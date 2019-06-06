<?php

	require "scripts/connection.php";
	require "scripts/mainFuncs.php";
	$settingsIncludes .= "<script src='https://www.google.com/recaptcha/api.js'></script>";

	if(User::isLoggedIn()) {
		redirect("home.php");
	}

	$autMessage = "";

	if(array_key_exists("login", $_POST)) {

		if(array_key_exists('badLogin', $_SESSION) && $_SESSION['badLogin'] > 2) {
			$secretKey = "6LfTd1sUAAAAAMVtpdYGcwIc9ZozzrjzjhKDJtVH";
	        $ip = $_SERVER['REMOTE_ADDR'];
	        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$_POST['g-recaptcha-response']."&remoteip=".$ip);
	        $responseKeys = json_decode($response,true);

	        if(intval($responseKeys["success"]) !== 1) {
	        	$autMessage .= "<p>You can not login because you are robot</p>";
	        }
	    }

		if(strlen($autMessage) == 0) {
			$email = $_POST['email'];
			$password = $_POST['password'];

			$checkEmailQuery = "SELECT * FROM `users` WHERE email='".mysqli_real_escape_string($connection, $email)."'";
			$loadUserData = mysqli_query($connection, $checkEmailQuery);
			if(mysqli_num_rows($loadUserData) == 0) $autMessage .= "<p>There is no such user with this email address</p>";
			else {
				$row = mysqli_fetch_array($loadUserData);

				if(password_verify($password, $row['password'])) {
					// LOGGED IN

					$banArray = User::loadSInfo($row['ID'], "bans");
					if(($banArray['time'] - time() > 0 && $banArray['time'] > 0) || $banArray['time'] == -1) {

						$banTimeText = "Permament ban";
						if($banArray['time'] != -1) {
							$banTimeText = 'Banned till '.date("Y-m-d H:i:s", $banArray['time']);
						}

						$autMessage .= '
						<p>
						User is banned by '.userLink($banArray['adminID']).'<br>
						Reason: '.$banArray['reason'].'<br>'.
						$banTimeText.'</p>';

					}

					else {

						$_SESSION['userID'] = $row['ID'];

						$loadMsgDataQuery = mysqli_query($connection, "SELECT `loginDate` FROM `users` WHERE `ID`='".$row['ID']."'");
						$msgRow = mysqli_fetch_array($loadMsgDataQuery);

						if($msgRow['loginDate'] == 0) addMiniMsg("Welcome to game! If you have any questions or ideas for the game please to share them");
						else addMiniMsg("Welcome back! Last time you logged in to game <ins>".date("Y-m-d H:i:s", $msgRow[0])."</ins>");

						mysqli_query($connection, "UPDATE `users` SET `lastIP`='".mysqli_real_escape_string($connection, getIP())."', `loginDate`='".time()."' WHERE `ID`='".$row['ID']."'");
						addPlayerLog($row['ID'], -1, "Login", "User ".userLink($row['ID'])." logged in");

						if(array_key_exists('badLogin', $_SESSION)) $_SESSION['badLogin'] = 0;

						redirect("home.php");
					}
				} else {
					$autMessage .= "<p>Password is not valid, please try again</p>";
				}
			}

			if(strlen($autMessage) > 0) {
				if(array_key_exists('badLogin', $_SESSION)) $_SESSION['badLogin'] ++;
				else $_SESSION['badLogin'] = 1;
			}
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
		<h1>LOGIN</h1>
		<input type="email" name="email" placeholder="Email">
		<input type="password" name="password" placeholder="Password">
		<?php if(array_key_exists('badLogin', $_SESSION)) if($_SESSION['badLogin'] > 2) echo '<div class="g-recaptcha" data-sitekey="6LfTd1sUAAAAAC7c6y7KKWqyWZWD9AwpJkPPyqXA"></div>'; ?>
		<button name="login">Login</button>
	</form>

	<a href="resetPassword.php">Don't remember password?</a>
	<a href="register.php">Register here</a>


	<?php include("html/footer.php"); ?>

</body>

</html>
