<?php
require_once('../../Public/config.php');
require_once('../../../Model/coursemodel.php');
require_once('../../../Controller/coursescontroll.php'); // Import controller
include('../admin/admin.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Khóa Học</title>
    <style>
        /* CSS styles here */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .button {
            background-color: #4CAF50; /* Màu nền của nút */
            color: white; /* Màu chữ */
            border: none; /* Không có viền */
            border-radius: 5px; /* Bo góc */
            padding: 8px 10px; /* Điều chỉnh padding */
            cursor: pointer; /* Con trỏ khi rê chuột */
            transition: background 0.3s; /* Hiệu ứng chuyển màu */
            font-size: 14px; /* Kích thước chữ nhỏ hơn */
            margin: 5px 0; /* Khoảng cách giữa các nút */
            text-decoration: none; /* Không có gạch chân */
            display: inline-block; /* Hiển thị như nút */
            max-width: 200px; /* Giới hạn chiều rộng tối đa */
            text-align: center; /* Căn giữa văn bản */
            white-space: nowrap; /* Ngăn ngừa xuống dòng */
        }

        .button:hover {
            background-color: #388E3C; /* Màu nền khi hover */
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

        /* Modal styles */
        .modal {
            display: none; /* Ẩn modal theo mặc định */
            position: fixed; /* Đặt vị trí cố định */
            z-index: 1000; /* Đảm bảo modal nổi lên trên cùng */
            left: 0;
            top: 0;
            width: 100%; /* Toàn bộ chiều rộng */
            height: 100%; /* Toàn bộ chiều cao */
            overflow: auto; /* Thêm thanh cuộn nếu cần */
            background-color: rgba(0, 0, 0, 0.5); /* Nền mờ */
        }

        .modal-content {
            background-color: #f9f9f9;
            margin: 15% auto; /* Căn giữa modal */
            padding: 20px;
            border: 1px solid #888;
            border-radius: 8px;
            width: 80%; /* Chiều rộng modal */
            max-width: 600px; /* Giới hạn chiều rộng tối đa */
        }

        /* Form styles */
        label {
            font-weight: bold; /* Làm cho nhãn đậm */
            margin-top: 10px;
            display: block; /* Đảm bảo nhãn nằm trên mỗi trường nhập */
        }

        input[type="text"],
        input[type="file"],
        textarea {
            width: 100%; /* Đảm bảo trường nhập chiếm toàn bộ chiều rộng */
            padding: 10px; /* Thêm khoảng cách bên trong */
            margin: 5px 0 15px; /* Khoảng cách giữa các trường nhập */
            border: 1px solid #ccc;
            border-radius: 4px; /* Bo góc cho trường nhập */
        }

        textarea {
            resize: vertical; /* Cho phép thay đổi kích thước theo chiều dọc */
        }

        button {
            width: 100%; /* Đường nút chiếm toàn bộ chiều rộng */
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover {
            background-color: #388E3C;
        }
    </style>
</head>

<body>
    <div class="main">
        <h2>Danh Sách Khóa Học</h2>
        <button class="button" id="addCourseBtn"><i class="fas fa-plus"></i> Thêm Khóa Học</button>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên Khóa Học</th>
                    <th>Giá</th>
                    <th>Giá đã giảm</th>
                    <th>Mô Tả</th>
                    <th>Thời Gian</th>
                    <th>Hình Ảnh</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($courses)): ?>
                    <?php foreach ($courses as $course): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($course['course_id']); ?></td>
                        <td><?php echo htmlspecialchars($course['title']); ?></td>
                        <td><?php echo htmlspecialchars($course['original_price']); ?> VND</td>
                        <td><?php echo htmlspecialchars($course['discounted_price']); ?> VND</td>
                        <td><?php echo htmlspecialchars($course['descriptions']); ?></td>
                        <td><?php echo htmlspecialchars($course['duration']); ?></td>
                        <td><img src="<?php echo htmlspecialchars($course['images']); ?>" alt="Hình Ảnh Khóa Học" width="100"></td>
                        <td>
                            <a href="?delete_id=<?php echo htmlspecialchars($course['course_id']); ?>" class="button" style="background-color: #f44336;" onclick="return confirm('Bạn có chắc chắn muốn xóa khóa học này?');"><i class="fas fa-trash-alt"></i> Xóa</a>
                            <a href="#>" class="button" style="background-color: #FF9800;" onclick="openEditModal(<?php echo htmlspecialchars($course['course_id']); ?>);"><i class="fas fa-edit"></i> Chỉnh Sửa</a>
                            <a href="detail-course.php?id=<?php echo htmlspecialchars($course['course_id']); ?>" class="button" style="background-color: blue;"><i class="fas fa-eye"></i> Xem Chi Tiết</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">Không có dữ liệu nào để hiển thị.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Modal Thêm Khóa Học -->
        <div id="courseModal" class="modal">
            <div class="modal-content">
                <span id="closeModal" style="float:right; cursor:pointer;">&times;</span>
                <h2>Thêm Khóa Học</h2>
                <form method="POST" enctype="multipart/form-data">
                    <label for="courseName">Tên Khóa Học:</label>
                    <input type="text" id="courseName" name="courseName" required>
                    
                    <label for="coursePrice">Giá:</label>
                    <input type="text" id="coursePrice" name="coursePrice" required>
                    
                    <label for="courseDescription">Mô Tả:</label>
                    <textarea id="courseDescription" name="courseDescription" required></textarea>
                    
                    <label for="courseDuration">Thời Gian:</label>
                    <input type="text" id="courseDuration" name="courseDuration" required>
                    
                    <label for="courseImage">Hình Ảnh:</label>
                    <input type="file" id="courseImage" name="courseImage" accept="image/*" required>
                    
                    <button type="submit" name="add_course" class="button">Lưu</button>
                </form>
            </div>
        </div>

        <!-- Modal Chỉnh Sửa Khóa Học -->
        <div id="editCourseModal" class="modal">
            <div class="modal-content">
                <span id="closeEditModal" style="float:right; cursor:pointer;">&times;</span>
                <h2>Chỉnh Sửa Khóa Học</h2>
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="editCourseId" name="editCourseId">
                    <label for="editCourseName">Tên Khóa Học:</label>
                    <input type="text" id="editCourseName" name="editCourseName" required>
                    
                    <label for="editCoursePrice">Giá:</label>
                    <input type="text" id="editCoursePrice" name="editCoursePrice" required>
                    
                    <label for="editCourseDescription">Mô Tả:</label>
                    <textarea id="editCourseDescription" name="editCourseDescription" required></textarea>
                    
                    <label for="editCourseDuration">Thời Gian:</label>
                    <input type="text" id="editCourseDuration" name="editCourseDuration" required>
                    
                    <label for="editCourseImage">Hình Ảnh:</label>
                    <input type="file" id="editCourseImage" name="editCourseImage" accept="image/*">
                    
                    <button type="submit" name="edit_course" class="button">Cập Nhật</button>
                </form>
            </div>
        </div>

    </div>

    <script>
        // Hiển thị modal khi nhấn nút "Thêm Khóa Học"
        document.getElementById('addCourseBtn').onclick = function() {
            document.getElementById('courseModal').style.display = 'block';
        };

        // Hiển thị modal chỉnh sửa
        function openEditModal(courseId) {
            // Fetch course data and populate the fields
            document.getElementById('editCourseId').value = courseId;
            document.getElementById('editCourseName').value = '<?php echo isset($editCourse) ? htmlspecialchars($editCourse['title']) : ''; ?>';
            document.getElementById('editCoursePrice').value = '<?php echo isset($editCourse) ? htmlspecialchars($editCourse['prices']) : ''; ?>';
            document.getElementById('editCourseDescription').value = '<?php echo isset($editCourse) ? htmlspecialchars($editCourse['descriptions']) : ''; ?>';
            document.getElementById('editCourseDuration').value = '<?php echo isset($editCourse) ? htmlspecialchars($editCourse['duration']) : ''; ?>';
            document.getElementById('editCourseModal').style.display = 'block';
        }

        // Đóng modal khi nhấn nút đóng
        document.getElementById('closeModal').onclick = function() {
            document.getElementById('courseModal').style.display = 'none';
        };

        document.getElementById('closeEditModal').onclick = function() {
            document.getElementById('editCourseModal').style.display = 'none';
        };

        // Đóng modal khi nhấn ra ngoài modal
        window.onclick = function(event) {
            var modal = document.getElementById('courseModal');
            var editModal = document.getElementById('editCourseModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
            if (event.target == editModal) {
                editModal.style.display = 'none';
            }
        };
    </script>
</body>

</html>