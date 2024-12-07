<?php
require_once('C:\xampp\htdocs\ProjectWeb-TD\ProjectEduWeb-PHP\Views\Public\config.php');
require_once('C:\xampp\htdocs\ProjectWeb-TD\ProjectEduWeb-PHP\Controller\coursescontroll.php');
require_once('C:\xampp\htdocs\ProjectWeb-TD\ProjectEduWeb-PHP\Controller\lessoncontroll.php');
require_once('C:\xampp\htdocs\ProjectWeb-TD\ProjectEduWeb-PHP\Controller\chaptercontroller.php');

// Thiết lập kết nối đến cơ sở dữ liệu
$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Tạo instance của các Controller
$courseController = new CourseController($conn);
$lessonController = new LessonController($conn);
$chapterController = new ChapterController($conn);

// Kiểm tra course_id
if (isset($_GET['id'])) {
    $course_id = $_GET['id'];
    $course = $courseController->getCourseById($course_id); 
    $chapters = $chapterController->getChaptersByCourseId($course_id);
} else {
    echo "Course ID is not provided.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Style chỉnh sửa */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }
        .video-wrapper {
            background: linear-gradient(135deg, #28a745, #80e27e);
            border-radius: 8px;
            overflow: hidden;
        }
        .video-wrapper iframe {
            width: 100%;
            height: 400px;
        }
        h5 {
            color: #2d572c;
        }
        .list-group-item {
            background-color: #e8f5e9;
            color: #2d572c;
        }
        .lesson_duratitle {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            margin: 5px 0;
            cursor: pointer;
        }
        .lesson-title {
            font-size: 16px;
        }
        .lesson-duration {
            font-size: 14px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h1><?php echo htmlspecialchars($course['title']); ?></h1>
        <div class="row">
            <div class="col-md-8">
                <div class="video-wrapper">
                    <?php
                    function convertToEmbedURL($url) {
                        if (strpos($url, 'watch?v=') !== false) {
                            return str_replace('watch?v=', 'embed/', $url);
                        }
                        return $url;
                    }
                    ?>
                    <iframe src="<?php echo htmlspecialchars($lesson['content_url']); ?>"
                        title="Video Player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                </div>
            </div>
            <div class="col-md-4">
                <h5>Nội dung khóa học</h5>
                <div class="accordion" id="courseContentAccordion">
                    <?php if (!empty($chapters)): ?>
                        <?php foreach ($chapters as $index => $chapter): ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading<?php echo $index; ?>">
                                    <button class="accordion-button <?php echo ($index === 0) ? '' : 'collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $index; ?>" aria-expanded="<?php echo ($index === 0) ? 'true' : 'false'; ?>" aria-controls="collapse<?php echo $index; ?>">
                                        <?php echo htmlspecialchars($chapter['chapter_title']); ?>
                                    </button>
                                </h2>
                                <div id="collapse<?php echo $index; ?>" class="accordion-collapse collapse <?php echo ($index === 0) ? 'show' : ''; ?>" aria-labelledby="heading<?php echo $index; ?>" data-bs-parent="#courseContentAccordion">
                                    <div class="accordion-body">
                                        <ul>
                                            <?php
                                            $lessons = $lessonController->getLessonsByChapter($chapter['chapter_id']);
                                            if (!empty($lessons)): ?>
                                                <?php foreach ($lessons as $lesson): ?>
                                                    <li class="lesson_duratitle" data-video="<?php echo htmlspecialchars($lesson['content_url']); ?>">
                                                        <button class="lesson-title"><?php echo htmlspecialchars($lesson['description']); ?></button>
                                                        <span class="lesson-duration"><?php echo htmlspecialchars($lesson['duration']); ?> phút</span>
                                                    </li>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <li>Không có bài học nào trong chương này.</li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Không có nội dung nào trong khóa học này.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div> 
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function toggleSection(element) {
        const content = element.nextElementSibling;
        const icon = element.querySelector('.expand-icon');
        if (content.style.display === "block") {
            content.style.display = "none";
            icon.textContent = "+";
        } else {
            content.style.display = "block";
            icon.textContent = "-";
        }
    }
    document.querySelectorAll('.lesson_duratitle').forEach(item => {
            item.addEventListener('click', () => {
                const videoURL = item.getAttribute('data-video');
                const iframe = document.querySelector('.video-wrapper iframe');
                iframe.src = videoURL;
            });
        });

    </script>
    
    
</body>
</html>
