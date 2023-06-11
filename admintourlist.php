<?php
/*
session_start();

if(!isset($_SESSION['userID']))
{
    include("loginform.php");
    exit();
}
*/
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
