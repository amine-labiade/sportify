<?php
include_once (__DIR__ . '/../functions.php');


if(isset($_FILES['file']['name'])){

  $image = $_FILES['file'];
  $imageName = $_FILES['file']['name'];
  $imageTmp =$_FILES['file']['tmp_name'];
  $imageSize =$_FILES['file']['size'];
  $imageError =$_FILES['file']['error'];
  $imageType =$_FILES['file']['type'];

  if (isset($_POST['objArr'])) {
    $terrainName = (json_decode($_POST['objArr'],true)[0]['t_name']);   //one of the trickiest!
    $idt = getTerrainId($terrainName);
  }


  $imageExt = explode('.',$imageName);
  $imageActualExt = strtolower(end($imageExt));
  $firstWord = (explode(' ',$terrainName))[0];
  
  $allowedExt =array('jpg' , 'jpeg' , 'png' );

  if (in_array($imageActualExt, $allowedExt)) {
    if ($imageError === 0) {
      if ($imageSize < 10000000) {
        $imageNameNew = uniqid('',true) .$firstWord . "." . $imageActualExt;
        echo $imageNameNew;
        $imageDest = __DIR__ . "/../images/std/" . $imageNameNew;
        move_uploaded_file($imageTmp,$imageDest);
      }else{
        $err =  "image is too big!";
      }
    }else{
      $err =  "there was an error uploading the image";
    }
  }else{
    $err = "file type unsuported!";
  }


  $sq = "SELECT t_path FROM terrains WHERE idt='" . $idt ."'";
  $res = mysqli_query($db,$sq);
  $img_path = mysqli_fetch_assoc($res);
  unlink(__DIR__ . "/../images/std/" . $img_path['t_path']); //deletes image from server

  $imageNameNew = e($imageNameNew) ;

  $query = "UPDATE terrains SET t_path='".$imageNameNew."' WHERE idt='".$idt."'";;

  if(mysqli_query($db,$query)){
  echo "Staduim image edited successfuly!";
}else {
  echo "internal error";
}
  unset($_POST['objArr']);
  unset($_FILES['file']);
}
?>
