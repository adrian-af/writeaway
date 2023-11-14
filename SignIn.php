
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignIn</title>
    <link href="FormStyles.css" rel="stylesheet">
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
        <div><h1>Sign Up</h1></div>
        <form action="./SignInCode.php" method="GET">
            <table>
                <tr>
                    <td colspan="2">
                    <div style="color: red">
                        <?php echo $text; ?>
                    </div>
                    </td>
                </tr>
                <tr>
                    <td><label class="label" for="email">Email</label></td>
                    <td><input class="text-input" type="email" id="email" name="email" value="<?php echo $email?>" required ></input></td>
                </tr>
                <tr>
                    <td><label class="label"  for="username">Choose a username</label></td>
                    <td><input class="text-input" type="text" id="username" name="username" value="<?php echo $username?>" required></input></td>
                </tr>
                <tr>
                    <td><label class="label"  for="pass">Password</label></td>
                    <td><input class="text-input" type="password" id="pass" name="pass" required></input></td>
                </tr>
                <tr>
                    <td><label class="label"  for="pass2">Repeat your password</label></td>
                    <td><input class="text-input" type="password" id="pass2" name="pass2" required></input></td>
                </tr>
                <tr>
                    <td class="notes" colspan="2"><input type="checkbox" required> Confirm we are the best</td>
                </tr>
                <tr>
                    <td class="notes" colspan="2"><button class="button">Sign Up</button></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>