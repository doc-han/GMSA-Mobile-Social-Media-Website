<?php
session_start();
if(!isset($_SESSION['adminId']))
{
	header('location: ../admin');
}
if(!isset($_GET['user'])){
  header('location: finduser.php');
}else{
  $userId = $_GET['user'];
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
<script type="text/javascript">
$(document).ready(function(){
  $("input[name='position']").hide();
  $("#exe").click(function(){
    $("input[name='position']").show();
    $("input[name='position']").attr("value","");
  });
  $("#mem").click(function(){
    $("input[name='position']").hide();
    $("input[name='position']").attr("value","none");
  });
});
</script>
		<title>
			Admin Login
		</title>
	</head>

	<body class="main-body" >
<style media="screen">
  .add-photo{
    width: 150px;
    height: 150px;
    line-height: 150px;
    text-align: center;
    font-weight: bolder;
    color: #333;
    border: 2px dashed #333;
  }
  .add-photo:hover{
    border: 2px dashed #969292;
    color: #969292;
  }
</style>
	<?php include 'header.php';?>
  <BR />
  <?php
include "../dbgmsa.php";

  $query = "SELECT * FROM users WHERE userId='$userId'";
  $get = $connect->query($query);
  $rows = mysqli_num_rows($get);
  while($fetch = $get->fetch_assoc()){
      $fullname = $fetch['fullname'];
      $gender = $fetch['gender'];
      $email_phone = $fetch['email-phone'];
      $year = $fetch['year'];
    }

  ?>
  <form method="POST" action="addinfo.php">
  <center>
          <div class="add-photo">
          User Photo
        </div>
    <br />

<div class="btn-group" data-toggle="buttons">
  <label class="btn btn-warning">
    <b>Floor Member</b>
  </label>
</div>
</center><br>
<div class="container">
<label style="margin-top:5px">
  <u>fullname</u>: <?php echo $fullname; ?>
</label><br>
<label style="margin-top:5px">
  <u>Email/Phone</u>: <?php echo $email_phone; ?>
</label><br>
<label style="margin-top:5px">
  <u>Gender</u>: <?php echo $gender; ?>
</label><br>
<label style="margin-top:5px">
  <u>year</u>: <?php echo $year; ?>
</label><br>
<br>
<button type="submit" name="go" class="form-control btn btn-primary" name="button">Warn User</button><br>
<button type="submit" name="go" class="form-control btn btn-danger" style="margin-top: 5px" name="button">Delete User</button><br>
</form>
<center><a href="findinfo.php"><button type="button" style="margin-top:10px" class="btn btn-secondary" name="button">Back</button></a></center>
</div>




	</body>

</html>
