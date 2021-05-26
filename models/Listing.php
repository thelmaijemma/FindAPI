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
    public $lat;
    public $lng;
    public $website;
    public $tags;
    public $areas;
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
            l.lat,
            l.lng,
            l.website,
            l.tags,
            l.areas
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
            . " WHERE CONCAT_WS('', tags, areas, address) LIKE ?";

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
            l.lat,
            l.lng,
            l.website,
            l.tags,
            l.areas
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
             $this->lat = $row['lng'];
             $this->lat = $row['lng'];
             $this->website = $row['website'];
             $this->areas = $row['areas'];
             $this->tags = $row['tags'];

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
                lat = :lat,
                lng = :lng,
                website = :website,
                tags = :tags,
                areas = :areas';

                // Prepare Statement
                echo 'this is query' . $query;
                $stmt = $this->conn->prepare($query);

                // Clean Data
                $this->listing_name = htmlspecialchars(strip_tags($this->listing_name));
                $this->address = htmlspecialchars(strip_tags($this->address));
                $this->postal_code = htmlspecialchars(strip_tags($this->postal_code));
                $this->lat = htmlspecialchars(strip_tags($this->lat));
                $this->lng = htmlspecialchars(strip_tags($this->lng));
                $this->website = htmlspecialchars(strip_tags($this->website));
                $this->tags = htmlspecialchars(strip_tags($this->tags));
                $this->areas = htmlspecialchars(strip_tags($this->areas));
               
                // Bind Data
                $stmt->bindParam(':listing_name', $this->listing_name);
                $stmt->bindParam(':address', $this->address);
                $stmt->bindParam(':postal_code', $this->postal_code);
                $stmt->bindParam(':lat', $this->lat);
                $stmt->bindParam(':lng', $this->lng);
                $stmt->bindParam(':website', $this->website);
                $stmt->bindParam(':tags', $this->tags);
                $stmt->bindParam(':areas', $this->areas);

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
                tags = :tags 
                WHERE
                    business_id = :id
                ';

                // Prepare Statement
                echo 'this is query' . $query;
                $stmt = $this->conn->prepare($query);

                // Clean Data
                $this->tags = htmlspecialchars(strip_tags($this->tags));
                $this->business_id = htmlspecialchars(strip_tags($this->business_id));
               
                // Bind Data
                $stmt->bindParam(':tags', $this->tags);
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
                $this->tags = htmlspecialchars(strip_tags($this->tags));
                $this->business_id = htmlspecialchars(strip_tags($this->business_id));
               
                // Bind Data
                $stmt->bindParam(':tags', $this->tags);
                 $stmt->bindParam(':id', $this->business_id);



                // Execute Query
                if($stmt->execute()) {
                    //return true;
                }

                // Print Error if Something Goes Wrong
                printf("Error: %s ", $stmt->error);

            }




    }
