<?php
require_once('../../Public/config.php');
require_once('../../../Controller/coursescontroll.php');
require_once('../../../Model/coursemodel.php');

// Khởi tạo kết nối đến cơ sở dữ liệu
$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Tạo một instance của CourseController
$courseController = new CourseController($conn);

// Lấy tất cả khóa học
$courses = $courseController->index(); // Đảm bảo biến $courses được khởi tạo

// Lấy 4 khóa học đầu tiên
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <!-- Import Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="/Views/Css/home.css">
  <!-- Libraries Stylesheet -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
</head>
<style>
body {
    font-family: Arial, sans-serif;
}
/* Trạng thái ban đầu (ẩn) */
.card {
  opacity: 0;
  transform: translateY(50px);
  transition: opacity 0.8s ease-out, transform 0.8s ease-out; /* Hiệu ứng smooth hơn */
}

.card.visible {
  opacity: 1;
  transform: translateY(0);
}

.container {
 
  width: 100%;
  background-color: fff;
}
.custom-black {
    color: black;
}

/* Body 1 */

.body-1 {
  display: flex;
  justify-content: center; 
  gap: 15px;
  margin-top: 25px;
}
.square-avatar {
    width: 45px;
    height: 45px;
    object-fit: cover;
}
.card-title {
    font-size: 14px;
    color: #000;
    transition: color 0.3s ease;
}
.card-title:hover,
.card-title:focus {
    color: #28a745;
    cursor: pointer;
}
.card-img-top {
    transition: transform 0.3s ease;
    overflow: hidden;
}
.card {
    overflow: hidden;
}
.card:hover .card-img-top {
    transform: scale(1.1);
}
.text-danger {
    color: #6c757d !important;
}
.text-danger del {
    color: #6c757d !important;
}

.text-muted.mb-1 {
    border-bottom: 1px solid #dcdcdc;
    padding-bottom: 5px;
}
.btn-success {
    background-color: #47CF73;      
    padding: 5px 15px;              
    border: 2px solid #47CF73;      
    border-radius: 5px;             
    color: black;                   
    font-size: 20px;
    font-weight: bold;                                
    transition: background-color 0.3s, border-color 0.3s; 
}
.btn-success:hover {
    background-color: green;      
    border-color: #40b760;         
}
.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}
.card:hover {
    transform: translateY(-15px);
    box-shadow: 0px 15px 30px rgba(0, 0, 0, 0.3);
    border: 1px solid darkgreen;
}

/* Body 2 */

.jane-herbert {
    background-color: #47CF73;
    padding: 35px;
    margin: 20px 0px; 
    color: black;
    
}
.jane {
    background-color: white;
    margin-bottom: 20px;
    padding: 22px;
    border-radius: 10px;
}
.achieve {
    display: flex;
    gap: 25px;
}
.time {
    display: flex;
    gap: 60px;
}
.btn {
    background-color: white;
    border: 1px solid black;
    width: 300px;
    height: 50px;
}
.img-cup {
  transition: transform 0.3s, box-shadow 0.3s; 
}
.img-cup:hover {
  transform: scale(1.2); 
}
.icon {
    margin-right: 15px; 
}
.img-jane {
    max-width: 300px; 
    max-height: 450px;
    transition: transform 0.5s, box-shadow 0.3s; 
}
.img-jane:hover {
    transform: scale(1.1);
}
/* Ẩn animation ban đầu */
.animate__animated {
    visibility: visible; /* Đảm bảo rằng nó có thể được nhìn thấy */
}

/* Body 3 */

.course-card {
  padding: 10px;
  border: none;
  border-radius: 10px;
  overflow: hidden;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  background-color: #fff;
}
.course-card:hover {
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
}
.card-img-top {
  width: 100%;
  height: 200px;
  object-fit: cover;
  border: none;
  border-radius: 10px;
}
/* Author Info */
.author-info {
  display: grid;
  grid-template-columns: 50px auto;
  gap: 10px;
 
}


.author-avatar {
  width: 50px;
  height: 50px;
  object-fit: cover;
}


.author-content {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
}

/* Typography */
.card-title {
  font-size: 1.1rem;
  font-weight: bold;
  margin-bottom: 0.3rem;
}

.text-muted {
  font-size: 0.9rem;
  color: #757575;
}

.price {
  font-weight: bold;
  color: #828385;
}


.old-price {
  text-decoration: line-through;
  color: #757575;
}

/* Divider */
.divider {
  border-top: 1px solid #e0e0e0;
  margin: 10px 0;
}

/* Card Body */
.card-body {
  padding-left: 15px;
}
.card-body p {
  margin-bottom: 8px;
}
.text-secondary.custom-black {
    opacity: 0; /* Ẩn ban đầu */
    transform: translateY(20px); /* Đẩy xuống một chút */
    transition: opacity 0.5s ease, transform 0.5s ease; /* Hiệu ứng mượt mà */
}

