<?php
session_start();
if(!isset($_SESSION['adminId']))
{
	header('location: ../admin');
}
  $adminyear = trim($_SESSION['adminyear']);

?>
<!DOCTYPE HTML>
<html>
	<head>

	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<!--linking css files-->
	<link rel="stylesheet" href="../extra/css/bootstrap.min.css" />
	<link rel="stylesheet" href="../extra/css/mystyle.css" />

	<!--linking the javascript files-->
	<script src="../extra/js/jquery-3.2.1.js"></script>
	<script src="../extra/js/lastActivity.js"></script>

<script src="../extra/js/jquery-3.2.1.js"></script>
		<title>
			GMSA
		</title>
	</head>

	<body class="main-body" >
		<?php
		include 'header.php';
		?>
		<BR />

	<form action="" method="GET">
	<div class="input-group">
	<select style="text-align:center" class="form-control" name="year">
    <?php
    echo "<option>".$adminyear."</option>";
    ?>
		</select>

		<span class="input-group-btn">
			<button name="filter" class="btn btn-default" type="submit">Go!</button>
		</span>
    </div>
    <?php
if(isset($_SESSION['message'])){
  echo $_SESSION['message'];
  $_SESSION['message'] = null;
}
    ?>
	</form>
	<BR />

	<div class="list-group">
	<ol style="padding:0px">

		<?php
		include '../dbgmsa.php';
    if(isset($_GET['filter'])){
      $query = "SELECT * FROM executives WHERE year='$adminyear' ORDER BY id";
      $get = $connect->query($query);
      while($fetch = $get->fetch_assoc()){
        $fullname = $fetch['fullname'];
        $position = $fetch['position'];
				$exepic = $fetch['image'];
        $id = $fetch['id'];

        echo '<a href="editinfo.php?id='.$id.'"><li class="list-group-item "><img src="../uploads/images/gmsa/'.$exepic.'" class="chat-img"><span class="list-group-item-heading" style="line-height:50px"><strong>'.$fullname.'</strong></span> <span style="line-height:50px;float:right">'.$position.'</span></li></a>';
      }
    }else{
      $query = "SELECT * FROM executives WHERE year='$adminyear' ORDER BY id";
      $get = $connect->query($query);
      while($fetch = $get->fetch_assoc()){
        $fullname = $fetch['fullname'];
        $position = $fetch['position'];
				$exepic = $fetch['image'];
        $id = $fetch['id'];

        echo '<a href="editinfo.php?id='.$id.'"><li class="list-group-item "><img src="../uploads/images/gmsa/'.$exepic.'" class="chat-img"><span class="list-group-item-heading" style="line-height:50px"><strong>'.$fullname.'</strong> </span> <span style="line-height:50px;float:right">'.$position.'</span></li></a>';
      }
    }
		?>
	</ol>
	</div>



	</body>

</html>
