<?php
include 'database.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 $TITLE = $_POST['TITLE'];
 $CONTENT = $_POST['CONTENT'];
 
// Use the getUserID() method from the Database class
$userId = $db->getUserID();

 $stmt = $conn->prepare("INSERT INTO posts (TITLE, CONTENT, user_id) VALUES (?, ?, ?)");
 if ($stmt === false) {
     die("Error preparing statement: " . $conn->error);
 }

 $stmt->bind_param("ssi", $TITLE, $CONTENT, $user_id);
 if ($stmt->execute() === false) {
     die("Error executing statement: " . $stmt->error);
 }

 $successMessage = "Post created successfully!";
 echo "<script>alert('$successMessage'); window.location.href = 'rant.php';</script>";
}
?>