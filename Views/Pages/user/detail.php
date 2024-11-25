<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết khoá học</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
body {
    margin: 0;
    padding: 0;
    background-color: #f9f9f9;
    font-family: Arial, sans-serif;

}

.course-detail {
    display: flex;
    justify-content: space-between;
    margin: 20px auto;
    max-width: 1200px;
}

.content {
    width: 65%;
}

.course-title {
    font-size: 35px;
    font-weight: bold;
}
.divider{
    border-top: 6px solid #32c787;
    width: 40px;
}
/*  */
.icon-container {
    display: flex;
    justify-content: space-around;
}

.icon-item {
    text-align: center;
    color: #333;
}
.icon-item p {
    padding-top:10px ;
    margin: 0;
    font-size: 14px;
}
.icon-circle {
    width: 80px;
    height: 80px;
    background-color: #404345;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    transition: background-color 0.3s ease, transform 0.7s ease; /* Hiệu ứng chuyển động */
}

.icon-item:hover .icon-circle {
    background-color: #32c787; /* Màu xanh đậm hơn */
    
}
.icon-circle i {
    font-size: 24px;
    color: #fff;
}

.learning-outcomes h2 {
    font-size: 20px;
    margin-bottom: 10px;
}

.outcomes-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.outcomes-list li {
    margin: 5px 0;
    display: flex;
    align-items: center;
 
}

.outcomes-list li::before {
    content: "✔";
    color: #32c787;
    margin-right: 10px;
}
.dicription{
    display: flex;
    gap: 10px;
    font-size: 16px;
   
}
.course-content h2 {
    font-size: 20px;
}
/* Tổng quát cho nội dung khóa học */
.section-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin-bottom: 10px;
    padding: 15px;      
    transition: background-color 0.3s ease;
    position: relative; /* Để hỗ trợ ::before */
}

.section-header::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 5px; /* Độ rộng của dải màu xanh */
    background-color: #32c787; /* Màu xanh */
    border-radius: 5px 0 0 5px; /* Bo tròn chỉ góc trái */
}

.section-header:hover {
    background-color: #e0f7fa; /* Hiệu ứng hover */
}

.section-header h2 {
    font-size: 1rem;
    margin: 0;
    color: #333;
}

.section-header .toggle-icon {
    font-size: 32px; /* Tăng kích thước dấu cộng */
    color: #32c787;
    transition: transform 0.3s ease;
}

/* Nội dung chi tiết */
.section-content {
    display: none;
    padding: 15px;
    border: 1px solid #ddd;
    border-top: none;
    background-color: #fff;
    border-radius: 0 0 5px 5px;
}

.section-content ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.section-content li {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    border-bottom: 1px solid #f0f0f0;
}

.section-content li:last-child {
    border-bottom: none;
}

.lesson-title {
    color: #333;
    font-size: 0.9rem;
}

.lesson-duration {
    color: #777;
    font-size: 0.9rem;
}

/* Khi mở mục */
.section-header.open .toggle-icon {
    transform: rotate(45deg); /* Xoay dấu cộng thành dấu trừ */
}

/* Hiển thị nội dung khi được mở */
.section-header.open .toggle-icon,
.section-item.open .section-toggle {
    transform: rotate(45deg); /* Dấu trừ khi mở */
}
.section-header:hover, .section-item:hover {
    background-color: #e0f7fa; /* Màu sáng hơn khi hover */
}
/*  */
.sidebar {
    width: 30%;
    text-align: center;
    position: fixed;
    left: 850px;
    top: 125px;
}

.video-preview {
    background: #e3e3e3;
    border-radius: 8px;
    padding: 15px;
}

.video-preview img {
    width: 100%;
    border-radius: 8px;
}

.video-preview p {
    margin: 10px 0 0;
    color: #555;
    font-size: 0.9rem;
}

.price p {
    font-size: 1.5rem;
    font-weight: bold;
   
    margin: 10px 0;
}
.register-btn {
  background-color: #32c787; /* Màu nền xanh lá */
  color: #fff; /* Màu chữ trắng */
  border: none; /* Xóa viền */
  border-radius: 5px; /* Góc bo tròn */
  padding: 10px 20px; /* Khoảng cách bên trong */
  font-size: 16px; /* Cỡ chữ */
  font-weight: bold; /* Đậm chữ */
  cursor: pointer; /* Con trỏ khi rê chuột */
  transition: all 0.3s ease; /* Hiệu ứng mượt khi hover */
}

