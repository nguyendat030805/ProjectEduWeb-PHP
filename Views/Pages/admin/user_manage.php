<?php
require_once('../../Public/config.php'); // Database connection
require_once('../../../Controller/usercontroll.php'); // User controller
require_once('../../../Controller/coursescontroll.php'); // Course controller
require_once('../../../Controller/enrollmentcontroll.php');
// Create database connection
$conn = mysqli_connect("localhost", "root", "Hiep@1609", "l5");
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Instantiate controllers
$userController = new UserController($conn);
$courseController = new CourseController($conn);
$enrollment = new EnrollController($conn);
// Get user information (for example, using user ID from a query parameter)
$user_id = $_GET['user_id']; // Assume the user ID is passed as a query parameter
$user = $userController->getUser($user_id);

// Get courses registered by the user
$user_courses = $enrollment->getUserEnrollments($user_id); // This method should be defined in CourseModel

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin người dùng</title>
    <link rel="stylesheet" href="../style.css"> <!-- Link to external CSS -->
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            color: #333;
        }

        p {
            font-size: 16px;
            color: #555;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            background: #e2e2e2;
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            display: flex;
            align-items: center;
        }

        img {
            margin-right: 15px;
            border-radius: 5px;
        }

        strong {
            font-size: 18px;
            color: #333;
        }
        a{
            color: green;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <a href="users.php"> <h2>Trở lại</h2></a>
    <div class="container">
        <h1>Tên: <?= htmlspecialchars($user['username']) ?>!</h1>
        <p>Email: <?= htmlspecialchars($user['email']) ?></p>
        <p>Phone: <?= htmlspecialchars($user['phone']) ?></p>
        <h2>Danh sách khóa học:</h2>
        <?php if (!empty($user_courses)): ?>
            <ul>
                <?php foreach ($user_courses as $course): ?>
                    <li>
                        <img src="<?= htmlspecialchars($course['images']) ?>" alt="Hình ảnh khóa học" width="100">
                        <strong><?= htmlspecialchars($course['title']) ?></strong> (<?= htmlspecialchars($course['duration']) ?> giờ)
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Chưa tham gia khóa học nào.</p>
        <?php endif; ?>
    </div>

</body>
</html>