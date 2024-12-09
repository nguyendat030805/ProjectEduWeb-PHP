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

        .navbar .active {
            background: #388E3C; /* Màu nền cho liên kết đang hoạt động */
            font-weight: bold; /* Làm cho chữ đậm */
        }

        .main {
            flex: 1;
            padding: 20px;
        }

        .header {
            background-color: #4CAF50;
            padding: 20px;
            text-align: center;
            color: white;
        }

        .logo img {
            max-height: 150px;
        }

        .page-title {
            font-size: 24px;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <h2>Quản Trị</h2>
        <div>
            <a href="../admin/dashboard.php" class="<?php echo ($current_page == 'dashboard.php') ? 'active' : ''; ?>"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            <a href="../admin/users.php" class="<?php echo ($current_page == 'users.php') ? 'active' : ''; ?>"><i class="fas fa-users"></i> Quản Lý Người Dùng</a>
            <a href="../admin/courses.php" class="<?php echo ($current_page == 'courses.php') ? 'active' : ''; ?>"><i class="fas fa-book"></i> Quản Lý Khóa Học</a>
            <a href="../admin/reports.php" class="<?php echo ($current_page == 'reports.php') ? 'active' : ''; ?>"><i class="fas fa-chart-line"></i> Báo Cáo</a>
            <a href="../../Pages/user/home.php"><i class="fas fa-sign-out-alt"></i> Đăng Xuất</a>
        </div>
    </div>

    <div class="main">
        <div class="header">
            <div class="logo">
                <img src="/ProjectEduWeb-PHP/Public/image/logo.png" alt="Logo">
            </div>
            <div class="page-title">
                <?php
                    // Xác định trang hiện tại
                    $current_page = basename($_SERVER['PHP_SELF']);
                    switch ($current_page) {
                        case 'dashboard.php':
                            echo "Dashboard";
                            break;
                        case 'users.php':
                            echo "Quản Lý Người Dùng";
                            break;
                        case 'courses.php':
                            echo "Quản Lý Khóa Học";
                            break;
                        case 'reports.php':
                            echo "Báo Cáo";
                            break;
                        default:
                            echo "Trang Quản Trị";
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>