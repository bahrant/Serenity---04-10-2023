<?php
if(isset($_POST['username']))
{
	if($_POST['username'] != "" && $_POST['password'] != "")
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
        include("dbconnect.php");
        $query = $dbc->prepare("SELECT userID, username, password 
        FROM users WHERE username = :username");
		$query->bindValue(":username", $username);
        $query->execute();
		$user = $query->fetchAll();
		
		if($query->rowCount() != 0 && password_verify($password, $user[0]['password']))
		{
			session_start();
            $_SESSION['userID'] = $user[0]['userID'];
            if($_GET['page'] != "/serenity/loginform.php"){
                header("Location:" . $_GET['page']);
            } else {
                header("Location: admin.php");
            }
            
	
		}
		else
		{
			$error = urlencode("Invalid username and/or password.");
            header("Location:loginform.php?msg=$error&page=" . $_GET['page']);
		}
    }
    else
    {
        $error = urlencode("Please fill in both fields.");
        header("Location:loginform.php?msg=$error&page=" . $_GET['page']);
    }
}
else
{
    $error=urlencode("Please log in.");
    header("Location:loginform.php?msg=$error&page=" . $_GET['page']);
}
