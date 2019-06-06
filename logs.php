<?php

	require "scripts/connection.php";
	require "scripts/mainFuncs.php";
	userAccountIncludes();

	$row = loadUserData();
	$logsText = "";

	if($row['role'] < 4) {
		header("home.php");
	}


	if(array_key_exists('ID', $_GET)) {

		$logsQuerry = mysqli_query($connection, "SELECT * FROM `userslogs` WHERE `userID`='".mysqli_real_escape_string($connection, $_GET['ID'])."' OR `additionalID`='".mysqli_real_escape_string($connection, $_GET['ID'])."' ORDER BY `ID` DESC");

		if(mysqli_num_rows($logsQuerry)) {

			$logsText .= "<h2>".userLink($_GET['ID'])." logs</h2>";

			while($logsData = mysqli_fetch_array($logsQuerry)) {

				$logsText .= '
				<section class="notificationsSection">
					Type/title: <strong>'.$logsData['type'].'</strong> <br>
					Content: <strong>'.$logsData['content'].'</strong> <br>
					IP: <strong>'.$logsData['ip'].'</strong> <br>
					Date: <strong>'.date("Y-m-d H:i:s", $logsData['time']).'</strong>
				</section>
				';

			}


		
		} else {
			header("location: home.php");
		}


	} else {
		header("location: home.php");
	}
?>

<!DOCTYPE html>
<html>
<?php include("html/head.php"); ?>
<body>

	<?php include("html/header.php"); ?>

	<?php echo $logsText; ?>

	<?php include("html/footer.php"); ?>

</body>

</html>