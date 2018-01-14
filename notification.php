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
	$("#livenot").load("ajax/clearnot.php");
});
</script>
		<title>
			GMSA
		</title>
	</head>

	<body class="find-body" >

	<?php include 'header.php';?>
	<?php include 'sheader.php';?>
</br></br>
	<div class="list-group">
		<?php
include 'dbgmsa.php';

	$userId = $_SESSION['userId'];
	$query = "SELECT * FROM `$userId` ORDER BY id DESC LIMIT 0,20";
	$get = $Notconnect->query($query);
	while($get1 = $get->fetch_assoc()){
		$sname = $get1['sname'];
		$senderId = $get1['senderId'];
		$message = $get1['message'];
		$link = $get1['link'];
		$lc = $get1['lc'];

		if($lc == 1){
			echo '<a href="'.$link.'" class="list-group-item list-group-item-action flex-column align-items-start"><div class="d-flex w-100 justify-content-between"><small class="text-muted">3 days ago</small></div><p class="mb-1"><b style="color:#337ab7">'.$sname.' '.$message.'</b></p></a>';
		}else{
			echo '<a href="'.$link.'" class="list-group-item list-group-item-action flex-column align-items-start"><div class="d-flex w-100 justify-content-between"><small class="text-muted">3 days ago</small></div><p class="mb-1">'.$sname.' '.$message.'</p></a>';
		}


	}
		?>

</div>


	</body>

</html>
