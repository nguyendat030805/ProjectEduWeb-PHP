<?php
require_once('C:\xampp\htdocs\ProjectWeb-TD\ProjectEduWeb-PHP\Views\Public\config.php');
require_once('C:\xampp\htdocs\ProjectWeb-TD\ProjectEduWeb-PHP\Controller\coursescontroll.php'); // Bao gồm CourseController
require_once('C:\xampp\htdocs\ProjectWeb-TD\ProjectEduWeb-PHP\Controller\lessoncontroll.php'); // Bao gồm LessonController
require_once('C:\xampp\htdocs\ProjectWeb-TD\ProjectEduWeb-PHP\Controller\chaptercontroller.php'); // Bao gồm ChapterController

// Thiết lập kết nối đến cơ sở dữ liệu
$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Tạo instance của CourseController, LessonController và ChapterController
$courseController = new CourseController($conn);
$lessonController = new LessonController($conn);
$chapterController = new ChapterController($conn); // Khởi tạo ChapterController

// Kiểm tra xem course_id có được thiết lập trong URL không
if (isset($_GET['id'])) {
    $course_id = $_GET['id'];
    $course = $courseController->getCourseById($course_id); // Lấy thông tin khóa học
    $chapters = $chapterController->getChaptersByCourseId($course_id); // Lấy các chương cho khóa học
} else {
    echo "Course ID is not provided.";
    exit;
}

// Bây giờ bạn có thể sử dụng $chapters để hiển thị thông tin chương
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
    margin: 0;
    padding: 0;
    background-color: #f9f9f9;
    font-family: Arial, sans-serif;

}

.course-detail {
    display: flex;
    justify-content: space-between;
    margin: 20px auto;
    max-width: 1200px;
}

.content {
    width: 65%;
}

.course-title {
    font-size: 35px;
    font-weight: bold;
}
.divider{
    border-top: 6px solid #32c787;
    width: 40px;
}
/*  */
.icon-container {
    display: flex;
    justify-content: space-around;
}

.icon-item {
    text-align: center;
    color: #333;
}
.icon-item p {
    padding-top:10px ;
    margin: 0;
    font-size: 14px;
}
.icon-circle {
    width: 80px;
    height: 80px;
    background-color: #404345;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    transition: transform 0.5s ease; /* Hiệu ứng chuyển động */
}

.icon-item:hover .icon-circle {
    transform: rotate(360deg);
    background-color: #32c787; /* Màu xanh đậm hơn */
    
}
.icon-circle i {
    font-size: 24px;
    color: #fff;
}

.learning-outcomes h2 {
    font-size: 20px;
    margin-bottom: 10px;
}

.outcomes-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.outcomes-list li {
    margin: 5px 0;
    display: flex;
    align-items: center;
 
}

.outcomes-list li::before {
    content: "✔";
    color: #32c787;
    margin-right: 10px;
}
.dicription{
    display: flex;
    gap: 10px;
    font-size: 16px;
   
}
.course-content h2 {
    font-size: 20px;
}
/* Tổng quát cho nội dung khóa học */
.section-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin-bottom: 10px;
    padding: 15px;      
    transition: background-color 0.3s ease;
    position: relative; /* Để hỗ trợ ::before */
}

.section-header::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 5px; /* Độ rộng của dải màu xanh */
    background-color: #32c787; /* Màu xanh */
    border-radius: 5px 0 0 5px; /* Bo tròn chỉ góc trái */
}

.section-header:hover {
    background-color: #e0f7fa; /* Hiệu ứng hover */
}

.section-header h2 {
    font-size: 1rem;
    margin: 0;
    color: #333;
}

.section-header .toggle-icon {
    font-size: 32px; /* Tăng kích thước dấu cộng */
    color: #32c787;
    transition: transform 0.3s ease;
}

/* Nội dung chi tiết */
.section-content {
    display: none;
    padding: 15px;
    border: 1px solid #ddd;
    border-top: none;
    background-color: #fff;
    border-radius: 0 0 5px 5px;
}

.section-content ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.section-content li {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    border-bottom: 1px solid #f0f0f0;
}

