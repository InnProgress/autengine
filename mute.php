<?php

	require "scripts/connection.php";
	require "scripts/mainFuncs.php";
	userAccountIncludes();

	$row = loadUserData();

	$usernameMute = "";

	if($row['role'] < 4) {
		redirect("home.php");
	}

	if(array_key_exists('ID', $_GET)) {

		$isRealUser = mysqli_query($connection, "SELECT `username` FROM `users` WHERE `ID`='".mysqli_real_escape_string($connection, $_GET['ID'])."'");
		if(!mysqli_num_rows($isRealUser)) {
			redirect("home.php");
		} else {
			$muteUsername = mysqli_fetch_array($isRealUser);
			$usernameMute = $muteUsername[0];
		}
	} else {
		redirect("home.php");
	}

	if(array_key_exists('muteButton', $_POST)) {

		$_POST['ID'] = User::getUserID($_POST['username']);

		$muteInfo = User::loadSInfo($_POST['ID'], "mutes");
		if(empty($muteInfo)) {
			$muteTime = $_POST['time'];

			if($_POST['time'] > 0) {
				$muteTime = time() + $_POST['time'] * 60;

				mysqli_query($connection, "INSERT INTO `mutes` (`userID`, `adminID`, `reason`, `time`) VALUES ('".mysqli_real_escape_string($connection, $_POST['ID'])."', '".mysqli_real_escape_string($connection, $_SESSION['userID'])."', '".mysqli_real_escape_string($connection, strip_tags($_POST['reason']))."', '".mysqli_real_escape_string($connection, $muteTime)."')");

				addPlayerLog($_POST['ID'], $_SESSION['userID'], "Mute", "Player ".userLink($_POST['ID'])." muted BY user ".userLink($_SESSION['userID']).". Reason: ".$_POST['reason']." for ".$_POST['time']." minutes");
				addMiniMsg("Player succesfully muted");
				addNotification($_POST['ID'], "Mute", "You were muted BY user ".userLink($_SESSION['userID']).". <br>Reason: ".$_POST['reason']." for ".$_POST['time']." minutes");
			} else {
				addErrorMsg("Mute should be at least for 1 minute");
			}
		} else {
			addErrorMsg("This player is already muted");
		}

		redirect("user.php?ID=".$_GET['ID']);

	}

?>

<!DOCTYPE html>
<html>
<?php include("html/head.php"); ?>
<body>

	<?php include("html/header.php"); ?>

	<form method="POST">
		<input type="text" name="username" value="<?php echo $usernameMute; ?>" placeholder="Username">
		<input type="text" name="reason" placeholder="Reason">
		<input type="number" name="time" placeholder="Time in minutes">
		<button name="muteButton">Mute</button>
	</form>

	<?php include("html/footer.php"); ?>

</body>

</html>
