<?php
include "database.php";

$Email_or_Phone = $_POST['Email_or_Phone'];
$Username = $_POST['Username'];
$Password = $_POST['Password'];

$sql = "INSERT INTO accounts (Email_or_Phone, Username, Password)
VALUES ('$Email_or_Phone', '$Username', '$Password')";

if ($conn->query($sql) === TRUE) {
    header("Location: success_reg.html");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>