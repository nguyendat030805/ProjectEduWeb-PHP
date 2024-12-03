<?php
require_once('../../Public/config.php');
require_once('../../../Controller/coursescontroll.php'); // Include CourseController
require_once('../../../Controller/lessoncontroll.php'); // Include LessonController
require_once('../../../Controller/chaptercontroller.php'); // Include ChapterController

// Set up database connection
$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create instances of CourseController, LessonController, and ChapterController
$courseController = new CourseController($conn);
$lessonController = new LessonController($conn);
$chapterController = new ChapterController($conn); // Initialize ChapterController

// Check if course_id is set in the URL
if (isset($_GET['id'])) {
    $course_id = $_GET['id'];
    $course = $courseController->getCourseById($course_id); // Get course information
    $chapters = $chapterController->getChaptersByCourseId($course_id); // Get chapters for the course
} else {
    echo "Course ID is not provided.";
    exit;
}

// Handle adding a chapter
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_chapter'])) {
    $chapter_title = $_POST['chapter_title'];
    if (!empty($chapter_title)) {
        $data = ['title' => $chapter_title, 'course_id' => $course_id]; // Prepare data
        $response = $chapterController->createChapter($data);
        header("Location: " . $_SERVER['REQUEST_URI']); // Refresh the page
        exit();
    }
}

// Handle adding a lesson
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_lesson'])) {
    $lesson_title = $_POST['lesson_title'];
    $lesson_duration = $_POST['lesson_duration'];
    $chapter_id = $_POST['chapter_id'];
    
    if (!empty($lesson_title) && !empty($lesson_duration) && !empty($chapter_id)) {
        $data = [
            'title' => $lesson_title,
            'duration' => $lesson_duration,
            'chapter_id' => $chapter_id,
            // Add other necessary fields like content_url and type if required
        ];
        $response = $lessonController->createLesson($data); // Create lesson
        header("Location: " . $_SERVER['REQUEST_URI']); // Refresh the page
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
        /* Existing styles */
        body { margin: 0; padding: 0; background-color: #f9f9f9; font-family: Arial, sans-serif; }
        .course-detail { display: flex; justify-content: space-between; margin: 20px auto; max-width: 1200px; }
        .content { width: 65%; }
        .course-title { font-size: 35px; font-weight: bold; }
        .divider { border-top: 6px solid #32c787; width: 40px; }
        .form-container { background-color: #fff; padding: 15px; border-radius: 5px; margin: 10px 0; border: 1px solid #ddd; }
        .form-container input { width: 100%; padding: 10px; margin: 5px 0; border: 1px solid #ccc; border-radius: 5px; }
        .form-container button { background-color: #32c787; color: #fff; border: none; border-radius: 5px; padding: 10px 20px; cursor: pointer; transition: background-color 0.3s ease; }
        .form-container button:hover { background-color: #22cd8b; }
        .learning-outcomes h2 { font-size: 20px; margin-bottom: 10px; }
        .course-content h2 { font-size: 20px; }
        /* Additional styles as needed */
    </style>
</head>
<body>
    <div class="course-detail">
        <div class="content">
            <h1 class="course-title"><?php echo htmlspecialchars($course['title']); ?></h1>
            <div class="divider"></div>
            <p class="course-description"><?php echo htmlspecialchars($course['descriptions']); ?></p>

            <!-- Add Chapter Form -->
            <div class="form-container">
                <h2>Thêm Chương</h2>
                <form method="POST">
                    <input type="text" name="chapter_title" placeholder="Tiêu đề chương" required>
                    <input type="hidden" name="add_chapter" value="1">
                    <button type="submit">Thêm Chương</button>
                </form>
            </div>

            <!-- Add Lesson Form -->
            <div class="form-container">
                <h2>Thêm Bài Học</h2>
                <form method="POST">
                    <input type="text" name="lesson_title" placeholder="Tiêu đề bài học" required>
                    <input type="text" name="lesson_duration" placeholder="Thời gian (phút)" required>
                    <input type="number" name="chapter_id" placeholder="ID chương" required>
                    <input type="hidden" name="add_lesson" value="1">
                    <button type="submit">Thêm Bài Học</button>
                </form>
            </div>

            <div class="learning-outcomes">
                <h2>Bạn sẽ học được gì?</h2>
                <ul class="outcomes-list">
                    <li>Hiểu các khái niệm và kỹ năng cần thiết trong lĩnh vực của khóa học</li>
                    <li>Nắm vững các kiến thức cơ bản và ứng dụng thực tế</li>
                    <li>Thành thạo sử dụng công cụ hoặc kỹ thuật liên quan để giải quyết vấn đề</li>
                    <li>Xây dựng các dự án thực tế để áp dụng kiến thức đã học</li>
                    <li>Nâng cao khả năng tư duy và sáng tạo</li>
                    <li>Sẵn sàng học thêm các chủ đề nâng cao để phát triển kỹ năng</li>
                </ul>
            </div>

            <div class="course-content">
                <h2>Nội dung bài học</h2>
                <?php if (count($chapters) > 0): ?>
                    <?php foreach ($chapters as $chapter): ?>
                        <div class="section-header" onclick="toggleSection(this)">
                            <h2><?php echo htmlspecialchars($chapter['chapter_title']); ?></h2>
                            <span class="toggle-icon">+</span>
                        </div>
                        <div class="section-content">
                            <ul>
                                <?php
                                $lessons = $lessonController->getLessonsByChapter($chapter['chapter_id']); // Get lessons by chapter_id
                                if (isset($lessons) && count($lessons) > 0): ?>
                                    <?php foreach ($lessons as $lesson): ?>
                                        <li>
                                            <span class="lesson-title"><?php echo htmlspecialchars($lesson['title']); ?></span>
                                            <span class="lesson-duration"><?php echo htmlspecialchars($lesson['duration']); ?> phút</span>
                                        </li>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <li>Không có bài học nào trong phần này.</li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Không có nội dung nào cho khóa học này.</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="sidebar">
            <div class="video-preview">
                <iframe src="<?php echo $course['video_url']; ?>"
                        title="Giới thiệu khóa học" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                </iframe>
                <p>Khám phá nội dung khóa học của chúng tôi qua video này!</p>
            </div>
            <div class="price">
                <p><?php echo htmlspecialchars($course['discounted_price']); ?> VND</p>
            </div>
        </div>
    </div>

    <script>
    function toggleSection(element) {
        const content = element.nextElementSibling;
        const icon = element.querySelector('.toggle-icon');
        if (content.style.display === "block") {
            content.style.display = "none";
            icon.textContent = "+";
        } else {
            content.style.display = "block";
            icon.textContent = "-";
        }
    }
    </script>
</body>
</html>

<?php
// Close the connection
$conn->close();
?>