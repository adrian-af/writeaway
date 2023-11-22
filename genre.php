<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="ComonStyles.css" rel="stylesheet">
</head>
<body>
    <?php
        include "./header.php";
    ?>
    <div class="primero">
    <?php
    $genre = $_GET['genre'];
    $query = "SELECT * FROM stories WHERE genreId LIKE $genre";
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
            $ID = $line['userId'];

            $subquery = "SELECT * FROM users WHERE ID = $userId";
            $subresult = connectionToDB($subquery);
            $subline = $subresult->fetch();
            $username = $subline['username'];

            echo "<div id='$ID' class='container'>";
                echo "<div class='title'><a href='./seeStory.php?id=$ID'>$title</a> by <a href='./otherProfile.php?id=$userId'>$username</a></div>";
                echo "<div class='content'>$content...</div>";
                echo "<div class='dateTime'>";
                echo $formattedDatetime; 
                echo "</div>";
            echo "</div>";
        }
    }else{
        echo "<h1>There's no stories for this genre!</h1>";
        echo '<a href="./write.php"><button class="button">Start writing!</button></a>';
    }
    ?>
    </div>
</body>
</html>