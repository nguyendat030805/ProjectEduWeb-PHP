<?php
require_once('C:\xampp\htdocs\php-project\ProjectEduWeb-PHP\Views\Public\config.php');

class ReviewsModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Lấy tất cả đánh giá
    public function getAllReviews() {
        $sql = "SELECT * FROM Reviews";
        $result = $this->conn->query($sql);

        $reviews = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $reviews[] = $row;
            }
        }
        return $reviews;
    }

    // Lấy đánh giá theo ID
    public function getReviewById($review_id) {
        $sql = "SELECT * FROM Reviews WHERE review_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $review_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Lấy đánh giá theo ID bài học
    public function getReviewByLessonId($lesson_id) {
        $sql = "SELECT * FROM Reviews WHERE lesson_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $lesson_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Xóa đánh giá
    public function deleteReview($review_id) {
        $sql = "DELETE FROM Reviews WHERE review_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $review_id);
        return $stmt->execute();
    }

    // Tạo đánh giá mới
    public function createReview($comments, $user_id, $lesson_id) {
        $sql = "INSERT INTO Reviews (comments, date_posted, user_id, lesson_id) VALUES (?, NOW(), ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sii", $comments, $user_id, $lesson_id);
        return $stmt->execute();
    }
}
?>