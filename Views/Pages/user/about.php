<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Responsive Header</title>
</head>
<style>
    body {
    background-color: green;
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: green;
    padding: 10px 20px;
}

.logo img {
    width: 70px;
    object-fit: cover;
    height: 50px;
}

.search-form {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-grow: 1; /* Giúp form chiếm không gian để căn giữa */
}

.search-form input {
    width: 300px;
    border-radius: 10px;
    padding: 5px;
}

.search-form button {
    margin-left: 10px;
}

.user-actions {
    display: flex;
    gap: 10px; /* Tạo khoảng cách giữa các nút */
}

.user-actions a {
    color: white;
    text-decoration: none;
    padding: 5px 10px;
    border-radius: 5px;
}

.user-actions .btn-primary {
    background-color: #007bff;
    border: none;
}
.d-flex .btn-outline-success{
    border: 2px solid white;
    color:white
}
.user-actions .btn-secondary {
    background-color: #6c757d;
    border: none;
}
.main-content{
    color: white;
    padding-top: 100px;
    height: auto;
    background-color: black;
}
.content{
    display:flex;
    justify-content: space-between;
    gap: 20px;
    align-items: center;
}
.container h3{
    padding-top: 50px;
}
h5{
    color: green;
    font-weight: bold;
}
.blockk {
    background-color: green;
    width: 100%;
    height: 300px;
    position: relative; /* Đặt vị trí tương đối để .container02 có thể định vị tuyệt đối dựa trên nó */
}

