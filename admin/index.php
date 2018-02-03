<?php
session_start();
if(isset($_SESSION['adminId']))
{
	header('location: cpanel.php');
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

	<div class="form-container">
	<div class="marginh-10p marginv-5p">
	<center><h3 style="font-family:monospace;">Administrators Only</h3></center><BR />
	<?php
	include '../dbgmsa.php';


	if(isset($_POST['go']))
	{
		// getting data from user input
		$phone = stripcslashes(htmlentities(trim($_POST['phone-email'])));
		$pass = stripcslashes(htmlentities(trim(md5($_POST['pass']))));

		// checking if data is valid
		$query = "SELECT * FROM admins WHERE `phone-email`='$phone' AND pass='$pass'";

		$check = $connect->query($query);
		$rows = mysqli_num_rows($check);
		if($rows == 1)
		{
			while($fetch = $check->fetch_assoc())
			{
				$_SESSION['adminName'] = $fetch['fullname'];
				$_SESSION['adminId'] = $fetch['adminId'];
				$_SESSION['adminContact'] = $fetch['phone-email'];
				$_SESSION['adminyear'] = $fetch['year'];
				$_SESSION['admintype'] = $fetch['type'];

				header('location: cpanel.php');
			}

		}else{
			echo "<div class='alert alert-danger'>Phone/Email or Password Invalid!</div>";
		}


	}
	else
	{
		$phone = null;
	}

	?>
	<form action="index.php" method="POST" >
		<input class="form-control" placeholder=" PHONE or EMAIL" value="<?php echo $phone; ?>" name="phone-email" type="text" /><BR />
		<input class="form-control" placeholder=" PASSWORD" name="pass" type="password" /><BR />
		<!--<a href="#">Forgot password?</a><BR /><BR />-->
		<button class="btn btn-primary" name="go" type="submit">Log me In</button></button></button>
	<form/>

	<HR>
	<center><h4><a style="text-decoration: none" href="create.php">| Create new |</a></h4></center>
		<div class="clear"></div>
	</div>

	</div>

	</body>

</html>
