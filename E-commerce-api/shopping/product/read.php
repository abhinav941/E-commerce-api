<?php 

//including header of the read file
header("Access-Control-Allow-Origin : * ");
header("Content-Type:application/json;charset=UTF-8");
header("Access-Control-Allow-Credentials:true");


//include the database connecting files
include_once '../config/database.php';
include_once '../objects/product.php';

//instantiate database and product
$database = new Database();
$db = $database->getConnection();

//initialize the object
$product = new Product($db);

// we will created the read method for reading the products from the record 
// if $num>0 means record is there and we set reponse to 200 ok;
// the show the data using json file to user.

//query products
$stmt = $product->read();
$num = $stmt->rowCount();

//check if more than 0 records ....
if($num>0){
    $products_arr = array();
    $products_arr["records"] = array();
    
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $product_item=array(
            "id"=>$id,
            "name"=>$name,
            "description"=>html_entity_decode($description),
            'price'=>$price,
            "category_id"=>$category_id,
            "category_name"=>$category_name
        );
        array_push($products_arr["records"],$product_item);
        
    }
    
    http_response_code(200);
    
    echo json_encode($products_arr);    
}
    
else{
    http_response_code(404);
    
    echo json_encode(
    array("message"=>"No product Found."));}
?>