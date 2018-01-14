<?php
session_start();
if(!isset($_SESSION['adminId']))
{
	header('location: ../admin');
}
?>
<!DOCTYPE HTML>
<html>
	<head>

	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<!--linking css files-->
	<link rel="stylesheet" href="../extra/css/bootstrap.min.css" />
	<link rel="stylesheet" href="../extra/css/mystyle.css" />


<script src="../extra/js/jquery-3.2.1.js"></script>

		<title>
			Admin Login
		</title>
	</head>

	<body class="main-body" >
    <style media="screen">
      .list-group-item:first-child, .list-group-item:last-child{
        border-radius:  0px;
      }
    </style>
<?php include 'header.php';?>
<a href="cpanel.php"><button type="button"> &laquo Back</button></a>
<form action="findinfo.php" method="GET">
  <br>
  <div class="col-lg-6">
   <div class="input-group">
     <input type="text" class="form-control" name="info" placeholder="Enter name/phone/email" aria-label="Enter name/phone/email">
     <span class="input-group-btn">
       <button class="btn btn-secondary" name="go" type="submit">Go!</button>
     </span>
   </div>
 </div>
</form>
<br>
<div class="container">
<div class="list-group">
  <?php
  include '../dbgmsa.php';
  if(isset($_GET['go'])){
    $info = htmlentities(trim($_GET['info']));

    $query = "SELECT userId,fullname,`email-phone`,year FROM users WHERE firstname LIKE '%$info%' OR `email-phone` LIKE '%$info%' OR fullname LIKE '%$info%'";
    $get = $connect->query($query);
    $rows = mysqli_num_rows($get);
    if($rows > 1){
      echo "<span style='color:#000'>".$rows." people found</span>";
    }else if($rows == 0){
      echo "<span style='color:#000'>No user found with details</span>";
    }else{
      echo "<span style='color:#000'>".$rows." person found</span>";
    }

    if($rows > 0){
      while($fetch = $get->fetch_assoc()){
        $fullname = $fetch['fullname'];
        $email_phone = $fetch['email-phone'];
        $year = $fetch['year'];
        $userId = $fetch['userId'];

        echo '<a href="info.php?user='.$userId.'" class="list-group-item list-group-item-action"><b>'.$fullname.' |</b> no: <b>'.$email_phone.' |</b> year: <b>'.$year.'</b></a>';
      }
    }
  }
  ?>
</div>
</div>
	</body>

</html>
