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

$errorname = 'error';


// Get ID
$listing->business_id = isset($_GET['id']) ? $_GET['id'] : die();




// Get Post
$listing->read_single();



// Create Array
$listing_arr = array(
    'info' => $listing->info,
    'business_id' => $listing->business_id,
    'listing_name' => $listing->listing_name,
    'address' => $listing->address,
    'postal_code' => $listing->postal_code,
    'lat' => $listing->lat,
    'lng' => $listing->lng,
    'website' => $listing->website,
    'areas' => $listing->areas,
    'tags' => $listing->tags
);

// Make Json
print_r(json_encode($listing_arr));



