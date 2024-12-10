
CREATE DATABASE l5;
USE l5;
-- ----------Courses----------------------
CREATE TABLE Courses (
    course_id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(250),              
    images VARCHAR(255),             
    descriptions TEXT,                   
    video_url VARCHAR(255),
    original_price DECIMAL(10, 2),                 
    types ENUM('Pro', 'Free')         
);

-- Chèn dữ liệu bảng courses

-- Khóa Học Pro
INSERT INTO Courses (title, images, descriptions, video_url, original_price, types)
VALUES 
('HTML CSS Pro', 'https://files.fullstack.edu.vn/f8-prod/courses/15/62f13d2424a47.png', 'Khóa học HTML và CSS nâng cao', 'https://www.youtube.com/embed/SHhUikA6OiQ?si=0a29iQUk2qPg5XbD', 2500000, 'Pro'),
('Sass', 'https://files.fullstack.edu.vn/f8-prod/courses/27/64e184ee5d7a2.png', 'Khóa học Sass nâng cao', 'https://www.youtube.com/embed/u9IeAoj3UEo?si=7A7TLmSPgawnpTFS', 400000, 'Pro'),
('JavaScript Pro', 'https://files.fullstack.edu.vn/f8-prod/courses/19/66aa28194b52b.png', 'Khóa học JavaScript nâng cao', 'https://www.youtube.com/embed/0SJE9dYdpps?si=cy8FHP0qPCuQSck_', 3299000, 'Pro'),
('ReactJS Pro', 'https://files.fullstack.edu.vn/f8-prod/courses/13/13.png', 'Khóa học ReactJS nâng cao', 'https://www.youtube.com/embed/your_video_id4', 3000000, 'Pro'),
('NodeJS Pro', 'https://files.fullstack.edu.vn/f8-prod/courses/6.png', 'Khóa học NodeJS nâng cao', 'https://www.youtube.com/embed/your_video_id5', 2800000, 'Pro'),
('Python Pro', 'https://media.imgcdn.org/repo/2023/03/learn-python-programming-tutorial/learn-python-programming-tutorial-pro-logo.png', 'Khóa học Python nâng cao', 'https://www.youtube.com/embed/your_video_id6', 4000000, 'Pro'),
('Java Pro', 'https://magazin.javapro.io/i/jp256.png', 'Khóa học Java nâng cao', 'https://www.youtube.com/embed/your_video_id7', 3500000, 'Pro'),
('PHP Pro', 'https://fullstack.edu.vn/courses/lap-trinh-c-co-ban-toi-nang-cao', 'Khóa học PHP nâng cao', 'https://www.youtube.com/embed/your_video_id8', 2200000, 'Pro');

-- Khóa Học Miễn Phí
INSERT INTO Courses (title, images, descriptions, video_url, original_price, types)
VALUES 
('Kiến Thức Nhập Môn IT', 'https://files.fullstack.edu.vn/f8-prod/courses/7.png', 'Khóa học giới thiệu về IT', 'https://www.youtube.com/embed/your_video_id9', 0, 'Free'),
('Lập Trình C++ Cơ Bản', 'https://files.fullstack.edu.vn/f8-prod/courses/21/63e1bcbaed1dd.png', 'Khóa học lập trình C++ cơ bản', 'https://www.youtube.com/embed/your_video_id10', 0, 'Free'),
('HTML, CSS Cơ Bản', 'https://files.fullstack.edu.vn/f8-prod/courses/2.png', 'Khóa học HTML, CSS từ cơ bản đến nâng cao', 'https://www.youtube.com/embed/your_video_id11', 0, 'Free'),
('Responsive Với Grid System', 'https://files.fullstack.edu.vn/f8-prod/courses/3.png', 'Khóa học về responsive với Grid System', 'https://www.youtube.com/embed/your_video_id12', 0, 'Free'),
('Lập Trình JavaScript Cơ Bản', 'https://files.fullstack.edu.vn/f8-prod/courses/1.png', 'Khóa học JavaScript cơ bản', 'https://www.youtube.com/embed/your_video_id13', 0, 'Free'),
('Lập Trình Python Cơ Bản', 'https://e7.pngegg.com/pngimages/372/490/png-clipart-python-pro-bicycle-vordingborg-bhs-almeborg-bornholm-logo-bicycle-mammal-cat-like-mammal.png', 'Khóa học Python cơ bản', 'https://www.youtube.com/embed/your_video_id14', 0, 'Free'),
('Lập Trình Java Cơ Bản', 'https://images.javatpoint.com/core/images/java-logo1.png', 'Khóa học Java cơ bản', 'https://www.youtube.com/embed/your_video_id15', 0, 'Free'),
('Git & GitHub Cơ Bản', 'https://github.blog/wp-content/uploads/2024/07/github-logo.png', 'Khóa học Git và GitHub cơ bản', 'https://www.youtube.com/embed/your_video_id16', 0, 'Free');

