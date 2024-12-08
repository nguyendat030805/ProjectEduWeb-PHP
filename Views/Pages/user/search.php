<?php
require_once('C:\xampp\htdocs\ProjectWeb-TD\ProjectEduWeb-PHP\Views\Public\config.php');

// Lấy từ khóa tìm kiếm từ URL
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Sử dụng prepared statements để tránh SQL Injection
$sql = "SELECT * FROM courses WHERE title LIKE ?";
$stmt = $conn->prepare($sql);
$searchTermParam = "%$searchTerm%";
$stmt->bind_param("s", $searchTermParam);
$stmt->execute();
$coursesResult = $stmt->get_result();

$sqlLessons = "SELECT * FROM lessons WHERE title LIKE ?";
$stmtLessons = $conn->prepare($sqlLessons);
$stmtLessons->bind_param("s", $searchTermParam);
$stmtLessons->execute();
$lessonsResult = $stmtLessons->get_result();

// Lấy kết quả từ database
$courses = mysqli_fetch_all($coursesResult, MYSQLI_ASSOC);
$lessons = mysqli_fetch_all($lessonsResult, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <!-- Thêm link tới Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJ6Hbk6J4t5tHupR3RYYR6jO03l72vT3DDffX6RmFS6aRPrzRb5QOXAf+I7D" crossorigin="anonymous">
    <style>
        /* Thêm style cho các card */
        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px); 
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .price {
            font-weight: bold;
            font-size: 18px;
        }

        .price-free {
            color: #28a745; /* Màu xanh lá cho khóa học miễn phí */
        }

        .price-discount {
            color: #dc3545; /* Màu đỏ cho giá đã giảm */
            text-decoration: line-through;
        }

        .confirm {
            text-align: center;
            color: #6c757d;
            font-size: 1.25rem;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: bold;
            color: #333;
        }

        /* Căn chỉnh các thẻ card trong một hàng */
        .row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .cart_search {
            width: 100%;
        }

        /* Đảm bảo hình ảnh có tỷ lệ phù hợp */
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <?php include '../../Layouts/headerLogin.html' ?>

    <div class="container mt-4">
        <h3 class="text-center mb-4">Kết quả tìm kiếm</h3>

        <!-- Hiển thị kết quả khóa học -->
        <h4 class="mb-3">Khóa học:</h4>
        <div class="row">
            <?php if (mysqli_num_rows($coursesResult) > 0): ?>
                <?php foreach ($courses as $index => $course): ?>
                    <div class="col-md-3 col-sm-6 col-12 mb-4"> <!-- Mỗi card chiếm 3 cột trên màn hình lớn (md), 6 cột trên màn hình nhỏ (sm), 12 cột trên màn hình rất nhỏ (xs) -->
                        <div class="card h-100">
                            <a href="detail.php?id=<?php echo htmlspecialchars($course['course_id']); ?>">
                                <img src="<?= htmlspecialchars($course['images']) ?>" 
                                    class="card-img-top" 
                                    alt="<?= htmlspecialchars($course['title']) ?>">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($course['title']); ?></h5>
                                <p class="price fw-bold <?= $course['types'] === 'Free' ? 'text-success' : 'text-danger' ?>">
                                <?= $course['types'] === 'Free' 
                                    ? 'Free' 
                                    :"$" . number_format($course['original_price'], 2) 
                                ?>
                            </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <h3 class="confirm">Không có khóa học nào phù hợp với tìm kiếm của bạn.</h3>
            <?php endif; ?>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-Ol5vJLrA5kK6+/bLgG7rl9LM1eYZrZgcf6yBzjt7fn60Q4yRvjlI9jYjYpvqdOJd" crossorigin="anonymous"></script>
</body>
</html>
