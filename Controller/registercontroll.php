<?php
// Bật thông báo lỗi để dễ dàng debug
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Gọi tệp  model đúng đường dẫn
require_once('../Model/registermodel.php');  // Đường dẫn từ Controller vào Model

class RegisterController {

    // Phương thức xử lý việc đăng ký người dùng
    public function register() {
        // Biến để lưu thông báo lỗi
        $error = '';

        // Kiểm tra nếu là POST request
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Lấy dữ liệu từ form đăng ký
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $phone = trim($_POST['phone']);
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirmPassword'];

            // Kiểm tra các trường dữ liệu (username, email, phone, password)
            if (empty($username) || empty($email) || empty($phone) || empty($password) || empty($confirmPassword)) {
                $error = "Vui lòng điền đầy đủ thông tin.";
            } else {
                // Kiểm tra email hợp lệ
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $error = "Email không hợp lệ.";
                } else {
                    // Kiểm tra mật khẩu và xác nhận mật khẩu
                    if ($password !== $confirmPassword) {
                        $error = "Mật khẩu và xác nhận mật khẩu không khớp.";
                        include('/../Views/Pages/user/register.php');
                    }
                }
            }

            // Nếu không có lỗi, tiến hành đăng ký
            if (empty($error)) {
                // Mã hóa mật khẩu
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                // Tạo đối tượng model để thực hiện việc đăng ký
                $registerModel = new Register();
                $result = $registerModel->registerUser($username, $email, $phone, $hashedPassword);

                if ($result === true) {
                    // Nếu đăng ký thành công, chuyển hướng người dùng đến trang login với thông báo
                    header("Location: ../Views/Pages/user/login.php?rs=success"); 
                    exit();
                } else {
                    // Nếu có lỗi trong quá trình đăng ký, hiển thị thông báo lỗi
                    echo "Có lỗi: ".$error = $result;
                }
            }
        }

        // Nếu có lỗi, hiển thị lại form với thông báo lỗi
        include "../Views/Pages/user/register.php";
    }
}

// Kiểm tra và gọi phương thức đăng ký
$controller = new RegisterController();
$controller->register();
?>
