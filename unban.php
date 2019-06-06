<?php

	require "scripts/connection.php";
	require "scripts/mainFuncs.php";
	userAccountIncludes();

	$row = loadUserData();

	if($row['role'] < 4) {
		redirect("home.php");
	}

	if(isset($_GET['ID'])) {
		$banInfo = loadSInfo($_GET['ID'], "bans");
		if(!empty($banInfo)) {
			mysqli_query($connection, "DELETE FROM `bans` WHERE `userID`='".mysqli_real_escape_string($connection, $_GET['ID'])."'");
			addPlayerLog($_GET['ID'], $_SESSION['userID'], "Unban", "Player ".userLink($_GET['ID'])." unbanned by user ".userLink($_SESSION['userID']));
			addMiniMsg("Player succesfully unbanned");
		} else {
			addErrorMsg("This player is already unbanned or it is invalid player ID");
		}
	}

	redirect("user.php?ID=".$_GET['ID']);
?>
