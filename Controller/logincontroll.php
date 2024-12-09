<?php
require_once('C:\xampp\htdocs\ProjectWeb-TD\ProjectEduWeb-PHP\Model\loginmodel.php'); // Model xử lý logic
require_once('C:\xampp\htdocs\ProjectWeb-TD\ProjectEduWeb-PHP\Views\Public\config.php'); // Kết nối cơ sở dữ liệu

class LoginController {
    private $model;

    // Constructor để khởi tạo model
    public function __construct($dbConnection) {
        $this->model = new Login($dbConnection);
    }

    public function login() {
        $error = ''; // Biến lưu thông báo lỗi

        // Kiểm tra nếu là POST request
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            // Kiểm tra dữ liệu nhập vào
            if (empty($email) || empty($password)) {
                $error = "Vui lòng điền đầy đủ thông tin.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Email không hợp lệ.";
            } else {
                // Gọi model để thực hiện đăng nhập
                $result = $this->model->loginUser($email, $password);

                if (is_array($result)) {
                    // Đăng nhập thành công: Lưu thông tin vào session
                    $_SESSION['user_id'] = $result['user_id'];
                    $_SESSION['user_name'] = $result['username'];
                    $_SESSION['user_email'] = $result['email'];
                    $_SESSION['user_phone'] = $result['phone'];


                    // Điều hướng đến trang Home
                    header("Location: ../Views/Pages/user/homelogin.php?rs=success");
                    exit();
                } else {
                    // Đăng nhập thất bại: Gán lỗi trả về
                    $error = $result;
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
