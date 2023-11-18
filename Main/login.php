<?php
include 'database.php';
session_start();

if (isset($_SESSION['Username'])) {
    $username = $_SESSION['Username'];
    $error = "You are already logged in!";
    echo "Error: $error";
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Login Figma</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="Login.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="function.js"></script>
    <style>
    * {
        margin: 0;
        padding: 0;
    }
    </style>
</head>
<body>
<div class="rectangle"></div>
    <div class="wrapper">
        <div class="logo">
            <img src="images/spc-ccs-logo2.png" alt="">
        </div>
        <div class="text-center mt-4 name">
            Login Form
       </div>
        <div class="circle"></div>
        <div class="spc_rant">SPC RANT</div>
        <div class="home"><a href="index.php"><img width="30" height="30" src="https://img.icons8.com/fluency-systems-filled/96/home.png" alt="home"/></a></div>
<form action="login_process.php" method="post">
        <form class="p-3 mt-3">
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input type="text" name="Username" id="userName" placeholder="Username">
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type="password" name="Password" placeholder="Password" id="pwd">
            </div>
            <button class="btn mt-3">Sign In</button>
        </form>
        <div class="text-center fs-6">
            <a href="#">Forget password?</a> or <a href="signup.php">Sign up</a>
        </div>
    </div>
</body>
</html>