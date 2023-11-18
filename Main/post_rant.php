<?php
include 'database.php';
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 $TITLE = $_POST['TITLE'];
 $CONTENT = $_POST['CONTENT'];
 
// Use the getUserID() method from the Database class
$userId = $db->getUserID();

 $stmt = $conn->prepare("INSERT INTO posts (TITLE, CONTENT, USER_ID) VALUES (?, ?, ?)");
 if ($stmt === false) {
     die("Error preparing statement: " . $conn->error);
 }

 $stmt->bind_param("ssi", $TITLE, $CONTENT, $userId);
 if ($stmt->execute() === false) {
     die("Error executing statement: " . $stmt->error);
 }

 $successMessage = "Post created successfully!";
 echo "<script>alert('$successMessage'); window.location.href = 'rant.php';</script>";
}
?>