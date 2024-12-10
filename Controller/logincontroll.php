<?php
require_once('C:\xampp\htdocs\ProjectWeb-TD\ProjectEduWeb-PHP\Model\loginmodel.php'); // Model xử lý logic
require_once('C:\xampp\htdocs\ProjectWeb-TD\ProjectEduWeb-PHP\Views\Public\config.php'); // Kết nối cơ sở dữ liệu

session_start();

class LoginController {
    private $model;

    // Constructor để khởi tạo model
    public function __construct($dbConnection) {
        $this->model = new Login($dbConnection);
    }

    public function login() {
        $error = ''; // Biến lưu thông báo lỗi

        // Xử lý nếu là POST request
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Lấy dữ liệu từ form
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            // Kiểm tra dữ liệu nhập vào
            if (empty($email) || empty($password)) {
                $error = "Vui lòng điền đầy đủ thông tin.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Email không hợp lệ.";
            } else {
                // Gọi model để thực hiện đăng nhập
                $result = $this->model->loginUser($email, $password);

                if (is_array($result)) {
                    // Kiểm tra vai trò của người dùng
                    $userRole = $result['role']; // role có thể là 'admin' hoặc 'user'

                    // Đăng nhập thành công: Lưu thông tin vào session
                    $_SESSION['user_id'] = $result['user_id'];
                    $_SESSION['user_name'] = $result['username'];
                    $_SESSION['user_email'] = $result['email'];
                    $_SESSION['user_phone'] = $result['phone'];
                    $_SESSION['user_role'] = $userRole;

                    // Điều hướng dựa trên vai trò
                    if ($userRole === 'Admin') {
                        header("Location: ../Views/Pages/admin/users.php?rs=success");
                    } else {
                        header("Location: ../Views/Pages/user/homelogin.php?rs=success");
                    }
                    exit(); // Dừng thực thi sau khi điều hướng
                } else {
                    // Đăng nhập thất bại
                    $error = $result; // Đảm bảo $result chứa thông báo lỗi
                }
            }
        }

        // Nếu có lỗi, hiển thị lại form đăng nhập với thông báo lỗi
        include('C:\xampp\htdocs\ProjectWeb-TD\ProjectEduWeb-PHP\Views\Pages\user\login.php');
    }
}

// Khởi tạo controller và gọi phương thức đăng nhập
global $conn; // Lấy kết nối từ config
$controller = new LoginController($conn);
$controller->login();
?>