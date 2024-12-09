<?php
require_once('../../Public/config.php');
require_once('../../../Controller/coursescontroll.php');
require_once('../../../Controller/chaptercontroller.php');

// Thiết lập kết nối cơ sở dữ liệu
$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Tạo đối tượng CourseController và ChapterController
$courseController = new CourseController($conn);
$chapterController = new ChapterController($conn);

// Kiểm tra xem course_id có được truyền trong URL không
if (isset($_GET['id'])) {
    $course_id = intval($_GET['id']);
    $course = $courseController->getCourseById($course_id);
    $chapters = $chapterController->getChaptersByCourseId($course_id);
} else {
    echo "Course ID is not provided.";
    exit;
}

// Xử lý thêm chương
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_chapter'])) {
    $chapter_title = trim($_POST['chapter_title']);
    if (!empty($chapter_title)) {
        $data = ['chapter_title' => $chapter_title, 'course_id' => $course_id];
        $chapterController->createChapter($data);
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết khóa học</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
     <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .course-detail {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .course-title {
            color: #4CAF50; /* Màu xanh lá */
            font-size: 24px;
            margin-bottom: 10px;
        }

        .divider {
            height: 2px;
            background: #4CAF50;
            margin: 10px 0;
        }

        .course-description {
            margin-bottom: 20px;
            color: #555;
        }

        .form-container {
            margin-bottom: 20px;
        }

        button {
            background-color: #4CAF50; /* Màu xanh lá */
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049; /* Xanh lá đậm hơn khi hover */
        }

        .course-content {
            margin-top: 20px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .section-header:hover {
            background: #e8f5e9; /* Nền sáng hơn khi hover */
        }

        .toggle-icon {
            color: #4CAF50;
            font-weight: bold;
        }

        form {
            display: flex;
            flex-direction: column;
            margin-top: 10px;
        }

        form input[type="text"] {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="course-detail">
        <div class="content">
            <h1 class="course-title"><?php echo htmlspecialchars($course['title']); ?></h1>
            <div class="divider"></div>
            <p class="course-description"><?php echo htmlspecialchars($course['descriptions']); ?></p>

            <!-- Thêm chương -->
            <div class="form-container">
                <h2>Thêm Chương</h2>
                <button onclick="toggleForm('addChapterForm')">Thêm Chương</button>
                <form id="addChapterForm" method="POST" style="display: none;">
                    <input type="text" name="chapter_title" placeholder="Tiêu đề chương" required>
                    <input type="hidden" name="add_chapter" value="1">
                    <button type="submit">Thêm Chương</button>
                </form>
            </div>

            <div class="course-content">
                <h2>
                    <i class="fas fa-book-open" style="margin-right: 8px;"></i>Nội dung chương
                </h2>
                <?php if (count($chapters) > 0): ?>
                    <?php foreach ($chapters as $chapter): ?>
                        <div class="section-header" onclick="location.href='chapter_detail.php?id=<?php echo $chapter['chapter_id']; ?>'">
                            <h2 style="flex: 1;">-<?php echo htmlspecialchars($chapter['chapter_title']); ?></h2>
                            <span class="toggle-icon">xem chương</span>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Không có nội dung nào cho khóa học này.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
    function toggleForm(formId) {
        const form = document.getElementById(formId);
        form.style.display = (form.style.display === "none" || form.style.display === "") ? "block" : "none";
    }
    </script>
</body>
</html>

<?php
// Đóng kết nối
$conn->close();
?>