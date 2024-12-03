<?php
require_once('C:\xampp\htdocs\php-project\ProjectEduWeb-PHP\Views\Public\config.php');
class ChapterModel {
    private $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }

    // Lấy tất cả các chương theo ID khóa học
    public function getChaptersByCourseId($course_id) {
        $stmt = $this->conn->prepare("SELECT * FROM Chapters WHERE course_id = ?");
        $stmt->bind_param('i', $course_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC); // Trả về mảng các chương
    }

    // Thêm chương mới
    public function createChapter($data) {
        $stmt = $this->conn->prepare("INSERT INTO Chapters (chapter_title, course_id) VALUES (?, ?)");
        $stmt->bind_param('si', $data['chapter_title'], $data['course_id']);
        return $stmt->execute(); // Trả về true nếu thành công
    }

    // Cập nhật chương
    public function updateChapter($chapter_id, $data) {
        $stmt = $this->conn->prepare("UPDATE Chapters SET chapter_title = ? WHERE chapter_id = ?");
        $stmt->bind_param('si', $data['chapter_title'], $chapter_id);
        return $stmt->execute();
    }

    // Xóa chương
    public function deleteChapter($chapter_id) {
        $stmt = $this->conn->prepare("DELETE FROM Chapters WHERE chapter_id = ?");
        $stmt->bind_param('i', $chapter_id);
        return $stmt->execute();
    }
     // Lấy danh sách bài học theo course_id và chapter_id
     public function getLessonsByCourseAndChapterId($course_id, $chapter_id) {
        $sql = "SELECT * FROM lessons WHERE course_id = ? AND chapter_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $course_id, $chapter_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    }

?>