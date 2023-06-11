<?php

session_start();
if(!isset($_SESSION['userID']))
{
    include("loginform.php");
    exit();
}

include("dbconnect.php");

//basic validation
if(isset($_POST['username']))
{
    $error = array();
    $data = array();

    if($_POST['password'] != "")
    {
        $password = password_hash($_POST['password'], PASSWORD_ARGON2I);
        $data['password'] = $password;
		//var_dump($password);
    }
    else
    {
        $error[] = "You need to enter a password";
    }
	if($_POST['username'] != "")
    {
        $username = $_POST['username'];
        $data['username'] = $username;
    }
    else
    {
        $error[] = "You need to enter a username";
    }
    if($_POST['firstname'] != "")
    {
        $firstname = $_POST['firstname'];
        $data['firstname'] = $firstname;
    }
    else
    {
        $error[] = "You need to enter a first name";
    }
	if($_POST['lastname'] != "")
    {
        $lastname = $_POST['lastname'];
        $data['lastname'] = $lastname;
    }
    else
    {
        $error[] = "You need to enter a last name";
    }
	if($_POST['email'] != "")
    {
        if(preg_match("/^((([!#$%&'*+\-/=?^_`{|}~\w])|([!#$%&'*+\-/=?^_`{|}~\w][!#$%&'*+\-/=?^_`{|}~\.\w]{0,}[!#$%&'*+\-/=?^_`{|}~\w]))[@]\w+([-.]\w+)*\.\w+([-.]\w+)*)$/ix",$_POST['email'])){
            $email = $_POST['email'];
            $data['email'] = $email;
        } else {
            $error[] = "You need to enter a valid email address";
        }
    }
    else
    {
        $error[] = "You need to enter an email";
    }
	
	//if no errors, process the form
    if(empty($error))
    {

		$query = $dbc->prepare("INSERT INTO users (username, password, firstName, lastName, email) VALUES (:username, :password, :firstname, :lastname, :email)");
		$query -> execute($data);
		header('Location:adduser.php');
	}
}
?>
