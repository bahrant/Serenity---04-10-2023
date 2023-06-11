<?php 
require_once("dbconnect.php");

$toursQuery = $dbc -> prepare("SELECT tourID, tourFeaturedName, tourFeaturedImage,
tourFeaturedDesc, tourFeaturedAlt, tourCost FROM tours ORDER BY tourName");

$toursQuery -> execute();
$pageTitle = "All of Our Premier Tours";
$PageClass = "home";
$heroImage = "craterlake.jpg";
include("header.php"); 
?>
<main>
    <section id="hero">
        <section id="herocontent">
            <p>Tour List</p>
</section>
</section>
        <section id="tourgrid">
            <section id="mainhead">
                <h1>Premier National Park</h1>
                <p>Select the tour you want to book from the list below to 
                    view details, including available dates.</p>
</section>
<section id="tourgrid">
    <?php 
    while($tourResult = $toursQuery -> fetch()){
        echo "<article>"; 

        echo "<a href='tourdetail.php?tour=".$tourResult['tourID']."'>";

        echo "<h2>". $tourResult['tourFeaturedName']."</h2>";
        
        echo "<img src='images/".$tourResult['tourFeaturedImage']."'alt='".$tourResult['tourFeaturedAlt']."'>";

        echo "<p>". $tourResult['tourFeaturedDesc']."</p>";

        echo "<p>$". $tourResult['tourCost']."</p>" . "<p>$". "per person"."</p>";

        echo "</a></article>";
    }
    ?>
</section>

</main>
<?php include("footer.php");