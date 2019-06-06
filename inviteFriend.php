<?php

	require "scripts/connection.php";
	require "scripts/mainFuncs.php";
	userAccountIncludes();

	$row = loadUserData();
	
	if(array_key_exists('ID', $_GET)) {

		if($_SESSION['userID'] == $_GET['ID']) {
			addErrorMsg("Stop! Get help!");
		} else {

			$friendsInfo = loadFriendsInfo($_SESSION['userID'], $_GET['ID']);

			if(empty($friendsInfo)) {

				$inviteFriend = mysqli_query($connection, "INSERT INTO `friends` (`userID1`, `userID2`) VALUES ('".mysqli_real_escape_string($connection, $_SESSION['userID'])."', '".mysqli_real_escape_string($connection, $_GET['ID'])."')");
					
				addNotification($_GET['ID'], "Friends", userLink($_SESSION['userID'])." invited you to be friends. <br><a href='acceptFriend.php?ID=".$_SESSION['userID']."'>Click here</a> to accept friend request or <a href='deleteFromFriends.php?ID=".$_SESSION['userID']."'>click here to decline</a>");

				addMiniMsg("Friend request succesfully sent");

			} else {

				addErrorMsg("You can't invite this friend, because he already invited you. <a href='acceptFriend.php?ID=".$_GET['ID']."'>CLICK HERE TO ACCEPT FRIEND REQUEST</a>");
			}
		}
		header("location: user.php?ID=".$_GET['ID']);
	} else {
		header("location: home.php");
	}
?>