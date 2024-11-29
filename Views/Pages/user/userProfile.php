<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

require_once('../../../Model/loginmodel.php');
require_once('../../../Public/config.php');

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
</head>
<body>
    <?php
        include '../../Layouts/headerLogin.html'
    ?>
    <h1>Chào mừng, <?= htmlspecialchars($_SESSION['user_name']) ?>!</h1>
    <p>Email: <?= htmlspecialchars($_SESSION['user_email']) ?></p>
    <p>Phone: <?= htmlspecialchars($_SESSION['user_phone']) ?></p>
    <h2>Danh sách khóa học của bạn:</h2>
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
        <p>Bạn chưa tham gia khóa học nào.</p>
    <?php endif; ?>
</body>
</html>
