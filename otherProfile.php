<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
        session_start();
        include "./dbfunctions.php";
        if(isset($_GET['id']))
        {
            $userId = $_GET['id'];
        }
        $query = "SELECT * FROM users WHERE ID LIKE $userId";
        $result = connectionToDB($query);
    ?>
</head>
<body>
    <header>
        <div>
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
                
            </div>
        </div>
        <div>
            <div id='about'>
                <p>About <?php echo $user['username']; ?>:</p>
                <p><?php echo $user['about'];?></p>
            </div>
            <?php
                
                echo $user['username'];
            ?>'s stories<br>
        </div>
    </header>
    <div>
        <?php
            $query = "SELECT * FROM stories WHERE userId LIKE $userId";
            $result = connectionToDB($query);
            if($result->rowCount() > 0) //if the query returns nothing, the email is not registered
            {
                foreach($result as $line) //takes each result of the query
                {
                    $title = $line['title'];
                    $public = $line['public'];
                    if($public == 1)
                    {

                        $content = substr($line['text'], 0, 50);
                        $mysqlDatetime = $line['datetime'];
                        $datetime = new DateTime($mysqlDatetime);
                        $formattedDatetime = $datetime->format('Y-m-d H:i:s');
                        
                        $ID = $line['ID'];
                        
                        echo "<div id='$ID'>";
                        echo "<div class='title'><a href='./seeStory.php?id=$ID'>$title</a>";
                        echo "<div class='content'>$content...</div>";
                        echo "<div class='dateTime'>";
                        echo $formattedDatetime; 
                        echo "</div>";
                        echo "</div>";
                    }
                }
            }
            else
            {
                echo "You haven't writen stories yet.";
            }
        ?>
    </div>
</body>
</html>