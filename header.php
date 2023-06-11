<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Serenity Travel: <?php echo $pageTitle; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;700&display=swap" rel="stylesheet">
    <link href="styles.css" type="text/css" rel="stylesheet">

    <style>
        #hero {
            background-image: url("images/<?php echo $heroImage ?>");
        }

    </style>
</head>

<body class="<?php echo $pageClass; ?>">
<div id="container">
    <header>
        <a href="index.php"><img src="images/logo.png" alt="Serenity Travel" class="logo"></a>
        <?php
        include('sociallinks.php');
        include('navigation.php');
        ?>
    </header>