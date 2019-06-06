<?php

	require "scripts/connection.php";
	require "scripts/mainFuncs.php";
	userAccountIncludes();

	if(isset($_GET['ID'])) {

		$isRealPost = mysqli_query($connection, "SELECT * FROM `news` WHERE `ID`='".mysqli_real_escape_string($connection, $_GET['ID'])."'");

		if(mysqli_num_rows($isRealPost)) {

			$isReal = mysqli_query($connection, "SELECT * FROM `reps` WHERE `postID`='".mysqli_real_escape_string($connection, $_GET['ID'])."' AND `giverID`='".mysqli_real_escape_string($connection, $_SESSION['userID'])."' AND `type`='0'");
			if(mysqli_num_rows($isReal)) {
				mysqli_query($connection, "DELETE FROM `reps` WHERE `postID`='".mysqli_real_escape_string($connection, $_GET['ID'])."' AND `giverID`='".mysqli_real_escape_string($connection, $_SESSION['userID'])."' AND `type`='0'");
			} else {

				$postData = mysqli_fetch_array($isRealPost);

				mysqli_query($connection, "INSERT INTO `reps` (`giverID`, `receiverID`, `postID`, `type`) VALUES ('".mysqli_real_escape_string($connection, $_SESSION['userID'])."', '".mysqli_real_escape_string($connection, $postData['writerID'])."', ".mysqli_real_escape_string($connection, $_GET['ID']).", '0')");
			}
		}
	}

	redirect("new.php?ID=".$_GET['ID']);
?>
