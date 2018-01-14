<?php
session_start();
if(!isset($_SESSION['fullname']))
{
	header('location: login.php');
}else{
	$activeUser = $_SESSION['userId'];
  $fullname = $_SESSION['fullname'];
  $phone = $_SESSION['phone'];
  $school = $_SESSION['school'];
  $year = $_SESSION['year'];
  $gender = $_SESSION['gender'];
}
?>
<!DOCTYPE HTML>
<html>
	<head>

	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<!--linking css files-->
	<link rel="stylesheet" href="extra/css/bootstrap.min.css" />
	<link rel="stylesheet" href="extra/css/mystyle.css" />


<script src="extra/js/jquery-3.2.1.js"></script>
<script type="text/javascript">
//This is a function to show user that whether post image is selected or not//
function imageselected(){
  var f = $("#file").val();
  if(f.length > 0){
    $(".add-photo").text("Image Selected");
  }else{
    $(".add-photo").text("Select Image");
  }
}
</script>
		<title>
			Admin Login
		</title>
	</head>

	<body class="main-body" >
<style media="screen">
  .p-pic {
    width: 90%;
    margin: 0 5%;
  }
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
	<?php include 'header.php'; include 'sheader.php';?>
  <BR />



	<form method="POST" enctype="multipart/form-data" action="account.php">
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
      <td><b>Email/Phone</b></td>
      <td> <input class="form-control" type="text" name="phone" value="<?php echo $phone; ?>"> </td>
    </tr>
    <tr>
      <td><b>Gender</b></td>
      <td> <select class="form-control" name="gender">
				<?php
				if($gender == 'male'){
					echo '<option selected>male</option><option>female</option>';
				}else{
					echo '<option>male</option><option selected>female</option>';
				}
				?>
      </select> </td>
    </tr>
    <tr>
      <td><b>year</b></td>
      <td><select class="form-control" name="year" >
<?php
				$tag1 = '<option>';
				$stag = '<option selected>';
				$tag2 = '</option>';
				$b = 2008;
				$currentyear = date('Y');
				$interval = $currentyear - $c;
				for($i=$b;$i<=$currentyear;$i++){
				  if($i == $year){
				    echo "$stag $i $tag2";
				  }else{
				    echo "$tag1 $i $tag2";
				  }

				}
?>
  		</select></td>
    </tr>
    <tr>
      <td><b>school</b></td>
      <td><select class="form-control" name="school">
  			<option><?php echo $school; ?></option>
  		</select></td>
    </tr>
    <tr>
      <td colspan="2"><center><button class="btn btn-warning" name="edit" type="submit">Save Changes</button></center></td>
    </tr>
		<tr>
      <td colspan="2"><center><a href="account.php"><button class="btn btn-primary">Back</button></a></center></td>
    </tr>
  </tbody>
</table>
</div>

</form>


	</body>

</html>