-- ----------Users----------------------
CREATE TABLE Users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255),
    email VARCHAR(255) unique,
    phone CHAR(10),
    password CHAR(255),
    role ENUM('User', 'Admin') default 'User'
);
select * from Users;

CREATE TABLE Enrollments (
    enrollment_id INT PRIMARY KEY AUTO_INCREMENT,
    date DATETIME,
    user_id INT,
    course_id INT,
    FOREIGN KEY (user_id) REFERENCES Users(user_id),
    FOREIGN KEY (course_id) REFERENCES Courses(course_id)
);
CREATE TABLE Payments (
    payment_id INT PRIMARY KEY AUTO_INCREMENT,
    status VARCHAR(50),
    payment_date DATETIME,
    user_id INT,
    course_id INT,
    FOREIGN KEY (user_id) REFERENCES Users(user_id),
    FOREIGN KEY (course_id) REFERENCES Courses(course_id)
);
-- ----------Lesson---------------------- 
CREATE TABLE Chapters (
    chapter_id INT PRIMARY KEY AUTO_INCREMENT,
    chapter_title VARCHAR(255),
    course_id INT,
    FOREIGN KEY (course_id) REFERENCES Courses(course_id) ON DELETE CASCADE
);
-- select*from Chapters_Course_Detail;
CREATE TABLE Lessons (
    lesson_id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255),
    content_url VARCHAR(255),
    description TEXT,
    course_id INT,
    chapter_id INT,
    FOREIGN KEY (course_id) REFERENCES Courses(course_id) ON DELETE CASCADE,
    FOREIGN KEY (chapter_id) REFERENCES Chapters(chapter_id) ON DELETE CASCADE
);
-- Chèn các chương cho khóa học "HTML CSS Pro"
INSERT INTO Chapters (chapter_title, course_id) VALUES
('Giới thiệu', 1),
('HTML cơ bản', 1),
('CSS cơ bản', 1),
('HTML nâng cao', 1),
('CSS nâng cao', 1),
('Dự án thực tế', 1);

