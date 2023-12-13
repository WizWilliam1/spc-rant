<?php
 
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Signup Figma</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="Signup.css">
    <script src="function.js"></script>
    <script>window.onload = applySavedTheme;</script>
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
            Signup Form
       </div>
        <div class="circle"></div>
        <div class="spc_rant">SPC RANT</div>
        <div class="home"><a href="index.php"><img width="30" height="30" src="https://img.icons8.com/fluency-systems-filled/96/home.png" alt="home"/></a></div>
<form action="signup_process.php" method="post">
        <form class="p-3 mt-3">
            <div class="form-field d-flex align-items-center">
                <span><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABIAAAASCAYAAABWzo5XAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAqUlEQVR4nN2Tuw2DMBRFj0SHlAyQgibZwIuwCWVER8kKtFkha2SChCojUIOMkC4IOYmDkSiSK93C73P0nmXD3+sE1IANdK3eSbkSZaCteicVCmZAtGCDSLVWvS+gBrgBxgMxqml8oANwATqgAvazmljrtMAVSHygUSnwlNM351FfQe4EnSbcOTWLQPM7MR9yQSCftgPlCp4Dbd0HOTzzx4ovcgeOKzb5JfUG7VeNP4+8vwAAAABJRU5ErkJggg=="></span>
                <input type="text" name="Email_or_Phone" id="Email_or_Phone" placeholder="Email or Phone">
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input type="text" name="Username" id="userName" placeholder="Username">
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type="password" name="Password" placeholder="Password" id="pwd">
            </div>
            <button class="btn mt-3">Sign Up</button>
        </form>
        <div class="text-center fs-6">
            <a>Already have account?</a> <a href="login.php">Login In</a>
        </div>
    </div>
<script>
    // Call applySavedTheme function on page load
    document.addEventListener("DOMContentLoaded", applySavedTheme);
</script>
</body>
</html>