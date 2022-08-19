<?php

defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('error_reporting', E_ALL);
$servername = "localhost";
$username = "root";
$password = "password";
$dbname="test";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    //echo "Connected successfully";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

function otpGenerate(){
    $otp = rand(100000,999999);
    return $otp;
}

function allUsers(){
    $servername = "localhost";
    $username = "root";
    $password = "password";
    $dbname="test";
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $stmnt = $conn->prepare('SELECT * FROM `users` ');
    $stmnt->execute();

    var_dump(json_encode($stmnt->fetchAll(PDO::FETCH_OBJ)));
    //print_r($stmnt);
}

function oneUser($id){
    $servername = "localhost";
    $username = "root";
    $password = "password";
    $dbname="test";
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $stmt = $conn->prepare("SELECT * FROM `users` WHERE UserID=?");
    $stmt->execute([$id]); 
    $user = $stmt->fetch(PDO::FETCH_OBJ);
    var_dump(json_encode($user));
}

function eUser($email){
    $servername = "localhost";
    $username = "root";
    $password = "password";
    $dbname="test";
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $stmt = $conn->prepare("SELECT `users.userID` FROM `users` WHERE email = ?");
    $stmt->execute([$email]); 
    $user = $stmt->fetch(PDO::FETCH_OBJ);
    return $user;

    echo $email;
    echo 'Hello World!';
}

function updateUser($id){
    $servername = "localhost";
    $username = "root";
    $password = "password";
    $dbname="test";
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $stmt = $conn->prepare("UPDATE`users` SET email=?, password=?, isVerrified=? WHERE UserID=?");
    try {
        $conn->beginTransaction();
            $stmt->execute($id);
        $conn->commit();
    }catch (Exception $e){
        $conn->rollback();
        throw $e;
}
}

    