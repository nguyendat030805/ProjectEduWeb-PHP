<?php
require_once('C:\xampp\htdocs\ProjectWeb-TD\ProjectEduWeb-PHP\Views\Public\config.php');
class Login {
    private $conn;

    // Constructor để khởi tạo kết nối cơ sở dữ liệu
    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    // Hàm xử lý đăng nhập
    public function loginUser($email, $password) {
        try {
            // Truy vấn thông tin người dùng từ cơ sở dữ liệu
            $query = "SELECT * FROM users WHERE email = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Lấy thông tin người dùng
                $user = $result->fetch_assoc();

                // Kiểm tra mật khẩu
                if (password_verify($password, $user['password'])) {
                    // Trả về thông tin chi tiết người dùng nếu đăng nhập thành công
                    return [
                        'user_id' => $user['user_id'],
                        'username' => $user['username'],
                        'email' => $user['email'],
                        'phone' => $user['phone']
                    ];
                } else {
                    // Sai mật khẩu
                    return "Mật khẩu không đúng.";
                }
            } else {
                // Không tìm thấy email
                return "Email không tồn tại.";
            }
        } catch (Exception $e) {
            // Xử lý lỗi nếu có
            return "Đã xảy ra lỗi trong quá trình đăng nhập: " . $e->getMessage();
        }
    }

    // Hàm lấy danh sách khóa học của người dùng (nếu cần sử dụng sau này)
    public function getUserCourses($user_id) {
        try {
            $query = "
                SELECT c.title, c.images, c.duration
                FROM courses c
                INNER JOIN enrollments e ON c.course_id = e.course_id
                WHERE e.user_id = ?
            ";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (Exception $e) {
            return "Đã xảy ra lỗi khi lấy danh sách khóa học: " . $e->getMessage();
        }
    }
}
?>
