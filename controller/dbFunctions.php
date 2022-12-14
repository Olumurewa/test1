<?php
require 'config/db.php';

class dbFunction{

    /**
     * Function for user registeration
     * @param string $email
     * @param string $pass
     * @param string $isVerified
     */

    public function Register($email, $pass, $isVerified)
    {
        try {
            $db = new DbConn();
            $sql = "INSERT INTO `users` (email, password, isVerified) VALUES (:email, :password,:isVerified)";
            $stmt = $db->conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $pass);
            $stmt->bindParam(':isVerified', $isVerified);
           
            $stmt->execute();
            if($stmt){
                echo '<script>alert("New account created: ")</script>';
                echo '<script>window.location.replace("login.php")</script>';
                
            }else{
                echo '<script>alert("An error occurred")</script>';
            }
            return true;
        }catch(PDOException $e)
        {
            $error = "Error: " . $e->getMessage();
            echo '<script type="text/javascript">alert("'.$error.'");</script>';
        }
        
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
        try{
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
                echo '<script>window.location.replace("verify.php");</script>';
                exit; 
            } 
            else
            {
                echo '<script>alert("invalid username or password")</script>';
            }
        }catch(PDOException $e) 
        {
            $error = "Error: " . $e->getMessage();
            echo '<script type="text/javascript">alert("'.$error.'");</script>';
        }
        
    }


    public function destroy($otp)
    {
        $db = new DbConn();
        try{
            $sql = "DELETE FROM `otp` WHERE otp = :otp";
            $stmt = $db->conn->prepare($sql);
            $stmt->bindValue(':otp', $otp);
    
            if ($stmt->execute())
            {
                echo '<script>alert("congratulations! You have logged in")</script>';
            }
        }catch(PDOException $e) 
        {
            $error = "Error: " . $e->getMessage();
            echo '<script type="text/javascript">alert("'.$error.'");</script>';
        }
    }



    public function verify($otp)
    {
        $db = new DbConn();
        try
        {
            $sql = "SELECT * FROM `otp` WHERE otp = :otp";
            $stmt = $db->conn->prepare($sql);
            $stmt->bindValue(':otp', $otp);
            $stmt->execute();
            $stmt->fetch(PDO::FETCH_ASSOC);
            if($stmt)
            {
                $_SESSION['otp']=$otp;
                dbFunction::destroy($otp);  
            } 
            else 
            {
                session_destroy(); 
                echo '<script>alert("Error!!!")</script>';
                echo '<script>window.location.replace("index.php");</script>';
        
            }
        }catch(PDOException $e) 
        {
            $error = "Error: " . $e->getMessage();
            echo '<script type="text/javascript">alert("'.$error.'");</script>';
        }
        
        
    }

    
}