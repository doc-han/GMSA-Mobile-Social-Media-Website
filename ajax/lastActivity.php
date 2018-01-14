<?php
include '../dbgmsa.php';
session_start();
if($_GET['action'] == "update"){
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

  $query = "UPDATE users SET lastActivity='$time' WHERE userId='$activeUser'";
  $update = $connect->query($query);
  //If it is a success or not I'v got nothing to do;
}


?>
