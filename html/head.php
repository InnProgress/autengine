<?php

include("settings/settings.php");

echo 
'
<head>
	<title>'.$title.'</title>
	<meta charset="UTF-8">
	<meta name="keywords" content="'.$keywords.'">
	<meta name="description" content="'.$description.'">
	<meta name="author" content="'.$author.'">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" type="text/css" href="styles/default.css">
	'.$settingsIncludes.'
</head>
';
?>