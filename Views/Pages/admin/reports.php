<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Báo Cáo Từ Người Dùng</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }

        h2 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
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
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .delete-button {
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 8px 12px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .delete-button:hover {
            background-color: #d32f2f;
        }
    </style>
</head>

<body>
    <h2>Báo Cáo Từ Người Dùng</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên Người Dùng</th>
                <th>Email</th>
                <th>Nội Dung Báo Cáo</th>
                <th>Ngày Gửi</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Nguyễn Văn A</td>
                <td>a@example.com</td>
                <td>Báo cáo về lỗi hệ thống.</td>
                <td>2024-01-15</td>
                <td>
                    <button class="delete-button"><i class="fas fa-trash-alt"></i> Xóa</button>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>Trần Thị B</td>
                <td>b@example.com</td>
                <td>Đề xuất tính năng mới.</td>
                <td>2024-01-16</td>
                <td>
                    <button class="delete-button"><i class="fas fa-trash-alt"></i> Xóa</button>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>