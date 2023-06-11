<?php
require_once("dbconnect.php");

$tourID = $_GET['tour'];

$tourquery = $dbc-> prepare(" SELECT tourID, tourName, tourHeroImage, 
tourDescImage, tourFeaturedDesc, tourHead, tourTeaser, 
TourDetail, tourCost, tourPageID FROM tours WHERE tourID = :tourid"); 
$tourquery -> bindParam("tourid",$tourid);
$tourquery-> execute();
$tourresult = $tourquery->fetch();




$datesquery = $dbc -> prepare("
SELECT DATE_FORMAT(startdate,'%m/%d/%y') AS start, 
DATE_FORMAT(enddate, '%m/%d/%y') AS end, soldout
FROM tourdates WHERE tourid = :tourID");
$datesquery -> bindParam('tourID',$tourID);
$datesquery -> execute();



$pageTitle = "Yosemite";
$pageClass = "yosemitetour tourpage";
$heroImage = "yosemitebanner.jpg";
include("header.php");
?>

<main>

<!-- delete the code bewteen these lines when you're done with the slides -->

<!-- stop deleting -->

<?php

	echo '<section id="hero">';
		echo '<section id="herocontent">';
			echo '<p>' . $tourresult['tourName'] . '</p>';
		echo '</section>';
	echo '</section>';
	
	echo '<section>';
		echo '<section id="mainhead">';
			echo '<h1>' . $tourresult['tourHead'] . '</h1>';
            echo '<p>' .  $tourresult['tourTeaser'] . '</p>';
				echo '</section>';
		echo '<section id="tourdetails">';
			echo '<img src="images/' . $tourresult['tourDescImage'] .'" width="400" height="400" alt="' . $tourresult['tourName'] .'"/>';
			echo '<section>';
            echo $tourresult['tourDetail'];
			echo '</section>';
			echo '<article>';
				echo '<p>$' . $tourresult['tourCost'] . 'per person</p>';
		
		?>

		<h2>Available dates:</h2>
		<ul>
			<?php
			while($datesresult= $datesquery->fetch()){
				if($datesresult['soldout']){
					echo"<li>". $datesresult['start']." to ". $dateresult['end']."</li>";
				} else{
					echo"<liclass='soldout'>". $datesresult['start'] . " to ".  $datesresult['end']. "SOLD OUT </li>"; 
				}
			}
			?>
				<p><a href="#" class="cta">Book Now</a></p>
			</article>
		</section>
		
		<section id="tourgrid">
			<h2>Add-on Tours</h2>
			<section>
				<img src="images/sequoia-ad.jpg" width="284" height="284" alt="Sequoia National Park"/>
				<h3>Kings Canyon and Sequoia National Parks</h3>
				<p><a href="#" class="cta">Learn More</a></p>
			</section>
			<section>
				<img src="images/sanfrancisco-ad.jpg" width="284" height="284" alt="San Francisco"/>
				<h3>San Francisco</h3>
				<p><a href="#" class="cta">Learn More</a></p>
			</section>
		</section>	
	</section>
</main>
<?php include("footer.php"); ?>
