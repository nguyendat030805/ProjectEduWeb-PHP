<?php
    require_once('../../Public/config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <!-- Import Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="/Views/Css/home.css">
  
</head>
<style>
body {
    font-family: Arial, sans-serif;
}
.container {
  padding: 30px;
  width: 100%;
  background-color: fff;
}
.custom-black {
    color: black;
}

/* Body 1 */

.body-1 {
  display: flex;
  justify-content: center; 
  gap: 15px;
  margin-top: 25px;
}
.square-avatar {
    width: 45px;
    height: 45px;
    object-fit: cover;
}
.card-title {
    font-size: 14px;
    color: #000;
    transition: color 0.3s ease;
}
.card-title:hover,
.card-title:focus {
    color: #28a745;
    cursor: pointer;
}
.card-img-top {
    transition: transform 0.3s ease;
    overflow: hidden;
}
.card {
    overflow: hidden;
}
.card:hover .card-img-top {
    transform: scale(1.1);
}
.text-danger {
    color: #6c757d !important;
}
.text-danger del {
    color: #6c757d !important;
}

.text-muted.mb-1 {
    border-bottom: 1px solid #dcdcdc;
    padding-bottom: 5px;
}
.btn-success {
    background-color: #47CF73;      
    padding: 15px 40px;              
    border: 2px solid #47CF73;      
    border-radius: 5px;             
    color: black;                   
    font-size: 20px;
    font-weight: bold;                                
    transition: background-color 0.3s, border-color 0.3s; 
}
.btn-success:hover {
    background-color: green;      
    border-color: #40b760;         
}
.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}
.card:hover {
    transform: translateY(-15px);
    box-shadow: 0px 15px 30px rgba(0, 0, 0, 0.3);
    border: 1px solid darkgreen;
}

/* Body 2 */

.jane-herbert {
    background-color: #47CF73;
    padding: 35px;
    margin: 10px; 
    color: black;
}
.jane {
    background-color: white;
    margin-bottom: 20px;
    padding: 22px;
    border-radius: 10px;
}
.achieve {
    display: flex;
    gap: 25px;
}
.time {
    display: flex;
    gap: 60px;
}
.btn {
    background-color: white;
    border: 1px solid black;
    width: 300px;
    height: 50px;
}
.img-cup {
  transition: transform 0.3s, box-shadow 0.3s; 
}
.img-cup:hover {
  transform: scale(1.2); 
}
.icon {
    margin-right: 15px; 
}
.img-jane {
    max-width: 300px; 
    max-height: 450px;
    transition: transform 0.5s, box-shadow 0.3s; 
}
.img-jane:hover {
    transform: scale(1.1);
}

/* Body 3 */

.course-card {
  padding: 10px;
  border: none;
  border-radius: 10px;
  overflow: hidden;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  background-color: #fff;
}
.course-card:hover {
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
}
.card-img-top {
  width: 100%;
  height: 200px;
  object-fit: cover;
  border: none;
  border-radius: 10px;
}
/* Author Info */
.author-info {
  display: grid;
  grid-template-columns: 50px auto;
  gap: 10px;
 
}


.author-avatar {
  width: 50px;
  height: 50px;
  object-fit: cover;
}


.author-content {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
}

/* Typography */
.card-title {
  font-size: 1.1rem;
  font-weight: bold;
  margin-bottom: 0.3rem;
}

.text-muted {
  font-size: 0.9rem;
  color: #757575;
}

.price {
  font-weight: bold;
  color: #828385;
}


.old-price {
  text-decoration: line-through;
  color: #757575;
}

/* Divider */
.divider {
  border-top: 1px solid #e0e0e0;
  margin: 10px 0;
}

/* Card Body */
.card-body {
  padding-left: 15px;
}
.card-body p {
  margin-bottom: 8px;
}

</style>
<body>
    <?php include '../../Layouts/header.html' ?>
  <div class="container">
