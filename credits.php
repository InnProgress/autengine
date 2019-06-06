<?php

	require "scripts/connection.php";
	require "scripts/mainFuncs.php";
	userAccountIncludes();

	$row = loadUserData();
	$vipPrice = 50;
	$vipText = "<strong>".$vipPrice."</strong>";
	$vipHeaderText = " ";

	if(time() - $row['registerDate'] < 345600) { 
		$vipPrice = 35;
		$vipText = "<strike class='danger'>50</strike> <strong class='success'>".$vipPrice."</strong>";
		$vipHeaderText = "<span class='success'>(Discount)</span>";
	}

	if(array_key_exists('buyVipForMonth', $_POST)) {
		if($row['vip'] > time()) {
			addErrorMsg("You are already VIP");
		} else {
			if($row['credits'] > $vipPrice) {

				$row['vip'] = time() + 3600 * 24 * 30;
				$row['credits'] -= $vipPrice;

				mysqli_query($connection, "UPDATE `users` SET `vip`='".$row['vip']."', `credits` = '".$row['credits']."' WHERE `ID`='".$_SESSION['userID']."'");
				addMiniMsg("Vip succesfully bought");
			} else {
				addErrorMsg("You don't have enough credits");
			}
		}
		header("location: credits.php");
	}

	$settingsIncludes .= '
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>';
?>

<!DOCTYPE html>
<html>
<?php include("html/head.php"); ?>
<body>

	<?php include("html/header.php"); ?>

	<a href="#buy-credits-text"><h4>Want to buy credits?</h4></a>

	<h1>Credits</h1>
	<p>Your credits: <strong><?php echo $row['credits']; ?></strong> <i class="far fa-gem"></i></p>

	<?php

	if($row['vip'] > time()) echo '<p>Your VIP is still valid for <ins>'.round(($row['vip'] - time()) / 60 / 60 / 24).'</ins> days</p>';
	else echo "<p>You don't have VIP</p>";

	?>

	<section class="messageSection">
		<h2>VIP <?php echo $vipHeaderText; ?></h2>

		<h5>Why do you need it?</h5>
		<ul>
			<li>"Star" sign next to your nick (<a href=""><i class="far fa-star"></i> Your_nick</a>)</li>
		</ul>

		Price: <i class="far fa-gem"></i> <?php echo $vipText; ?> credits <br>
		Period: <strong>30 days</strong> <br>
		<button data-toggle="modal" data-target="#vipForMonth">Buy</button>
	</section>


	<br>

	<h2 id="buy-credits-text">Want to buy credits?</h2>
	<section class="row">
		<section class="credit-block centered-text">
			Amount: <strong>50 <i class="far fa-gem"></i></strong> <br>
			Price: <strong>3.00 <i class="fas fa-euro-sign"></i></strong>
		</section>
		<section class="credit-block centered-text">
			Amount: <strong>150 <i class="far fa-gem"></i></strong> <br>
			Price: <strong>8.00 <i class="fas fa-euro-sign"></i></strong>
		</section>
		<section class="credit-block centered-text">
			Amount: <strong>300 <i class="far fa-gem"></i></strong> <br>
			Price: <strong>12.00 <i class="fas fa-euro-sign"></i></strong>
		</section>
		<section class="credit-block centered-text">
			Amount: <strong>500 <i class="far fa-gem"></i></strong> <br>
			Price: <strong>18.00 <i class="fas fa-euro-sign"></i></strong>
		</section>
		<section class="credit-block centered-text">
			Amount: <strong>1000 <i class="far fa-gem"></i></strong> <br>
			Price: <strong>30.00 <i class="fas fa-euro-sign"></i></strong>
		</section>
		<section class="credit-block centered-text">
			Amount: <strong>5000 <i class="far fa-gem"></i></strong> <br>
			Price: <strong>130.00 <i class="fas fa-euro-sign"></i></strong>
		</section>
	</section>
	
	<br>

	<div class="alert alert-warning" role="alert">
	  <h4 class="alert-heading">Sorry...</h4>
	  <p>We are sorry, but automatic credit buying system is not implemented yet, but for sure you can buy credits contacting administrator of the game.</p>
	  <hr>
	  <p class="mb-0">You can contact game administrator in game <?php echo userLink(1); ?> or via skype <a href="skype:arnold.autuch">here</a>.</p>
	</div>


  	<div class="modal" id="vipForMonth">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
          	Do you really want to buy VIP?
          </div>
          <div class="modal-footer">
        	<form method="POST"><button name="buyVipForMonth" class="def-success">Buy</button></form>
          	<button data-dismiss="modal" class="def-danger">Close</button>
          </div>
        </div>
      </div>
    </div>
 

	<?php include("html/footer.php"); ?>

</body>

</html>