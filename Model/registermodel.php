<?php
require_once('C:\xampp\htdocs\ProjectWeb-TD\ProjectEduWeb-PHP\Views\Public\config.php');

class Register {
    
    // Hàm xử lý đăng ký người dùn
    
        // Hàm xử lý đăng ký người dùng
        public function registerUser($username, $email, $phone, $hashedPassword, $role = null) {
            global $conn; // Sử dụng kết nối cơ sở dữ liệu
            
            // Kiểm tra xem tên đăng nhập hoặc email đã tồn tại chưa
            $checkUserQuery = "SELECT * FROM Users WHERE username = ? OR email = ?";
            $stmt = $conn->prepare($checkUserQuery);
            $stmt->bind_param("ss", $username, $email);
            $stmt->execute();
            $result = $stmt->get_result();
        
            if ($result->num_rows > 0) {
                return "Tên đăng nhập hoặc email đã tồn tại.";  // Nếu đã tồn tại
            }
    
            // Kiểm tra xem có người dùng nào trong bảng chưa
            $countQuery = "SELECT COUNT(*) AS user_count FROM Users";
            $result = $conn->query($countQuery);
            $row = $result->fetch_assoc();
            $userCount = $row['user_count'];
    
            // Nếu chưa có người dùng nào, vai trò mặc định là admin
            if ($userCount == 0) {
                $role = 'admin';
            } else {
                // Nếu đã có người dùng, vai trò phải được chỉ định hoặc là 'user' mặc định
                $role = $role ?: 'user';
            }
        
            // Thực hiện câu lệnh INSERT vào bảng Users
            $sql = "INSERT INTO Users (username, email, phone, password, role) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $username, $email, $phone, $hashedPassword, $role);
        
            if ($stmt->execute()) {
                return true;  // Đăng ký thành công
            } else {
                return "Lỗi: " . $stmt->error;  // Thông báo lỗi
            }
        }
    }
?>
