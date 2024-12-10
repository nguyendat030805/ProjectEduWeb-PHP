<?php
require_once('C:\xampp\htdocs\ProjectWeb-TD\ProjectEduWeb-PHP\Model\coursemodel.php');
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
        $video = $data['courseURL'];
        $prices = $data['coursePrice'];
        $type = $data['courseType'];
        return $this->courseModel->createCourse($title, $images, $descriptions, $video, $prices,$type);
    }
    // 4. Cập nhật thông tin khóa học
    public function update($course_id, $data) {
        $title = $data['courseName'];
        $images = $data['courseImage']; // Giả sử bạn có trường hình ảnh
        $descriptions = $data['courseDescription'];
        $video = $data['courseURL'];
        $prices = $data['coursePrice'];
        $type = $data['courseType'];
        return $this->courseModel->updateCourse($course_id, $title, $images, $descriptions, $video, $prices, $type);
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
        'courseURL' => $_POST['courseURL'],
        'courseImage' => $_POST['courseImage'],
        'coursePrice' => $_POST['coursePrice'],
        'courseType' => $_POST['courseType'],
    ];

    // Xử lý hình ảnh


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
        'coursePrice' => $_POST['editCoursePrice'],
        'courseImage' => $_POST['editCourseImage'],
        'courseURL' => $_POST['editCourseURL'],
        'courseType' => $_POST['courseType'],
    ];
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
    
}

// Đóng kết nối
// mysqli_close($conn);
?>