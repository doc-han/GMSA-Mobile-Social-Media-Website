
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
if(isset($_POST['go'])){
  $fullname = htmlentities(trim($_POST['fullname']));
  $name = explode(" ", $fullname);
  $adminId = $name[0].rand(100,1000);
  $phone = htmlentities(trim($_POST['phone-email']));
  $pass = htmlentities(trim(md5($_POST['pass'])));
  $adminType = htmlentities(trim($_POST['admin-type']));
  $year = htmlentities(trim($_POST['year']));
  $code = htmlentities(trim($_POST['code']));

  if($code == "allahuakbar1" || $code == "patron6162"){
    //checking for availability of admin
    $check = $connect->query("SELECT `phone-email` FROM admins WHERE `phone-email`='$phone'");
    if(mysqli_num_rows($check) > 0){
      echo "<div class='alert alert-warning'>Admin account for ".$name[0]." has already been created</div>";
    }else{
      //insert details
      $query = "INSERT INTO admins (id,adminId,fullname,`phone-email`,pass,type,year)VALUES(null,'$adminId','$fullname','$phone','$pass','$adminType','$year')";
  	  if($insert = $connect->query($query)){
        echo "<div class='alert alert-success'>Admin account has been created for ".$name[0]."</div>";
      }else{
        echo "<div class='alert alert-danger'>There was an error creating the admin account. try again!</div>";
        echo $connect->error;
      }
    }


  }else{
    //not the main admin
    echo "<div class='alert alert-warning'>You can't create an admin account if you are not a creator!</div>";
  }

}






  ?>
  <form method="POST" action="create.php">
  <center>

    <br />
    <br />


  <span type="button" class="label label-danger">Admin</span>

</center><br>
<div class="container">
<input type="text" class="form-control" style="margin-top:5px" placeholder="Fullname" name="fullname">
<input type="text" class="form-control" style="margin-top:5px" placeholder="Phone or Email" name="phone-email">
<input type="password" class="form-control" style="margin-top:5px" placeholder="Password" name="pass">
<select style="margin-top:5px" class="form-control" name="admin-type">
  <option>Type</option>
  <option value="1">President</option>
  <option value="2">Vice President</option>
	<option value="3">General Secretary</option>
</select>

<select style="margin-top:5px" class="form-control" name="year">
  <?php

        $selectedyear = date(Y);

  			$tag1 = '<option>';
  			$stag = '<option selected>';
  			$tag2 = '</option>';
  			$b = 2008;
  			$currentyear = date('Y');
  			$interval = $currentyear - $b;
  			for($i=$currentyear;$i>=$b;$i--){
          if(!isset($selectedyear)){
            if($i == $_SESSION['year']){
    					echo "$stag $i $tag2";
    				}else{
    					echo "$tag1 $i $tag2";
    				}
          }else{
            if($i == $selectedyear){
    					echo "$stag $i $tag2";
    				}else{
    					echo "$tag1 $i $tag2";
    				}
          }


  			}
  ?>
</select>

<input type="password" class="form-control" style="margin-top:5px" placeholder="Creator code" name="code">

<button style="margin-top:5px" type="submit" name="go" class="form-control btn btn-success" name="button">Create Admin</button><br>
</form>
</div>

<?php include '../footer.php'; ?>


	</body>

</html>
