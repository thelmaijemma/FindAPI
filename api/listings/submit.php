<?php 
// Headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Submission.php';


// Instantiate DB and Connect
$database = new Database();
$db = $database->connect();


// Instantiate Listing Object
$submission = new Submission($db);

// Get The Raw POST data
$data = json_decode(file_get_contents("php://input"));

$submission->name = $data->name;
$submission->address = $data->address;
$submission->tags = $data->tags;


// Create Listing
if($submission->create()){
    echo json_encode(
        array('message' => 'Post Created')
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
"name": "name",
"address": "test",
"tags": "so, many, tags"
}

*/