.container02 {
    background-color: white;
    color: black;
    height:400px;
    width: 70%; /* Tùy chỉnh chiều rộng theo ý muốn */
    position: absolute; /* Định vị tuyệt đối */
    top: 50px; /* Căn chỉnh vị trí theo trục dọc */
    left: 50%; /* Canh giữa theo chiều ngang */
    transform: translateX(-50%); 
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); 
    border-radius: 10px; /* Bo tròn góc cạnh */
}
.container02 h5{
    text-align: center;
    padding-top: 10px;
}
.values{
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    padding: 40px;
    padding-left: 90px;
}
.values-1, .values-2, .values-3, .values-4{
    flex: 0 0 45%;
}
.footer{
    padding-top: 150px;
    background-color: white
}
* {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
        }

        header {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            background-color: rgba(3, 94, 24, 0.8); /* Màu nền trong suốt */
            color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: absolute; /* Header nổi trên slider */
            top: 0;
            z-index: 10;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo img {
            width: 70px;
            height: 70px;
            margin-right: 15px;
        }

        .logo h1 {
            font-size: 20px;
            color: #0afa66;
            text-transform: uppercase;
            font-weight: bold;
        }

        .nav {
            display: flex;
            justify-content: space-between;
            gap: 50px;
        }

        .nav a {
            text-decoration: none;
            color: white;
            font-size: 16px;
            font-weight: 500;
            text-transform: uppercase;
            transition: color 0.3s, transform 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav a i {
            font-size: 18px;
        }

        .nav a:hover {
            color: #0afa66;
            transform: scale(1.1);
        }

        .search-container {
            display: flex;
            align-items: center;
            position: relative;
        }

        .search-btn {
            padding: 5px 10px;
            background-color: #0afa66;
            border: none;
            border-radius: 5px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .search-btn:hover {
            background-color: #028a4f;
        }

        .search-input {
            width: 0;
            opacity: 0;
            padding: 5px 10px;
            margin-left: 10px;
            border: none;
            border-radius: 5px;
            outline: none;
            transition: width 0.3s ease, opacity 0.3s ease;
            display: inline-block;
        }

        .search-container:hover .search-input {
            width: 200px;
            opacity: 1;
        }

        .right-section {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .slider {
            padding-top: 100px;
        }
        .user-menu {
            display: none; /* Menu ẩn mặc định */
            position: absolute;
            top: 40px;
            right: 0;
            background-color: white;
            color: #333;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 150px;
            text-align: center;
            z-index: 1000;
        }

        .user-menu a {
            display: block;
            padding: 10px 0;
            color: #035e18;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .user-menu a:hover {
            background-color: #f0f0f0;
        }
        .user-icon {
            position: relative;
        }

        .user-menu {
            display: none;
            position: absolute; 
            top: 100%; 
            right: 0; 
            background-color: white;
            color: #333;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 150px;
            text-align: center;
            z-index: 1000;
        }

        .user-menu a {
            display: block;
            padding: 10px 0;
            color: #035e18;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s;
        }
</style>
<body>
<header>
        <div class="logo">
            <a href="../user/homelogin.php">
                <img src="../../Public/Assets/Image/download_logo.png" alt="Logo">
            </a>
            <h1>Học cùng L5</h1>
        </div>
        <nav class="nav">
            <a href="../user/homelogin.php">
                <i class="fas fa-home"></i> Home
            </a>
            <a href="../user/courses.php">
                <i class="fas fa-book"></i> Course
            </a>
            <a href="../user/about.php">
                <i class="fas fa-info-circle"></i> About
            </a>
        </nav>
        <div class="right-section">
            <div class="search-container">
                <button class="search-btn">Search</button>
                <input type="text" class="search-input" placeholder="Search...">
            </div>
            <div class="user-icon" id="user-icon">
                <i class="fas fa-user"></i>
                <div class="user-menu" id="user-menu">
                    <a href="../../Pages/user/login.php">Logout</a>
                </div>
            </div>
        </div>
</header>
    <div class="main-content">
        <div class="container">
            <h3>Giới thiệu về L5</h3>
            <div class="content">
                <img src="../../Public/Assets/Image/img_logo.jpg" alt="">
                <div class="text-content">
                    <h5>BẠN CÓ BIẾT?</h5>
                <p>Ngoài kia, có rất nhiều người mắc kẹt trong những công việc sai lầm, với tư duy thụ động, bị mắc vào những công việc không thú vị hoặc không mang lại cảm giác thỏa mãn. Họ đối mặt với những khủng hoảng cuộc sống liên tiếp.
                    Ở tuổi 22, họ hoang mang, không biết nên chọn con đường sự nghiệp nào.
                    Ở tuổi 28, họ bị sốc, tự hỏi làm sao có thể xây dựng gia đình và nuôi dạy con cái với mức lương hiện tại.
                    Ở tuổi 40, họ hối tiếc không biết liệu mình có đang lãng phí tuổi trẻ.</p>
                </div>
            </div>
            <p>Mọi chuyện sẽ rất khác nếu họ được định hướng công việc phù hợp, biết cách đặt cho mình một mục tiêu rõ ràng và có đầy đủ kĩ năng cần thiết để phát triển sự nghiệp.</p>
            <p>L5 tin rằng con người Việt Nam không hề thua kém gì so với con người ở bất cứ nơi đâu. Con rồng cháu tiên hoàn toàn có thể trở thành công dân toàn cầu để sánh vai cùng các cường quốc năm châu.</p>
            <p>L5 mong muốn trở thành một tổ chức góp phần tạo nên sự thay đổi đó, và việc tạo ra cộng đồng học lập trình mới chỉ là điểm bắt đầu. Chúng tôi đang nỗ lực tạo ra các khóa học có nội dung chất lượng vượt trội, giúp học viên sau khi hoàn thành khóa học có thể trở thành những lập trình viên luôn được nhiều công ty săn đón.</p>
            <div class="text-content2">
                <h5>Tầm nhìn</h5>
                <p>Trở thành công ty công nghệ giáo dục có vị thế vững vàng trên thị trường, với các sản phẩm hỗ trợ học lập trình chất lượng, thông minh và hiệu quả. L5 sẽ nổi tiếng bởi chất lượng sản phẩm vượt trội và được cộng đồng tin tưởng chứ không phải vì tiếp thị tốt.</p>
            </div>
            <div class="text-content3">
                <h5>Giá trị cốt lõi</h5>
                <p>Sự tử tế: Tử tế trong chính người L5 với nhau và tử tế với học viên là kim chỉ nam phấn đấu. Đã làm sản phẩm là phải chất lượng và chứng minh được hiệu quả, bất kể là sản phẩm miễn phí hay giá rẻ. Làm ra phải thấy muốn để người thân mình dùng.</p>
                <p>Tư duy số: Sản phẩm làm ra không phải là để vừa lòng đội ngũ trong công ty. Sản phẩm làm ra với mục tiêu cao nhất là người học thấy dễ học, được truyền cảm hứng tự học, học tới bài học cuối cùng và người học có thể tự tay làm ra những dự án bằng kiến thức đã học.</p>
                <p>Luôn đổi mới và không ngừng học: Học từ chính đối thủ, học từ những công ty công nghệ giáo dục tốt trên thế giới và luôn luôn lắng nghe mọi góp ý từ phía học viên.</p>
                <p>Tư duy bền vững: Có hai thứ đáng để đầu tư giúp mang lại thành quả tài chính tốt nhất trong dài hạn của một công ty đó là nhân viên và khách hàng.</p>
            </div>
            <div class="blockk">
                <div class="container02">
                    <h5>Bạn nhận được gì từ L5?</h5>
                    <div class="values">
                        <div class="values-1">
                            <h6>1. Sự thành thạo</h6>
                            <p>Các bài học đi đôi với thực hành, làm bài kiểm tra ngay trên trang web và bạn luôn có sản phẩm thực tế sau mỗi khóa học.</p>    
                        </div>
                        <div class="values-2">
                            <h6>2. Tính tự học</h6>
                            <p>Một con người chỉ thực sự trưởng thành trong sự nghiệp nếu họ biết cách tự thu nạp kiến thức mới cho chính mình.</p>
                        </div>
                        <div class="values-3">
                            <h6>3. Tiết kiệm thời gian</h6>
                            <p>Thay vì chật vật vài năm thì chỉ cần 4-6 tháng để có thể bắt đầu công việc đầu tiên với vị trí Intern tại công ty IT.</p>
                        </div>
                        <div class="values-4">
                            <h6>4. Làm điều quan trọng</h6>
                            <p>Chỉ học và làm những điều quan trọng để đạt được mục tiêu đi làm được trong thời gian ngắn nhất.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
        <?php include '../../Layouts/footer.html' ?>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const userIcon = document.getElementById('user-icon');
            const userMenu = document.getElementById('user-menu');
    
            // Toggle hiển thị menu khi nhấn vào icon
            userIcon.addEventListener('click', function (event) {
                event.stopPropagation(); // Ngăn chặn sự kiện click lan ra ngoài
                userMenu.style.display = userMenu.style.display === 'block' ? 'none' : 'block';
            });
    
            // Ẩn menu khi nhấn ra ngoài
            document.addEventListener('click', function () {
                userMenu.style.display = 'none';
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
