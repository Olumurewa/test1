<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <form action="register.php" method="post">
        <input required="required" type="email" name="email" placeholder="Email">
        <input required="required" type="password" name="password" placeholder="Password">                  
        <button name="submit" type="submit">register</button>
    </form>
    <?php 
    define('BASEPATH', true); 
    require 'config/db.php'; //require connection script
    
     if(isset($_POST['submit'])){  
            try {
                //$dsn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $email = $_POST['email'];
                $pass = $_POST['password'];
                $isVerified = 0;
        
                $pass = password_hash($pass, PASSWORD_BCRYPT);
                //Check if email exists
                // $sql = "SELECT COUNT(email) AS num FROM `users` WHERE email =:email";
                // $stmt = $pdo->prepare($sql);
                // $stmt->bindValue(':email', $user);
                // $stmt->execute();
                // $row = $stmt->fetch(PDO::FETCH_ASSOC);
                // if($row['num'] > 0){
                //     echo '<script>alert("User already exists")</script>';
                // }else{
                    $stmt = $conn->prepare("INSERT INTO `users` (email, password, isVerified) 
                    VALUES (:email, :password,:isVerified)");
                    $stmt->bindParam(':email', $email);
                    $stmt->bindParam(':password', $pass);
                    $stmt->bindParam(':isVerified', $isVerified);
                    if($stmt->execute()){
                        // $otpstore = $conn->prepare("INSERT INTO `` (otp, isExpired, email) 
                        // VALUES (:otp, :isExpired, :email)");
                        // $otpstore->bindparam(':otp', $otp);
                        // $otpstore->bindparam(':isExpiired', $isExpired);
                        // $otpstore->bindparam(':email', $email);
                        echo '<script>alert("New account created: ")</script>';
                        echo '<script>window.location.replace("index.php")</script>';
                        //redirecting with JS because header doesn't allow for user input first
                        
                    }else{
                        echo '<script>alert("An error occurred")</script>';
                    }
                    //}
            }catch(PDOException $e){
                $error = "Error: " . $e->getMessage();
                echo '<script type="text/javascript">alert("'.$error.'");</script>';
            }
    }
    
    ?>
</body>
</html>