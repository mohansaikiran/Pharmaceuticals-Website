<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body style="background-image:url(medical4.jpg);background-repeat:no-repeat;background-position:center;background-size:cover">

<div class="header">
	<h2>ADMIN-Home Page</h2>
</div>
<form>
<div>
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
    	<div class="input-group">
		 <img src="admin.jpg" height="35px" width="30px"/>Welcome <strong><?php echo $_SESSION['username']; ?></strong>
		</div>
		<p>Select any one of below operations</p><br/>
		<ul>
		  <li><p><a href="add.php"/>Add a medicine-</p></li><br/>
 
          <li><p><a href="search.php" />Search for a medicine</p></li><br/>
		  
		  <li><p><a href="del.php"/>Delete a medicine</p></li><br/>
 
          <li><p><a href="up.php" />Update a medicine</p></li><br/>
		  
		  <li><p><a href="allview1.php" />View all medicines</p></li><br/>
        </ul>
		<div class="input-group">
    	<p> <a href="home.php?logout='1'" style="color: red;">logout</a> </p>
		</div>
    <?php endif ?>
</div>
</form>		
</body>
</html>