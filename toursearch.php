<?php
require_once ("dbconnect.php");

$rowsPerPage = 2;

if(isset($_POST['search'])){
	$search = $_POST['search'];
} elseif(isset($_GET['search'])){
	$search = $_GET['search'];
} else {
	header("Location: tours.php");
}

if(isset($_GET['start']))
{
	$start = $_GET['start'];
} else {
	$start = 0;
}

if(isset($_GET['numpages'])){
	$numPages = $_GET['numpages'];
	$totalRows = $_GET['totalrows'];
} else {
	$rowCountQuery = $dbc -> prepare("SELECT COUNT(tourID) as count FROM tours WHERE tourFeaturedName LIKE :search");
	$rowCountQuery -> bindValue(':search', '%' . $search . '%');
	$rowCountQuery -> execute();
	$rowCount = $rowCountQuery -> fetch();
	$totalRows = $rowCount['count'];
	// or, don't use COUNT() in the query, and simply use $rowCount = $rowCountQuery -> rowCount();

	if($totalRows <= $rowsPerPage){
		$numPages = 1;
	} else {
		$numPages = ceil($totalRows/$rowsPerPage);
	}
}

$toursQuery = $dbc -> prepare("SELECT tourID, tourFeaturedName, tourFeaturedImage, tourFeaturedDesc, 
								tourFeaturedAlt, tourCost 
								FROM tours 
								WHERE tourFeaturedName LIKE :search
								ORDER BY tourName
								LIMIT $start, $rowsPerPage");
$toursQuery -> bindValue(':search', '%' . $search . '%');
$toursQuery -> execute();

$pageTitle = "All of Our Premier Tours";
$pageClass = "home";
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
			<h1>Premier National Park Tours</h1>
			<p>Select the tour you want to book from the list below to view details, including available dates.</p>
			<form action="toursearch.php" method="post" class="searchform">
			<p>Or, you can search for available tours: <input type="text" name="search" id="search">
			<button type="submit">Search</button></p>
			</form>
		</section>
		<section id="tourgrid">
			<p>Your search returned <?php echo $totalRows; ?> results.</p>
            <?php
            while($tourResult = $toursQuery -> fetch()){
                echo "<article>";
				echo "<a href='tourdetail.php?tour=" . $tourResult['tourID'] . "'>";
					echo "<h2>" . $tourResult['tourFeaturedName'].  "</h2>";
					echo "<img src='images/" . $tourResult['tourFeaturedImage'] . "' alt='" . $tourResult['tourFeaturedAlt'] . "'>";
					echo "<p>" . $tourResult['tourFeaturedDesc'] . "</p>";
                    echo "<p>$" . $tourResult['tourCost'] . " per person.</p>";
				echo "</a></article>";
            }
            ?>
		</section>
		<section id="pagination">
			<p>
			<?php
			if($numPages > 1){
				$currentPage = ($start/$rowsPerPage) + 1;

				if($currentPage != 1){
					//only show when not on first page
					echo "<a href='toursearch.php?start=" . ($start-$rowsPerPage) . "&search=$search&numpages=$numPages&totalrows=$totalRows'>Previous</a>";
				}
				

				//show numbered pages here, with current page unlinked
				for($i = 1; $i <= $numPages; $i++){
					if($i != $currentPage){
						echo " <a href='toursearch.php?start=" . ($rowsPerPage * ($i - 1)) . "&search=$search&numpages=$numPages&totalrows=$totalRows'>$i</a> ";
					} else {
						echo $i;
					}
				}
				

				if($currentPage != $numPages){
					//only show when not on last page
					echo "<a href='toursearch.php?start=" . ($start+$rowsPerPage) . "&search=$search&numpages=$numPages&totalrows=$totalRows'>Next</a>";
				}
			}	
			?>
			</p>
		</section>
</main>
<?php include ("footer.php");