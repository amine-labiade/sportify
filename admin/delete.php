<?php
include_once (__DIR__ . "/../functions.php");

if (isset($_POST['tname'])) {
  $tname = e($_POST['tname']);
  $sql = "DELETE FROM terrains WHERE t_name='" . $tname . "'";

  $sq = "SELECT t_path FROM terrains WHERE t_name='" . $tname ."'";
  $res = mysqli_query($db,$sq);
  $img_path = mysqli_fetch_assoc($res);

  if(mysqli_query($db,$sql)){
    unlink(__DIR__ . "/../images/std/" . $img_path['t_path']); //deletes image from server
    echo "deletus success";
  }else{
    echo "error";   //a wow moment here constraints buddy!  why rows couldn't be deleted;
  }
  unset($_POST['tname']);
}else{
  $sql = "DELETE FROM terrains";
  if(mysqli_query($db,$sql)){
    echo "No more terrains :()";
  }
}
 ?>
