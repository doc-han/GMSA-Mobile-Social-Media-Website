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
<script type="text/javascript">
$(document).ready(function(){
	$('li img').click(function(){
		var img = $(this).attr('src');
		$('.thumbnail').attr('src',img);
		$('.view-body').show();
	});

	$('.view-close').click(function(){
		$('.view-body').hide();
	});
});
</script>
		<title>
			GMSA
		</title>
	</head>

	<body class="main-body" >
		<style media="screen">
			.view-body{
				display: none;
				position: fixed;
				bottom: 0;
				top: 0;
				left: 0;
				right: 0;
				z-index: 3;
				background-color: rgba(0, 0, 0, 0.85);
				color: #fff;
			}
			.view-close {
				padding: 15px 20px;
				background-color: #ff1122;
				color: #000;
				font-weight: bolder;
				cursor: pointer;
			}
			.view-img img {
				width: 100%;
			}
		</style>
				<div class="view-body">
					<div class="view-close pull-right">
						x
					</div>
					<div class="view-img">
						<img class="thumbnail" src="uploads/images/gmsa/2017-1.jpg" alt="">
					</div>
					<?php include 'footer.php'; ?>
				</div>
		<?php
		include 'header.php';
		include 'sheader.php';
		include 'dbgmsa.php';
		include 'admin/positionslist.php';

		$pos = getpos(1);
		$get = $connect->query("SELECT fullname,image FROM executives WHERE position ='$pos' ORDER BY year DESC LIMIT 1");
		while($fetch = $get->fetch_assoc()){
			$president = $fetch['fullname'];
			$pimage = $fetch['image'];
		}
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
			<li class="list-group-item "><img src="uploads/images/gmsa/<?php echo $pimage;?>" class="pres-pic"><BR /><strong><span class="list-group-item-heading"><?php echo $president; ?></span></strong><BR /><p class="list-group-item-text">Current President</p><div class="clear"></div></li>
			</div>
		</div>

		<a href="#" class="thumbnail" style="margin-bottom: 0px;">
			<img src="extra/img/bg.jpg" />
		</a>
<br>
<style media="screen">
	hr {
		margin-top: 0px;
	}
</style>
		<?php include 'footer.php';?>

	</body>

</html>