.text-secondary.custom-black.visible {
    opacity: 1; /* Hiện khi có lớp visible */
    transform: translateY(0); /* Trở về vị trí ban đầu */
}
.img-jane{
    width: 200px;
    height: 200px;
    object-fit: cover;
    border: 10px solid black;
    border-radius: 20px;
}
</style>
<body>
    <?php include '../../Layouts/headerLogin.html' ?>
  <div class="container">
<!-- Body 1 -->
    <div class="container mt-5">
        <div class="text-center">
        <h1 id="top-courses" class="fw-bold custom-black animate__animated">Top Courses</h1>
        <p class="text-secondary custom-black">Find Courses and Specializations from top Lecturers</p>
        <button type="submit" class="btn-success " style="color: black;">Explore</button>
        </div>
    </div>
    <div class="body-1">
        <!-- Card 1 -->
         <!-- Courses Section -->
         <?php
    // Giả sử $courses đã được lấy từ CourseController, ví dụ:
    // $courses = $courseController->index();

    // Lấy 4 khóa học đầu tiên
    $topCourses = array_slice($courses, 0, 4);
    ?>

    <div class="row">
        <?php foreach ($topCourses as $course): ?>
            <div class="col-md-3 d-flex">
                <div class="card flex-grow-1">
                    <!-- Hình ảnh khóa học -->
                    <a href="detail.php?id=<?php echo htmlspecialchars($course['course_id']); ?>">                    <img 
                        src="<?= htmlspecialchars($course['images']) ?>" 
                        class="card-img-top card-img-fixed" 
                        alt="<?= htmlspecialchars($course['title']) ?>"
                    ></a>
                    <div class="card-body">
                        <!-- Tiêu đề khóa học -->
                        <h6 class="card-title fw-bold mb-0">
                            <?= htmlspecialchars($course['title']) ?>
                        </h6>

                        <!-- Mô tả ngắn -->
                        <p class="text-muted mb-1">
                            <?= htmlspecialchars($course['descriptions']) ?>
                        </p>

                        <!-- Giá khóa học -->
                        <p class="fw-bold <?= $course['types'] === 'Free' ? 'text-success' : 'text-danger' ?>">
                            <?= $course['types'] === 'Free' 
                                ? 'Free' 
                                : "$" . number_format($course['original_price'], 2)
                            ?>
                        </p>

                        <!-- Đánh giá sao (tĩnh hoặc động) -->
                        <div class="text-warning">
                            ★★★★★
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>      

    </div>
    <!-- </div> -->
