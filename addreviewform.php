<?php
/*
session_start();
if(!isset($_SESSION['userID']))
{
    include("loginform.php");
    exit();
}
*/
$pageTitle = "Submit Review";
$pageClass = "reviewPage";
$heroImage = "craterlake.jpg";
include("header.php");
?>
<main>
<form method="post" action="addreviewaction.php" enctype="multipart/form-data">
    <fieldset>
        <legend>Submit a Review</legend>
        <label for="customerName">Name</label>
        <input type="text" name="customerName" id="customerName">
        <label for="customerLocation">Your Location</label>
        <input type="text" name="customerLocation" id="customerLocation">
        <label for=“reviewText">Your Review</label>
        <textarea name="reviewText" id="reviewText"></textarea>
        <label for="picture">Your Picture (JPG, PNG, or GIF, max size 1MB)</label>
        <input type="file" name="picture" id="picture" accept=".jpg, .gif, .png">
        <button type="submit">Submit Review</button>
        <input type="hidden" name="MAX_FILE_SIZE" value="1048576">
    </fieldset>
</form>
</main>
<?php
include("footer.php");
?>
