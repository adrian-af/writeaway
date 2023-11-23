<?php
     include "./header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="ComonStyles.css" >
    <style>
        p{
            overflow-wrap: break-word;
        }
        p pre{
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        pre{
            padding: 5%;
            text-align: justify;
            white-space: pre-line;
            background: lightgray;
            border:1px solid black;
        }
        /*Coments*/
        .commentsWall{
            background: #a39b74;
            border: 10px inset #ede4bd;
            padding: 2%;
        }
        #commentForm{
            margin: 10px 0 10px 0;
        }
        .comment{
            border-bottom: 3px dashed #66424c;
            padding-top: 2%;
            margin-bottom: 5px;
        }
        .comment > * > pre{
            background: none;
            border:none;
        }
        .commentInfo{
            text-align: left;
            padding-left: 10px;
        }
    </style>
</head>
<body>
    <div class="primero">
        <?php
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
            $storyDatetime = $datetime->format('d-m-Y H:i:s');
            echo "<div>";
            echo "<h2>$storyTitle</h2>";
            echo "<div class='dateTime'>$storyDatetime</div>";
            echo "<p><pre>$storyText</pre></p>";
        }
        ?>
        <div class='commentsWall'>
            <div id='commentForm'>
                <form action="commentCode.php" method='GET'>
                    <input name='storyId' value='<?php echo $storyId ?>' type='hidden'>
                    <input type="text" name='text' placeholder='Write a comment...'>
                    <button type='submit'>Comment</button>
                </form>
            </div>
            <div id='comments'>
            <?php

                $query = "SELECT * FROM comments WHERE storyId LIKE $storyId";
                $result = connectionToDB($query);
                if($result->rowCount() > 0)
                {
                    foreach($result as $comment)
                    {
                        $commentUserId = $comment['userId'];
                        $queryUser = "SELECT * FROM users WHERE ID LIKE $commentUserId";
                        $resultUser = connectionToDB($queryUser);
                        $resultUser2 =  $resultUser->fetch();

                        $commentUsername = $resultUser2['username'];
                        $mysqlDatetime = $comment['dateTime'];
                        $datetime = new DateTime($mysqlDatetime);
                        $commentDatetime = $datetime->format('d-m-Y H:i:s');
                        $commentContent = $comment['content'];

                        echo "<div class='comment'>";
                        echo "<div class='commentInfo'>$commentUsername commented on $commentDatetime</div>";
                        echo "<div><pre>$commentContent</pre></div>";
                        echo "</div>";
                    }
                }

            ?>
            </div>
        </div>
    </div>
</body>
</html>