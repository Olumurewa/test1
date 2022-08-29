<?php 
    session_start();
    define('BASEPATH', true);
    ini_set('error_reporting', E_ALL);
    require 'controller/dbFunctions.php';
    require 'index.view.php';

    echo "<h1>LOGIN</h1><br/><form action='index.php' method='post'><input type='email' name='email' placeholder='E Mail'><br/><input type='password' name='password' placeholder='Password'><br/><button name='submit' type='submit'>sign in</button> </form>"  ;
    if(isset($_POST['submit'])){  
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
        $passwordAttempt = !empty($_POST['password']) ? trim($_POST['password']) : null;
  
    
    }

