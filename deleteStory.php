<?php
 include "./dbfunctions.php";

//program

    $ID = $_GET['id'];
    $query = "DELETE FROM stories WHERE ID = $ID";
    $result = connectionToDB($query);
    if(!$result) 
    {
        echo "there was an error deleting the story";
    }
header("Location: profile.php");

?>