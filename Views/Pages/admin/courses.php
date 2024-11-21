<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Khóa Học</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .content {
            margin-top: 20px;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .button {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
            transition: background 0.3s;
            font-size: 16px;
            margin: 5px 0;
            text-decoration: none; /* Xóa gạch chân cho thẻ a */
            display: inline-block; /* Để có padding và margin */
        }

        .button:hover {
            background-color: #388E3C;
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

        /* Modal Styles */
        .modal {
            display: none; /* Ẩn modal ban đầu */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* Styles cho form */
        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        textarea {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            width: 100%;
        }

        textarea {
            resize: vertical; /* Cho phép thay đổi kích thước chiều dọc */
            min-height: 100px; /* Chiều cao tối thiểu cho textarea */
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .navbar a {
                margin: 10px 0;
            }

            .main {
                padding: 10px;
            }

            .button {
                width: 100%; /* Nút chiếm toàn bộ chiều rộng */
            }
        }

        @media (max-width: 480px) {
            .button {
                width: 100%; /* Nút chiếm toàn bộ chiều rộng */
            }
        }
    </style>
</head>

<body>
    <div class="main">
        <div class="content">
            <h2>Danh Sách Khóa Học</h2>
            <button class="button" id="addCourseBtn"><i class="fas fa-plus"></i> Thêm Khóa Học</button>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên Khóa Học</th>
                        <th>Giá</th>
                        <th>Mô Tả</th>
                        <th>Thời Gian</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Khóa Học PHP Cơ Bản</td>
                        <td>1.000.000 VND</td>
                        <td>Học PHP từ căn bản đến nâng cao.</td>
                        <td>30 Giờ</td>
                        <td>
                            <button class="button" style="background-color: #2196F3;"><i class="fas fa-edit"></i> Sửa</button>
                            <button class="button" style="background-color: #f44336;"><i class="fas fa-trash-alt"></i> Xóa</button>
                            <a class="button" href="detail-course.php"><i class="fas fa-eye"></i> Xem Chi Tiết</a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Khóa Học JavaScript Nâng Cao</td>
                        <td>1.500.000 VND</td>
                        <td>Nâng cao kỹ năng JavaScript cho lập trình viên.</td>
                        <td>40 Giờ</td>
                        <td>
                            <button class="button" style="background-color: #2196F3;"><i class="fas fa-edit"></i> Sửa</button>
                            <button class="button" style="background-color: #f44336;"><i class="fas fa-trash-alt"></i> Xóa</button>
                            <a class="button" href="detail-course.php"><i class="fas fa-eye"></i> Xem Chi Tiết</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Thêm Khóa Học -->
    <div id="courseModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <h2>Thêm Khóa Học</h2>
            <form id="courseForm">
                <label for="courseName">Tên Khóa Học:</label>
                <input type="text" id="courseName" required>
                <label for="coursePrice">Giá:</label>
                <input type="text" id="coursePrice" required>
                <label for="courseDescription">Mô Tả:</label>
                <textarea id="courseDescription" required></textarea>
                <label for="courseDuration">Thời Gian:</label>
                <input type="text" id="courseDuration" required>
                <button type="submit" class="button">Lưu</button>
            </form>
        </div>
    </div>

    <script>
        // Lấy các phần tử cần thiết
        const modal = document.getElementById("courseModal");
        const btn = document.getElementById("addCourseBtn");
        const span = document.getElementById("closeModal");
        const form = document.getElementById("courseForm");

        // Khi nhấn nút "Thêm Khóa Học", mở modal
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // Khi nhấn nút đóng (x), đóng modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // Khi người dùng nhấp ra ngoài modal, đóng modal
        window.onclick = function(event) {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        }

        // Xử lý sự kiện gửi form
        form.onsubmit = function(event) {
            event.preventDefault(); // Ngăn chặn gửi form thực tế
            // Lấy dữ liệu từ form
            const courseName = document.getElementById("courseName").value;
            const coursePrice = document.getElementById("coursePrice").value;
            const courseDescription = document.getElementById("courseDescription").value;
            const courseDuration = document.getElementById("courseDuration").value;

            // Thêm khóa học mới vào bảng hoặc thực hiện các hành động khác

            // Đóng modal
            modal.style.display = "none";
            // Có thể thêm mã để cập nhật bảng ở đây
            console.log("Khóa học mới:", { courseName, coursePrice, courseDescription, courseDuration });
        }
    </script>
</body>

</html>