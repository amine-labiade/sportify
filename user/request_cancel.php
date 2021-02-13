<?php
require_once(__DIR__ . "/../functions.php");

if (isset($_POST['idr'])) {
  $idr = e($_POST['idr']);
  $sql = "UPDATE reservation SET cancel_req='true' WHERE idr='$idr'";
  if(mysqli_query($db,$sql)){
    echo 'success';
  }else {
    echo mysqli_error($db);
  }
}

unset($_POST['idr']);

?>
