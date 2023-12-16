<?php
include "database.php";

$Email_or_Phone = $_POST['Email_or_Phone'];
$Username = $_POST['Username'];
$Password = $_POST['Password'];

// Set a default role value ('user') for the 'role' column
$role = 'user';

$sql = "INSERT INTO accounts (Email_or_Phone, Username, Password, role)
VALUES ('$Email_or_Phone', '$Username', '$Password', '$role')";

if ($conn->query($sql) === TRUE) {
    header("Location: success_reg.html");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>