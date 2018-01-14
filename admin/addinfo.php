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
<script type="text/javascript">

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
include 'positionslist.php';
if(isset($_POST['go'])){
  $fullname = htmlentities($_POST['fullname']);
  $class = htmlentities($_POST['class']);
  $year = htmlentities($_POST['year']);
  $id = htmlentities($_POST['position']);
	$position = getpos($id);

	$check = $connect->query("SELECT id FROM executives WHERE id='$id' AND year='$year'");
	if(mysqli_num_rows($check)>0){
		echo "<div class='alert alert-danger'>This position is already <b>occupied!</b></div>";
	}else{
		$query = "INSERT INTO executives (num,id,fullname,class,year,position,image)VALUES(null,'$id','$fullname','$class','$year','$position',0)";
	  $insert = $connect->query($query);
		echo $connect->error;
	  if($insert){
	    echo "<div class='alert alert-success'>Info of <b>".$fullname."</b> has been added!</div>";
	  }else{
	    echo "<div class='alert alert-danger'>Unable to add info of <b>".$fullname."</b>. Try Again!</div>";
	  }
	}
	}


  ?>
  <form method="POST" action="addinfo.php">
  <center>
    <label class="custom-file" style="cursor: pointer;">
      <input style="display: none;" type="file" id="file2" class="custom-file-input">
      <span class="custom-file-control">
          <div class="add-photo">
          Select Photo
          </div>
        </span>
    </label>
    <br />
    <br />


  <span type="button" class="label label-danger">Exucutive</span>

</center><br>
<div class="container">
<input type="text" class="form-control" style="margin-top:5px" placeholder="Full name" name="fullname">
<select class="form-control" style="margin-top:5px" name="class" value="<?php echo $year; ?>" type="year" >
	<option value="0" >Class</option><option>Science One [ S1 ]</option><option>Science Two [ S2 ]</option><option>Science Three [ S3 ]</option><option>Science Four [ S4 ]</option><option>Science Five [ S5 ]</option><option>Science Six [ S6 ]</option><option>Science Seven [ S7 ]</option><option>General Arts One [ A1 ]</option><option>General Arts Two [ A2 ]</option><option>General Arts Three [ A3 ]</option><option>General Arts Four [ A4 ]</option><option>General Arts Five [ A5 ]</option><option>General Arts Six [ A6 ]</option><option>Visual Arts One [ V1 ]</option><option>Visual Arts Two [ V2 ]</option><option>Business One [ B1 ]</option><option>Business Two [ B2 ]</option>
</select>
<select class="form-control" style="margin-top:5px" name="year" value="<?php echo $year; ?>" type="year" >
	<option value="0" >Year of service</option><option>2008</option><option>2009</option><option>2010</option><option>2011</option><option>2012</option><option>2013</option><option>2014</option><option>2015</option><option>2016</option><option>2017</option>
</select>
<select class="form-control" style="margin-top:5px" name="position">
	<option value="0" >Position</option><option value="1" >President [ P ]</option><option value="2" >Vice President [ VP ]</option><option value="3" >General Secetary [ GS ]</option><option value="4" >Imam [ I ]</option><option value="5" >Public Relation Officer [ PRO ]</option>
	<option value="6" >Womens Commissioner [ WOCOM ]</option><option value="7" >Deputy Imam [ DI ]</option><option value="8" >Financial Secetary [ FS ]</option><option value="9" >Male Organiser [ MO ]</option><option value="10" >Female Organiser [ FO ]</option><option value="11" >Male Advisor [ MA ]</option>
	<option value="12" >Female Advisor [ FA ]</option><option value="13" >Asst Male Organiser [ AMO ]</option><option value="14" >Treasure [ T ]</option><option value="15" >Deputy Womens Commissioner [ DWC ]</option>
</select>
<br>
<button type="submit" name="go" class="form-control btn btn-success" name="button">Add User</button><br>
</form>
<center><a href="cpanel.php"><button type="button" style="margin-top:10px" class="btn btn-secondary" name="button">Back</button></a></center>
</div>




	</body>

</html>
