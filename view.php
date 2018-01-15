<?php
session_start();
if(!isset($_SESSION['userId']))
{
	header('location: login.php');
}else if(isset($_GET['cat']) && isset($_GET['ref'])){
  $user = trim($_GET['ref']);
  $cat = trim($_GET['cat']);
  switch($cat){
    case 'followers':
      $var = 1;
      $isPost = false;
      $header = "Followers";
      break;
    case 'following':
      $var = 0;
      $isPost = false;
      $header = "Following";
      break;
    case 'posts':
      $isPost = true;
      $header = "Posts";
      break;
    default:
    //nothing to do here yet
  }
}else{
  //redirect to 404
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

	<!--linking the javascript files-->
	<script src="extra/js/jquery-3.2.1.js"></script>
	<script src="extra/js/lastActivity.js"></script>

<script src="extra/js/jquery-3.2.1.js"></script>
		<title>
			GMSA
		</title>
	</head>

	<body class="main-body" >
		<?php
		include 'header.php';
		include 'sheader.php';
		?>
    <div class=" marginv-5p">
			<center><h4 style="color:#fff;padding-bottom:10px;font-weight:bolder;background-color:rgba(0,0,0,0.54)"><?php echo $header;?></h4></center>



	<div class="list-group">
	<ol style="padding:0px">
<?php
include 'dbgmsa.php';
if($isPost){
  //getting posts by user
  $pquery = "SELECT * FROM posts WHERE userId='$user' ORDER BY id DESC";
  $get1 = $connect->query($pquery);
  while($get = $get1->fetch_assoc())
  {
    $PuserId = $get['userId'];
    $PpostId = $get['postId'];
    $Plikes = $get['likes'];
    $Pcomments = $get['comments'];
    $PpostTxt = html_entity_decode($get['postTxt']);
    $PpostImg = $get['postImg'];
    $Pactivity = $get['activity'];
    $Pschool = $get['school'];

    //getting post user profile pic
    $getpic = $connect->query("SELECT profilepic,fullname FROM users WHERE userId='$PuserId'");
    while($picfetch = $getpic->fetch_assoc()){
      $Puserpic = $picfetch['profilepic'];
      $Pusername = $picfetch['fullname'];
    }
    if($PpostImg != '0'){
      $img = '<img src="uploads/images/posts/'.$PpostId.'.'.$PpostImg.'" >';
    }else{
      $img = null;
    }

      echo '<div class="panel panel-default"><div class="panel-heading"><div class="post-uimg"><img src="uploads/images/profiles/'.$Puserpic.'"/></div><div class="post-uactivity"><a href="profile.php?ref='.$PuserId.'"><span class="post-uname">'.$Pusername.'</span></a> '.$Pactivity.'</div><div class="clear"></div></div><div class="panel-body"><p class="post-text">'.$PpostTxt.'</p><span class="post-img">'.$img.'</span></div><div class="panel-footer"><b> <a href="story.php?postId='.$PpostId.'">View Full Story</a></b></div></div>';


  }

}else{
  //getting followers or people user is following
  $query = "SELECT userId FROM `$user` WHERE follow='$var'";
  $get = $followconnect->query($query);
  while($fetch = $get->fetch_assoc()){
    $fid = $fetch['userId'];

    //getting user actual name and pic
    $getinfo = $connect->query("SELECT profilepic,fullname FROM users WHERE userId='$fid'");
    while($infofetch = $getinfo->fetch_assoc()){
      $fpic = $infofetch['profilepic'];
      $fname = $infofetch['fullname'];
    }
    echo '<a href="profile.php?ref='.$fid.'"><li class="list-group-item "><img src="uploads/images/profiles/'.$fpic.'" class="chat-img"><span class="list-group-item-heading" style="line-height:50px"><strong>'.$fname.'</strong></span> <span style="line-height:50px;float:right"></span></li></a>';
  }
}




?>
	</ol>
	</div>



	</body>

</html>
