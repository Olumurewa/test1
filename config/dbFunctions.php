<?php

session_start();
require 'db.php';

class dbFunction{

    /**
     * Function for user registeration
     * @param string $email
     * @param string $pass
     * @param string $isVerified
     */

    public function Register($email, $pass, $isVerified)
    {
        $db = new DbConn();
        $stmt = $db->conn->prepare("INSERT INTO `users` (email, password, isVerified) 
                    VALUES (:email, :password,:isVerified)");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $pass);
        $stmt->bindParam(':isVerified', $isVerified);
        echo '<script>alert("An error occurred")</script>';
        $stmt->execute();
        if($stmt->execute()){
            echo '<script>alert("New account created: ")</script>';
            echo '<script>window.location.replace("index.php")</script>';
            
        }else{
            echo '<script>alert("An error occurred")</script>';
        }
        return true;
    }
    /**
     * Function to generate OTP
     * @param int $userID
     */

    public function OtpGenerator($userID)
    {
        $otp = rand(100000, 999999);
        $db = new DbConn();
        $isExpired = 0;
        try
        {
            $otpstore = $db->conn->prepare("INSERT INTO `otp` (otp, isExpired, userID) 
            VALUES ($otp,$isExpired,$userID)");
            $otpstore->execute();
            echo '<script type="text/javascript">alert("COPY: '.$otp.'");</script>';
            echo '<script>window.location.replace("verify.php");</script>';
        }
        catch(PDOException $e) 
        {
            $error = "Error: " . $e->getMessage();
            echo '<script type="text/javascript">alert("'.$error.'");</script>';
        }
        return $otp;

    }

    /**
     * Function to handle login
     * @param string $email
     * @param string $passwordAttempt
     * 
     */
    public function Login($email, $passwordAttempt)
    {
        $db = new DbConn();
        $sql = "SELECT * FROM `users` WHERE email = :email";
        $stmt = $db->conn->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if($user === false)
        {
            echo '<script>alert("invalid email or password")</script>';
        } 
        else
        {
            $validPassword = password_verify($passwordAttempt, $user['password']);
        }
        if($validPassword)
        {
            $_SESSION['email'] = $email;
            $_SESSION['userID'] = $user['userID'];
            dbFunction::OtpGenerator($user['userID']);
            exit; 
        } 
        else
        {
            echo '<script>alert("invalid username or password")</script>';
        }
    }


    public function destroy($otp){
        require 'config/db.php';
        $sql = "DELETE FROM `otp` WHERE otp = :otp";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':otp', $otp);
 
        if ($stmt->execute())
        {
            echo '<script>alert("congratulations!")</script>';
        }
    }

    public function verify($otp)
    {
        $db = new DbConn();
        $sql = "SELECT * FROM `otp` WHERE otp = :otp";
        $stmt = $db->conn->prepare($sql);
        $stmt->bindValue(':otp', $otp);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $id = $_SESSION['user'];
        if (isset($id)){
            if($user['userID'] === $id)
            {
                dbFunction::destroy($otp);  
            } 
            else 
            {
                session_destroy(); 
                echo '<script>alert("Error!!!")</script>';
                echo '<script>window.location.replace("index.php");</script>';
    
            }
        }
    }

    
}