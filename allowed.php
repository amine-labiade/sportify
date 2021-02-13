<?php
include_once(__DIR__ . "/functions.php");

/*it takes the date inserted first
then looks for hours already booked
07 => 20 */


if (isset($_POST['r_date']) && isset($_POST['std'])) {


  $std = e(getTerrainId($_POST['std']));
  $dat = e(implode('-',array_reverse(explode('.',$_POST['r_date']))));
  $allowed = range(7, 20);

  $starts = array();
  $ends = array();
  $booked = array();

  $sql = "SELECT startTime,endTime FROM reservation WHERE r_date='$dat' AND idt='$std' ";
  $result = mysqli_query($db,$sql);
  while ($row = mysqli_fetch_assoc($result)) {
    array_push($booked,array(substr($row['startTime'],0,2),substr($row['endTime'],0,2)));
    array_push($starts,substr($row['startTime'],0,2));
    array_push($ends,substr($row['endTime'],0,2));
  }

foreach ($booked as $value) {
  if (($value[0]+1)<=($value[1]-1)) {
      $allowed = array_diff($allowed,range($value[0]+1,$value[1]-1)) ;
  }
  if ($value[0] == 7) {
    array_shift($allowed);
  }
  if ($value[1] == 20) {
    array_pop($allowed);
  }
}

$allowed = array_diff($allowed,array_intersect($starts,$ends));




/*if (count($allowed) == 1) {
  unlink($allowe)
} */
$taken = array();


array_push($taken,array_diff(range(7,20),$allowed)) ;
array_push($taken,array_map(intval,$starts)) ;
array_push($taken,array_map(intval,$ends)) ;
$taken = json_encode($taken);

echo $taken;

//echo $allowed;



}





?>
