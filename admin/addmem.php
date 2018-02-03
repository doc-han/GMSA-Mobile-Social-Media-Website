<?php
session_start();
if(!isset($_SESSION['adminId']))
{
	header('location: ../admin');
}
$adminType = trim($_SESSION['admintype']);
if($adminType == 1){
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
function show(){
  var val = $("[name=event]").val();
  if(val=="add"){
    $("[name=new-event]").show();
  }else{
    $("[name=new-event]").hide();
  }

  var a = $("[name=new-event]");
  if(a.css("display") == "none"){
    a.val("");
  }

}

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
if(isset($_POST['go'])){
  $year = htmlentities($_POST['year']);
  $event = htmlentities(trim($_POST['event']));
  $newEvent = htmlentities(trim($_POST['new-event']));
  if($newEvent != ""){
    $event = $newEvent;

          //uploading image unto site
          $location = '../uploads/images/memories/';
          $target_file = $location . basename($_FILES["file"]["name"]);
          $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
          $name = $_FILES["file"]["name"];
          $tmp_name = $_FILES["file"]["tmp_name"];
          $error = $_FILES["file"]["error"];

          if(!empty($name)) {

            if(move_uploaded_file($tmp_name, $target_file)){

                //inserting blueprint into the database
                $query = "INSERT INTO memories (id,year,event,image)VALUES(null,'$year','$event','$name')";
                $insert = $connect->query($query);
                if($insert){
                  echo "<div class='alert alert-success'>Image uploaded successfully</div>";
									$event == "0";
                }else{
                  echo "<div class='alert alert-warning'>Error Uploading Memory. Try again</div>";
                }

            }else {
              echo "<div class='alert alert-warning'>Error Uploading Memory. Try again</div>";
            }
          }else{
						echo "<div class='alert alert-warning'><b>No Image selected</b></div>";
					}

  }else{
    if($event == "0" || $event == "add"){
      echo '<div class="alert alert-warning"><b>No Event was selected</b></div>';
    }else{
			//uploading image unto site
			$location = '../uploads/images/memories/';
			$target_file = $location . basename($_FILES["file"]["name"]);
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			$r = rand(100,1000000000);
			$name = "$year-$r.$imageFileType";
			$tmp_name = $_FILES["file"]["tmp_name"];
			$error = $_FILES["file"]["error"];

			if(!empty($name)) {

				if(move_uploaded_file($tmp_name, $location.$name)){

						//inserting blueprint into the database
						$query = "INSERT INTO memories (id,year,event,image)VALUES(null,'$year','$event','$name')";
						$insert = $connect->query($query);
						if($insert){
							echo "<div class='alert alert-success'>Image uploaded successfully</div>";
							$event == "0";
						}else{
							echo "<div class='alert alert-warning'>Error Uploading Memory. Try again</div>";
						}

				}else {
					echo "<div class='alert alert-warning'>Error Uploading Memory. Try again</div>";
				}
			}else{
				echo "<div class='alert alert-warning'><b>No Image selected</b></div>";
			}
		}
  }





	}


  ?>
  <form method="POST" enctype="multipart/form-data" action="addmem.php">
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


  <span type="button" class="label label-success">Memories</span>

</center><br>
<div class="container">

<select class="form-control" style="margin-top:5px" name="year" value="<?php echo $year; ?>" type="year" >
	<option value="<?php echo $_SESSION['adminyear'];?>"><?php echo $_SESSION['adminyear'];?></option>
</select>
<select onchange="show()" name="event" class="form-control" style="margin-top:5px" >
	<option value="0">Select Event</option>
	<?php
$a = [];
$num = 0;
$ayear = trim($_SESSION['adminyear']);
$query = "SELECT event FROM memories WHERE year='$ayear' ORDER BY id DESC";
$get = $connect->query($query);
while($fetch = $get->fetch_assoc()){
$event = $fetch['event'];
if(!in_array($event, $a)){
	echo "<option>$event</option>";
	$a[$num] = $event;
	$num++;
}

}

	?>
  <option value="add">Add Event</option>
</select>
<input type="text" name="new-event" style="margin-top:5px;display:none" class="form-control" placeholder="Enter event name">
<br>
<button type="submit" name="go" class="form-control btn btn-success" name="button">Add Memory</button><br>
</form>
<center><a href="cpanel.php"><button type="button" style="margin-top:10px" class="btn btn-secondary" name="button">Back</button></a></center>

</div>


	</body>

</html>
