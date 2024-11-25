<?php
require_once('../../Views/Public/config.php');  // Kết nối cơ sở dữ liệu
class LessonModel {
    private $conn;

    // Constructor: Nhận kết nối cơ sở dữ liệu
    public function __construct($conn) {
        $this->conn = $conn;
    }

    // 1. Lấy tất cả bài học
    public function getAllLessons() {
        $sql = "SELECT * FROM Lessons";
        $result = $this->conn->query($sql);

        $lessons = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $lessons[] = $row;
            }
        }
        return $lessons;
    }

    // 2. Lấy bài học theo ID
    public function getLessonById($lesson_id) {
        $sql = "SELECT * FROM Lessons WHERE lesson_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $lesson_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // 3. Lấy bài học theo ID khóa học
    public function getLessonsByCourseId($course_id) {
        $sql = "SELECT * FROM Lessons WHERE course_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $course_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $lessons = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $lessons[] = $row;
            }
        }
        return $lessons;
    }

    // 4. Thêm bài học mới
    public function createLesson($title, $content_url, $type, $duration, $course_id) {
        $sql = "INSERT INTO Lessons (title, content_url, type, duration, course_id)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssii", $title, $content_url, $type, $duration, $course_id);
        return $stmt->execute();
    }

    // 5. Cập nhật thông tin bài học
    public function updateLesson($lesson_id, $title, $content_url, $type, $duration, $course_id) {
        $sql = "UPDATE Lessons 
                SET title = ?, content_url = ?, type = ?, duration = ?, course_id = ?
                WHERE lesson_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssiii", $title, $content_url, $type, $duration, $course_id, $lesson_id);
        return $stmt->execute();
    }

    // 6. Xóa bài học
    public function deleteLesson($lesson_id) {
        $sql = "DELETE FROM Lessons WHERE lesson_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $lesson_id);
        return $stmt->execute();
    }
}
?>
