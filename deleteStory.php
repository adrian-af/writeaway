<?php
 include "./dbfunctions.php";
function prompt($prompt_msg)
{
    echo("<script type='text/javascript'> var answer = prompt('".$prompt_msg."'); </script>");

    $answer = "<script type='text/javascript'> document.write(answer); </script>";
    return($answer);
}

//program
$sure = NULL;
$prompt_msg = "Are you sure you want to delete this story forever?";
$sure = prompt($prompt_msg);

if($sure != null)
{
    $ID = $_GET['id'];
    $query = "DELETE FROM stories WHERE ID = $ID";
    $result = connectionToDB($query);
    if(!$result) 
    {
        echo "<script>console.log('there was an error deleting the story')</script>";
    }
}
header("Location: profile.php");

?>