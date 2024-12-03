<?php
// Bao gồm file config hoặc bất kỳ tệp nào cần thiết
require_once('C:\xampp\htdocs\php-project\ProjectEduWeb-PHP\Views\Public\config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách bài học</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #66bb6a, #388e3c);
            color: #fff;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 40px 0;
        }
        h1 {
            text-align: center;
            font-size: 36px;
            margin-bottom: 30px;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
        }
        .lesson-card {
            display: flex;
            align-items: center;
            background-color: #ffffff;
            color: #333;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease-in-out;
        }
        .lesson-card:hover {
            transform: translateY(-10px);
        }
        .lesson-card img {
            width: 220px;
            height: 120px;
            object-fit: contain;
        }
        .lesson-card-content {
            padding: 20px;
            flex-grow: 1;
        }
        .lesson-card-content h3 {
            margin-top: 0;
            font-size: 24px;
        }
        .lesson-card-content p {
            font-size: 16px;
            margin: 5px 0;
        }
        .lesson-card-content .play-btn {
            background-color: #388e3c;
            padding: 10px 20px;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        .lesson-card-content .play-btn:hover {
            background-color: #66bb6a;
        }
        .lesson-list {
            margin-top: 30px;
        }
        .lesson-list a {
            text-decoration: none;
            color: #fff;
            font-size: 18px;
            display: block;
            padding: 10px 0;
            transition: color 0.3s;
        }
        .lesson-list a:hover {
            color: #c8e6c9;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            padding: 20px;
            background-color: #2c6b2f;
            color: #fff;
        }
        .text-warning {
            color: #FFCC00;
        }
        /* Form đánh giá */
        .rating-form {
            margin-top: 20px;
            display: flex;
            align-items: center;
        }
        .rating-form input {
            display: none;
        }
        .rating-form label {
            font-size: 30px;
            cursor: pointer;
            color: #ccc; /* Màu mặc định của sao */
            transition: color 0.3s ease;
        }
        .rating-form input:checked ~ label,
        .rating-form input:hover ~ label,
        .rating-form input:checked ~ label:hover {
            color: #FFCC00; /* Màu vàng khi chọn hoặc hover */
        }
        .rating-form button {
            background-color: #388e3c;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 10px;
        }
        .rating-form button:hover {
            background-color: #66bb6a;
        }
        input[type="radio"]:nth-child(n+6) {
            display: none; /* Ẩn các sao từ 6 trở đi */
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>Danh sách các bài học</h1>
        
        <div class="lesson-list">
            <?php if (isset($lessons) && !empty($lessons)) : ?>
                <?php foreach ($lessons as $lesson) : ?>
                    <div class="lesson-card">
                        <img src="Public/Assets/Image/img_logo.jpg" alt="<?= htmlspecialchars($lesson['title']); ?>">
                        <div class="lesson-card-content">
                            <h3><?= htmlspecialchars($lesson['title']); ?></h3>
                            <p>Thời gian: <?= htmlspecialchars($lesson['duration']); ?> phút</p>
                            <p>Chương: <?= htmlspecialchars($lesson['description']); ?></p>
                            <p>Thể loại: <?= htmlspecialchars($lesson['content_type']); ?></p>
                            <button class="play-btn">
                                <a href="<?= htmlspecialchars($lesson['content_url']); ?>" target="_blank" style="color: #fff;">Xem bài học</a>
                            </button>

                            
                            <!-- Form đánh giá -->
                            <div class="rating-form">
                                <label for="star1-<?= $lesson['lesson_id']; ?>">★</label>
                                <input type="radio" id="star1-<?= $lesson['lesson_id']; ?>" name="rating-<?= $lesson['lesson_id']; ?>" value="1">
                                
                                <label for="star2-<?= $lesson['lesson_id']; ?>">★</label>
                                <input type="radio" id="star2-<?= $lesson['lesson_id']; ?>" name="rating-<?= $lesson['lesson_id']; ?>" value="2">
                                
                                <label for="star3-<?= $lesson['lesson_id']; ?>">★</label>
                                <input type="radio" id="star3-<?= $lesson['lesson_id']; ?>" name="rating-<?= $lesson['lesson_id']; ?>" value="3">
                                
                                <label for="star4-<?= $lesson['lesson_id']; ?>">★</label>
                                <input type="radio" id="star4-<?= $lesson['lesson_id']; ?>" name="rating-<?= $lesson['lesson_id']; ?>" value="4">
                                
                                <label for="star5-<?= $lesson['lesson_id']; ?>">★</label>
                                <input type="radio" id="star5-<?= $lesson['lesson_id']; ?>" name="rating-<?= $lesson['lesson_id']; ?>" value="5">
                                
                                <button type="submit">Gửi đánh giá</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p class="no-data">Không có bài học nào.</p>
            <?php endif; ?>
        </div>
    </div>
    <?php include 'Views/Layouts/footer.html'; ?> 
</body>
</html>
