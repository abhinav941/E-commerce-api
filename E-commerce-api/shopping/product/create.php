<?php 

header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json;charset=UTF-8");
header("Acces-Control-Allow-Methods:POST");
header("Access-Control-Max-Age:3600");
header("Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Headers,Authorization,X-Requested-With");

//get database connection and get product object
include_once '../config/database.php';
include_once '../objects/product.php';

//instantiate database
$database =  new Database();
$connect = $database->getConnection();

//initiate product
$product =  new Product($connect);

//get posted data 
$data = json_decode(file_get_contents("php://input"));

if(!empty($data->name) && !empty($data->price) && !empty($data->description) && !empty($data->category_id)){
    $product->name=$data->name;
    $product->price=$data->price;
    $product->description=$data->description;
    $product->category_id=$data->category_id;
    $product->created = date('Y-m-d H:i:s');
    
    if($product->create()){
        http_response_code(201);
        
        echo json_encode(array("message"=>"Product was succesfully created"));
        
    }
    else{
        http_response_code(503);
        
        echo json_encode(array("message"=>"Product unable to create"));
    }
}
else{
    http_response_code(400);
    
    echo json_encode(array("message"=>"data was incomplete"));
}
?>