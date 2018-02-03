<?php
include '../dbgmsa.php';
$id = $_GET['id'];
$action = $_GET['action'];

if($action == 0){
  $query = "UPDATE users SET exe='0' WHERE userId='$id'";
  $add = false;
}else if($action == 1){
  $query = "UPDATE users SET exe='1' WHERE userId='$id'";
  $add = true;
}else{
  //I've got nothing to do here.
}
if($connect->query($query)){
  if($add){
    echo 1;
  }else{
    echo 2;
  }
}else{
  echo 0;
}


?>
