<?php

//$time = microtime(TRUE);
//$mem = memory_get_usage();

require_once("./src/config.php");

include("settings/timezone.php");
include("settings/maintenance.php");

//global $connection;

$connection -> query("DELETE FROM `user_online` WHERE `time`<'".(time() - 600)."'");
$connection -> query("DELETE FROM `bans` WHERE `time` - '".time()."' < 1 AND `time` != '-1'");
$connection -> query("DELETE FROM `mutes` WHERE `time` - '".time()."' < 1");

session_start();

$settingsIncludes = "";

function userAccountIncludes() {

	if(!User::isLoggedIn()) redirect("index.php");

	if(User::isBanned()) {
		User::logout();
	} else {
		User::updateAcitivity();
	}

	if(isset($_GET['logout'])) {
		if($_GET['logout'] == 1) {
			User::logout(true);
		}
	}
}

function userLink($id) {

	global $connection;

	$query = "SELECT `username`, `loginDate`, `role`, `vip` FROM `users` WHERE `ID`='".mysqli_real_escape_string($connection, $id)."'";
	$query = mysqli_query($connection, $query);
	$row = mysqli_fetch_array($query);

	$addClasses = "";
	$icon = '<i class="fas fa-user"></i>';

	if($row['vip'] > time()) $icon = '<i class="far fa-star"></i>';
	if($row['role'] == 2 || $row['role'] == 3) $icon = '<i class="fas fa-screwdriver"></i>';
	else if($row['role'] == 4) {
		$icon = '<i class="fas fa-crown"></i>';
	}

	if(time() - $row['loginDate'] > 864000) $addClasses = "class='muted-text'"; // jei neaktyvus 10 dienu

	if(!empty(User::loadSInfo($id, "bans"))) {
		$addClasses = "class='banned-text danger'";
		$icon = '<i class="fas fa-ban"></i>';
	}

	return "<a ".$addClasses." href='user.php?ID=".$id."'>".$icon." ".htmlspecialchars($row['username'])."</a>";
}

function unreadMessages() {
	global $connection;

	$uMsgs = mysqli_query($connection, "SELECT `ID` FROM `messages` WHERE `receiverID`='".$_SESSION['userID']."' AND `msgOwner`='".$_SESSION['userID']."' AND `msgRead`='0'");

	return mysqli_num_rows($uMsgs);
}

function unreadNotifications() {
	global $connection;

	$uMsgs = mysqli_query($connection, "SELECT `ID` FROM `notifications` WHERE `receiverID`='".$_SESSION['userID']."' AND `notificationRead`='0'");

	return mysqli_num_rows($uMsgs);
}

function addNotification($id, $title, $text) {
	global $connection;

	mysqli_query($connection, "INSERT INTO `notifications` (`receiverID`, `title`, `content`, `sentTime`) VALUES ('".$id."', '".mysqli_real_escape_string($connection, $title)."', '".mysqli_real_escape_string($connection, $text)."', '".time()."')");
}
function addMessage($id, $title, $text) {
	global $connection;

	mysqli_query($connection, "INSERT INTO `messages` (`receiverID`, `title`, `content`, `sentTime`, `msgOwner`) VALUES ('".$id."', '".mysqli_real_escape_string($connection, $title)."', '".mysqli_real_escape_string($connection, $text)."', '".time()."', '".$id."')");
}

function registeredPlayers() {
	global $connection;

	$rPlayers = mysqli_query($connection, "SELECT `ID` FROM `users`");
	return mysqli_num_rows($rPlayers);
}

function addPlayerLog($userID, $addID, $type, $content)
{
	global $connection;

	mysqli_query($connection, "INSERT INTO `userslogs` (`userID`, `additionalID`, `type`, `content`, `time`, `ip`) VALUES ('".$userID."', '".$addID."', '".mysqli_real_escape_string($connection, $type)."', '".mysqli_real_escape_string($connection, $content)."', '".time()."', '".getIP()."')");
}

function loadUserData() {

	global $connection;

	$loadDataQuery = mysqli_query($connection, "SELECT * FROM `users` WHERE `ID`='".$_SESSION['userID']."'");
	$row = mysqli_fetch_array($loadDataQuery);

	return $row;
}


