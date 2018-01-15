<?php
session_start();
if(!isset($_SESSION['adminId']))
{
	header('location: ../admin');
}
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

	<div class="list-group">
		<?php
		include '../dbgmsa.php';
		$yearfilter = $_SESSION['adminyear'];
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
		<a href="#" class="list-group-item active">Total number of users <span class="badge"><?php echo $total; ?></span></a>
		<a href="#" class="list-group-item ">Total number of males <span class="badge"><?php echo $males; ?></span></a>
		<a href="#" class="list-group-item active">Total number of females <span class="badge"><?php echo $females; ?></span></a>
		<!--<a href="#" class="list-group-item a">Reports <span class="badge">5</span></a>-->
	</div>

	<div class="container" style="width: 100%">
		<a href="addinfo.php"><button type="button" style="width: 49%" class="btn btn-warning" name="button">Add info</button></a>
		<button type="button" style="width: 49%" class="btn btn-danger disabled" name="button">Edit info</button>
		<!--<a href="finduser.php"><button type="button" style="width: 49%;margin-top:5px" class="btn btn-dark" name="button">Find User</button></a>-->
	</div>
	<br>
	<div class="container">
	<a href="logout.php"><button type="button" class=" form-control btn btn-success" name="button">Logout</button></a>
</div>




	</body>

</html>
