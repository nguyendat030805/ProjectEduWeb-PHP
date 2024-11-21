<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Khóa Học</title>
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

        .button {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .button:hover {
            background-color: #388E3C;
        }

        /* Modal Styles */
        .modal {
            display: none;
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

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"], input[type="url"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            width: 100%;
        }

        /* Video Player Styles */
        .video-modal-content {
            position: relative;
            padding-top: 56.25%; /* 16:9 Aspect Ratio */
        }

        .video-modal-content iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }
    </style>
</head>

<body>
    <h2>Chi Tiết Khóa Học: Khóa Học PHP Cơ Bản</h2>
    <button class="button" id="addVideoBtn"><i class="fas fa-plus"></i> Thêm Video</button>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên Video</th>
                <th>URL Video</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody id="videoList">
            <tr>
                <td>1</td>
                <td>Giới Thiệu Khóa Học</td>
                <td><a href="#" onclick="openVideoModal('https://www.example.com/video1')">Xem Video</a></td>
                <td>
                    <button class="edit-button" onclick="openEditModal(1, 'Giới Thiệu Khóa Học', 'https://www.example.com/video1')"><i class="fas fa-edit"></i> Chỉnh Sửa</button>
                    <button class="delete-button" onclick="deleteVideo(this)"><i class="fas fa-trash-alt"></i> Xóa</button>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>Biến Và Kiểu Dữ Liệu</td>
                <td><a href="#" onclick="openVideoModal('https://www.example.com/video2')">Xem Video</a></td>
                <td>
                    <button class="edit-button" onclick="openEditModal(2, 'Biến Và Kiểu Dữ Liệu', 'https://www.example.com/video2')"><i class="fas fa-edit"></i> Chỉnh Sửa</button>
                    <button class="delete-button" onclick="deleteVideo(this)"><i class="fas fa-trash-alt"></i> Xóa</button>
                </td>
            </tr>
        </tbody>
    </table>

    <!-- Modal Thêm Video -->
    <div id="videoModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <h2>Thêm Video Mới</h2>
            <form id="videoForm">
                <label for="videoName">Tên Video:</label>
                <input type="text" id="videoName" required>
                <label for="videoUrl">URL Video:</label>
                <input type="url" id="videoUrl" required>
                <button type="submit" class="button">Lưu</button>
            </form>
        </div>
    </div>

    <!-- Modal Chỉnh Sửa Video -->
    <div id="editVideoModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeEditModal">&times;</span>
            <h2>Chỉnh Sửa Video</h2>
            <form id="editVideoForm">
                <label for="editVideoName">Tên Video:</label>
                <input type="text" id="editVideoName" required>
                <label for="editVideoUrl">URL Video:</label>
                <input type="url" id="editVideoUrl" required>
                <button type="submit" class="button">Cập Nhật</button>
            </form>
        </div>
    </div>

    <!-- Modal Phát Video -->
    <div id="videoPlayerModal" class="modal">
        <div class="modal-content video-modal-content">
            <span class="close" id="closeVideoModal">&times;</span>
            <h2>Xem Video</h2>
            <iframe id="videoPlayer" src="" allowfullscreen></iframe>
        </div>
    </div>

    <script>
        const modal = document.getElementById("videoModal");
        const editModal = document.getElementById("editVideoModal");
        const videoPlayerModal = document.getElementById("videoPlayerModal");
        const btn = document.getElementById("addVideoBtn");
        const span = document.getElementById("closeModal");
        const editSpan = document.getElementById("closeEditModal");
        const videoSpan = document.getElementById("closeVideoModal");
        const form = document.getElementById("videoForm");
        const editForm = document.getElementById("editVideoForm");
        const videoList = document.getElementById("videoList");
        const videoPlayer = document.getElementById("videoPlayer");
        let currentEditRow;

        // Mở modal khi nhấn nút "Thêm Video"
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // Đóng modal khi nhấn nút x
        span.onclick = function() {
            modal.style.display = "none";
        }

        // Đóng modal chỉnh sửa khi nhấn nút x
        editSpan.onclick = function() {
            editModal.style.display = "none";
        }

        // Đóng modal phát video khi nhấn nút x
        videoSpan.onclick = function() {
            videoPlayerModal.style.display = "none";
            videoPlayer.src = ""; // Xóa nguồn video để dừng phát
        }

        // Đóng modal khi nhấp ra ngoài modal
        window.onclick = function(event) {
            if (event.target === modal) {
                modal.style.display = "none";
            } else if (event.target === editModal) {
                editModal.style.display = "none";
            } else if (event.target === videoPlayerModal) {
                videoPlayerModal.style.display = "none";
                videoPlayer.src = ""; // Xóa nguồn video để dừng phát
            }
        }

        // Xử lý sự kiện gửi form thêm video
        form.onsubmit = function(event) {
            event.preventDefault(); // Ngăn chặn gửi form thực tế
            const videoName = document.getElementById("videoName").value;
            const videoUrl = document.getElementById("videoUrl").value;

            // Tạo hàng mới cho video
            const newRow = document.createElement("tr");
            newRow.innerHTML = `
                <td>${videoList.children.length + 1}</td>
                <td>${videoName}</td>
                <td><a href="#" onclick="openVideoModal('${videoUrl}')">Xem Video</a></td>
                <td>
                    <button class="edit-button" onclick="openEditModal(${videoList.children.length + 1}, '${videoName}', '${videoUrl}')"><i class="fas fa-edit"></i> Chỉnh Sửa</button>
                    <button class="delete-button" onclick="deleteVideo(this)"><i class="fas fa-trash-alt"></i> Xóa</button>
                </td>
            `;
            videoList.appendChild(newRow);

            // Đóng modal
            modal.style.display = "none";

            // Xóa nội dung của form
            form.reset();
        }

        // Hàm mở modal chỉnh sửa video
        function openEditModal(id, name, url) {
            currentEditRow = id; // Lưu ID hàng hiện tại
            document.getElementById("editVideoName").value = name;
            document.getElementById("editVideoUrl").value = url;
            editModal.style.display = "block";
        }

        // Xử lý sự kiện gửi form chỉnh sửa video
        editForm.onsubmit = function(event) {
            event.preventDefault(); // Ngăn chặn gửi form thực tế

            const videoName = document.getElementById("editVideoName").value;
            const videoUrl = document.getElementById("editVideoUrl").value;

            // Cập nhật hàng video
            const row = videoList.children[currentEditRow - 1]; // Tìm hàng dựa vào ID
            row.cells[1].textContent = videoName;
            row.cells[2].innerHTML = `<a href="#" onclick="openVideoModal('${videoUrl}')">Xem Video</a>`;

            // Đóng modal
            editModal.style.display = "none";
        }

        // Hàm mở modal phát video
        function openVideoModal(url) {
            videoPlayer.src = url; // Đặt nguồn video
            videoPlayerModal.style.display = "block";
        }

        // Hàm xóa video
        function deleteVideo(button) {
            const row = button.parentElement.parentElement;
            row.parentElement.removeChild(row);
        }
    </script>
</body>

</html>