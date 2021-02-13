<?php
include_once(__DIR__ . "/../functions.php");


if (isset($_POST['curType'])) {
  $curType = e($_POST['curType']);

?>

    <?php
    $sq1 = "SELECT  t_name, city, type, description, t_price, t_path FROM terrains WHERE type='$curType' ORDER BY t_name";
    $res1 = mysqli_query($db,$sq1) ;
    $index = 0;
    while ($row1 = mysqli_fetch_assoc($res1)) {?>
      <div class="row">
        <div class="col-md-6 cleft">
          <div class="card ">
            <div class="card-body">
              <img class="rounded img-responsive" style="width : 100%; height: 210px ;" src="../images/std/<?php echo $row1['t_path'];?>" onerror="this.src = '../images/default/std1.jpg';">
              <h5 class="card-title mt-2"><?php echo $row1['t_name'];?></h5>
              <p class="card-text"><?php echo $row1['city'];?></p>
              <p class="card-text"><?php echo $row1['description'];?></p>
              <p class="card-text"><?php echo $row1['t_price'] . "DH";?></p>
            </div>
          </div>
        </div>
        <?php if ($row1 = mysqli_fetch_assoc($res1)) { ?>
          <div class="col-md-6 cleft">
            <div class="card ">
              <div class="card-body">
                <img class="rounded img-responsive" style="width : 100%; height: 210px ;" src="../images/std/<?php echo $row1['t_path'];?>" onerror="this.src = '../images/default/std1.jpg';">
                <h5 class="card-title mt-2"><?php echo $row1['t_name'];?></h5>
                <p class="card-text"><?php echo $row1['city'];?></p>
                <p class="card-text"><?php echo $row1['description'];?></p>
                <p class="card-text"><?php echo $row1['t_price'] . "DH";?></p>
              </div>
            </div>
          </div>
          <?php    } ?>
      </div> <?php
    } ?>

<?php
unset($_POST['curType']);
}



if (isset($_POST['curCity'])) {
  $curCity = e($_POST['curCity']);

?>

    <?php
    $sq1 = "SELECT  t_name, city, type, description, t_price, t_path FROM terrains WHERE city='$curCity' ORDER BY t_name";
    $res1 = mysqli_query($db,$sq1) ;
    $index = 0;
    while ($row1 = mysqli_fetch_assoc($res1)) {?>
      <div class="row">
        <div class="col-md-6 cleft">
          <div class="card ">
            <div class="card-body">
              <img class="rounded img-responsive" style="width : 100%; height: 210px ;" src="../images/std/<?php echo $row1['t_path'];?>" onerror="this.src = '../images/default/std1.jpg';">
              <h5 class="card-title mt-2"><?php echo $row1['t_name'];?></h5>
              <p class="card-text"><?php echo $row1['type'];?></p>
              <p class="card-text"><?php echo $row1['description'];?></p>
              <p class="card-text"><?php echo $row1['t_price'] . "DH";?></p>
            </div>
          </div>
        </div>
        <?php if ($row1 = mysqli_fetch_assoc($res1)) { ?>
          <div class="col-md-6 cleft">
            <div class="card ">
              <div class="card-body">
                <img class="rounded img-responsive" style="width : 100%; height: 210px ;" src="../images/std/<?php echo $row1['t_path'];?>" onerror="this.src = '../images/default/std1.jpg';">
                <h5 class="card-title mt-2"><?php echo $row1['t_name'];?></h5>
                <p class="card-text"><?php echo $row1['type'];?></p>
                <p class="card-text"><?php echo $row1['description'];?></p>
                <p class="card-text"><?php echo $row1['t_price'] . "DH";?></p>
              </div>
            </div>
          </div>
          <?php    } ?>
      </div> <?php
    } ?>

<?php
unset($_POST['curCity']);
}

 ?>
