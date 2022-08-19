<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify</title>
</head>
<body>
    <form method="post" action="verify.php">
        <span><input type="text" name="token" placeholder="Enter Token" autocomplete="none"></span>
        <span><button name="submit" type="submit">Verify Token</button></span>
    </form>
    <?php
    session_start();
    define('BASEPATH', true);
    require 'config/db.php';
    $_SESSION['user'] =$id;
    function destroy($otp){
        require 'config/db.php';
        $sql = "DELETE FROM `otp` WHERE otp = :otp";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':otp', $otp);
 
        if ($stmt->execute()){
            echo '<script>alert("congratulations!")</script>';
        }
    }
    if(!isset($_SESSION['email'])){
        echo '<script>alert("Unauthenticated")</script>';
        echo '<script>window.location.replace("index.php");</script>';
    }
    if(isset($_POST['submit'])){  
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $otp = !empty($_POST['token']) ? trim($_POST['token']) : null;
        $sql = "SELECT * FROM `otp` WHERE otp = :otp";
        // $sql = "SELECT * FROM `users` WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':otp', $otp);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        //var_dump($user);
        
        echo $id;
        if (isset($id)){
            if($user['userID'] === $id){
                destroy($otp);  
            } else {
                session_destroy(); 
                echo '<script>alert("Error!!!")</script>';
                echo '<script>window.location.replace("index.php");</script>';
    
            }
        }
        }
        

    ?>
</body>
</html>


