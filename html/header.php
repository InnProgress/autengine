<nav class="navbar navbar-light bg-light">
  <a class="navbar-brand" href="#">
    #AUTengine

    <?php include("html/navigation.php"); ?>

  </a>
</nav>

<div class="container">
	<?php 
	if(array_key_exists('userID', $_SESSION)) {
		$row = loadUserData(); 
		if($row['emailVerified'] == 0) {
			echo '
			<div class="alert alert-warning alert-dismissible fade show" role="alert">
			  <strong>Email verification</strong> Please verify your email address by clicking on a link we send to you via email. <a href="resend.php">Resend email</a>
			</div>
			';
		} 
	}
	?>
	<?php if(array_key_exists('userID', $_SESSION)) if(empty($_POST)) { showMiniMsg(); showErrorMsg(); } ?>