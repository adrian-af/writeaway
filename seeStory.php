<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    include "./header.php";
    if(isset($_GET['id']))
    {
        $storyId = $_GET['id'];
        $query = "SELECT * FROM stories WHERE ID LIKE $storyId";
        $result = connectionToDB($query);
        $story = $result->fetch();

        $storyTitle = $story['title'];
        $storyText = $story['text'];

        $mysqlDatetime = $story['datetime'];
        $datetime = new DateTime($mysqlDatetime);
        $storyDatetime = $datetime->format('Y-m-d H:i:s');
        echo "<div>";
        echo "<h2>$storyTitle</h2>";
        echo "<div>$storyDatetime</div>";
        echo "<p><pre>$storyText</pre></p>";
    }
    ?>
</body>
</html>