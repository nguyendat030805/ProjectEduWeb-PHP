<?php
require_once('../Public/config.php');  // Kết nối cơ sở dữ liệu

class login {

    // Hàm đăng nhập
    public function loginUser($email, $password) {
        global $conn; // Sử dụng kết nối cơ sở dữ liệu

        // Lấy thông tin người dùng từ cơ sở dữ liệu dựa trên email
        $sql = "SELECT * FROM Users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Lấy dữ liệu người dùng
            $user = $result->fetch_assoc();

            // Kiểm tra mật khẩu
            if (password_verify($password, $user['password'])) {
                // Đăng nhập thành công
                return true;
            } else {
                // Mật khẩu không đúng
                return "Mật khẩu không đúng.";
            }
        } else {
            // Không tìm thấy email trong cơ sở dữ liệu
            return "Email không tồn tại.";
        }
    }
}
?>
