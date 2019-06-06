<?php

	require "scripts/connection.php";
	require "scripts/mainFuncs.php";
	userAccountIncludes();

	$row = loadUserData();
	if($row['role'] < 4) {
		redirect("home.php");
	}

	if(isset($_GET['ID'])) {
		$muteInfo = loadSInfo($_GET['ID'], "mutes");
		if(!empty($muteInfo)) {
			mysqli_query($connection, "DELETE FROM `mutes` WHERE `userID`='".mysqli_real_escape_string($connection, $_GET['ID'])."'");
			addPlayerLog($_GET['ID'], $_SESSION['userID'], "Unmute", "Player ".userLink($_GET['ID'])." unmuted by user ".userLink($_SESSION['userID']));
			addMiniMsg("Player succesfully unmuted");
			addNotification($_GET['ID'], "Mute", "You were unmuted by user ".userLink($_SESSION['userID']));
		} else {
			addErrorMsg("This player is already unmuted or it is invalid player ID");
		}
	}

	redirect("user.php?ID=".$_GET['ID']);
?>