<!-- Body 1 -->
    <div class="container mt-5">
        <div class="text-center">
        <h1 class="fw-bold custom-black">Top Courses</h1>
        <p class="text-secondary custom-black">Find Courses and Specializations from top Lecturers</p>
        <button type="submit" class="btn-success" style="color: black;">Explore</button>
        </div>
    </div>
    <div class="body-1">
        <!-- Card 1 -->
        <div class="col-md-3 d-flex">
            <div class="card flex-grow-1">
            <img src="https://images.pexels.com/photos/5306442/pexels-photo-5306442.jpeg?auto=compress&cs=tinysrgb&w=400&lazy=load" class="card-img-top card-img-fixed" alt="Course Image">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                <img src="https://images.pexels.com/photos/6325968/pexels-photo-6325968.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="square-avatar me-3" alt="Avatar">
                <h6 class="card-title fw-bold mb-0">Duplicated is the entry point to your user experience</h6>
                </div>
                <p class="text-muted mb-1">Thorsten Sträter</p>
                <p class="fw-bold text-success">Free</p>
                <div class="text-warning">
                ★★★★★
                </div>
            </div>
            </div>
        </div>
        <!-- Card 2 -->
        <div class="col-md-3 d-flex">
            <div class="card flex-grow-1">
            <img src="https://images.pexels.com/photos/4145153/pexels-photo-4145153.jpeg?auto=compress&cs=tinysrgb&w=600" class="card-img-top card-img-fixed" alt="Course Image">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                <img src="https://images.pexels.com/photos/8171190/pexels-photo-8171190.jpeg?auto=compress&cs=tinysrgb&w=400&lazy=load" class="square-avatar me-3" alt="Avatar">
                <h6 class="card-title fw-bold mb-0">The Magic Number</h6>
                </div>
                <p class="text-muted mb-1">Jane Herbert</p>
                <p class="fw-bold text-success">Free</p>
                <div class="text-warning">
                ★★★★★
                </div>
            </div>
            </div>
        </div>
        <!-- Card 3 -->
        <div class="col-md-3 d-flex">
            <div class="card flex-grow-1">
            <img src="https://images.pexels.com/photos/8761523/pexels-photo-8761523.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="card-img-top card-img-fixed" alt="Course Image">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                <img src="https://images.pexels.com/photos/5971242/pexels-photo-5971242.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="square-avatar me-3" alt="Avatar">
                <h6 class="card-title fw-bold mb-0">A Start Guide: Product Marketing Using G Suite</h6>
                </div>
                <p class="text-muted mb-1">Jane Herbert</p>
                <p class="fw-bold text-danger"><del>$125.00</del> $99.00</p>
                <div class="text-warning">
                ★★★★★
                </div>
            </div>
            </div>
        </div>
        <!-- Card 4 -->
        <div class="col-md-3 d-flex">
            <div class="card flex-grow-1">
            <img src="https://images.pexels.com/photos/8761553/pexels-photo-8761553.jpeg?auto=compress&cs=tinysrgb&w=400&lazy=load" class="card-img-top card-img-fixed" alt="Course Image">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                <img src="https://images.pexels.com/photos/3769021/pexels-photo-3769021.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="square-avatar me-3" alt="Avatar">
                <h6 class="card-title fw-bold mb-0">A good header is the entry point to your user experience</h6>
                </div>
                <p class="text-muted mb-1">Thorsten Sträter</p>
                <p class="fw-bold text-danger"><del>$125.00</del> $99.00</p>
                <div class="text-warning">
                ★★★★★
                </div>
            </div>
            </div>
        </div>

    </div>
    <!-- </div> -->
