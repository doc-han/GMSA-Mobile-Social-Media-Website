
<?php
session_start();
if(!isset($_SESSION['userId']))
{
	header('location: login.php');
}
$year = $_SESSION['year'] + 2;
?>
<!DOCTYPE HTML>
<html>
	<head>

	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<!--linking css files-->
	<link rel="stylesheet" href="extra/css/bootstrap.min.css" />
	<link rel="stylesheet" href="extra/css/mystyle.css" />

	<script src="extra/js/jquery-3.2.1.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$("[name=filter]").click(function(){
			//showing loader
			$("[class=imgs]").html("");
			$("[class=loader]").show();
			var year,e;
			year = $("[name=year]").val();
			e = $("[name=event]").val();
			var data = {
				year: year,
				e: e,
			}
			$.ajax({
	      url: "ajax/mem.php",
	      method: "GET",
	      data: data,
	      success: function(e) {
					$("[class=loader]").hide();
					$("[class=imgs]").html(e);
	      },
	      error: function() {
	        alert('error');
	      }
	    });

		});
	});

	</script>

		<title>
			Login
		</title>
	</head>

	<body class="main-body" >

	<?php include 'header.php';?>
	<?php
	include 'dbgmsa.php';


	?>
<form>
  <br>
  <center><span>filter images</span></center>
  <div class="input-group">
    <select style="text-align:center" class="form-control" name="year">
  <?php

	$tag1 = '<option>';
	$stag = '<option selected>';
	$tag2 = '</option>';
	$b = 2008;
	$currentyear = date('Y');
	$interval = $currentyear - $b;
	for($i=$currentyear;$i>=$b;$i--){

			if($i == $year){
				echo "$stag $i $tag2";
			}else{
				echo "$tag1 $i $tag2";
			}



	}
  ?>
  		</select>
      <select style="text-align:center" class="form-control" name="event">
				<option value="0">All events</option>
				<?php
			$a = [];
			$num = 0;
			$query = "SELECT event FROM memories WHERE year='$year' ORDER BY id DESC";
			$get = $connect->query($query);
			while($fetch = $get->fetch_assoc()){
			$event = $fetch['event'];
			if(!in_array($event, $a)){
				echo "<option value='$event'>$event</option>";
				$a[$num] = $event;
				$num++;
			}

			}

				?>
    		</select>
      <span class="input-group-btn"  style="height: 100%">
  			<button name="filter" class="btn btn-primary" style="height: 68px" type="button">Go!</button>
  		</span>
  </form>
  </div>

<style media="screen">

  .img-body{
    margin-top: 5px;
    width: 100%;
    background: #fff;
    height: 480px;
  }
  .upper, .lower {
    height: 40px;
    background: #000;
  }
  .body-main {
    height: 400px;
    overflow-y: scroll;
  }
  .body-main img {
    height: 400px;
    width: 100%;
  }
  .up, .down {
    text-align: center;
    line-height: 40px;
    color: #fff;
  }
  .up:hover, .down:hover {
    border: 1px solid #000;
    color: #000;
    background: #fff;
  }
</style>
  <div class="img-body">
    <div class="upper">
      <div class="up">
        Memories
      </div>
    </div>
    <div class="body-main">
			<style media="screen">
.loader {
	display: none;
}
.container {
width: 100%;
height: 40px;
margin-top: 20px;
}
#sub-container {
width: 50%;
height: 100%;
margin-left: 30%;
}

@keyframes one {
0%{left: 0;}
50%{left: -25%;}
100%{left: 0;}
}
@keyframes three {
0%{right: 0;}
50%{right: -25%;}
100%{right: 0;}
}

.block {
width: 25%;
height: 100%;
border-radius: 10px;
float: left;
}
.block:nth-child(1) {
background: #2196f3;
position: relative;
animation-name: one;
animation-duration: 2s;
animation-iteration-count: 100;
}
.block:nth-child(2) {
background: #f44336;
}
.block:nth-child(3) {
	background: #009688;
	position: relative;
	animation-name: three;
	animation-duration: 2s;
	animation-iteration-count: 100;
}

			</style>
			<div class="loader">
				<div class="container">
	        <center><h3>Loading</h3></center>
	    </div>
	    <div class="container">
	      <div id="sub-container">
	        <div class="block"></div>
	        <div class="block"></div>
	        <div class="block"></div>
	      </div>
	    </div>
			</div>
<div class="imgs">
	<?php

$query = "SELECT image FROM memories WHERE year='$year' ORDER BY id DESC";
$get = $connect->query($query);
if(mysqli_num_rows($get) < 1){
	echo "<br><br><center><h3>No Images Uploaded!</h3></center>";
}else{
	while($fetch = $get->fetch_assoc()){
	$img = $fetch['image'];
	echo "<img src='uploads/images/memories/$img' >";
	}
}


	?>
</div>

    </div>
    <div class="lower">
      <div class="down">
        GMSA - KNUST
      </div>
    </div>
  </div>

	</body>

</html>
