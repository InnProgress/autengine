<?php

	require "scripts/connection.php";
	require "scripts/mainFuncs.php";
	userAccountIncludes();
	$settingsIncludes .= formEditorIncludes();

	$aMsg = "";

	if(array_key_exists('postButton', $_POST)) {

		if(strlen($_POST['title']) < 3) $aMsg .= "<p>Title is too short (At least 3 symbols)</p>";
		else if(strlen($_POST['title']) > 40) $aMsg .= "<p>Title is too big (Not more then 40 symbols)</p>";

		if(strlen($_POST['content']) < 10) $aMsg .= "<p>Content is too short (At least 10 symbols)</p>";
		else if(strlen($_POST['content']) > 600) $aMsg .= "<p>Content is too big (Not more then 600 symbols)</p>";

		if(strlen($aMsg) < 1) {
			addMiniMsg("Post succesfully written");

			mysqli_query($connection, "INSERT INTO `news` (`writerID`, `title`, `content`, `writeTime`) VALUES ('".$_SESSION['userID']."', '".mysqli_real_escape_string($connection, $_POST['title'])."', '".mysqli_real_escape_string($connection, $_POST['content'])."', '".time()."')");

			redirect("news.php");
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
		<input type="text" name="title" placeholder="title">
		<textarea name="content" id="summernote" placeholder="content"></textarea>
		<button name="postButton">Post</button>
	</form>

	<?php include("html/footer.php"); ?>

	<?php include("scripts/formEditor.js"); ?>


</body>

</html>
