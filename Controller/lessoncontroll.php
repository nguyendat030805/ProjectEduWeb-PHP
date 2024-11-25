<?php
require_once('../Model/lesson.php'); // Kết nối với model
require_once('../Public/config.php'); // Kết nối cơ sở dữ liệu

class LessonController {
    private $lessonModel;

    public function __construct($conn) {
        $this->lessonModel = new LessonModel($conn);
    }

    // 1. Hiển thị tất cả bài học
    public function showAllLessons() {
        $lessons = $this->lessonModel->getAllLessons();
        include '../Views/Public/lessonList.php'; // View để hiển thị danh sách bài học
    }

    // 2. Hiển thị bài học theo ID
    public function showLesson($lesson_id) {
        $lesson = $this->lessonModel->getLessonById($lesson_id);
        include '../Views/Public/lessonDetail.php'; // View để hiển thị chi tiết bài học
    }

    // 3. Lấy bài học theo ID khóa học
    public function showLessonsByCourseId($course_id) {
        $lessons = $this->lessonModel->getLessonsByCourseId($course_id);
        include '../Views/Public/lessonsByCourse.php'; // View để hiển thị bài học theo khóa học
    }

    // 4. Thêm bài học mới (chỉ dành cho admin)
    public function addLesson($title, $content_url, $type, $duration, $course_id) {
        if ($this->lessonModel->createLesson($title, $content_url, $type, $duration, $course_id)) {
            echo "Bài học đã được thêm thành công.";
        } else {
            echo "Có lỗi xảy ra khi thêm bài học.";
        }
    }

    // 5. Cập nhật bài học (chỉ dành cho admin)
    public function updateLesson($lesson_id, $title, $content_url, $type, $duration, $course_id) {
        if ($this->lessonModel->updateLesson($lesson_id, $title, $content_url, $type, $duration, $course_id)) {
            echo "Bài học đã được cập nhật thành công.";
        } else {
            echo "Có lỗi xảy ra khi cập nhật bài học.";
        }
    }

    // 6. Xóa bài học (chỉ dành cho admin)
    public function deleteLesson($lesson_id) {
        if ($this->lessonModel->deleteLesson($lesson_id)) {
            echo "Bài học đã được xóa thành công.";
        } else {
            echo "Có lỗi xảy ra khi xóa bài học.";
        }
    }
}

// Ví dụ sử dụng
session_start();
$userRole = $_SESSION['userRole'] ?? 'user'; // Mặc định là 'user' nếu không có thông tin

$conn = mysqli_connect();
$lessonController = new LessonController($conn);

// Xử lý các yêu cầu dựa trên phương thức HTTP
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['action'])) {
        if ($_GET['action'] === 'view') {
            $lessonController->showLesson($_GET['id']); // Hiển thị chi tiết bài học
        } elseif ($_GET['action'] === 'course') {
            $lessonController->showLessonsByCourseId($_GET['course_id']); // Hiển thị bài học theo khóa học
        } else {
            $lessonController->showAllLessons(); // Hiển thị tất cả bài học
        }
    } else {
        $lessonController->showAllLessons(); // Mặc định hiển thị tất cả bài học
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($userRole === 'admin') { // Chỉ admin mới có quyền thêm, sửa, xóa
        if (isset($_POST['action']) && $_POST['action'] === 'add') {
            $lessonController->addLesson($_POST['title'], $_POST['content_url'], $_POST['type'], $_POST['duration'], $_POST['course_id']);
        } elseif (isset($_POST['action']) && $_POST['action'] === 'update') {
            $lessonController->updateLesson($_POST['lesson_id'], $_POST['title'], $_POST['content_url'], $_POST['type'], $_POST['duration'], $_POST['course_id']);
        } elseif (isset($_POST['action']) && $_POST['action'] === 'delete') {
            $lessonController->deleteLesson($_POST['lesson_id']);
        }
    } else {
        echo "Bạn không có quyền thực hiện hành động này."; // Thông báo lỗi cho user
    }
}

// Đóng kết nối
$conn->close();
?>