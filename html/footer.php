</div>


<footer class="footer bg-light">
	<p><a href="online.php">Online players: <?php echo User::onlineUsers(); ?></a> <br>
	Registered players: <?php echo registeredPlayers(); ?></p>
    <span class="text-muted">#AUTengine &copy; 2018</span>
</footer>

<?php
	if(!empty($_SESSION['userID'])) {
		$myurl = strlen($_SERVER['QUERY_STRING']) ? basename($_SERVER['PHP_SELF'])."?".$_SERVER['QUERY_STRING'] : basename($_SERVER['PHP_SELF']);

		mysqli_query($connection, "UPDATE `users` SET `lastPage` = '".mysqli_real_escape_string($connection, $myurl)."' WHERE `ID`='".mysqli_real_escape_string($connection, $_SESSION['userID'])."'");
	}

	/*print_r(array(
	  'memory' => (memory_get_usage() - $mem) / (1024 * 1024),
	  'seconds' => microtime(TRUE) - $time
	));*/
?>
