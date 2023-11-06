<?php
include "./dbfunctions.php";
session_start();

if(isset($_GET['email']))
{
    $email = $_GET['email'];
    $username = $_GET['username'];
    $pass = $_GET['pass'];
    $pass2 = $_GET['pass2'];

    $errorEmail = 0;
    $errorUsername = 0;
    $errorPass = 0;
    $error = 0;

    //returns error if the passwords don't match
    if($pass != $pass2) 
    {
        $errorPass = 1;
    }

    //gets the database information into $res from the configuration xml file and checks it complies with the xsd schema
    $res = load_config(dirname(__FILE__)."/configuration.xml", dirname(__FILE__)."/configuration.xsd");
    $db = new PDO($res[0], $res[1], $res[2]); //connexion to DB
    $query = "SELECT * FROM users WHERE email = '$email'"; //checks if the email is registered
    $result = $db->query($query);
    if($result->rowCount() > 0) //if the query returns something, the email is registered
    {
        $errorEmail = 1;
    }
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = $db->query($query);
    if($result->rowCount() > 0) //if the query returns something, the username is registered
    {
        $errorUsername = 1;
    }
    
    echo $email;
    if($errorEmail === 1 || $errorPass === 1 || $errorUsername === 1)
    {
        $error = true;
        header("Location: SignIn.php?errorCode=$error&errorUsername=$errorUsername&errorPass=$errorPass&errorEmail=$errorEmail&email=$email&username=$username"); //returns to the signin page with true or false for the errors so it prints what was wrong
        return;
    }
    
    $hashedPass = password_hash($pass, PASSWORD_DEFAULT); //function to encrypt password
    $confirmationCode = rand(10, 10000000);
    $query = "INSERT INTO users(email, username, password, confirmationCode) VALUES('$email', '$username', '$hashedPass', '$confirmationCode');";
    $result = $db->query($query); //insert into database
    if(!$result)
    {
        echo "error al registrar usuario";
    }
    else
    {
        $_SESSION['email'] =  $email;
        $_SESSION['username'] = $username;
        $_SESSION['confirmationCode'] = $confirmationCode;
        $_SESSION['userId'] = $user['ID'];
        header("Location: verify.php"); //when it's registred, redirect to verify
    }
}
else
{
    echo "email is not set"; //should never get here
}
