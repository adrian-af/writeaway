<?php
include "./dbfunctions.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Write a story</title>
</head>
<body>
    <h1>Write your story</h1>
    <form action="writeDB.php">
        <label for="title">Title: </label>
        <input type="text" id="title" name="title"></input><br>
        <label for="genre">Genre: </label>
        <select id="genre" name="genre">
            <?php
                $query = "SELECT * FROM genres";
                $result = connectionToDB($query);
                if($result->rowCount() > 0) //if the query returns nothing, the email is not registered
                {
                    foreach($result as $line) //takes each result of the query
                    {
                        $temp = ucfirst($line['name']); //capital first letter so it looks nicer
                        $tempNum = $line['ID'];
                        echo "<option value='$tempNum'>$temp</option>"; //this adds an option for each genre with the value of its name
                    }
                }
                else
                {
                    echo "can't find genres";
                }
            ?>
        </select><br>
        <label for="story">Story: </label>
        <textarea id="story" name="story"></textarea><br>
        <input type="radio" id="private" name="public" value="0">
        <label for="private">Private<br>
        <input type="radio" id="public" name="public" value="1">
        <label for="private">Public<br>
        <button>Submit</button>
    </form>
</body>
</html>