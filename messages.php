<?php

	require "scripts/connection.php";
	require "scripts/mainFuncs.php";
	userAccountIncludes();


	$page = 1;
	if(array_key_exists('page', $_GET)) {
		$page = $_GET['page'];
	}
	$sPage = $page;
	if($sPage <= 1) $sPage = 0;
	else {
		$sPage --;
		$sPage *= 10;
	}
	$sPageMax = $sPage + 10;

	$allMessages = 0;


	if(array_key_exists("read", $_GET)) {
		if($_GET['read'] == "all") {
			mysqli_query($connection, "UPDATE `messages` SET `msgRead`='1' WHERE `msgOwner`='".$_SESSION['userID']."'");
		}
		redirect("messages.php");
	}


	if(array_key_exists('act', $_GET) && $_GET['act'] == 'delete') {
		if(array_key_exists('ID', $_GET)) {

			if($_GET['ID'] == "all") {

				mysqli_query($connection, "DELETE FROM `messages` WHERE `msgOwner`='".mysqli_real_escape_string($connection, $_SESSION['userID'])."'");
				addMiniMsg("All messages deleted");

			} else {

				$deleteMsg = mysqli_query($connection, "DELETE FROM `messages` WHERE `ID`='".mysqli_real_escape_string($connection, $_GET['ID'])."' AND `msgOwner`='".mysqli_real_escape_string($connection, $_SESSION['userID'])."'  LIMIT 1");
				if($deleteMsg) {
					addMiniMsg("Message with ID <b>".$_GET['ID']."</b> succesfully deleted.");
				}

			}
		}
		if(array_key_exists('playerID', $_GET)) {

			$row = loadUserData();
			if($row['role'] < 4) {
				redirect("home.php");
			} else {

				$deleteMsg = mysqli_query($connection, "DELETE FROM `messages` WHERE `senderID`='".mysqli_real_escape_string($connection, $_GET['playerID'])."'");
				if($deleteMsg) addMiniMsg("Messages succesfully deleted");
				else addErrorMsg("There was an error while deleting messages");

				redirect("user.php?ID=".$_GET['playerID']);
			}
		}
		else {
			if(!array_key_exists('type', $_GET)) $_GET['type'] = "received";
			redirect("messages.php?type=".$_GET['type']);
		}
	}

	$messagesText = "";

	if(!array_key_exists('type', $_GET)) {
		$_GET['type'] = "received";
	}

	if(array_key_exists('type', $_GET)) {

		if($_GET['type'] == "received") {

			$messagesText .= '
			<a href="newMessage.php">New message</a> <br>
			<a href="messages.php?type=sent">Sent messages</a><br>
			<a href="messages.php?act=delete&ID=all&type='.$_GET['type'].'">Delete all received messages</a> <br>
			<a href="messages.php?read=all">Mark all as read</a> <br><br>
			';

			$allMessages = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM `messages` WHERE `receiverID`='".$_SESSION['userID']."' AND `msgOwner`='".$_SESSION['userID']."'"));


			$messagesText .= '<p>All received messages: '.$allMessages.'</p>';

			$messagesText .= '<h1>Received messages</h1>';

			$query = "SELECT * FROM `messages` WHERE `receiverID`='".$_SESSION['userID']."' AND `msgOwner`='".$_SESSION['userID']."' ORDER BY `ID` DESC LIMIT ".$sPage.", ".$sPageMax;
			$getMessages = mysqli_query($connection, $query);

			if(mysqli_num_rows($getMessages) < 1 && $page != 1) {
				header("location: messages.php?type=received");
			}

			if(mysqli_num_rows($getMessages) < 1) {
				$messagesText .= "<p>You don't have any messages</p>";
			} else {

				while($row = mysqli_fetch_array($getMessages))
				{
					$new = "";
					if($row['msgRead'] == 0) {
	 					$new = "newSmth";
	 					mysqli_query($connection, "UPDATE `messages` SET `msgRead`='1' WHERE `ID`='".$row['ID']."' AND `msgOwner`='".$_SESSION['userID']."'");
	 				}

					$messagesText .= '
					<section class="messageSection '.$new.'">

						<em>From: '.userLink($row['senderID']).'</em>

						<h3>'.htmlspecialchars($row['title']).'</h3>
						<p>'.($row['content']).'</p>
						<small>'.date("Y-m-d H:i:s", $row['sentTime']).'</small>

						<p>
							<a href="replyMsg.php?ID='.$row['ID'].'">Reply</a>
							<a href="messages.php?act=delete&ID='.$row['ID'].'&type=received">Delete</a>
						</p>

					</section>
					';

				}
			}

		} else if($_GET['type'] == "sent") {

			$messagesText .= '
			<a href="newMessage.php">New message</a> <br>
			<a href="messages.php?type=received">Received messages</a> <br>
			<a href="messages.php?act=delete&ID=all&type='.$_GET['type'].'">Delete all sent messages</a> <br><br>
			';

			$allMessages = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM `messages` WHERE `senderID`='".$_SESSION['userID']."' AND `msgOwner`='".$_SESSION['userID']."'"));

			$messagesText .= '<p>All sent messages: '.$allMessages.'</p>';

			$messagesText .= '<h1>Sent messages</h1>';

			$query = "SELECT * FROM `messages` WHERE `senderID`='".$_SESSION['userID']."' AND `msgOwner`='".$_SESSION['userID']."' ORDER BY `ID` DESC LIMIT ".$sPage.", ".$sPageMax;

			$getMessages = mysqli_query($connection, $query);

			if(mysqli_num_rows($getMessages) < 1 && $page != 1) {
				header("location: messages.php?type=sent");
			}

			if(mysqli_num_rows($getMessages) < 1) {
				$messagesText .= "<p>You don't have any messages</p>";
			} else {
				while($row = mysqli_fetch_array($getMessages))
				{

					$messagesText .= '
					<section class="messageSection">

						<em>To: '.userLink($row['receiverID']).'</em>

						<h3>'.htmlspecialchars($row['title']).'</h3>
						<p>'.($row['content']).'</p>
						<small>'.date("Y-m-d H:i:s", $row['sentTime']).'</small>

						<p>
							<a href="replyMsg.php?ID='.$row['ID'].'">Reply</a>
							<a href="messages.php?act=delete&ID='.$row['ID'].'&type=sent">Delete</a>
						</p>

					</section>
					';
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

	<?php


		echo $messagesText;


		if($page > 1) echo ' <a href="messages.php?type='.$_GET['type'].'&page='.($page-1).'">'.($page-1).'</a> ';
		echo $page;
		if($sPageMax < $allMessages) echo ' <a href="messages.php?type='.$_GET['type'].'&page='.($page+1).'">'.($page+1).'</a> ';
	?>

	<?php include("html/footer.php"); ?>

</body>

</html>
