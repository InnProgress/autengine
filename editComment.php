<?php

	require "scripts/connection.php";
	require "scripts/mainFuncs.php";
	userAccountIncludes();
	$settingsIncludes .= formEditorIncludes();

	$row = loadUserData();


	$aMsg = "";
	$aContent = "";
	$writer;
	$postID;

	if(array_key_exists('ID', $_GET)) {
		$isRealComment = mysqli_query($connection, "SELECT `writerID`, `content`, `postID` FROM `newscomments` WHERE `ID`='".mysqli_real_escape_string($connection, $_GET['ID'])."'");
		if(mysqli_num_rows($isRealComment)) {

			$commentRow = mysqli_fetch_array($isRealComment);

			if($row['role'] >= 4 || $_SESSION['userID'] == $commentRow['writerID']) {

				$aContent = $commentRow['content'];
				$writer = $commentRow['writerID'];
				$postID = $commentRow['postID'];
			} else {

				header("location: home.php");
			}

		} else {
			header("location: home.php");
		}
	}

	if(array_key_exists('commentContent', $_POST) && array_key_exists('ID', $_GET) && $writer >= 0) {

		if(strlen($_POST['commentContent']) < 3) $aMsg .= "<p>Comment most contain at least 3 symbols</p>";
		else if(strlen($_POST['commentContent']) > 700) $aMsg .= "<p>Comment most not contain more than 700 symbols</p>";
		else {
			addMiniMsg("Comment succesfully edited");

			mysqli_query($connection, "UPDATE `newscomments` SET `content`='".mysqli_real_escape_string($connection, $_POST['commentContent'])."' WHERE `ID`='".mysqli_real_escape_string($connection, $_GET['ID'])."'");

			if($writer != $_SESSION['userID']) { 
				addNotification($writer, "Comment", "You comment was edited by ".userLink($_SESSION['userID']));
			}

			addPlayerLog($_SESSION['userID'], $writer, "Moderating", userLink($_SESSION['userID'])." edited ".userLink($writer)." comment");

			header("location: new.php?ID=".$postID);
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
		<textarea id="summernote" name="commentContent"><?php echo $aContent; ?></textarea>
		<button>Edit</button>
	</form>

	<?php include("html/footer.php"); ?>
	<?php include("scripts/formEditor.js"); ?>

</body>

</html>