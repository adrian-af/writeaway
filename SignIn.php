
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignIn</title>
    
</head>
<body>
    <?php
        $text = "";
        $email = "";
        $username = "";
        if(isset($GET_['errorCode']))
        {
            $text = "Wrong!";
            $email = $GET_['email'];
            $username = $GET_['username'];

            if($GET_['errorEmail'])
            {
                $text .= " That email is already registered";
            }
            if($GET_['errorUsername'])
            {
                $text .= " That username is already in use";
            }
            if($GET_['errorPasswords'])
            {
                $text .= " The passwords do not match";
            }
            
        }
    ?>
    <h1>Sign In form</h1>
    <form action="./SignInCode.php" method="GET">
        <div style="color: red">
            <?php echo $text ?>
        </div>
        <label for="email">Email</for>
        <input type="email" id="email" name="email" value="<?php echo $email?>"></input><br>
        <label for="username">Choose a username</for>
        <input type="text" id="username" name="username" value="<?php echo $username?>"></input><br>
        <label for="pass">Password</for>
        <input type="password" id="pass" name="pass"></input><br>
        <label for="pass2">Repeat your password</for>
        <input type="password" id="pass2" name="pass2"></input>
        <br>
        <button>Sig In</button>

    </form>
    <!-- Send user name and password @ email -->
</body>
</html>