<?php 
session_start();

$medcode=0;
$errors=array();

require 'vendor/autoload.php';


$client= new MongoDB\Client;
$pharmadb = $client->pharmadb;
$empcollection = $pharmadb->data;


if(isset($_POST['delete']))
{
	$medcode=$_POST['medcode'];

if (empty($medcode)) 
{ 
array_push($errors, "Medicine code is required"); 
}

 if(count($errors)==0)
 {
    $result = $empcollection -> deleteMany(
    ['_id' => $medcode] );

  	$_SESSION['success'] = "Successfully removed a medicine";
  	header('location: home.php');
  }
}
  ?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript">
function myfunc()
{
var id1= document.getElementsByName("medcode");
if(id1[0].value.length==0)
{
 alert(	"Enter medicine code");
 id1.focus();
 return false;
}

else
	return true;
}
</script>
</head>
<body style="background-image:url(medical4.jpg);background-repeat:no-repeat;background-position:center;background-size:cover">

<div class="header">
	<h2>REMOVE A Medicine</h2>
</div>
<form method="post" action="del.php" onSubmit="myfunc()">
   <div class="input-group">
    <label>Enter the Medicine code of the medicine to be removed</label>
   <input type="text" name="medcode" >
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="delete">Delete</button>
  	</div>
	<a href="home.php">Go back</a>
</form>   

		
</body>
</html>