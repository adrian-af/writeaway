<?php
include "./header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Write a story</title>
    <link rel="stylesheet" href="ComonStyles.css">
    <style>
        .primero > * > *{
            border:1px solid black;
        }
        .primero > * > *>*{
            border:1px solid black;
        }
        p{
            width: max-content;
            text-align: left;
            margin: 0px;
        }
        .content{
            display: grid;
            padding: none;
            margin: 10px;
        }
        #story{
            height: 500px;
            resize:vertical;
        }
        .private, .public {
            width: max-content;
        }
    </style>
</head>
<body>
    <div class="primero">
    <h1>Write your story</h1>
    <?php
    //get the elements from the form
    if(!isset($_SESSION['userId']))
    {
        header("Location: logIn.php");
    }
    if(isset($_POST['title']))
    {
        //store in variables
        $title = $_POST['title'];
        $genre = $_POST['genre'];
        $story = $_POST['story'];
        $public = $_POST['public'];
        $safeStory = str_replace("\"", "&ldquo;", $story);
        $safeStory = str_replace(chr(39), "&#39;", $safeStory);

        $user = $_SESSION['userId'];
        //write it to the database
        $query = 'INSERT INTO stories (userId, genreId, title, text, public) VALUES(' .$user .', ' .$genre .', "' .$title .'", "' .$safeStory . '", ' .$public .');';

        $result = connectionToDB($query);
        if($result)
        {
            echo "<span id='added' style='color: green'>Story added!</span>";
        }
        else
        {
            echo "<span id='added'>Error</span>";
        }
    }
    ?>
    <form action="write.php" method='POST' class="writeStory">
        <div class="content">
            <p><label for="title">Title: </label></p>
            <input type="text" id="title" name="title" class="input"></input>
        </div>
        <div class="content">
            <p><label for="genre">Genre: </label></p>
            <select id="genre" name="genre">
            <?php
                    
                $query = "SELECT * FROM genres";
                $result = connectionToDB($query);
                if($result->rowCount() > 0)
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
            </select>
        </div>
        <div class="content">  
            <p><label for="story">Story:</label></p>
            <textarea id="story" name="story"></textarea>
        </div>
        <div>
            <div class="private">
                <label for="private">Private</label>
                <input type="radio" id="private" name="public" value="0" checked>
            </div>
            <div class="public">
                <input type="radio" id="public" name="public" value="1">
                <label for="private">Public</label>
            </div>
        </div>
        <button class="button">Submit</button>
    </form>
    </div>
</body>
</html>