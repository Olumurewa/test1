<?php
    session_start();
    define('BASEPATH', true);
    ini_set('error_reporting', E_ALL);
    require 'controller/dbFunctions.php';
    include 'index.view.php';

    
    if(!isset($_SESSION['email'])){
        echo '<script>alert("Unauthenticated")</script>';
        echo '<script>window.location.replace("index.php");</script>';
    }
    echo "<form method='post' action='verify.php'><input type='text' name='token' placeholder='OTP'><br/><button name='submit' type='submit'>sign in</button> </form>";
    
    $func = new dbFunction();
    $func->verify($otp);
    
      

?>



