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

// Kiểm tra course_id
if (isset($_GET['course_id'])) {
    $course_id = $_GET['course_id'];
    $course = $courseController->getCourseById($course_id); 
    $chapters = $chapterController->getChaptersByCourseId($course_id);

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

        .video-wrapper {
            border: 2px solid black;
            background-image: url('../../Public/Assets/Image/download_logo.png');
            object-fit: cover;
            border-radius: 8px;
            overflow: hidden;
        }
        .video-wrapper iframe {
            width: 100%;
            height: 400px;
        }
        h5 {
            color: #2d572c;
        }
        .review-item {
            background-color: #e8f5e9;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;

            color: #2d572c;
        }
        .lesson_duratitle {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            margin: 5px 0;
            cursor: pointer;
        }
        .lesson-title {
            font-size: 16px;
            width: 250px;
            height: 50px;
            background-color: white;
            border: 1px solid gray;
            border-radius: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            cursor: pointer;
            background-size: 200% 200%;

        }
        .lesson-title:hover{
            background: linear-gradient(135deg, #028a4f, #0afa66);
            background-position: 100% 100%; /* Di chuyển gradient sang phải */
            transform: scale(1.05);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.3);
        }
        .lesson-duration {
            font-size: 14px;
            color: #555;
        }
        .rounded-pill {
            cursor: pointer;
            padding: 8px 16px;
        }
        .rounded-pill:hover {
            background-color: #e6e6e6;
        }
        .bi {
            font-size: 20px;
        }
        span {
            font-weight: bold;
        }
        .profile{
            display: flex;
            gap: 10px;
            align-items: center;
        }
        .profile h5{
            color: black;
            font-weight: bold;
        }
        .avt{
            display: flex;
            align-items: center;
            width: 165px;
        }
        .avt img{
            width: 20%;
            height: 20%;
        }
        .seen-profile{
            background-color: #0afa66;
            border-radius: 10px;
        }
        .seen-profile:hover{
            background-color: white;
        }
        .seen-profile a{
            text-decoration: none;
            color: black;
        }
        .evaluate{
            padding-top: 50px;
            display: flex;
            text-align: center;
            justify-content: space-between;
        }
        #dislike-btn,#like-btn {
            border: 2px solid black;
            background-color: #0afa66;
            width: 100px;
            border-radius: 20px;
        }
        #dislike-btn:hover,#like-btn:hover{
            background-color: white;

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
        <h1><?php echo htmlspecialchars($course['title']); ?></h1>
        <div class="row">
            <div class="col-md-8">
                <div class="video-wrapper">
                    <?php
                    function convertToEmbedURL($url) {
                        if (strpos($url, 'watch?v=') !== false) {
                            return str_replace('watch?v=', 'embed/', $url);
                        }
                        return $url;
                    }
                    ?>
                    <iframe src="<?php echo htmlspecialchars($lesson['content_url']); ?>"
                        title="Video Player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                    
                </div>
                <div class="title-course">
                    <h5><?php echo htmlspecialchars($course['title']); ?></h5>
                    <div class="evaluate">
                        <div class="profile">
                            <div class="avt">
                                <img src="../../Public/Assets/Image/download_logo.png" alt="">
                                <h5>Learn on Web</h5>
                            </div>
                            
                            <button class="seen-profile"><a href="../../Pages/user/about.php">Learn On</a> </button>
                        </div>
                        <div class="d-flex align-items-center rounded-pill bg-light p-2" id="like-container">
                            <div class="d-flex align-items-center me-3 justify-content-between" id="like-btn">
                                <i class="bi bi-hand-thumbs-up-fill"></i>
                                <span id="like-count">0</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between" id="dislike-btn">
                                <i class="bi bi-hand-thumbs-down"></i>
                                <span id="dislike-count">0</span>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <h5>Nội dung khóa học</h5>
                <div class="accordion" id="courseContentAccordion">
                    <?php if (!empty($chapters)): ?>
                        <?php foreach ($chapters as $index => $chapter): ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading<?php echo $index; ?>">
                                    <button class="accordion-button <?php echo ($index === 0) ? '' : 'collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $index; ?>" aria-expanded="<?php echo ($index === 0) ? 'true' : 'false'; ?>" aria-controls="collapse<?php echo $index; ?>">
                                        <?php echo htmlspecialchars($chapter['chapter_title']); ?>
                                    </button>
                                </h2>
                                <div id="collapse<?php echo $index; ?>" class="accordion-collapse collapse <?php echo ($index === 0) ? 'show' : ''; ?>" aria-labelledby="heading<?php echo $index; ?>" data-bs-parent="#courseContentAccordion">
                                    <div class="accordion-body">
                                        <ul>
                                            <?php
                                            $lessons = $lessonController->getLessonsByChapter($chapter['chapter_id']);
                                            if (!empty($lessons)): ?>
                                                <?php foreach ($lessons as $lesson): ?>
                                                    <li class="lesson_duratitle" data-video="<?php echo htmlspecialchars($lesson['content_url']); ?>">
                                                        <button class="lesson-title"><?php echo htmlspecialchars($lesson['description']); ?></button>
                                                        <span class="lesson-duration"><?php echo htmlspecialchars($lesson['duration']); ?> phút</span>
                                                    </li>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <li>Không có bài học nào trong chương này.</li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Không có nội dung nào trong khóa học này.</p>
                    <?php endif; ?>
                </div>
            </div>
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
    // Hàm xử lý tăng số lượng
    function incrementCount(buttonId, countElementId, countVariable) {
        const button = document.getElementById(buttonId);
        const countElement = document.getElementById(countElementId);

        button.addEventListener('click', () => {
            countVariable++;
            countElement.textContent = countVariable.toLocaleString();
        });

        return countVariable;
    }

    // Biến số lượng
    let likeCount = 0;
    let dislikeCount = 0;

    // Gọi hàm cho "like" và "dislike"
    likeCount = incrementCount('like-btn', 'like-count', likeCount);
    dislikeCount = incrementCount('dislike-btn', 'dislike-count', dislikeCount);

    </script>
</body>
</html>

<?php
$conn->close();
?>