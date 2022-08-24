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
    <form action='register.php' method='post'>
        <h1>REGISTER</h1>
        <input required='required' type='email' name='email' placeholder='Email'>
        <br/>
        <input required='required' type='password' name='password' placeholder='Password'>
        <button name='submit' type='submit'>register</button>
    </form>
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