function showMiniMsg() {
	global $connection;
	$miniMsgQuery = mysqli_query($connection, "SELECT `miniMsg` FROM `users` WHERE `ID`='".$_SESSION['userID']."'");
	$msgRow = mysqli_fetch_array($miniMsgQuery);
	if(!empty($msgRow[0])) {

		echo '
		<div class="alert alert-warning alert-dismissible fade show" role="alert">
			'.$msgRow[0].'
		</div>';
		mysqli_query($connection, "UPDATE `users` SET `miniMsg`='' WHERE `ID`='".$_SESSION['userID']."'");
	}
}
function showErrorMsg() {
	global $connection;

	$miniMsgQuery = mysqli_query($connection, "SELECT `errorMsg` FROM `users` WHERE `ID`='".$_SESSION['userID']."'");
	$msgRow = mysqli_fetch_array($miniMsgQuery);
	if(!empty($msgRow[0])) {
		echo '<div class="alert alert-danger" role="alert">'.$msgRow[0].'</div>';
		mysqli_query($connection, "UPDATE `users` SET `errorMsg`='' WHERE `ID`='".$_SESSION['userID']."'");
	}
}
function addMiniMsg($msgContent) {
	global $connection;

	mysqli_query($connection, "UPDATE `users` SET `miniMsg`='".mysqli_real_escape_string($connection, $msgContent)."' WHERE `ID`='".$_SESSION['userID']."'");
}
function addErrorMsg($msgContent) {
	global $connection;

	mysqli_query($connection, "UPDATE `users` SET `errorMsg`='".mysqli_real_escape_string($connection, $msgContent)."' WHERE `ID`='".$_SESSION['userID']."'");
}

function formEditorIncludes() {
	return '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>';
}

function showShout($shoutArray, $role) {

	$returnText = '
	<section class="messageSection">
		<p>'.$shoutArray['content'].'</p>
		<small>'.getTimeAgo($shoutArray['time']).' ago by '.userLink($shoutArray['writerID']).'</small>';

		if($role >= 4 || $_SESSION['userID'] == $shoutArray['writerID']) {
			$returnText .= '
			<br>
			<a href="shouts.php?deleteID='.$shoutArray['ID'].'">Delete</a>
			<a href="editShout.php?ID='.$shoutArray['ID'].'">Edit</a>';
		}

		$returnText .= '
	</section>';

	return $returnText;
}

function loadFriendsInfo($id1, $id2) {

	global $connection;

	$query = "SELECT * FROM `friends` WHERE (`userID1`='".mysqli_real_escape_string($connection, $id1)."' && `userID2`='".mysqli_real_escape_string($connection, $id2)."') || (`userID1`='".mysqli_real_escape_string($connection, $id2)."' && `userID2`='".mysqli_real_escape_string($connection, $id1)."')";
	$query = mysqli_query($connection, $query);
	$row = mysqli_fetch_array($query);

	return $row;
}




function getTimeAgo($time) {
	$writeTime = time() - $time;
	if($writeTime < 60) $writeTime = $writeTime." sek.";
	else if($writeTime < 3600) $writeTime = round($writeTime / 60)." min";
	else if($writeTime < 86400) $writeTime = round($writeTime / 60/ 60)." h";
	else if($writeTime < 86400 * 7) $writeTime = round($writeTime / 60 / 60 / 24)." days";
	else if($writeTime < 86400 * 365) $writeTime = round($writeTime / 60 / 60 / 24 / 7)." weeks";
	else $writeTime = round($writeTime / 60 / 60 / 24 / 365)." years";

	return $writeTime;
}

function redirect($page = null) {

	if(is_null($page)) $redirect = "Refresh:0";
	else $redirect = "Location: ".$page;
  header($redirect);
  die();
}


function esc_v($var) {
	global $connection;
	return mysqli_real_escape_string($connection, $var);
}

function getIP() {
	$ip = false;

	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    	$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
	    $ip = $_SERVER['REMOTE_ADDR'];
	}

	return $ip;
}
?>
