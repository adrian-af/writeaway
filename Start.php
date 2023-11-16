
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <!-- <link href="ComonStyles.css" rel="stylesheet"> -->
    <style>
        body{
            background-color: aqua;
            background-image: url("./Imagenes/fondo2.png");
            background-size: 100% auto;
            background-repeat: repeat-y;
        }
        .primero {
            background: rgba(213, 202, 152, 0.44);
            margin: 2.5%  20% 0 20%;
            padding: 20px 0% 0 5%;
            height: auto;
            border: 1px solid black;
        }
        .primero> *{
            padding: 5px;
            width: 85%;
            border: 1px solid black;
        }
        .logIn, .signUp{
            width: 45%;
            border: 5px dotted #66424c;
            text-align: center;
        }
        .logIn{
            float: left;
        }
        .signUp{
            float: right;
        }
    </style>
</head>
<body>
    <?php
        include "./header.php";
    ?>
    <div class="primero">
        <h2>Welcome to</h2>
        <img src="Imagenes/logotipo.png">
        <div>
            <div class="logIn">
                <p>Are you with us already?</p>
                <a href="LogIn.php"><button>Log In</button></a>
            </div>
            <div class="signUp">
                <p>Want to join us and start writing?</p>
                <a href="SignIn.php"><button>Sign Up</button></a>
            </div>
        </div>
        <img src="./Imagenes/libros.png">
        <div>
            <h3>What is this web?</h3>
            <p>
                Welcome to Write Away, a creative space for young writers! 
                This user-friendly website is designed for enyone who wnats to
                to unleash their imagination, share stories, and explore the 
                diverse world of storytelling.</p>
            <h3>Who are we?</h3>
            <p>
                We are Adrián and Cielo, two hardworking students of Web Apllication Development
                in I.E.S CLara del Rey in Spain that had combined their habilities learned to create
                this web poryect.
            </p>
            <h3>Whant to contact us?</h3>
            <p>Contact email fakemail@mailme.com</p>
        </div>
    </div>
</body>
</html>