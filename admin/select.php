<?php
session_start();
if(!isset($_SESSION['adminId']))
{
	header('location: login.php');
}
$adminType = trim($_SESSION['admintype']);
if($adminType != 1){
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

	<!--linking the javascript files-->
	<script src="../extra/js/jquery-3.2.1.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $("li").click(function(){
        var id = $(this).attr("rel");
        $(this).addClass("disabled");
        if($(this).hasClass("active")){
          var action = 0;
          $(this).removeClass("active");
        }else{
          var action = 1;
        }

        var data = {
          id: id,
          action: action,
        }

        $.ajax({
          url: "../ajax/select.php",
          method: "GET",
          data: data,
          success: function(e) {
            if(e == 1){
              //worked
              $("[rel="+id+"]").removeClass("disabled");
              $("[rel="+id+"]").addClass("active");
              $("[rel="+id+"] .pull-right").text("selected");
            }else if(e == 2){
              $("[rel="+id+"]").removeClass("disabled");
              $("[rel="+id+"]").removeClass("active");
              $("[rel="+id+"] .pull-right").text("select");
            }else{
              //did not work
              $("[rel="+id+"]").removeClass("disabled");
            }

          },
          error: function() {
            alert('error');
          }
        });

      });
    });
  </script>

		<title>
			GMSA
		</title>
	</head>

	<body class="main-body" >
		<?php
		include 'header.php';
		?>
		<BR />

	<BR />

	<div class="list-group">
	<ol style="padding:0px">
		<?php
		include '../dbgmsa.php';
$year = $_SESSION['adminyear'];
$year = $year - 2;//this is because the admin year is greater than the members year for a group
        $query = "SELECT fullname,userId,profilepic,exe FROM users WHERE year='$year' ORDER BY firstname";
        $get = $connect->query($query);
        while($fetch = $get->fetch_assoc()){
          $fullname = $fetch['fullname'];
          $userId = $fetch['userId'];
          $profilepic = $fetch['profilepic'];
          $exe = $fetch['exe'];
          if($exe == '1'){
            echo '<li class="list-group-item active" rel='.$userId.'><img src="../uploads/images/profiles/'.$profilepic.'" class="chat-img"><strong><span class="list-group-item-heading" style="line-height:50px">'.$fullname.'</span></strong><span style="line-height:50px" class="pull-right">selected</span></li> ';
          }else{
            echo '<li class="list-group-item" rel='.$userId.'><img src="../uploads/images/profiles/'.$profilepic.'" class="chat-img"><strong><span class="list-group-item-heading" style="line-height:50px">'.$fullname.'</span></strong><span style="line-height:50px" class="pull-right">select</span></li> ';
          }
        }




		?>
	</ol>
	</div>



	</body>

</html>
