<?php
include '../dbgmsa.php';
session_start();
$activeUser = $_SESSION['userId'];
$otherUser = $_SESSION['chat-other'];
$message = nl2br(trim($_GET['message']));
// h=hours i=minutes d=day m=month Y=year
$s = date("s");
$i = date("i");
$h = date("h");
$d = date("d");
$y = date("Y");
$m = date("m");
if(date("a") == "pm"){
  $h = $h + 12;
}
$msgtime = $y.$m.$d.$h.$i.$s;
$query = "INSERT INTO `$otherUser` (id,msgfrom,message,`msgtime`,`is_read`) VALUES (null,'$activeUser','$message','$msgtime','0')";
$send = $chatconnect->query($query);
if($send){
  echo 1;
}

?>
