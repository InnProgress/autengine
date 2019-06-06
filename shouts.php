<?php

	require "scripts/connection.php";
	require "scripts/mainFuncs.php";
	userAccountIncludes();
	$settingsIncludes .= formEditorIncludes();

	$row = loadUserData();

	/// DELETE SHOUT --------------------------------------------
	if(array_key_exists('deleteID', $_GET)) {
		if($_GET['deleteID'] == "all") {

			if($row['role'] >= 4) {
				$deleteMsg = mysqli_query($connection, "DELETE FROM `shouts`");
				addMiniMsg("All shouts deleted");
				addPlayerLog($_SESSION['userID'], -1, "Moderating", userLink($_SESSION['userID'])." deleted all shouts");
			}
		} else {

			$isRealShout = mysqli_query($connection, "SELECT * FROM `shouts` WHERE `ID`='".mysqli_real_escape_string($connection, $_GET['deleteID'])."'");

			if(mysqli_num_rows($isRealShout)) {

				$shoutInfo = mysqli_fetch_array($isRealShout);

				if($_SESSION['userID'] == $shoutInfo['writerID'] || $row['role'] >= 4) {

					$deleteShout = mysqli_query($connection, "DELETE FROM `shouts` WHERE `ID`='".mysqli_real_escape_string($connection, $_GET['deleteID'])."' LIMIT 1");
					if($deleteShout) {
						addMiniMsg("Shout with ID <b>".$_GET['deleteID']."</b> succesfully deleted.");

						if($shoutInfo['writerID'] != $_SESSION['userID']) {
							addNotification($shoutInfo['writerID'], "Shout", "You shout was deleted by ".userLink($_SESSION['userID'])."<br>Shout: ".$shoutInfo['content']);
						}

						addPlayerLog($_SESSION['userID'], $shoutInfo['writerID'], "Moderating", userLink($_SESSION['userID'])." deleted ".userLink($shoutInfo['writerID'])." shout");

					} else {
						addErrorMsg("There was an error while deleting shout, please contact admin");
					}
				} else {
					addErrorMsg("You can not delete this shout");
				}
			} else {
				addErrorMsg("This is not valid ID of shout");
			}
		}
	}



	$page = 1;
	if(array_key_exists('page', $_GET)) {
		$page = $_GET['page'];
	}
	$sPage = $page;
	if($sPage <= 1) $sPage = 0;
	else {
		$sPage --;
		$sPage *= 10;
	}
	$sPageMax = $sPage + 10;

	$userQueryText = "";
	$userIDText = "";

	if(array_key_exists('userID', $_GET)) {
		$userQueryText = " WHERE `writerID`='".mysqli_real_escape_string($connection, $_GET['userID'])."' ";
		$userIDText = "userID=".$_GET['userID'];
	}

	$allShouts = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM `shouts`".$userQueryText));

	$shoutsText = "";
	$moreOptions = "";

	if($row['role'] >= 4) {
		$moreOptions = '
		<p><a href="shouts.php?deleteID=all">Delete all shouts</a></p>
		';
	}

	$shoutsQuery = mysqli_query($connection, "SELECT * FROM `shouts`".$userQueryText."ORDER BY `ID` DESC LIMIT ".$sPage.", ".$sPageMax);

	if(mysqli_num_rows($shoutsQuery) < 1 && $page != 1) {
		header("location: shouts.php?".$userIDText);
	}

	while($newRow = mysqli_fetch_array($shoutsQuery)) {

		$shoutsText .= showShout($newRow, $row['role']);
	}

	if(strlen($shoutsText) < 1) $shoutsText = "<p>There is no shouts yet!</p>";
?>

<!DOCTYPE html>
<html>
<?php include("html/head.php"); ?>
<body>

	<?php include("html/header.php"); ?>


	<?php echo "<p>All shouts: ".$allShouts."</p>"; ?>

	<form method="POST" action="writeShout.php">
		<textarea id="summernote" name="shoutContent"></textarea>
		<button>Write</button>
	</form>


	<?php
		echo $moreOptions;
		echo $shoutsText;

		if($page > 1) echo ' <a href="shouts.php?page='.($page-1).'&'.$userIDText.'">'.($page-1).'</a> ';
		echo $page;
		if($sPageMax < $allShouts) echo ' <a href="shouts.php?page='.($page+1).'&'.$userIDText.'">'.($page+1).'</a> ';

	?>

	<?php include("html/footer.php"); ?>
	<?php include("scripts/formEditor.js"); ?>

</body>

</html>
