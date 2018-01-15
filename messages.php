<?php
session_start();
if(!isset($_SESSION['userId']))
{
	header('location: login.php');
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

	<!--linking the javascript files-->
	<script src="extra/js/jquery-3.2.1.js"></script>
	<script src="extra/js/lastActivity.js"></script>
		<title>
			GMSA
		</title>
	</head>

	<body class="chat-body" >

	<?php include 'header.php';?>
	<?php include 'sheader.php';?>
		<div class=" marginv-5p">
			<center><h4 style="color:#fff;padding-bottom:10px;font-weight:bolder;background-color: rgba(0,0,0,0.54)">MESSAGES</h4></center>

			<div class="list-group">
				<ol>
<?php
	include 'dbgmsa.php';
	$activeUser = trim($_SESSION['userId']);

	$mquery = "SELECT * FROM `$activeUser` WHERE is_read='0'";
	$getmessages = $chatconnect->query($mquery);
	$c = null;
	$count = 0;
	while($fetch = $getmessages->fetch_assoc()){
		$mId = $fetch['msgfrom'];
		//fetching recent message from users
		$getrecent = $chatconnect->query("SELECT message FROM `$activeUser` WHERE msgfrom='$mId' AND is_read='0' ORDER BY msgtime DESC, msgfrom LIMIT 1");
		while($getm = $getrecent->fetch_assoc()){
			$message = $getm['message'];
		}


		//getting users fullname from ID
		$uquery = "SELECT fullname,profilepic FROM users WHERE userId='$mId'";
		$getname = $connect->query($uquery);
		while($name = $getname->fetch_assoc()){
			$uname = $name['fullname'];
			$upic = $name['profilepic'];
		}
		if($c!=$mId){
			//<img class="online-icon" src="extra/img/online.png" />
			echo '<a href="conversation.php?oid='.$mId.'"><li class="list-group-item "><img src="uploads/images/profiles/'.$upic.'" class="chat-img"><strong><span class="list-group-item-heading">'.$uname.'</span></strong><BR /><p class="list-group-item-text few-msg">'.$message.'</p></li></a>';
			$count++;
		}
		$c = $mId;
	}

	if($count == 0){
		echo '<li class="list-group-item"><strong><span class="list-group-item-heading"><center>You have no new message</center></span></strong></li>';
	}

?>
				</ol>
			</div>



		</div>
	</body>

</html>
