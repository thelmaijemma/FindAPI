<?php 
// for create and put - headers - application json
class Listing {
    // DB
    private $conn;
    private $table = 'listings';

    // Listing Properties
    public $business_id;
    public $listing_name;
    public $address;
    public $postal_code;
    public $google_id;
    public $website;
    public $tag_array;
    public $area_array;
    public $info;
    public $search;



    // Constructor With DB
    public function __construct($db){
        $this->conn = $db;

    }

        // Get Listings
        public function read(){
            $query = 'SELECT 
            i.info as business_attr,
            l.business_id,
            l.listing_name,
            l.address,
            l.postal_code,
            l.google_id,
            l.website,
            l.tag_array,
            l.area_array
            FROM
            ' . $this->table . ' l
            LEFT JOIN 
            idjoin i ON l.business_id = i.business_id
            ORDER BY
            l.business_id DESC';


            // Prepare Statement 
            $stmt = $this->conn->prepare($query);

            // execute statement
            $stmt->execute();


            return $stmt;

        }

// Get Listings BY CATEGORY MATCH/ SEARCH
public function search_match(){
            $query = "SELECT * FROM " 
            . $this->table 
            . " WHERE tag_array LIKE ?";

            // LIMIT 10

             // Prepare Statement 
             $stmt = $this->conn->prepare($query);

             // Bind Id
             
            $stmt->bindParam(1, $this->search);
            // return $this->search; (%refill%)
            
             // Execute Query
            $stmt->execute();

            //$row = $stmt->fetch(PDO::FETCH_ASSOC);

            return $stmt;
    
           

            

        }



        // Get Single Tweet
        public function read_single(){
            $query = 'SELECT 
           i.info as info,
            l.business_id,
            l.listing_name,
            l.address,
            l.postal_code,
            l.google_id,
            l.website,
            l.tag_array,
            l.area_array
            FROM
            ' . $this->table . ' l
            LEFT JOIN 
            idjoin i ON l.business_id = i.business_id
            WHERE
            l.business_id = ?
            LIMIT 0,1';

            
             // Prepare Statement 
             $stmt = $this->conn->prepare($query);
             

             // Bind Id
             $stmt->bindParam(1, $this->business_id);

             // Execute Query
             $stmt->execute();

             $row = $stmt->fetch(PDO::FETCH_ASSOC);

             // Set Properties
             $this->business_id = $row['business_id'];
             $this->listing_name = $row['listing_name'];
             $this->address = $row['address'];
             $this->postal_code = $row['postal_code'];
             $this->google_id = $row['google_id'];
             $this->website = $row['website'];
             $this->area_array = $row['area_array'];
             $this->tag_array = $row['tag_array'];

        }

            // Create Post


            public function create(){
                // create query
                $query = 'INSERT INTO ' . 
                $this->table . 
                ' SET
                listing_name = :listing_name,
                address = :address,
                postal_code = :postal_code,
                google_id = :google_id,
                website = :website,
                tag_array = :tag_array,
                area_array = :area_array';

                // Prepare Statement
                echo 'this is query' . $query;
                $stmt = $this->conn->prepare($query);

                // Clean Data
                $this->listing_name = htmlspecialchars(strip_tags($this->listing_name));
                $this->address = htmlspecialchars(strip_tags($this->address));
                $this->postal_code = htmlspecialchars(strip_tags($this->postal_code));
                $this->google_id = htmlspecialchars(strip_tags($this->google_id));
                $this->website = htmlspecialchars(strip_tags($this->website));
                $this->tag_array = htmlspecialchars(strip_tags($this->tag_array));
                $this->area_array = htmlspecialchars(strip_tags($this->area_array));
               
                // Bind Data
                $stmt->bindParam(':listing_name', $this->listing_name);
                $stmt->bindParam(':address', $this->address);
                $stmt->bindParam(':postal_code', $this->postal_code);
                $stmt->bindParam(':google_id', $this->google_id);
                $stmt->bindParam(':website', $this->website);
                $stmt->bindParam(':tag_array', $this->tag_array);
                $stmt->bindParam(':area_array', $this->area_array);

                // Execute Query
                if($stmt->execute()) {
                    return true;
                }

                // Print Error if Something Goes Wrong
                printf("Error: %s ", $stmt->error);

            }



            public function update(){
                // create query
                /*$query = 'UPDATE ' . 
                $this->table . 
                ' SET
                listing_name = :listing_name,
                address = :address,
                postal_code = :postal_code,
                google_id = :google_id,
                website = :website,
                tag_array = :tag_array,
                area_array = :area_array
                WHERE
                    business_id = :id
                ';
              */

                $query = 'UPDATE ' . 
                $this->table . 
                ' SET 
                tag_array = :tag_array 
                WHERE
                    business_id = :id
                ';

                // Prepare Statement
                echo 'this is query' . $query;
                $stmt = $this->conn->prepare($query);

                // Clean Data
                $this->tag_array = htmlspecialchars(strip_tags($this->tag_array));
                $this->business_id = htmlspecialchars(strip_tags($this->business_id));
               
                // Bind Data
                $stmt->bindParam(':tag_array', $this->tag_array);
                 $stmt->bindParam(':id', $this->business_id);

                // Execute Query
                if($stmt->execute()) {
                    return true;
                }

                // Print Error if Something Goes Wrong
                printf("Error: %s ", $stmt->error);

                 

            

                // Prepare Statement
                echo 'this is query' . $query;
                $stmt = $this->conn->prepare($query);

                // Clean Data
                $this->tag_array = htmlspecialchars(strip_tags($this->tag_array));
                $this->business_id = htmlspecialchars(strip_tags($this->business_id));
               
                // Bind Data
                $stmt->bindParam(':tag_array', $this->tag_array);
                 $stmt->bindParam(':id', $this->business_id);



                // Execute Query
                if($stmt->execute()) {
                    //return true;
                }

                // Print Error if Something Goes Wrong
                printf("Error: %s ", $stmt->error);

            }




    }
