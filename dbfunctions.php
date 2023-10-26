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