.section-content li:last-child {
    border-bottom: none;
}

.lesson-title {
    color: #333;
    font-size: 0.9rem;
}

.lesson-duration {
    color: #777;
    font-size: 0.9rem;
}

/* Khi mở mục */
.section-header.open .toggle-icon {
    transform: rotate(45deg); /* Xoay dấu cộng thành dấu trừ */
}

/* Hiển thị nội dung khi được mở */
.section-header.open .toggle-icon,
.section-item.open .section-toggle {
    transform: rotate(45deg); /* Dấu trừ khi mở */
}
.section-header:hover, .section-item:hover {
    background-color: #e0f7fa; /* Màu sáng hơn khi hover */
}
/*  */
.sidebar {
    width: 30%;
    text-align: center;
    position: fixed;
    right:0;
    top: 125px;
}

.video-preview {
    background: #e3e3e3;
    border-radius: 8px;
    padding: 15px;
}

.video-preview img {
    width: 100%;
    border-radius: 8px;
}

.video-preview p {
    margin: 10px 0 0;
    color: #555;
    font-size: 0.9rem;
}

.price p {
    font-size: 1.5rem;
    font-weight: bold;
   
    margin: 10px 0;
}
.register-btn {
  background-color: #32c787; /* Màu nền xanh lá */
  color: #fff; /* Màu chữ trắng */
  border: none; /* Xóa viền */
  border-radius: 5px; /* Góc bo tròn */
  padding: 10px 20px; /* Khoảng cách bên trong */
  font-size: 16px; /* Cỡ chữ */
  font-weight: bold; /* Đậm chữ */
  cursor: pointer; /* Con trỏ khi rê chuột */
  transition: all 0.3s ease; /* Hiệu ứng mượt khi hover */
}

.register-btn:hover {
  background-color: #22cd8b; /* Màu xanh lá đậm hơn khi hover */
  transform: scale(1.05); /* Tăng nhẹ kích thước */
}

.register-btn:active {
  background-color: #1e7e34; /* Màu xanh lá tối khi nhấn */
  transform: scale(0.95); /* Giảm nhẹ kích thước khi nhấn */
}

</style>
</head>
<body>
    <div class="course-detail">
        <div class="content">
            <h1 class="course-title"><?php echo htmlspecialchars($course['title']); ?></h1>
            <div class="divider"></div>
            <p class="course-description">
                <?php echo htmlspecialchars($course['descriptions']); ?>
            </p>
            <div class="icon-container">
                <div class="icon-item">
                    <div class="icon-circle">
                        <i class="fas fa-flag"></i>
                    </div>
                    <p>Hơn 60 bài học</p>
                </div>
                <div class="icon-item">
                    <div class="icon-circle">
                        <i class="fas fa-clock"></i>
                    </div>
                    <p>Thời lượng 5+ giờ</p>
                </div>
                <div class="icon-item">
                    <div class="icon-circle">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <p>Phù hợp mọi đối tượng</p>
                </div>
                <div class="icon-item">
                    <div class="icon-circle">
                        <i class="fas fa-sitemap"></i>
                    </div>
                    <p>Lộ trình học rõ ràng</p>
                </div>
                <div class="icon-item">
                    <div class="icon-circle">
                        <i class="fas fa-sync-alt"></i>
                    </div>
                    <p>Nội dung luôn cập nhật</p>
                </div>
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
                                $lessons = $lessonController->getLessonsByChapter($chapter['chapter_id']); // Lấy bài học theo course_id và chapter_id
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
            <!-- Thêm phần video preview và giá khóa học nếu cần -->
                <div class="video-preview">
                    <iframe src="<?php echo htmlspecialchars($course['video_url']); ?>" title="Giới thiệu khoá học" width="560" height="315" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                    </iframe>       
                    <p>Khám phá nội dung khóa học của chúng tôi qua video này!</p>
                </div>
                <div class="price">
                    <p><?php echo htmlspecialchars($course['original_price']); ?> VND</p>
                    <button class="register-btn">Đăng ký ngay</button>
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
// Đóng kết nối
$conn->close();
?>