<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
</head>
<body>
    <h1>LOGIN</h1><br/>
    <form action="index.php" method="post">                          
    <input type="email" name="email" placeholder="E Mail"><br/>
    <input type="password" name="password" placeholder="Password"><br/>   
    <button name="submit" type="submit">sign in</button>
    </form>
    <?php 
    session_start();
    define('BASEPATH', true);
    ini_set('error_reporting', E_ALL);
    require 'config/db.php';
    require 'config/otp.php';

    if(isset($_POST['submit'])){  
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
        $passwordAttempt = !empty($_POST['password']) ? trim($_POST['password']) : null;
        $sql = "SELECT * FROM `users` WHERE email = :email";
        // $sql = "SELECT * FROM `users` WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        //var_dump($user);
        if($user === false){
            echo '<script>alert("invalid email or password")</script>';
        } else{
            $validPassword = password_verify($passwordAttempt, $user['password']);
            if($validPassword){
                $_SESSION['email'] = $email;
                $_SESSION['userID'] = $user['userID'];
                $otp = rand(100000, 999999);
                otpGen($user['userID'],$otp);
                echo '<script type="text/javascript">alert("COPY: '.$otp.'");</script>';
                echo '<script>window.location.replace("verify.php");</script>';
                exit; 
            } else{
                echo '<script>alert("invalid username or password")</script>';
        }
    }
    }
    ?>
    
</body>
</html>