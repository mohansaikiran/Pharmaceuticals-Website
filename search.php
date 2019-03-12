

<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript">
function myfunc()
{
var id1= document.getElementsByName("medname");
if(id1[0].value.length==0)
{
 alert(	"Please enter the medicine name");
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
	<h2>SEARCH A Medicine</h2>
</div>
<form method="post" action="search1.php" onSubmit="myfunc()">
   <div class="input-group">
    <label>Enter the Name of the medicine to be searched</label>
   <input type="text" name="medname" >
  	</div>
	<div class="input-group">
  		<button type="submit" class="btn" name="search">Search</button>
  	</div>
	<a href="home.php">Go back to home page?</a>
</form>   
</body>
</html>