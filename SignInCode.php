<?php
//function to check the configuration file that has the database parameters
function load_config($name, $schema)
{
	$config = new DOMDocument();
	$config->load($name);
	$res = $config->schemaValidate($schema);
	if ($res===FALSE){ 
	   throw new InvalidArgumentException("Check configuration file");
	} 		
	$data = simplexml_load_file($name);	
	$ip = $data->xpath("//ip");
	$name = $data->xpath("//name");
	$user = $data->xpath("//user");
	$password = $data->xpath("//password");	
	$conn_string = sprintf("mysql:dbname=%s;host=%s", $name[0], $ip[0]);
	$result = [];
	$result[] = $conn_string;
	$result[] = $user[0];
	$result[] = $password[0];
	return $result;
}

if(isset($_GET['email']))
{
    $email = $_GET['email'];
    $username = $_GET['username'];
    $pass = $_GET['pass'];
    $pass2 = $_GET['pass2'];

    $errorEmail = false;
    $errorUsername = false;
    $errorPass = false;
    $error = false;

    //returns error if the passwords don't match
    if($pass != $pass2) 
    {
        $errorPass = true;
    }

    //gets the database information into $res from the configuration xml file and checks it complies with the xsd schema
    $res = load_config(dirname(__FILE__)."/configuration.xml", dirname(__FILE__)."/configuration.xsd");
    $db = new PDO($res[0], $res[1], $res[2]); //connexion to DB
    $query = "SELECT * FROM users WHERE email = '$email'"; //checks if the email is registered
    $result = $db->query($query);
    if($result->rowCount() > 0) //if the query returns something, the email is registered
    {
        $errorEmail = true;
    }
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = $db->query($query);
    if($result->rowCount() > 0) //if the query returns something, the username is registered
    {
        $errorUsername = true;
    }
    
    if($errorEmail || $errorPass || $errorUsername)
    {
        $error = true;
        header("Location: SignIn.php?errorCode=$error&errorUsername=$errorUsername&errorPass=$errorPassword&errorEmail=$errorEmail"); //returns to the signin page with true or false for the errors so it prints what was wrong
        return;
    }
    
    $hashedPass = password_hash($pass, PASSWORD_DEFAULT); //function to encrypt password
    $query = "INSERT INTO users(email, username, password) VALUES('$email', '$username', '$hashedPass');";
    $result = $db->query($query); //insert into database
    if(!$result)
    {
        echo "error al registrar usuario";
    }
    else
    {
        $db->commit();
        header("Location: lobby.php"); //when it's registred, redirect to the lobby
    }
}
else
{
    echo "email is not set"; //should never get here
}