-- Chèn bài học vào bảng Course_Detail (thuộc khóa học HTML CSS Pro)
INSERT INTO Lessons (title, content_url, description, course_id, chapter_id) VALUES
('Giới thiệu về khóa học', 'https://www.youtube.com/embed/R6plN3FvzFY?si=52XH97u2XBZhmz83', 'Giới thiệu tổng quan về khóa học HTML CSS Pro', 1, 1),
('HTML là gì?', 'https://www.youtube.com/embed/8AN4u5P08AA?si=Z0eKEjxFr5OWK_Pu', 'Tìm hiểu về HTML và cách sử dụng', 1, 2),
('Cấu trúc cơ bản của trang HTML', 'https://www.youtube.com/embed/LYnrFSGLCl8?si=6M67sNKAUAvQ7ZKr', 'Học về cấu trúc cơ bản của một trang HTML', 1, 2),
('CSS là gì?', 'https://www.youtube.com/embed/NsSsJTg29oE?si=oh6sTyX0dDREZppp', 'Giới thiệu về CSS và cách sử dụng', 1, 3),
('Cách liên kết CSS với HTML', 'https://example.com/css_linking.mp4', 'Hướng dẫn cách liên kết CSS với HTML', 1, 3),
('Thẻ HTML nâng cao', 'https://www.youtube.com/embed/AzmdwZ6e_aM?si=gLHTnQGC-VTXSDUi', 'Học về các thẻ HTML nâng cao', 1, 4),
('Dựng khung cho Form đăng ký', 'https://www.youtube.com/embed/8AN4u5P08AA?si=Pv9TL8qKVEyYU0xW', 'Cách tạo form đăng ký', 1, 4),
('CSS Layout và Flexbox', 'https://www.youtube.com/embed/bVUN6nS82k8?si=LASA28QQ9V25qKX6', 'Giới thiệu về CSS Layout và Flexbox', 1, 5),
('Giới thiệu dự án The Band ', 'https://www.youtube.com/embed/RPHBgBsw6Xg?si=wNOBc3-Qm6jodgBJ', 'Thực hành cắt HTML CSS cơ bản | Phân tích giao diện web', 1, 5),
('Dựng form mua vé ', 'https://www.youtube.com/embed/7yKMQGE0x5M?si=pqzgXGg2Y5V6d5Mm', 'Dự án thực tế: Xây dựng trang web cá nhân từ A-Z', 1, 6);


-- Chèn các chương cho khóa học Pro "Sass" 
INSERT INTO Chapters (chapter_title, course_id) VALUES
('Giới thiệu về Sass', 2),
('Cài đặt và thiết lập', 2),
('Biến và toán tử trong Sass', 2),
('Mixins và Functions', 2),
('Thực hành và dự án', 2);

-- Chèn bài học vào bảng Course_Detail (thuộc khóa học Sass)
INSERT INTO Lessons (title, content_url, description, course_id, chapter_id) VALUES
('Giới thiệu về Sass', 'https://www.youtube.com/embed/pXbA0Nab9UE?si=BVVfY03ztq5w8-SS', 'Giới thiệu về Sass và các tính năng nổi bật', 2, 7),
('Cài đặt Sass', 'https://www.youtube.com/embed/_mN4ELylI-Q?si=lvBWA2Ubqnx4sL-S', 'Hướng dẫn cài đặt và thiết lập môi trường Sass', 2, 8),
('Extensions trong Sass', 'https://www.youtube.com/embed/wxnI6j2U9SE?si=qBvuDFHecDo9kDcz', 'Học cách sử dụng extensions trong Sass', 2, 9),
('Function tử trong Sass', 'https://www.youtube.com/embed/CinjLzKFpvY?si=zDac748F9um9PmtC', 'Giới thiệu về functions trong Sass', 2, 9),
('Mixins trong Sass', 'https://www.youtube.com/embed/RHm2LKjGZGI?si=Ds_dpMxvTNmENi-K', 'Cách sử dụng mixins để tái sử dụng mã CSS', 2, 10),
('Button trong Sass', 'https://www.youtube.com/embed/fzt73yr_f_w?si=-bKAFuSUOt1G7VMj', 'Hướng dẫn tạo và sử dụng Button trong Sass', 2, 10),
('Dự án Sass', 'https://www.youtube.com/embed/C00FEX0kLrc?si=Z_8AT-gPWnnEJhOL', 'Thực hành và dự án thực tế với Sass', 2, 11);

-- Chèn các chương cho khóa học "JavaScript Pro"
INSERT INTO Chapters (chapter_title, course_id) VALUES
('Giới thiệu', 3),
('Các khái niệm cơ bản', 3),
('Làm việc với DOM', 3),
('Xử lý sự kiện', 3),
('Lập trình hướng đối tượng', 3),
('AJAX và Fetch API', 3),
('Dự án thực tế', 3);

