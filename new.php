<?php

	require "scripts/connection.php";
	require "scripts/mainFuncs.php";
	userAccountIncludes();
	$settingsIncludes .= formEditorIncludes();

	$newText = "";
	$moderating = "";


	$row = loadUserData();

	if(array_key_exists('deleteID', $_GET)) {

		if($row['role'] >= 4) {

			if(array_key_exists('ID', $_GET)) {

				if($_GET['ID'] == "all") {

					$deleteMsg = mysqli_query($connection, "DELETE FROM `news`");
					addMiniMsg("All messages deleted");

				} else {

					$deleteNew = mysqli_query($connection, "DELETE FROM `news` WHERE `ID`='".mysqli_real_escape_string($connection, $_GET['ID'])."' LIMIT 1");
					mysqli_query($connection, "DELETE FROM `reps` WHERE `postID`='".mysqli_real_escape_string($connection, $_GET['ID'])."'");
					if($deleteNew) {
						addMiniMsg("Post with ID <b>".$_GET['ID']."</b> succesfully deleted.");
					}
				}
			}
		}

		redirect("news.php");

	}



	if(array_key_exists('ID', $_GET)) {

		if(array_key_exists('comment', $_POST)) {

			if(!empty(loadMuteInfo($_SESSION['userID']))) {

				addErrorMsg("You can not write comments while you are muted");
			}
			else {
				if(strlen($_POST['comment']) < 3) addErrorMsg("Comment should contain at least 3 symbols");
				else if(strlen($_POST['comment']) > 700) addErrorMsg("Comment can't contain more then 700 symbols");
				else if($row['lastComment'] - time() > 1) addErrorMsg("You can't comment that often");
				else {

					$playerUpdate = mysqli_query($connection, "UPDATE `users` SET `lastComment`='".(time() + 240)."' WHERE `ID`='".$_SESSION['userID']."'");
					if($playerUpdate) {

						mysqli_query($connection, "INSERT INTO `newscomments` (`postID`, `writerID`, `content`, `time`) VALUES ('".mysqli_real_escape_string($connection, $_GET['ID'])."', '".mysqli_real_escape_string($connection, $_SESSION['userID'])."', '".mysqli_real_escape_string($connection, $_POST['comment'])."', '".time()."')");
						addMiniMsg("Comment succesfully posted");
					}

				}
			}
			header("location: new.php?ID=".$_GET['ID']);
		}


		if($row['role'] >= 4) {
			$moderating = '
			<p>
				<a href="new.php?deleteID='.$_GET['ID'].'">Delete</a>
				<a href="editNew.php?ID='.$_GET['ID'].'">Edit</a>
			</p>
			';
		}

		$newsQuery = mysqli_query($connection, "SELECT * FROM `news` WHERE `ID` = '".$_GET['ID']."'");
		if(mysqli_num_rows($newsQuery)) {

			$newRow = mysqli_fetch_array($newsQuery);
			$timeAgo = getTimeAgo($newRow['writeTime']);

			$countReps = mysqli_query($connection, "SELECT COUNT(*) FROM `reps` WHERE `postID`='".$_GET['ID']."' AND `type`='0'");
			$countReps = mysqli_fetch_array($countReps);


			$isMyRep = mysqli_query($connection, "SELECT * FROM `reps` WHERE `postID`='".$_GET['ID']."' AND `giverID`='".$_SESSION['userID']."' AND `type`='0'");
			$giveRepText = "<a href='rep.php?ID=".$_GET['ID']."'><i class='far fa-heart'></i> +REP</a>";
			if(mysqli_num_rows($isMyRep)) $giveRepText = "<a href='rep.php?ID=".$_GET['ID']."'><i class='fas fa-heart'></i> -REP</a>";

			$newText = '
			<section class="messageSection">
				<h2>'.htmlspecialchars($newRow['title']).'</h2>
				<small>Rep: '.$countReps[0].'</small> '.$giveRepText.' <br>
				<small>Writer: '.userLink($newRow['writerID']).'</small> <br>
				<small>'.$timeAgo.' ago ('.date("Y-m-d H:i:s", $newRow['writeTime']).')</small>
				<p>'.$newRow['content'].'</p>

				<br>'.$moderating.'
			</section>
			';

			// COMMENTS ///////////////////////////////////////////////////////////////
			$commentsQuery = mysqli_query($connection, "SELECT * FROM `newscomments` WHERE `postID`='".$_GET['ID']."' GROUP BY `ID` DESC");

			$newText .= '<h2>Comments ('.mysqli_num_rows($commentsQuery).')</h2>';
			if(mysqli_num_rows($commentsQuery)) {

				while($commentRow = mysqli_fetch_array($commentsQuery)) {

					$moderateText = "";
					if($row['role'] >= 4 || $_SESSION['userID'] == $commentRow['writerID']) {
						$moderateText = '
						<p>
							<a href="deleteComment.php?ID='.$commentRow['ID'].'">Delete</a> |
							<a href="editComment.php?ID='.$commentRow['ID'].'">Edit</a>
						</p>';
					}

					$countCReps = mysqli_query($connection, "SELECT * FROM `reps` WHERE `postID`='".$commentRow['ID']."' AND `type`='1'");
					$countCReps = mysqli_num_rows($countCReps);

					$isMyCRep = mysqli_query($connection, "SELECT * FROM `reps` WHERE `postID`='".$commentRow['ID']."' AND `giverID`='".$_SESSION['userID']."' AND `type`='1'");
					$giveCRepText = "<a href='commentRep.php?ID=".$commentRow['ID']."'><i class='far fa-heart'></i> +REP</a>";
					if(mysqli_num_rows($isMyCRep)) $giveCRepText = "<a href='commentRep.php?ID=".$commentRow['ID']."'><i class='fas fa-heart'></i> -REP</a>";

					$newText .= '
					<section class="messageSection">
						<small>By </small>'.userLink($commentRow['writerID']).' <br>
						<small>'.getTimeAgo($commentRow['time']).' ago</small> <br>
						<small>Rep: '.$countCReps.' '.$giveCRepText.'</small>
						<p>'.$commentRow['content'].'</p>
						'.$moderateText.'
					</section>';

				}
			} else {
				$newText .= '<p>There is no comments</p>';
			}

			$newText .= '
			Your comment: <br>
			<form method="POST">
				<textarea name="comment" id="summernote"></textarea>
				<button>Write</button>
			</form>';

		} else {
			header("location: home.php");
		}

	} else {
		header("location: home.php");
	}
?>

<!DOCTYPE html>
<html>
<?php include("html/head.php"); ?>
<body>

	<?php include("html/header.php"); ?>

	<?php echo "<a href='news.php'>All news</a>".$newText; ?>

	<?php include("html/footer.php"); ?>
	<?php include("scripts/formEditor.js"); ?>
</body>

</html>
