<?php
require_once('../Views/Public/config.php');  // Kết nối cơ sở dữ liệu
require_once('../Models/user.php');    // Kết nối tới model người dùng

class UserController {
    private $userModel;

    public function __construct($conn) {
        $this->userModel = new UserModel($conn);
    }

    // 1. Đăng ký tài khoản
    public function registerUser($username, $email, $phone, $password) {
        if ($this->userModel->register($username, $email, $phone, $password)) {
            return "Đăng ký thành công!";
        } else {
            return "Đăng ký thất bại!";
        }
    }

    // 2. Đăng nhập
    public function loginUser($email, $password) {
        $user = $this->userModel->login($email, $password);
        if ($user) {
            // Có thể lưu thông tin người dùng vào session
            $_SESSION['user'] = $user;
            return "Đăng nhập thành công!";
        } else {
            return "Email hoặc mật khẩu không chính xác!";
        }
    }

    // 3. Lấy thông tin người dùng
    public function getUser($user_id) {
        return $this->userModel->getUserById($user_id);
    }

    // 4. Cập nhật thông tin người dùng
    public function updateUser($user_id, $username, $email, $phone) {
        if ($this->userModel->updateUser($user_id, $username, $email, $phone)) {
            return "Cập nhật thông tin thành công!";
        } else {
            return "Cập nhật thông tin thất bại!";
        }
    }
}

// Ví dụ sử dụng UserController
session_start();  // Bắt đầu phiên làm việc

$conn = mysqli_connect("localhost", "root", "Hiep@1609", "l5");
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

$userController = new UserController($conn);

// Kiểm tra hành động từ form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['register'])) {
        // Đăng ký người dùng
        $response = $userController->registerUser($_POST['username'], $_POST['email'], $_POST['phone'], $_POST['password']);
        echo $response;
    } elseif (isset($_POST['login'])) {
        // Đăng nhập người dùng
        $response = $userController->loginUser($_POST['email'], $_POST['password']);
        echo $response;
    } elseif (isset($_POST['update'])) {
        // Cập nhật thông tin người dùng
        $response = $userController->updateUser($_SESSION['user']['user_id'], $_POST['username'], $_POST['email'], $_POST['phone']);
        echo $response;
    }
}
?>