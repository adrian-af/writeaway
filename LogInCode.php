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

    //gets the database information into $res from the configuration xml file and checks it complies with the xsd schema
    $res = load_config(dirname(__FILE__)."/configuration.xml", dirname(__FILE__)."/configuration.xsd");
    $db = new PDO($res[0], $res[1], $res[2]); //connexion to DB
    $query = "SELECT * FROM users WHERE email = '$email'"; //checks if the email is registered
    $result = $db->query($query);
    if($result->rowCount() == 0) //if the query returns nothing, the email is not registered
    {
        $errorEmail = 1;
    }
    else
    {
        $hashedPass = password_hash($pass, PASSWORD_DEFAULT);
        $query = "SELECT * FROM users WHERE email = '$email' AND password = '$hashedPass'";
        $result = $db->query($query);
        if($result->rowCount() > 0) //if the query returns something, the login info is correct
        {
            $user = $result->fetch();
            $_SESSION['email'] =  $user['email'];
            $_SESSION['username'] = $user['username'];
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
        header("Location: LogIn.php?errorCode=$error&errorPass=$errorPass&errorEmail=$errorEmail&email=$email"); //returns to the signin page with true or false for the errors so it prints what was wrong
        return;
    }
}
else
{
    echo "email is not set"; //should never get here
}
