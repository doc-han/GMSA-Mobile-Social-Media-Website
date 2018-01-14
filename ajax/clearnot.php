<?php
	include '../dbgmsa.php';
	session_start();

	$activeUser = $_SESSION['userId'];

//reseting the notifications to zero (0)...
	$getnot = $Notconnect->query("UPDATE `$activeUser` SET lc='0' WHERE lc='1' ");

?>
