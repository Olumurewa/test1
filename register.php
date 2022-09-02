<?php 
    require 'caller.php';

    echo "<form class='elevate' action='register.php' method='post'><h1>REGISTER</h1><input required='required' type='email' name='email' placeholder='Email'><br/><input required='required' type='password' name='password' placeholder='Password'><button name='submit' type='submit'>register</button></form>";
    
    if(isset($_POST['submit'])){  
            try 
            {
                $email = $_POST['email'];
                $pass = $_POST['password'];
                $isVerified = 0;
        
                $pass = password_hash($pass, PASSWORD_BCRYPT);
                $instance = new dbFunction();
                $instance->Register($email, $pass, $isVerified);
                
            }
            catch(PDOException $e)
            {
                $error = "Error: " . $e->getMessage();
                echo '<script type="text/javascript">alert("'.$error.'");</script>';
            }
    }
?>
