<?php
include 'database.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$Username = $_POST['Username'];
$Password = $_POST['Password'];

$sql = "SELECT Username, Password FROM accounts WHERE Username='$Username' AND Password='$Password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

session_start();
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['Username'] = $user['Username'];
    
    $conn->close();
    header("Location: success_log.html");
} else{
    header("Location: login.php?error=invalid"); exit;
}
?>