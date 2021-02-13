<?php include_once (__DIR__ . "/../functions.php") ;?>
<?php
if (isset($_GET['dater'])) {

  $hDate =e($_GET['dater']);

  $slq = "SELECT idr, idt ,idu ,startTime ,endTime ,duration, price FROM reservation WHERE r_date='$hDate' AND cancel_req IS NULL ORDER BY startTime";
  $resu =mysqli_query($db,$slq);
  if (mysqli_num_rows($resu)) { ?>
    <table class="table table-striped">
      <thead class="smthn">
        <tr>
          <th scope="col">User</th>
          <th scope="col">Terrain</th>
          <th scope="col">From</th>
          <th scope="col">To</th>
          <th scope="col">duration</th>
          <th scope="col">price</th>
          <th scope="col"></th>
        </tr>
      </thead>
    <?php
    while ($ro = mysqli_fetch_assoc($resu)){
      ?>
        <tbody>
          <tr>
            <th class="light" scope="row"><?php echo getUserById($ro['idu'])['username'];?></th>
            <td class="heavy" ><?php echo getTerrainById($ro['idt'])['t_name'];?></td>
            <td class="light"><?php echo substr($ro['startTime'],0,5); ?></td>
            <td class="heavy"><?php echo substr($ro['endTime'],0,5); ?></td>
            <td class="light"><?php echo $ro['duration']; ?></td>
            <td class="heavy"><?php echo $ro['price'];?><strong class="float-right text-right">MAD</strong></td>
            <td class="lighty"><button data-id="<?php echo $ro['idr'] ;?>" class="cancel_btn btn btn-danger ml-5">Cancel</button></td>
          </tr>
        </tbody>
    <?php  }
            ?>
    </table>
  <?php }else {
    echo "<div class='alert alert-warning'><b>No records for the Day selected</b></div>";
  }
  $slq = "SELECT idr, idt ,idu ,startTime ,endTime ,duration, price FROM reservation WHERE r_date='$hDate' AND cancel_req='true' ORDER BY startTime";
  $resu =mysqli_query($db,$slq);
  if (mysqli_num_rows($resu)) {?>
    <div class="float-left text-primary mt-5"><h5><b><i>Cancelation Requests : </i></b></h5></div>
    <table class="table table-striped">
      <thead class="smthn-c">
        <tr>
          <th scope="col">User</th>
          <th scope="col">Terrain</th>
          <th scope="col">From</th>
          <th scope="col">To</th>
          <th scope="col">duration</th>
          <th scope="col">price</th>
          <th scope="col"></th>
        </tr>
      </thead>
    <?php
    while ($ro = mysqli_fetch_assoc($resu)){
      ?>
        <tbody>
          <tr>
            <th scope="row"><?php echo getUserById($ro['idu'])['username'];?></th>
            <td><?php echo getTerrainById($ro['idt'])['t_name'];?></td>
            <td><?php echo substr($ro['startTime'],0,5); ?></td>
            <td><?php echo substr($ro['endTime'],0,5); ?></td>
            <td><?php echo $ro['duration']; ?></td>
            <td><?php echo $ro['price'];?><strong class="float-right text-right">MAD</strong></td>
            <td><button data-id="<?php echo $ro['idr'] ;?>" class="cancel_btn btn btn-danger ml-5">Cancel</button></td>
          </tr>
        </tbody>
    <?php  }
            ?>
    </table>
  <?php }else {
    echo "<div class='alert alert-warning'><b>No cancelling requests for the Day selected</b></div>";
  }
  unset($_GET['dater']);
}else{
  $slq = "SELECT idt ,idu ,r_date ,startTime ,endTime ,duration, price FROM reservation ORDER BY r_date";
  $resu =mysqli_query($db,$slq);
  if (mysqli_num_rows($resu)>0) { ?>
    <table class="table table-striped">
      <thead class="smthn">
        <tr>
          <th scope="col">User</th>
          <th scope="col">Terrain</th>
          <th scope="col">Date</th>
          <th scope="col">From</th>
          <th scope="col">To</th>
          <th scope="col">duration</th>
          <th scope="col">price</th>
        </tr>
      </thead>
    <?php
    while ($ro = mysqli_fetch_assoc($resu)){
      ?>
        <tbody>
          <tr>
            <th class="light" scope="row"><?php echo getUserById($ro['idu'])['username'];?></th>
            <td class="heavy" ><?php echo getTerrainById($ro['idt'])['t_name'];?></td>
            <td class="light"><?php echo $ro['r_date']; ?></td>
            <td class="light"><?php echo substr($ro['startTime'],0,5); ?></td>
            <td class="heavy"><?php echo substr($ro['endTime'],0,5); ?></td>
            <td class="light"><?php echo $ro['duration']; ?></td>
            <td class="heavy"><?php echo $ro['price'];?><strong class="float-right text-right mr-6">MAD</strong></td>
          </tr>
        </tbody>
    <?php  }
            ?>
    </table>
  <?php }else {
    echo "<div class='alert alert-warning'><b>No records yet</b></div>";
  }
}
  ?>
