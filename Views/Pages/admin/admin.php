<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Quản Trị</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            background-color: #4CAF50;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h2 {
            margin: 0;
            color: white;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            padding: 10px;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .navbar a:hover {
            background: #388E3C;
        }

        .main {
            flex: 1;
            padding: 20px;
        }

        .header {
            background-image: url('C:\xampp\htdocs\ProjectEduWeb-PHP\Public\image\header-background.jpg'); /* Đặt đường dẫn trong url() */
            padding: 20px;
            text-align: center;
            color: white;
        }

        .logo img {
            max-height: 150px;
        }

    </style>
</head>

<body>
    <div class="navbar">
        <h2>Quản Trị</h2>
        <div>
            <a href="#"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            <a href="#"><i class="fas fa-users"></i> Quản Lý Người Dùng</a>
            <a href="#"><i class="fas fa-book"></i> Quản Lý Khóa Học</a>
            <a href="#"><i class="fas fa-chart-line"></i> Báo Cáo</a>
            <a href="#"><i class="fas fa-sign-out-alt"></i> Đăng Xuất</a>
        </div>
    </div>

    <div class="main">
        <div class="header">
            <div class="logo">
                <img src="/ProjectEduWeb-PHP/Public/image/logo.png" alt="Logo">
            </div>
        </div>
        <?php
            include 'reports.php'
        ?>
    </div>
</body>
</html>