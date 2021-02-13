<?php include_once (__DIR__ . "/../functions.php") ;?>
<?php
$sq = "SELECT  t_name, description, t_price, t_path FROM terrains WHERE type=? AND city=? ORDER BY t_name";

 if ($stm = mysqli_prepare($db,$sq)) {
   mysqli_stmt_bind_param($stm, "ss", $_GET['type'] ,$_GET['city']);

   mysqli_stmt_execute($stm);

   mysqli_stmt_bind_result($stm, $stdName, $stdDesc, $stdPrice, $stdImagePath);

  $index = 1 ;

  while (mysqli_stmt_fetch($stm)) {?>
    <div id= "showy" class="row showy">
      <div class="col-6 sc cleft">
        <div class="card ">
          <div class="card-body">
            <img class="rounded img-responsive" style="width : 100%; height: 210px ;" src="../images/std/<?php echo $stdImagePath;?>" onerror="this.src = '../images/default/std1.jpg';">
            <h5 class="card-title"><?php echo $stdName ;?></h5>
            <p class="card-text"><?php echo $stdDesc ;?></p>
            <p class="card-text"><?php echo $stdPrice . "DH"; ?> </p>
            <a class="input-radio" onclick="dtpPop()"><input class="checkrad" id="reserve-<?php echo $index;?>" type="radio" name="choy"><label for="reserve-<?php echo $index++;?>">Choose</label></a>
          </div>
        </div>
      </div>
      <?php if (mysqli_stmt_fetch($stm)) { ?>
            <div  class="col-6 sc cright">
              <div class="card">
                <div class="card-body">
                  <img class="rounded img-responsive" style="width : 100%;height: 210px ;" src="../images/std/<?php echo $stdImagePath;?>" onerror="this.src = '../images/default/std2.jpg';">
                  <h5 class="card-title"><?php echo $stdName ;?></h5>
                  <p class="card-text"><?php echo $stdDesc ;?></p>
                  <p class="card-text"><?php echo $stdPrice . "DH"; ?> </p>
                  <a class="input-radio" onclick="dtpPop()"><input class="checkrad" id="reserve-<?php echo $index;?>" type="radio" name="choy"><label for="reserve-<?php echo $index++;?>">Choose</label></a>
                </div>
              </div>
            </div>
        <?php    } ?>
    </div> <?php
      }
  }
   mysqli_stmt_close($stm);
?>
