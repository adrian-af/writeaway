<?php
include "./dbfunctions.php";
//get the elements from the form
if(isset($_GET['title']))
{
    $title = $_GET['title'];
    $genre = $_GET['genre'];
    $story = $_GET['story'];
    //check that the text is not malware to break the database
    $title = mysql_real_escape_string($title);
    $genre = mysql_real_escape_string($genre);
    $story = mysql_real_escape_string($story);   
    //write it to the database
    //$query = "INSERT INTO stories (userId, genreId, text) VALUES($_SESSION['userId'], $genre, $story)";
    $query = "SELECT * FROM users WHERE email = '$email'"; //checks if the email is registered
    $result = connectionToDB($query);
    if($result->rowCount() == 0) //if the query returns nothing, the email is not registered
    {
        $errorEmail = 1;
    }
}