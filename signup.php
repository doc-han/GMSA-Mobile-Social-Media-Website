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


	<link rel="stylesheet" href="extra/css/bootstrap.min.css" />
	<link rel="stylesheet" href="extra/css/mystyle.css" />

		<title>
			Sign Up
		</title>
	</head>

	<body class="main-body" >

		<?php include 'header.php';?>

	<div class="form-container">
	<div class="marginh-10p marginv-5p">
	<center><h3>Create an Account</h3></center><BR />
	<?php
	include 'dbgmsa.php';


		if(isset($_POST['go']))
		{
			// get data from user inputs
			$fullname = stripcslashes(htmlentities(trim($_POST['name'])));
			//getting firstname;
			$firstname = explode(" ", $fullname);
			$firstname = $firstname[0]; //done getting firstname
			$frand = rand(0,100000);
			$userId = $firstname.$frand;
			$phone = stripcslashes(htmlentities(trim($_POST['phone-email'])));
			$school = stripcslashes(htmlentities(trim($_POST['school'])));
			$year = stripcslashes(htmlentities(trim($_POST['year'])));
			$gender = $_POST['gender'];
			$password = stripcslashes(htmlentities(trim(md5($_POST['pass']))));
			$prand = rand(1,10);
			$profilepic = "default_profile".$prand.".png";

			// preparing tables for user.
			$query = "INSERT INTO users (id,userId,firstname,fullname,`email-phone`,gender,school,year,password,lastActivity,profilepic)VALUES(null,'$userId','$firstname','$fullname','$phone','$gender','$school','$year','$password','0','$profilepic');";
			$query .= "CREATE TABLE `gmsanot`.`$userId` ( `id` INT NOT NULL AUTO_INCREMENT , `sname` VARCHAR(100) NOT NULL , `senderId` VARCHAR(100) NOT NULL , `message` VARCHAR(255) NOT NULL , `type` INT(5) NOT NULL , `link` VARCHAR(255) NOT NULL , `lc` INT(5) NOT NULL , `nottime` VARCHAR(20) NOT NULL, PRIMARY KEY (`id`)) ENGINE = InnoDB;";
			$query .= "CREATE TABLE `users_chat`.`$userId` ( `id` INT NOT NULL AUTO_INCREMENT , `msgfrom` VARCHAR(50) NOT NULL , `message` VARCHAR(255) NOT NULL , `msgtime` VARCHAR(20) NOT NULL , `is_read` BOOLEAN NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
			$query .= "CREATE TABLE `gmsafollow`.`$userId` ( `id` INT NOT NULL AUTO_INCREMENT , `userId` VARCHAR(100) NOT NULL , `follow` INT(5) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
			if(mysqli_multi_query($connect,$query)){
				$_SESSION['message'] = "<div class='alert alert-success'><p>".$firstname.", "."your account has been created</p><hr><p>You can login now!</p></div>";
				$_SESSION['new-user'] = true;
				header('location:login.php');
			}else{


			}
			$password = null;

		} else {
			$fullname = null;
			$phone = $school = $year = $password = $fullname;
		}


	?>
	<form role="form" action="signup.php" method="POST" >
	<input class="form-control" name="name" value="<?php echo $fullname; ?>" placeholder=" FULL NAME" type="text" />
	<BR />
		<input class="form-control" name="phone-email" value="<?php echo $phone; ?>" placeholder=" PHONE or EMAIL" type="text" />
		<BR />
		<select class="form-control" name="school">
			<option>KNUST Senior High</option>
		</select>
		<BR />
		<select class="form-control" name="year" value="<?php echo $year; ?>" type="year" >
			<option>YEAR YOU STARTED THE SCHOOL</option><option>2008</option><option>2009</option><option>2010</option><option>2011</option><option>2012</option><option>2013</option><option>2014</option><option>2015</option><option>2016</option><option>2017</option>
		</select>
		<BR />
		<input class="form-control" name="pass" value="<?php echo $password; ?>" placeholder=" PASSWORD" type="password" />
		<BR />
		<input type="radio" name="gender" value="male"> Male ||
		<input type="radio" name="gender" value="female"> Female
		<BR />
		<BR />
		<button class="btn btn-primary" name="go" type="submit">Create my account</button>
	</form>
		<div class="clear"></div>
	</div>

	</div>
	<HR>
	<center><h4>If you already have an account</h4><h4><a style="text-decoration: none" href="login.php">| Login |</a></h4></center>

	</body>

</html>
