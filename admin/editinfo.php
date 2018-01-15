<?php
session_start();
if(!isset($_SESSION['adminId']))
{
	header('location: ../admin');
}else{
		$execid = trim($_GET['id']);

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

  $query = "SELECT * FROM executives WHERE id='$execid'";
  $get = $connect->query($query);
  $rows = mysqli_num_rows($get);
  while($fetch = $get->fetch_assoc()){
      $fullname = $fetch['fullname'];
      $class = $fetch['class'];
      $year = $fetch['year'];
			$position = $fetch['position'];
    }

    include 'positionslist.php';

		if(isset($_POST['edit'])){
			$efullname = trim($_POST['fullname']);
			$eclass = $_POST['class'];
			$eid = $_POST['position'] + 1;
			$epos = getpos($eid);
			if($eclass == '0' && $epos == '0'){
				$query = "UPDATE executives SET fullname='$efullname' WHERE id='$execid'";
			}else if($epos == '0' && $eclass != '0'){
				$equery = "UPDATE executives SET fullname='$efullname', class='$eclass' WHERE id='$execid'";
			}else if($eclass == '0' && $epos != '0'){
				$equery = "UPDATE executives SET fullname='$efullname', position='$epos', id='$eid' WHERE id='$execid'";
			}else if($eclass != '0' && $epos != '0'){
				$equery = "UPDATE executives SET fullname='$efullname', class='$eclass', position='$epos', id='$eid' WHERE id='$execid'";
			}else{
				//nothing to do here
			}

			$update = $connect->query($equery);
			if($update){
				$_SESSION['message'] = "<div class='alert alert-success'>Changes made successfully!</div>";
				header('location: infolist.php');
			}else{
				$_SESSION['message'] = "<div class='alert alert-danger'>Error making changes. try again!</div>";
				header('location: infolist.php');
			}


		}

  ?>
	<form method="POST" enctype="multipart/form-data" action="editinfo.php?id=<?php echo $execid;?>">
  <center>
    <label class="custom-file">
      <input style="display: none" onchange="imageselected()" class="custom-file-input" id="file" name="file" type="file" accept="image/*" />
      <span class="custom-file-control">
        <div class="add-photo">
        Select Image
        </div>
      </span></label>

    <br />

</center><br>
<div class="container">
<br>
<table class="table table-striped">
  <tbody>
    <tr>
      <td><b>Fullname</b></td>
      <td> <input class="form-control" type="text" name="fullname" value="<?php echo $fullname; ?>"> </td>
    </tr>
    <tr>
      <td><b>year</b></td>
      <td><select class="form-control" name="year" >
					<option value="<?php echo $year;?>"><?php echo $year;?></option>
  		</select></td>
    </tr>
    <tr>
      <td><b>Class</b></td>
      <td><select class="form-control" name="class">
				<option value="0" >Change Class</option><option>Science One [ S1 ]</option><option>Science Two [ S2 ]</option><option>Science Three [ S3 ]</option><option>Science Four [ S4 ]</option><option>Science Five [ S5 ]</option><option>Science Six [ S6 ]</option><option>Science Seven [ S7 ]</option><option>General Arts One [ A1 ]</option><option>General Arts Two [ A2 ]</option><option>General Arts Three [ A3 ]</option><option>General Arts Four [ A4 ]</option><option>General Arts Five [ A5 ]</option><option>General Arts Six [ A6 ]</option><option>Visual Arts One [ V1 ]</option><option>Visual Arts Two [ V2 ]</option><option>Business One [ B1 ]</option><option>Business Two [ B2 ]</option>
  		</select></td>
    </tr>
    <tr>
			<tr>
				<td><b>Position</b></td>
				<td>
					<select class="form-control" style="margin-top:5px" name="position">
					<option value="0" >Change Position</option><option value="1" >President [ P ]</option><option value="2" >Vice President [ VP ]</option><option value="3" >General Secetary [ GS ]</option><option value="4" >Imam [ I ]</option><option value="5" >Public Relation Officer [ PRO ]</option>
					<option value="6" >Womens Commissioner [ WOCOM ]</option><option value="7" >Deputy Imam [ DI ]</option><option value="8" >Financial Secetary [ FS ]</option><option value="9" >Male Organiser [ MO ]</option><option value="10" >Female Organiser [ FO ]</option><option value="11" >Male Advisor [ MA ]</option>
					<option value="12" >Female Advisor [ FA ]</option><option value="13" >Asst Male Organiser [ AMO ]</option><option value="14" >Treasure [ T ]</option><option value="15" >Deputy Womens Commissioner [ DWC ]</option>
				</select>
			</td>
			</tr>
      <td colspan="2"><center><button class="btn btn-warning" name="edit" type="submit">Save Changes</button></center></td>
    </tr>
  </tbody>
</table>
</div>

</form>

	</body>

</html>
