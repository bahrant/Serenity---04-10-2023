<?php

require_once("dbconnect.php");

if(isset($_GET['tourID']))
{

    $getrecordsquery = $dbc -> prepare("SELECT tourID, tourName, tourFeaturedName, tourFeaturedImage, tourHeroImage,
    tourDescImage, tourFeaturedDesc, tourHead, tourTeaser, tourDetail, tourCost, tourPageID, tourFeaturedAlt,
    tourDescAlt FROM tours WHERE tourID = :tourID");
    $getrecordsquery -> bindParam(':tourID', $_GET['tourID']);
    $getrecordsquery -> execute();

    $pageTitle = "Admin: Update Tour";
    $pageClass = "admin";
    $heroImage = "";
    include("header.php");

    echo "<main>";

    if(isset($_GET['error'])){
        echo "<section class='error'>" . $_GET['error'] . "</section>";
    }

    echo "<form method='post' action='" . $_SERVER['PHP_SELF'] . "'>";

    while($row = $getrecordsquery -> fetch())
    {
        echo "<label for='tourName'>Tour Name</label>";
        echo "<input type='text' name='tourName' id='tourName' value='" . $row['tourName'] . "'>";

        echo "<label for='tourFeaturedName'>Featured Name</label>";
        echo "<input type='text' name='tourFeaturedName' id='tourFeaturedName' value='" . $row['tourFeaturedName'] . "'>";

        echo "<label for='tourFeaturedImage'>Featured Image</label>";
        echo "<input type='text' name='tourFeaturedImage' id='tourFeaturedImage' value='" . $row['tourFeaturedImage'] . "'>";

        echo "<label for='tourFeaturedAlt'>Featured Image Alt</label>";
        echo "<input type='text' name='tourFeaturedAlt' id='tourFeaturedAlt' value='" . $row['tourFeaturedAlt'] . "'>";

        echo "<label for='tourHeroImage'>Hero Image</label>";
        echo "<input type='text' name='tourHeroImage' id='tourHeroImage' value='" . $row['tourHeroImage'] . "'>";

        echo "<label for='tourDescImage'>Description Image</label>";
        echo "<input type='text' name='tourDescImage' id='tourDescImage' value='" . $row['tourDescImage'] . "'>";

        echo "<label for='tourDescAlt'>Description Image Alt</label>";
        echo "<input type='text' name='tourDescAlt' id='tourDescAlt' value='" . $row['tourDescAlt'] . "'>";

        echo "<label for='tourFeaturedDesc'>Featured Descripion</label>";
        echo "<textarea name='tourFeaturedDesc' id='tourFeaturedDesc'>" . $row['tourFeaturedDesc'] . "</textarea>";

        echo "<label for='tourHead'>Tour Header</label>";
        echo "<input type='text' name='tourHead' id='tourHead' value='" . $row['tourHead'] . "'>";

        echo "<label for='tourTeaser'>Teaser Text</label>";
        echo "<textarea name='tourTeaser' id='tourTeaser'>" . $row['tourTeaser'] . "</textarea>";

        echo "<label for='tourDetail'>Detail Text</label>";
        echo "<textarea name='tourDetail' id='tourDetail'>" . $row['tourDetail'] . "</textarea>";

        echo "<label for='tourCost'>Cost</label>";
        echo "<input type='number' name='tourCost' id='tourCost' value='" . $row['tourCost'] . "'>";

        echo "<label for='tourPageID'>Page ID</label>";
        echo "<input type='text' name='tourPageID' id='tourPageID' value='" . $row['tourPageID'] . "'>";

        echo "<input type='hidden' name='tourID' id='tourID' value='" . $row['tourID'] . "'>";
    }
    echo "<input type='submit' value='Update Tour'>";
    echo "</main>";
    include("footer.php");
}
else if(isset($_POST['tourID']))
{
    $error = array();
    $data = array(); 

    if($_POST['tourName'] != ""){
        $data['tourName'] = $_POST['tourName'];
    }
    else{
        $error[] = "You must have a tour name";
    }
    if($_POST['tourFeaturedName'] != ""){
        $data['tourFeaturedName'] = $_POST['tourFeaturedName'];
    }
    else{
        $error[] = "You must have a tour featured name";
    }
    if($_POST['tourFeaturedImage'] != ""){
        $data['tourFeaturedImage'] = $_POST['tourFeaturedImage'];
    }
    else{
        $error[] = "You must have a tour featured image";
    }
    if($_POST['tourHeroImage'] != ""){
        $data['tourHeroImage'] = $_POST['tourHeroImage'];
    }
    else{
        $error[] = "You must have a tour hero image";
    }
    if($_POST['tourDescImage'] != ""){
        $data['tourDescImage'] = $_POST['tourDescImage'];
    }
    else{
        $error[] = "You must have a tour description image";
    }
    if($_POST['tourFeaturedDesc'] != ""){
        $data['tourFeaturedDesc'] = $_POST['tourFeaturedDesc'];
    }
    else{
        $error[] = "You must have a tour featured description";
    }
    if($_POST['tourHead'] != ""){
        $data['tourHead'] = $_POST['tourHead'];
    }
    else{
        $error[] = "You must have a tour head";
    }
    if($_POST['tourTeaser'] != ""){
        $data['tourTeaser'] = $_POST['tourTeaser'];
    }
    else{
        $error[] = "You must have a tour teaser";
    }
    if($_POST['tourDetail'] != ""){
        $data['tourDetail'] = $_POST['tourDetail'];
    }
    else{
        $error[] = "You must have a tour detail";
    }
    if($_POST['tourCost'] != ""){
        $data['tourCost'] = $_POST['tourCost'];
    }
    else{
        $error[] = "You must have a tour cost";
    }
    if($_POST['tourPageID'] != ""){
        $data['tourPageID'] = $_POST['tourPageID'];
    }
    else{
        $error[] = "You must have a tour page ID";
    }
    if($_POST['tourFeaturedAlt'] != ""){
        $data['tourFeaturedAlt'] = $_POST['tourFeaturedAlt'];
    }
    else{
        $error[] = "You must have alternate text for your featured image";
    }
    if($_POST['tourDescAlt'] != ""){
        $data['tourDescAlt'] = $_POST['tourDescAlt'];
    }
    else{
        $error[] = "You must have alternate text for your description image";
    }

    $data['tourID'] = $_POST['tourID'];
   
    if(empty($error)){
        $updatequery = $dbc -> prepare("UPDATE tours SET tourName = :tourName, tourFeaturedName = :tourFeaturedName,
        tourFeaturedImage = :tourFeaturedImage, tourHeroImage = :tourHeroImage, tourDescImage = :tourDescImage, 
        tourFeaturedDesc = :tourFeaturedDesc,  tourHead = :tourHead, tourTeaser = :tourTeaser, 
        tourDetail = :tourDetail, tourCost = :tourCost, tourPageID = :tourPageID, tourFeaturedAlt = :tourFeaturedAlt, 
        tourDescAlt = :tourDescAlt WHERE tourID = :tourID");
        $updatequery -> execute($data);

       header("location: admintourlist.php");
    }
    else{
        $message = "<ul>";
        foreach($error as $value)
        {
            $message .= "<li>$value</li>";
        }
        $message .= "</ul>";
        $message = urlencode($message);
        header("location:". $_SERVER['PHP_SELF'] . "?error=$message&tourID=" . $_POST['tourID']);
    }
} else {
    header("location: admintourlist.php");
}


?>