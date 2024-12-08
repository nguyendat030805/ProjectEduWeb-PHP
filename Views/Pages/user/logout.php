<?php
// Bắt đầu session
session_start();

// Hủy tất cả các biến session
session_unset();

// Hủy session
session_destroy();

// Chuyển hướng về trang đăng nhập hoặc trang chủ
header("Location: login.php?rs=success"); 
exit;
?>
