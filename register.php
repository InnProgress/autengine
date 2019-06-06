<?php

	require "scripts/connection.php";
	require "scripts/mainFuncs.php";
	$settingsIncludes .= "<script src='https://www.google.com/recaptcha/api.js'></script>";

	if(User::isLoggedIn()) {
		redirect("home.php");
	}

	$autMessage = "";

	$username = "";
	$email = "";

	if(array_key_exists("registration", $_POST)) { /// REGISTRATION

		$secretKey = "6LfTd1sUAAAAAMVtpdYGcwIc9ZozzrjzjhKDJtVH";
	    $ip = $_SERVER['REMOTE_ADDR'];
	    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$_POST['g-recaptcha-response']."&remoteip=".$ip);
	    $responseKeys = json_decode($response,true);

	    if(intval($responseKeys["success"]) !== 1) {
	        $autMessage .= "<p>You need confirm that you are not robot</p>";
	    }

	    if(strlen($autMessage) < 1) {
		    $username = $_POST['username'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$passwordR = $_POST['passwordR'];

			if(strlen($username) < 3) $autMessage .= "<p>Username you entered is too short!</p>";
			else if(strlen($username > 15)) $autMessage .= "<p>Username you entered is too big</p>";

			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $autMessage .= "<p>Email you entered is not valid</p>";

			if($password != $passwordR) $autMessage .= "<p>Passwords does not match</p>";

			if(strlen($password) < 6) $autMessage .= "<p>Password is too short, atleast 6 symbols</p>";
			else if(strlen($password) > 20) $autMessage .= "<p>Password is too big, not more then 20 symbols</p>";

			$queryText = "SELECT `ID` FROM `users` WHERE `email`='".mysqli_real_escape_string($connection, $email)."'";
			$checkQuery = mysqli_query($connection, $queryText);
			if(mysqli_num_rows($checkQuery) != 0) $autMessage .= "<p>This email is already taken</p>";

			$queryText = "SELECT `ID` FROM `users` WHERE `username`='".mysqli_real_escape_string($connection, $username)."'";
			$checkQuery = mysqli_query($connection, $queryText);
			if(mysqli_num_rows($checkQuery) != 0) $autMessage .= "<p>This username is already taken</p>";

			$registeredAcc = 0;

			$multiAccQuery = mysqli_query($connection, "SELECT * FROM `users` WHERE `registrationIP`='".mysqli_real_escape_string($connection, getIP())."'");
			while($accRow = mysqli_fetch_array($multiAccQuery)) {

				if(time() - $accRow['loginDate'] < 864000)
				{
					$banInfo = loadBanInfo($accRow['ID']);
					if(empty($banInfo)) $registeredAcc ++;
				}
			}

			if($registeredAcc > 3) $autMessage .= "<p>We have detected that this is not only account that is registered on this IP address, if you think it is mistake contact game administrator via <a href='skype:arnold.autuch'>skype</a> or <a href='mailto:autengine@gmail.com'>e-mail</a></p>";

			if(strlen($autMessage) < 1) {

				$registrationQuery = "INSERT INTO `users` (`username`, `email`, `password`, `registrationIP`, `registerDate`) VALUES ('".mysqli_real_escape_string($connection, $username)."', '".mysqli_real_escape_string($connection, $email)."', '".password_hash($password, PASSWORD_DEFAULT)."', '".mysqli_real_escape_string($connection, getIP())."', '".time()."')";
				$registered = mysqli_query($connection, $registrationQuery);


				$id = mysqli_insert_id($connection);

				$confirmCode = md5(uniqid(rand()));
				mysqli_query($connection, "INSERT INTO `verifications` (`confirmCode`, `userID`) VALUES ('".mysqli_real_escape_string($connection, $confirmCode)."', '".mysqli_real_escape_string($connection, $id)."')");

				$subject = "#AUTengine account verification";
				$txt = "Hello, thanks for registering to #AUTengine game.<br>Now you can verify your account by clicking here <a href='http://arnoldportfolio-com.stackstaging.com/autengine/verifyAccount.php?code=".$confirmCode."'>VERIFY ACCOUNT</a>";
				$headers = "From: autengine@gmail.com" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

				mail($email,$subject,$txt,$headers);


				if(!$registered) $autMessage .= "<p>Sign up failed, please try again later</p>";
			}
		}
		if(strlen($autMessage) > 0) {
			$autMessage = "<h1>ERRORS:</h1>".$autMessage;
		} else {
			$autMessage = "<H1>Registration was succesfull <a href='index.php'>Login</a></h1>";
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
		<h1>REGISTER</h1>
		<input type="text" name="username" value="<?php echo $username; ?>" placeholder="Username">
		<input type="email" name="email" value="<?php echo $email; ?>" placeholder="Email">
		<input type="password" name="password" placeholder="Password">
		<input type="password" name="passwordR" placeholder="Re-enter password">
		<div class="g-recaptcha" data-sitekey="6LfTd1sUAAAAAC7c6y7KKWqyWZWD9AwpJkPPyqXA"></div>
		<button name="registration">Register</button>
	</form>

	<a href="index.php">Login here</a>

	<?php include("html/footer.php"); ?>

</body>

</html>
