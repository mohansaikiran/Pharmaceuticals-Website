<?php 
session_start();

$medcode=0;
$errors=array();
$upcode ="";
$newcode="";

require 'vendor/autoload.php';

$client= new MongoDB\Client;
$pharmadb = $client->pharmadb;
$empcollection = $pharmadb->data;


if(isset($_POST['update']))
{
	$medcode=$_POST['medcode'];
	$upcode=$_POST['upcode'];
	$newcode=$_POST['newvalue'];

if (empty($medcode)) 
{ 
array_push($errors, "Medicine code is required"); 
}
if(empty($upcode))
{
	array_push($errors ,"Attribute is required");
}
if(empty($newcode))
{
	array_push($errors ,"New value is required");
}

 if(count($errors)==0)
 {
	 if(strcmp($upcode,"Name")==0)
	 {
	 $query =$empcollection->updateMany(
    ['_id' => $medcode],
    ['$set' =>  ['med_name' => $newcode]]  
  );
   	$_SESSION['success'] = "Successfully updated a medicine";
  	header('location: home.php');
	 }
	 else if(strcmp($upcode,"Composition")==0)
	 {
		 $query =$empcollection->updateMany(
    ['_id' => $medcode],
    ['$set' =>  ['composition' => $newcode]]  
  );

  	$_SESSION['success'] = "Successfully updated a medicine";
  	header('location: home.php');
	 }
	 else if(strcmp($upcode,"Manufacture")==0)
	 {
    
      $query =$empcollection->updateMany(
    ['_id' => $medcode],
    ['$set' =>  ['manufacture' => $newcode]]  
  );
  	$_SESSION['success'] = "Successfully updated a medicine";
  	header('location: home.php');
	 }
	 else if(strcmp($upcode,"Expiry")==0)
	 {
		 $query =$empcollection->updateMany(
    ['_id' => $medcode],
    ['$set' =>  ['expiry' => $newcode]]  
  );
  	$_SESSION['success'] = "Successfully updated a medicine";
  	header('location: home.php');
	 }
	 else
	 {
		 $query =$empcollection->updateMany(
    ['_id' => $medcode],
    ['$set' =>  ['_id' => $newcode]]  
  );
  	$_SESSION['success'] = "Successfully updated a medicine";
  	header('location: home.php');
	 }
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
var id2= document.getElementsByName("upcode");
var id3= document.getElementsByName("newvalue");
if(id1[0].value.length==0&&id2[0].value.length==0&&id3[0].value.length==0)
{
 alert(	"Please enter all details");
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
	<h2>UPDATE A Medicine</h2>
</div>
<form method="post" action="up.php" onSubmit="myfunc()">
   <div class="input-group">
    <label>Enter the Medicine code of the medicine to be updated</label>
   <input type="text" name="medcode" >
  	</div>
	<div class="input-group">
    <label>Enter the parameter of the medicine to be updated</label>
   <input type="text" name="upcode" >
  	</div>
	<div class="input-group">
    <label>Enter the updated value</label>
   <input type="text" name="newvalue" >
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="update">Update</button>
  	</div>
	<a href="home.php">Go back</a>
</form>   

		
</body>
</html>