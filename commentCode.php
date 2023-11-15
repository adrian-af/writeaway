<?php
session_start();
include "./dbfunctions.php";
if(!isset($_SESSION['userId']))
{
    header("Location: logIn.php");
}
if(isset($_GET['storyId']))
{
    //store in variables
    $userId = $_SESSION['userId'];
    $storyId = $_GET['storyId'];
    $content = $_GET['text'];
    $safeContent = str_replace("\"", "&ldquo;", $content);
    $safeContent = str_replace(chr(39), "&#39;", $safeContent);
    

    //write it to the database
    $query = "INSERT INTO comments (userId, storyId, content) VALUES($userId, $storyId, '$safeContent');";

    echo $query;
    $result = connectionToDB($query);
    if($result)
    {
        echo "<span id='added' style='color: green'>Comment added!</span>";
    }
    else
    {
        echo "<span id='added'>Error</span>";
    }
    header("Location: seeStory.php?id=$storyId");
}
else
{
    echo "id is not set";
}