
<nav class="navbar navbar-inverse" id="header" style="margin-bottom: 0px">
  <div class="container-fluid">
    <div class="navbar-header">
      <ul class="nav navbar-nav pull-left"> 
	  <li style="padding-left: 10px"><a href="index.php"><strong>GMSA</strong></a></li>
	  </ul>
	  
	  <?php
	  if(isset($_SESSION['adminName']))
	  {
		  echo '<ul class="nav navbar-nav pull-right"><li style="padding-right: 10px"><a href="#">';
		  echo $_SESSION['adminName'];
		  echo '</a></li></ul>';
		  
	  }
	  
	  ?>
	 
    </div>
  </div>
</nav>
