<?php
session_start();
include "./dbfunctions.php";
//store photo in var
if(isset($_POST['bio']))
{
    $bio = $_POST['bio'];
    $user = $_SESSION['userId'];

    //write it to the database
    $query = 'UPDATE users SET about = "' .$bio .'" WHERE ID LIKE ' .$user .';';
    
    $result = connectionToDB($query);
    if($result)
    {
        echo "bien";
    }
    else
    {
        echo "mal";
    }
    header("Location: profile.php");
}
else
{
    echo "error with the bio form";
}
//access database

//save photo in database