<?php

	require "scripts/connection.php";
	require "scripts/mainFuncs.php";
	userAccountIncludes();
	$settingsIncludes .= formEditorIncludes();

	$aMsg = "";
	$aTitle = "";
	$aContent = "";

	$row = loadUserData();
	if($row['role'] < 4) {
		header("location: home.php");
	} 

	if(array_key_exists('ID', $_GET)) {
		$isRealPost = mysqli_query($connection, "SELECT `title`, `content` FROM `news` WHERE `ID`='".$_GET['ID']."'");
		if(mysqli_num_rows($isRealPost)) {

			$newsRow = mysqli_fetch_array($isRealPost);

			$aTitle = $newsRow['title'];
			$aContent = $newsRow['content'];

		} else {

			header("location: news.php");
		}
	}

	if(array_key_exists('postButton', $_POST) && array_key_exists('ID', $_GET)) {

		if(strlen($_POST['title']) < 3) $aMsg .= "<p>Title is too short (At least 3 symbols)</p>";
		else if(strlen($_POST['title']) > 40) $aMsg .= "<p>Title is too big (Not more then 40 symbols)</p>";

		if(strlen($_POST['content']) < 10) $aMsg .= "<p>Content is too short (At least 10 symbols)</p>";
		else if(strlen($_POST['content']) > 600) $aMsg .= "<p>Content is too big (Not more then 600 symbols)</p>";

		if(strlen($aMsg) < 1) {
			addMiniMsg("Post succesfully edited");

			mysqli_query($connection, "UPDATE `news` SET `title`='".mysqli_real_escape_string($connection, $_POST['title'])."', `content`='".mysqli_real_escape_string($connection, $_POST['content'])."' WHERE `ID`='".$_GET['ID']."'");

			header("location: new.php?ID=".$_GET['ID']);
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
		<input type="text" name="title" value="<?php echo $aTitle; ?>" placeholder="title">
		<textarea name="content" id="summernote" placeholder="content"><?php echo $aContent; ?></textarea>
		<button name="postButton">Post</button>
	</form>

	<?php include("html/footer.php"); ?>
	<?php include("scripts/formEditor.js"); ?>

</body>

</html>