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
            flex-direction: row;
            background-color: red;
            margin: 0;

        }
    </style>
</head>
<body>
    <header>
        <div id='headerleft'>
            <div id='logo'></div>
            <div id='homepage'>Home</div>
            <div id='genre'>
                Genre
                <?php echo 'hola'?>
            </div>
            <div id='search'></div>
        </div>    
        <div id='headerright'>
            <div id='profile'></div>
        </div>
    </header>
</body>
</html>