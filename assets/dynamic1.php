<?php include_once (__DIR__ . "/../functions.php") ;?>
<?php
$sq = "SELECT DISTINCT type FROM terrains WHERE city=? ORDER BY type";

 if ($stmt = mysqli_prepare($db,$sq)) {
   mysqli_stmt_bind_param($stmt, "s", $_GET['city']);

   mysqli_stmt_execute($stmt);

   mysqli_stmt_bind_result($stmt, $type);

  ?> <option value="">--Choose a type--</option> <?php
  while (mysqli_stmt_fetch($stmt)) {
    ?><option value="<?php echo $type;?>"><?php echo $type;?></option><?php
  }
   mysqli_stmt_close($stmt);
}
?>
