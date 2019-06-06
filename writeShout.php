<?php

	require "scripts/connection.php";
	require "scripts/mainFuncs.php";
	userAccountIncludes();

	$row = loadUserData();

	if(User::isMuted()) {
		addErrorMsg("You can not write shouts while you are muted");
	}
	else {
		if(isset($_POST['shoutContent'])) {
			if(time() - $row['lastShout'] > 200 || $row['role'] >= 4) {

				if(strlen($_POST['shoutContent']) < 3) addErrorMsg("Shout most contain at least 3 symbols");
				else if(strlen($_POST['shoutContent']) > 300) addErrorMsg("Shout most not contain more than 300 symbols");
				else {
					mysqli_query($connection, "INSERT INTO `shouts` (`writerID`, `content`, `time`) VALUES ('".mysqli_real_escape_string($connection,$_SESSION['userID'])."', '".mysqli_real_escape_string($connection, $_POST['shoutContent'])."', '".time()."')");
					mysqli_query($connection, "UPDATE `users` SET `lastShout`='".time()."' WHERE `ID`='".mysqli_real_escape_string($connection,$_SESSION['userID'])."'");

					addMiniMsg("Shout succesfully written");
				}
			} else {
				addErrorMsg("You can't write shouts that often");
			}
		}
	}

	redirect("shouts.php");
?>
