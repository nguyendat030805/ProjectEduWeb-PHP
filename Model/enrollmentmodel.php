<?php
require_once('C:\xampp\htdocs\ProjectWeb-TD\ProjectEduWeb-PHP\Views\Public\config.php');  // Kết nối cơ sở dữ liệu

class EnrollmentModel {
    private $conn;

    // Constructor: Nhận kết nối cơ sở dữ liệu
    public function __construct($conn) {
        $this->conn = $conn;
    }
    // 2. Lấy thông tin khóa học theo ID (bao gồm loại khóa học)
    public function getCourseById($course_id) {
        $sql = "SELECT * FROM Courses WHERE course_id = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            die("Error preparing query: " . $this->conn->error);
        }

        $stmt->bind_param("i", $course_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result === false) {
            die("Error executing query: " . $this->conn->error);
        }

        return $result->fetch_assoc();  // Trả về thông tin chi tiết về khóa học
    }

    // 3. Kiểm tra đăng ký khóa học và thực hiện đăng ký
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

        if ($result->num_rows > 0) {
            echo "<script>alert('You have already enrolled in this course.');</script>";
            return false;  // Kết thúc xử lý
        }

        // Nếu chưa có bản ghi, thực hiện đăng ký
        $sql = "INSERT INTO Enrollments (user_id, course_id, status) VALUES (?, ?, 'studying')";
        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            die("Error preparing query: " . $this->conn->error);
        }

        $stmt->bind_param("ii", $user_id, $course_id);
        $stmt->execute();

        // Sau khi đăng ký thành công, trả về khóa học để kiểm tra loại
        return $this->getCourseById($course_id);  // Trả về thông tin khóa học đã đăng ký
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
