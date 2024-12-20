<?php
    require_once('C:\xampp\htdocs\ProjectWeb-TD\ProjectEduWeb-PHP\Views\Public\config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.lineicons.com/4.0/lineicons.css" />
    <link rel="stylesheet" href="/Views/Css/login.css">
</head>
<style>
    body {
    font-family: Arial, sans-serif;
    display: flex;
    background-image: url('https://haycafe.vn/wp-content/uploads/2022/05/Background-xanh-la-cay-nhat.jpg');
    background-size: cover;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    overflow: hidden;
}
.container {
    background-image: url('../../../Public/Assets/Image/img_lg.jpg');
    background-size: cover;
    border-radius: 25px;
    box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
    position: relative;
    overflow: hidden;
    width: 500px;
    max-width: 100%;
    min-height: 500px;
}
form {
    display: flex;
    align-items: center;
    background-color:url('../../../Public/Assets/Image/img_lg.jpg');
    justify-content: center;
    flex-direction: column;
    padding: 0 50px;
    height: 100%;
    text-align: center;
}
input {
    background-color: #fff;
    border-radius: 10px;
    border: none;
    padding: 12px 15px;
    margin: 8px 0;
    width: 100%; 
}
.content {
    display: flex;
    width: 100%;
    height: 50px;
    align-items: center;
    justify-content: space-around;
}
.content input {
    color: black;
    width: 12px;
    height: 12px;
}

.content label {
    font-size: 14px;
    user-select: none;
    padding-left: 5px;
}
a {
    color: black;
    font-size: 14px;
    text-decoration: none;
    margin: 15px 0;
    transition: 0.3s;
}
a:hover{
    color: green;
}
.btn-login {
    border-radius: 20px;
    border: 1px solid green;
    background-color: green;
    color: #fff;
    font-size: 15px;
    font-weight: 700;
    margin: 15px;
    padding: 12px 80px;
    letter-spacing: 1px;
    text-transform: capitalize;
    transition: 0.3s;
}
.btn-login:hover {
    letter-spacing: 3px;
}
.social-icon {
    margin: 20px 0;
}
.social-icon a {
    border: 3px solid #dddddd;
    border-radius: 50%;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    margin: 0 5px;
    height: 40px;
    width: 40px;
    transition: 0.3s;
}
.social-icon a:hover {
    border: 1px solid green;
}

</style>
<body>
    <div class="container">    
            <form action="../../../Controller/logincontroll.php" method="POST">
                <h1>Login</h1>
                <?php if (!empty($error)): ?>
                    <p style="color: red;"><?php echo $error; ?></p>
                <?php endif; ?>

                <input type="email" name="email" placeholder="Email">
                <input type="phone" name="phone" placeholder="Phone Number">
                <input type="password" name="password" placeholder="Password">
                <div class="content">
                    <div class="checkbox">
                        <input type="checkbox" name="" id="checkbox">
                        <label>Remember me</label>
                    </div>
                    <div class="pass-link">
                        <a href="#">Forgot password?</a>
                    </div>
                </div>
                <button type="submit" class="btn-login">Login</button>
                <span><a href="../user/register.php">or register your account</a></span>
                <div class="social-icon">
                    <a href="#" class="social"><i class="lni lni-facebook-fill"></i></a>
                    <a href="#" class="social"><i class="lni lni-google"></i></a>
                    <a href="#" class="social"><i class="lni lni-linkedin-original"></i></a>
                </div>
            </form>
        
    </div>
</body>
</html>
