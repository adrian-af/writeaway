
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogIn</title>
</head>
<body>
<?php
        $text = "";
        $email = "";
        $username = "";
        if(isset($_GET['errorCode']))
        {
            $text = "Wrong!";
            $email = $_GET['email'];

            if($_GET['errorEmail'] == '1')
            {
                $text .= " That email is not registered.";
            }
            if($_GET['errorPass'] == '1')
            {
                $text .= " Incorrect password.";
            }
            
        }
    ?>
    <h1>Log In Form</h1>
    <div style="color: red" id="wrong"><?php echo $text;?></div>
    <form action="./LogInCode.php" method="GET">
        <label for="email">Email</for>
        <input type="email" id="email" name="email" value="<?php echo $email?>"></input><br>
        <label for="pass">Password</for>
        <input type="password" id="pass" name="pass"></input><br>
        <button>Log in</button>
    </form>
    <p>Not with us yet?</p><a href="SignIn.php">Sign in!!</a>
</body>
</html>