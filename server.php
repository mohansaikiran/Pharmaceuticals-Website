<?php

require 'vendor/autoload.php';

session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
//$db = mysqli_connect('localhost', 'root', '', 'registration');


$client= new MongoDB\Client;
$pharmadb = $client->pharmadb;
$empcollection = $pharmadb->empcollection;


// REGISTER USER
if (isset($_POST['register'])) {
  // receive all input values from the form
  $username =  $_POST['username'];
  $email = $_POST['email'];
  $password_1 = $_POST['password_1'];
  $password_2 = $_POST['password_2'];

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $result = $empcollection->find(
    ['username' => $username,'email' => $email]);

  //"SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";


  //$result = mysqli_query($pharmadb, $user_check_query);
  $user = array($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['password'] === $password) {
      array_push($errors, "Password already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	//$password = md5($password_1);//encrypt the password before saving in the database

  	$query = $empcollection->insertOne(
    ['username' => '$username','email' => '$email','password'=> '$password']);

    //"INSERT INTO users (username, email, password) 
  		//	  VALUES('$username', '$email', '$password_1')";
  	//mysqli_query($db, $query);


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
  	$query =  $empcollection->find(
    ['username' => $username,'password' => $password]);
    //"SELECT * FROM users WHERE username='$username' AND password='$password'";
  	//$results = mysqli_query($db, $query);

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
