<?php include(__DIR__  . "/../functions.php");


  $idt = getTerrainId(e($_POST['t_name']));
  $text = e($_POST['text']);
  $column_name = e($_POST['column_name']);

  $sql = "UPDATE terrains SET ".$column_name."='".$text."' WHERE idt='".$idt."'";

  if (mysqli_query($db,$sql)) {
    echo "success";
  }
?>
