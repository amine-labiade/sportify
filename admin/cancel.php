<?php
require_once( __DIR__  . "/../functions.php");

if (isset($_POST['idr'])) {

  $idr = e($_POST['idr']);

  $sql = "SELECT idt, r_date, startTime, endTime FROM reservation WHERE idr='$idr' LIMIT 1";

  if ($res = mysqli_query($db,$sql)){
    $r_info  = mysqli_fetch_assoc($res);
    $notif =e(implode("@",$r_info));
  }

  $sql = "SELECT idu FROM reservation WHERE idr='$idr' LIMIT 1";
  $idu = e(mysqli_fetch_assoc(mysqli_query($db,$sql))['idu']);



  $sql = "UPDATE users SET notification='$notif' WHERE idu='$idu'";

  if(mysqli_query($db,$sql)){
    echo "success";
  }

  $sql = "DELETE FROM reservation WHERE idr='$idr'";
  mysqli_query($db,$sql);

  unset($_POST['idr']);
}



?>
