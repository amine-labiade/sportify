<?php
  session_start();
  $db = mysqli_connect('localhost','root','aqwxsz','GC2SP');

  $username = "";
  $email = "";
  $errors = array();

  if (isset($_POST['register_btn'])) {
    register();
    unset($_POST['register_btn']);
  }

  function register(){
    global $db, $username, $email, $errors;

    $username = e($_POST['username']);
    $email = e($_POST['email']);
    $password_1 = e($_POST['password_1']);
    $password_2 = e($_POST['password_2']);

    if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($password_1)) { array_push($errors, "Password is required"); }
    if ($password_1 != $password_2) {array_push($errors, "The  passwords do not match"); }

    // first check the database to make sure
    // a user does not already exist with the same username and/or email
    if (count($errors)==0) {
      $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
      $result = mysqli_query($db, $user_check_query);
      $user = mysqli_fetch_assoc($result);

      if ($user) { // if user exists
        if ($user['username'] === $username) {
          array_push($errors, "Username already exists");
        }

        if ($user['email'] === $email) {
          array_push($errors, "email already exists");
        }
      }
    }


    // register user if there are no errors in the form
    if (count($errors) == 0) {
      $pass = $password_1;
      $password = md5($pass);//encrypt the password before saving in the database

      $query = "INSERT INTO users (username, email, user_type, password) VALUES('$username', '$email', 'user', '$password')";
      mysqli_query($db, $query);

      // get id of the created user
/*
      //$logged_in_user_id = mysqli_insert_id($db);

      //$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
      //$_SESSION['success']  = "You are now logged in";    (to be seen later)*/
      $_SESSION['successr'] = "user registered!";
      header('location: index.php');
    }
  }

 ///////////////////////////////////////////////////////*               */

if (isset($_POST['login_btn'])) {
   login();
   unset($_POST['login_btn']);
 }


 function login(){
   global $db,$username,$errors;

   $username = e($_POST['username']);
   $password = e($_POST['password']);

   if (empty($username)) { array_push($errors,"username is required");}
   if (empty($password)) { array_push($errors,"password is required");}

   if (count($errors) == 0 ) {
     $password = md5($password);

     $query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
     $results = mysqli_query($db,$query);
     if (mysqli_num_rows($results) == 1) {
       $logged_in_user = mysqli_fetch_assoc($results);
       if ($logged_in_user['user_type'] == 'admin') {
         $_SESSION['user'] = $logged_in_user ;
         $_SESSION['success'] = "You are now logged in" ;
         header('location: admin/home.php');
       }else{
         $_SESSION['user'] = $logged_in_user;
         $_SESSION['success'] = "you're logged in";
         header('location: user/home.php');
       }
     }else{
       array_push($errors,"Wrong username/password combination");
     }
   }
 }


//////////////////////////////////////////////////////////////////////

  // return user array from their id
  function getUserById($id){
  	global $db;
  	$query = "SELECT * FROM users WHERE idu=" . $id;
  	$result = mysqli_query($db, $query);

  	$user = mysqli_fetch_assoc($result);
  	return $user;
  }

  function getTerrainId($str){
    global $db;
    $query = "SELECT idt FROM terrains WHERE t_name='$str' LIMIT 1";
    $result = mysqli_query($db, $query);

    $what = mysqli_fetch_assoc($result);
    $idt = $what['idt'];
    return $idt;
  }



  function getTerrainById($id){
    global $db;
    $query = "SELECT * FROM terrains WHERE idt=" . $id;
    $result = mysqli_query($db, $query);

    $terrain = mysqli_fetch_assoc($result);
    return $terrain;
  }

  function isLoggedIn(){
	   if (isset($_SESSION['user'])) {
		     return true;
	      }else{
		        return false;
	         }
      }

      // ...
  function isAdmin(){
  	if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {
  		return true;
  	}else{
  		return false;
  	}
  }



  function e($val){
  	global $db;
  	return mysqli_real_escape_string($db, trim($val));
  }

  function display_error() {
  	global $errors;

  	if (count($errors) > 0){
      foreach ($errors as $error){
  		    echo '<div class="notious alert alert-danger">';
  				echo $error .'</div>';
      }
  	}
  }

  function register_success(){
      if(isset($_SESSION['successr'])) : ?>
        <div class="alert alert-success">
          <?php echo $_SESSION['successr'];?>
        </div>
      <?php unset($_SESSION['successr']);
    endif;
  }
 ?>
