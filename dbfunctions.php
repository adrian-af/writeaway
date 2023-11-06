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
	$email = $data->xpath("//email");
	$emailpass = $data->xpath("//emailpass");
	$conn_string = sprintf("mysql:dbname=%s;host=%s", $name[0], $ip[0]);
	$result = [];
	$result[] = $conn_string; //0
	$result[] = $user[0]; //1
	$result[] = $password[0]; //2
	$result[] = $email; //3
	$result[] = $emailpass; //4
	return $result;
}

function connectionToDB($query)
{
	$res = load_config(dirname(__FILE__)."/configuration.xml", dirname(__FILE__)."/configuration.xsd");
    $db = new PDO($res[0], $res[1], $res[2]); //connexion to DB
    $result = $db->query($query);
	return $result;
}

use PHPMailer\PHPMailer\PHPMailer;
require dirname(__FILE__)."/../../../vendor/autoload.php";
function send_mail($mailaddress,  $code)
{
	$res = load_config(dirname(__FILE__)."/configuration.xml", dirname(__FILE__)."/configuration.xsd");
	$mail = new PHPMailer();		
	$mail->IsSMTP(); 					
	$mail->SMTPDebug  = 0; 
	$mail->SMTPAuth   = true;                  
	$mail->SMTPSecure = "tls";                 
	$mail->Host       = "smtp.gmail.com";      
	$mail->Port       = 587;                   
	$mail->Username   = "" .$res[3][0];  
	$mail->Password   = "" .$res[4][0];           
	$mail->SetFrom('noreply@writeaway.com', 'WriteAway Team');
	$mail->Subject    = "WriteAway email verification";
	$body = "Welcome to Writeaway! To verify your account, click on this link: " .dirname(__FILE__)."/verified.php?verificationCode=$code";
	$mail->MsgHTML($body);
	$mail->addAddress($mailaddress, 'Client');
	if(!$mail->Send()) {
	  return $mail->ErrorInfo;
	} else {
	  return TRUE;
	}
}