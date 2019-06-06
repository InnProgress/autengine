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

			if(!empty($friendsInfo)) {

				if($friendsInfo['accepted'] == 0) {

					if($_SESSION['userID'] == $friendsInfo['userID2']) {

						$acceptRequest = mysqli_query($connection, "UPDATE `friends` SET `accepted`='1' WHERE `ID`='".$friendsInfo['ID']."'");
						addNotification($friendsInfo['userID1'], "Friends", userLink($friendsInfo['userID2'])." accepted your friend request");
						addMiniMsg("Friend request was succesfully accepted");

					} else {
						addErrorMsg("You can't accept your own friend request");
					}

				} else {

					addErrorMsg("You are already friends");
				}
			} else {
				addErrorMsg("Can't accept friend request, because it has expired or canceled");
			}
		}
		redirect("user.php?ID=".$_GET['ID']);
	} else {
		redirect("home.php");
	}
?>
