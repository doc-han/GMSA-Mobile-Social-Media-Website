<?php
	include '../dbgmsa.php';
	session_start();

	$activeUser = $_SESSION['userId'];

	$getnot = $Notconnect->query("SELECT * FROM `$activeUser` WHERE lc= 1");
	$count = mysqli_num_rows($getnot);

	if($count == 0)
	{
		echo "";
	} else {
		echo $count;
	}


?>
