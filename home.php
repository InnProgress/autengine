<?php

	require "scripts/connection.php";
	require "scripts/mainFuncs.php";
	userAccountIncludes();
	$settingsIncludes .= formEditorIncludes();

	$row = loadUserData();

	//addMiniMsg("Just tinking");
	addNotification($_SESSION['userID'], "3", "3333333333333333");
	//addMessage($_SESSION['userID'], "Sveikas atvykes i zaidima", "Sveikas, tai ka tik atsidares naujas zaidimas, kuriame vis dar gali pasiekti viska, svarbiausia jau dabar pradeti zaisti.<Br>Gali rasti GUIDE kaip zaisti stai cia, paspausk arba ne <p>Sekmes zaidime ;)</p>");
	//addPlayerLog($_SESSION['userID'], "-1", "Home", "You are very good player");
?>

<!DOCTYPE html>
<html>
<?php include("html/head.php"); ?>
<body>

	<?php include("html/header.php"); ?>

	<?php
	if(time() - $row['registerDate'] < 345600 && $row['vip'] < time()) {
		echo '
		<div class="alert alert-success" role="alert">
		  <h4 class="alert-heading">Vip discount for newbie</h4>
		  <p>Because you registered since last few days, we offer you cheaper VIP. <br>
		  Usual price is <strong>50 credits</strong> <i class="far fa-gem"></i>, but now you can buy it only for <strong>35 credits</strong> <i class="far fa-gem"></i>.</p>
		  <hr>
		  <p class="mb-0"><a href="credits.php">Buy it here</a></p>
		</div>
		';
	}


	if($row['role'] == 4) {
		echo '<a href="messageToAll.php">Send message to all</a>';
	}
	?>

	<section class="row">
		<section class="f-33 centered">
			<h1>Latest news</h1>
			<?php
			$newNews = mysqli_query($connection, "SELECT * FROM `news` WHERE '".time()."' - `writeTime` < '604800' ORDER BY `ID` DESC LIMIT 5");
			if(mysqli_num_rows($newNews)) {
				while($newRow = mysqli_fetch_array($newNews)) {
					echo
					'<section class="messageSection inlineHeading">
						<h4>'.$newRow['title'].'</h4>
						<small>'.getTimeAgo($newRow['writeTime']).' ago by '.userLink($newRow['writerID']).'</small> <br>
						<a href="new.php?ID='.$newRow['ID'].'">Read...</a>
					</section>';
				}
			} else {
				echo '<p>There is no news</p>';
			}
			echo '<p><a href="news.php">All news</a></p>';
			?>
		</section>
		<section class="f-33 centered">
			<h1>Shouts</h1>
			<section>
				<?php
				$newShouts = mysqli_query($connection, "SELECT * FROM `shouts` ORDER BY `ID` DESC LIMIT 4");
				if(mysqli_num_rows($newShouts)) {
					while($shoutRow = mysqli_fetch_array($newShouts)) {
						echo showShout($shoutRow, $row['role']);
					}
				} else {
					echo 'There is no shouts';
				}
				echo '<p><a href="shouts.php">All shouts</a></p>';
				?>

				<form method="POST" action="writeShout.php">
					<textarea id="summernote" name="shoutContent"></textarea>
					<button>Write</button>
				</form>
			</section>
		</section>

		<section class="f-33 centered">
			<h1>New players</h1>

			<?php
			$newPlayersQuery = mysqli_query($connection, "SELECT `ID`, `registerDate` FROM `users` WHERE '".time()."' - `registerDate` < '604800' ORDER BY `registerDate` DESC LIMIT 6");
			if(mysqli_num_rows($newPlayersQuery)) {

				while($playersRow = mysqli_fetch_array($newPlayersQuery)) {
					echo '
					<section class="messageSection">
						<h3>'.userLink($playersRow['ID']).'</h3>
						Registered '.getTimeAgo($playersRow['registerDate']).' ago
					</section>
					';

				}

			} else {
				echo 'There is no new players on last 7 days';
			}
			?>
		</section>

	</section>

	<?php include("html/footer.php"); ?>
	<?php include("scripts/formEditor.js"); ?>
</body>

</html>
