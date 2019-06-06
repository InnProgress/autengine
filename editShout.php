<?php

	require "scripts/connection.php";
	require "scripts/mainFuncs.php";
	userAccountIncludes();
	$settingsIncludes .= formEditorIncludes();

	$row = loadUserData();


	$aMsg = "";
	$aContent = "";
	$writer;

	if(array_key_exists('ID', $_GET)) {
		$isRealShout = mysqli_query($connection, "SELECT `writerID`, `content` FROM `shouts` WHERE `ID`='".mysqli_real_escape_string($connection, $_GET['ID'])."'");
		if(mysqli_num_rows($isRealShout)) {

			$shoutRow = mysqli_fetch_array($isRealShout);

			if($row['role'] >= 4 || $_SESSION['userID'] == $shoutRow['writerID']) {

				$aContent = $shoutRow['content'];
				$writer = $shoutRow['writerID'];
			} else {

				header("location: shouts.php");
			}

		} else {
			header("location: shouts.php");
		}
	}

	if(array_key_exists('shoutContent', $_POST) && array_key_exists('ID', $_GET) && $writer >= 0) {

		if(strlen($_POST['shoutContent']) < 3) $aMsg .= "<p>Shout most contain at least 3 symbols</p>";
		else if(strlen($_POST['shoutContent']) > 200) $aMsg .= "<p>Shout most not contain more than 200 symbols</p>";
		else {
			addMiniMsg("Shout succesfully edited");

			mysqli_query($connection, "UPDATE `shouts` SET `content`='".mysqli_real_escape_string($connection, $_POST['shoutContent'])."' WHERE `ID`='".mysqli_real_escape_string($connection, $_GET['ID'])."'");

			if($writer != $_SESSION['userID']) { 
				addNotification($writer, "Shout", "You shout was edited by ".userLink($_SESSION['userID']));
			}

			addPlayerLog($_SESSION['userID'], $writer, "Moderating", userLink($_SESSION['userID'])." edited ".userLink($writer)." shout");

			header("location: shouts.php");
		}
	}
?>

<!DOCTYPE html>
<html>
<?php include("html/head.php"); ?>
<body>

	<?php include("html/header.php"); ?>

	<div><?php echo $aMsg; ?></div>

	<form method="POST">
		<textarea id="summernote" name="shoutContent"><?php echo $aContent; ?></textarea>
		<button>Edit</button>
	</form>

	<?php include("html/footer.php"); ?>
	<?php include("scripts/formEditor.js"); ?>

</body>

</html>