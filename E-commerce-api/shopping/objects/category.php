<?php

class Category{
    
    private $conn;
    private $table_name = "categories";
    
    public $name;
    public $id;
    public $description;
//    public $created;
    
    function __construct($db){
        $this->conn = $db;
    }
    
    function read(){
        $query = "SELECT id,name,description FROM
        ". $this->table_name ."
            ORDER BY 
                name";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>