-- Chèn bài học vào bảng Course_Detail (thuộc khóa học "JavaScript Pro")
INSERT INTO Lessons (title, content_url, description, course_id, chapter_id) VALUES
('Giới thiệu về JavaScript và môi trường lập trình', 'https://www.youtube.com/embed/-jV06pqjUUc?si=i0_PyQhBhPZyNLQo', 'Giới thiệu về JavaScript và môi trường phát triển', 3, 12),
('Cài đặt môi trường và các công cụ hỗ trợ', 'https://www.youtube.com/embed/efI98nT8Ffo?si=GlAQ4M2OJ7iCgYov', 'Hướng dẫn cài đặt môi trường phát triển và các công cụ hỗ trợ', 3, 12),
('Biến, kiểu dữ liệu và toán tử', 'https://www.youtube.com/embed/SZb-N7TfPlw?si=vAntZw6G6Ji4YFmZ', 'Học về biến, kiểu dữ liệu và các toán tử trong JavaScript', 3, 13),
('Câu lệnh điều kiện và vòng lặp', 'https://www.youtube.com/embed/9MpHrdWBdxg?si=Kn3T6DW3tK7u4cY7', 'Giới thiệu về câu lệnh điều kiện và vòng lặp trong JavaScript', 3, 13),
('Làm việc với DOM: Phần 1', 'https://www.youtube.com/embed/gETNXKi3l_U?si=b_lWcc8tGPoCv9Ag', 'Học cách làm việc với Document Object Model (DOM)', 3, 14),
('Làm việc với DOM: Phần 2', 'https://www.youtube.com/embed/OQkUwdVvul8?si=-_GSbUczChJgkCRB', 'Tiếp tục học cách làm việc với DOM', 3, 14),
('JSON là gì?', 'https://www.youtube.com/embed/Uph14HYkgEQ?si=1rKD7f9iS2cxpiW0', 'JSON được sử dụng như thế nào trong JavaScript?', 3, 15),
('Lập trình hướng đối tượng: Phần 1', 'https://www.youtube.com/embed/orIXdOPFWeM?si=t0LoYSP0uXlGiPZq', 'Giới thiệu về lập trình hướng đối tượng trong JavaScript', 3, 16),
('Lập trình hướng đối tượng: Phần 2', 'https://www.youtube.com/embed/FO1OMbT_k2w?si=UpqT4gbrVvSzq8r_', 'Tiếp tục học về lập trình hướng đối tượng trong JavaScript', 3, 16),
('AJAX và Fetch API: Phần 1', 'https://www.youtube.com/embed/TRjVXmk8q8I?si=Z5gmXOeo42vTS1FT', 'Học cách làm việc với AJAX và Fetch API', 3, 17),
('AJAX và Fetch API: Phần 2', 'https://www.youtube.com/embed/CvX_5uyUXSs?si=YmAwz2r6whzWKBfS', 'Tiếp tục học cách làm việc với AJAX và Fetch API', 3, 17),
('Dự án thực tế: Xây dựng ứng dụng với JavaScript', 'https://www.youtube.com/embed/On24_XdhXq8?si=viQJavfpkNQSql4H', 'Dự án thực tế: Xây dựng ứng dụng với JavaScript', 3, 18);

-- Chèn các chương cho khóa học "ReactJS Pro"
INSERT INTO Chapters (chapter_title, course_id) VALUES
('Giới thiệu về ReactJS', 4),
('Cài đặt môi trường ReactJS', 4),
('Cấu trúc cơ bản của ReactJS', 4),
('Component và Props', 4),
('State và Lifecycle', 4),
('React Router', 4),
('Quản lý trạng thái với Redux', 4),
('Dự án thực tế với ReactJS', 4);

