<?php
// 0 in the database means u are following
// 1 in the database means follower

include '../dbgmsa.php';
session_start();

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
$nottime = $y.$m.$d.$h.$i.$s;

$activeUser = $_SESSION['userId'];
$activeUserName = $_SESSION['fullname'];
$otherUser = $_SESSION['user-to-follow'];
$action = trim($_GET['action']);

if($action == 'follow'){
  //This is to insert follow
  $query = "INSERT INTO  `gmsafollow`.`$activeUser` (id,userId,follow) VALUES (null,'$otherUser',0);";
  $query .= "INSERT INTO  `gmsafollow`.`$otherUser` (id,userId,follow) VALUES (null,'$activeUser',1)";
  $is = true;
}else{
  //This is to remove follow
  $query = "DELETE FROM `gmsafollow`.`$activeUser` WHERE userId='$otherUser' AND follow=0;";
  $query .= "DELETE FROM  `gmsafollow`.`$otherUser` WHERE userId='$activeUser' AND follow=1";
  $is = false;
}

if(mysqli_multi_query($followconnect, $query)){
  // 1 is send to ajax to show that insert has been done successfully;
  if($is){
    //sending user a notification that he has a new follower
    $message = "started following you";
   $add = $Notconnect->query("INSERT INTO `$otherUser` (id,sname,senderId,message,type,link,lc,nottime)VALUES(null, '$activeUserName', '$activeUser', '$message', '1', 'profile.php?ref=$activeUser','1','$nottime') ");
  }else{
    //sending user a notification that someone stopped following him
    $message = "stopped following you. Maybe ask why?";
   $add = $Notconnect->query("INSERT INTO `$otherUser` (id,sname,senderId,message,type,link,lc,nottime)VALUES(null, '$activeUserName', '$activeUser', '$message', '1', 'profile.php?ref=$activeUser','1','$nottime') ");
  }
  echo 1;
}

?>
