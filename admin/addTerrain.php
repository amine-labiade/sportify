<?php
 include_once (__DIR__ . '/../functions.php');
 if(isset($_POST['add'])){

   $flag = true;

   $terrainName =e(ucfirst($_POST['terrainName'])) ;
   $address = e(ucfirst($_POST['address'])) ;
   $city = e(ucfirst($_POST['city'])) ;
   $category = e(ucfirst($_POST['category'])) ;
   $description = e(ucfirst($_POST['description'])) ;
   $price = e($_POST['price']);

   $image = $_FILES['image'];
   $imageName = $_FILES['image']['name'];
   $imageTmp =$_FILES['image']['tmp_name'];
   $imageSize =$_FILES['image']['size'];
   $imageError =$_FILES['image']['error'];
   $imageType =$_FILES['image']['type'];

   $imageExt = explode('.',$imageName);
   $imageActualExt = strtolower(end($imageExt));
   $firstWord = (explode(' ',$terrainName))[0];

   $allowedExt =array('jpg' , 'jpeg' , 'png' );

   if (in_array($imageActualExt, $allowedExt)) {
     if ($imageError === 0) {
       if ($imageSize < 10000000) {
         $imageNameNew = uniqid('',true) .$firstWord . "." . $imageActualExt;
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

   $imageDest = e($imageDest) ;

   $query = "INSERT INTO terrains ( t_name , address, city, type, description, t_price, t_path) VALUES ('$terrainName', '$address', '$city', '$category' ,'$description', '$price','$imageNameNew')";
   if(mysqli_query($db,$query)){
   $_SESSION['std']="Staduim added successfuly!";
 }else {
   echo "internal error";
 }
   unset($_GET['add']);
 }


//tips and tricks
// enctype
// " " to retrieve full value ....

 ?>
