<?php
require_once('C:\xampp\htdocs\ProjectWeb-TD\ProjectEduWeb-PHP\Model\review.php');
require_once('C:\xampp\htdocs\ProjectWeb-TD\ProjectEduWeb-PHP\Views\Public\config.php');

class ReviewController {
    private $courseModel;

    public function __construct($conn) {
        $this->courseModel = new reviewsModel($conn);
    }

    // Lấy tất cả đánh giá
    public function getAllReviews() {
        return $this->courseModel->getAllReviews();
    }

    // Lấy đánh giá theo ID
    public function getReviewById($review_id) {
        return $this->courseModel->getReviewById($review_id);
    }

    // Lấy đánh giá theo ID bài học
    public function getReviewByLessonId($lesson_id) {
        return $this->courseModel->getReviewByLessonId($lesson_id);
    }

    // Xóa đánh giá
    public function deleteReview($review_id) {
        return $this->courseModel->deleteReview($review_id);
    }

    // Tạo đánh giá mới
    public function createReview($comments, $user_id, $lesson_id) {
        return $this->courseModel->createReview($comments, $user_id, $lesson_id);
    }
}

// Kết nối cơ sở dữ liệu
$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}

// Tạo đối tượng controller
$courseController = new reviewController($conn);

// Xử lý yêu cầu từ phía người dùng
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Lấy tất cả đánh giá
    if (isset($_GET['action']) && $_GET['action'] === 'getAllReviews') {
        $reviews = $courseController->getAllReviews();
        echo json_encode($reviews);
    }
    // Lấy đánh giá theo ID
    elseif (isset($_GET['action']) && $_GET['action'] === 'getReviewById' && isset($_GET['review_id'])) {
        $review = $courseController->getReviewById(intval($_GET['review_id']));
        echo json_encode($review);
    }
    // Lấy đánh giá theo ID bài học
    elseif (isset($_GET['action']) && $_GET['action'] === 'getReviewByLessonId' && isset($_GET['lesson_id'])) {
        $review = $courseController->getReviewByLessonId(intval($_GET['lesson_id']));
        echo json_encode($review);
    }
}

// Xử lý yêu cầu tạo đánh giá
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    // Tạo đánh giá mới
    if ($_POST['action'] === 'createReview' && isset($_POST['comments'], $_POST['user_id'], $_POST['lesson_id'])) {
        $comments = $_POST['comments'];
        $user_id = intval($_POST['user_id']);
        $lesson_id = intval($_POST['lesson_id']);

        $result = $courseController->createReview($comments, $user_id, $lesson_id);
        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Đánh giá đã được tạo.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Có lỗi xảy ra khi tạo đánh giá.']);
        }
    }
    // Xóa đánh giá
    elseif ($_POST['action'] === 'deleteReview' && isset($_POST['review_id'])) {
        $review_id = intval($_POST['review_id']);
        $result = $courseController->deleteReview($review_id);
        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Đánh giá đã được xóa.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Có lỗi xảy ra khi xóa đánh giá.']);
        }
    }
}

// Đóng kết nối
$conn->close();
?>