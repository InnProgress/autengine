<?php

	require "scripts/connection.php";
	require "scripts/mainFuncs.php";
	userAccountIncludes();

	$onlineUsersText = '
	<h1>Online users</h1>
	<p>Users online: '.User::onlineUsers().'</p>
	';

	$getOnlineUsersQuery = mysqli_query($connection, "SELECT * FROM `user_online`");
	while($onlineUserRow = mysqli_fetch_array($getOnlineUsersQuery))
	{

		$onlineUsersText .= '
		<section class="messageSection">
			'.userLink($onlineUserRow['userID']).'
		</section>';
	}

?>

<!DOCTYPE html>
<html>
<?php include("html/head.php"); ?>
<body>

	<?php include("html/header.php"); ?>

	<?php echo $onlineUsersText; ?>

	<?php include("html/footer.php"); ?>

</body>

</html>
