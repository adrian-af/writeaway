<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WriteAway</title>
    <link href="header.css" rel="stylesheet">
</head>
<body>
    <header>
        <div id='headerleft'>
            <div id='logo'>
                <img class="logo" src="Imagenes/logotipo.png">
            </div>
            <div id='homepage'><a href="./Lobby.php">Home</a></div>
            <div class="dropdown">
                <div class="dropbtn">Genre</div>
                <div class="dropdown-content">
                    <?php
                        session_start();
                        include "./dbfunctions.php";
                        $query = "SELECT * FROM genres";
                        $result = connectionToDB($query);
                        if($result->rowCount() > 0)
                        {
                            foreach($result as $line) //takes each result of the query
                            {
                                $temp = ucfirst($line['name']); //capital first letter so it looks nicer
                                $tempNum = $line['ID']; //The id so it redirects to the specific genre page
                                echo "<a id='$tempNum' href='./genre.php?genre=$tempNum'>".$temp."</a>";
                            }
                        }
                    ?>
                </div>
            </div>
            <div id='search'>
                <form action="profilesearch.php" method="GET">
                    <input type="text" placeholder="Search users..." name="usersearched">
                    <button><img src="./Imagenes/search.png" alt="Search button" class="icon"></button>
                </form>
            </div>
        </div>    
        <div id='headerright'>
            <div  class='dropdown'>
                <img src="Imagenes/user.png" alt="User Picture" class="dropbtn" id="user">
                <div class="dropdown-content2">
                    <a href='./profile.php'>Profile</a>
                    <a href='./LogIn.php?logout=1' >Log out</a>
                </div>
            </div>
        </div>
        
    </header>
</body>
</html>