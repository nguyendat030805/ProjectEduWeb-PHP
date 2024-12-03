<?php
require_once('../../Public/config.php');
require_once('../../../Model/coursemodel.php');
require_once('../../../Controller/coursescontroll.php'); // Nhúng controller
include('../admin/admin.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bảng điều khiển</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        .header {
            background-color: #4CAF50;
            padding: 20px;
            text-align: center;
            color: white;
        }

        .container {
            display: flex;
            flex-direction: column;
            padding: 20px;
        }

        .main-content {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .card {
            background: white;
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .card h2 {
            margin: 0 0 10px 0;
            display: flex;
            align-items: center;
        }

        .card i {
            font-size: 28px;
            margin-right: 10px;
            color: #4CAF50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .navbar a {
                margin: 10px 0;
            }

            .card {
                width: 100%;  /* Chiếm toàn bộ chiều rộng trên di động */
            }
        }

        @media (max-width: 480px) {
            .card {
                width: 100%;  /* Chiếm toàn bộ chiều rộng trên di động */
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Bảng điều khiển</h1>
    </div>
    <div class="container">
        <div class="main-content">
            <div class="card">
                <h2><i class="fas fa-users"></i> Danh Sách Người Dùng</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên Người Dùng</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Nguyễn Văn A</td>
                            <td>a@example.com</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Trần Thị B</td>
                            <td>b@example.com</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Hoàng Văn C</td>
                            <td>c@example.com</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>