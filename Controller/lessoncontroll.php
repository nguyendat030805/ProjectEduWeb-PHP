<?php
require_once('C:\xampp\htdocs\php-project\ProjectEduWeb-PHP\Model\lessonsmodel.php'); // Include LessonModel

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
        } else {
            echo json_encode(['message' => 'Lesson not found']);
        }
    }

    // 3. Get lessons by course ID
    public function getLessonsByChapter($chapter_id) {
        $lessons = $this->lessonModel->getLessonsByChapterId($chapter_id);
        return $lessons;
    }

    // 4. Create a new lesson
    public function createLesson($data) {
        $title = $data['title'];
        $content_url = $data['content_url'];
        $type = $data['type'];
        $duration = $data['duration'];
        $chapter_id = $data['chapter_id'];

        if ($this->lessonModel->createLesson($title, $content_url, $type, $duration, $chapter_id)) {
            echo json_encode(['message' => 'Lesson created successfully']);
        } else {
            echo json_encode(['message' => 'Failed to create lesson']);
        }
    }

    // 5. Update lesson
    public function updateLesson($lesson_id, $data) {
        $title = $data['title'];
        $content_url = $data['content_url'];
        $type = $data['type'];
        $duration = $data['duration'];
        $chapter_id = $data['chapter_id'];

        if ($this->lessonModel->updateLesson($lesson_id, $title, $content_url, $type, $duration, $chapter_id)) {
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
            'content_url' => $_POST['content_url'],
            'type' => $_POST['type'],
            'duration' => $_POST['duration'],
            'chapter_id' => $_POST['chapter_id']
        ];
        $lessonController->createLesson($data);
    }
}

// Đóng kết nối đến cơ sở dữ liệu
mysqli_close($conn);
?>