<!-- Body 2 3 -->
    <div class="jane-herbert">
    <!-- Body 2 -->
        <div class="row align-items-center jane">
            <div class="col-md-8">
                <h2>Jane Herbert</h2>
                <p>Whether you work in machine learning or finance, or are pursuing a career in web development or data science, Python is one of the most important skills you can learn.</p>
                <div class="achieve">
                    <div class="img-cup">
                        <img src="../Public/Assets/Image/img_cup.png" alt="Jane-Achievements" class="img-fluid">
                    </div>
                    <div class="time">
                        <div>
                            <h2>19 Years</h2>
                            <span class="text-black">Experience</span>
                        </div>
                        <button type="button" class="d-flex justify-content-between align-items-center btn">
                            All Reviews for Jane 
                            <i class="bi bi-chevron-right icon"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-center ">
                <img src="../Public/Assets/Image/img_jena.jpg" alt="Image">
            </div>
        </div>

  <!-- Body 3 -->  
        <div class="row gy-4 gx-3">
            <!-- Card 1 -->
            <div class="col-md-3">
                <a href="#" class="text-decoration-none">
                <div class="card flex-grow-1">
                    <img src="https://i.pinimg.com/736x/a0/d9/c6/a0d9c689594b8a3f5a35335b61a1b582.jpg"   class="card-img-top card-img-fixed" alt="Course Image">
                    <div class="card-body">
                    <div class="author-info">
                    <img src="https://i.pinimg.com/736x/32/62/6d/32626dee8e168e3df4ed1958d099367c.jpg" class="author-avatar" alt="Author Avatar">
                    <div class="author-content">
                        <h5 class="card-title mb-0">The Magic Number</h5>
                        <p class="mb-1"></p>Jane Herbert</p>
                        <p class="text-muted mb-2">
                        <i class="bi bi-briefcase"></i> Business, Course
                        </p>
                    </div>
                    </div>
                    <div class="divider"></div>
                    <p class="price">Free</p>
                    </div>
                </div>
                </a>
            </div>
            <!-- Card 2 -->
            <div class="col-md-3">
                <a href="#" class="text-decoration-none">
                <div class="card flex-grow-1">
                    <img src="https://i.pinimg.com/736x/a0/d9/c6/a0d9c689594b8a3f5a35335b61a1b582.jpg"   class="card-img-top card-img-fixed" alt="Course Image">
                    <div class="card-body">
                    <div class="author-info">
                    <img src="https://i.pinimg.com/736x/32/62/6d/32626dee8e168e3df4ed1958d099367c.jpg" class="author-avatar" alt="Author Avatar">
                    <div class="author-content">
                        <h5 class="card-title mb-0">The Magic Number</h5>
                        <p class="mb-1"></p>Jane Herbert</p>
                        <p class="text-muted mb-2">
                        <i class="bi bi-briefcase"></i> Business, Course
                        </p>
                    </div>
                    </div>
                    <div class="divider"></div>
                    <span class="old-price">$125.00</span>
                    <span class="price">$99.00</span>
                    </div>
                </div>
                </a>
            </div>
            
            <!-- Card 3 -->
            <div class="col-md-3">
                <a href="#" class="text-decoration-none">
                <div class="card flex-grow-1">
                    <img src="https://i.pinimg.com/736x/a0/d9/c6/a0d9c689594b8a3f5a35335b61a1b582.jpg"   class="card-img-top card-img-fixed" alt="Course Image">
                    <div class="card-body">
                    <div class="author-info">
                    <img src="https://i.pinimg.com/736x/32/62/6d/32626dee8e168e3df4ed1958d099367c.jpg" class="author-avatar" alt="Author Avatar">
                    <div class="author-content">
                        <h5 class="card-title mb-0">The Magic Number</h5>
                        <p class="mb-1"></p>Jane Herbert</p>
                        <p class="text-muted mb-2">
                        <i class="bi bi-briefcase"></i> Business, Course
                        </p>
                    </div>
                    </div>
                    <div class="divider"></div>
                    <p class="price">$120.00</p>
                    </div>
                </div>
                </a>
            </div>
            
            <!-- Card 4 -->
            <div class="col-md-3">
                <a href="#" class="text-decoration-none">
                <div class="card flex-grow-1">
                    <img src="https://i.pinimg.com/736x/a0/d9/c6/a0d9c689594b8a3f5a35335b61a1b582.jpg"   class="card-img-top card-img-fixed" alt="Course Image">
                    <div class="card-body">
                    <div class="author-info">
                    <img src="https://i.pinimg.com/736x/32/62/6d/32626dee8e168e3df4ed1958d099367c.jpg" class="author-avatar" alt="Author Avatar">
                    <div class="author-content">
                        <h5 class="card-title mb-0">The Magic Number</h5>
                        <p class="mb-1"></p>Jane Herbert</p>
                        <p class="text-muted mb-2">
                        <i class="bi bi-briefcase"></i> Business, Course
                        </p>
                    </div>
                    </div>
                    <div class="divider"></div>
                    <p class="price">Free</p>
                    </div>
                </div>
                </a>
            </div>
        </div>     
    </div>     
  </div>
  <?php include '../../Layouts/footer.html'; ?> 
</body>
</html>

<?php

