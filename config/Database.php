<?php 
class Database {
    // DB Params
    // heroku ysql url: mysql://b3fffe5008c3c2:2b670a96@eu-cdbr-west-01.cleardb.com/heroku_78228f7c75a06d5?reconnect=true
    // username:password
    // @ host
    /*
    private $cleardb_url = parse_url(getenv("mysql://b3fffe5008c3c2:2b670a96@eu-cdbr-west-01.cleardb.com/heroku_78228f7c75a06d5?reconnect=true"));
    private $cleardb_server = $cleardb_url["eu-cdbr-west-01.cleardb.com"];
    private $cleardb_username = $cleardb_url["b3fffe5008c3c2"];
    private $cleardb_password = $cleardb_url["2b670a96"];
    private $cleardb_db = substr($cleardb_url["/heroku_78228f7c75a06d5?reconnect=true"],1);
    private $active_group = 'default';
    private $query_builder = TRUE;
    // Connect to DB
    private $conn; 
    */

    // heroku ysql url: mysql://b3fffe5008c3c2:2b670a96@eu-cdbr-west-01.cleardb.com/heroku_78228f7c75a06d5?reconnect=true
    
    
    private $host = 'eu-cdbr-west-01.cleardb.com';
    private $db_name = 'heroku_78228f7c75a06d5';
    private $username = 'b3fffe5008c3c2';
    private $password = '2b670a96';
    private $port = '3306';
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

// $this->conn->mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);