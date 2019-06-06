<?php

	require "scripts/connection.php";
	require "scripts/mainFuncs.php";
	userAccountIncludes();

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

	$allNews = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM `news`"));

	$newsText = "";
	$moreOptions = "";

	$row = loadUserData();

	if($row['role'] >= 4) {
		$moreOptions = '
		<a href="newNew.php">Write new post</a> <br>
		<a href="deleteNew.php?ID=all">Delete all news</a>
		';
	}

	$newsQuery = mysqli_query($connection, "SELECT * FROM `news` ORDER BY `ID` DESC LIMIT ".$sPage.", ".$sPageMax);

	if(mysqli_num_rows($newsQuery) < 1 && $page != 1) {
		redirect("news.php");
	}

	while($newRow = mysqli_fetch_array($newsQuery)) {

		$timeAgo = getTimeAgo($newRow['writeTime']);

		$moderating = "";
		if($row['role'] >= 4) {
			$moderating = '
				<a href="deleteNew.php?ID='.$newRow['ID'].'">Delete</a>
				<a href="editNew.php?ID='.$newRow['ID'].'">Edit</a>
			';
		}

		$newsText .= '
		<section class="messageSection">
			<h2>'.$newRow['title'].'</h2>
			<small>Writer: '.userLink($newRow['writerID']).'</small> <br>
			<small>'.$timeAgo.' ago</small>
			<p>'.substr(strip_tags($newRow['content']), 0, 120).'...</p>

			<a href="new.php?ID='.$newRow['ID'].'">Read more...</a> <br><Br>
			'.$moderating.'
		</section>';
	}

	if(strlen($newsText) < 1) $newsText = "There is no news yet!";
?>

<!DOCTYPE html>
<html>
<?php include("html/head.php"); ?>
<body>

	<?php include("html/header.php"); ?>

	<?php
		echo "<p>All news: ".$allNews."</p>";
		echo $moreOptions;
		echo $newsText;

		if($page > 1) echo ' <a href="news.php?page='.($page-1).'">'.($page-1).'</a> ';
		echo $page;
		if($sPageMax < $allNews) echo ' <a href="news.php?page='.($page+1).'">'.($page+1).'</a> ';

	?>

	<?php include("html/footer.php"); ?>

</body>

</html>
