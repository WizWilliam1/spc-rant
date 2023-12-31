<?php
// Include the database connection file
include "database.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// If the request method is POST, process the token verification
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the token from the POST data
    $token = $_POST["token"];

    // Check if the token matches the one on file for the user
    if ($token === $_SESSION["reset_token"]) {
        // Redirect to the password reset page
        header("Location: reset_password.php");
        exit;
    } else {
        echo "Invalid token.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8" />
   <title>Verify Token</title>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
   <link rel="stylesheet" href="Login.css">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   <script src="function.js"></script>
   <script>window.onload = applySavedTheme;</script>
   <style>
   * {
       margin: 0;
       padding: 0;
   }
   .reset-btn {
   display: block;
   width: 100%;
   height: 40px;
   background-color: #5cfd00;
   color: #fff;
   border-radius: 25px;
   box-shadow: 3px 3px 3px #b1b1b1, -3px -3px 3px #fff;
   letter-spacing: 1.3px;
   margin: 0 auto;
   text-align: center;
   line-height: 40px;
   font-size: 1.2rem;
   cursor: pointer;
   transition: background-color 0.3s ease;
}

.reset-btn:hover {
   background-color: #5cfd0069;
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
               Verify Token Form
          </div>
           <div class="circle"></div>
           <div class="spc_rant">SPC RANT</div>
           <div class="home"><a href="index.php"><img width="30" height="30" src="https://img.icons8.com/fluency-systems-filled/96/home.png" alt="home"/></a></div>
   <form action="verify_token.php" method="post">
       <div class="form-field d-flex align-items-center">
           <span class="far fa-user"></span>
           <input type="text" name="token" placeholder="Enter your token">
       </div>
       <button type="submit" class="reset-btn">Next</button>
   </form>
</body>
</html>
