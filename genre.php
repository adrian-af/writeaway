<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include "./header22.php";
    ?>
    <?php
    include "./dbfunctions.php";
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

            $ID = $line['ID'];

            echo "<div id='$ID'>";
                echo "<div class='title'><a href='./read.php?id=$ID'>$title</a></div>";
                echo "<div class='content'>$content...</div>";
                echo "<div class='dateTime'>";
                echo $formattedDatetime; 
                echo "</div>";
            echo "</div>";
        }
    }
    ?>
</body>
</html>