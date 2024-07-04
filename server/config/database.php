<?php
class Database {
    private $host = "localhost";
    private $db_name = "events_db";
    private $username = "root";
    private $password = "mayur013";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        // echo "<h1>hiii</h1>";
        // $conn_status = $this->conn ? "Connected" : "Not connected";
        // echo "<script>console.log('PHP: Connection status - " . $conn_status . "');</script>";

        return $this->conn;
    }
}

?>
