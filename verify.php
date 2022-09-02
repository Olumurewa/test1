<?php
    if(!isset($_SESSION['email'])){
        echo '<script>alert("Unauthenticated")</script>';
        echo '<script>window.location.replace("index.php");</script>';
    }
    require 'caller.php';
    echo "<form class='elevate' method='post' action='verify.php'><input type='text' name='token' placeholder='OTP'><br/><button name='submit' type='submit'>sign in</button> </form>";
    
    if(isset($_POST['submit'])){  
        $otp = !empty($_POST['token']) ? trim($_POST['token']) : null;

        $func = new dbFunction();
        $func->verify($otp);
    }
    
    
      

?>



