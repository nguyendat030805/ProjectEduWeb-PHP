<?php
require_once('C:\xampp\htdocs\ProjectWeb-TD\ProjectEduWeb-PHP\Views\Public\config.php');  // Kết nối cơ sở dữ liệu
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
    public function getLessonsByChapterId($chapter_id) {
        $sql = "SELECT * FROM lessons WHERE chapter_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $chapter_id);
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
    public function getLessonsByCourseId($course_id) {
        try {
            $sql = "SELECT * FROM Lessons WHERE course_id = ?";
            $stmt = $this->conn->prepare($sql); // Chuẩn bị truy vấn
            $stmt->bind_param("i", $course_id); // Gắn tham số
            $stmt->execute(); // Thực thi truy vấn

            $result = $stmt->get_result();
            $lessons = [];
            while ($row = $result->fetch_assoc()) {
                $lessons[] = $row; // Lưu từng bài học vào mảng
            }
            return $lessons; // Trả về danh sách bài học
        } catch (Exception $e) {
            // Log lỗi nếu cần
            return [];
        }
    }

    // 4. Thêm bài học mới
    public function createLesson($title, $content_url, $description, $chapter_id,$course_id) {
        $sql = "INSERT INTO Lessons (title, content_url, description, chapter_id,course_id)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssii", $title, $content_url, $description, $chapter_id,$course_id);
        return $stmt->execute();
    }

    // 5. Cập nhật thông tin bài học
    public function updateLesson($lesson_id, $title, $content_url, $description, $chapter_id,$course_id) {
        $sql = "UPDATE Lessons 
                SET title = ?, content_url = ?, content_type = ?, description = ?, chapter_id = ?, course_id = ?
                WHERE lesson_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssii", $title, $content_url, $description, $chapter_id, $lesson_id,$course_id);
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
