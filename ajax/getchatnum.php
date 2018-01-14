<?php
	include '../dbgmsa.php';
	session_start();

	$activeUser = $_SESSION['userId'];

  // h=hours i=minutes d=day m=month Y=year
  $i = date("i");
  $h = date("h");
  $d = date("d");
  $y = date("Y");
  $m = date("m");
  if(date("a") == "pm"){
    $h = $h + 12;
  }
  $time = $y.$m.$d.$h.$i;
  $offtime = $time - 3;

  $query = "SELECT lastActivity FROM users WHERE lastActivity>$offtime";
	$getnum = $connect->query($query);
	$count = mysqli_num_rows($getnum);

	if($count != 0){
		echo $count - 1;
	}else{
		echo "";
	}


?>
