<?php
session_start();
require_once('../Model/loginmodel.php');  // Kết nối tới model, nơi có logic xử lý đăng nhập
class LoginController {

    public function login() {
        // Biến để lưu thông báo lỗi
        $error = '';
        // Kiểm tra nếu là POST request
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = trim($_POST['email']);
            $password =trim($_POST['password']) ;
                    // Kiểm tra các trường dữ liệu (email, password)
                if (empty($email) || empty($password)) {
                    $error = "Vui lòng điền đầy đủ thông tin.";
                } else {
                    // Kiểm tra email hợp lệ
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                        $error = "Email hoặc mật khẩu  không hợp lệ.";
                    }
        
            }  

            // Nếu không có lỗi, tiến hành đăng nhập
            if (empty($error)) {
                // Tạo đối tượng model để thực hiện việc đăng nhập
                $userModel = new Login();
                $result = $userModel->loginUser($email, $password);
                
                if ($result === true) {
                    // Nếu đăng nhập thành công, lưu thông tin người dùng vào session
                    $_SESSION['user_email'] = $email;
                    header("Location: ../Views/Pages/user/homelogin.php?rs=success");  // Điều hướng tới trang Home
                    exit();
                } else {
                    // Nếu đăng nhập thất bại, hiển thị thông báo lỗi
                    $error = $result;
                }
            }
        }

        // Nếu có lỗi, hiển thị lại form với thông báo lỗi
        include('../Views/Pages/user/login.php');
    }
}

// Kiểm tra và gọi phương thức đăng nhập
$controller = new LoginController();
$controller->login();
?>
