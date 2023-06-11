<?php


if(isset($_GET['page'])){
    $page = $_GET['page'];
} else {
    $page = $_SERVER['PHP_SELF'];
}

$pageTitle = "Log In";
$pageClass = "loginPage";
$heroImage = "craterlake.jpg";
include("header.php");
?>

<form method="post" action="loginaction.php?page=<?php echo $page; ?>">
<fieldset>  
    <?php
    if(isset($_GET['msg']))
    {
        $msg = $_GET['msg'];
        echo "<p class='error'>$msg</p>";
    }
    ?>
    <label for="username">Username:</label>
    <input type="text" name="username" id="username">
    <label for="password">Password:</label>
    <input type="text" name="password" id="password">
    <button type="submit">Log In</button>
</fieldset>
</form>

