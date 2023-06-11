<?php

$user = 'root'; //db username
$pass = ''; //db password
$host = 'localhost'; //address to the db server
$dbname = 'serenity'; //name of the database

try {
	$dbc = new PDO("mysql:host=$host; dbname=$dbname", $user, $pass);
}
catch (PDOException $e) {
	echo $e -> getMessage();
}


//note no closing php delimiter