-- Chèn bài học vào bảng Courses_Detail (thuộc khóa học ReactJS Pro)
INSERT INTO Lessons (title, content_url, description, course_id, chapter_id) VALUES
('Giới thiệu về ReactJS', 'https://example.com/react_intro_video.mp4', 'Giới thiệu tổng quan về ReactJS và các tính năng của nó', 4, 19),
('Cài đặt môi trường ReactJS', 'https://example.com/react_setup.pdf', 'Hướng dẫn cài đặt môi trường ReactJS và các công cụ cần thiết', 4, 20),
('Cấu trúc cơ bản của ReactJS', 'https://example.com/react_basics.mp4', 'Tìm hiểu về cấu trúc cơ bản của một ứng dụng ReactJS', 4, 21),
('Component và Props', 'https://example.com/react_components_props.pdf', 'Học về cách tạo và sử dụng components và props trong ReactJS', 4, 22),
('State và Lifecycle', 'https://example.com/react_state_lifecycle.mp4', 'Tìm hiểu về state và lifecycle methods trong ReactJS', 4, 23),
('React Router', 'https://example.com/react_router.pdf', 'Giới thiệu về React Router và cách sử dụng để điều hướng trong ứng dụng ReactJS', 4, 24),
('Quản lý trạng thái với Redux', 'https://example.com/redux_state_management.mp4', 'Học cách quản lý trạng thái ứng dụng ReactJS với Redux', 4, 25),
('Dự án thực tế với ReactJS', 'https://example.com/react_project.mp4', 'Xây dựng một dự án thực tế với ReactJS từ A-Z', 4, 26);

-- Chèn các chương cho khóa học miễn phí  "Nhập môn IT"
INSERT INTO Chapters (chapter_title, course_id) VALUES
('Giới thiệu về IT', 9),
('Cấu trúc máy tính và phần cứng', 9),
('Phần mềm và hệ điều hành', 9),
('Mạng máy tính cơ bản', 9),
('Lập trình và các ngôn ngữ lập trình', 9),
('Dự án thực tế: Xây dựng một ứng dụng đơn giản', 9);

-- Chèn bài học vào bảng Courses_Detail (Nhập môn IT)
INSERT INTO Lessons (title, content_url, description, course_id, chapter_id) VALUES
('Giới thiệu về IT', 'https://example.com/intro_to_it_video.mp4', 'Giới thiệu tổng quan về ngành IT và các lĩnh vực chính', 9, 27),
('Cấu trúc máy tính và phần cứng', 'https://example.com/computer_hardware.pdf', 'Tìm hiểu về cấu trúc cơ bản của máy tính và các thành phần phần cứng', 9, 28),
('Phần mềm và hệ điều hành', 'https://example.com/software_and_os_video.mp4', 'Giới thiệu về phần mềm, các loại hệ điều hành và chức năng của chúng', 9, 29),
('Mạng máy tính cơ bản', 'https://example.com/computer_networking.pdf', 'Cơ bản về mạng máy tính và các loại mạng phổ biến', 9, 30),
('Lập trình và các ngôn ngữ lập trình', 'https://example.com/programming_languages_video.mp4', 'Giới thiệu các ngôn ngữ lập trình phổ biến và cách thức lập trình cơ bản', 9, 31),
('Dự án thực tế: Xây dựng một ứng dụng đơn giản', 'https://example.com/project_video.mp4', 'Thực hành xây dựng một ứng dụng đơn giản từ A-Z', 9, 32);

-- Chèn các chương cho khóa học miễn phí  "C++"
INSERT INTO Chapters (chapter_title, course_id) VALUES
('Giới thiệu về C++', 10),
('Cấu trúc cơ bản của C++', 10),
('Biến, kiểu dữ liệu và toán tử', 10),
('Câu lệnh điều kiện và vòng lặp', 10),
('Hàm trong C++', 10),
('Lập trình hướng đối tượng trong C++', 10),
('Dự án thực tế với C++', 10);

