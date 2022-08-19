<?php
defined('BASEPATH') OR exit('No direct script access allowed');


function otpGen($userID,$otp){
    $servername = "localhost";
    $username = "root";
    $password = "password";
    $dbname="test";
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $isExpired = 0;
    try{
        $otpstore = $conn->prepare("INSERT INTO `otp` (otp, isExpired, userID) 
        VALUES ($otp,$isExpired,$userID)");
        // $otpstore = $conn->prepare("INSERT INTO `otp` VALUES ($otp,$isExpired,$email)");
        // $otpstore->bindparam(':otp', $otp);
        // $otpstore->bindparam(':isExpiired', $isExpired);
        // $otpstore->bindparam(':email', $email);
        $otpstore->execute();
    }catch(PDOException $e) {
        $error = "Error: " . $e->getMessage();
        echo '<script type="text/javascript">alert("'.$error.'");</script>';
    }
    return $otp;
}