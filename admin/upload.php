<?php
session_start();
if(!isset($_SESSION['adminId']))
{
	header('location: ../admin');
}
$adminType = trim($_SESSION['admintype']);
if($adminType != 3){
	header('location: cpanel.php');
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

$year = $_SESSION['adminyear'];
if(isset($_POST['go'])){
  $page = htmlentities($_POST['page']);
  if(!empty($page)){

    //uploading image unto site
    $location = '../uploads/images/minutes/';
    $target_file = $location . basename($_FILES["file"]["name"]);
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    $name = "$year-$page.$imageFileType";
    $tmp_name = $_FILES["file"]["tmp_name"];
    $error = $_FILES["file"]["error"];
    $imagename = "default_profile6.png";

    if(!empty($_FILES["file"]["name"])) {

      if(move_uploaded_file($tmp_name, $location.$name)){
        //inserting prototype into the database
        //inserting info into the database
          $query = "INSERT INTO minutepics (id,year,page,image)VALUES(null,'$year','$page','$name')";
          $insert = $connect->query($query);
          echo $connect->error;
          if($insert){
            echo "<div class='alert alert-success'>Page $page added successfully!</div>";
          }else{
            echo "<div class='alert alert-danger'>Error adding page. try again!</div>";
          }

      }else {
        echo "<div class='alert alert-danger'>Error adding page. try again!</div>";
      }
    }else{
      echo "<div class='alert alert-warning'>No image has been selected</div>";
    }

  }else{
    echo "<div class='alert alert-danger'>Please select a page number before uploading</div>";
  }





	}


  ?>
  <form method="POST" enctype="multipart/form-data" action="upload.php">
  <center>
    <label class="custom-file" style="cursor: pointer;">
      <input style="display: none;" onchange="imageselected()" name="file" type="file" id="file" class="custom-file-input">
      <span class="custom-file-control">
          <div class="add-photo">
          Select Photo
          </div>
        </span>
    </label>
    <br />
    <br />


  <span type="button" class="label label-success">Minute book</span>
</center>
<div class="container">
	<?php
	$get = $connect->query("SELECT page FROM minutepics WHERE year='$year' ORDER BY page DESC LIMIT 1");
	while($fetch = $get->fetch_assoc()){
		$recentpage = $fetch['page'];
	}
	if(empty($recentpage)){
		$recentpage = 0;
	}
	echo "<center><div style='margin-top:5px' class='alert alert-warning'>Page reached - <b>Page $recentpage</b></div></center>";
	?>
<input type="number" class="form-control" style="margin-top:5px" placeholder="Page number" name="page">


<br>
<button type="submit" name="go" class="form-control btn btn-success" name="button">Add Page</button><br>
</form>
<center><a href="cpanel.php"><button type="button" style="margin-top:10px" class="btn btn-secondary" name="button">Back</button></a></center>
</div>




	</body>

</html>
