<?php 
session_start();

require 'vendor/autoload.php';

$client= new MongoDB\Client;
$pharmadb = $client->pharmadb;
$empcollection = $pharmadb->data;

// initializing variables
$medcode = 0;
$medname = "";
$composition = "";
$mandate = "";
$expdate = "";
$mandate1 = "";
$expdate1 = "";
$errors = array(); 

// REGISTER USER
if (isset($_POST['add'])) {
  // receive all input values from the form
  $medcode = $_POST['medcode'];
  $medname = $_POST['medname'];
  $composition = $_POST['composition'];
  $mandate = $_POST['mandate'];
  $expdate = $_POST['expdate'];

  if (empty($medcode)) { array_push($errors, "Medicine code is required"); }
  if (empty($medname)) { array_push($errors, "Medicine name is required"); }
  if (empty($composition)) { array_push($errors, "Composition is required"); }
  if (empty($mandate)) { array_push($errors, "Manufacture date is required"); }
  if (empty($expdate)) { array_push($errors, "Expiry date is required"); }
  
  $result = $empcollection->findOne(
     ['_id' => $medcode]
 );

  $medicine = array($result);
  
  if ($medicine) { // if user exists
    if ($medicine['_id'] == $medcode) {
      array_push($errors, "Medicine already exists");
    }
  }

  if (count($errors) == 0) {
    
  	$query = $empcollection->insertOne(
    ['_id' => $medcode,'med_name' => $medname,'composition' => $composition,'manufacture'=> $mandate,'expiry' => $expdate] );

  	$_SESSION['success'] = "Successfully added a medicine";
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
var id2= document.getElementsByName("medname");
var id3= document.getElementsByName("composition");
var id4= document.getElementsByName("mandate");
var id5= document.getElementsByName("expdate");
if(id1[0].value.length==0&&id2[0].value.length==0&&id3[0].value.length==0&&id4[0].value.length==0&&id5[0].value.length==0)
{
 alert(	"Please enter all the details");
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
	<h2>ADD A Medicine</h2>
</div>
<form method="post" action="add.php" onSubmit="myfunc()">
   <div class="input-group">
    <label>Medicine code</label>
   <input type="text" name="medcode" >
  	</div>
  	<div class="input-group">
  		<label>Medicine name</label>
  		<input type="text" name="medname">
  	</div>
  	<div class="input-group">
  		<label>Composition</label>
  		<input type="text" name="composition">
  	</div>
	<div class="input-group">
	    <label>Manufacture date</label>
		<input type="text" name="mandate">
	</div>
	<div class="input-group">
	    <label>Expiry date</label>
		<input type="text" name="expdate">
	</div>
    <div class="input-group">
  		<button type="submit" class="btn" name="add">Add</button>
  	</div>
	<a href="home.php">Go back</a>
</form>   

		
</body>
</html>