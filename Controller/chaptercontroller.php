<?php
require_once('C:\xampp\htdocs\ProjectWeb-TD\ProjectEduWeb-PHP\Model\chapter.php');  // Bao gồm ChapterModel
require_once('C:\xampp\htdocs\ProjectWeb-TD\ProjectEduWeb-PHP\Model\lessonsmodel.php');   // Bao gồm LessonModel

class ChapterController {
    private $chapterModel;
    private $lessonModel;

    // Constructor để khởi tạo các đối tượng Model
    public function __construct($conn) {
        $this->chapterModel = new ChapterModel($conn);
        $this->lessonModel = new LessonModel($conn);  // Khởi tạo đối tượng LessonModel
    }

    // 1. Lấy tất cả các chương theo ID khóa học
    public function getChaptersByCourseId($course_id) {
        $chapters = $this->chapterModel->getChaptersByCourseId($course_id);
        return $chapters;
    }

    // 2. Tạo chương mới
    public function createChapter($data) {
        if ($this->chapterModel->createChapter($data)) {
            return ['message' => 'Chapter created successfully'];
        } else {
            return ['message' => 'Failed to create chapter'];
        }
    }

    // 3. Cập nhật chương
    public function updateChapter($chapter_id, $data) {
        if ($this->chapterModel->updateChapter($chapter_id, $data)) {
            return ['message' => 'Chapter updated successfully'];
        } else {
            return ['message' => 'Failed to update chapter'];
        }
    }

    // 4. Xóa chương
    public function deleteChapter($chapter_id) {
        if ($this->chapterModel->deleteChapter($chapter_id)) {
            return ['message' => 'Chapter deleted successfully'];
        } else {
            return ['message' => 'Failed to delete chapter'];
        }
    }


    // Lấy bài học dựa trên course_id và chapter_id
    public function getLessonsByCourseAndChapterId($chapter_id) {
        return $this->lessonModel->getLessonsByChapterId($chapter_id);
    }
    public function getChapterById($chapter_id) {
    return $this->chapterModel->getChapterById($chapter_id);
}
}
?>
