
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WriteAway</title>
    <link href="ComonStyles.css" rel="stylesheet">
</head>
<?php
        include "./header.php";
    ?>
<body>
   
    <div class="primero">
        <h1 align='center'>This is the lobby!!</h1>
        <h2>Last updates</h2>
        <?php
        $query = "SELECT * FROM stories ORDER BY datetime DESC LIMIT 10";
        
        $result = connectionToDB($query);

        if($result->rowCount() > 0) //if the query returns nothing, the email is not registered
        {
            foreach($result as $line) //takes each result of the query
            {
                $title = $line['title'];
                $content = substr($line['text'], 0, 50);
                $mysqlDatetime = $line['datetime'];
                $datetime = new DateTime($mysqlDatetime);
                $formattedDatetime = $datetime->format('d-m-Y H:i:s');

                $ID = $line['ID'];
                $userId = $line['userId'];
                $subquery = "SELECT * FROM users WHERE ID LIKE $userId";
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
        }
        ?>
    </div>
</body>
</html>