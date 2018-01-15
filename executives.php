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

	<form action="" method="GET">
	<div class="input-group">
	<select style="text-align:center" class="form-control" name="year">
    <?php

          $selectedyear = $_GET['year'];

    			$tag1 = '<option>';
    			$stag = '<option selected>';
    			$tag2 = '</option>';
    			$b = 2008;
    			$currentyear = date('Y');
    			$interval = $currentyear - $b;
    			for($i=$currentyear;$i>=$b;$i--){
            if(!isset($selectedyear)){
              if($i == $_SESSION['year']){
      					echo "$stag $i $tag2";
      				}else{
      					echo "$tag1 $i $tag2";
      				}
            }else{
              if($i == $selectedyear){
      					echo "$stag $i $tag2";
      				}else{
      					echo "$tag1 $i $tag2";
      				}
            }


    			}
    ?>
		</select>
		<span class="input-group-btn">
			<button name="filter" class="btn btn-default" type="submit">Go!</button>
		</span>
    </div>
	</form>
	<BR />

	<div class="list-group">
	<ol style="padding:0px">
		<?php
		include 'dbgmsa.php';
    if(isset($_GET['filter'])){
      $query = "SELECT * FROM executives WHERE year='$selectedyear' ORDER BY id";
      $get = $connect->query($query);
      while($fetch = $get->fetch_assoc()){
        $fullname = $fetch['fullname'];
        $position = $fetch['position'];
				$exepic = $fetch['image'];

        echo '<li class="list-group-item "><img src="uploads/images/gmsa/'.$exepic.'" class="chat-img"><span class="list-group-item-heading" style="line-height:50px"><strong>'.$fullname.'</strong></span> <span style="line-height:50px;float:right">'.$position.'</span></li>';
      }
    }else{
      $selectedyear = $_SESSION['year'];
      $query = "SELECT * FROM executives WHERE year='$selectedyear' ORDER BY id";
      $get = $connect->query($query);
      while($fetch = $get->fetch_assoc()){
        $fullname = $fetch['fullname'];
        $position = $fetch['position'];
				$exepic = $fetch['image'];

        echo '<li class="list-group-item "><img src="uploads/images/gmsa/'.$exepic.'" class="chat-img"><span class="list-group-item-heading" style="line-height:50px"><strong>'.$fullname.'</strong> </span> <span style="line-height:50px;float:right">'.$position.'</span></li>';
      }
    }
		?>
	</ol>
	</div>



	</body>

</html>
