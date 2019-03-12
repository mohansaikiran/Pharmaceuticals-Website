<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

require 'vendor/autoload.php';

$client= new MongoDB\Client;
$pharmadb = $client->pharmadb;
$empcollection = $pharmadb->empcollection;



// REGISTER USER
if (isset($_POST['register'])) {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password_1 =  $_POST['password_1'];
  $password_2 = $_POST['password_2'];

  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  $result = $empcollection->find(
    ['_id' => $username,'email' => $email]);

  $user = array($result);
  
  $username = isset($_SESSION['username']) ? $_SESSION['username'] : NULL;

  $username = isset($_POST['username']) ? $_POST['username'] : $username;
  $email = isset($_POST['email']) ? $_POST['email'] : NULL;

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {

  	$query = $query = $empcollection->insertOne(
    ['_id' => $username,'email' => $email,'password'=> $password_2]);

  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: home.php');
  }
}
if (isset($_POST['login_user'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	//$password = md5($password);
  	$query = $empcollection->find(
    ['_id' => $username,'password' => $password]);
  	
    if (count($query) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: home.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}
?>


<!DOCTYPE html>
<html>
<head>
<title>User registration</title>
<link rel="stylesheet" type="text/css" href="style.css">
<script type="text/javascript">
function myfunc()
{
var id1= document.getElementsByName("username");
var id2= document.getElementsByName("email");
var id3= document.getElementsByName("password_1");
var id4= document.getElementsByName("password_2");
if(id1[0].value.length==0&&id2[0].value.length==0&&id3[0].value.length==0&&id4[0].value.length==0)
{
 alert(	"Please enter all the details");
 id1.focus();
 return false;
}
if(
if(id3[0].value!=id4[0].value)
{
	alert("Password's do not match");
	return false;
}
else
	return true;
}
</script>
</head>
<body style="background-image:url(medical4.jpg);background-repeat:no-repeat;background-position:center;background-size:cover">
<div class="header">
  <h2>REGISTER</h2>
 </div>
 <form method="post" action="register.php" onSubmit="myfunc()">
 
 <div class="input-group">
  <label>Username</label>
  <input type="text" name="username">
  </div>
  <div class="input-group">
  <label>Email</label>
  <input type="text" name="email">
  </div>
  <div class="input-group">
  <label>Password</label>
  <input type="password" name="password_1">
  </div>
  <div class="input-group">
  <label>Confirm password</label>
  <input type="password" name="password_2">
  </div>
  <div class="input-group">
  <button type="submit" name="register" class="btn">Register</button>
  </div>
  <p>
  Already a member?<a href="login.php">Log in</a>
  </form>
 </body>
 </html>