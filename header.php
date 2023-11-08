<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WriteAway</title>
    <style>
        body
        {
            margin: 0;
        }
        header
        {
            display: flex;
            background-color: azure;
            height: 50px;
            margin: 0;
            justify-content: space-between;
        }
        #headerleft
        {
            display: flex;
        }
        #headerleft > *
        {
            margin: 10px;
            padding: 10px;
            text-align: center;
        }
        #headerleft > *
        {
            cursor: pointer;
        }
        .show
        {
            visibility: visible;
        }
        .hide
        {
            visibility: hidden;
        }
        
    </style>
</head>
<body>
    <script>
        function toggleGenres() 
        {
            var genres = document.getElementsByClassName('genresd');
            for(var i=0; i<genres.length; i++)
            {
                if (genres[i].classList.contains("show"))
                {
                    genres[i].classList.remove("show");
                    genres[i].classList.add("hide");
                }
                else
                {
                    genres[i].classList.remove("hide");
                    genres[i].classList.add("show");
                }
            }
        } 
    </script>
    <header>
        <div id='headerleft'>
            <div id='logo'></div>
            <div id='homepage'><a href="./Lobby.php">Home</a></div>
            <div id='genre' onclick='toggleGenres()'>
                Genre
                <?php
                    session_start();
                    include "./dbfunctions.php";
                    echo "<div id='genres'>";
                    $query = "SELECT * FROM genres";
                    $result = connectionToDB($query);
                    if($result->rowCount() > 0)
                    {
                        foreach($result as $line) //takes each result of the query
                        {
                            $temp = ucfirst($line['name']); //capital first letter so it looks nicer
                            $tempNum = $line['ID'];
                            echo "<div id='$tempNum' class='genresd hide'><a href='./genre.php?genre=$tempNum'>$temp</a></div>";
                        }
                    }
                    echo "</div>";
                ?>
            </div>
            <div id='search'></div>
        </div>    
        <div id='headerright'>
            <div id='profile'>
                <img src="Imagenes/user.png" alt="User Picture">
            </div>
        </div>
        
    </header>
</body>
</html>