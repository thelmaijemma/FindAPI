<?php 
// postman http://localhost/cftweets/api/tweets/read_single.php?id=1
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Listing.php';


// Instantiate DB and Connect
$database = new Database();
$db = $database->connect();


// Instantiate Listing Object
$listing = new Listing($db);

$listing->search = isset($_GET['search']) ? $_GET['search'] : die();





// Listing Query
$result = $listing->search_match();
// Get Row Count 
$num = $result->rowCount();

if($num > 0){
    $listings_arr = array();
    $listings_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $listing_item = array(
            'business_id' => $business_id,
            'listing_name' => html_entity_decode($listing_name),
            'address' => $address,
            'postal_code' => $postal_code,
            'position' => $position,
            'website' => $website,
            'area-array' => $area_array,
            'tag-array' => $tag_array
        );

        // Push to 'data'
        array_push($listings_arr['data'], $listing_item);
    }

    // Turn to JSON & Output
    echo json_encode($listings_arr);


 }else {
    // No Posts
    echo json_encode(
        array('message' => 'no posts found')
    );
 }






 


 