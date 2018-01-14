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
	<script>
	$(document).ready(function() {
		$("#list").load("ajax/getonlineusers.php");
		setInterval(function(){
			$("#list").load("ajax/getonlineusers.php");
		}, 1000);
	});
	</script>

		<title>
			GMSA
		</title>
	</head>

	<body class="chat-body" >

	<?php include 'header.php';?>
	<?php include 'sheader.php';?>
		<div class=" marginv-5p">
			<center><h4 style="color:#fff;padding-bottom:10px;font-weight:bolder;background-color:rgba(0,0,0,0.54)">CHAT</h4></center>

			<div class="list-group">
				<ol id="list">
					<!--Ajax will load the list in here-->
				</ol>
			</div>



		</div>
	</body>

</html>
