<?php

	const hostName = "*******";
	const hostUser = "*******";
	const hostUserPassword = "*****";
	const hostDatabase = "******";

	$connection = new mysqli(hostName, hostUser, hostUserPassword, hostDatabase);

	if(!$connection) {
		die("Error connecting to mysql!");
	}

?>
