<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Gọi tệp  model đúng đường dẫn
require_once('../Model/usermodel.php'); 
class ProfileController {

    public function showProfile() {
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (!isset($_SESSION['email']) || !isset($_SESSION['username'])) {
            // Nếu chưa đăng nhập, chuyển hướng về trang login
            header("Location: ../Views/Pages/user/login.php?error=not_logged_in");
            exit();
        }

        // Lấy thông tin từ session
        $userEmail = $_SESSION['email'];
        $userName = $_SESSION['username'];

        // Lấy thông tin người dùng từ database
        require_once('../Model/loginmodel.php');
        $userModel = new Login();

        // Gọi phương thức trong model để lấy thông tin người dùng
        $userInfo = $userModel->getUserByUsernameAndEmail($userName, $userEmail);

        // Kiểm tra xem người dùng có tồn tại trong cơ sở dữ liệu không
        if ($userInfo === null) {
            // Nếu không tìm thấy người dùng, hiển thị thông báo lỗi
            echo "Không tìm thấy người dùng với thông tin này.";
            exit();
        }

        // Nếu có thông tin người dùng, hiển thị thông tin trên trang profile
        include('../Views/Pages/user/profile.php');
    }
}

// Gọi controller để hiển thị trang profile
$controller = new ProfileController();
$controller->showProfile();
?>
