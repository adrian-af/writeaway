<?php
include "./header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit a story</title>
    <link rel="stylesheet" href="ComonStyles.css">
    <style>
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
        .public{
            float: right;
        }
        .private{
            float: left;
        }
        input:nth-child(3),select{
            background: linear-gradient(to bottom, #d5ca98, #b3c262);
        }
    </style>
</head>
<body>
    <div class="primero">
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
            <div class="content">
                <input name="id" value='<?php echo $_GET['id'] ?>' type="hidden">
                <p><label for="title">Title:</label></p>
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
                ?>"></input>
            </div>
            <div class="content">
                <p><label for="genre">Genre: </label></p>
                <select id="genre" name="genre">
                <?php
                    

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
                </select>
            </div>
            <div class="content">
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
                ?>
                <div class="private">
                    <input type="radio" id="private" name="public" value="0" <?php echo $privateImput; ?>>
                    <label for="private">Private</label>
                </div>
                <div class="public">
                    <input type="radio" id="public" name="public" value="1" <?php echo $publicImput; ?>>
                    <label for="private">Public</label>
                </div>
            </div>
            <div class="content">
                <label for="story">Story: </label>
                <textarea id="story" name="story"><?php echo $text; ?></textarea>
            </div>
            <button class="button">Submit</button>
        </form>
    </div>
</body>
</html>