<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
        <div>
            <div id='pfp'>
                <img src="" alt="">
                <img src="" alt="">
            </div>
        </div>
        <div>
            <?php
                session_start();
                include "./dbfunctions.php";
                $user = $_SESSION['username'];
                $userId = $_SESSION['userId'];
                echo $user;
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
            $content = substr($line['text'], 0, 50);
            $datetime = $line['datetime'];
            $ID = $line['ID'];

            echo "<div id='$ID'>";
                echo "<div class='title'>$title</div>";
                echo "<div class='content>$content</div>'";
                echo "<div class='dateTime'>$datetime</div>";
            echo "</div>";
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