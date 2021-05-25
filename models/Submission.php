<?php 
// POST
// https://wellfindapi.herokuapp.com/api/listings/submit.php
class Submission {
    // DB
    private $conn;
    private $table = 'submits';

    // Listing Properties
    public $name;
    public $address;
    public $tags;
    public $update;
  



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
                tags = :tags,
                update = :update';

                // Prepare Statement
                echo 'this is query' . $query;
                $stmt = $this->conn->prepare($query);

                // Clean Data
                $this->name = htmlspecialchars(strip_tags($this->name));
                $this->address = htmlspecialchars(strip_tags($this->address));
                $this->tags = htmlspecialchars(strip_tags($this->tags));
                $this->update = htmlspecialchars(strip_tags($this->update));
               
                // Bind Data
                $stmt->bindParam(':name', $this->name);
                $stmt->bindParam(':address', $this->address);
                $stmt->bindParam(':tags', $this->tags);
                $stmt->bindParam(':update', $this->update);

                // Execute Query
                if($stmt->execute()) {
                    return true;
                }

                // Print Error if Something Goes Wrong
                printf("Error: %s ", $stmt->error);

            }

    }
