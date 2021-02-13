<?php include_once (__DIR__ . "/../functions.php") ;?>

<?php

  if (!isLoggedIn()) {
    ?>
      <form action="#" method="post">
        <div class="choice">
          <div class="d-inline-flex flex-row justify-content-between mx-auto">
            <div class="mr-5">
              <label for="city">City<label>
              <select class="form-control" id="city" name="city" onchange="getTypo(this.value);storeCity();">
                <option value="">--Choose a city--</option>
                <?php
                $city = "SELECT DISTINCT `city` FROM `terrains` ORDER BY `city` ";
                $out = mysqli_query($db,$city);
                if (mysqli_num_rows($out) > 0) {
                  while ($row = mysqli_fetch_assoc($out)) {
                    ?><option value= <?php echo $row['city']?>><?php echo $row['city']?></option><?php
                  }
                }
                ?>
              </select>
            </div>
            <div class="type  ml-5">
              <label for="type">Type<label>
              <select class="form-control selectpicker" id="type" name="type" onchange="getSTD(this.value , storeCity())">
                  <option value="">--Choose a type--</option>
              </select>
            </div>
          </div>
        </div>
      </form>
      <div class="jumbotron smol" id="showcase">
            <div id="notify" class="alert alert-danger">please login first !</div>
      </div>
    </div>

    <?php
  }



  if(isset($_SESSION['user'])){

    $a = e($_GET['std']);
    $idt = getTerrainId($a);

    $period = array();

    $sq = "SELECT startTime,endTime FROM reservation WHERE r_date = ? AND idt = ?";

    if ($stmt = mysqli_prepare($db , $sq) ) {
      mysqli_stmt_bind_param($stmt,"si", $_GET['r_date'] , $idt);

      mysqli_stmt_execute($stmt);

      mysqli_stmt_bind_result($stmt,$s,$e);

      while (mysqli_stmt_fetch($stmt)){
        array_push($period , array(substr($s,0,2),substr($e,0,2))) ;
      }
    }
     mysqli_stmt_close($stmt);

    $start = $_GET['start'];
    $end = $_GET['end'];
    $valid = true;
    $starz = substr($start,0,2) ;
    $enz = substr($end,0,2);

    if($starz >= $enz){
      $valid = false;
      }else{
      if (!empty($period)) {
        {
        foreach ($period as $val) {
          if ( $starz>=$val[0] && $starz < $val[1]) {
            $valid = false;
            break;
          }elseif ($starz<$val[0]) {
            if ($enz <= $val[0]) {
              $valid = true ;
              continue;
            }else{
              $valid = false;
              break;
            }
          }elseif ($starz >= $val[1]) {
              $valid = true;
              continue;
          }else{
              $valid = false ;
              break;
            }
          }
        }
      }
    }

  $r_date = e($_GET['r_date']);
  $start = e($start);
  $end = e($end);
  $idu = e($_SESSION['user']['idu']);
  $duration = e($enz-$starz);
  $sqlPrix = "SELECT t_price FROM terrains WHERE idt='$idt' LIMIT 1";
  $res = mysqli_query($db, $sqlPrix);
  $wut = mysqli_fetch_assoc($res);
  $idr = e(uniqid("r",true));

  $price = e($duration*$wut['t_price']);

  $_SESSION['data'] = array($idr.' ' ,$_SESSION['user']['username'],$_GET['std'],$start,$end,$duration,$price);

  if($valid){
    $quer = "INSERT INTO reservation (idr, idu, idt, r_date, startTime, endTime, duration, price) VALUES('$idr','$idu','$idt','$r_date','$start','$end','$duration','$price')";
    if(mysqli_query($db,$quer)){
        echo '<div class="alert alert-success">transaction completed successfully!</div>';
        ?>
        <div class="btn-group">
          <a href="/assets/ticket.php" target="_blank"> <button type="button" class="btn btn-primary">Download Ticket</button></a>
          <button id="email-receipt" style="width:140px" class="btn btn-info text-center">Email Ticket</button>
        </div>
        <button class="btn btn-warning mt-5" onclick="return_home()">Return to Home !</button>
        <div id="email-feedback" class="mt-4"></div>


        <?php

    }else{
      echo mysqli_error($db);
      echo '<div class="alert alert-danger">Internal Error :( </div>' ;
    }
  }else{
    echo '<div class = "alert alert-danger"> Internal Error :(  </div> ';
  }
}
?>
