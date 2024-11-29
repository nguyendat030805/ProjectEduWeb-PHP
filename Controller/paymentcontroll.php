<?php
require_once('../Model/paymentmodel.php'); // Kết nối với model
require_once('../Views/config.php'); // Kết nối cơ sở dữ liệu

class PaymentController {
    private $paymentModel;

    public function __construct($conn) {
        $this->paymentModel = new PaymentModel($conn);
    }

    // 1. Lấy tất cả thanh toán
    public function getAllPayments() {
        $payments = $this->paymentModel->getAllPayments();
        include '../Views/Public/paymentList.php'; // View để hiển thị danh sách thanh toán
    }

    // 2. Lấy thanh toán theo ID
    public function getPayment($payment_id) {
        $payment = $this->paymentModel->getPaymentById($payment_id);
        include '../Views/Public/paymentDetail.php'; // View để hiển thị chi tiết thanh toán
    }

    // 3. Lấy tất cả thanh toán của một người dùng
    public function getPaymentsByUserId($user_id) {
        $payments = $this->paymentModel->getPaymentsByUserId($user_id);
        include '../Views/Public/userPayments.php'; // View để hiển thị thanh toán của người dùng
    }

    // 4. Thêm thanh toán mới
    public function createPayment($status, $payment_date, $user_id, $course_id) {
        if ($this->paymentModel->createPayment($status, $payment_date, $user_id, $course_id)) {
            echo "Thêm thanh toán thành công.";
        } else {
            echo "Có lỗi xảy ra khi thêm thanh toán.";
        }
    }

    // 5. Cập nhật trạng thái thanh toán
    public function updatePaymentStatus($payment_id, $status) {
        if ($this->paymentModel->updatePaymentStatus($payment_id, $status)) {
            echo "Cập nhật trạng thái thanh toán thành công.";
        } else {
            echo "Có lỗi xảy ra khi cập nhật trạng thái.";
        }
    }

    // 6. Xóa thanh toán
    public function deletePayment($payment_id) {
        if ($this->paymentModel->deletePayment($payment_id)) {
            echo "Xóa thanh toán thành công.";
        } else {
            echo "Có lỗi xảy ra khi xóa thanh toán.";
        }
    }
}

// Ví dụ sử dụng
session_start();
$conn = mysqli_connect(); // Đảm bảo rằng hàm getConnection() đã được định nghĩa trong config.php
$paymentController = new PaymentController($conn);

// Xử lý các yêu cầu dựa trên phương thức HTTP
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'create') {
            $status = $_POST['status'] ?? 'pending';
            $payment_date = $_POST['payment_date'] ?? date('Y-m-d H:i:s');
            $user_id = $_SESSION['user_id'] ?? null; // Lấy ID người dùng từ session
            $course_id = $_POST['course_id'] ?? null;

            if ($user_id && $course_id) {
                $paymentController->createPayment($status, $payment_date, $user_id, $course_id);
            } else {
                echo "Bạn cần đăng nhập để thực hiện thanh toán.";
            }
        } elseif ($_POST['action'] === 'update') {
            $payment_id = $_POST['payment_id'] ?? null;
            $status = $_POST['status'] ?? null;
            if ($payment_id && $status) {
                $paymentController->updatePaymentStatus($payment_id, $status);
            } else {
                echo "Dữ liệu không hợp lệ.";
            }
        } elseif ($_POST['action'] === 'delete') {
            $payment_id = $_POST['payment_id'] ?? null;
            if ($payment_id) {
                $paymentController->deletePayment($payment_id);
            } else {
                echo "Dữ liệu không hợp lệ.";
            }
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['action'])) {
        if ($_GET['action'] === 'viewAll') {
            $paymentController->getAllPayments(); // Hiển thị tất cả thanh toán
        } elseif ($_GET['action'] === 'view') {
            $payment_id = $_GET['payment_id'] ?? null;
            if ($payment_id) {
                $paymentController->getPayment($payment_id); // Hiển thị thanh toán theo ID
            } else {
                echo "Dữ liệu không hợp lệ.";
            }
        } elseif ($_GET['action'] === 'userPayments') {
            $user_id = $_SESSION['user_id'] ?? null; // Lấy ID người dùng từ session
            if ($user_id) {
                $paymentController->getPaymentsByUserId($user_id); // Hiển thị thanh toán của người dùng
            } else {
                echo "Bạn cần đăng nhập để xem thông tin thanh toán.";
            }
        }
    }
}

// Đóng kết nối
$conn->close();
?>