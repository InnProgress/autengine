<?php

	require "scripts/connection.php";
	require "scripts/mainFuncs.php";
	userAccountIncludes();

	// PHP SCRIPT
?>

<!DOCTYPE html>
<html>
<?php include("html/head.php"); ?>
<body>

	<?php include("html/header.php"); ?>

	<form method="GET">
		<input type="text" name="username" placeholder="Username"> <br>
		<button>Search</button>
	</form>

	<?php

	if(array_key_exists('username', $_GET)) {

		echo '<h2>Results: </h2>';

		$searchQuery = mysqli_query($connection, "SELECT `ID` FROM `users` WHERE `username` LIKE '%".mysqli_real_escape_string($connection, $_GET['username'])."%'");
		if(mysqli_num_rows($searchQuery)) {

			echo '<p>Results: '.mysqli_num_rows($searchQuery).'</p>';

			while($sRow = mysqli_fetch_array($searchQuery)) {
				echo '<p>'.userLink($sRow['ID']).'</p>';
			}
		} else {
			echo '<p>There is no results</p>';
		}
	}

	?>

	<?php include("html/footer.php"); ?>

</body>

</html>