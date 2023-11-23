<?php
include "./header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="ComonStyles.css" rel="stylesheet">
    <?php
        if(!isset($_SESSION['userId']))
        {
            header("Location: logIn.php");
        }
        $user = $_SESSION['username'];
        $userId = $_SESSION['userId'];
        $query = "SELECT * FROM users WHERE ID LIKE $userId";
        $result = connectionToDB($query);
    ?>
    <script>
        function confirmDelete(id)
        {
            let confirmation = "Are you sure you want to delete the story?";
            if(confirm(confirmation) == true)
            {
                var url = "deleteStory.php?id=" + id;
                window.location.replace(url);
            }
        }
    </script>
    <style>
        #pfp, #about{
            width:max-content;
        }
        #pfp{
            float: right;
        }
        #about{
            width: 75%;
        }
        #buser{
            text-align: left;
        }
        #usersite{
            padding: 10px;
            border: 10px outset #ede4bd;
        }
        pre{
            white-space: pre-line;
            text-align: justify;
        }
    </style>
</head>
<body>
    <div class="primero">
        <div id='usersite'>
            <div id='pfp'>
                <img src="<?php
                    if($result)
                    {
                        $user = $result->fetch();
                        if($user['photo'] != NULL)
                        {
                            $userpfp = "data:image/jpg;charset=utf8;base64," . base64_encode($user['photo']);
                        }
                        else
                        {
                            $userpfp = "./Imagenes/user.png";
                        }
                    }
                    echo $userpfp;
                ?>" alt="user profile picture" style='width: 100px'>
                <img src="./Imagenes/edit.png" alt="edit button" style="width: 20px" onclick="window.location='./changeImg.html'">
            </div>
            <div id='about'>
                <p id='buser'>About <?php echo $user['username']; ?>:
                <img src="./Imagenes/edit.png" alt="edit button" style="width: 20px" onclick="window.location='./changeBio.html'"></p>
                <p class='text'><pre><?php echo $user['about'];?></pre></p>
                
            </div>
        </div>
        <div>
            <h2><?php
                    
                    echo $user['username'];
                ?>'s stories:</h2>
            <?php
                $query = "SELECT * FROM stories WHERE userId LIKE $userId";
                $result = connectionToDB($query);
                if($result->rowCount() > 0) //if the query returns nothing, the email is not registered
                {
                    foreach($result as $line) //takes each result of the query
                    {
                        $title = $line['title'];
                        $content = substr($line['text'], 0, 50);
                        $mysqlDatetime = $line['datetime'];
                        $datetime = new DateTime($mysqlDatetime);
                        $formattedDatetime = $datetime->format('Y-m-d H:i:s');

                        $ID = $line['ID'];

                        echo "<div id='$ID' class='container'>";
                            echo "<div class='title'><a href='./seeStory.php?id=$ID'>$title</a> - <a href='./editStory.php?id=$ID'>Edit</a>
                            <a class='delete' onclick='confirmDelete(this.id)' id='$ID'>Delete</a></div>";
                            echo "<div class='content'>$content...</div>";
                            echo "<div class='dateTime'>";
                            echo $formattedDatetime; 
                            echo "</div>";
                        echo "</div>";
                    }
                }
                else
                {
                    echo "You haven't writen stories yet.";
                }
            ?>
        </div>
        <div id="alert"></div>
    </div>
</body>
</html>