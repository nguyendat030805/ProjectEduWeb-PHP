<?php
require_once('C:\xampp\htdocs\php-project\ProjectEduWeb-PHP\Views\Public\config.php');  // Kết nối cơ sở dữ liệu

class EnrollmentModel {
    private $conn;

    // Constructor: Nhận kết nối cơ sở dữ liệu
    public function __construct($conn) {
        $this->conn = $conn;
    }

    // 1. Lấy tất cả đăng ký của một người dùng
    public function getEnrollmentsByUser($user_id) {
        $sql = "SELECT * FROM Enrollments WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            // Xử lý lỗi nếu không thể chuẩn bị câu truy vấn
            die("Error preparing query: " . $this->conn->error);
        }

        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result === false) {
            // Xử lý lỗi khi thực thi câu truy vấn
            die("Error executing query: " . $this->conn->error);
        }

        $enrollments = [];
        while ($row = $result->fetch_assoc()) {
            $enrollments[] = $row;
        }
        return $enrollments;
    }

    // 2. Lấy tất cả người dùng đã đăng ký khóa học
    public function getUsersByCourse($course_id) {
        $sql = "SELECT * FROM Enrollments WHERE course_id = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            // Xử lý lỗi nếu không thể chuẩn bị câu truy vấn
            die("Error preparing query: " . $this->conn->error);
        }

        $stmt->bind_param("i", $course_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result === false) {
            // Xử lý lỗi khi thực thi câu truy vấn
            die("Error executing query: " . $this->conn->error);
        }

        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        return $users;
    }

    // 3. Đăng ký một khóa học
    public function enrollInCourse($user_id, $course_id) {
        // Kiểm tra nếu người dùng đã đăng ký khóa học này
        $sql = "SELECT * FROM Enrollments WHERE user_id = ? AND course_id = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            die("Error preparing query: " . $this->conn->error);
        }

        $stmt->bind_param("ii", $user_id, $course_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Nếu đã có bản ghi, không cho phép đăng ký lại
        if ($result->num_rows > 0) {
            return false;  // Người dùng đã đăng ký khóa học này rồi
        }

        // Nếu chưa có bản ghi, thực hiện đăng ký
        $sql = "INSERT INTO Enrollments (user_id, course_id, status) VALUES (?, ?, 'studying')";
        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            die("Error preparing query: " . $this->conn->error);
        }

        $stmt->bind_param("ii", $user_id, $course_id);
        return $stmt->execute();
    }

    // 4. Cập nhật trạng thái đăng ký (đang học hoặc đã học)
    public function updateEnrollmentStatus($enrollment_id, $status) {
        $sql = "UPDATE Enrollments SET status = ? WHERE enrollment_id = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            die("Error preparing query: " . $this->conn->error);
        }

        $stmt->bind_param("si", $status, $enrollment_id);
        return $stmt->execute();
    }

    // 5. Hủy đăng ký khóa học
    public function cancelEnrollment($enrollment_id) {
        $sql = "DELETE FROM Enrollments WHERE enrollment_id = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            die("Error preparing query: " . $this->conn->error);
        }

        $stmt->bind_param("i", $enrollment_id);
        return $stmt->execute();
    }
}
?>
