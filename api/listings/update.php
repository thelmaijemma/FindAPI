<?php 
// Headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Listing.php';


// Instantiate DB and Connect
$database = new Database();
$db = $database->connect();


// Instantiate Listing Object
$listing = new Listing($db);

// Get The Raw POST data
$data = json_decode(file_get_contents("php://input"));

// Set ID to UPDATE
$listing->business_id = $data->id;




// update: name
$listing->tag_array = $data->tag_array;

/* other
$listing->address = $data->address;
$listing->postal_code = $data->postal_code;
$listing->google_id = $data->google_id;
$listing->website = $data->website;
$listing->tag_array = $data->tag_array;
$listing->area_array = $data->area_array;*/


// Create Listing

if($listing->update()){
    echo json_encode(
        array('message' => 'Post Updated')
    );
} else {
    echo json_encode(
        array('message' => 'Listing Not Created')
    );
}


/*

REQUEST SAMPLE
post CONTENT TYPE APPLICATION/JSON
BODY - RAW
{
"listing_name": "name",
"address": "test",
"postal_code": "n15 4qt",
"google_id": "google_id",
"website": "website",
"tag_array": "tag_array, array",
"area_array": "area_array, array"
}

*/