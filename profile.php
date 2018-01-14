<?php
session_start();
if(!isset($_SESSION['fullname']))
{
	header('location: login.php');
}else if(isset($_GET['ref'])){
	$activeUser = trim($_SESSION['userId']);
  $profileId = trim($_GET['ref']);
	$_SESSION['user-to-follow'] = $profileId;
  if($profileId == $_SESSION['userId']){
    header('location: account.php');
  }else{
    include "dbgmsa.php";

  //getting user details
    $query = "SELECT * FROM users WHERE userId='$profileId'";
    $get = $connect->query($query);
    while($fetch = $get->fetch_assoc()){
      $pfullname = $fetch['fullname'];
      $pphone = $fetch['email-phone'];
      $pgender = $fetch['gender'];
      $pschool = $fetch['school'];
      $pyear = $fetch['year'];
      $pprofilepic = $fetch['profilepic'];
    }


  //getting number of users posts
    $query = "SELECT id FROM `posts` WHERE userId='$profileId'";
    $get = $connect->query($query);
    $pposts = mysqli_num_rows($get);

		//This is the code for getting users followers and follows;

		//This is for getting number user is following
		$fquery = "SELECT id FROM `$profileId` WHERE follow=0";
		$follow1 = $followconnect->query($fquery);
		$following = mysqli_num_rows($follow1);

		//This is for getting number following user
		$foquery = "SELECT id FROM `$profileId` WHERE follow=1";
		$follow2 = $followconnect->query($foquery);
		$followers = mysqli_num_rows($follow2);

		//checking whether active user is following user or not
		$checkfollow = $followconnect->query("SELECT id FROM `$profileId` WHERE follow=1 AND userId='$activeUser'");
		if(mysqli_num_rows($checkfollow) > 0){
			$followerbtn = '<button id="unfollow-btn" class="btn btn-danger pull-left follow" type="button">Unfollow</button>';
		}else{
			$followerbtn = '<button id="follow-btn" class="btn btn-primary pull-left follow" type="button">Follow</button>';
		}
  }


}else{
  header('location: account.php');
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
$(document).ready(function(){
  $(".follow").click(function(){
var action;
		if($(".follow").attr('id') == 'follow-btn'){
			action = 'follow';
			$(".follow").text('Unfollow');
			$(".follow").removeClass('btn-primary').addClass('btn-danger disabled');
		}else{
			action = 'unfollow';
			$(".follow").text('Follow');
			$(".follow").removeClass('btn-danger').addClass('btn-primary disabled');
		}

		var data = {
			action: action,
		}
		$.ajax({
			url: "ajax/follow.php",
      method: "GET",
      data: data,
			success: function(e){
				// e=1 means the follow has been inserted successfully in the database
				if(e == 1){
					if(action == 'follow'){
						$(".follow").attr('id','unfollow-btn').removeClass('disabled');
					}else{
						$(".follow").attr('id','follow-btn').removeClass('disabled');
					}


				}
			}
		})

  });
});
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

  <center>
          <img class="p-pic" src="uploads/images/profiles/<?php echo $pprofilepic;?>" alt="">



</center><br>
<div class="container">
<center><h3><?php echo $pfullname; ?></h3><div class="container"><?php echo $followerbtn;?><a href="conversation.php?oid=<?php echo $profileId;?>"><button class="btn btn-success pull-right" type="button">Send Message</button></a></div> </center>
<br>
<table class="table table-striped">
  <tbody>
    <tr>
      <td><b>followers</b></td>
      <td><?php echo $followers;?></td>
    </tr>
    <tr>
      <td><b>following</b></td>
      <td><?php echo $following;?></td>
    </tr>
    <tr>
      <td><b>posts</b></td>
      <td><?php echo $pposts; ?></td>
    </tr>
    <tr>
      <td><b>Email/Phone</b></td>
      <td><?php echo $pphone; ?></td>
    </tr>
    <tr>
      <td><b>Gender</b></td>
      <td><?php echo $pgender; ?></td>
    </tr>
    <tr>
      <td><b>year</b></td>
      <td><?php echo $pyear; ?></td>
    </tr>
    <tr>
      <td><b>school</b></td>
      <td><?php echo $pschool; ?></td>
    </tr>

  </tbody>
</table>
</div>
<br><br><br><br><br>
<?php include 'footer.php';?>



	</body>

</html>
