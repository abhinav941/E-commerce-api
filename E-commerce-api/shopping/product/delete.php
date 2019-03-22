<?php 

header("Access-Control-Allow-Origin:*");
header("Acces-Control-Allow-Headers:Content-Type,Access-Control-Allow-Headers,Authorization,X-Requested-With");
header("Access-Control-Allow-Methods:POST");
header("Content-Type:application/json");
header("Access-Control-Allow-Credentials:true");
header("Access-Control-Max-Age:3600");

//include databse and product
include_once "../config/database.php";
include_once "../objects/product.php";

//instantiate database
$database =new Database();
$connect = $database->getConnection();


//initiate the product
$product = new Product($connect);


$data = json_decode(file_get_contents("php://input"));
$product->id = $data->id;

if($product->delete()){
    http_response_code(200);
    
    echo json_encode(array("message"=>"Product is deleted","type"=>"success"));
    
}
else{
    http_response_code(503);
    
    echo json_encode(array("message"=>"Product can't be deleted","type"=>"danger"));
}
?>