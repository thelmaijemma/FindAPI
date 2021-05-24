<?php 
// for create and put - headers - application json
class Submission {
    // DB
    private $conn;
    private $table = 'submits';

    // Listing Properties
    public $name;
    public $address;
    public $tags;
  



    // Constructor With DB
    public function __construct($db){
        $this->conn = $db;

    }
            public function create(){
                // create query
                $query = 'INSERT INTO ' . 
                $this->table . 
                ' SET
                name = :name,
                address = :address,
                tags = :tags';

                // Prepare Statement
                echo 'this is query' . $query;
                $stmt = $this->conn->prepare($query);

                // Clean Data
                $this->name = htmlspecialchars(strip_tags($this->name));
                $this->address = htmlspecialchars(strip_tags($this->address));
                $this->tags = htmlspecialchars(strip_tags($this->tags));
               
                // Bind Data
                $stmt->bindParam(':name', $this->name);
                $stmt->bindParam(':address', $this->address);
                $stmt->bindParam(':tags', $this->tags);

                // Execute Query
                if($stmt->execute()) {
                    return true;
                }

                // Print Error if Something Goes Wrong
                printf("Error: %s ", $stmt->error);

            }

    }
