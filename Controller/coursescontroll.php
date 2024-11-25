<?php
require_once('../Model/coursemodel.php'); // Kết nối với model
require_once('../Views/Public/config.php'); // Kết nối cơ sở dữ liệu

class EnrollController {
    private $enrollmentModel;

    public function __construct($conn) {
        $this->enrollmentModel = new EnrollmentModel($conn);
    }

    // 1. Lấy tất cả đăng ký của một người dùng
    public function getUserEnrollments($user_id) {
        $enrollments = $this->enrollmentModel->getEnrollmentsByUser($user_id);
        include '../Views/Pages/user'; // View để hiển thị profile của người dùng
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

// Ví dụ sử dụng
session_start();
$conn = mysqli_connect(); // Đảm bảo rằng hàm getConnection() đã được định nghĩa trong config.php
$enrollController = new EnrollController($conn);

// Xử lý các yêu cầu dựa trên phương thức HTTP
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'enroll') {
            $user_id = $_SESSION['user_id'] ?? null; // Lấy ID người dùng từ session
            $course_id = $_POST['course_id'] ?? null;
            if ($user_id && $course_id) {
                $enrollController->enrollInCourse($user_id, $course_id);
            } else {
                echo "Bạn cần đăng nhập để đăng ký khóa học.";
            }
        } elseif ($_POST['action'] === 'updateStatus') {
            $enrollment_id = $_POST['enrollment_id'] ?? null;
            $status = $_POST['status'] ?? null;
            if ($enrollment_id && $status) {
                $enrollController->updateEnrollmentStatus($enrollment_id, $status);
            } else {
                echo "Dữ liệu không hợp lệ.";
            }
        } elseif ($_POST['action'] === 'cancel') {
            $enrollment_id = $_POST['enrollment_id'] ?? null;
            if ($enrollment_id) {
                $enrollController->cancelEnrollment($enrollment_id);
            } else {
                echo "Dữ liệu không hợp lệ.";
            }
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $user_id = $_SESSION['user_id'] ?? null; // Lấy ID người dùng từ session
    if ($user_id) {
        $enrollController->getUserEnrollments($user_id); // Hiển thị đăng ký của người dùng
    } else {
        echo "Bạn cần đăng nhập để xem thông tin đăng ký.";
    }
}

// Đóng kết nối
$conn->close();
?>