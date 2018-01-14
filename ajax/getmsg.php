<?php
include '../dbgmsa.php';
session_start();
$activeUser = $_SESSION['userId'];
$otherUser = $_SESSION['chat-other'];

$query = "SELECT * FROM (SELECT * FROM `$activeUser` WHERE msgfrom='$otherUser' UNION SELECT * FROM `$otherUser` WHERE msgfrom='$activeUser') results ORDER BY msgtime ASC LIMIT 200";
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
