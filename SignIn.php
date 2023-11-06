
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignIn</title>
    <style>
        body{
            display: flex;
            justify-content: center; /* Center horizontally */
            align-items: center;
        }
        .rectangle-1 {
            width: 448px;
            height: 554px;
            padding: 8px 8px 8px 8px;
            background: #CBE8BA;
            border-color: #000000;
            border-width: 1px;
            border-style: solid;
        }
        .sign-in- {
            width: 131px;
            height: 57px;
            color: #000000;
            font-family: "Helvetica";
            font-weight: 400;
            font-size: 36px;
            text-align: left;
        }
        .email- {
            width: 83px;
            height: 32px;
            color: #232323;
            font-family: "Helvetica";
            font-weight: 400;
            font-size: 18px;
            text-align: left;
        }
        .text-input-4 {
            width: 145px;
            height: 27px;
            padding: 4px 8px 4px 8px;
            background: #FFFFFF;
            color: #C0C0C0;
            border-color: #232323;
            border-width: 1px;
            border-style: solid;
            border-radius: 3px 3px 3px 3px;
            font-family: "Helvetica";
            font-weight: 400;
            font-size: 14px;
            text-align: left;
        }
        .checkbox-1 {
            width: 266px;
            height: 18px;
            background: #FFFFFF;
            color: #232323;
            border-color: #232323;
            border-width: 1.5px;
            border-style: solid;
            font-family: "Helvetica";
            font-weight: 400;
            font-size: 14px;
            text-align: left;
        }
        .button-1 {
            width: 97px;
            height: 27px;
            padding: 0px 10px 0px 10px;
            background: #EBEBEB;
            color: #232323;
            border-color: #232323;
            border-width: 1px;
            border-style: solid;
            border-radius: 3px 3px 3px 3px;
            font-family: "Helvetica";
            font-weight: 400;
            font-size: 14px;
            text-align: center;
        }
    </style>
    
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
            $username = $_GET['username'];

            if($_GET['errorEmail'] == '1')
            {
                $text .= " That email is already registered.";
            }
            if($_GET['errorUsername'] == '1')
            {
                $text .= " That username is already in use.";
            }
            if($_GET['errorPass'] == '1')
            {
                $text .= " The passwords do not match.";
            }
            if($_GET['errorVerify'] == '1')
            {
                $text .= " There was an error verifying your email. Please try again.";
            }
        }
    ?>
    <div class="rectangle-1">
        <h1>Sign In form</h1>
        <form action="./SignInCode.php" method="GET">
            <div style="color: red">
                <?php echo $text; ?>
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
        <p>Already with us?</p><a href="LogIn.php">Log in!!</a>
    </div>
    <!-- Send user name and password @ email -->
</body>
</html>