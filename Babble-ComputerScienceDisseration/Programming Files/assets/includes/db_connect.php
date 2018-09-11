<?php
class db_connect{

private	function __construct(){}

//Generate PDO connection using relevant information
public static function infGen() {
	$host = 'localhost';
	$user = 'jbran051';
	$pass = 'MySQL123';
	$db = 'test';
//Try PDO connection
try {
	$db = new PDO('mysql:host='.$host.';dbname='.$db, $user, $pass); 	
} catch (PDOexception $e) { 	echo("Connection error"); }
return $db;
}
}
?>
