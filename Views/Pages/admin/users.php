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
            background-color: #727070;
            padding: 20px;
            text-align: center;
            color: white;
        }

        .header h1 {
            color: #4CAF50;
            margin: 0;
        }

        img {
            width: 100px;
            height: auto;
            margin-top: 10px;
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
            /* Màu đỏ cho nút Xóa */
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
            /* Khoảng cách giữa icon và text */
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
            <th>Email</th>
            <th>Mật Khẩu</th>
            <th>Số Điện Thoại</th>
            <th>Hành Động</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>Nguyễn Văn A</td>
            <td>a@example.com</td>
            <td>********</td> <!-- Ẩn mật khẩu -->
            <td>0123456789</td>
            <td>
                <button class="delete-button"><i class="fas fa-trash-alt"></i>Xóa</button>
            </td>
        </tr>
        <tr>
            <td>2</td>
            <td>Trần Thị B</td>
            <td>b@example.com</td>
            <td>********</td> <!-- Ẩn mật khẩu -->
            <td>0987654321</td>
            <td>
                <button class="delete-button"><i class="fas fa-trash-alt"></i>Xóa</button>
            </td>
        </tr>
    </tbody>
</table>
    </div>
</body>

</html>