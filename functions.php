<?php
function sessionTest(){
	session_start();
	if(!isset($_SESSION['userID']))
	{
		header("Location:loginform.php");
	}
}

function validateForm($fields){
	$data = array();
	$error = array();
	foreach($fields as $field => $value){
		if($value == "")
		{
			$error[] = "You need to enter a value for $field";
		}
		else
		{
			$data[$field] = $value; 
		}
	}
	return array('data' => $data, 'error' => $error);
}