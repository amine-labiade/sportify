 <?php include_once(__DIR__ . '/../functions.php');


  if(!isLoggedIn()){
    $_SESSION['msg'] = "you must login first";
    header('location: ../index.php');
    }


  if (isset($_SESSION['data'])) {
    unset($_SESSION['data']);
    }

  // log user out if logout button clicked
if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['user']);
  header("location: ../index.php");
  }

$_SESSION['success']
?>
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
    <link rel="stylesheet" type="text/css" href="../datetimepicker/build/jquery.datetimepicker.min.css">
    <link rel="stylesheet" href="../css/style.css">





    <script src="../datetimepicker/build/jquery.datetimepicker.full.min.js"></script>
    <script src="../assets/dynamic.js"></script>
  </head>

  <body>
    <header>


    </header>
    <main>
      <div class="bar">
        <div class="media">
          <img class="rounded-circle mr-3" src= "../images/default/profile.png" onerror="this.src = 'path';">
          <div class="media-body alert alert-success rounded">
            <p>hello! <strong><?php if(isset($_SESSION['user'])) { echo $_SESSION['user']['username'] ; }?></strong></p>
          </div>
        </div>
        <?php  if(isset($_SESSION['user'])){if(isset($_SESSION['msg'])) {
          ?> <div class="alert alert-warning"> <?php echo $_SESSION['msg'];  ?> </div><?php
        }
          unset($_SESSION['msg']); } ;?>
        <script>
          $(function(){
            $('.alert-warning').hide(2000);
          });
        </script>
        <div class="nav flex-column nav-tabs" id="v-pills-tab" role="tablist" aria-orientation="vertical">
          <a class="nav-link" id="v-pills-book-tab" data-toggle="pill" href="#v-pills-book" role="tab" aria-controls="v-pills-book" aria-selected="true">Book</a>
          <a class="nav-link active" id="v-pills-views-tab" data-toggle="pill" href="#v-pills-views" role="tab" aria-controls="v-pills-views" aria-selected="false">View Staduims</a>
          <a class="nav-link" id="v-pills-history-tab" data-toggle="pill" href="#v-pills-history" role="tab" aria-controls="v-pills-history" aria-selected="false">View reservation history</a>
          <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</a>
        </div>
        <div>
          <a href="/user/home.php?logout='1'" class="btn btn-danger" role="button">logout</a>
        </div>
      </div>
      <div class="content">
        <div class="jumbotron big">
          <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade" id="v-pills-book" role="tabpanel" aria-labelledby="v-pills-book-tab">
              <form action="#" method="post">
                <div class="choice">
                  <div class="d-inline-flex flex-row justify-content-between mx-auto">
                    <div class="mr-5">
                      <label for="city">City<label>
                      <select class="form-control mr-10" id="city" name="city" onchange="getTypo(this.value);storeCity();">
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
                      <select class="form-control ml-10" id="type" name="type" onchange="getSTD(this.value , storeCity())">
                        <option value="">--Choose a type--</option>
                      </select>
                    </div>
                  </div>
                </div>
              </form>
              <div class="jumbotron smol rounded" id="showcase">
              </div>
            </div>
            <div class="tab-pane fade show active nav-justified" id="v-pills-views" role="tabpanel" aria-labelledby="v-pills-views-tab">
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
              <div id="bycity-viewing" class="alert alert-info">
                Choose a city
              </div>

                <script type="text/javascript">

                $(document).on('click', '.viewcity', function(){
                    var current_city = $(this).text();       // attr('id');
                     $.ajax({
                        url:"/../assets/view.php",
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
                <div id="bytype-viewing" class="alert alert-info">
                  Choose a category
                </div>

                <script type="text/javascript">

                  $(document).on('click', '.viewtype', function(){
                      var current_type = $(this).text();       // attr('id');
                       $.ajax({
                          url:"/../assets/view.php",
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
            <div class="tab-pane fade" id="v-pills-history" role="tabpanel" aria-labelledby="v-pills-history-tab">
              <div class="alert alert-info">
                <div class="OutOfNames row">
                  <div class="col-4"></div>
                  <div class="col-4">
                    <input class="form-control datetimepicker d-inline-flex p-2" class="datetimepicker" id="dtpy" type="text" name=""  autocomplete="off">
                  </div>
                  <div class="col-4">
                    <div class="btn-group">
                      <button class="btn btn-primary" id="goe-history" onclick="getUserHistory()">Go</button>
                      <button class="btn btn-success" id="allhistory" onclick="allUserhistory()" >Show all</button>
                    </div>
                  </div>
                </div>
              </div>
              <div id="user-history" class="jumbotron smol"></div>

              <script>
                function getUserHistory(){
                  var a = $('#dtpy').datetimepicker('getValue');
                  r_date = a.getFullYear()+"-"+(a.getMonth()+1)+"-"+a.getDate();
                  {
                    $.ajax({
                      url:"user_history.php",
                      method:"POST",
                      data:{res_date:r_date},
                      dataType :"html",
                      success: function (data) {
                                  document.getElementById("user-history").innerHTML = data;
                                }
                    });
                  }
                }
                function allUserhistory(){
                  {
                    $.ajax({
                      url:"user_history.php",
                      dataType :"html",
                      success: function (data) {
                                  document.getElementById("user-history").innerHTML = data;
                                }
                    });
                  }
                }

                $(document).on('click','.req_cancel',function(){
                  var idr = $(this).attr('data-id');
                  $.ajax({
                    url : "request_cancel.php",
                    method : "POST",
                    data : {idr:idr},
                    dataType:"html",
                    success:function(){
                      $('#goe-history').trigger('click');   //simulate click to update records
                      alert("Cancellation request has been submitted!");
                    }
                  });
                    //$("#user-history").load(location.href+" #user-history>*","");
                });
              </script>

            </div>
            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
              <p>Coming later <3 (°!°)</p>
            </div>
          </div>
        </div>
      </div>
    </main>
    <footer>2020&copy;</footer>
    <script src="../datetimepicker/build/jquery.datetimepicker.full.min.js"></script>
    <script src="../dtpset.js"></script>

    <script>
      $(document).on('click','#email-receipt',function(){
          $.ajax({
            url:"../assets/email.php",
            success:function(data){
              getElementById("email-feedback").innerHTML = '<div class="alert alert-success">Email Sent !</div>';
            }
          });
      });

      function return_home(){   /*  beautiful one */
              /* $( "#editor" ).load(window.location.href + " #editor" );   DIV duplication issue yo*/
              $("#v-pills-book").load(location.href+" #v-pills-book>*","");
            }

    </script>



    <script>
  //prevent form resubmission beautiful too
      if ( window.history.replaceState ) {
          window.history.replaceState( null, null, window.location.href );
      }
    </script>
  </body>
</html>
