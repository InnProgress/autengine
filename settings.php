<?php

	require "scripts/connection.php";
	require "scripts/mainFuncs.php";
	userAccountIncludes();
	$row = loadUserData();

	if(isset($_POST['submitNewEmail'])) {

		$checkQuery = mysqli_query($connection, "SELECT `ID` FROM `users` WHERE `email`='".mysqli_real_escape_string($connection, $_POST['email'])."'");

		if(mysqli_num_rows($checkQuery) != 0) addErrorMsg("This email is already taken");
		else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) addErrorMsg("Email you entered is not valid");
		else {
			$changeEmailQuery = mysqli_query($connection, "UPDATE `users` SET `email`='".mysqli_real_escape_string($connection, $_POST['email'])."', `emailVerified`='0' WHERE `ID`='".mysqli_real_escape_string($connection, $_SESSION['userID'])."'");

			mysqli_query($connection, "DELETE FROM `verifications` WHERE `userID`='".mysqli_real_escape_string($connection, $_SESSION['userID'])."'");

			$confirmCode = md5(uniqid(rand()));
			mysqli_query($connection, "INSERT INTO `verifications` (`confirmCode`, `userID`) VALUES ('".mysqli_real_escape_string($connection, $confirmCode)."', '".mysqli_real_escape_string($connection, $_SESSION['userID'])."')");

			$subject = "#AUTengine email verification";
			$txt = "Hello, you can verify your account by clicking here <a href='http://arnoldportfolio-com.stackstaging.com/autengine/verifyAccount.php?code=".$confirmCode."'>VERIFY ACCOUNT</a>";
			$headers = "From: autengine@gmail.com" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			mail($_POST['email'],$subject,$txt,$headers);

			if($changeEmailQuery) {
				addMiniMsg("Email succesfully changed to ".strip_tags($_POST['email']));
				addPlayerLog($_SESSION['userID'], -1, "Settings", userLink($_SESSION['userID'])." changed his email address");
			}
			else addErrorMsg("There was an error, we could not change you email address, please try again later or contact game administrator");
		}
		redirect("settings.php");
	}

	if(array_key_exists('submitNewPassword', $_POST)) {

		if(strlen($_POST['password1']) < 6) $autMessage .= addErrorMsg("Password is too short, atleast 6 symbols");
		else if(strlen($_POST['password1']) > 20) $autMessage .= addErrorMsg("Password is too big, not more then 20 symbols");
		else if($_POST['password1'] != $_POST['password2']) addErrorMsg("Passwords does not match");
		else {
			$changePasswordQuery = mysqli_query($connection, "UPDATE `users` SET `password`='".mysqli_real_escape_string($connection, password_hash($_POST['password1'], PASSWORD_DEFAULT))."' WHERE `ID`='".mysqli_real_escape_string($connection, $_SESSION['userID'])."'");

			if($changePasswordQuery) {
				addMiniMsg("Password succesfully changed");
				addPlayerLog($_SESSION['userID'], -1, "Settings", userLink($_SESSION['userID'])." changed his password");
			}
			else addErrorMsg("There was an error with changing the password, please try again later or contact game administrator");
		}

		redirect("settings.php");
	}
?>

<!DOCTYPE html>
<html>
<?php include("html/head.php"); ?>
<body>

	<?php include("html/header.php"); ?>

	<h2>Change your e-mail address: </h2>
	Now your email address is <?php echo $row['email']; ?>
	<form method="POST">
		<input type="email" name="email" placeholder="E-mail address">
		<button name="submitNewEmail">Submit</button>
	</form>
	<br>

	<h2>Change your password: </h2>
	<form method="POST">
		<input type="password" name="password1" placeholder="Password">
		<input type="password" name="password2" placeholder="Password">
		<button name="submitNewPassword">Submit</button>
	</form>

	<?php include("html/footer.php"); ?>

</body>
</html>
