<?php
include 'database.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
function getDashboardRedirect() {
    // Check the user's role stored in the session and return the appropriate redirection
    if ($_SESSION['Role'] == 'admin') {
        return 'location.href=\'admin_dashboard.php\'';
    } else {
        return 'location.href=\'dashboard.php\'';
    }
}
?>

<!DOCTYPE html>
<html data-theme="light">

<head>
	<meta charset="UTF-8" />
	<title>SPC Rant</title>
	<link rel="stylesheet" href="styles.css">
	<link href="https://fonts.googleapis.com/css?family=Allerta+Stencil" rel="stylesheet">
	<link rel="icon" type="image/x-icon" href="favicon.ico">
	<script src="function.js"></script>
</head>

<body>
	<div class="rant_now"></div>
	<div class="centered">
		<div style="margin: 50px;"> <img src="images/spc-ccs.png" alt="Logo" /> </div>
	</div>
	<div class="spc_rant">SPC RANT</div>
	<div class="rectangle"></div> 
	<img src="d&n.png" class="clickable-icon" id="theme-toggle" onclick="myFunction()" alt="Toggle dark mode">
	<button class="sign_in" role="button" onclick="<?php echo isset($_SESSION['Username']) ? getDashboardRedirect() : 'location.href=\'login.php\'' ?>">
   <?php
      if (isset($_SESSION['Username'])) {
         echo "Dashboard";
      } else {
         echo "Sign In";
      }
   ?>
</button>
	<button class="rant_now" role="button" onclick="location.href='rant.php'">Rant Now</button>
	
<script>window.onload = applySavedTheme;</script>

</body>

</html>
