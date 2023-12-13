<?php
class DeleteManager {
   private $conn;
   
   public function __construct($conn) {
       $this->conn = $conn;
   }
   
   public function deletePost($postId) {
       $userId = $this->getUserId();
       $sql = "DELETE FROM posts WHERE id = ? AND user_id = ?";
       
       $stmt = $this->conn->prepare($sql);
       $stmt->bind_param("ii", $postId, $userId);
       
       if ($stmt->execute()) {
           echo "Post deleted successfully.";
       } else {
           echo "Error deleting post: " . $stmt->error;
       }
       
       $stmt->close();
   }
   
   private function getUserId() {
       return isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
   }
}

?>
