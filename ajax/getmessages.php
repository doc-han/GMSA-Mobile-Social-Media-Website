<?php
	include '../dbgmsa.php';
	session_start();

	$activeUser = $_SESSION['userId'];
  $otherUser = $_SESSION['chat-other'];

//marking all recieved messages from user as read//
	$get = $chatconnect->query("SELECT * FROM (SELECT * FROM `$activeUser` WHERE is_read='0')results WHERE msgfrom!='$otherUser' ");
  $rows = mysqli_num_rows($get);
  if($rows != 0){
    echo $rows;
  }


?>
