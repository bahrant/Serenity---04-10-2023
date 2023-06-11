<?php
require_once ("dbconnect.php");

$reviewQuery = $dbc -> prepare("SELECT customerName, customerLocation, customerImage, reviewText FROM reviews");
$reviewQuery -> execute();

$featuredQuery = $dbc -> prepare("SELECT tourID, tourFeaturedName, tourFeaturedImage, tourFeaturedDesc, tourFeaturedAlt FROM tours");
$featuredQuery -> execute();

$pageTitle = "Premier National Park Tours";
$pageClass = "home";
$heroImage = "craterlake.jpg";
include("header.php");
?>
<main>
	<section id="hero">
		<section id="herocontent">
			<p>Visit The Parks Your Way</p>
			<a href="reservations.html">Book Your Tour Today</a>
		</section>
	</section>
	<section id="tourgrid">
		<section id="mainhead">
			<h1>Premier National Park Tours</h1>
			<p>With our custom-made national park tours, you can visit the most beautiful places in America your way. Whether it's a backcountry adventure, a private tour with a ranger or qualified historian, or a romantic getaway, Serenity Travel offers the best national park tours available.</p>
		</section>
		<section id="tourgrid">
            <?php
            while($tourResult = $featuredQuery -> fetch()){
                echo "<article>";
				echo "<a href='tourdetail.php?tour=" . $tourResult['tourID'] . "'>";
					echo "<h2>" . $tourResult['tourFeaturedName'].  "</h2>";
					echo "<img src='images/" . $tourResult['tourFeaturedImage'] . "' alt='" . $tourResult['tourFeaturedAlt'] . "'>";
					echo "<p>" . $tourResult['tourFeaturedDesc'] . "</p>";
				echo "</a></article>";
            }
            ?>


		</section>
		<a href="tours.html" class="cta">Take a look at our other tours</a>
	</section>
	<hr>
	<section id="reviews">
		<h2>What Our Customers Say</h2>

    <?php

    while($result = $reviewQuery -> fetch())
    {
		echo "<article>";
			echo "<img src='images/" . $result['customerImage'] . "' alt='Customer photo'>";

				echo "<h3>" . $result['customerName'] . " from " . $result['customerLocation'] . "</h3>";
				echo "<p>" . $result['reviewText'] . "</p>";
		
		echo "</article>";
		}
		?>
	</section>
</main>
<?php include ("footer.php");