<!-- Body 2 3 -->
<div class="jane-herbert">
    <!-- Body 2 -->
    <div class="jane-wrapper">
        <div class="row align-items-center jane">
            <div class="col-md-8">
                <h2>Mr.Hiệp Hồ</h2>
                <p>Cho dù bạn làm việc trong lĩnh vực học máy hay tài chính, hoặc đang theo đuổi sự nghiệp phát triển web hay khoa học dữ liệu, Python là một trong những kỹ năng quan trọng nhất mà bạn có thể học.</p>
                <div class="achieve">
                    <div class="img-cup">
                        <img src="../../Public/Assets/Image/img_cup.png" alt="Jane-Achievements" class="img-fluid">
                    </div>
                    <div class="time">
                        <div>
                            <h2>19 năm</h2>
                            <span class="text-black">Kinh nghiệm</span>
                        </div>
                        <button type="button" class="d-flex justify-content-between align-items-center btn">
                            Khoá học của Hiệp 
                            <i class="bi bi-chevron-right icon"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-center ">
                <img src="../../Public/Assets/Image/z6072512062445_10257e3160ce576ab5aaad21f5582d40.jpg" alt="Image" class="img-jane">
            </div>
        </div>
    </div>
  <!-- Body 3 -->  
        <div class="row gy-4 gx-3">
        <?php
        // Giả sử $courses đã được lấy từ CourseController, ví dụ:
        // $courses = $courseController->index();

        $topCourses = array_slice($courses, 4, 4);
        ?>
            <!-- Card 1 -->
            <?php foreach ($topCourses as $course): ?>
            <div class="col-md-3">
                <a href="detail.php?id=<?php echo htmlspecialchars($course['course_id']); ?>" class="text-decoration-none">
                    <div class="card flex-grow-1">
                        <img src="<?= htmlspecialchars($course['images']) ?>" class="card-img-top card-img-fixed" alt="<?= htmlspecialchars($course['title']) ?>">
                        <div class="card-body">
                            <div class="author-info d-flex align-items-center">
                                <img src="../../Public/Assets/Image/z6072512062445_10257e3160ce576ab5aaad21f5582d40.jpg" class="author-avatar" alt="Author Avatar">
                                <div class="author-content ms-2">
                                    <h5 class="card-title mb-0"><?= htmlspecialchars($course['title']) ?></h5>
                                    <p class="mb-1"></p>Mr.Hiệp Hồ</p>
                                    <p class="text-muted mb-2">
                                        <i class="bi bi-briefcase"></i> Business, Course
                                    </p>
                                </div>
                            </div>
                            <div class="divider my-2"></div>
                            <p class="price fw-bold <?= $course['types'] === 'Free' ? 'text-success' : 'text-danger' ?>">
                                <?= $course['types'] === 'Free' 
                                    ? 'Free' 
                                    : "$" . number_format($course['original_price'], 2) 
                                ?>
                            </p>
                            <div class="text-warning">
                            ★★★★★
                        </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
           
        </div>     
    </div>     
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Cấu hình cho Intersection Observer
        const observerOptions = {
            root: null, // Sử dụng viewport mặc định
            threshold: 0.1 // 10% phần tử xuất hiện
        };

        // Observer cho các thẻ card
        const cards = document.querySelectorAll('.card'); // Lấy tất cả các thẻ card
        if (cards.length > 0) {
            const cardObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible'); // Thêm lớp visible khi vào viewport
                        observer.unobserve(entry.target); // Ngừng theo dõi sau khi animation đã chạy
                    }
                });
            }, observerOptions);

            // Áp dụng observer vào mỗi thẻ card
            cards.forEach(card => cardObserver.observe(card));
        }
        // Observer cho phần tử "top-courses"
        const topCourses = document.getElementById('top-courses');
        if (topCourses) {
            const topCoursesObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        topCourses.classList.add('animate__animated', 'animate__fadeInDown');
                        topCourses.style.visibility = 'visible'; // Hiện phần tử nếu cần
                        observer.unobserve(topCourses); // Ngừng theo dõi sau khi animation đã chạy
                    }
                });
            }, observerOptions);

            // Bắt đầu theo dõi phần tử top-courses
            topCoursesObserver.observe(topCourses);
        }

        // Hiệu ứng cho nút Explore
        const exploreButton = document.querySelector('.btn-success');
        if (exploreButton) {
            exploreButton.classList.add('animate__animated', 'animate__pulse');
        }

        // Observer cho phần "Jane Herbert"
        const janeSection = document.querySelector('.jane-wrapper'); // Sử dụng đúng selector
        if (janeSection) {
            const janeObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        console.log('Jane section is in view'); // Debug log
                        janeSection.classList.add('animate__animated', 'animate__zoomIn');
                        observer.unobserve(janeSection); // Ngừng theo dõi sau khi animation đã chạy
                    }
                });
            }, observerOptions);

            janeObserver.observe(janeSection);
        }
    });
        // Cấu hình cho Intersection Observer
        const observerOptions = {
            root: null, // Sử dụng viewport mặc định
            threshold: 0.1 // 10% phần tử xuất hiện
        };

        // Observer cho các thẻ card
        const cards = document.querySelectorAll('.card'); // Lấy tất cả các thẻ card
        if (cards.length > 0) {
            const cardObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible', 'animate__animated', 'animate__fadeInUp');
                        observer.unobserve(entry.target); // Ngừng theo dõi sau khi animation đã chạy
                    }
                });
            }, observerOptions);

            // Áp dụng observer vào mỗi thẻ card
            cards.forEach(card => cardObserver.observe(card));
        }

        // Observer cho phần tử "top-courses"
        const topCourses = document.getElementById('top-courses');
        if (topCourses) {
            const topCoursesObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        topCourses.classList.add('animate__animated', 'animate__fadeInDown');
                        topCourses.style.visibility = 'visible'; // Hiện phần tử nếu cần
                        observer.unobserve(topCourses); // Ngừng theo dõi sau khi animation đã chạy
                    }
                });
            }, observerOptions);

            // Bắt đầu theo dõi phần tử top-courses
            topCoursesObserver.observe(topCourses);
        }

        // Hiệu ứng cho nút Explore
        const exploreButton = document.querySelector('.btn-success');
        if (exploreButton) {
            exploreButton.classList.add('animate__animated', 'animate__zoomIn');
        }

        document.addEventListener('DOMContentLoaded', () => {
    // Cấu hình cho Intersection Observer
        const observerOptions = {
            root: null, // Sử dụng viewport mặc định
            threshold: 0.1 // 10% phần tử xuất hiện
        };

        // Observer cho đoạn văn "Find Courses and Specializations"
        const subtitle = document.querySelector('.text-secondary.custom-black'); // Lấy đoạn văn
        if (subtitle) {
            const subtitleObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        subtitle.classList.add('visible'); // Thêm lớp visible khi vào viewport
                        observer.unobserve(subtitle); // Ngừng theo dõi sau khi animation đã chạy
                    }
                });
            }, observerOptions);

            subtitleObserver.observe(subtitle); // Bắt đầu theo dõi đoạn văn
        }
    });

</script>

<?php include '../../../Views/Layouts/footer.html'; ?> 
</body>
</html>

<?php

