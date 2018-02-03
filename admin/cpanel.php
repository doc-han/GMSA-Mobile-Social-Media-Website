<?php
session_start();
if(!isset($_SESSION['adminId']))
{
	header('location: ../admin');
}

$adminType = trim($_SESSION['admintype']);
?>
<!DOCTYPE HTML>
<html>
	<head>

	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<!--linking css files-->
	<link rel="stylesheet" href="../extra/css/bootstrap.min.css" />
	<link rel="stylesheet" href="../extra/css/mystyle.css" />

		<title>
			Admin Login
		</title>
	</head>

	<body class="main-body" >

	<?php include 'header.php';?>

		<?php
		include '../dbgmsa.php';
		$yearfilter = $_SESSION['adminyear'] - 2;//this is because admin year is greater than users year for a group
		//getting total number of users
		$getTotal = $connect->query("SELECT id FROM users WHERE year='$yearfilter'");
		$total = mysqli_num_rows($getTotal);
		//getting total number of males
		$getMales = $connect->query("SELECT id FROM users WHERE gender='male' AND year='$yearfilter'");
		$males = mysqli_num_rows($getMales);
		//getting total number of females
		$getFemales = $connect->query("SELECT id FROM users WHERE gender='female' AND year='$yearfilter'");
		$females = mysqli_num_rows($getFemales);

		?>
		<table class="table table-striped">
		  <tbody>
		    <tr>
		      <td><b>Total number of users</b></td>
		      <td><?php echo $total; ?></td>
		    </tr>
				<tr>
		      <td><b>Total number of males</b></td>
		      <td><?php echo $males; ?></td>
		    </tr>
				<tr>
		      <td><b>Total number of females</b></td>
		      <td><?php echo $females; ?></td>
		    </tr>
			</tbody>
		</table>

	<div class="container" style="width: 100%">
		<?php
if($adminType == 1){
	echo '<a href="addinfo.php"><button type="button" style="width: 49%" class="btn btn-warning" name="button">Add info</button></a>';
	echo '<a href="infolist.php"><button type="button" style="width: 49%" class="btn btn-danger  pull-right" name="button">Edit info</button></a>';
	echo '<a href="select.php"><button type="button" style="margin-top:10px" class="form-control btn btn-primary" name="button">Select Executives</button></a>';
}else if($adminType == 2){
	echo '<a href="addinfo.php"><button type="button" style="width: 49%" class="btn btn-warning" name="button">Add info</button></a>';
	echo '<a href="infolist.php"><button type="button" style="width: 49%" class="btn btn-danger  pull-right" name="button">Edit info</button></a>';
	echo '<a href="addmem.php"><button type="button" style="margin-top:10px" class="form-control btn btn-info" name="button">Add memories</button></a>';
}else if($adminType == 3){
	echo '<a href="addmem.php"><button type="button" style="width: 49%" class="btn btn-info" name="button">Add memories</button></a>';
	echo '<a href="infolist.php"><button type="button" style="width: 49%" class="btn btn-danger  pull-right" name="button">Edit info</button></a>';
	echo '<a href="upload.php"><button type="button" style="margin-top:10px" class=" form-control btn btn-primary" name="button">Upload minutes</button></a>';
}else{
	// I've got nothing to do here.
	echo "Not a real admin";
}
		?>
		<!--<a href="addinfo.php"><button type="button" style="width: 49%" class="btn btn-warning" name="button">Add info</button></a>
		<button type="button" style="width: 49%" class="btn btn-danger disabled" name="button">Edit info</button>

		<a href="#"><button type="button" style="width: 49%;margin-top:10px" class="btn btn-info" name="button">Add memories</button></a>
		<a href="#"><button type="button" style="width: 49%;margin-top:10px" class="btn btn-dark" name="button">Select Executives</button></a>
		<a href="#"><button type="button" style="margin-top:10px" class=" form-control btn btn-primary" name="button">Uploads minutes</button></a>-->
	</div>
	<br>
	<div class="container">
	<a href="logout.php"><button type="button" class=" form-control btn btn-success" name="button">Logout</button></a>
</div>




	</body>

</html>
