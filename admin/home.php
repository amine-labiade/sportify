<?php
require_once (__DIR__ . '/../functions.php');
require_once (__DIR__ . '/addTerrain.php');

if(!isAdmin()){
  if (isLoggedIn()) {
    $_SESSION['msg'] = "inaccessible";
    header('location: ../user/home.php');
  }else{
    $_SESSION['msg'] = "You must login first";
    header('location: ../index.php');
  }
}

  // log user out if logout button clicked
if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['user']);
  header("location: ../index.php");
}

unset($_SESSION['success']);

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

  </head>
  <body>
    <header>
    </header>
    <main>
      <div class="bar">
        <div class="media">
          <img class="rounded-circle mr-3" src="../images/default/profile.png" onerror="this.src = 'path';">
          <div class="media-body alert alert-success rounded">
            <p>hello! <strong><?php if(isset($_SESSION['user'])) { echo $_SESSION['user']['username']; }?></strong></p>
          </div>
        </div>
        <div class="nav flex-column nav-tabs" id="v-pills-tab" role="tablist" aria-orientation="vertical">
          <a class="nav-link active" id="v-pills-add-tab" data-toggle="pill" href="#v-pills-add" role="tab" aria-controls="v-pills-add" aria-selected="true">Manage Staduim</a>
          <a class="nav-link" id="v-pills-views-tab" data-toggle="pill" href="#v-pills-views" role="tab" aria-controls="v-pills-views" aria-selected="false">View Staduims</a>
          <a class="nav-link" id="v-pills-history-tab" data-toggle="pill" href="#v-pills-history" role="tab" aria-controls="v-pills-history" aria-selected="false">View Reservation History</a>
          <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</a>
        </div>
          <a href="home.php?logout='1'" class="btn btn-danger" role="button">logout</a>
        </div>
      </div>
      <div class="content">
        <div class="jumbotron">
          <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade show active nav-justified" id="v-pills-add" role="tabpanel" aria-labelledby="v-pills-add-tab">

              <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link" id="pills-adds-tab" data-toggle="pill" href="#pills-adds" role="tab" aria-controls="pills-adds" aria-selected="true"><i class="fa fa-plus-circle mr-2"></i>add</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="pills-edits-tab" data-toggle="pill" href="#pills-edits" role="tab" aria-controls="pills-edits" aria-selected="false"><i class="fa fa-edit mr-2"></i>edit</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" id="pills-deletes-tab" data-toggle="pill" href="#pills-deletes" role="tab" aria-controls="pills-deletes" aria-selected="false"><i class="fa fa-minus-circle mr-2"></i>delete</a>
                </li>
              </ul>

              <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade" id="pills-adds" role="tabpanel" aria-labelledby="pills-adds-tab">
                  <div class="alert alert-info">
                    <div class="add-std">
                      <form action="home.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                          <div class="form-group col-4">
                            <label>Staduim name<input class="form-control" type="text" name="terrainName" placeholder="Name" value="" required></label>
                          </div>
                          <div class="form-group col-4">
                            <label>Address<input class="form-control" type="text" name="address" placeholder="address"  value="" required></label>
                          </div>
                          <div class="form-group col-4">
                            <label>City<input class="form-control" type="text" name="city" placeholder="city" value="" required></label>
                          </div>
                          <div class="form-group col-4">
                            <label>Category<input class="form-control" name="category" type="text" placeholder="Category"  value="" required></label>
                          </div>
                          <div class="form-group col-4">
                            <label>Description<input class="form-control" name="description" type="text" placeholder="Description" value="" required></label>
                          </div>
                          <div class="form-group col-4">
                            <label>Price<input class="form-control" name="price" type="number" placeholder="Price" value="" required></label>
                          </div>
                          <div class="custom-file col-6 mx-auto">
                            <input type="file" accept="image/*" class="custom-file-input" name="image" id="imageUp" aria-describedby="image">
                            <label class="custom-file-label" for="imageUp">Choose file...</label>
                          </div>
                          <script>
                              document.querySelector('.custom-file-input').addEventListener('change',function(e){
                              var fileName = document.getElementById("imageUp").files[0].name; /*Solve a bug with bootstrap */
                              var nextSibling = e.target.nextElementSibling;
                              nextSibling.innerText = fileName
                              })
                          </script>
                        </div>
                        <div class="row">
                          <div class="form-group col-4 mx-auto">
                              <input class="btn btn-danger mx-auto mt-3" type="submit" name="add" value="Add!">
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="pills-edits" role="tabpanel" aria-labelledby="pills-edits-tab">

                  <div class="row">
                    <div class="col-3 alert alert-primary ml-3 mb-3">
                      tap a field to start editing :)
                    </div>
                  </div>


                  <div id="editor" class="editor alert alert-primary">
                    <?php
                    $sql = "SELECT `t_name`, `address`, `city`, `type`, `description`, `t_price`, `t_path` FROM `terrains` ORDER BY `t_name`";
                    $res = mysqli_query($db,$sql);
                    ?>
                    <table id="trackchange" class="table table-striped">
                      <thead>
                        <tr>
                          <th scope="col">Image</th>
                          <th scope="col">Name</th>
                          <th scope="col">Address</th>
                          <th scope="col">City</th>
                          <th scope="col">Type</th>
                          <th scope="col">Description</th>
                          <th scope="col">Price (MAD)</th>
                        </tr>
                      </thead>
                      <tbody>
                    <?php
                    $ind = 1;
                    while($row = mysqli_fetch_assoc($res)){

                    ?>
                          <tr>
                            <td> <label for="imgupload<?php echo $ind ;?>"><img class="edt" src="../images/std/<?php echo $row['t_path'];?>" alt="No image"></label> <input class="imgupload" id="imgupload<?php echo $ind++ ;?>" data-id="<?php echo $row['t_name']; ?>"  type="file" accept="image/*" > </td>
                            <th class="align-middle t_name" data-id="<?php echo $row['t_name']; ?>" contenteditable="true" scope="row"><?php echo $row['t_name'];?></th>   <!-- Good One-->
                            <td class="align-middle t_address" data-id="<?php echo $row['t_name']; ?>" contenteditable="true"><?php echo $row['address'];?></td>
                            <td class="align-middle t_city" data-id="<?php echo $row['t_name']; ?>" contenteditable="true"><?php echo $row['city'];?></td>
                            <td class="align-middle t_type" data-id="<?php echo $row['t_name']; ?>" contenteditable="true"><?php echo $row['type'];?></td>
                            <td class="align-middle t_description" data-id="<?php echo $row['t_name']; ?>" contenteditable="true"><?php echo $row['description'];?></td>
                            <td class="align-middle t_price" data-id="<?php echo $row['t_name']; ?>" contenteditable="true"><?php echo $row['t_price'];?></td>
                          </tr>
                      <?php
                    }
                    ?>
                      </tbody>
                    </table>

                    <script>

                    var dota = [];

                    var duta = [];

                    function edit_data(t_name,text,column_name){
                      {
                        $.ajax({
                          url:"edit.php",
                          method:"POST",
                          data:{t_name:t_name, text:text, column_name:column_name},
                          dataType:"text"
                          /*success:function(data){
                          } */
                        });
                      }
                    }

                      $(document).on('change','.imgupload' , function(){
                        var old = window.old_t_tname;
                        window.old_t_tname = $(this).attr('data-id');   //id should be unique to get different value each time (:)
                        var id = $(this).attr('id');
                        var property = document.getElementById(id).files[0];
                        var image_name = property.name;
                        var image_extension = image_name.split('.').pop().toLowerCase();
                        if (jQuery.inArray(image_extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                          alert("Invalid Image File");
                        }
                        var image_size = property.size;
                        if(image_size > 10000000){
                          alert("Image too big friend :)");
                        }else{
                          var form_data = new FormData();
                          form_data.append("file",property);
                          var arr = [];
                          if (old != window.old_t_tname || old == undefined ) {    //a tricksy bug (maybe solved by these conditional statments)
                            arr.push(window.old_t_tname);
                            arr.push(form_data);                //one of the hardest
                            duta.push(arr);
                          }else{
                            arr.pop();
                            arr.pop();
                            arr.push(window.old_t_tname);
                            arr.push(form_data);
                            duta.pop();
                            duta.push(arr);
                          }
                        }
                      });

                    function edit_image(t_name,formData){
                      var objArr = [];
                      objArr.push({"t_name": t_name});
                      //JSON obj
                      formData.append('objArr', JSON.stringify(objArr));  //why JSON.stringify
                      $.ajax({
                        url:"edit_image.php",
                        method:"POST",
                        data:formData,
                        contentType :false,
                        cache:false,
                        processData:false,
                        beforeSend:function(){
                          $("#imgupload").html("<label class='text-success'>Image Uploading...</lable>");
                        }
                        /*success:function(data){
                          $("#imgupload").html(data);
                        } */
                      });
                    }


                    $(document).on('blur', '.t_name', function(){
                       var oldt_tname = $(this).attr('data-id');
                       var t_name = $(this).text();
                       var arr = [oldt_tname , t_name , "t_name"];
                       dota.push(arr);
                    });

                    $(document).on('blur', '.t_address', function(){
                       var oldt_tname = $(this).attr('data-id');
                       var t_address = $(this).text();
                       var arr = [oldt_tname , t_address , "address"];
                       dota.push(arr);
                    });

                    $(document).on('blur', '.t_city', function(){
                       var oldt_tname = $(this).attr('data-id');
                       var t_city = $(this).text();
                       var arr = [oldt_tname , t_city , "city"];
                       dota.push(arr);
                    });

                    $(document).on('blur', '.t_type', function(){
                       var oldt_tname = $(this).attr('data-id');
                       var t_type = $(this).text();
                       var arr = [oldt_tname , t_type , "type"];
                       dota.push(arr);
                    });

                    $(document).on('blur', '.t_description', function(){
                       var oldt_tname = $(this).attr('data-id');
                       var t_description = $(this).text();
                       var arr = [oldt_tname , t_description , "description"];
                       dota.push(arr);
                    });

                    $(document).on('blur', '.t_price', function(){
                       var oldt_tname = $(this).attr('data-id');
                       var t_price = $(this).text();
                       var arr = [oldt_tname , t_price , "t_price"];
                       dota.push(arr);
                       /*edit_data(oldt_tname,t_price,"t_price"); */
                    });


                        document.getElementById("trackchange").addEventListener("input", function() {
                              $("#btn-save").prop('disabled', false);
                              $("#btn-clear").prop('disabled', false);
                          }, false);

                        $(function(){
                          $("#btn-save").prop('disabled', true);
                          $("#btn-clear").prop('disabled', true);
                        });

                        function saveData(array1,array2){    //haha so tricky lol
                          for (var i = 0; i < array2.length; i++) {
                            edit_image(array2[i][0],array2[i][1]);
                          }

                          for (var i = 0; i < array1.length; i++) {
                            edit_data(array1[i][0],array1[i][1],array1[i][2]);
                          }
                          $("#editor").load(location.href+" #editor>*","");


                          alert("changes saved!");
                        }

                        function clearChanges(){   /*  beautiful one */
                                /* $( "#editor" ).load(window.location.href + " #editor" );   DIV duplication issue yo*/
                                $("#editor").load(location.href+" #editor>*","");
                              }

                    </script>
                  </div>
                  <div class="btn-group float-right mr-4">
                    <button id="btn-save" class="btn btn-success" onclick="saveData(dota,duta)">Save</button>
                    <button id="btn-clear" class="btn btn-danger" onclick="clearChanges()">Clear</button>
                  </div>
                </div>
                <div class="tab-pane fade show active" id="pills-deletes" role="tabpanel" aria-labelledby="pills-deletes-tab">
                  <div id="deletor" class="alert alert-info">
                    <div class="row">

                <?php

                $sql = "SELECT t_name FROM terrains ORDER BY t_name";
                $in = 1;
                if($res = mysqli_query($db,$sql)){
                  while ($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <div class="col-4">
                      <input class="checkdelete" type="checkbox" value="<?php echo $row['t_name'];?>" id="delete<?php echo $in ;?>">
                      <label class="card batch-delete checkdelete" for="delete<?php echo $in++ ;?>">
                          <?php echo $row['t_name']; ?>
                      </label>
                    </div>
                    <?php
                  }
                }
                ?>
                    </div>



                    <script>
                    function select_all(){
                      $(function(){
                        $('#batchselect').click(function(){
                          if($('#selectall').is(':checked')) {
                            $('.checkdelete').prop("checked",true);
                          }else{
                            $('.checkdelete').prop("checked",false);
                          }
                        });
                      });
                    }
                    select_all();
                      function delete_std(){
                        var ar = [];

                        if (!($('#selectall').is(':checked'))) {
                          $(".checkdelete:checked").each(function(){
                            ar.push($(this).val());
                          });
                          for (var i = 0; i < ar.length; i++) {
                            var t_name = ar[i];
                            {
                              $.ajax({
                                url:"delete.php",
                                method:"POST",
                                data:{tname:t_name},
                                dataType:"text"
                              });
                            }
                          }
                        }else{
                          $.ajax({
                            url:"delete.php",
                          });
                        }

                        $("#deletor").load(location.href+" #deletor>*","");
                      }
                    </script>

                  </div>

                  <div class="btn-group float-right mt-4 mr-4">
                    <button id="batchselect" class="btn btn-info" style="height:40px">
                      <input type="checkbox" id="selectall">
                      <label for="selectall">Select all</label>
                    </button>
                    <button style="height:40px" class="btn btn-secondary" onclick="delete_std()">Delete</button>
                  </div>
                </div>



              </div>


              <script>

                $(function(){
                  $('.addstd').hide(5000);
                })
              </script>

                  <?php if(isset($flag)){
                          if ($flag) {
                    ?>
                    <div class="addstd alert alert-success">
                      <?php if (isset($_SESSION['std'])){
                         echo $_SESSION['std'];
                      }else {
                        echo $err;
                      } ?>
                    </div><?php
                    }}
                    ?>
              </div>
              <div class="tab-pane fade nav-justified" id="v-pills-views" role="tabpanel" aria-labelledby="v-pills-views-tab">              <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
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
                              <div  id="all-viewing" class="alert alert-info">
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
                      <button class="btn btn-primary" id="go-history" onclick="getHistory()">Go</button>
                      <button class="btn btn-success" id="allhistory" onclick="allhistory()">Show all</button>
                    </div>
                  </div>
                </div>
              </div>
              <div id="history" class="jumbotron smol">
                <script>
                  function allhistory(){
                    {
                      $.ajax({
                        url:"history.php",
                        dataType :"html",
                        success: function (data) {
                                    document.getElementById("history").innerHTML = data;
                            }
                      });
                    }
                  };

                  $(document).on('click','.cancel_btn',function(){
                    var idr = $(this).attr('data-id');
                    $.ajax({
                      url : "cancel.php",
                      method : "POST",
                      data : {idr:idr},
                      dataType:"html",
                      success:function(){
                        $('#go-history').trigger('click');   //simulate click to update records
                        alert("reservation has been canceled !")
                      }
                    });
                      //$("#history").load(location.href+" #history>*","");
                  });

                </script>
              </div>
            </div>
            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
              <div class="alert alert-warning">
                <p>Coming Later  :)</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <footer> 2020&copy; </footer>
    <script>
  //prevent form resubmission
      if ( window.history.replaceState ) {
          window.history.replaceState( null, null, window.location.href );
      }
    </script>
    <script src="../datetimepicker/build/jquery.datetimepicker.full.min.js"></script>
    <script src="../dtpset.js"></script>
    <script src="history.js"></script>

  </body>
</html>
