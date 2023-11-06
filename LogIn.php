
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogIn</title>
    <link href="LogInEstilo.css" rel="stylesheet">
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
    <div class="rectangle-1">
        <div><h2>Log In Form</h2></div>
        <div style="color: red" id="wrong"><?php echo $text;?></div>
        <div>
            <form action="./LogInCode.php" method="GET">
                <table>
                    <tr>
                        <td><label for="email">Email</label></td>
                        <td><input class="text-input" type="email" id="email" name="email" value="<?php echo $email?>"></input></td>
                    </tr>
                    <tr>
                        <td><label for="pass">Password</label></td>
                        <td><input class="text-input" type="password" id="pass" name="pass"></input></td>
                    </tr>
                    <tr>
                        <td colspan="2"><button>Log in</button></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <div class="rectangle-2">
    <div class="not-with-us-yet-">Not with us yet?</div><div> <button class="button-2 ">Sign IN!!</button></div> 
    </div>
</body>
</html>