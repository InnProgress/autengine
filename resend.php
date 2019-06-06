<?php

	require "scripts/connection.php";
	require "scripts/mainFuncs.php";
	userAccountIncludes();

	$row = loadUserData();


	if($row['emailVerified'] == 0) {
		$infoQuery = mysqli_query($connection, "SELECT `confirmCode` FROM `verifications` WHERE `userID`='".mysqli_real_escape_string($connection, $_SESSION['userID'])."'");
		$infoRow = mysqli_fetch_array($infoQuery);

		$subject = "#AUTengine account verification";
		$txt = "Hello, thanks for registering to #AUTengine game.<br>Now you can verify your account by clicking here <a href='http://arnoldportfolio-com.stackstaging.com/autengine/verifyAccount.php?code=".$infoRow['confirmCode']."'>VERIFY ACCOUNT</a>";
		$headers = "From: arnoldautuch4@gmail.com" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		mail($row['email'],$subject,$txt,$headers);
	}
	else addErrorMsg("You email is already verified");

	header("location: home.php");
?>