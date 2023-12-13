<?php
// Include the database connection file
include "database.php";
session_start();

// If the request method is POST, process the password reset
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the new password and confirm password from the POST data
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];

    // Check if the new password and confirm password match
    if ($new_password === $confirm_password) {
        // Update the password in the database based on User_ID
        $query = "UPDATE accounts SET Password = ? WHERE User_ID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $new_password, $_SESSION["User_ID"]);
        $stmt->execute();

        // Redirect to the login page
        header("Location: login.php");
        exit;
    } else {
        echo "The new password and confirm password do not match.";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>Reset Password</title>
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
              Reset Password Form
         </div>
          <div class="circle"></div>
          <div class="spc_rant">SPC RANT</div>
          <div class="home"><a href="index.php"><img width="30" height="30" src="https://img.icons8.com/fluency-systems-filled/96/home.png" alt="home"/></a></div>
  <form action="reset_password.php" method="post">
      <div class="form-field d-flex align-items-center">
          <span class="fas fa-key"></span>
          <input type="password" name="new_password" placeholder="Enter your new password">
      </div>
      <div class="form-field d-flex align-items-center">
          <span class="fas fa-key"></span>
          <input type="password" name="confirm_password" placeholder="Confirm your new password">
      </div>
      <button type="submit" class="reset-btn">Reset Password</button>
  </form>
</body>
</html>
