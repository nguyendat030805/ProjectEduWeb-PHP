<?php
require_once('C:\xampp\htdocs\php-project\ProjectEduWeb-PHP\Model\enrollmentmodel.php'); // Kết nối với model
require_once('C:\xampp\htdocs\php-project\ProjectEduWeb-PHP\Views\Public\config.php'); // Kết nối cơ sở dữ liệu

class EnrollController {
    private $enrollmentModel;

    public function __construct($conn) {
        $this->enrollmentModel = new EnrollmentModel($conn);
    }

    // 1. Lấy tất cả đăng ký của một người dùng
    public function getUserEnrollments($user_id) {
        $enrollments = $this->enrollmentModel->getEnrollmentsByUser($user_id);
        return $enrollments;
    }

    // 2. Đăng ký một khóa học
    public function enrollInCourse($user_id, $course_id) {
        if ($this->enrollmentModel->enrollInCourse($user_id, $course_id)) {
            echo "Đăng ký khóa học thành công.";
        } else {
            echo "Bạn đã đăng ký khóa học này rồi.";
        }
    }

    // 3. Cập nhật trạng thái đăng ký
    public function updateEnrollmentStatus($enrollment_id, $status) {
        if ($this->enrollmentModel->updateEnrollmentStatus($enrollment_id, $status)) {
            echo "Cập nhật trạng thái đăng ký thành công.";
        } else {
            echo "Có lỗi xảy ra khi cập nhật trạng thái.";
        }
    }

    // 4. Hủy đăng ký khóa học
    public function cancelEnrollment($enrollment_id) {
        if ($this->enrollmentModel->cancelEnrollment($enrollment_id)) {
            echo "Hủy đăng ký thành công.";
        } else {
            echo "Có lỗi xảy ra khi hủy đăng ký.";
        }
    }
}

?>