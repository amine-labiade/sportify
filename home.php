<?php include (__DIR__ . "/functions.php");?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Sportify</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="/datetimepicker/build/jquery.datetimepicker.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <script src="/datetimepicker/build/jquery.datetimepicker.full.min.js"></script>
    <script src="/assets/dynamic.js"></script>
  </head>
  <body>
    <header>
      <div class="row">
        <div class="col-12 align-self-start">

        </div>
      </div>
      <!--<div class="row justify-content-center">
        <div class="holp col-4">
            <ul class="nav nav-pills nav-justified">
              <li class="nav-item rounded mb-1">
                <a class="nav-link hii active" data-toggle="tab" href="#home">Home</a>
              </li>
              <li class="nav-item rounded mb-1">
                <a class="nav-link hii" data-toggle="tab" href="#about">About</a>
              </li>
            </ul>
        </div>
        <div class="col-4">
        </div>
      </div> -->
    </header>
      <!--<div class="tab-content">
        <div id="home" class="tab-pane active"><br> -->
          <main>
            <div class="bar">
              <div class="forms">
                <script src="tog.js"></script>
                <div class="btn-toolbar">
                  <div>
                    <button type="button" class="btn btn-secondary" id="btn_1">Login</button>
                  </div>
                  <div>
                    <button type="button" class="btn btn-secondary" id="btn_2">Register</button>
                  </div>
                </div>
                <div class="login">
                  <form action="home.php" method="post">
                    <div class="form-group">
                      <label>username<input class="form-control" type="text" name="username" placeholder="username" value=""></label>
                    </div>
                    <div class="form-group">
                      <label>password<input class="form-control" type="password" name="password" placeholder="password" value=""></label>
                    </div>
                      <input class="btn btn-primary" type="submit" name="login_btn" value="login">
                  </form>
                </div>
                <div class="register">
                  <form action="home.php" method="post">
                    <div class="form-group">
                      <label>username<input class="form-control" type="text" name="username" placeholder="username" value="<?php echo $username ;?>"></label>
                    </div>
                    <div class="form-group">
                       <label>email<input class="form-control" type="email" name="email" placeholder="email" value="<?php echo $email ;?>"></label>
                    </div>
                    <div class="form-group">
                      <label>password<input class="form-control" type="password" name="password_1" placeholder="password" ></label>
                    </div>
                    <div class="form-group">
                      <label>confirm password<input class="form-control" type="password" name="password_2" placeholder="confirm password"></label>
                    </div>
                    <input class="btn btn-primary" type="submit" name="register_btn" value="register">
                  </form>
                </div>
              </div>
              <script>
                $(function(){
                  $('.notious').fadeOut(3000);
                });
              </script>
              <?php echo display_error(); ?>
              <?php echo register_success(); ?>
              <?php  if(isset($_SESSION['msg'])){
                        ?> <div class="notious alert alert-warning"> <?php echo $_SESSION['msg']; ?></div> <?php
                        unset($_SESSION['msg']);
                      }
               ?>
               <div class="nav flex-column nav-tabs" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                 <a class="nav-link active" id="v-pills-book-tab" data-toggle="pill" href="#v-pills-book" role="tab" aria-controls="v-pills-book" aria-selected="true">Book</a>
                 <a class="nav-link" id="v-pills-views-tab" data-toggle="pill" href="#v-pills-views" role="tab" aria-controls="v-pills-views" aria-selected="false">View Staduims</a>
               </div>
            </div>
            <div class="content">
              <div class="jumbotron big">
                <div class="tab-content" id="v-pills-tabContent">
                  <div class="tab-pane fade show active" id="v-pills-book" role="tabpanel" aria-labelledby="v-pills-book-tab">
                    <form action="#" method="post">
                      <div class="choice">
                        <div class="d-inline-flex flex-row justify-content-between mx-auto">
                          <div class="mr-5">
                            <label for="city">City<label>
                            <select class="form-control selectpicker" id="city" name="city"  onchange="getTypo(this.value);storeCity();">
                              <option value="">--Choose a city--</option>
                              <?php
                              $city = "SELECT DISTINCT `city` FROM `terrains` ORDER BY `city` ";
                              $out = mysqli_query($db,$city);
                              if (mysqli_num_rows($out) > 0) {
                                while ($row = mysqli_fetch_assoc($out)) {
                                  ?><option value= "<?php echo $row['city']?>"><?php echo $row['city']?></option><?php
                                }
                              }
                              ?>
                            </select>
                          </div>
                          <div class="type ml-5">
                            <label for="type">Type<label>
                            <select class="form-control" id="type" name="type" onchange="getSTD(this.value , storeCity())">
                                <option value="">--Choose a type--</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </form>
                    <div class="jumbotron smol rounded" id="showcase">
                      <div class="alert alert-secondary">
                        <strong class="text-success"><h2>Welcome!</h2></strong>
                        <strong class="text-danger">You must login/register to book!</strong>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade  nav-justified" id="v-pills-views" role="tabpanel" aria-labelledby="v-pills-views-tab">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link " id="pills-all-tab" data-toggle="pill" href="#pills-all" role="tab" aria-controls="pills-all" aria-selected="true"><i class="fa fa-eye mr-2"></i>View all</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="pills-bycity-tab" data-toggle="pill" href="#pills-bycity" role="tab" aria-controls="pills-bycity" aria-selected="false"><i class="fa fa-city mr-2"></i>By city</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link active" id="pills-bytype-tab" data-toggle="pill" href="#pills-bytype" role="tab" aria-controls="pills-bytype" aria-selected="false"><i class="fa fa-filter mr-2"></i>By type</a>
                      </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                      <div class="tab-pane fade" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab">
                      <div id="all-viewing" class="alert alert-info">
                        <?php
                        $sq1 = "SELECT  t_name, city, type, description, t_price, t_path FROM terrains ORDER BY t_name";
                        $res1 = mysqli_query($db,$sq1) ;
                        $index = 0;
                        while ($row1 = mysqli_fetch_assoc($res1)) {?>
                          <div class="row">
                            <div class="col-6 cleft">
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
                              <div class="col-6 cleft">
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
                      </div>
                    </div>

                  <div class="tab-pane fade" id="pills-bycity" role="tabpanel" aria-labelledby="pills-bycity-tab">
                    <div class="row justify-content-start">
                    <?php
                    $sql = "SELECT DISTINCT city FROM terrains ORDER BY city";
                    $res = mysqli_query($db,$sql);
                    while($row=mysqli_fetch_assoc($res)){
                      ?>
                      <div class="col-2">
                        <div class="card viewcity text-center">
                          <?php echo $row['city']; ?>
                        </div>
                      </div>
                      <?php
                    }
                     ?>
                    </div>

                      <div id="bycity-viewing" class="alert">
                        Choose a city
                      </div>


                      <script type="text/javascript">

                      $(document).on('click', '.viewcity', function(){
                          var current_city = $(this).text();       // attr('id');
                           $.ajax({
                              url:"/assets/view.php",
                              method:"POST",
                              data:{curCity:current_city},
                              dataType:"html",
                              success: function(data){
                                document.getElementById('bycity-viewing').innerHTML = data;
                              }
                            });
                          });
                      </script>
                    </div>

                    <div class="tab-pane fade show active" id="pills-bytype" role="tabpanel" aria-labelledby="pills-bytype-tab">
                      <div class="row justify-content-start">
                      <?php
                      $sql = "SELECT DISTINCT type FROM terrains ORDER BY type";
                      $res = mysqli_query($db,$sql);
                      while($row=mysqli_fetch_assoc($res)){
                        ?>
                        <div class="col-2">
                          <div class="card viewtype text-center">
                            <?php echo $row['type']; ?>
                          </div>
                        </div>
                        <?php
                      }
                       ?>
                      </div>
                      <div id="bytype-viewing" class="alert">
                        Choose a category
                      </div>

                      <script type="text/javascript">

                        $(document).on('click', '.viewtype', function(){
                            var current_type = $(this).text();       // attr('id');
                             $.ajax({
                                url:"/assets/view.php",
                                method:"POST",
                                data:{curType:current_type},
                                dataType:"html",
                                success: function(data){
                                  document.getElementById('bytype-viewing').innerHTML = data;
                                }
                              });
                            });
                      </script>

                    </div>
                  </div>
                  </div>
                </div>
              </div>
            </div>
          </main>
        </div>
        <!--<div id="about" class="tab-pane fade"><br>
          <main>
            <div class="bar">HI</div>
            <div class="content">HI</div>
          </main>
        </div>-->
      </div>
      <script>
    //prevent form resubmission beautiful too
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
      </script>
    <footer>2020&copy;</footer>
  </body>
</html>
