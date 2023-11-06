<?php
include "./dbfunctions.php";
session_start();
if(isset($_GET['email']))
{
    $email = $_GET['email'];
    $pass = $_GET['pass'];

    $errorEmail = 0;
    $errorPass = 0;
    $error = 0;

    
    $query = "SELECT * FROM users WHERE email = '$email'"; //checks if the email is registered
    $result = connectionToDB($query);
    if($result->rowCount() == 0) //if the query returns nothing, the email is not registered
    {
        $errorEmail = 1;
    }
    else
    {
        $user = $result->fetch();
        if (password_verify($pass, $user['password'])) //checks the original password against the one in the database (NOT hashed again)
        {
            $_SESSION['email'] =  $user['email'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['userId'] = $user['ID'];
            header("Location: lobby.php");
        }
        else
        {
            $errorPass = 1;
        }
    }
    
    if($errorEmail === 1 || $errorPass === 1)
    {
        $error = true;
        header("Location: LogIn.php?errorCode=$error&errorPass=$errorPass&errorEmail=$errorEmail&email=$email&incorrect=$hashedPass"); //returns to the signin page with true or false for the errors so it prints what was wrong
        return;
    }
}
else
{
    echo "email is not set"; //should never get here
}


