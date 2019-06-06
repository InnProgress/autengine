<?php

	require "scripts/connection.php";
	require "scripts/mainFuncs.php";
	userAccountIncludes();
	$settingsIncludes .= formEditorIncludes();

	$aMsg = "";
	$msgUsername = "";
	$msgTitle = "";
	$msgContent = "";

	if(!array_key_exists('ID', $_GET)) {
		redirect("messages.php");
	} else {
		$isValidMsg = mysqli_query($connection, "SELECT * FROM `messages` WHERE `ID`='".mysqli_real_escape_string($connection, $_GET['ID'])."' AND `msgOwner`='".$_SESSION['userID']."' LIMIT 1");
		if(mysqli_num_rows($isValidMsg)) {

			$row = mysqli_fetch_array($isValidMsg);

			$replyUserID = $row['receiverID'];
			if($row['senderID'] != $_SESSION['userID']) $replyUserID = $row['senderID'];

			$userNameQuery = mysqli_query($connection, "SELECT `username` FROM `users` WHERE `ID`='".$replyUserID."'");
			$userNameQuery = mysqli_fetch_array($userNameQuery);

			$msgUsername = $userNameQuery[0];
			$msgTitle = $row['title'];

		} else {
			redirect("messages.php");
		}
	}

?>

<!DOCTYPE html>
<html>
<?php include("html/head.php"); ?>
<body>

	<?php include("html/header.php"); ?>

	<div><?php echo $aMsg; ?></div>

	<form method="POST" action="newMessage.php">

		<input type="text" value="<?php echo $msgUsername; ?>" name="username" placeholder="Username">
		<input type="text" value="<?php echo $msgTitle; ?>" name="title" placeholder="Title">
		<textarea name="content" id="summernote" placeholder="Content"><?php echo $msgContent; ?></textarea>

		<button name="sendButton">Send</button>

	</form>

	<?php include("html/footer.php"); ?>
	<?php include("scripts/formEditor.js"); ?>

</body>

</html>
