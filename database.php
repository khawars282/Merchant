<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Database{

    public function build_connection(){     //build sql database connection 
        $conn = new mysqli("localhost","root","","merchant_db");
        if ($conn->connect_error){
            echo "Database Connection Error";
        }
        else{
            return $conn;
        }
    }
    public function close_connection($conn){   //close database connection
        $conn->close();
    }

    // This functioon is used to search with specific  id.
     
    function searchById($tableName,$id)
    {
        $conn = self::build_connection();
        $sql = "SELECT * FROM ".$tableName ." WHERE id LIKE id='{$id}'";
        $result = $conn->query($sql) or die("SQL Query Failed.");

        if(mysqli_num_rows($result) > 0 ){
            
            $output = $result->fetch_assoc();
            return $output;
        }else{

            return json_encode(array("message"=>'No Search Found.'));
        }   
        self::close_connection($conn);
    }

    // This functioon is used to search with specific  id.

    function list($tableName)
    {
        $conn = self::build_connection();
        $sql = "SELECT * FROM ".$tableName ."";
        $result = $conn->query($sql) or die("SQL Query Failed.");

        if(mysqli_num_rows($result) > 0 ){
            
            $output = $result->fetch_all();
            // print_r($output);
            echo json_encode($output);
            return $output;
        }else{

            return json_encode(array("message"=>'No Search Recod Found.'));
        }   
        self::close_connection($conn);
        
    }
}
?>