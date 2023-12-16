<?php
include 'database.php';

$Username = $_POST['Username'];
$Password = $_POST['Password'];

$sql = "SELECT user_id, Username, Role FROM accounts WHERE Username='$Username' AND Password='$Password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    session_start();
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['Username'] = $user['Username'];
    $_SESSION['Role'] = $user['Role'];

    $conn->close();

    // Redirect based on user role
    if ($_SESSION['Role'] == 'admin') {
        header("Location: admin_dashboard.php");
    } else {
        header("Location: dashboard.php");
    }
} else {
    echo '<script>alert("Invalid username or password"); window.location.href = "login.php?error=invalid";</script>';
    exit;
}
?>
