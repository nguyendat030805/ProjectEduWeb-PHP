<?php
require_once('..Views/Public/config.php');

class Register {
    
    // Hàm xử lý đăng ký người dùng
    public function registerUser($username, $email, $phone, $hashedPassword) {
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
    
        // Thực hiện câu lệnh INSERT vào bảng Users
        $sql = "INSERT INTO Users (username, email, phone, password) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $username, $email, $phone, $hashedPassword);
    
        if ($stmt->execute()) {
            return true;  // Đăng ký thành công
        } else {
            return "Lỗi: " . $stmt->error;  // Thông báo lỗi
        }
    }
    
    
}
?>
