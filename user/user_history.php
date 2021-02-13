<?php
include (__DIR__ . '/../functions.php');


if(isset($_SESSION['user'])){
  $loggedInId = $_SESSION['user']['idu'];

  if (isset($_POST['res_date'])) {
    $res_date = e($_POST['res_date']);


    $slq = "SELECT idr, idt ,r_date ,startTime ,endTime ,duration, price FROM reservation WHERE idu='$loggedInId' AND r_date='$res_date' AND cancel_req IS NULL ORDER BY startTime";
    $resu =mysqli_query($db,$slq);
    if (mysqli_num_rows($resu)>0) {
      ?>
      <table class="table table-striped">
        <thead class="smthn">
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Date</th>
            <th scope="col">From</th>
            <th scope="col">To</th>
            <th scope="col">duration</th>
            <th scope="col">price</th>
            <th scope="col"></th>
          </tr>
        </thead>
      <?php
      while ($rwo = mysqli_fetch_assoc($resu)){
        ?>
          <tbody>
            <tr>
              <th class="light" scope="row"><?php echo getTerrainById($rwo['idt'])['t_name'];?></th>
              <td class="heavy" ><?php echo $rwo['r_date']; ?></td>
              <td class="light"><?php echo substr($rwo['startTime'],0,5); ?></td>
              <td class="heavy"><?php echo substr($rwo['endTime'],0,5); ?></td>
              <td class="light"><?php echo $rwo['duration']; ?></td>
              <td class="heavy"><?php echo $rwo['price'];?><strong class="float-right text-right">MAD</strong></td>
              <td class="light"><button data-id="<?php echo $rwo['idr'] ;?>" class="btn btn-danger ml-5 req_cancel">Request Cancelation</button></td>
            </tr>
          </tbody>
      <?php  }
      ?></table><?php
    }else{
              echo '<div class="alert alert-warning"><b>No reservations found (°°)</b></div>';
    }


    $slq = "SELECT idt ,r_date ,startTime ,endTime ,duration, price FROM reservation WHERE idu='$loggedInId' AND r_date='$res_date' AND cancel_req='true' ORDER BY startTime";
    $resu =mysqli_query($db,$slq);
    if (mysqli_num_rows($resu)>0) {
      ?>
      <div class="float-left text-primary mt-5"><h5><b><i>Cancelation Requests : </i></b></h5></div>
      <table class="table table-striped">
        <thead class="smthn-c">
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Date</th>
            <th scope="col">From</th>
            <th scope="col">To</th>
            <th scope="col">duration</th>
            <th scope="col">price</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
      <?php
      while ($rwo = mysqli_fetch_assoc($resu)){
        ?>
          <tbody>
            <tr>
              <th  scope="row"><?php echo getTerrainById($rwo['idt'])['t_name'];?></th>
              <td><?php echo $rwo['r_date']; ?></td>
              <td><?php echo substr($rwo['startTime'],0,5); ?></td>
              <td><?php echo substr($rwo['endTime'],0,5); ?></td>
              <td><?php echo $rwo['duration']; ?></td>
              <td><?php echo $rwo['price'];?><strong class="float-right text-right">MAD</strong></td>
              <td class="text-primary"><b>Waiting for cancelation Approval!</b></td>
            </tr>
          </tbody>
      <?php  }
      ?></table><?php
    }else{
              echo '<div class="alert alert-warning"><b>Cancelation requests appear here ! (°°)</b></div>';
    }

    $sql = "SELECT notification FROM users WHERE idu='$loggedInId' AND notification IS NOT NULL LIMIT 1 ";
    $res = mysqli_query($db,$sql);

    if (mysqli_num_rows($res)>0) {
      $row = explode('@',mysqli_fetch_assoc($res)['notification']);
      ?>
      <div class="row">
        <div class="alert alert-success col-8 ml-2">
          <b> Your reservation of terrain:<i><?php echo getTerrainById($row[0])['t_name'] ;?></i><br>
              For  : <i><?php echo $row[1] ;?></i><br>
              From : <i><?php echo substr($row[2],0,5) ;?></i><br>
              To   : <i><?php echo substr($row[3],0,5) ;?></i><br>
             <span class="text-danger">was canceled!</span></b>
        </div>
      </div>
      <?php
      $sql = "UPDATE users SET notification = NULL WHERE idu='$loggedInId'";
      mysqli_query($db,$sql);

    unset($_POST['res_date']);
    }
  }else{

  $slq = "SELECT idt ,r_date ,startTime ,endTime ,duration, price FROM reservation WHERE idu='$loggedInId' ORDER BY r_date";
  $resu =mysqli_query($db,$slq);
  if (mysqli_num_rows($resu)>0){
  ?>
  <table class="table table-striped">
    <thead class="smthn">
      <tr>
        <th scope="col">Name</th>
        <th scope="col">Date</th>
        <th scope="col">From</th>
        <th scope="col">To</th>
        <th scope="col">duration</th>
        <th scope="col">price</th>
      </tr>
    </thead>
  <?php
  while ($rwo = mysqli_fetch_assoc($resu)){
    ?>
      <tbody>
        <tr>
          <th class="light" scope="row"><?php echo getTerrainById($rwo['idt'])['t_name'];?></th>
          <td class="heavy" ><?php echo $rwo['r_date']; ?></td>
          <td class="light"><?php echo substr($rwo['startTime'],0,5); ?></td>
          <td class="heavy"><?php echo substr($rwo['endTime'],0,5); ?></td>
          <td class="light"><?php echo $rwo['duration']; ?></td>
          <td class="heavy"><?php echo $rwo['price'];?><strong class="float-right text-right mr-6">MAD</strong></td>
        </tr>
      </tbody>
      <?php
    } ?>
    </table>
    <?php
      }else{
        echo '<div class="alert alert-warning ml-1"><b> No reservations found (°°)</b></div>';
      }
    }
  }
 ?>
