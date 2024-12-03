
CREATE DATABASE l5;
USE l5;
-- ----------Courses----------------------
CREATE TABLE Courses (
    course_id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(250),              
    images VARCHAR(255),             
    descriptions TEXT,               
    duration VARCHAR(20),            
    original_price DECIMAL(10, 2),   
    discounted_price DECIMAL(10, 2), 
    num_students INT,               
    types ENUM('Pro', 'Free')         
);

-- Chèn dữ liệu bảng courses
-- Khóa học Pro
INSERT INTO Courses (title, images, descriptions, duration, original_price, discounted_price, num_students, types)
VALUES 
('HTML CSS Pro', 'https://files.fullstack.edu.vn/f8-prod/courses/15/62f13d2424a47.png', 'Khóa học HTML và CSS nâng cao', '10h18p', 2500000, 1299000, 31273, 'Pro'),
('Sass', 'https://files.fullstack.edu.vn/f8-prod/courses/27/64e184ee5d7a2.png', 'Khóa học Sass nâng cao', '10h18p', 400000, 299000, 31273, 'Pro'),
('JavaScript Pro', 'https://files.fullstack.edu.vn/f8-prod/courses/19/66aa28194b52b.png', 'Khóa học JavaScript nâng cao', '10h18p', 3299000, 1399000, 31273, 'Pro'),
('ReactJS Pro', 'https://files.fullstack.edu.vn/f8-prod/courses/13/13.png', 'Khóa học ReactJS nâng cao', '10h18p', 3000000, 1500000, 31273, 'Pro'),
('NodeJS Pro', 'https://files.fullstack.edu.vn/f8-prod/courses/6.png', 'Khóa học NodeJS nâng cao', '10h18p', 2800000, 1200000, 31273, 'Pro'),
('Python Pro', 'path_to_image', 'Khóa học Python nâng cao', '10h18p', 4000000, 2000000, 31273, 'Pro'),
('Java Pro', 'path_to_image', 'Khóa học Java nâng cao', '10h18p', 3500000, 1800000, 31273, 'Pro'),
('PHP Pro', 'https://fullstack.edu.vn/courses/lap-trinh-c-co-ban-toi-nang-cao', 'Khóa học PHP nâng cao', '10h18p', 2200000, 1100000, 31273, 'Pro');

-- Khóa học miễn phí
INSERT INTO Courses (title, images, descriptions, duration, original_price, discounted_price, num_students, types)
VALUES 
('Kiến Thức Nhập Môn IT', 'https://files.fullstack.edu.vn/f8-prod/courses/7.png', 'Khóa học giới thiệu về IT', '10h18p', 0, 0, 31273, 'Free'),
('Lập Trình C++ Cơ Bản', 'https://files.fullstack.edu.vn/f8-prod/courses/21/63e1bcbaed1dd.png', 'Khóa học lập trình C++ cơ bản', '10h18p', 0, 0, 31273, 'Free'),
('HTML, CSS Cơ Bản', 'https://files.fullstack.edu.vn/f8-prod/courses/2.png', 'Khóa học HTML, CSS từ cơ bản đến nâng cao', '10h18p', 0, 0, 31273, 'Free'),
('Responsive Với Grid System', 'https://files.fullstack.edu.vn/f8-prod/courses/3.png', 'Khóa học về responsive với Grid System', '10h18p', 0, 0, 31273, 'Free'),
('Lập Trình JavaScript Cơ Bản', 'https://files.fullstack.edu.vn/f8-prod/courses/1.png', 'Khóa học JavaScript cơ bản', '10h18p', 0, 0, 31273, 'Free'),
('Lập Trình Python Cơ Bản', 'path_to_image', 'Khóa học Python cơ bản', '10h18p', 0, 0, 31273, 'Free'),
('Lập Trình Java Cơ Bản', 'img', 'Khóa học Java cơ bản', '10h18p', 0, 0, 31273, 'Free'),
('Git & GitHub Cơ Bản', 'path_to_image', 'Khóa học Git và GitHub cơ bản', '10h18p', 0, 0, 31273, 'Free');

