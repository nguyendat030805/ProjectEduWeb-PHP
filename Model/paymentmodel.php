<?php
require_once('../Views/Public/config.php');  // Kết nối cơ sở dữ liệu
class PaymentModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // 1. Lấy tất cả thanh toán
    public function getAllPayments() {
        $sql = "SELECT * FROM Payments";
        $result = $this->conn->query($sql);

        $payments = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $payments[] = $row;
            }
        }
        return $payments;
    }

    // 2. Lấy thanh toán theo ID
    public function getPaymentById($payment_id) {
        $sql = "SELECT * FROM Payments WHERE payment_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $payment_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // 3. Lấy tất cả thanh toán của một người dùng
    public function getPaymentsByUserId($user_id) {
        $sql = "SELECT * FROM Payments WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $payments = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $payments[] = $row;
            }
        }
        return $payments;
    }

    // 4. Thêm thanh toán mới
    public function createPayment($status, $payment_date, $user_id, $course_id) {
        $sql = "INSERT INTO Payments (status, payment_date, user_id, course_id) 
                VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssii", $status, $payment_date, $user_id, $course_id);
        return $stmt->execute();
    }

    // 5. Cập nhật trạng thái thanh toán
    public function updatePaymentStatus($payment_id, $status) {
        $sql = "UPDATE Payments SET status = ? WHERE payment_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $status, $payment_id);
        return $stmt->execute();
    }

    // 6. Xóa thanh toán
    public function deletePayment($payment_id) {
        $sql = "DELETE FROM Payments WHERE payment_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $payment_id);
        return $stmt->execute();
    }
}
?>
