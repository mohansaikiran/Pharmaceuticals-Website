<?php

   require 'vendor/autoload.php';

$client= new MongoDB\Client;
$pharmadb = $client->pharmadb;
$empcollection = $pharmadb->data;

   ?>

<!DOCTYPE html>
<html>
<head>
<title>Admin</title>
<style>
table, th, td {
    border: 1px solid black;
}
.header {
  width: 30%;
  margin: 50px auto 0px;
  color: white;
  background: #5F9EA0;
  text-align: center;
  border: 1px solid #B0C4DE;
  border-bottom: none;
  border-radius: 10px 10px 0px 0px;
  padding: 20px;
}
</style>
</head>
<body style="background-image:url(medical4.jpg);background-repeat:no-repeat;background-position:center;background-size:cover">
<div class="header">
	<h2>VIEW ALL Medicines</h2>
</div>
<body>

<table align="center">
	<thead>
		<tr>
			<th>Medicine code</th>
			<th>Medicine name</th>
			<th>Composition</th>
			<th>Manufacture date</th>
			<th>Expiry date</th>
			
		</tr>
	</thead>
	
	<?php 

	$query=array();
	$result = $empcollection->find($query);

	foreach($result as $doc => $row){
	}
		?>
		<tr>
			<td>

				<?php 
					$query=array();
					$result = $empcollection->find($query);

					foreach($result as $doc => $row){
						echo $row['_id'];
						echo "<br>";
					}  
				?>	
			</td>

			<td><?php 
					$query=array();
					$result = $empcollection->find($query);

					foreach($result as $doc => $row){
						echo $row['med_name'];
						echo "<br>";
					}  
				?>
					
			</td>

			<td><?php 
					$query=array();
					$result = $empcollection->find($query);

					foreach($result as $doc => $row){
						echo $row['composition'];
						echo "<br>";
					}  
				?>
					
				</td>
			<td><?php 
					$query=array();
					$result = $empcollection->find($query);

					foreach($result as $doc => $row){
						echo $row['manufacture'];
						echo "<br>";
					}  
				?></td>
			<td><?php 
					$query=array();
					$result = $empcollection->find($query);

					foreach($result as $doc => $row){
						echo $row['expiry'];
						echo "<br>";
					}  
				?></td>
			
		</tr>
	
</table>
<a href="home.php">Go back to home page?</a>
</body>
</html>