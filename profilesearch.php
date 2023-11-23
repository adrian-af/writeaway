<?php
include "./header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="ComonStyles.css" rel="stylesheet">
    <style>
        .primero{
            display: flex;
        }
        .userBox{
            float: left;
            width:min-content;
        }
        .about{
            white-space: pre-wrap;
            overflow: hidden;
        }
    </style>
</head>
<body>
    <div class="primero">
        <?php
        $term = $_GET['usersearched'];
            $query = "SELECT * FROM users WHERE username LIKE '%$term%'";
            $result = connectionToDB($query);
            if($result->rowCount() > 0) 
            {
                foreach($result as $line)
                {
                    $username = $line['username'];
                    $photo = $line['photo'];
                    $id = $line['ID'];
                    $about = $line['about'];

                    $ID = $line['ID'];

                    echo "<div id='$ID' class='userBox'>";
                    echo "<img src=";
                    
                    if($photo != NULL)
                    {
                        $userpfp = "data:image/jpg;charset=utf8;base64," . base64_encode($photo);
                    }
                    else
                    {
                        $userpfp = "./Imagenes/user.png";
                    }
                    
                    echo $userpfp;
                    echo " alt='user profile picture' style='width: 100px'>";
                    echo "<div>";
                        echo "<div class='username'><a href='otherProfile.php?id=$id'>$username</a></div>";
                        echo "<div class='about'>$about</div>";
                    echo "</div>";
                    echo "</div>";
                }
            }
            else
            {
                echo "No users match your search.";
            }
        ?>
    </div>
</body>
</html>