-- Chèn bài học vào bảng Courses_Detail (C++)
INSERT INTO Lessons (title, content_url, description, course_id, chapter_id) VALUES
('Giới thiệu về C++', 'https://example.com/cpp_intro_video.mp4', 'Giới thiệu tổng quan về ngôn ngữ lập trình C++', 10, 33),
('Cấu trúc cơ bản của C++', 'https://example.com/cpp_basics.pdf', 'Tìm hiểu về cấu trúc cơ bản của một chương trình C++', 10, 34),
('Biến, kiểu dữ liệu và toán tử', 'https://example.com/cpp_variables_operators.mp4', 'Học về các loại biến, kiểu dữ liệu và toán tử trong C++', 10, 35),
('Câu lệnh điều kiện và vòng lặp', 'https://example.com/cpp_conditions_loops.pdf', 'Tìm hiểu về câu lệnh điều kiện và các loại vòng lặp trong C++', 10, 36),
('Hàm trong C++', 'https://example.com/cpp_functions_video.mp4', 'Học cách sử dụng hàm trong C++ để tái sử dụng mã', 10, 37),
('Lập trình hướng đối tượng trong C++', 'https://example.com/cpp_oop.pdf', 'Tìm hiểu về lập trình hướng đối tượng (OOP) trong C++', 10, 38),
('Dự án thực tế với C++', 'https://example.com/cpp_project_video.mp4', 'Xây dựng một dự án thực tế với C++ từ A-Z', 10, 39);

-- Chèn các chương cho khóa học miễn phí  "HTML & CSS "
INSERT INTO Chapters (chapter_title, course_id) VALUES
('Giới thiệu về HTML & CSS', 11),
('Cấu trúc cơ bản của HTML', 11),
('CSS cơ bản', 11),
('HTML nâng cao', 11),
('CSS nâng cao', 11),
('Dự án thực tế với HTML & CSS', 11);

-- Chèn bài học vào bảng Courses_Detail (HTML & CSS)
INSERT INTO Lessons (title, content_url, description, course_id, chapter_id) VALUES
('Giới thiệu về HTML & CSS', 'https://example.com/html_css_intro.mp4', 'Giới thiệu tổng quan về HTML và CSS, cũng như tầm quan trọng của chúng trong web development', 11, 40),
('Cấu trúc cơ bản của HTML', 'https://example.com/html_structure.pdf', 'Học về cấu trúc cơ bản của HTML và cách xây dựng một trang web', 11, 41),
('CSS cơ bản', 'https://example.com/css_basics.mp4', 'Tìm hiểu về các thuộc tính và cách sử dụng CSS để tạo kiểu cho các trang web', 11, 42),
('HTML nâng cao', 'https://example.com/advanced_html.pdf', 'Khám phá các thẻ HTML nâng cao và cách sử dụng chúng trong các trang web phức tạp', 11, 43),
('CSS nâng cao', 'https://example.com/advanced_css.mp4', 'Học về các kỹ thuật CSS nâng cao như Flexbox và Grid', 11, 44),
('Dự án thực tế với HTML & CSS', 'https://example.com/html_css_project.mp4', 'Thực hành và xây dựng dự án thực tế với HTML và CSS từ A đến Z', 11, 45);

-- Chèn các chương cho khóa học miễn phí  "Responsive & Grid"
INSERT INTO Chapters (chapter_title, course_id) VALUES
('Giới thiệu về Responsive Design', 12),
('Cách sử dụng Grid System', 12),
('Bố cục với Grid', 12),
('Làm việc với các phần tử trong Grid', 12),
('Responsive Web Design với Grid', 12),
('Dự án thực tế với Grid System', 12);

-- Chèn bài học vào bảng Courses_Detail (Responsive & Grid)
INSERT INTO Lessons (title, content_url, description, course_id, chapter_id) VALUES
('Giới thiệu về Responsive Design', 'https://example.com/responsive_intro_video.mp4', 'Giới thiệu về responsive design và lý thuyết cơ bản', 12, 46),
('Cách sử dụng Grid System', 'https://example.com/grid_system_setup.pdf', 'Hướng dẫn về cách cài đặt và sử dụng Grid System trong responsive design', 12, 47),
('Bố cục với Grid', 'https://example.com/grid_layout.mp4', 'Tạo bố cục với Grid System trong thiết kế responsive', 12, 48),
('Làm việc với các phần tử trong Grid', 'https://example.com/grid_elements.pdf', 'Tìm hiểu cách làm việc với các phần tử trong Grid System', 12, 49),
('Responsive Web Design với Grid', 'https://example.com/responsive_grid_design.mp4', 'Học cách xây dựng trang web responsive hoàn chỉnh với Grid System', 12, 50),
('Dự án thực tế với Grid System', 'https://example.com/grid_system_project.mp4', 'Thực hành dự án thực tế để áp dụng Grid System trong thiết kế web', 12, 51);


