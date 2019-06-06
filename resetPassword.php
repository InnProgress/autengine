<?php

	require "scripts/connection.php";
	require "scripts/mainFuncs.php";

	$autMessage = "";

	if(array_key_exists('reset', $_POST) && array_key_exists('email', $_POST)) {

		$isRealEmail = mysqli_query($connection, "SELECT `ID`, `emailVerified` FROM `users` WHERE `email`='".mysqli_real_escape_string($connection, $_POST['email'])."' LIMIT 1");
		if(mysqli_num_rows($isRealEmail)) {

			$emailData = mysqli_fetch_array($isRealEmail);

			if($emailData['emailVerified'] == 1) {


				$infoQuery = mysqli_query($connection, "SELECT `confirmCode` FROM `password_resets` WHERE `userID`='".mysqli_real_escape_string($connection, $emailData['ID'])."'");
				if(mysqli_num_rows($infoQuery)) {
					$autMessage .= 'Reset email was already sent before, if you think it is mistake contact game administrator  via <a href="skype:arnold.autuch">skype</a> or <a href="mailto:autengine@gmail.com">e-mail (autengine@gmail.com)</a>';
				} else {

					$confirmCode = md5(uniqid(rand()));
					mysqli_query($connection, "INSERT INTO `password_resets` (`confirmCode`, `userID`) VALUES ('".mysqli_real_escape_string($connection, $confirmCode)."', '".mysqli_real_escape_string($connection, $emailData['ID'])."')");

					$subject = "#AUTengine password reset";
					$txt = "Hello, if you want to reset you password click here <a href='http://arnoldportfolio-com.stackstaging.com/autengine/newPassword.php?code=".$confirmCode."'>NEW PASSWORD</a>";
					$headers = "From: arnoldautuch4@gmail.com" . "\r\n";
					$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

					mail($_POST['email'],$subject,$txt,$headers);

					$autMessage = '<h3>We sent email to your email address, check it to reset password</h3>';
				}

			}
			else $autMessage = 'You can not reset your password because you have not verified you email address, please contact game administrator  via <a href="skype:arnold.autuch">skype</a> or <a href="mailto:autengine@gmail.com">e-mail (autengine@gmail.com)</a>';
		} else {
			$autMessage = 'This is not valid email address, if you do not remember you email or you can not access feel free to contact game administrator via <a href="skype:arnold.autuch">skype</a> or <a href="mailto:autengine@gmail.com">e-mail (autengine@gmail.com)</a>';
		}
	} 

?>

<!DOCTYPE html>
<html>
<?php include("html/head.php"); ?>
<body>

	<?php include("html/header.php"); ?>

	<div id="messageDiv"> <?php echo $autMessage; ?> </div>

	<form method="POST">
		<h1>RESET PASSWORD</h1>
		<input type="email" name="email" placeholder="Email">
		<button name="reset">Reset</button>
	</form>


	<?php include("html/footer.php"); ?>

</body>
</html>