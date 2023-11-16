<?php
include "./header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit a story</title>
</head>
<body>
    <h1>Edit your story</h1>
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
        $id = $_POST['id'];
        //write it to the database
        $query = "UPDATE stories SET title = '$title', genreId = $genre, text = '$safeStory' WHERE ID = $id;";

        $result = connectionToDB($query);
        if($result)
        {
            echo "<span id='added' style='color: green'>Story modified!</span>";
        }
        else
        {
            echo "<span id='added'>Error</span>";
        }

    }
    ?>
    <form action="editStory.php?id=<?php echo $_GET['id']; ?>" method='POST'>
        <input name="id" value='<?php echo $_GET['id'] ?>' type="hidden">
        <label for="title">Title: </label>
        <input type="text" id="title" name="title" value="<?php
            $id = $_GET['id'];
            $query = "SELECT * FROM stories WHERE ID = $id";
            $resultStory = connectionToDB($query);
            $story = $resultStory->fetch();
            $title = $story['title'];
            $genre = $story['genreId'];
            $text = $story['text'];
            $public = $story['public'];
            echo ltrim($title);
        ?>"></input><br>
        <label for="genre">Genre: </label>
        <select id="genre" name="genre">
        <?php
            $privateImput = "";
            $publicImput = "";
            if($public == "0")
            {
                $privateImput = "checked";
            }
            else
            {
                $publicImput = "checked";
            }

            $queryGenre = "SELECT * FROM genres";
            $resultGenre = connectionToDB($queryGenre);
        
            if($resultGenre->rowCount() > 0)
            {
                foreach($resultGenre as $line) //takes each result of the query
                {
                    $temp = ucfirst($line['name']); //capital first letter so it looks nicer
                    $tempNum = $line['ID']; 
                    if($story['genreId'] == $tempNum) //if the current genre matches, it's preselected
                    {
                        echo "<option value='$tempNum' selected='selected'>$temp</option>";
                    }
                    else
                    {
                        echo "<option value='$tempNum'>$temp</option>"; //this adds an option for each genre with the value of its name
                    }
                }
            }
            else
            {
                echo "can't find genres";
            }
        ?>
        </select><br>
        <label for="story">Story: </label>
        <textarea id="story" name="story"><?php echo $text; ?></textarea><br>
        <label for="private">Private<br>
        <input type="radio" id="private" name="public" value="0" <?php echo $privateImput; ?>>
        <input type="radio" id="public" name="public" value="1" <?php echo $publicImput; ?>>
        <label for="private">Public<br>
        <button>Submit</button>
    </form>
</body>
</html>