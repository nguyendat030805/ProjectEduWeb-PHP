<?php
require_once('C:/xampp/htdocs/WebEducation-PHP/ProjectEduWeb-PHP/Public/config.php');
// Kết nối cơ sở dữ liệu

class login {
    private $conn;
    // Hàm đăng nhập
    public function loginUser($email, $password) {
        global $conn; // Sử dụng kết nối cơ sở dữ liệu

        // Lấy thông tin người dùng từ cơ sở dữ liệu dựa trên email
        $sql = "SELECT * FROM users WHERE email = ?";
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
    public function getUserCourses($user_id) {
        
        try {
            $query = "
                SELECT c.title, c.images, c.duration
                FROM courses c
                INNER JOIN enrollments e ON c.course_id = e.course_id
                WHERE e.user_id = ?
            ";
            $stmt = $this->conn->prepare($query);
            if ($stmt === false) {
                throw new Exception("Lỗi khi chuẩn bị câu truy vấn.");
            }
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (Exception $e) {
            // Xử lý lỗi nếu có
            return "Đã xảy ra lỗi khi lấy danh sách khóa học: " . $e->getMessage();
        }
    }
}
?>
