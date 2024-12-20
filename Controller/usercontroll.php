<?php
require_once('C:\xampp\htdocs\ProjectWeb-TD\ProjectEduWeb-PHP\Views\Public\config.php');   // Kết nối cơ sở dữ liệu
require_once('C:\xampp\htdocs\ProjectWeb-TD\ProjectEduWeb-PHP\Model\usermodel.php');    // Kết nối tới model người dùng

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
    public function showAllUser() {
        return $this->userModel->getAllUsers();
    }
    // 3. Lấy thông tin người dùng
    public function getUser($user_id) {
        return $this->userModel->getUserById($user_id);
    }
    //Profile
    public function profile() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: ../Views/Pages/user/login.php?rs=success");// Chuyển hướng đến trang đăng nhập nếu chưa đăng nhập
            exit;
        }

        $user_id = $_SESSION['user_id'];
        $user = $this->userModel->getUserById($user_id);

        if (!$user) {
            echo "Không tìm thấy người dùng.";
            exit;
        }

        include '../views/profile.php';
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