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
		<BR />


	<div class="input-group">
	<select style="text-align:center" class="form-control" name="range">
			<option>Filter by year</option>
			<option>2018</option>
			<option>2017</option>
			<option>2016</option>
			<option>2015</option>
		</select>
		<span class="input-group-btn">
			<button class="btn btn-default" type="button">Go!</button>
		</span>
    </div>
	<BR />

	<div class="list-group">
	<ol style="padding:0px">
		<?php
		include 'dbgmsa.php';
		$type = $_GET['type'];

		$get = $connect->query("SELECT * FROM students WHERE type='$type' ");
		while($get1 = $get->fetch_assoc()){
			$fullname = $get1['fullname'];

			echo '<li class="list-group-item "><img src="extra/img/pic.jpg" class="chat-img"><strong><span class="list-group-item-heading" style="line-height:50px">'.$fullname.'</span></strong></li>';
			echo $connect->error;
		}
		?>
		<!--<li class="list-group-item "><img src="extra/img/pic.jpg" class="chat-img"><strong><span class="list-group-item-heading" style="line-height:50px">ListName</span></strong></li>-->
	</ol>
	</div>



	</body>

</html>
