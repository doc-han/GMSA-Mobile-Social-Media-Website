<?php
// 0 in the database means u are following
// 1 in the database means follower

include '../dbgmsa.php';
session_start();

$activeUser = $_SESSION['userId'];
$otherUser = $_SESSION['user-to-follow'];
$action = trim($_GET['action']);

if($action == 'follow'){
  //This is to insert follow
  $query = "INSERT INTO  `gmsafollow`.`$activeUser` (id,userId,follow) VALUES (null,'$otherUser',0);";
  $query .= "INSERT INTO  `gmsafollow`.`$otherUser` (id,userId,follow) VALUES (null,'$activeUser',1)";
}else{
  //This is to remove follow
  $query = "DELETE FROM `gmsafollow`.`$activeUser` WHERE userId='$otherUser' AND follow=0;";
  $query .= "DELETE FROM  `gmsafollow`.`$otherUser` WHERE userId='$activeUser' AND follow=1";
}

if(mysqli_multi_query($followconnect, $query)){
  // 1 is send to ajax to show that insert has been done successfully;
  echo 1;
}

?>