.register-btn:hover {
  background-color: #22cd8b; /* Màu xanh lá đậm hơn khi hover */
  transform: scale(1.05); /* Tăng nhẹ kích thước */
}

.register-btn:active {
  background-color: #1e7e34; /* Màu xanh lá tối khi nhấn */
  transform: scale(0.95); /* Giảm nhẹ kích thước khi nhấn */
}
</style>
</head>
<body>
<?php include '../../Layouts/headerLogin.html'?>
    <div class="course-detail">
        <div class="content">
            <h1 class="course-title">Python Cơ bản</h1>
            <div class="divider"></div>
            <p class="course-description">
                Học cách lập trình và phân tích dữ liệu bằng Python. Phát triển các chương trình để thu thập, làm sạch, phân tích và trực quan hóa dữ liệu.
            </p>
            <div class="icon-container">
                <div class="icon-item">
                    <div class="icon-circle">
                        <i class="fas fa-flag"></i>
                    </div>
                    <p>60 bài học</p>
                </div>
                <div class="icon-item">
                    <div class="icon-circle">
                        <i class="fas fa-clock"></i>
                    </div>
                    <p>5h 02 phút</p>
                </div>
                <div class="icon-item">
                    <div class="icon-circle">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <p>Tự học</p>
                </div>
                <div class="icon-item">
                    <div class="icon-circle">
                        <i class="fas fa-sitemap"></i>
                    </div>
                    <p>Kết cấu rõ ràng</p>
                </div>
                <div class="icon-item">
                    <div class="icon-circle">
                        <i class="fas fa-sync-alt"></i>
                    </div>
                    <p>Nội dung cập nhật liên tục</p>
                </div>
            </div>
            <div class="learning-outcomes">
                <h2>Bạn sẽ học được gì?</h2>
                <ul class="outcomes-list">
                    <li> Hiểu cách cài đặt và sử dụng Python trên các hệ điều hành phổ biến</li>
                    <li> Nắm vững các khái niệm cơ bản trong lập trình Python (biến, vòng lặp, hàm, v.v.)</li>
                    <li> Thành thạo làm việc với các thư viện như NumPy, Pandas, và Matplotlib để phân tích dữ liệu</li>
                    <li> Xây dựng các dự án nhỏ để áp dụng kiến thức thực tế</li>
                    <li> Biết cách gỡ lỗi và tối ưu hóa mã Python</li>
                    <li> Sẵn sàng học nâng cao với các chủ đề như xử lý tệp, API, và trí tuệ nhân tạo</li>
                </ul>
            </div>
            <div class="course-content">
                <h2>Nội dung khóa học</h2>
                <div class="dicription">
                    <p>• 6 chương </p>
                    <p>• 40 bài học</p>
                    <p>• Thời lượng 2 giờ 30 phút</p>
                </div>
                    <div class="section-header" onclick="toggleSection(this)">
                        <h2>1. Giới thiệu</h2>
                        <span class="toggle-icon">+</span>
                    </div>
                    <div class="section-content">
                        <ul>
                            <li>
                                <span class="lesson-title">Làm quen với Python và môi trường lập trình </span>
                                <span class="lesson-duration">10:00</span>
                            </li>
                            <li>
                                <span class="lesson-title">Thiết lập Python trên hệ điều hành của bạn</span>
                                <span class="lesson-duration">15:00</span>
                            </li>
                        </ul>
                    </div>
                    <!-- Add more sections like this -->
                    <div class="section-header" onclick="toggleSection(this)">
                        <h2>2. Các khái niệm cơ bản</h2>
                        <span class="toggle-icon">+</span>
                    </div>
                    <div class="section-content">
                        <ul>
                            <li>
                                <span class="lesson-title">Biến và kiểu dữ liệu trong Python</span>
                                <span class="lesson-duration">15:00</span>
                            </li>
                            <li>
                                <span class="lesson-title">Vòng lặp và câu lệnh điều kiện</span>
                                <span class="lesson-duration">20:00</span>
                            </li>
                            <li>
                                <span class="lesson-title">Hàm và cách tổ chức mã nguồn</span>
                                <span class="lesson-duration">15:00</span>
                            </li>
                        </ul>
                    </div>
                    <!--  -->
                    <div class="section-header" onclick="toggleSection(this)">
                        <h2>3. Làm việc với dữ liệu</h2>
                        <span class="toggle-icon">+</span>
                    </div>
                    <div class="section-content">
                        <ul>
                            <li>
                                <span class="lesson-title">Xử lý tệp văn bản và đọc dữ liệu từ tệp CSV</span>
                                <span class="lesson-duration">15:00</span>
                            </li>
                            <li>
                                <span class="lesson-title">Làm quen với thư viện NumPy để xử lý mảng</span>
                                <span class="lesson-duration">20:00</span>
                            </li>
                            <li>
                                <span class="lesson-title">Chuyển đổi và thao tác dữ liệu cơ bản</span>
                                <span class="lesson-duration">15:00</span>
                            </li>
                        </ul>
                    </div>
                    <!--  -->
                    <div class="section-header" onclick="toggleSection(this)">
                        <h2>4. Phân tích dữ liệu với Pandas</h2>
                        <span class="toggle-icon">+</span>
                    </div>
                    <div class="section-content">
                        <ul>
                            <li>
                                <span class="lesson-title">Đọc và xử lý dữ liệu từ Excel hoặc CSV bằng Pandas </span>
                                <span class="lesson-duration">15:00</span>
                            </li>
                            <li>
                                <span class="lesson-title">Thao tác nhóm, lọc, và tổng hợp dữ liệu </span>
                                <span class="lesson-duration">25:00</span>
                            </li>
                        </ul>
                    </div>
                    <!--  -->
                    <div class="section-header" onclick="toggleSection(this)">
                        <h2>5. Trực quan hóa dữ liệu</h2>
                        <span class="toggle-icon">+</span>
                    </div>
                    <div class="section-content">
                        <ul>
                            <li>
                                <span class="lesson-title">Sử dụng Matplotlib để tạo biểu đồ cơ bản (line, bar, scatter)</span>
                                <span class="lesson-duration">15:00</span>
                            </li>
                            <li>
                                <span class="lesson-title">Sử dụng Seaborn để trực quan hóa dữ liệu nâng cao</span>
                                <span class="lesson-duration">20:00</span>
                            </li>
                            <li>
                                <span class="lesson-title">Tùy chỉnh biểu đồ và xuất báo cáo trực quan</span>
                                <span class="lesson-duration">10:00</span>
                            </li>
                        </ul>
                    </div>
                    <!--  -->
                    <div class="section-header" onclick="toggleSection(this)">
                        <h2>6. Dự án thực tế</h2>
                        <span class="toggle-icon">+</span>
                    </div>
                    <div class="section-content">
                        <ul>
                            <li>
                                <span class="lesson-title">Xây dựng ứng dụng phân tích dữ liệu cơ bản với Python</span>
                                <span class="lesson-duration">30:00</span>
                            </li>
                            <li>
                                <span class="lesson-title">Tích hợp các thư viện để xử lý và trực quan hóa dữ liệu</span>
                                <span class="lesson-duration">20:00</span>
                            </li>
                            <li>
                                <span class="lesson-title">Tối ưu mã nguồn và trình bày kết quả phân tích</span>
                                <span class="lesson-duration">12:00</span>
                            </li>
                        </ul>
                    </div>
            </div>
        </div>
        <div class="sidebar">
            <div class="video-preview">
                <iframe 
                    src="https://www.youtube.com/embed/8BDIkM6a7nE" 
                    title="Giới thiệu khóa học" 
                    frameborder="0" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                    allowfullscreen>
                </iframe>
                <p>Xem giới thiệu khóa học</p>
            </div>
            <div class="price">
                <p>Miễn phí</p>
                <button class="register-btn">Đăng ký học</button> 
            </div>    
        </div>
    </div>
    <script>
    function toggleSection(element) {
        const content = element.nextElementSibling; // Nội dung chi tiết
        const icon = element.querySelector('.toggle-icon'); // Biểu tượng dấu cộng
        if (content.style.display === "block") {
            content.style.display = "none";
            icon.textContent = "+"; // Chuyển lại thành dấu cộng
        } else {
            content.style.display = "block";
            icon.textContent = "-"; // Hiển thị dấu trừ
        }
    }
    
    </script>
</body>
</html>
