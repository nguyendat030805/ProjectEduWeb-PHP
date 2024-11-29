<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Cá Nhân</title>
</head>
<body>
    <h1>Thông Tin Cá Nhân</h1>

    <?php if (isset($userInfo)): ?>
        <p><strong>Họ và Tên:</strong> <?php echo htmlspecialchars($userInfo['name']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($userInfo['email']); ?></p>
        <p><strong>Số điện thoại:</strong> <?php echo htmlspecialchars($userInfo['phone'] ?? 'Không có thông tin'); ?></p>
    <?php else: ?>
        <p>Không thể lấy thông tin người dùng.</p>
    <?php endif; ?>

    <h2>Khóa Học Đã Đăng Ký</h2>
    <?php if (!empty($courses)): ?>
        <ul>
            <?php foreach ($courses as $course): ?>
                <li>
                    <img src="<?php echo htmlspecialchars($course['images']); ?>" alt="Course Image" width="100">
                    <strong><?php echo htmlspecialchars($course['title']); ?></strong>
                    <span>Thời lượng: <?php echo htmlspecialchars($course['duration']); ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Bạn chưa đăng ký khóa học nào.</p>
    <?php endif; ?>

    <a href="../Controllers/LogoutController.php">Đăng Xuất</a>
</body>
</html>
