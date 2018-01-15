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

	<meta name="viewport" content="width=device-width,initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<!--linking css files-->
	<link rel="stylesheet" href="extra/css/bootstrap.min.css" />
	<link rel="stylesheet" href="extra/css/mystyle.css" />

	<!--linking the javascript files-->
	<script src="extra/js/jquery-3.2.1.js"></script>
	<script src="extra/js/lastActivity.js"></script>

<script src="extra/js/jquery-3.2.1.js"></script>
		<title>
			GMSA
		</title>
	</head>

	<body class="main-body" >
		<?php
		include 'header.php';
		include 'sheader.php';
		?>
		<div class="panel panel-primary">
			<div class="panel-heading"><BR />
			<center><strong>KNUST Senior High - <?php echo date('Y');?></strong></center>
			</div>
			<div class="panel-body">
				<a href="executives.php"><button style="float:left;width:49%;padding-top:10px;padding-bottom:10px" class="btn btn-danger">Executives</button></a>
				<a href="members.php"><button style="float:right;width:49%;padding-top:10px;padding-bottom:10px" class="btn btn-primary">Members</button></a>
			</div>
			<div class="panel-footer">
			<li class="list-group-item "><img src="extra/img/pic.jpg" class="pres-pic"><BR /><strong><span class="list-group-item-heading">Razak Salifu</span></strong><BR /><p class="list-group-item-text">Current President</p><div class="clear"></div></li>
			</div>
		</div>

		<a href="#" class="thumbnail">
			<img src="extra/img/bg.jpg" />
		</a>
<br>
		<?php include 'footer.php';?>

	</body>

</html>
