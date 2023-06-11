<?php
/*
session_start();
if(!isset($_SESSION['userID']))
{
    include("loginform.php");
    exit();
}

require_once ("dbconnect.php");

$pageTitle = "Serenity Admin";
$pageClass = "admin";
$heroImage = "craterlake.jpg";
include("header.php");

///
<main>
	<h1>Admin</h1>
    <ul>
        <li><a href="addreviewform.php">Add Review</a></li>
        <li><a href="adduser.php">Add User</a></li>
        <li><a href="admintourlist.php">Tour List</a></li>
        <li><a href="logout.php">Log Out</a></li>
    </ul>
</main>
//// 
?>

<?php*/ 
require_once("dbconnect.php");
$pageTitle = "Admin: Tour List";
$pageClass = "admin";
$heroImage = "";
include("header.php");

$query = $dbc->prepare("SELECT tourID, tourName FROM tours");
$query->execute();

echo "<main>";
echo "<ul>";

while($row = $query->fetch())
{
	echo "<li>" . $row['tourName'] . " (<a href='adminupdatetour.php?tourID=". $row['tourID'] . "'>edit</a>)</li>";
}
echo "</ul>";
echo "</main>";
include("footer.php");
?>

include ("footer.php");