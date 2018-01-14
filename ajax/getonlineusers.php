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

  $query = "SELECT fullname,userId FROM users WHERE lastActivity>$offtime ORDER BY fullname";
  $get = $connect->query($query);
  $count = 0;
  while($fetch = $get->fetch_assoc()){
    $fullname = $fetch['fullname'];
    $oid = $fetch['userId'];
    if($activeUser != $oid){
      $count++;
      echo '<a href="conversation.php?oid='.$oid.'"><li class="list-group-item"><strong><span class="list-group-item-heading">'.$fullname.'</span></strong><img class="online-icon" src="extra/img/online.png" /></li></a>';
    }

  }

  if($count == 0){
    echo '<li class="list-group-item"><strong><span class="list-group-item-heading"><center>There are no users online.</center></span></strong></li>';
  }
?>
