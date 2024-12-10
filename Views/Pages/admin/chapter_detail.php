<?php
require_once('../../Public/config.php');
require_once('../../../Controller/lessoncontroll.php');
require_once('../../../Controller/chaptercontroller.php');

// Thiết lập kết nối cơ sở dữ liệu
$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Tạo các đối tượng LessonController và ChapterController
$lessonController = new LessonController($conn);
$chapterController = new ChapterController($conn);

// Kiểm tra xem chapter_id có được truyền trong URL không
if (isset($_GET['id'])) {
    $chapter_id = intval($_GET['id']);
    $chapter = $chapterController->getChapterById($chapter_id);
    
    // Kiểm tra xem chương có tồn tại không
    if ($chapter === null) {
        echo "Không tìm thấy chương với ID: " . htmlspecialchars($chapter_id);
        exit;
    }
    
    $lessons = $lessonController->getLessonsByChapter($chapter_id);
} else {
    echo "ID chương không được cung cấp.";
    exit;
}

// Xử lý yêu cầu thêm bài học
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'add') {
        // Lấy dữ liệu từ form
        $data = [
            'title' => $_POST['title'],
            'content_url' => $_POST['content_url'], // Đọc URL YouTube
            'description' => intval($_POST['description']),
            'chapter_id' => $chapter_id
        ];

        $lessonController->createLesson($data);
        header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $chapter_id);
        exit;
    } elseif ($_POST['action'] === 'edit') {
        // Logic chỉnh sửa vẫn giữ nguyên, nhưng đảm bảo xử lý URL đúng cách
        if (isset($_POST['lesson_id'])) {
            $lesson_id = intval($_POST['lesson_id']);
            $data = [
                'title' => $_POST['title'],
                'content_url' => $_POST['content_url'] ?? null, // Đọc URL YouTube
                'description' => intval($_POST['description']),
                'chapter_id' => $chapter_id
            ];

            $lessonController->updateLesson($lesson_id, $data);
            header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $chapter_id);
            exit;
        }
    } elseif ($_POST['action'] === 'delete') {
        if (isset($_POST['lesson_id'])) {
            $lesson_id = intval($_POST['lesson_id']);
            $lessonController->deleteLesson($lesson_id);
            header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $chapter_id);
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài học của Chương</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            display: flex;
        }
        .lesson-detail {
            max-width: 800px;
            margin-right: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .video-container {
            flex: 1;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            display: none;
        }
        h1, h2 {
            color: #4CAF50; 
        }
        form {
            margin-top: 20px;
            margin-bottom: 20px;
        }
        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #45a049;
        }
        .course-content {
            margin-top: 20px;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
            background: #f9f9f9;
        }
        .actions {
            margin-top: 10px;
        }
        .toggle-form {
            margin-top: 20px;
            background: #4CAF50;
            padding: 10px;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: inline-block;
            transition: background 0.3s;
        }
        .toggle-form:hover {
            background: #45a049;
        }
    </style>
</head>
<body>
    <div class="lesson-detail">
        <h1>Bài học trong chương: <?php echo htmlspecialchars($chapter['chapter_title']); ?></h1>
        
        <button class="toggle-form" onclick="toggleForm()">Thêm Bài Học</button>
        
        <form id="addLessonForm" action="" method="POST" style="display: none;">
            <input type="hidden" name="action" value="add">
            <input type="text" name="title" placeholder="Tiêu đề bài học" required>
            <input type="text" name="content_url" placeholder="Link YouTube" required>
            <input type="text" name="description" placeholder="mô tả" required>
            <button type="submit">Thêm Bài Học</button>
        </form>

        <div class="course-content">
            <?php if (count($lessons) > 0): ?>
                <ul>
                    <?php foreach ($lessons as $lesson): ?>
                        <li>
                            <span class="lesson-title"><?php echo htmlspecialchars($lesson['title']); ?></span>
                            <div class="actions">
                                <button onclick="showContent('<?php echo htmlspecialchars($lesson['content_url']); ?>')">Xem Bài Học</button>
                                <form action="" method="POST" style="display:inline;">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="lesson_id" value="<?php echo $lesson['lesson_id']; ?>">
                                    <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa bài học này?');">Xóa</button>
                                </form>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Không có bài học nào trong chương này.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="video-container" id="contentDisplay">
        <!-- Nội dung video sẽ hiển thị ở đây -->
    </div>

    <script>
        function showContent(url) {
            const contentDisplay = document.getElementById('contentDisplay');
            // Chuyển đổi URL thành định dạng nhúng
            const videoId = extractVideoId(url);
            if (videoId) {
                const embedUrl = `https://www.youtube.com/embed/${videoId}`;
                contentDisplay.innerHTML = `<iframe width="100%" height="400" src="${embedUrl}" frameborder="0" allowfullscreen></iframe>`;
                contentDisplay.style.display = 'block'; // Hiển thị khung
            } else {
                alert('URL không hợp lệ.');
            }
        }

        // Hàm trích xuất video ID từ URL YouTube
        function extractVideoId(url) {
            const regex = /(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^&\n]{11})/;
            const match = url.match(regex);
            return match ? match[1] : null;
        }

    function toggleForm() {
        const form = document.getElementById('addLessonForm');
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    }
    </script>
</body>
</html>

<?php
// Đóng kết nối
$conn->close();
?>