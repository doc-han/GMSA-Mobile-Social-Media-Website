<?php
	include '../dbgmsa.php';
	session_start();

	$activeUser = $_SESSION['userId'];
  $otherUser = $_SESSION['chat-other'];

//marking all recieved messages from user as read//
	$read = $chatconnect->query("UPDATE `$activeUser` SET is_read='1' WHERE (msgfrom='$otherUser' && is_read='0') ");

?>
