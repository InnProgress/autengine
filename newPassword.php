<?php

	require "scripts/connection.php";
	require "scripts/mainFuncs.php";

	if(array_key_exists('code', $_GET)) {

		$isRealCode = mysqli_query($connection, "SELECT * FROM `password_resets` WHERE `confirmCode`='".mysqli_real_escape_string($connection, $_GET['code'])."'");
		if($isRealCode && mysqli_num_rows($isRealCode)) {

			$verificationData = mysqli_fetch_array($isRealCode);

			if(array_key_exists('reset', $_POST) && array_key_exists('password1', $_POST) && array_key_exists('password2', $_POST)) {

				if($_POST['password1'] != $_POST['password2']) $autMessage .= "<p>Passwords does not match</p>";

				if(strlen($_POST['password1']) < 6) $autMessage .= "<p>Password is too short, atleast 6 symbols</p>";
				else if(strlen($_POST['password1']) > 20) $autMessage .= "<p>Password is too big, not more then 20 symbols</p>";

				if(strlen($autMessage) < 1) {

					mysqli_query($connection, "UPDATE `users` SET `password`='".password_hash($_POST['password1'], PASSWORD_DEFAULT)."' WHERE `ID`='".mysqli_real_escape_string($connection, $verificationData['userID'])."'");
					mysqli_query($connection, "DELETE FROM `password_resets` WHERE `confirmCode`='".mysqli_real_escape_string($connection, $_GET['code'])."' AND `userID`='".mysqli_real_escape_string($connection, $verificationData['userID'])."'");

					$autMessage = "<h4>Password succesfully reseted, now you can login with your new password</h4>";
					addPlayerLog($verificationData['userID'], -1, "Password", "Password has been reseted");
				}
			}

		} else $autMessage = "You can not reset this password";
	} else header("location: index.php");
?>


<!DOCTYPE html>
<html>
<?php include("html/head.php"); ?>
<body>

	<?php include("html/header.php"); ?>

	<div id="messageDiv"> <?php echo $autMessage; ?> </div>

	<form method="POST">
		<h1>RESET PASSWORD</h1>
		<input type="password" name="password1" placeholder="Password">
		<input type="password" name="password2" placeholder="Password">
		<button name="reset">Set new password</button>
	</form>


	<?php include("html/footer.php"); ?>

</body>
</html>