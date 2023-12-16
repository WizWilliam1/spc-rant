<?php
include 'database.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['deletePost'])) {
    $postIdToDelete = $_POST['post_id'];

    $stmt = $conn->prepare("DELETE FROM posts WHERE id = ?");
    $stmt->bind_param("i", $postIdToDelete);

    if ($stmt->execute()) {
        $stmt = $conn->prepare("DELETE FROM comments WHERE post_id = ?");
        $stmt->bind_param("i", $postIdToDelete);
        $stmt->execute();

        $stmt->close();

        $sqlUpdate = "SET @num := 0;
                     UPDATE posts SET id = @num := @num + 1;";
        if ($conn->multi_query($sqlUpdate) === TRUE) {
            header("Location: admin_dashboard.php");
            exit;
        } else {
            echo "Error updating post IDs: " . $conn->error;
        }
    } else {
        echo "Error deleting post: " . $stmt->error;
        exit;
    }
} else {
   header("Location: admin_dashboard.php");
   exit;
}
?>