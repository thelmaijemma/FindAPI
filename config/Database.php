<?php 
class Database {
    // DB Params
    private $host = 'localhost';
    private $db_name = 'database';
    private $username = 'username';
    private $password = 'password';
    private $port = '3307';
    private $conn;

    // DB Connect Method
    public function connect(){
        $this->conn = null;

        try{
            $this->conn = new PDO('mysql:host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->db_name,
            $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }

        return $this->conn; 
    }
}