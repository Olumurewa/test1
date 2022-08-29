<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App</title>
</head>
<body>
    <div>
        
        <h1>LOGIN</h1><br/>
        <form action='index.php' method='post'>
            <input type='email' name='email' placeholder='E Mail'><br/>
            <input type='password' name='password' placeholder='Password'><br/>
            <button name='submit' type='submit'>sign in</button> 
        </form>

        <?php
         if(isset($_POST['submit'])){  
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
            $passwordAttempt = !empty($_POST['password']) ? trim($_POST['password']) : null;
    
            
    
            $func = new dbFunction();
            $func->Login($email, $passwordAttempt);
            // var_dump($func);   
        }
        ?>
    
    </div>
    <style>
        body{
            padding: 0.5rem;
            background-color: skyblue;
            justify-content: center;

        }
    </style>
</body>

</html>