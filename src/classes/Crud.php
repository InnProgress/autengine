<?php

class Crud
{

  static function deleteNotification($id = "all", $receiverID = null) {

    global $connection;

    if(is_null($receiverID)) $receiverID = $_SESSION['userID'];
    $idQuery = "";
    if($id != "all") {
      $idQuery = " AND `ID`='".esc_v($id)."'";
    }

    if($connection -> query("DELETE FROM `notifications` WHERE `receiverID`='".esc_v($receiverID)."'".$idQuery)) return true;
    else return false;
  }

}

?>
