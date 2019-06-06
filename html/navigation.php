<?php


if(array_key_exists('userID', $_SESSION))
{

	$unreadMsgText = "";
	$unreadMessages = unreadMessages();
	if($unreadMessages > 0) {
		$unreadMsgText = "<span class='specialColor unreadMessages'>(".$unreadMessages.")</span>";
	}

	$unreadNotificationsText = "";
	$unreadNotifications = unreadNotifications();
	if($unreadNotifications > 0) {
		$unreadNotificationsText = "<span class='specialColor unreadNotifs'>(".$unreadNotifications.")</span";
	}

	echo '
		<ul id="navigation-list">
			<li> <a href="home.php"><i class="fas fa-home"></i> Home</a> </li>
			<li> <a href="search.php"><i class="fas fa-search"></i> Search</a> </li>
			<li> <a href="news.php"><i class="far fa-newspaper"></i> News</a> </li>
			<li> <a href="shouts.php"><i class="far fa-sticky-note"></i> Shouts</a> </li>
			<li> <a href="user.php?ID='.$_SESSION['userID'].'"><i class="far fa-user"></i> My profile</a> </li>
			<li> <a href="settings.php"><i class="fas fa-wrench"></i> Settings</a> </li>
			<li> <a href="messages.php?type=received"><i class="far fa-comments"></i> Messages '.$unreadMsgText.'</a> </li>
			<li> <a href="notifications.php"><i class="far fa-bell"></i> Notifications '.$unreadNotificationsText.'</a> </li>
			<li> <a class="specialColor" href="credits.php"><i class="far fa-credit-card"></i> Credits</a> </li>
			<li> <a href="home.php?logout=1"><i class="fas fa-sign-out-alt"></i> Log Out</a> </li>
		</ul>';

} else {
	echo '
		<ul id="navigation-list">
			<li> <a href="index.php"><i class="fas fa-sign-in-alt"></i> Login</a> </li>
			<li> <a href="register.php"><i class="fas fa-user-plus"></i> Register</a> </li>
		</ul>
	';
}
?>
