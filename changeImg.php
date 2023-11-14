<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="./changeImgCode.php" method='POST' enctype="multipart/form-data">
        <label for="photo">New profile photo:</label>
        <input type="file" id='photo' name='photo' accept='image/png, image/jpeg, image/gif'><br>
        <button>Submit</button>
    </form>
</body>
</html>