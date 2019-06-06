<?php

class User
{

  static function onlineUsers() {
  	global $connection;
    $users = 0;

  	if($onlineUsersCount = mysqli_query($connection, "SELECT * FROM `user_online`")) {
  	   $users = mysqli_num_rows($onlineUsersCount);
    }

    return $users;
  }

  static function isLoggedIn() {
    if(array_key_exists('userID', $_SESSION)) return true;
  }

  static function logout($log = false) {

    if($log) {
      addPlayerLog($_SESSION['userID'], -1, "Logout", "User ".userLink($_SESSION['userID'])." logged out");
    }

    mysqli_query($connection, "DELETE FROM `user_online` WHERE `session`='".session_id()."' AND `userID`='".$_SESSION['userID']."'");
    unset($_SESSION['userID']);
		redirect("index.php");
  }


  static function loadSInfo($id = null, $table = "bans") {
    // tables: - bans, mutes

    if(is_null($id)) $id = $_SESSION['userID'];

  	global $connection;

  	$query = "SELECT * FROM `".$table."` WHERE `userID`='".mysqli_real_escape_string($connection, $id)."'";
  	$query = mysqli_query($connection, $query);
  	$row = mysqli_fetch_array($query);

  	return $row;
  }

  static function isBanned($id = null) {

    if(is_null($id)) $id = $_SESSION['userID'];

    global $connection;

    $query = mysqli_query($connection, "SELECT * FROM `bans` WHERE `userID`='".mysqli_real_escape_string($connection, $id)."'");
    if(mysqli_num_rows($query)) return true;
    else return false;
  }
  static function isMuted($id = null) {

    if(is_null($id)) $id = $_SESSION['userID'];

    global $connection;

    $query = mysqli_query($connection, "SELECT * FROM `mutes` WHERE `userID`='".mysqli_real_escape_string($connection, $id)."'");
    if(mysqli_num_rows($query)) return true;
    else return false;
  }


  static function getUserID($username) {
  	global $connection;

  	$gettingIDQuery = mysqli_query($connection, "SELECT `ID` FROM `users` WHERE `username`='".mysqli_real_escape_string($connection, $username)."'");
  	$gettingIDQueryResult = mysqli_fetch_array($gettingIDQuery);

  	if(!empty($gettingIDQueryResult)) {
  		return $gettingIDQueryResult[0];
  	} else return false;
  }

  static function updateAcitivity() {
    global $connection;

    $sessionQuery = $connection -> prepare("SELECT * FROM `user_online` WHERE session=? AND userID=?");
		$sessionID = session_id();
		$sessionQuery -> bind_param("ii", $sessionID, $_SESSION['userID']);
		$sessionQuery -> execute();
		$sessionQuery -> store_result();
		$sessionCount = $sessionQuery -> num_rows();
		if($sessionCount == "0") $connection -> query("INSERT INTO `user_online` (`session`, `time`, `userID`) VALUES ('".session_id()."', '".time()."', '".$_SESSION['userID']."')");
		else $connection -> query("UPDATE `user_online` SET `time`='".time()."' WHERE `session`='".session_id()."' AND `userID`='".$_SESSION['userID']."' LIMIT 1");
  }

}

?>
