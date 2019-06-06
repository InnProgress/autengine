<?php

	require "scripts/connection.php";
	require "scripts/mainFuncs.php";
	userAccountIncludes();

	$row = loadUserData();

	$usernameBan = "";

	if($row['role'] < 4) {
		redirect("home.php");
	}

	if(array_key_exists('ID', $_GET)) {

		$isRealUser = mysqli_query($connection, "SELECT `username` FROM `users` WHERE `ID`='".mysqli_real_escape_string($connection, $_GET['ID'])."'");
		if(!mysqli_num_rows($isRealUser)) {
			redirect("home.php");
		} else {
			$banUsername = mysqli_fetch_array($isRealUser);
			$usernameBan = $banUsername[0];
		}

	} else {
		redirect("home.php");
	}

	if(array_key_exists('banButton', $_POST)) {

		$_POST['ID'] = User::getUserID($_POST['username']);

		$banInfo = User::loadSInfo($_POST['ID'], "bans");
		if(empty($banInfo)) {
			$banTime = $_POST['time'];
			if($banTime > 0) {
				$banTime = time() + $_POST['time'] * 60;
			}

			mysqli_query($connection, "INSERT INTO `bans` (`userID`, `adminID`, `reason`, `time`) VALUES ('".$_POST['ID']."', '".mysqli_real_escape_string($connection, $_SESSION['userID'])."', '".mysqli_real_escape_string($connection, strip_tags($_POST['reason']))."', '".mysqli_real_escape_string($connection, $banTime)."')");

			mysqli_query($connection, "DELETE FROM `user_online` WHERE `userID`='".$_POST['ID']."'");

			addPlayerLog($_POST['ID'], $_SESSION['userID'], "Ban", "Player ".userLink($_POST['ID'])." banned by user ID: ".userLink($_SESSION['userID']).". Reason: ".$_POST['reason']);

			addMiniMsg("Player succesfully banned");
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
		<input type="text" name="username" value="<?php echo $usernameBan; ?>" placeholder="Username">
		<input type="text" name="reason" placeholder="Reason">
		<input type="number" name="time" placeholder="Time (-1 if permament ban) in minutes">
		<button name="banButton">Ban</button>
	</form>

	<?php include("html/footer.php"); ?>

</body>

</html>
