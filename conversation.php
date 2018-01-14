<?php
session_start();
if(!isset($_SESSION['userId']))
{
	header('location: login.php');
}else{
	if(isset($_GET['oid'])){
		$oid = trim($_GET['oid']);
		$_SESSION['chat-other'] = $oid;
		include 'dbgmsa.php';
		// Fetching users fullname and images
		$query = "SELECT fullname FROM users WHERE userId='$oid' ";
		$get = $connect->query($query);
		$row = mysqli_num_rows($get);
		if($row == 1){
			while($fetch = $get->fetch_assoc()){
				$fullname = $fetch['fullname'];
			}
		}else{
			//no user with such ID
		}
	}else{
		header('location: chat.php');
	}
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
	<link rel="stylesheet" href="extra/css/conversation.css" />

	<!--linking the javascript files-->
	<script src="extra/js/jquery-3.2.1.js"></script>
	<script src="extra/js/lastActivity.js"></script>
	<script src="extra/js/conversation.js"></script>

		<title>
			Conversation
		</title>
	</head>

	<body>
		<?php include 'header.php'; ?>
		<?php include 'sheader.php';?>
		<div class="ud">
			<div class="img">
					<img src="extra/img/pic.jpg" alt="">
			</div>
			<div class="mid">
					<h3><?php echo $fullname; ?></h3>
					<br>
					<span id="user-status"></span>
			</div>
			<div class="clear"></div>
		</div>


		<div class="mb">
				<div class="u-msg">
					<center><div class="loading">
						Loading...
					</div></center>
				</div>
		</div>


		<div class="sbox">
			<div class="txt">
				<textarea placeholder="Type a message" id="msg-txt" name="name" ></textarea>
			</div>
			<div class="snd">
				<button class="btn btn-primary" id="msg-send" type="submit" name="button">Send</button>
			</div>
		</div>

	</body>
</html>
