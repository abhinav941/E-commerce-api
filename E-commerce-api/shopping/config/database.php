<?php 

class Database{
    
    // specifying the database details....
    private $server = 'localhost';
    private $db_name = 'api_db';
    private $username ="root";
    private $password = "";
    
    //get the database connection 
     public function getConnection(){
        $this->conn = null;
        try{
            $this->conn = new PDO("mysql:host=localhost;dbname=api_db",$this->username,$this->password);
            $this->conn->exec("set names utf8");
        }
        catch (PDOException $exception){
            echo "Connection error: ".$exception->getMessage();
        }
        return $this->conn;
    }
    
}

?>