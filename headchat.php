<?php
session_start();
if(!isset($_SESSION['userId']))
{
	header('location: login.php');
}
$exe = trim($_SESSION['exe']);
if($exe != 1){
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
	<link rel="stylesheet" href="extra/css/conversation.css" />

	<!--linking the javascript files-->
	<script src="extra/js/jquery-3.2.1.js"></script>
	<script src="extra/js/lastActivity.js"></script>
	<script src="extra/js/conversation.js"></script>

		<title>
			Conversation
		</title>
	</head>

	<body style="background:#333;color:#e2e2e2">
		<?php include 'header.php'; ?>
		<?php include 'sheader.php';?>
    <br><br><br><br><br>
    <center> <h3>available in 3months time</h3> </center>
		<!--<div class="ud">
			<div class="img">
					<img src="uploads/images/profiles/default_profile9.png" alt="">
			</div>
			<div class="mid">
					<h3>Executives</h3>
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
-->
<?php include 'footer.php'; ?>
	</body>
</html>
