<?php

// ultimate pagination
// sutvarkyti pagination when deleting all msgs, notifs
// messages - ajax delete (all), mark all as read
// shouts.php, home.php - delete, edit
// search.php realtime
// news.php, new.php delete
// with pusher update if someone is sending messages to you toastr notif

	require "scripts/connection.php";
	require "scripts/mainFuncs.php";
	userAccountIncludes();

	$settingsIncludes .= '
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
	<link rel="stylesheet" href="styles/style.css">
	<script src="scripts/js/modernizr.js"></script>';


	if(isset($_GET['deleteID'])) {
		if($_GET['deleteID'] == "all") Crud::deleteNotification("all");
		else Crud::deleteNotification($_GET['deleteID']);
	}


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


	$allNotifications = 0;


	if(array_key_exists("read", $_GET)) {
		if($_GET['read'] == "all") {
			mysqli_query($connection, "UPDATE `notifications` SET `notificationRead`='1' WHERE `receiverID`='".$_SESSION['userID']."'");
		}
		redirect("notifications.php");
	}

	$notificationsText = "";

	$query = "SELECT * FROM `notifications` WHERE `receiverID`='".$_SESSION['userID']."' ORDER BY `ID` DESC LIMIT ".$sPage.", ".$sPageMax;
	$getNotifications = mysqli_query($connection, $query);

	if(mysqli_num_rows($getNotifications) < 1 && $page != 1) {
		redirect("notifications.php");
	}

	while($row = mysqli_fetch_array($getNotifications))
	{
		$new = "";
		if($row['notificationRead'] == 0) {
 			$new = "newSmth";
 			mysqli_query($connection, "UPDATE `notifications` SET `notificationRead`='1' WHERE `ID`='".$row['ID']."'");
 		}

		$notificationsText .= '
		<section class="notificationsSection '.$new.'">

			<h3>'.htmlspecialchars($row['title']).'</h3>
			<p>'.($row['content']).'</p>
			<small>'.date("Y-m-d H:i:s", $row['sentTime']).'</small>

			<p>
				<a class="delete-link cd-popup-trigger" id="'.$row['ID'].'" href="javascript:void(0);">Delete</a>
			</p>

		</section>
		';
	}
	if(strlen($notificationsText) < 1) $notificationsText = 'You dont have any notifications!';

?>

<!DOCTYPE html>
<html>
<?php include("html/head.php"); ?>
<body>

	<?php include("html/header.php"); ?>

	<?php

		$allNotifications = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM `notifications` WHERE `receiverID`='".$_SESSION['userID']."'"));

		echo '<a class="delete-link cd-popup-trigger" id="all" href="javascript:void(0);">Delete all received notifications</a> <br>
		<a id="all-read" href="javascript:void(0);">Mark all as read</a> <br><br>';

		echo '<p>All notifications: <span id="notifs-number">'.$allNotifications.'</span></p>';

		echo '<h1>Received notifications</h1>';

		echo "<p id='no-notifs'>".$notificationsText."</p>";


		if($page > 1) echo ' <a href="notifications.php?page='.($page-1).'">'.($page-1).'</a> ';
		echo $page;
		if($sPageMax < $allNotifications) echo ' <a href="notifications.php?page='.($page+1).'">'.($page+1).'</a> ';
	?>

	<?php include("html/footer.php"); ?>

	<div class="cd-popup" role="alert">
		<div class="cd-popup-container">
			<p class="popup-text">Are you sure you want to delete this element?</p>
			<ul class="cd-buttons">
				<li><a href="javascript:void(0);" class="delete-ok">Yes</a></li>
				<li><a href="javascript:void(0);" class="delete-no">No</a></li>
			</ul>
			<a href="#0" class="cd-popup-close img-replace">Close</a>
		</div> <!-- cd-popup-container -->
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script src="scripts/js/popup.js"></script> <!-- https://github.com/CodyHouse/confirmation-popup -->

	<script>

		$(document).ready(function() {

			var marked = false;
			var deleted = false;
			var id = null;
			var thisElement = null;

			$(".delete-no").on('click', function() {
				$(".cd-popup").removeClass('is-visible');
				id = null;
				thisElement = null;
			});


			$(".delete-link").on('click', function() {
				id = $(this).attr("id"); // id
				thisElement = $(this);
				$(".cd-popup").show();

				if(id == "all") {
					$(".popup-text").text("Are you sure you want to delete all notifications?");
				} else {
					$(".popup-text").text("Are you sure you want to delete this notification?");
				}
			});
			$(".delete-ok").on('click', function() {

				$(".cd-popup").removeClass('is-visible');

				if(!deleted) {
					//if(confirm("Are you sure, you wanna delete this notification?")) {
						// var id = $(this).attr("id"); // id
						// var thisElement = $(this);
						var notifsNumber = parseInt($("#notifs-number").text());

						$.ajax({
							type: 'GET',
							data: {deleteID:id},
							success: function() {

								if(id == "all") {
									$(".notificationsSection").fadeOut("slow", function() {
										$(".notificationsSection").remove();
									});
									toastr.success("All notifications were deleted");
									notifsNumber = 0;
									deleted = true;

								} else {
									thisElement.parent().parent().fadeOut("normal", function() {
										thisElement.parent().parent().remove();
									});
									toastr.success("Notification succesfully deleted");
									notifsNumber --;
								}

								$("#notifs-number").text(notifsNumber);

								if(notifsNumber < 1) {
									$("#no-notifs").text("You dont have any notifications!");
								}

							},
							error: function() {
								toastr.error("Error while trying to delete content");
							}
						});
					//}
				} else {
					toastr.warning("You have already deleted all messages");
				}
			});

			$("#all-read").on('click', function() {
				if(!marked) {
					$.ajax({
						type: 'GET',
						data: {"read": "all"},
						success: function() {
							$(".notificationsSection").removeClass("newSmth");
							$(".unreadNotifs").remove();
							toastr.success("All notifications were succesfully marked as read");
							marked = true;
						}
					});
				} else {
					toastr.warning("You have already marked them as readed");
				}
			});

		});
	</script>

</body>

</html>
