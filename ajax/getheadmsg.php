<?php
include '../dbgmsa.php';
session_start();
$activeUser = $_SESSION['userId'];

$query = "SELECT * FROM ORDER BY msgtime ASC LIMIT 200";
$get = $chatconnect->query($query);
while($fetch = $get->fetch_assoc()){
  $msgfrom = $fetch['msgfrom'];
  $message = $fetch['message'];

  if($msgfrom == $otherUser){
    //incoming message
    echo '<div class="u-msg"><div class="in">'.$message.'</div></div>';
  }else{
    //outgoing message
    echo '<div class="u-msg"><div class="out">'.$message.'</div></div>';
  }
}

?>
