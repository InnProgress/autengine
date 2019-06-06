<?php

	require "scripts/connection.php";
	require "scripts/mainFuncs.php";

	if(isset($_GET['code'])) {

		$isRealCode = mysqli_query($connection, "SELECT * FROM `verifications` WHERE `confirmCode`='".mysqli_real_escape_string($connection, $_GET['code'])."'");
		if($isRealCode && mysqli_num_rows($isRealCode)) {

			$verificationData = mysqli_fetch_array($isRealCode);
			mysqli_query($connection, "UPDATE `users` SET `emailVerified`='1' WHERE `ID`='".mysqli_real_escape_string($connection, $verificationData['userID'])."'");
			mysqli_query($connection, "DELETE FROM `verifications` WHERE `confirmCode`='".mysqli_real_escape_string($connection, $_GET['code'])."' AND `userID`='".mysqli_real_escape_string($connection, $verificationData['userID'])."'");


			if(isset($_SESSION['userID'])) {
				addMiniMsg("Email succesfully verified");
				redirect("home.php");
			} else {
				echo "Email verified. <a href='index.php'>Go to login page</a>";
				addPlayerLog($verificationData['userID'], -1, "Email", "Email address has been verified");
			}
		} else echo "<a href='index.php'>Go back to game</a>";
	} else echo "<a href='index.php'>Go back to game</a>";
?>
