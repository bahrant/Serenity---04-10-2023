<?php
/*
session_start();
if(!isset($_SESSION['userID']))
{
    include("loginform.php");
    exit();
}
*/
if(isset($_POST['customerName']))
{
    $error = array();
    $data = array();
    $uploaderror = "";

    if(isset($_FILES['picture'])){
        $allowed = array('image/jpg', 'image/jpeg', 'image/gif', 'image/png');
        if(in_array($_FILES['picture']['type'], $allowed)){
            if(move_uploaded_file($_FILES['picture']['tmp_name'], "images/{$_FILES['picture']['name']}")){
                $reviewImagePath = $_FILES['picture']['name'];
                $data['customerImage'] = $reviewImagePath;
            }
            else {
                switch($_FILES['picture']['error']){
                    case 1:
                        $uploaderror .= "This file exceeds the upload_max_filesize setting in php.ini";
                        break;
                    case 2:
                        $uploaderror .= "This file exceeds the MAX_FILE_SIZE setting in the HTML";
                        break;
                    case 3: 
                        $uploaderror .= "The file was only partially uploaded.";
                        break;
                    case 4: 
                        $uploaderror .= "No file was uploaded.";
                        break;
                    case 6:
                        $uploaderror .= "No temporary folder was available.";
                        break;
                    default:
                        $uploaderror .= "A system error occurred.";
                }
            }
        } else {
            $uploaderror .= "Please upload a PNG, JPG, or GIF.";
        }
    } else {
        $error[] = "Please select a file to upload.";
    }
    
    if($_POST['customerName'] != "")
    {
        $customerName = $_POST['customerName'];
        $data['customerName'] = $customerName;
    }
    else
    {
        $error[] = "You need to enter your name";
    }
    if($_POST['customerLocation'] != "")
    {
        $customerLocation = $_POST['customerLocation'];
        $data['customerLocation'] = $customerLocation;
    }
    else
    {
        $error[] = "You need to enter your location (just a state is fine)";
    }
    if($_POST['reviewText'] != "")
    {
        $reviewText = $_POST['reviewText'];
        $data['reviewText'] = $reviewText;
    }
    else
    {
        $error[] = "You need to enter a review";
    }

    if(empty($error)){
        include("dbconnect.php");
        $query = $dbc->prepare("INSERT INTO reviews (customerName, customerLocation, reviewText, customerImage) VALUES (:customerName, :customerLocation, :reviewText, :customerImage)");
		$query->execute($data);
        header("location:index.php");
    }
    else{
        $message = "<ul>";
        foreach($error as $value)
        {
            $message .= "<li>$value</li>";
        }
        $message .= "</ul>";
        header("location:addreviewform.php");
    }
}
