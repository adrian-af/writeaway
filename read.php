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
    <div>
    <?php
        session_start();
        include "./dbfunctions.php";
        $query = "SELECT * FROM users WHERE ID LIKE $userId";
        $result = connectionToDB($query);
    ?>
    </div>
</body>
</html>