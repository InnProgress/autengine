<?php

	require "scripts/connection.php";
	require "scripts/mainFuncs.php";
	userAccountIncludes();

	$profileText = "";

	if(array_key_exists('ID', $_GET)) {

		$isRealUser = mysqli_query($connection, "SELECT * FROM `users` WHERE `ID`='".mysqli_real_escape_string($connection, $_GET['ID'])."'");
		if(mysqli_num_rows($isRealUser)) {

			$userProfile = mysqli_fetch_array($isRealUser);

			$row = loadUserData();
			$banInfo = User::loadSInfo($_GET['ID'], "bans");
			$muteInfo = User::loadSInfo($_GET['ID'], "mutes");


			///////////////// ADMIN TEXT /////////////////////////////////////
			if($row['role'] >= 4) {

				$banUnbanLink = '<a href="ban.php?ID='.$_GET['ID'].'">Ban</a>';
				if(!empty($banInfo)) {
					$banUnbanLink = '<a href="unban.php?ID='.$_GET['ID'].'">Unban</a>';
				}
				$muteLink = '<a href="mute.php?ID='.$_GET['ID'].'">Mute</a>';
				if(!empty($muteInfo)) {
					$muteLink = '<a href="unmute.php?ID='.$_GET['ID'].'">Unmute</a>';
				}

				$eVerificationText = "Not verified";
				if($userProfile['emailVerified'] == 1) $eVerificationText = "Verified";

				$profileText .= '
				<p>
					Email: '.$userProfile['email'].' ('.$eVerificationText.')<br>
					Registration IP: '.$userProfile['registrationIP'].' <br>
					Last IP: '.$userProfile['lastIP'].' <br>

			 		<a href="logs.php?ID='.$_GET['ID'].'">User logs</a> <br>
			 		'.$banUnbanLink.' |
			 		'.$muteLink.' |
			 		<a href="deleteMsg.php?playerID='.$_GET['ID'].'">Delete all sent messages</a>
				</p>
				';
			}
			//////////////////////////////////////////////////////////////////////


			if($userProfile['ID'] != $_SESSION['userID']) {

				$profileText .= '
				<a href="newMessage.php?ID='.$_GET['ID'].'">Send message</a> <br>';

				$friendsInfo = loadFriendsInfo($_SESSION['userID'], $userProfile['ID']);

				if(!empty($friendsInfo)) {

					if($friendsInfo['accepted'] == 1) { // JEIGU ZAIDEJAS YRA DRAUGUOSE
						$profileText .= '<a href="deleteFromFriends.php?ID='.$userProfile['ID'].'">Delete from friends</a>';
					} else {
						if($friendsInfo['userID1'] == $_SESSION['userID']) $profileText .= '<a href="deleteFromFriends.php?ID='.$userProfile['ID'].'">Cancel/decline friend request</a>';
						else $profileText .= '<a href="acceptFriend.php?ID='.$userProfile['ID'].'">Accept friend request</a> OR <a href="deleteFromFriends.php?ID='.$userProfile['ID'].'">Decline friend request</a>';
					}

				} else { // JEIGU NERA DRAUGUOSE
					$profileText .= '<a href="inviteFriend.php?ID='.$userProfile['ID'].'">Invite friend</a>';
				}
			}

			$isOnlineText = "<span class='danger'>Offline</span>";

			$isOnlineQuery = mysqli_query($connection, "SELECT * FROM `user_online` WHERE `userID`='".$userProfile['ID']."'");
			$isOnlineQuery = mysqli_num_rows($isOnlineQuery);
			if($isOnlineQuery == "1") $isOnlineText = "<span class='success'>Online</span>";
			if(!empty($banInfo)) $isOnlineText = "<span class='danger'>Banned</span>";


			if($userProfile['role'] == 2) $profileText .= '<h2><span class="badge badge-secondary">Moderator</span></h2>';
			else if($userProfile['role'] == 3) $profileText .= '<h2><span class="badge badge-secondary">Super Moderator</span></h2>';
			else if($userProfile['role'] == 4) $profileText .= '<h2><span class="badge badge-secondary">Administrator</span></h2>';
			else if($userProfile['vip'] > time()) $profileText .= '<h2><span class="badge badge-secondary">VIP</span></h2>';

			$profileText .= '
			<h2>'.userLink($userProfile['ID']).' <small>('.$isOnlineText.')</small></h2>';

			$allReps = mysqli_query($connection, "SELECT `ID` FROM `reps` WHERE `receiverID`='".$userProfile['ID']."'");
			$profileText .= '<h4><i class="fas fa-heart"></i> Reputation: '.mysqli_num_rows($allReps).'</h4>';


			if(time() - $userProfile['loginDate'] > 864000) {
				$profileText .= '<big>Inactive for '.round((time() - $userProfile['loginDate']) / 60 / 60 / 24).' days</big>';
			}

			if(!empty($banInfo)) {

				$banTimeText = "Permament ban";
				if($banInfo['time'] != -1) {
					$banTimeText = 'Banned till '.date("Y-m-d H:i:s", $banInfo['time']);
				}

				$profileText .= '
				<p>User is banned by '.userLink($banInfo['adminID']).'<br>
				Reason: '.$banInfo['reason'].'<br>'.
				$banTimeText.'</p>';
			}
			if(!empty($muteInfo)) {

				$muteTimeText = 'Muted till '.date("Y-m-d H:i:s", $muteInfo['time']);

				$profileText .= '
				<p>User is muted by '.userLink($muteInfo['adminID']).'<br>
				Reason: '.$muteInfo['reason'].'<br>'.
				$muteTimeText.'</p>';
			}

			if($userProfile['loginDate'] == 0) $userProfile['loginDate'] = "Not logged in yet";
			else $userProfile['loginDate'] = date("Y-m-d H:i:s", $userProfile['loginDate']);

			$profileText .= '
			<p>
			Registration date: '.date("Y-m-d H:i:s", $userProfile['registerDate']).'<br>
			Last login date: '.$userProfile['loginDate'].'
			</p>
			';

			// SHOUTS //////////////////////////////////////////////////////////////////////////////////////////////////////
			$profileText .= '<h2>Last player shouts</h2>';

			$newShouts = mysqli_query($connection, "SELECT * FROM `shouts` WHERE `writerID`='".$userProfile['ID']."' ORDER BY `ID` DESC LIMIT 5");
			if(mysqli_num_rows($newShouts)) {
				while($shoutRow = mysqli_fetch_array($newShouts)) {
					$profileText .= showShout($shoutRow, $row['role']);
				}
			} else {
				$profileText .= '<p>There is no shouts</p>';
			}
			$profileText .= '<p><a href="shouts.php?userID='.$userProfile['ID'].'">All this player shouts</a></p>';
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////



			// FRIENDS //////////////////////////////////////////////////////////////////////////////////////////////////////////
			$allFriendsQuery = mysqli_query($connection, "SELECT * FROM `friends` WHERE (`userID1`='".$userProfile['ID']."' OR `userID2`='".$userProfile['ID']."') AND `accepted`='1'");
			$allFriends = mysqli_num_rows($allFriendsQuery);

			$profileText .= '<h2>Friends ('.$allFriends.')</h2>';
			$newFriends = mysqli_query($connection, "SELECT * FROM `friends` WHERE (`userID1`='".$userProfile['ID']."' OR `userID2`='".$userProfile['ID']."') AND `accepted`='1' ORDER BY `ID` DESC");
			if(mysqli_num_rows($newFriends)) {
				while($friendsRow = mysqli_fetch_array($newFriends)) {

					$friendID;

					if($friendsRow['userID1'] != $userProfile['ID'])  $friendID = $friendsRow['userID1'];
					else $friendID = $friendsRow['userID2'];

					$profileText .= ' '.userLink($friendID).' ';
				}
			} else {
				$profileText .= '<p>Player does not have any friends</p>';
			}
			//$profileText .= '<p><a href="friends.php?userID='.$userProfile['ID'].'">All this player friends</a></p>';
			///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


		} else {
			header("location: user.php?ID=".$_SESSION['userID']);
		}

	} else {
		header("location: user.php?ID=".$_SESSION['userID']);
	}
?>

<!DOCTYPE html>
<html>
<?php include("html/head.php"); ?>
<body>

	<?php include("html/header.php"); ?>

	<?php echo $profileText; ?>

	<?php include("html/footer.php"); ?>

</body>
</html>
