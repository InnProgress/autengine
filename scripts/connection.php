<?php

	const hostName = "localhost";
	const hostUser = "id9399400_autdata_db	";
	const hostUserPassword = "dainostarm";
	const hostDatabase = "id9399400_autdata_db";

	$connection = new mysqli(hostName, hostUser, hostUserPassword, hostDatabase);

	if(!$connection) {
		die("Error connecting to mysql!");
	}

?>
