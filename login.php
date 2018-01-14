<?php
session_start();
if(isset($_SESSION['userId']))
{
	header('location: index.php');
}


?>
<!DOCTYPE HTML>
<html>
	<head>

	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<!--linking css files-->
	<link rel="stylesheet" href="extra/css/bootstrap.min.css" />
	<link rel="stylesheet" href="extra/css/mystyle.css" />

		<title>
			Login
		</title>
	</head>

	<body class="main-body" >

	<?php include 'header.php';?>

	<div class="form-container">
	<div class="marginh-10p marginv-5p">
	<center><h3>Log Into Your Account</h3></center><BR />
	<?php
	include 'dbgmsa.php';

	// checking and displaying message from previous page
		if(isset($_SESSION['message']))
		{
			echo $_SESSION['message'];
			$_SESSION['message'] = null;
		}


	if(isset($_POST['go']))
	{
		// getting data from user input
		$phone = stripcslashes(htmlentities(trim($_POST['phone-email'])));
		$pass = stripcslashes(htmlentities(trim(md5($_POST['pass']))));

		// checking if data is valid
		$query = "SELECT * FROM users WHERE `email-phone`='$phone' AND password='$pass'";

		$check = $connect->query($query);
		$rows = mysqli_num_rows($check);
		if($rows == 1)
		{
			while($fetch = $check->fetch_assoc())
			{
				$_SESSION['profilepic'] = $fetch['profilepic'];
				$_SESSION['firstname'] = $fetch['firstname'];
				$_SESSION['fullname'] = $fetch['fullname'];
				$_SESSION['userId'] = $fetch['userId'];
				$_SESSION['phone'] = $fetch['email-phone'];
				$_SESSION['school'] = $fetch['school'];
				$_SESSION['year'] = $fetch['year'];
				$_SESSION['gender'] = $fetch['gender'];

				if($_SESSION['new-user']){
					header('location: account.php');
				}else{
					header('location: index.php');
				}

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
	<form action="login.php" method="POST" >
		<input class="form-control" placeholder=" PHONE or EMAIL" value="<?php echo $phone; ?>" name="phone-email" type="text" /><BR />
		<input class="form-control" placeholder=" PASSWORD" name="pass" type="password" /><BR />
		<a href="#">Forgot password?</a><BR /><BR />
		<button class="btn btn-primary" name="go" type="submit">Log me In</button></button></button>
	<form/>
		<div class="clear"></div>
	</div>

	</div>
	<HR>
	<center><h4>If you are new here </h4><h4><a style="text-decoration: none" href="signup.php">| Register |</a></h4></center>

	</body>

</html>
