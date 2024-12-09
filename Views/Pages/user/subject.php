<?php
require_once('C:\xampp\htdocs\php-project\ProjectEduWeb-PHP\Controller\reviewcontroller.php');
require_once('C:\xampp\htdocs\php-project\ProjectEduWeb-PHP\Views\Public\config.php');
require_once('C:\xampp\htdocs\php-project\ProjectEduWeb-PHP\Controller\coursescontroll.php');
require_once('C:\xampp\htdocs\php-project\ProjectEduWeb-PHP\Controller\lessoncontroll.php');
require_once('C:\xampp\htdocs\php-project\ProjectEduWeb-PHP\Controller\chaptercontroller.php');

// Kết nối cơ sở dữ liệu
$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}

// Tạo đối tượng controller
$reviewController = new ReviewController($conn);
$lessonController = new LessonController($conn);

// Lấy các thông tin bài học
if (isset($_GET['lesson_id'])) {
    $lesson_id = intval($_GET['lesson_id']);
    $lesson = $lessonController->getLessonById($lesson_id); // Giả sử có phương thức này
    $reviews = $reviewController->getReviewByLessonId($lesson_id);
} else {
    echo "Lesson ID is not provided.";
    exit;
}

// Xử lý yêu cầu từ phía người dùng
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'createReview' && isset($_POST['comments'], $_POST['user_id'])) {
        $comments = $_POST['comments'];
        $user_id = intval($_POST['user_id']);

        $result = $reviewController->createReview($comments, $user_id, $lesson_id);
        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Bình luận đã được tạo.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Có lỗi xảy ra khi tạo bình luận.']);
        }
        exit; // Dừng lại sau khi xử lý POST
    } elseif ($_POST['action'] === 'deleteReview' && isset($_POST['review_id'])) {
        $review_id = intval($_POST['review_id']);
        $result = $reviewController->deleteReview($review_id);
        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Bình luận đã được xóa.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Có lỗi xảy ra khi xóa bình luận.']);
        }
        exit; // Dừng lại sau khi xử lý POST
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết Bài học</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Style chỉnh sửa */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }
        .review-title {
            font-weight: bold;
        }
        .review-item {
            background-color: #e8f5e9;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h1><?php echo htmlspecialchars($lesson['title']); ?></h1>
        <p><?php echo htmlspecialchars($lesson['description']); ?></p>

        <h5>Bình luận:</h5>
        <div id="reviews">
            <?php if (!empty($reviews)): ?>
                <?php foreach ($reviews as $review): ?>
                    <div class="review-item">
                        <span class="review-title"><?php echo htmlspecialchars($review['comments']); ?></span>
                        <form style="display:inline;" method="POST" class="delete-review-form">
                            <input type="hidden" name="action" value="deleteReview">
                            <input type="hidden" name="review_id" value="<?php echo $review['review_id']; ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Chưa có bình luận nào.</p>
            <?php endif; ?>
        </div>

        <h5>Thêm bình luận:</h5>
        <form method="POST" id="comment-form">
            <input type="hidden" name="action" value="createReview">
            <input type="hidden" name="user_id" value="1"> <!-- Thay thế bằng ID người dùng hiện tại -->
            <textarea name="comments" placeholder="Nhập bình luận của bạn" required></textarea>
            <button type="submit" class="btn btn-primary">Gửi</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.getElementById('comment-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);

        fetch('', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (data.success) {
                location.reload(); // Tải lại trang để cập nhật bình luận
            }
        });
    });

    document.querySelectorAll('.delete-review-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            fetch('', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                if (data.success) {
                    location.reload(); // Tải lại trang để cập nhật bình luận
                }
            });
        });
    });
    </script>
</body>
</html>

<?php
$conn->close();
?>