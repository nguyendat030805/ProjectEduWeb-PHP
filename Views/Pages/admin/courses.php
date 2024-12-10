<?php
require_once('../../Public/config.php');
require_once('../../../Model/coursemodel.php');
require_once('../../../Controller/coursescontroll.php');
include('../admin/admin.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Khóa Học</title>
    <style>
        /* Các kiểu CSS ở đây */
        body {
            font-family: Arial, sans-serif;
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
            padding: 8px 10px;
            cursor: pointer;
            transition: background 0.3s;
            font-size: 14px;
            margin: 5px 0;
            text-decoration: none;
            display: inline-block;
            max-width: 200px;
            text-align: center;
            white-space: nowrap;
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

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #f9f9f9;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            border-radius: 8px;
            width: 80%;
            max-width: 600px;
        }

        label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: 100%;
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
        <h1>Quản lý Khóa Học</h1>
        <button class="button" id="addCourseBtn"><i class="fas fa-plus"></i> Thêm Khóa Học</button>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên Khóa Học</th>
                    <th>Giá</th>
                    <th>Mô Tả</th>
                    <th>Types</th>
                    <th>Hình Ảnh</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($courses)): ?>
                    <?php foreach ($courses as $course): ?>
                    <tr data-id="<?php echo htmlspecialchars($course['course_id']); ?>">
                        <td><?php echo htmlspecialchars($course['course_id']); ?></td>
                        <td><?php echo htmlspecialchars($course['title']); ?></td>
                        <td><?php echo htmlspecialchars($course['original_price']); ?> VND</td>
                        <td><?php echo htmlspecialchars($course['descriptions']); ?></td>
                        <td><?php echo htmlspecialchars($course['types']); ?></td>
                        <td><img src="<?php echo htmlspecialchars($course['images']); ?>" alt="Hình Ảnh Khóa Học" width="100"></td>
                        <td>
                            <a href="?delete_id=<?php echo htmlspecialchars($course['course_id']); ?>" class="button" style="background-color: #f44336;" onclick="return confirm('Bạn có chắc chắn muốn xóa khóa học này?');"><i class="fas fa-trash-alt"></i> Xóa</a>
                            <a href="#!" class="button" style="background-color: #FF9800;" onclick="openEditModal(<?php echo htmlspecialchars($course['course_id']); ?>);"><i class="fas fa-edit"></i> Chỉnh Sửa</a>
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
            <form method="POST">
                <label for="courseName">Tên Khóa Học:</label>
                <input type="text" id="courseName" name="courseName" required>
                
                <label for="coursePrice">Giá:</label>
                <input type="text" id="coursePrice" name="coursePrice" required>
                
                <label for="courseDescription">Mô Tả:</label>
                <textarea id="courseDescription" name="courseDescription" required></textarea>
                
                <label for="courseURL">Video:</label>
                <input type="text" id="courseURL" name="courseURL" required>
                
                <label for="courseImage">URL Hình Ảnh:</label>
                <input type="text" id="courseImage" name="courseImage" required>
                
                <label for="courseType">Loại Khóa Học:</label>
                <select id="courseType" name="courseType" required>
                    <option value="Pro">Pro</option>
                    <option value="Free">Free</option>
                </select>
                
                <button type="submit" name="add_course" class="button">Lưu</button>
            </form>
            </div>
        </div>

        <!-- Modal Chỉnh Sửa Khóa Học -->
        <div id="editCourseModal" class="modal">
            <div class="modal-content">
                <span id="closeEditModal" style="float:right; cursor:pointer;">&times;</span>
                <h2>Chỉnh Sửa Khóa Học</h2>
                <form method="POST">
                    <input type="hidden" id="editCourseId" name="editCourseId">
                    <label for="editCourseName">Tên Khóa Học:</label>
                    <input type="text" id="editCourseName" name="editCourseName" required>
                    
                    <label for="editCoursePrice">Giá:</label>
                    <input type="text" id="editCoursePrice" name="editCoursePrice" required>

                    <label for="editCourseDescription">Mô Tả:</label>
                    <textarea id="editCourseDescription" name="editCourseDescription" required></textarea>
                    
                    <label for="editCourseURL">Video:</label>
                    <input type="text" id="editCourseURL" name="editCourseURL" required>
                    
                    <label for="editCourseImage">URL Hình Ảnh:</label>
                    <input type="text" id="editCourseImage" name="editCourseImage">
                    <select id="courseType" name="courseType" required>
                        <option value="pro">Pro</option>
                        <option value="free">Free</option>
                    </select>
                    
                    <button type="submit" name="edit_course" class="button">Cập Nhật</button>
                </form>
            </div>
        </div>

    </div>

    <script>
        document.getElementById('addCourseBtn').onclick = function() {
            document.getElementById('courseModal').style.display = 'block';
        };

        function openEditModal(courseId) {
            // Tìm dòng tương ứng với courseId
            var courseRow = document.querySelector(`tr[data-id="${courseId}"]`);
            if (!courseRow) {
                alert('Không tìm thấy khóa học!');
                return;
            }

            // Điền thông tin vào modal chỉnh sửa
            document.getElementById('editCourseId').value = courseId;
            document.getElementById('editCourseName').value = courseRow.querySelector('td:nth-child(2)').innerText;
            document.getElementById('editCoursePrice').value = courseRow.querySelector('td:nth-child(3)').innerText.replace(' VND', '').trim();
            document.getElementById('editCourseDescription').value = courseRow.querySelector('td:nth-child(4)').innerText;
            document.getElementById('editCourseImage').value = courseRow.querySelector('td:nth-child(6) img').src;

            // Hiển thị modal chỉnh sửa
            document.getElementById('editCourseModal').style.display = 'block';
        }


        document.getElementById('closeModal').onclick = function() {
            document.getElementById('courseModal').style.display = 'none';
        };

        document.getElementById('closeEditModal').onclick = function() {
            document.getElementById('editCourseModal').style.display = 'none';
        };

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