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
                echo $_SESSION['username'];
            ?>'s stories<br>
        </div>
    </header>
</body>
</html>