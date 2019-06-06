<?php

	require "scripts/connection.php";
	require "scripts/mainFuncs.php";
	userAccountIncludes();

	$row = loadUserData();
	
	if(array_key_exists('ID', $_GET)) {

		$friendsInfo = loadFriendsInfo($_SESSION['userID'], $_GET['ID']);

		if(!empty($friendsInfo)) {

			$deleteFriend = mysqli_query($connection, "DELETE FROM `friends` WHERE `ID`='".mysqli_real_escape_string($connection, $friendsInfo['ID'])."' LIMIT 1");

			$otherUserID;
			if($_SESSION['userID'] != $friendsInfo['userID1']) $otherUserID = $friendsInfo['userID1'];
			else $otherUserID = $friendsInfo['userID2'];
				
			if($friendsInfo['accepted'] == 0) {
				
				if($_SESSION['userID'] == $friendsInfo['userID2']) {
					addNotification($otherUserID, "Friends", userLink($_SESSION['userID'])." declined your friend request");
					addMiniMsg("Friend request was succesfully declined");
				}
				else { 
					addNotification($otherUserID, "Friends", userLink($_SESSION['userID'])." canceled his friend request");
					addMiniMsg("Friend request was succesfully canceled");
				}
			}
			else { 
				addNotification($otherUserID, "Friends", userLink($_SESSION['userID'])." deleted you from his friendlist");
				addMiniMsg("User was succesfully deleted from you friendlist");
			}

		} else {
			addErrorMsg("This player is not in your friendlist or you can't decline this friend invitation");
		}

		header("location: user.php?ID=".$_GET['ID']);
	} else {
		header("location: home.php");
	}
?>