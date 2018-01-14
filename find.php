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

	<body class="find-body" >

	<?php include 'header.php';?>
	<?php include 'sheader.php';?>
		<div class=" marginv-5p">
			<form action="find.php" method="GET" >
				<input class="input-fill inputh-40px" name="name" type="input" style="text-align:center;margin-bottom:10px" placeholder="Enter name of friend here" />
				<button style="display:none" name="go" type="submit">GO</button>
				<?php
					if(isset($_GET['go']))
					{
						$name = stripcslashes(htmlentities(trim($_GET['name'])));
					}
					else
					{
						$name = null;
					}
				?>
				<center><div style="margin-bottom:10px">
				<?php


				include 'dbgmsa.php';
				if($name != null)
				{
					// search and fetch from database
						$query = "SELECT fullname,userId FROM users WHERE fullname LIKE '%$name%'";
						$check = $connect->query($query);
						$rows = mysqli_num_rows($check);
						if($rows > 1){
							echo "<span style='color:#fff'>".$rows." people found</span>";
						}else if($rows == 0){
							echo "<span style='color:#fff'>There is no one with such name here</span>";
						}else{
							echo "<span style='color:#fff'>".$rows." person found</span>";
						}

						echo "</div></center></form><div class='chat-body'><div style='background-color: #f4f4f6' class='list-group'><ol>";
						if($rows > 0){
							while($fetch = $check->fetch_assoc()){
								$fullname = $fetch['fullname'];
								$id = $fetch['userId'];

								echo "<a href='profile.php?ref=$id'><li class='list-group-item '><img src='extra/img/pic.jpg' class='chat-img'><strong><span class='list-group-item-heading' style='line-height:50px'>$fullname</span></strong></li>";
							}
						}
				}


				?>



				</ol>
				</div>
			</div>



		</div>

	</body>

</html>
