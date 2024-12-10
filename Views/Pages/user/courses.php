<?php
require_once('../../Public/config.php'); // Kết nối cơ sở dữ liệu

// Lấy dữ liệu khóa học Pro
$stmt = $conn->prepare("SELECT * FROM Courses WHERE types = 'Pro'");
$stmt->execute();
$result = $stmt->get_result(); // Lấy kết quả dưới dạng đối tượng mysqli_result
$pro_courses = [];
while ($course = $result->fetch_assoc()) {
    $pro_courses[] = $course; // Lưu từng bản ghi vào mảng
}
// Lấy dữ liệu khóa học miễn phí
$stmt_free = $conn->prepare("SELECT * FROM Courses WHERE types = 'Free'");
$stmt_free->execute();
$result_free = $stmt_free->get_result(); // Lấy kết quả dưới dạng đối tượng mysqli_result
$free_courses = [];
while ($course_free = $result_free->fetch_assoc()) {
    $free_courses[] = $course_free; // Lưu từng bản ghi vào mảng
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khóa Học</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <style>
        .card-price {
            font-size: 1.3rem;
            font-weight: bold;
            color: gray;
        }
        .card-price.green {
            color: #32c787;
        }
        .old-price {
            text-decoration: line-through;
            color: #888;
            font-size: 1rem;
            margin-right: 10px;
        }
        .price-row {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }
        .card {
            height: auto;
            max-height: 300px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 20px rgba(255, 255, 255, 0.2);
        }
        .card-img-top {
            height: 150px; /*Giảm chiều cao ảnh*/
            object-fit: cover;
        }
        .card-header {
            background-color: #32c787!important;
            color: white !important;
            font-weight: bold;
            font-size: 16px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .card-header:hover {
            background-color: ghostwhite!important;
            color: #32c787 !important;
            cursor: pointer;
        }
        .badge.bg-primary {
            background-color: yellow !important;
            color: black !important;
        }
        .info-row {
            font-size: 0.9rem;
            color: #555;
            margin-top: 10px;
        }
        .info-row i {
            margin-right: 5px;
            color: gray;
        }
        #coures {
            font-weight: bold;
        }
        .fas.fa-crown {
            color: gold;
        }
        .free-course-price {
            text-align: left;
            font-weight: bold;
            color: #32c787;
            font-size: 18px;
        }
        .card-link {
            text-decoration: none; /* Loại bỏ gạch chân */
            color: inherit; /* Giữ màu sắc gốc */
        }
        .mt-5{
            color: black;
            text-align: center;
        }
    </style>
</head>
<body>
    <?php include '../../Layouts/headerLogin.html' ?>
    <div class="container my-5">
        <!-- Khóa học Pro -->
        <h1 class="mt-5" id="coures">Khóa học Pro <i class="fas fa-crown"></i></h1>
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <?php foreach ($pro_courses as $course): ?>
            <div class="col">
            <a href="detail.php?course_id=<?= htmlspecialchars($course['course_id']) ?>" class="card-link">
                <div class="card h-100 text-center">
                    <div class="card-header bg-primary text-white"><?= htmlspecialchars($course['title']) ?> <i class="fas fa-crown"></i></div>
                    <div class="card-body">
                        <img src="<?= htmlspecialchars($course['images']) ?>" class="card-img-top card-img-fixed" alt="<?= htmlspecialchars($course['title']) ?>">
                        </a>
                        <div class="price-row">
                            <p class="price fw-bold <?= $course['types'] === 'Free' ? 'text-success' : 'text-danger' ?>">
                                <?= $course['types'] === 'Free' 
                                    ? 'Free' 
                                    : "$" . number_format($course['original_price'], 2) 
                                ?>
                            </p>
                        </div>
                        <!-- Liên kết tới trang chi tiết khóa học -->
                    </div>
                </div>
                
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Khóa học miễn phí -->
        <h1 class="mt-5" id="coures">Khóa học miễn phí</h1>
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <?php foreach ($free_courses as $course): ?>
            <div class="col">
                <div class="card h-100 text-center free-course">
                <a href="detail.php?id=<?= htmlspecialchars($course['course_id']) ?>" class="card-link">
                    <div class="card-header"><?= htmlspecialchars($course['title']) ?></div>
                    <div class="card-body">
                        <img src="<?= htmlspecialchars($course['images']) ?>" class="card-img-top" alt="<?= htmlspecialchars($course['title']) ?>">
                        </a>
                        <p class="price fw-bold <?= $course['types'] === 'Free' ? 'text-success' : 'text-danger' ?>">
                            <?= $course['types'] === 'Free' 
                                ? 'Free' 
                                : "$" . number_format($course['original_price'] , 2)
                            ?>
                        </p>
                        <!-- Liên kết tới trang chi tiết khóa học -->
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php include '../../Layouts/footer.html' ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
