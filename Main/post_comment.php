<?php
include 'database.php';

// Check if a session is not already active
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Validate and sanitize inputs
  $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
  $user_id = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : 0;
  $comment = isset($_POST['comment']) ? htmlspecialchars($_POST['comment']) : '';

  // Insert into comments table
  $stmt = $conn->prepare("INSERT INTO comments (post_id, user_id, comment) VALUES (?, ?, ?)");
  if ($stmt === false) {
      die("Error preparing statement: " . $conn->error);
  }

  $stmt->bind_param("iis", $post_id, $user_id, $comment);
  if ($stmt->execute() === false) {
      die("Error executing statement: " . $stmt->error);
  }

  // Redirect to the same page
  header("Location: " . $_SERVER['REQUEST_URI']);
  exit; // Ensure the script stops executing after the header function
}
?>