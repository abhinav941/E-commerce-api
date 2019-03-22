<?php 
header("Access-Control-Allow-Origin :*");
header("Access-Control-Allow-Methods:GET");
header("Access-Control-Allow-Headers:access");
header("Access-Control-Allow-Credentials:true");
header("Content-Type:application/json");

//including database and the product 
include_once '../config/database.php';
include_once '../objects/product.php';

//instantiate database
$database = new Database();
$connect = $database->getConnection();

//initialize the product
$product = new Product($connect);

//getting the id of the product to show
$product->id = isset($_GET['id']) ? $_GET['id'] : die();
$product->readOne();

if($product->name!=null){
    $product_arr = array(
        "id"=>$product->id,
        "name"=>$product->name,
        "description"=>$product->description,
        "category_id"=>$product->category_id,
        "category_name"=>$product->category_name
    );
    http_response_code(200);
    
    echo json_encode($product_arr);
}
else{
    http_response_code(404);
    
    echo json_encode(array("message"=>"No Product found"));
}


?>