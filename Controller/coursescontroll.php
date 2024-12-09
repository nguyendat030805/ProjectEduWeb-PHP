<?php
require_once('C:\xampp\htdocs\php-project\ProjectEduWeb-PHP\Views\Public\config.php');
require_once(__DIR__ . '/../Model/coursemodel.php'); // Đường dẫn tương đối // Import model
class CourseController {
    private $courseModel;
    public function __construct($conn) {
        $this->courseModel = new CourseModel($conn);
    }

    // 1. Lấy tất cả khóa học

    public function index() {
        $courses = $this->courseModel->getAllCourses();
        return $courses;
    }
    // 2. Lấy thông tin chi tiết khóa học
    public function getCourseById($course_id) {
        $course = $this->courseModel->getCourseById($course_id);
        if (!$course) {
            echo "Khóa học không tồn tại.";
            exit; // Hoặc bạn có thể trả về một giá trị khác như false hoặc null
        }
        return $course; // Trả về thông tin khóa học nếu tìm thấy
    }
    // 3. Thêm một khóa học mới
    public function store($data) {
        $title = $data['courseName'];
        $images = $data['courseImage']; // Giả sử bạn có trường hình ảnh
        $descriptions = $data['courseDescription'];
        $duration = $data['courseDuration'];
        $prices = $data['coursePrice'];
        return $this->courseModel->createCourse($title, $images, $descriptions, $duration, $prices);
    }
    // 4. Cập nhật thông tin khóa học
    public function update($course_id, $data) {
        $title = $data['courseName'];
        $images = $data['courseImage']; // Giả sử bạn có trường hình ảnh
        $descriptions = $data['courseDescription'];

        $duration = $data['courseDuration'];
        $prices = $data['coursePrice'];
        return $this->courseModel->updateCourse($course_id, $title, $images, $descriptions, $duration, $prices);
    }

    // 5. Xóa một khóa học
    public function destroy($course_id) {
        return $this->courseModel->deleteCourse($course_id);
    }
}

// Khởi tạo kết nối đến cơ sở dữ liệu
$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Tạo một instance của CourseController
$courseController = new CourseController($conn);

// 1. Lấy tất cả khóa học
$courses = $courseController->index();

// 2. Thêm một khóa học mới
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_course'])) {
    $data = [
        'courseName' => $_POST['courseName'],
        'courseDescription' => $_POST['courseDescription'],
        'courseDuration' => $_POST['courseDuration'],
        'coursePrice' => $_POST['coursePrice'],
    ];

    // Xử lý hình ảnh
if (isset($_FILES['courseImage']) && $_FILES['courseImage']['error'] == 0) {
    $targetDir = "uploads/"; // Thư mục lưu trữ hình ảnh (đường dẫn tương đối)
    
    // Kiểm tra xem thư mục uploads có tồn tại không
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true); // Tạo thư mục nếu không tồn tại
    }

    $targetFile = $targetDir . basename($_FILES['courseImage']['name']);
    
    // Kiểm tra loại file hình ảnh
    $check = getimagesize($_FILES['courseImage']['tmp_name']);
    if ($check !== false) {
        // Di chuyển file tải lên
        if (move_uploaded_file($_FILES['courseImage']['tmp_name'], $targetFile)) {
            $data['courseImage'] = $targetFile; // Lưu đường dẫn hình ảnh vào dữ liệu
        } else {
            echo "Lỗi khi tải lên hình ảnh.";
            exit;
        }
    } else {
        echo "File không phải là hình ảnh.";
        exit;
    }
} else {
    echo "Không có hình ảnh nào được tải lên.";
    exit;
}

    // Gọi phương thức store từ CourseController
    $courseController->store($data);
    
    // Chuyển hướng về trang quản lý khóa học
    header("Location: " . $_SERVER['PHP_SELF']);
    exit(); // Đảm bảo không có mã nào sau đó được thực thi
}

// 3. Cập nhật thông tin khóa học
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_course'])) {
    $course_id = $_POST['editCourseId'];
    
    // Khởi tạo mảng dữ liệu
    $data = [
        'courseName' => $_POST['editCourseName'],
        'courseDescription' => $_POST['editCourseDescription'],
        'courseDuration' => $_POST['editCourseDuration'],
        'coursePrice' => $_POST['editCoursePrice'],
    ];

    // Xử lý tải lên tệp nếu có hình ảnh mới
    if (!empty($_FILES['editCourseImage']['name'])) {
        $target_dir = "uploads/"; // Đặt thư mục tải lên của bạn
        $target_file = $target_dir . basename($_FILES["editCourseImage"]["name"]);
        move_uploaded_file($_FILES["editCourseImage"]["tmp_name"], $target_file);
        $data['courseImage'] = $target_file; // Lưu đường dẫn vào cơ sở dữ liệu
    }

    // Cập nhật khóa học bằng cách sử dụng hàm trong controller của bạn
    $courseController->update($course_id, $data);
    echo "Khóa học đã được cập nhật thành công!";
    header("Location: " . $_SERVER['PHP_SELF']);
}

// 4. Xóa một khóa học
if (isset($_GET['delete_id'])) {
    $course_id = $_GET['delete_id'];
    $courseController->destroy($course_id);
    echo "Khóa học đã được xóa thành công!";
    header("Location: " . $_SERVER['PHP_SELF']);
}
// 5. Lấy thông tin chi tiết khóa học
if (isset($_GET['course_id'])) {
    $course_id = $_GET['course_id']; // Lấy ID khóa học từ URL
    $course = $courseController->getCourseById($course_id); // Gọi phương thức để lấy thông tin khóa học
    echo json_encode($course);
}

// Đóng kết nối
mysqli_close($conn);
?>