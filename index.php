<?php
include 'Public/config.php';
include 'Controller/usercontroll.php';

$userController = new UserController($conn);
$userController->profile(); // Gọi phương thức profile để hiển thị thông tin người dùng
?>