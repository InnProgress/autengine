<?php

	require "scripts/connection.php";
	require "scripts/mainFuncs.php";
	userAccountIncludes();

	$row = loadUserData();

	if(array_key_exists('ID', $_GET)) {

		$commentData = mysqli_query($connection, "SELECT * FROM `newscomments` WHERE `ID`='".mysqli_real_escape_string($connection, $_GET['ID'])."'");

		if(mysqli_num_rows($commentData)) {

			$commentRow = mysqli_fetch_array($commentData);
			if($row['role'] >= 4 || $commentRow['writerID'] == $_SESSION['userID'])
			{
				$deleteNew = mysqli_query($connection, "DELETE FROM `newscomments` WHERE `ID`='".mysqli_real_escape_string($connection, $_GET['ID'])."' LIMIT 1");
				if($deleteNew) {
					addMiniMsg("Comment with ID <b>".$_GET['ID']."</b> succesfully deleted.");
				}
			}
		}
	}

	redirect($row['lastPage']);
?>
