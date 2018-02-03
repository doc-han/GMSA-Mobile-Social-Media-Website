<?php
session_start();
include '../dbgmsa.php';
$year = trim($_GET['year']);
$event = trim($_GET['e']);
if($event == "0"){
  $query = "SELECT image FROM memories WHERE year='$year' ORDER BY id DESC";
}else{
  $query = "SELECT image FROM memories WHERE year='$year' AND event='$event' ORDER BY id DESC";
}
$get = $connect->query($query);
if(mysqli_num_rows($get) < 1){
  echo "<br><br><center><h3>No Images Uploaded!</h3></center>";
}else{
  while($fetch = $get->fetch_assoc()){
  	$img = $fetch['image'];
  	echo "<img src='uploads/images/memories/$img' >";
  }
}

?>
