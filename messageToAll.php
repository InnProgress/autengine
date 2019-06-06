<?php

	require "scripts/connection.php";
	require "scripts/mainFuncs.php";
	userAccountIncludes();
	$settingsIncludes .= formEditorIncludes();

	$aMsg = "";
	$msgTitle = "";
	$msgContent = "";

	$row = loadUserData();
	if($row['role'] < 4) {
		header("home.php");
	}
	else {

		if(array_key_exists('sendButton', $_POST)) {

			$msgTitle = $_POST['title'];
			$msgContent = $_POST['content'];

			if(strlen($msgTitle) < 3 || strlen($msgTitle) > 30) $aMsg .= "<p>Message title should be 3-30 symbols length</p>"; 
			if(strlen($msgContent) < 3 || strlen($msgContent) > 500) $aMsg .= "<p>Message content should be 3-500 symbols length</p>";

			if(strlen($aMsg) < 1) {


				$playerIDQuery = mysqli_query($connection, "SELECT `ID` FROM `users`");
				while($pRow = mysqli_fetch_array($playerIDQuery)) {

					$sendQuery = mysqli_query($connection, "INSERT INTO `messages` (`senderID`, `receiverID`, `title`, `content`, `sentTime`, `msgOwner`) VALUES ('0', '".mysqli_real_escape_string($connection, $pRow[0])."', '".mysqli_real_escape_string($connection, $msgTitle)."', '".mysqli_real_escape_string($connection, $msgContent)."', '".time()."', '".mysqli_real_escape_string($connection, $pRow[0])."')");

				}
				addMiniMsg("Message succesfully sent");
				header("location: home.php");
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<?php include("html/head.php"); ?>
<body>

	<?php include("html/header.php"); ?>

	<div><?php echo $aMsg; ?></div>

	<form method="POST">

		<input type="text" value="<?php echo $msgTitle; ?>" name="title" placeholder="Title">
		<textarea name="content" id="summernote" placeholder="Content"><?php echo $msgContent; ?></textarea>
		
		<button name="sendButton">Send to all</button>

	</form>

	<?php include("html/footer.php"); ?>
	<?php include("scripts/formEditor.js"); ?>

</body>

</html>