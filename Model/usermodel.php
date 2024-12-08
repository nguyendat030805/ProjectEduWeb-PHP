<?php
require_once('C:\xampp\htdocs\ProjectWeb-TD\ProjectEduWeb-PHP\Views\Public\config.php');  // Kết nối cơ sở dữ liệu

class UserModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // 1. Đăng ký tài khoản
    public function register($username, $email, $phone, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);  // Mã hóa mật khẩu
        $sql = "INSERT INTO Users (username, email, phone, password) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $username, $email, $phone, $hashedPassword);
        return $stmt->execute();
    }

    // 2. Đăng nhập
    public function login($email, $password) {
        $sql = "SELECT * FROM Users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                return $user;  // Đăng nhập thành công, trả về thông tin người dùng
            } else {
                return false;  // Mật khẩu không chính xác
            }
        }
        return false;  // Không tìm thấy người dùng
    }
    public function getAllUsers() {
        $sql = "SELECT * FROM Users";
        $result = $this->conn->query($sql);

        $users = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }
        return $users;
    }
    // 3. Lấy thông tin người dùng
    public function getUserById($user_id) {
        $sql = "SELECT * FROM Users WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    public function getUserByUsernameAndEmail($username, $email) {
        $sql = "SELECT * FROM Users WHERE username = ? AND email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    // 4. Cập nhật thông tin người dùng (có thể dùng để thay đổi email, số điện thoại, v.v.)
    public function updateUser($user_id, $username, $email, $phone) {
        $sql = "UPDATE Users SET username = ?, email = ?, phone = ? WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssi", $username, $email, $phone, $user_id);
        return $stmt->execute();
    }
}
?>
