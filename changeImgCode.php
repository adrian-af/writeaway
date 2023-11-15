<?php
session_start();
include "./dbfunctions.php";
//store photo in var
if(isset($_FILES['photo']))
{
    //echo $_POST['photo'];
    $file =addslashes(file_get_contents($_FILES['photo']['tmp_name']));

    $user = $_SESSION['userId'];
    //write it to the database
    $query = 'UPDATE users SET photo = "' .$file .'" WHERE ID LIKE ' .$user .';';
    //echo $query;
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
    echo "error with the photo form";
}
//access database

//save photo in database