-- ----------Users----------------------
CREATE TABLE Users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255),
    email VARCHAR(255) unique,
    phone CHAR(10),
    password CHAR(255)
);
CREATE TABLE Enrollments (
    enrollment_id INT PRIMARY KEY AUTO_INCREMENT,
    date DATETIME,
    status ENUM('studying', 'studied'),
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
    content_type ENUM('video', 'document'),
    duration INT,
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
INSERT INTO Lessons (title, content_url, content_type, duration, description, course_id, chapter_id) VALUES
('Giới thiệu về khóa học', 'https://example.com/intro_video.mp4', 'video', 10, 'Giới thiệu tổng quan về khóa học HTML CSS Pro', 1, 1),
('HTML là gì?', 'https://example.com/html_basics.pdf', 'document', 15, 'Tìm hiểu về HTML và cách sử dụng', 1, 2),
('Cấu trúc cơ bản của trang HTML', 'https://example.com/html_structure.mp4', 'video', 20, 'Học về cấu trúc cơ bản của một trang HTML', 1, 2),
('CSS là gì?', 'https://example.com/css_basics.pdf', 'document', 15, 'Giới thiệu về CSS và cách sử dụng', 1, 3),
('Cách liên kết CSS với HTML', 'https://example.com/css_linking.mp4', 'video', 20, 'Hướng dẫn cách liên kết CSS với HTML', 1, 3),
('Thẻ HTML nâng cao', 'https://example.com/advanced_html.pdf', 'document', 25, 'Học về các thẻ HTML nâng cao', 1, 4),
('Sử dụng biểu mẫu và đa phương tiện', 'https://example.com/html_forms_multimedia.mp4', 'video', 30, 'Cách sử dụng biểu mẫu và đa phương tiện trong HTML', 1, 4),
('CSS Layout và Flexbox', 'https://example.com/css_layout_flexbox.pdf', 'document', 25, 'Giới thiệu về CSS Layout và Flexbox', 1, 5),
('CSS Grid', 'https://example.com/css_grid.mp4', 'video', 30, 'Học cách sử dụng CSS Grid để tạo bố cục trang web', 1, 5),
('Xây dựng trang web cá nhân', 'https://example.com/project_website.mp4', 'video', 40, 'Dự án thực tế: Xây dựng trang web cá nhân từ A-Z', 1, 6);

-- Chèn các chương cho khóa học Pro "Sass" 
INSERT INTO Chapters (chapter_title, course_id) VALUES
('Giới thiệu về Sass', 2),
('Cài đặt và thiết lập', 2),
('Biến và toán tử trong Sass', 2),
('Mixins và Functions', 2),
('Thực hành và dự án', 2);

-- Chèn bài học vào bảng Course_Detail (thuộc khóa học Sass)
INSERT INTO Lessons (title, content_url, content_type, duration, description, course_id, chapter_id) VALUES
('Giới thiệu về Sass', 'https://example.com/sass_intro_video.mp4', 'video', 10, 'Giới thiệu về Sass và các tính năng nổi bật', 2, 7),
('Cài đặt Sass', 'https://example.com/sass_install.pdf', 'document', 15, 'Hướng dẫn cài đặt và thiết lập môi trường Sass', 2, 8),
('Biến trong Sass', 'https://example.com/sass_variables_video.mp4', 'video', 20, 'Học cách sử dụng biến trong Sass', 2, 9),
('Toán tử trong Sass', 'https://example.com/sass_operators.pdf', 'document', 10, 'Giới thiệu về các toán tử trong Sass', 2, 9),
('Mixins trong Sass', 'https://example.com/sass_mixins_video.mp4', 'video', 25, 'Cách sử dụng mixins để tái sử dụng mã CSS', 2, 10),
('Functions trong Sass', 'https://example.com/sass_functions.pdf', 'document', 15, 'Hướng dẫn tạo và sử dụng functions trong Sass', 2, 10),
('Dự án Sass', 'https://example.com/sass_project_video.mp4', 'video', 30, 'Thực hành và dự án thực tế với Sass', 2, 11);

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
INSERT INTO Lessons (title, content_url, content_type, duration, description, course_id, chapter_id) VALUES
('Giới thiệu về JavaScript và môi trường lập trình', 'https://www.example.com/js_intro.mp4', 'video', 12, 'Giới thiệu về JavaScript và môi trường phát triển', 3, 12),
('Cài đặt môi trường và các công cụ hỗ trợ', 'https://www.example.com/js_setup.pdf', 'document', 15, 'Hướng dẫn cài đặt môi trường phát triển và các công cụ hỗ trợ', 3, 12),
('Biến, kiểu dữ liệu và toán tử', 'https://www.example.com/js_variables.mp4', 'video', 18, 'Học về biến, kiểu dữ liệu và các toán tử trong JavaScript', 3, 13),
('Câu lệnh điều kiện và vòng lặp', 'https://www.example.com/js_conditions_loops.pdf', 'document', 20, 'Giới thiệu về câu lệnh điều kiện và vòng lặp trong JavaScript', 3, 13),
('Làm việc với DOM: Phần 1', 'https://www.example.com/js_dom_part1.mp4', 'video', 22, 'Học cách làm việc với Document Object Model (DOM)', 3, 14),
('Làm việc với DOM: Phần 2', 'https://www.example.com/js_dom_part2.mp4', 'video', 25, 'Tiếp tục học cách làm việc với DOM', 3, 14),
('Xử lý sự kiện trong JavaScript', 'https://www.example.com/js_events.mp4', 'video', 20, 'Học cách xử lý các sự kiện trong JavaScript', 3, 15),
('Lập trình hướng đối tượng: Phần 1', 'https://www.example.com/js_oop_part1.pdf', 'document', 25, 'Giới thiệu về lập trình hướng đối tượng trong JavaScript', 3, 16),
('Lập trình hướng đối tượng: Phần 2', 'https://www.example.com/js_oop_part2.mp4', 'video', 30, 'Tiếp tục học về lập trình hướng đối tượng trong JavaScript', 3, 16),
('AJAX và Fetch API: Phần 1', 'https://www.example.com/js_ajax_part1.mp4', 'video', 25, 'Học cách làm việc với AJAX và Fetch API', 3, 17),
('AJAX và Fetch API: Phần 2', 'https://www.example.com/js_ajax_part2.mp4', 'video', 28, 'Tiếp tục học cách làm việc với AJAX và Fetch API', 3, 17),
('Dự án thực tế: Xây dựng ứng dụng với JavaScript', 'https://www.example.com/js_project.mp4', 'video', 35, 'Dự án thực tế: Xây dựng ứng dụng với JavaScript', 3, 18);

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
INSERT INTO Lessons (title, content_url, content_type, duration, description, course_id, chapter_id) VALUES
('Giới thiệu về ReactJS', 'https://example.com/react_intro_video.mp4', 'video', 15, 'Giới thiệu tổng quan về ReactJS và các tính năng của nó', 4, 19),
('Cài đặt môi trường ReactJS', 'https://example.com/react_setup.pdf', 'document', 20, 'Hướng dẫn cài đặt môi trường ReactJS và các công cụ cần thiết', 4, 20),
('Cấu trúc cơ bản của ReactJS', 'https://example.com/react_basics.mp4', 'video', 25, 'Tìm hiểu về cấu trúc cơ bản của một ứng dụng ReactJS', 4, 21),
('Component và Props', 'https://example.com/react_components_props.pdf', 'document', 30, 'Học về cách tạo và sử dụng components và props trong ReactJS', 4, 22),
('State và Lifecycle', 'https://example.com/react_state_lifecycle.mp4', 'video', 30, 'Tìm hiểu về state và lifecycle methods trong ReactJS', 4, 23),
('React Router', 'https://example.com/react_router.pdf', 'document', 20, 'Giới thiệu về React Router và cách sử dụng để điều hướng trong ứng dụng ReactJS', 4, 24),
('Quản lý trạng thái với Redux', 'https://example.com/redux_state_management.mp4', 'video', 35, 'Học cách quản lý trạng thái ứng dụng ReactJS với Redux', 4, 25),
('Dự án thực tế với ReactJS', 'https://example.com/react_project.mp4', 'video', 45, 'Xây dựng một dự án thực tế với ReactJS từ A-Z', 4, 26);

-- Chèn các chương cho khóa học miễn phí  "Nhập môn IT"
INSERT INTO Chapters (chapter_title, course_id) VALUES
('Giới thiệu về IT', 9),
('Cấu trúc máy tính và phần cứng', 9),
('Phần mềm và hệ điều hành', 9),
('Mạng máy tính cơ bản', 9),
('Lập trình và các ngôn ngữ lập trình', 9),
('Dự án thực tế: Xây dựng một ứng dụng đơn giản', 9);

-- Chèn bài học vào bảng Courses_Detail (Nhập môn IT)
INSERT INTO Lessons (title, content_url, content_type, duration, description, course_id, chapter_id) VALUES
('Giới thiệu về IT', 'https://example.com/intro_to_it_video.mp4', 'video', 20, 'Giới thiệu tổng quan về ngành IT và các lĩnh vực chính', 9, 27),
('Cấu trúc máy tính và phần cứng', 'https://example.com/computer_hardware.pdf', 'document', 30, 'Tìm hiểu về cấu trúc cơ bản của máy tính và các thành phần phần cứng', 9, 28),
('Phần mềm và hệ điều hành', 'https://example.com/software_and_os_video.mp4', 'video', 25, 'Giới thiệu về phần mềm, các loại hệ điều hành và chức năng của chúng', 9, 29),
('Mạng máy tính cơ bản', 'https://example.com/computer_networking.pdf', 'document', 35, 'Cơ bản về mạng máy tính và các loại mạng phổ biến', 9, 30),
('Lập trình và các ngôn ngữ lập trình', 'https://example.com/programming_languages_video.mp4', 'video', 40, 'Giới thiệu các ngôn ngữ lập trình phổ biến và cách thức lập trình cơ bản', 9, 31),
('Dự án thực tế: Xây dựng một ứng dụng đơn giản', 'https://example.com/project_video.mp4', 'video', 50, 'Thực hành xây dựng một ứng dụng đơn giản từ A-Z', 9, 32);

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
INSERT INTO Lessons (title, content_url, content_type, duration, description, course_id, chapter_id) VALUES
('Giới thiệu về C++', 'https://example.com/cpp_intro_video.mp4', 'video', 15, 'Giới thiệu tổng quan về ngôn ngữ lập trình C++', 10, 33),
('Cấu trúc cơ bản của C++', 'https://example.com/cpp_basics.pdf', 'document', 20, 'Tìm hiểu về cấu trúc cơ bản của một chương trình C++', 10, 34),
('Biến, kiểu dữ liệu và toán tử', 'https://example.com/cpp_variables_operators.mp4', 'video', 25, 'Học về các loại biến, kiểu dữ liệu và toán tử trong C++', 10, 35),
('Câu lệnh điều kiện và vòng lặp', 'https://example.com/cpp_conditions_loops.pdf', 'document', 30, 'Tìm hiểu về câu lệnh điều kiện và các loại vòng lặp trong C++', 10, 36),
('Hàm trong C++', 'https://example.com/cpp_functions_video.mp4', 'video', 30, 'Học cách sử dụng hàm trong C++ để tái sử dụng mã', 10, 37),
('Lập trình hướng đối tượng trong C++', 'https://example.com/cpp_oop.pdf', 'document', 35, 'Tìm hiểu về lập trình hướng đối tượng (OOP) trong C++', 10, 38),
('Dự án thực tế với C++', 'https://example.com/cpp_project_video.mp4', 'video', 40, 'Xây dựng một dự án thực tế với C++ từ A-Z', 10, 39);

-- Chèn các chương cho khóa học miễn phí  "HTML & CSS "
INSERT INTO Chapters (chapter_title, course_id) VALUES
('Giới thiệu về HTML & CSS', 11),
('Cấu trúc cơ bản của HTML', 11),
('CSS cơ bản', 11),
('HTML nâng cao', 11),
('CSS nâng cao', 11),
('Dự án thực tế với HTML & CSS', 11);

-- Chèn bài học vào bảng Courses_Detail (HTML & CSS)
INSERT INTO Lessons (title, content_url, content_type, duration, description, course_id, chapter_id) VALUES
('Giới thiệu về HTML & CSS', 'https://example.com/html_css_intro.mp4', 'video', 15, 'Giới thiệu tổng quan về HTML và CSS, cũng như tầm quan trọng của chúng trong web development', 11, 40),
('Cấu trúc cơ bản của HTML', 'https://example.com/html_structure.pdf', 'document', 20, 'Học về cấu trúc cơ bản của HTML và cách xây dựng một trang web', 11, 41),
('CSS cơ bản', 'https://example.com/css_basics.mp4', 'video', 25, 'Tìm hiểu về các thuộc tính và cách sử dụng CSS để tạo kiểu cho các trang web', 11, 42),
('HTML nâng cao', 'https://example.com/advanced_html.pdf', 'document', 30, 'Khám phá các thẻ HTML nâng cao và cách sử dụng chúng trong các trang web phức tạp', 11, 43),
('CSS nâng cao', 'https://example.com/advanced_css.mp4', 'video', 35, 'Học về các kỹ thuật CSS nâng cao như Flexbox và Grid', 11, 44),
('Dự án thực tế với HTML & CSS', 'https://example.com/html_css_project.mp4', 'video', 40, 'Thực hành và xây dựng dự án thực tế với HTML và CSS từ A đến Z', 11, 45);

-- Chèn các chương cho khóa học miễn phí  "Responsive & Grid"
INSERT INTO Chapters (chapter_title, course_id) VALUES
('Giới thiệu về Responsive Design', 12),
('Cách sử dụng Grid System', 12),
('Bố cục với Grid', 12),
('Làm việc với các phần tử trong Grid', 12),
('Responsive Web Design với Grid', 12),
('Dự án thực tế với Grid System', 12);

-- Chèn bài học vào bảng Courses_Detail (Responsive & Grid)
INSERT INTO Lessons (title, content_url, content_type, duration, description, course_id, chapter_id) VALUES
('Giới thiệu về Responsive Design', 'https://example.com/responsive_intro_video.mp4', 'video', 15, 'Giới thiệu về responsive design và lý thuyết cơ bản', 12, 46),
('Cách sử dụng Grid System', 'https://example.com/grid_system_setup.pdf', 'document', 20, 'Hướng dẫn về cách cài đặt và sử dụng Grid System trong responsive design', 12, 47),
('Bố cục với Grid', 'https://example.com/grid_layout.mp4', 'video', 25, 'Tạo bố cục với Grid System trong thiết kế responsive', 12, 48),
('Làm việc với các phần tử trong Grid', 'https://example.com/grid_elements.pdf', 'document', 20, 'Tìm hiểu cách làm việc với các phần tử trong Grid System', 12, 49),
('Responsive Web Design với Grid', 'https://example.com/responsive_grid_design.mp4', 'video', 30, 'Học cách xây dựng trang web responsive hoàn chỉnh với Grid System', 12, 50),
('Dự án thực tế với Grid System', 'https://example.com/grid_system_project.mp4', 'video', 40, 'Thực hành dự án thực tế để áp dụng Grid System trong thiết kế web', 12, 51);


-- Chèn các chương cho khóa học miễn phí  "Lập trình Python cơ bản"
INSERT INTO Chapters (chapter_title, course_id) VALUES
('Giới thiệu', 14),
('Các khái niệm cơ bản', 14),
('Làm việc với dữ liệu', 14),
('Phân tích dữ liệu với Pandas', 14),
('Trực quan hóa dữ liệu', 14),
('Dự án thực tế', 14);

-- Chèn bài học vào bảng Courses_Detail (thuộc khóa học Python cơ bản)
INSERT INTO Lessons (title, content_url, content_type, duration, description, course_id, chapter_id) VALUES
('Làm quen với Python và môi trường lập trình', 'https://www.youtube.com/watch?v=NZj6LI5a9vc&list=PL33lvabfss1xczCv2BA0SaNJHu_VXsFtg&index=1&pp=iAQB', 'video', 10, 'Giới thiệu về Python và môi trường phát triển', 14, 52),
('Thiết lập Python trên hệ điều hành của bạn', 'https://example.com/setup.pdf', 'document', 15, 'Cách cài đặt Python trên Windows và macOS', 14, 52),
('Biến và kiểu dữ liệu trong Python', 'https://example.com/data_types.pdf', 'document', 15, 'Học về biến và các kiểu dữ liệu trong Python', 14, 53),
('Vòng lặp và câu lệnh điều kiện trong Python', 'https://example.com/loops_video.mp4', 'video', 20, 'Giới thiệu về vòng lặp và câu lệnh điều kiện trong Python', 14, 53),
('Xử lý tệp văn bản và đọc dữ liệu từ tệp CSV', 'https://example.com/file_handling_video.mp4', 'video', 15, 'Hướng dẫn xử lý tệp và làm việc với dữ liệu từ CSV', 14, 54),
('Làm quen với thư viện NumPy để xử lý mảng', 'https://example.com/numpy_intro.pdf', 'document', 20, 'Giới thiệu về thư viện NumPy và cách sử dụng để xử lý mảng', 14, 54),
('Đọc và xử lý dữ liệu với Pandas', 'https://example.com/pandas_video.mp4', 'video', 25, 'Học cách xử lý dữ liệu với thư viện Pandas', 14, 55),
('Sử dụng Matplotlib để tạo biểu đồ cơ bản', 'https://example.com/matplotlib_video.mp4', 'video', 15, 'Hướng dẫn tạo biểu đồ cơ bản với Matplotlib', 14, 56),
('Xây dựng ứng dụng phân tích dữ liệu cơ bản với Python', 'https://example.com/project_video.mp4', 'video', 30, 'Dự án thực tế: Xây dựng ứng dụng phân tích dữ liệu với Python', 14, 57);

-- CREATE TABLE Videos (
-- 	video_id INT PRIMARY KEY AUTO_INCREMENT,
--     video_name varchar(255),
--     video_data longblob,
--     course_id int,
--     lesson_id int,
--     foreign key (course_id) references Courses(course_id),
--     foreign key (lesson_id) references Lessons(lesson_id)
-- );

-- -- Chèn dữ liệu video cho các bài học của lập trình python cơ bản của khóa học miễn phí 
-- INSERT INTO Videos (video_name, video_data, course_id, lesson_id)
-- VALUES
-- ('Làm quen với Python và môi trường lập trình', 'https://www.youtube.com/watch?v=NZj6LI5a9vc&list=PL33lvabfss1xczCv2BA0SaNJHu_VXsFtg&index=1&pp=iAQB', 14, 1),
-- ('Vòng lặp và câu lệnh điều kiện trong Python', 'https://www.youtube.com/watch?v=1sixkaqdZNs&pp=ygU3VsOybmcgbOG6t3AgdsOgIGPDonUgbOG7h25oIMSRaeG7gXUga2nhu4duIHRyb25nIFB5dGhvbg%3D%3D', 14, 2),
-- ('Xử lý tệp văn bản và đọc dữ liệu từ tệp CSV', 'https://www.youtube.com/watch?v=pF5Ft0SOYyE&pp=ygU_WOG7rSBsw70gdOG7h3AgdsSDbiBi4bqjbiB2w6AgxJHhu41jIGThu68gbGnhu4d1IHThu6sgdOG7h3AgQ1NW', 14, 3),
-- ('Đọc và xử lý dữ liệu với Pandas', 'https://www.youtube.com/watch?v=D_FrHmKYNLw&pp=ygUtJ8SQ4buNYyB2w6AgeOG7rSBsw70gZOG7ryBsaeG7h3UgduG7m2kgUGFuZGFz', 14, 4),
-- ('Sử dụng Matplotlib để tạo biểu đồ cơ bản', 'https://www.youtube.com/watch?v=Vt93b-U_Pr0&pp=ygU5U-G7rSBk4bulbmcgTWF0cGxvdGxpYiDEkeG7gyB04bqhbyBiaeG7g3UgxJHhu5MgY8ahIGLhuqNu', 14, 5),
-- ('Xây dựng ứng dụng phân tích dữ liệu cơ bản với Python', 'https://www.youtube.com/watch?v=t8LWZMh7JIc&list=PLv6GftO355AsTHazj_LKbli1YIrQ5Re0w&index=3&pp=iAQB', 14, 6);

CREATE TABLE Reviews (
    review_id INT PRIMARY KEY AUTO_INCREMENT,
    rating INT,
    comments TEXT,
    date_posted DATETIME,
    user_id INT,
    course_id INT,
    FOREIGN KEY (user_id) REFERENCES Users(user_id),
    FOREIGN KEY (course_id) REFERENCES Courses(course_id)
);
-- Hiển thị tất cả các bài học trong tất cả các khóa học 
SELECT c.course_id, c.title AS course_title, l.lesson_id, l.title AS lesson_title
FROM Courses c
JOIN Lessons l ON c.course_id = l.course_id
ORDER BY c.course_id, l.lesson_id;

-- Hiển thị tất cả các bài học trong khóa học miễn phí của Lập trình Python Cơ bản
SELECT c.title AS course_title, l.title AS lesson_title, l.duration, l.description
FROM Courses 
JOIN Lessons l ON c.course_id = l.course_id
WHERE c.types = 'Free' AND (c.title LIKE '%Cơ Bản%' OR c.title LIKE '%Basic%')
ORDER BY c.course_id, l.lesson_id;

-- drop database l5;
select*from Courses_detail;
 -- SET foreign_key_checks = 0;
-- SET foreign_key_checks = 1;
-- TRUNCATE TABLE users;
select*from  Chapters_Course_Detail;
select*from courses;
select*from lessons;	
select*from chapters;
SELECT * FROM lessons WHERE course_id = 2 ;
SELECT * FROM Lessons WHERE course_id = 2 AND chapter_id = 8;



