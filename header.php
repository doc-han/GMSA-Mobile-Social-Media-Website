<?php
//check whether device is a mobile;
if(!stristr($_SERVER['HTTP_USER_AGENT'],'Mobile')){
	//header('location: desktop.php');
}
?>
<nav class="navbar navbar-inverse" id="header" style="margin-bottom: 0px">
  <div class="container-fluid">
    <div class="navbar-header">
      <ul class="nav navbar-nav pull-left">
	  <li style="padding-left: 10px"><a href="index.php"><strong>GMSA</strong></a></li>
	  </ul>

	  <?php

	  if(isset($_SESSION['fullname']))
	  {
      //This is to set chat other users ID to null when not on conversations or profile page.
      //This is to recieve message notifications on all users
      $pagename = $_SERVER['SCRIPT_NAME'];
      $split = explode("/", $pagename);
      $pagename = $split[sizeof($split)-1];
      if($pagename != 'conversation.php'){
        $_SESSION['chat-other'] = null;
      }
      if($pagename != 'profile.php'){
        $_SESSION['user-to-follow'] = null;
      }

      //end of code...

      //displays username is the session isset//
		  echo '<ul class="nav navbar-nav pull-right"><li style="padding-right: 10px"><a href="account.php">';
		  echo $_SESSION['fullname'];
		  echo '</a></li></ul>';

	  }

	  ?>

    </div>
  </div>
</nav>
