<?php
require_once('../../Public/config.php');  // Kết nối cơ sở dữ liệu
require_once('../../../Model/usermodel.php');       // Kết nối tới model người dùng
require_once('../../../Controller/usercontroll.php');
include('../admin/admin.php'); // Kết nối tới controller người dùng

$conn = mysqli_connect("localhost", "root", "", "l5");
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

$userController = new UserController($conn);

// Lấy danh sách người dùng
$users = $userController->showAllUser(); // Giả định bạn có phương thức này trong UserModel
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Người Dùng</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .header {
            background-color: #4CAF50;
            padding: 20px;
            text-align: center;
            color: white;
        }

        .header h1 {
            color: #4CAF50;
            margin: 0;
        }

        .content {
            padding: 20px;
        }

        .content p {
            font-size: 18px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
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

        button {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
            display: flex;
            align-items: center;
        }

        button:hover {
            background-color: #d32f2f;
            transform: translateY(-2px);
        }

        button:active {
            transform: translateY(0);
        }

        button i {
            margin-right: 5px;
        }

        .view-button {
            background-color: #007BFF; /* Màu xanh cho nút Xem Chi Tiết */
            margin-right: 5px; /* Khoảng cách giữa nút Xem và Xóa */
        }

        @media (max-width: 768px) {
            .content p {
                font-size: 16px;
            }

            table,
            th,
            td {
                font-size: 14px;
            }

            button {
                padding: 6px 10px;
            }
        }
    </style>
</head>

<body>
    <div class="content">
        <h1>Quản Lý Người Dùng</h1>
        <p>Danh sách người dùng:</p>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên Người Dùng</th>
                    <th>Role</th>
                    <th>Email</th>
                    <th>Mật Khẩu</th>
                    <th>Số Điện Thoại</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['user_id']); ?></td>
                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                            <td><?php echo htmlspecialchars($user['role']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td>********</td> <!-- Ẩn mật khẩu -->
                            <td><?php echo htmlspecialchars($user['phone']); ?></td>
                            <td>
                                <a href="user_manage.php?user_id=<?php echo htmlspecialchars($user['user_id']); ?>" class="button"><i class="fas fa-eye"></i> Xem Chi Tiết</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">Không có người dùng nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>

</html>