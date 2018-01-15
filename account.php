<?php
session_start();
if(!isset($_SESSION['fullname']))
{
	header('location: login.php');
}else{
	//setting new user to false
	$_SESSION['new-user'] = false;

  $activeUser = $_SESSION['userId'];
  $fullname = $_SESSION['fullname'];
  $phone = $_SESSION['phone'];
  $school = $_SESSION['school'];
  $year = $_SESSION['year'];
  $gender = $_SESSION['gender'];
	$profilepic = $_SESSION['profilepic'];

	$activeUser = trim($_SESSION['userId']);
	// h=hours i=minutes d=day m=month Y=year
	$s = date("s");
	$i = date("i");
	$h = date("h");
	$d = date("d");
	$y = date("Y");
	$m = date("m");
	if(date("a") == "pm"){
		$h = $h + 12;
	}
	$nottime = $y.$m.$d.$h.$i.$s;
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


<script src="extra/js/jquery-3.2.1.js"></script>
<script type="text/javascript">

</script>
		<title>
			Admin Login
		</title>
	</head>

	<body class="main-body" >
<style media="screen">
  .p-pic {
    width: 90%;
    margin: 0 5%;
		max-height: 350px;
  }
</style>
	<?php include 'header.php'; include 'sheader.php';?>
  <BR />
  <?php
include "dbgmsa.php";

//This is the code for getting number of users posts
$query = "SELECT id FROM `posts` WHERE userId='$activeUser'";
$get = $connect->query($query);
$posts = mysqli_num_rows($get);

//This is the code for getting users followers and follows;

//This is for getting number user is following
$fquery = "SELECT id FROM `$activeUser` WHERE follow=0";
$follow1 = $followconnect->query($fquery);
$following = mysqli_num_rows($follow1);

//This is for getting number following user
$foquery = "SELECT id FROM `$activeUser` WHERE follow=1";
$follow2 = $followconnect->query($foquery);
$followers = mysqli_num_rows($follow2);

  ?>

  <center>
          <img class="p-pic" src="uploads/images/profiles/<?php echo $profilepic;?>" alt="">



</center><br>
<div class="container">
<center><h3><?php echo $fullname; ?></h3> <a href="accountedit.php"><button class="btn btn-primary" type="button" name="button">Edit My Account</button></a> </center>
<br>
<?php

// This is the PHP code for accountedit.php
// It makes the users changed here.
if(isset($_POST['edit'])){
	$efullname = trim($_POST['fullname']);
	$efirstname = explode(" ", $efullname);
	$efirstname = $efirstname[0]; //done getting firstname
	$ephone = trim($_POST['phone']);
	$egender = $_POST['gender'];
	$eyear = $_POST['year'];
	$eschool = $_POST['school'];

	//changing users profile pic
	// 1 deleting the provious profile pic
	$defaults = ["default_profile1.png","default_profile2.png","default_profile3.png","default_profile4.png","default_profile5.png","default_profile6.png","default_profile7.png","default_profile8.png","default_profile9.png","default_profile10.png"];
	if(file_exists("uploads/images/profiles/$profilepic")){
		if(!in_array($profilepic, $defaults)){
			unlink("uploads/images/profiles/$profilepic");
		}

	}
	// 2 adding the new profile pic
	$location = 'uploads/images/profiles/';
	$target_file = $location . basename($_FILES["file"]["name"]);
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	$irand = rand(0,10000000);
	$name = "$activeUser.$imageFileType";
	$tmp_name = $_FILES["file"]["tmp_name"];
	$error = $_FILES["file"]["error"];

	if(!empty($_FILES["file"]["name"])) {
		//message for notification to show that profilepic has been updated
		$message = "Changed his/her Profile Pic and some info";
		if(move_uploaded_file($tmp_name, $location.$name)){
			//inserting prototype into the database
			$imagename = $name;
			echo "<div class='alert alert-success'>Profile Pic changed</div>";
		}else {
			$imagename = $profilepic;
			echo "<div class='alert alert-warning'>Profile Pic Unchanged</div>";
		}
	}else{
		$message = "Updated his/her Account Info";
		$imagename = $profilepic;
	}

	//updating users info
	$query = "UPDATE users SET firstname='$efirstname', fullname='$efullname', `email-phone`='$ephone', gender='$egender', year='$eyear', school='$eschool', profilepic='$imagename' WHERE userId='$activeUser'";
	$update = $connect->query($query);
	if($update){
		echo "<div class='alert alert-success'>Details Updated. <a href='account.php'>Click Here</a> to see change.</div>";
		//code for notification to followers
		// 1 getting Followers
		$getf = $followconnect->query("SELECT userId FROM `$activeUser` WHERE follow=1");
		while($fetchf = $getf->fetch_assoc()){
			$followersId = $fetchf['userId'];

			//notifing the follower
			$notify = $Notconnect->query("INSERT INTO `$followersId` (id,sname,senderId,message,type,link,lc,nottime)VALUES(null, '$fullname', '$activeUser', '$message', '1', 'profile.php?ref=$activeUser','1','$nottime') ");
		}

		//updating session after changing users details
		$_SESSION['profilepic'] = $imagename;
		$_SESSION['firstname'] = $efirstname;
		$_SESSION['fullname'] = $efullname;
		$_SESSION['phone'] = $ephone;
		$_SESSION['school'] = $eschool;
		$_SESSION['year'] = $eyear;
		$_SESSION['gender'] = $egender;
	}

}

//This is the end of the code
?>
<table class="table table-striped">
  <tbody>
    <tr>
      <td><b>followers</b></td>
      <td><?php echo $followers;?><a class="pull-right" href="view.php?cat=followers&ref=<?php echo $activeUser;?>">show all</a></td>
    </tr>
    <tr>
      <td><b>following</b></td>
      <td><?php echo $following;?><a class="pull-right" href="view.php?cat=following&ref=<?php echo $activeUser;?>">show all</a></td>
    </tr>
    <tr>
      <td><b>posts</b></td>
      <td><?php echo $posts; ?><a class="pull-right" href="view.php?cat=posts&ref=<?php echo $activeUser;?>">show all</a></td>
    </tr>
    <tr>
      <td><b>Email/Phone</b></td>
      <td><?php echo $phone; ?></td>
    </tr>
    <tr>
      <td><b>Gender</b></td>
      <td><?php echo $gender; ?></td>
    </tr>
    <tr>
      <td><b>year</b></td>
      <td><?php echo $year; ?></td>
    </tr>
    <tr>
      <td><b>school</b></td>
      <td><?php echo $school; ?></td>
    </tr>
    <tr>
      <td colspan="2"><center><button class="btn btn-warning">Submit an Error</button></center></td>
    </tr>
  </tbody>
</table>
</div>


<?php include 'footer.php';?>

	</body>

</html>
