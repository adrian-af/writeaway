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
    $queryGenre = "SELECT * FROM genres WHERE ID LIKE $genre";
    $resultGenre = connectionToDB($queryGenre);
    $genreLine = $resultGenre->fetch();
    $genreName = ucfirst($genreLine['name']);
    echo "<h1>$genreName</h1>";
    $query = "SELECT * FROM stories WHERE genreId LIKE $genre ORDER BY datetime DESC";
    $result = connectionToDB($query);

    if($result->rowCount() > 0)
    {
        foreach($result as $line)
        {
            $title = $line['title'];
            $content = substr($line['text'], 0, 50);
            $mysqlDatetime = $line['datetime'];
            $datetime = new DateTime($mysqlDatetime);
            $formattedDatetime = $datetime->format('d-m-Y H:i:s');
            $ID = $line['ID'];
            $userId = $line['userId'];

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