<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        session_start();
        if(isset($_GET['verificationCode']))
        {
            $code = $_GET['verificationCode'];
            $codeUser = $_SESSION['verificationCode'];
            $email = $_SESSION['email'];
            $username = $_SESSION['username'];
            if($code == $codeUser)
            {
                header("Location: Lobby.php");
            }
            else
            {
                header("Location: SignIn.php?errorCode=1&errorPass=0&errorEmail=0&email=0&incorrect=0&errorVerify=1&errorUsername=0&email=$email&username=$username");
            }
        }
    ?>
</body>
</html>