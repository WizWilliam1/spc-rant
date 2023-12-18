<?php
class Database { //Bali mao ni ang PARENT CLASS which is si "Database", then ang curly braces kay dre ipang intak ang tanan properties ug methods.
    private $conn; //Dre nag start ang iyang PROPERTIES
    private $servername = "localhost"; //Different sa PUBLIC ug PRIVATE [Public = Ma used sha ug iyang methods bisag asa nga maka access sa object]
    private $username = "root"; //Then ang PRIVATE [Kebali ma access ra sha within the class kung asa sha gi defined(So Other purpose nganong ni gamit ani especially kay naa ta sa sensitive data which is ang database then by using the private kay ma protect ni niya and mas secure)]
    private $password = "";
    private $dbname = "database";

//Then mao na dayon ni ang METHODS
    public function __construct() { //So ang gamit niya is, iyang eh automatically call ni niya nga object kebali if mag create kag method para sa object dadto sa class niya
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname); //So bali ang "$this" kay gamiton sha para ma access ang current object of the class [so mura ra shag tool bitaw nga aron ma gamit niya ang "$username"]

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        session_start(); //Bali mura ni shag sa engine like atong yabihan bitaw nga, pag once tawagon ni sha kay mo start na dayon ang iyang session like, kunwari nag login ka then na save imong data nga naka login naka tas pag ma tawag ni then auto start na iyang session.

        if (isset($_SESSION['Username'])) { //So bali ang gamit sa "isset" kay eh check niya if ang variable kay "empty" or naa nay naka "set/declared"
            $this->username = $_SESSION['Username']; //Tawagon nya si --> Username [Start ang Session (Check Username)]
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
