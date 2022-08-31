 <?php 
    session_start();
    define('BASEPATH', true);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require 'controller/dbFunctions.php';
    require 'index.view.php';

    echo "hello world";
    if(isset($_POST['submit'])){  
        $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
        $passwordAttempt = !empty($_POST['password']) ? trim($_POST['password']) : null;

        

        $func = new dbFunction();
        $func->Login($email, $passwordAttempt);
        // var_dump($func);   
    }
    // var_dump($func); 
    // var_dump($passwordAttempt);
    ?>