-- Chèn các chương cho khóa học miễn phí  "Lập trình Python cơ bản"
INSERT INTO Chapters (chapter_title, course_id) VALUES
('Giới thiệu', 14),
('Các khái niệm cơ bản', 14),
('Làm việc với dữ liệu', 14),
('Phân tích dữ liệu với Pandas', 14),
('Trực quan hóa dữ liệu', 14),
('Dự án thực tế', 14);

-- Chèn bài học vào bảng Courses_Detail (thuộc khóa học Python cơ bản)
INSERT INTO Lessons (title, content_url, description, course_id, chapter_id) VALUES
('Làm quen với Python và môi trường lập trình', 'https://www.youtube.com/embed/NZj6LI5a9vc?si=t2KDD8DWZxgktWwn', 'Giới thiệu về Python và môi trường phát triển', 14, 52),
('Thiết lập Python trên hệ điều hành của bạn', 'https://www.youtube.com/embed/jf-q_dG8WzI?si=KydMxb8vMAr5qeVE', 'Cách cài đặt Python trên Windows và macOS', 14, 52),
('Biến và kiểu dữ liệu trong Python', 'https://www.youtube.com/embed/nclE18Yl-kA?si=QBj-G364T_djU5Ir', 'Học về biến và các kiểu dữ liệu trong Python', 14, 53),
('Vòng lặp và câu lệnh điều kiện trong Python', 'https://www.youtube.com/embed/Vb6XWSLPQfg?si=1Y9YCNB0SsrvCV1t', 'Giới thiệu về vòng lặp và câu lệnh điều kiện trong Python', 14, 53),
('Xử lý tệp văn bản và đọc dữ liệu từ tệp CSV', 'https://www.youtube.com/embed/gw9zbl2Q7r4?si=cgz9OQLN9s3ru647nt', 'Giới thiệu về thư viện NumPy và cách sử dụng để xử lý mảng', 14, 54),
('Đọc và xử lý dữ liệu với Pandas', 'https://example.com/pandas_video.mp4', 'Học cách xử lý dữ liệu với thư viện Pandas', 14, 55),
('Sử dụng Matplotlib để tạo biểu đồ cơ bản', 'https://example.com/matplotlib_video.mp4', 'Hướng dẫn tạo biểu đồ cơ bản với Matplotlib', 14, 56),
('Xây dựng ứng dụng phân tích dữ liệu cơ bản với Python', 'https://example.com/project_video.mp4', 'Dự án thực tế: Xây dựng ứng dụng phân tích dữ liệu với Python', 14, 57);


CREATE TABLE Reviews (
    review_id INT PRIMARY KEY AUTO_INCREMENT,
    comments TEXT,
    date_posted DATETIME,
    user_id INT,
    lesson_id INT,
    FOREIGN KEY (user_id) REFERENCES Users(user_id),
    FOREIGN KEY (lesson_id) REFERENCES Lessons(lesson_id)
);
-- Hiển thị tất cả các bài học trong tất cả các khóa học 
SELECT c.course_id, c.title AS course_title, l.lesson_id, l.title AS lesson_title
FROM Courses c
JOIN Lessons l ON c.course_id = l.course_id
ORDER BY c.course_id, l.lesson_id;

select*from Enrollments;
select*from courses;
select*from chapters;

SELECT * FROM Users;
	
select*from Reviews;
SELECT * FROM lessons WHERE course_id = 2 ;
SELECT * FROM Lessons WHERE course_id = 2 AND chapter_id = 8;

