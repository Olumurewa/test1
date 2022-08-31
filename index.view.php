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
        <ul>
            <li><a href='login.php'>LOGIN</a></li>
            <li><a href='register.php'>REGISTER</a></li>

        </ul>

        <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
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