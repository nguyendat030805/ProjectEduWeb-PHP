<?php
require_once('C:\xampp\htdocs\ProjectWeb-TD\ProjectEduWeb-PHP\Views\Public\config.php');


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
        $sql = "SELECT * FROM courses WHERE course_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $course_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // 3. Thêm một khóa học mới
public function createCourse($title, $images, $descriptions, $duration, $prices) {
    // Nếu $images là một mảng, chuyển đổi nó thành chuỗi
    if (is_array($images)) {
        $images = implode(',', $images); // Nối các phần tử lại với nhau
    }

    // Chuẩn bị câu lệnh SQL
    $stmt = $this->conn->prepare("INSERT INTO courses (title, images, descriptions, duration, prices) VALUES (?, ?, ?, ?, ?)");
    
    // Kiểm tra xem $stmt có phải là một đối tượng hợp lệ không
    if ($stmt === false) {
        echo "Lỗi chuẩn bị: " . $this->conn->error;
        return false;
    }

    // Binding parameters
    $stmt->bind_param("ssssi", $title, $images, $descriptions, $duration, $prices);
    
    // Thực hiện câu lệnh
    if ($stmt->execute()) {
        return true; // Trả về true nếu thêm thành công
    } else {
        echo "Lỗi: " . $stmt->error; // Xem lỗi nếu có
        return false; // Trả về false nếu có lỗi
    }
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
