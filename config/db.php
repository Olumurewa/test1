<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class DbConn {
    protected $conn;

    function connect(){
        try{
            require('config.php');
            $conn = new PDO("mysql:host=$DB_HOST; dbname=$DB_DATABSE", $DB_USER, $DB_PASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            if(!$conn){
                die("Error connecting to database");
            }
            return $conn;
        }
        catch(PDOException $e)
        {
            $error = "Error: " . $e->getMessage();
            echo '<script type="text/javascript">alert("'.$error.'");</script>';
        }
        
    }
  
}



    
