<?php
class Database {
    private $conn;
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "database";

    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        session_start();

        if (isset($_SESSION['Username'])) {
            $this->username = $_SESSION['Username'];
        }
    }

    public function getUsername() {
        return $this->username;
    }

    public function getConnection() {
        return $this->conn;
    }

    public function getUserID() {
        return isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
    }
}

// Create connection
$db = new Database();
$conn = $db->getConnection();
?>
