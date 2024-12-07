<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

require_once('../../../Model/loginmodel.php');
require_once('C:\xampp\htdocs\ProjectWeb-TD\ProjectEduWeb-PHP\Views\Public\config.php');

$model = new Login($conn);
$user_id = $_SESSION['user_id'];
$user_courses = $model->getUserCourses($user_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin người dùng</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #8BC34A, #4CAF50);
            color: #fff;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            color: #333;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 36px;
            color: #4CAF50;
            text-align: center;
        }

        p {
            font-size: 18px;
            line-height: 1.6;
        }

        .course-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 20px;
        }

        .course-card {
            background: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: calc(33.333% - 20px);
            text-align: center;
            transition: transform 0.3s;
        }

        .course-card:hover {
            transform: translateY(-10px);
        }

        .course-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .course-card-content {
            padding: 15px;
        }

        .course-card-content h3 {
            font-size: 20px;
            color: #4CAF50;
        }

        .course-card-content p {
            font-size: 16px;
            color: #666;
        }

        .header {
            background: #4CAF50;
            padding: 20px;
            text-align: center;
            color: #fff;
            font-size: 24px;
        }

        .header a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }

        .footer {
            background: #388E3C;
            padding: 10px;
            text-align: center;
            color: #fff;
            margin-top: 40px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="header">
        <a href="../../Pages/user/homelogin.php">Quản lý tài khoản</a>
    </div>

    <div class="container">
        <h1>Chào mừng, <?= htmlspecialchars($_SESSION['user_name']) ?>!</h1>
        <p><strong>Email:</strong> <?= htmlspecialchars($_SESSION['user_email']) ?></p>
        <p><strong>Số điện thoại:</strong> <?= htmlspecialchars($_SESSION['user_phone']) ?></p>

        <h2>Danh sách khóa học của bạn:</h2>
        <?php if (!empty($user_courses)): ?>
            <div class="course-list">
                <?php foreach ($user_courses as $course): ?>
                    <div class="course-card">
                        <img src="<?= htmlspecialchars($course['images']) ?>" alt="Hình ảnh khóa học">
                        <div class="course-card-content">
                            <h3><?= htmlspecialchars($course['title']) ?></h3>
                            <p>Thời lượng: <?= htmlspecialchars($course['duration']) ?> giờ</p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>Bạn chưa tham gia khóa học nào.</p>
        <?php endif; ?>
    </div>

    <?php include '../../Layouts/footer.html' ?>
</body>
</html>
