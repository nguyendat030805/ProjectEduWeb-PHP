
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết thanh toán</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
    /* Css của phần form thanh toán */
    body {
        margin: 0;
        font-family: Arial, sans-serif;
    }
    .form-select:focus, .form-control:focus {
        border-color: #fff;
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
    }
    .outer-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: white;
        padding: 20px;
    }

    .form-container {
        max-width: 700px;
        width: 100%;
        background-color: #fff;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .logo-title {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px; /* Giảm khoảng cách giữa logo và tiêu đề */
        margin-bottom: 15px;
    }

    .logo-title img {
        height: 150px;
    }

    .logo-title h1 {
        font-weight: bold;
        font-size: 2rem;
        color: #32c787;
        margin: 0;
    }

    .bg-highlight {
        background-color: green;
        color: #fff;
        text-align: center;
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }
    .form-row {
        display: flex;
        gap: 10px;
        margin-bottom: 15px;
    }

    .form-row .form-group {
        flex: 1;
    }

    .mb-4 {
        display: flex;
        flex-direction: column;
    }

    .group {
        display: flex;
        flex-direction: column;
        padding-top: 10px;
        box-sizing: border-box;
    }

    .highlight {
        text-decoration: line-through;
        color: black;
    }

    .input-group {
        display: flex;
        align-items: center;
    }
    .input-group-text {
        background-color: #f1f1f1;
        border-color: #ccc;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 40px;
        height: 40px;
        font-size: 18px;
    }
    .price-info {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: flex-start;
        height: 60px;
    }

    .price-info .highlight {
        text-decoration: line-through;
        color: black;
    }

    .price-info .discount {
        font-weight: bold;
    }
    .container-form{
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
    .left-form .form-row{
        display: flex;
        flex-direction: column;
    }
    .right-form .form-row{
        display: flex;
        flex-direction: column;
    }
    /* Kết thúc form thanh toán */

    /* Css của phần Thanh toán thành công */
    .success-box {
        width: 500px;
        background-color: #e6ffe6; /* Light green box */
        border: 2px solid #2eb82e; /* Green border */
        border-radius: 10px;
        height: 250px;
        padding: 20px;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .success-title {
        font-size: 20px;
        color: #2d862d; /* Dark green text */
        font-weight: bold;
    }
    .success-icon {
        color: #2eb82e; /* Green check icon */
        font-size: 50px;
        margin: 10px 0;
    }
    .form-container.blur {
        filter: blur(10px); /* Tăng độ mờ */
        pointer-events: none; /* Ngăn tương tác */
    }
    .success-box {
        display: none;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 500px;
        background-color: #e6ffe6;
        border: 2px solid #2eb82e;
        border-radius: 10px;
        padding: 20px;
        text-align: center;
        z-index: 1000;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        opacity: 0; /* Hiệu ứng ẩn ban đầu */
        transition: opacity 0.3s ease-in-out;
    }
    .success-box.active {
        display: block;
        opacity: 1; /* Hiển thị với hiệu ứng */
    }
    .success-icon {
        color: #2eb82e;
        font-size: 50px;
        margin-bottom: 15px;
    }
    .success-title {
        font-size: 20px;
        color: #2d862d;
        font-weight: bold;
    }
    .success-close {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: #2d862d;
        color: white;
        border: none;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        font-size: 18px;
    }
    .success-close:hover {
        background-color: #1e7d32;
    }
    /* Kết thúc phần CSS thanh toán thành công */
</style>
</head>
<body>
    <?php
    // Biến $success xác định trạng thái thanh toán
    $success = false;

    // Kiểm tra nếu form được gửi
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $success = true; // Giả định thanh toán thành công
    }
    ?>
  <div class="outer-container">
        <div class="form-container <?php echo $success ? 'blur' : ''; ?>">
            <div class="logo-title">
                <img src="/Public/image/logo.png" alt="Logo">
            </div>
            <div class="bg-highlight">
                <h2 class="h6 mb-0">Chi tiết thanh toán</h2>
            </div>
            <form method="POST" action="">
                <div class="container-form">
                    <div class="left-form">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name" class="form-label">Tên khách hàng</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($_SESSION['username'] ?? '') ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="phone" class="form-label">Số điện thoại</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    <input type="text" class="form-control" id="phone" name="phone" value="<?= htmlspecialchars($_SESSION['user_phone'] ?? '') ?>" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="right-form">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="email" class="form-label">Nhập email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($_SESSION['email'] ?? '') ?>" readonly>
                                </div>
                            </div>
                            <div class="group">
                                <div class="form-group">
                                    <label class="form-label">Khóa học:</label>
                                    <span class="selected-course">HTML CSS Pro</span>
                                </div>
                                <div class="price-info">
                                    <p class="mb-0">Giá gốc: <span class="highlight">2.900.000đ</span></p>
                                    <p class="mb-0">Ưu đãi hôm nay: <span class="discount">1.900.000đ</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-outline-danger" onclick="location.href='./detail.php'">Hủy</button>
                    <button type="submit" name="submit_payment" class="btn btn-outline-success">Thanh toán</button>
                </div>
            </form>
        </div>
        <!-- Box thanh toán thành công -->
          <?php 
                $course_id = $_GET['course_id'];
                $user_id = $_GET['user_id'];
             ?>
       <?php if ($success): ?>
    <div class="success-box active">
        <button class="success-close" 
                onclick="window.location.href = 'http://localhost:8080/ProjectWeb-TD/ProjectEduWeb-PHP/Views/Pages/user/subject.php?course_id=<?php echo $course_id; ?>&user_id=<?php echo $user_id; ?>';">×</button>
        
        <div class="success-icon">
            <i class="bi bi-check-circle-fill"></i>
        </div>
        <div class="success-title">
            Thanh toán khóa học thành công
        </div>
    </div>
<?php endif; ?>
    </div>
</body>
</html>