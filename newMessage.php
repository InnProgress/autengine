<?php

	require "scripts/connection.php";
	require "scripts/mainFuncs.php";
	userAccountIncludes();
	$settingsIncludes .= formEditorIncludes();

	$aMsg = "";
	$msgUsername = "";
	$msgTitle = "";
	$msgContent = "";


	if(array_key_exists('ID', $_GET)) {

		$playerIDQuery = mysqli_query($connection, "SELECT `username` FROM `users` WHERE `ID`='".mysqli_real_escape_string($connection, $_GET['ID'])."'");

		if(mysqli_num_rows($playerIDQuery) != 0) {
			$playerID = mysqli_fetch_array($playerIDQuery);
			$msgUsername = $playerID[0];
		} else {
			header("location: newMessage.php");
		}
	}


	if(array_key_exists('sendButton', $_POST)) {
		$msgUsername = $_POST['username'];
		$msgTitle = $_POST['title'];
		$msgContent = $_POST['content'];

		$query = "SELECT * FROM `users` WHERE `username`='".mysqli_real_escape_string($connection, $msgUsername)."'";
		$userQuery = mysqli_query($connection, $query);
		if(mysqli_num_rows($userQuery) == 0) {
			$aMsg = "<p>There is no such user</p>";
		} else {
			if(strlen($msgTitle) < 3 || strlen($msgTitle) > 30) $aMsg .= "<p>Message title should be 3-30 symbols length</p>"; 
			if(strlen($msgContent) < 3 || strlen($msgContent) > 500) $aMsg .= "<p>Message content should be 3-500 symbols length</p>";

			if(strlen($aMsg) < 1) {
				$receiver = mysqli_fetch_array($userQuery);

				

				if($receiver[0] == $_SESSION['userID']) {
					$aMsg .= "<p>You can't send message to yourself</p>";
				} else {

					$msgSendError = false;
					
					$sendQuery = mysqli_query($connection, "INSERT INTO `messages` (`senderID`, `receiverID`, `title`, `content`, `sentTime`, `msgOwner`) VALUES ('".$_SESSION['userID']."', '".mysqli_real_escape_string($connection, $receiver[0])."', '".mysqli_real_escape_string($connection, $msgTitle)."', '".mysqli_real_escape_string($connection, $msgContent)."', '".time()."', '".mysqli_real_escape_string($connection, $_SESSION['userID'])."')");
					if(!$sendQuery) $msgSendError = true;

					$sendQuery = mysqli_query($connection, "INSERT INTO `messages` (`senderID`, `receiverID`, `title`, `content`, `sentTime`, `msgOwner`) VALUES ('".$_SESSION['userID']."', '".mysqli_real_escape_string($connection, $receiver[0])."', '".mysqli_real_escape_string($connection, $msgTitle)."', '".mysqli_real_escape_string($connection, $msgContent)."', '".time()."', '".mysqli_real_escape_string($connection, $receiver[0])."')");
					if(!$sendQuery) $msgSendError = true;

					if($msgSendError) {
						$aMsg .= "<p>There was an error while sending a message, please try again later</p>";
					} else {
						addMiniMsg("Message succesfully sent");
						header("location: messages.php?type=sent");
					}
				}
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

		<input type="text" value="<?php echo $msgUsername; ?>" name="username" placeholder="Username">
		<input type="text" value="<?php echo $msgTitle; ?>" name="title" placeholder="Title">
		<textarea name="content" id="summernote" placeholder="Content"><?php echo $msgContent; ?></textarea>
		
		<button name="sendButton">Send</button>

	</form>

	<?php include("html/footer.php"); ?>
	<?php include("scripts/formEditor.js"); ?>

</body>

</html>