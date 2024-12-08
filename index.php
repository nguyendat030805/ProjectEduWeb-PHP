<?php
require_once 'C:\xampp\htdocs\ProjectWeb-TD\ProjectEduWeb-PHP\Views\Public\config.php';
require_once '../ProjectEduWeb-PHP/Model/lessonsmodel.php';
require_once '../ProjectEduWeb-PHP/Controller/lessoncontroll.php';

// Kết nối cơ sở dữ liệu
$conn = new mysqli('localhost', 'root', 'Bang^0805', 'l5');
if ($conn->connect_error) {
    die("Kết nối cơ sở dữ liệu thất bại: " . $conn->connect_error);
}


?>