<?php
require_once('../../Views/Public/config.php');
// Kết nối cơ sở dữ liệu

class CourseModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // 1. Lấy tất cả khóa học
    public function getAllCourses() {
        $sql = "SELECT * FROM Courses";
        $result = $this->conn->query($sql);

        $courses = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $courses[] = $row;
            }
        }
        return $courses;
    }

    // 2. Lấy thông tin chi tiết khóa học
    public function getCourseById($course_id) {
        $sql = "SELECT * FROM Courses WHERE course_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $course_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // 3. Thêm một khóa học mới
    public function createCourse($title, $images, $descriptions, $duration, $prices) {
        $sql = "INSERT INTO Courses (title, images, descriptions, duration, prices) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssid", $title, $images, $descriptions, $duration, $prices);
        return $stmt->execute();
    }

    // 4. Cập nhật thông tin khóa học
    public function updateCourse($course_id, $title, $images, $descriptions, $duration, $prices) {
        $sql = "UPDATE Courses 
                SET title = ?, images = ?, descriptions = ?, duration = ?, prices = ? 
                WHERE course_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssidi", $title, $images, $descriptions, $duration, $prices, $course_id);
        return $stmt->execute();
    }

    // 5. Xóa một khóa học
    public function deleteCourse($course_id) {
        $sql = "DELETE FROM Courses WHERE course_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $course_id);
        return $stmt->execute();
    }
}
?>
