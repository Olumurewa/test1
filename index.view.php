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
        <nav>
            <ul>
                <li><a href='login.php'>LOGIN</a></li>

                <li class='list-item'><a href='register.php'>REGISTER</a></li>

            </ul>
        </nav>

    </div>
    <style>
        nav{
            display: flex;
            flex-direction: row;
            text-decoration: none;
            background-color: pink;
            justify-content: space-evenly;
        }
        li{
            display: inline;
            list-style: none;
            text-decoration: none;
            color: white;
        }
        .list-item{
            padding-left: 3rem;
        }
        a{
            color:black;
            text-decoration: none !important; 
        }
        a:hover{
            color: aliceblue;
            text-decoration: wavy;
        }
        .elevate {
            background: #ffffff;
            box-shadow: 0px 0px 20px -3px rgba(0, 0, 0, 0.12);
            padding: 7%;
        }


    </style>
</body>

</html>