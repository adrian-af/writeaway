<?php
session_start();
include "./dbfunctions.php";
//get the elements from the form
if(isset($_GET['title']))
{
    //store in variables
    $title = $_GET['title'];
    $genre = $_GET['genre'];
    $story = $_GET['story'];
    $public = $_GET['visibility'];
    
    //check that the text is not malware to break the database
    $title = mysql_real_escape_string($title);
    $story = mysql_real_escape_string($story);   
    $user = $_SESSION['userId'];
    //write it to the database
    $query = "INSERT INTO stories (userId, genreId, text, public) VALUES($user, $genre, $story, $public);";
    $result = connectionToDB($query);
    if($result)
    {
        echo "Story added!";
    }
    else
    {
        echo "Error";
    }
}