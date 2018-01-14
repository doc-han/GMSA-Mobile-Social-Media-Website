<?php
  include '../dbgmsa.php';
  include '../solvedate.php';
  session_start();
  $activeUser = $_SESSION['userId'];
  $otherUser = $_SESSION['chat-other'];
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

  $query = "SELECT lastActivity FROM users WHERE userId='$otherUser' ";
  $get = $connect->query($query);
  while($fetch = $get->fetch_assoc()){
    $lastseen = $fetch['lastActivity'];
    if($lastseen>$offtime){
      echo "online";
    }else{
      echo "Last seen ";
      echo solvedate($lastseen);
    }
  }
?>
