<?php 
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Listing.php';


// Instantiate DB and Connect
$database = new Database();
$db = $database->connect();


// Instantiate Tweet Object
$listing = new Listing($db);

// Listing Query
$result = $listing->read();
// Get Row Count 
$num = $result->rowCount();

// Check to See if any Listings
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
            'google_id' => $google_id,
            'website' => $website,
            'area-array' => $area_array
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