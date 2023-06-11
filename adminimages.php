<?php

session_start();
if(!isset($_SESSION['userID']))
{
    include("loginform.php");
    exit();
}

if(isset($_POST['filter'])){
    switch ($_POST['filter']){
        case 'JPG':
            $filter =  '/\.(jpg)$/i';
            break;
        case 'GIF':
            $filter =  '/\.(gif)$/i';
            break;
        case 'PNG':
            $filter =  '/\.(png)$/i';
            break;
        case 'SVG':
            $filter =  '/\.(svg)$/i';
            break;
        default:
            $filter = "";
    }
}

$pageTitle = "Serenity Image Admin";
$pageClass = "admin";
$heroImage = "craterlake.jpg";
include("header.php");
?>
<main>
	<h1>Images</h1>
    <section class='imagelist'>
      <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <label for="filter">Show only files of type:</label>
            <select name='filter' id="filter">
                <option value="">Show All</option>
                <option>JPG</option>
                <option>GIF</option>
                <option>PNG</option>
                <option>SVG</option>
            </select>
            <button>Filter</button>
        </form>
   <?php
    $files = new FilesystemIterator('images');
    if(isset($_POST['filter']) && $_POST['filter'] != ""){
        $files = new RegexIterator($files, $filter);
    }
    echo "<p>There were " .  iterator_count($files) . " images found.</p>";
    echo "<ul>";
    foreach($files as $file){
       echo "<li><a href='$file'>$file</a></li>";
       /*echo "<img src='$file'>";*/
    }
    
   ?>
    </ul>
   </section>
</main>
<?php include ("footer.php");