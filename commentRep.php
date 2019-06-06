<?php

	require "scripts/connection.php";
	require "scripts/mainFuncs.php";
	userAccountIncludes();

	$row = loadUserData();

	if(array_key_exists('ID', $_GET)) {

		$isRealPost = mysqli_query($connection, "SELECT * FROM `newscomments` WHERE `ID`='".mysqli_real_escape_string($connection, $_GET['ID'])."'");

		if(mysqli_num_rows($isRealPost)) {

			$postData = mysqli_fetch_array($isRealPost);

			if($postData['writerID'] == $_SESSION['userID']) {
				addErrorMsg("You can't give rep to yourself");
			} else {

				$isReal = mysqli_query($connection, "SELECT * FROM `reps` WHERE `postID`='".mysqli_real_escape_string($connection, $_GET['ID'])."' AND `giverID`='".mysqli_real_escape_string($connection, $_SESSION['userID'])."' AND `type`='1'");
				if(mysqli_num_rows($isReal)) {
					mysqli_query($connection, "DELETE FROM `reps` WHERE `postID`='".mysqli_real_escape_string($connection, $_GET['ID'])."' AND `giverID`='".mysqli_real_escape_string($connection, $_SESSION['userID'])."' AND `type`='1'");
				} else {

					mysqli_query($connection, "INSERT INTO `reps` (`giverID`, `receiverID`, `postID`, `type`) VALUES ('".mysqli_real_escape_string($connection, $_SESSION['userID'])."', '".mysqli_real_escape_string($connection, $postData['writerID'])."', ".mysqli_real_escape_string($connection, $_GET['ID']).", '1')");
				}
			}
		}
	}

	header("location: ".$row['lastPage']);
?>