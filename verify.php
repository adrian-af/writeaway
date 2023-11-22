<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify</title>
</head>
<body>
    <p>
        <?php
            session_start();
            include "./dbfunctions.php";
            use PHPMailer\PHPMailer\PHPMailer;
            //coger el confirmationCode y el email
            $code = $_SESSION['confirmationCode'];
            $email = $_SESSION['email'];
            //mandarlo por email
            $sent = send_mail($email, $code);
            //si todo bien, mostrar "mira tu email"
            if($sent)
            {
                echo 'Check your mail to activate your account!';
            }
            //si no, mostrar error
            else
            {
                echo 'Error sending verification email.';
            }
        ?>
    </p>
    <script>
        function goback()
        {
            setTimeout(() => {
                window.location.href = "./Login.php";
            }, 5000);
        }
        window.onload = goback;
    </script>
</body>
</html>