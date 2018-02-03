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
	<script type="text/javascript">
	$(document).ready(function() {
		$("#livechat").load("ajax/getchatnum.php");
		setInterval(function(){
			$("#livechat").load("ajax/getchatnum.php");
		}, 1000);
	});
	</script>

		<title>
			GMSA
		</title>
	</head>

	<body class="index-body" >

	<?php include 'header.php';?>
		<div class="sections-container">

			<a href="feeds.php"><div class="sections">
				Feeds
			</div></a>
			<a href="school.php"><div class="sections">
				My School
			</div><a/>
			<a href="find.php"><div class="sections">
				Find
			</div><a/>

			<a href="chat.php"><div class="sections">
				Chat <span id="livechat" class="badge"></span>
			</div><a/>
			<a href="gallery.php"><div class="sections">
				Gallery
			</div><a/>
			<?php
			$exe = $_SESSION['exe'];
			if($exe == '1'){
				echo '<a href="headchat.php"><div class="sections">Executives</div><a/>';
			}
			?>
			<a href="logout.php"><div class="sections">
				Log Out
			</div><a/>


		</div>

	</body>

</html>
