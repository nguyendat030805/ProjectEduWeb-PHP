<?php
session_start(); // Đảm bảo session được khởi tạo

require_once('C:\xampp\htdocs\Bang_PHP\ProjectWeb-TD\ProjectEduWeb-PHP\Model\enrollmentmodel.php'); // Kết nối với model
require_once('C:\xampp\htdocs\Bang_PHP\ProjectWeb-TD\ProjectEduWeb-PHP\Views\Public\config.php'); // Kết nối cơ sở dữ liệu
require_once('C:\xampp\htdocs\Bang_PHP\ProjectWeb-TD\ProjectEduWeb-PHP\Model\usermodel.php');
require_once('C:\xampp\htdocs\Bang_PHP\ProjectWeb-TD\ProjectEduWeb-PHP\Model\registermodel.php');
require_once('C:\xampp\htdocs\Bang_PHP\ProjectWeb-TD\ProjectEduWeb-PHP\Model\loginmodel.php');
require_once('C:\xampp\htdocs\Bang_PHP\ProjectWeb-TD\ProjectEduWeb-PHP\Model\coursemodel.php');

class EnrollController {
    private $enrollmentModel;

    public function __construct($conn) {
        $this->enrollmentModel = new EnrollmentModel($conn);
      
    }
    
    // 2. Đăng ký một khóa học
    public function enrollInCourse($user_id, $course_id) {
        // Kiểm tra khóa học
        $course = $this->enrollmentModel->getCourseById($course_id);
       
        // Nếu khóa học tồn tại
        if ($course) {
            if ($this->enrollmentModel->enrollInCourse($user_id, $course_id)) {
                echo "Đăng ký khóa học thành công.";
                
                
                
                if ($course['types'] === 'Pro') {
                    // Nếu khóa học trả phí, chuyển đến trang thanh toán
                    header('Location:../views/Pages/user/paymentForm.php?course_id=' . $course_id. '&user_id=' . $user_id );
                    exit(); // Dừng mã thực thi thêm
                } else {
                    // Nếu khóa học miễn phí, chuyển đến trang bài học
                    header('Location: ../views/Pages/user/subject.php?user_id=' . $user_id . '&course_id=' . $course_id);
                    exit(); // Dừng mã thực thi thêm
                }
            } else {
               
                    // Sau khi đăng ký thành công, chuyển hướng tới trang subject.php
                    header('Location: ../views/Pages/user/subject.php?user_id=' . $user_id . '&course_id=' . $course_id);
                    exit();
            }
        } else {
            echo "Khóa học không tồn tại.";
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

// Khởi tạo đối tượng EnrollController
$enrollController = new EnrollController($conn);

// Xử lý các yêu cầu dựa trên phương thức HTTP
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        // Đảm bảo rằng người dùng đã đăng nhập trước khi thực hiện các thao tác
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id']; // Lấy ID người dùng từ session
        } else {
            echo "Bạn cần đăng nhập để đăng ký khóa học.";
            exit;
        }

        if ($_POST['action'] === 'enroll') {
            $course_id = $_POST['course_id'] ?? null;
            if(isset($course_id)){

                $course_id = (int) $course_id; 
            }
            if ($course_id) {
            
                $enrollController->enrollInCourse($user_id, $course_id);
            } else {
                echo "Dữ liệu không hợp lệ.";
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
    // Lấy ID người dùng từ session nếu có
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    } else {
        echo "Bạn cần đăng nhập để xem trang này.";
        exit;
    }
}

// Đóng kết nối
$conn->close();
?>
