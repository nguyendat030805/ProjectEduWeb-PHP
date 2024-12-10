<?php
require_once('C:\xampp\htdocs\ProjectWeb-TD\ProjectEduWeb-PHP\Model\lessonsmodel.php');
class LessonController {
    private $lessonModel;

    // Constructor: Initialize LessonModel
    public function __construct($conn) {
        $this->lessonModel = new LessonModel($conn);
    }

    // 1. Get all lessons
    public function getAllLessons() {
        $lessons = $this->lessonModel->getAllLessons();
        echo json_encode($lessons);
    }

    // 2. Get lesson by ID
    public function getLessonById($lesson_id) {
        $lesson = $this->lessonModel->getLessonById($lesson_id);
        if ($lesson) {
            echo json_encode($lesson);
            return $lesson;
        }
    }

    // 3. Get lessons by course ID
    public function getLessonsByChapter($chapter_id) {
        $lessons = $this->lessonModel->getLessonsByChapterId($chapter_id);
        return $lessons;
    }

    // 4. Create a new lesson
// Trong lessoncontroll.php
    public function createLesson($data) {
        // Kiểm tra các khóa trong mảng $data
        $title = isset($data['title']) ? $data['title'] : null;
        $contentUrl = isset($data['content_url']) ? $data['content_url'] : null;
        $chapterId = isset($data['chapter_id']) ? $data['chapter_id'] : null;
        $description = isset($data['descripion']) ? $data['descripion'] : null;
        $course_id = isset($data['course_id']) ? $data['course_id'] : null;
        // Kiểm tra xem các tham số cần thiết có được cung cấp không
        if ($title && $chapterId) {
            // Thực hiện chèn vào cơ sở dữ liệu
            $stmt = $this->lessonModel->createLesson($title, $contentUrl,$description, $chapterId,$course_id);
        } else {
            // Xử lý lỗi
            echo "Thiếu thông tin cần thiết để tạo bài học.";
        }
    }

    // 5. Update lesson
    public function updateLesson($lesson_id, $data) {
        $title = $data['title'];
        $content_url = $data['content_url'];
        $description = $data['description'];
        $chapter_id = $data['chapter_id'];
        $course_id = $data['course_id'];

        if ($this->lessonModel->updateLesson($lesson_id, $title, $content_url,$description, $chapter_id,$course_id)) {
            echo json_encode(['message' => 'Lesson updated successfully']);
        } else {
            echo json_encode(['message' => 'Failed to update lesson']);
        }
    }

    // 6. Delete lesson
    public function deleteLesson($lesson_id) {
        if ($this->lessonModel->deleteLesson($lesson_id)) {
            echo json_encode(['message' => 'Lesson deleted successfully']);
        } else {
            echo json_encode(['message' => 'Failed to delete lesson']);
        }
    }
}

// Tạo kết nối tới cơ sở dữ liệu (nếu chưa có)
$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Tạo instance của LessonController
$lessonController = new LessonController($conn);

// Xử lý yêu cầu POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'add') {
        $data = [
            'title' => $_POST['title'],
            'content_url' => $_FILES['content_url'],
            'descripton' => $_POST['descripton'],
            'chapter_id' => $_POST['chapter_id'],
            'course_id' => $_POST['course_id'],
        ];
        $lessonController->createLesson($data);
    }
}

// Đóng kết nối đến cơ sở dữ liệu
mysqli_close($conn);
?>