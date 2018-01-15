<?php
session_start();
if(!isset($_SESSION['userId']))
{
	header('location: login.php');
}
		$activeUser = trim($_SESSION['userId']);
		// h=hours i=minutes d=day m=month Y=year
		$s = date("s");
		$i = date("i");
		$h = date("h");
		$d = date("d");
		$y = date("Y");
		$m = date("m");
		if(date("a") == "pm"){
			$h = $h + 12;
		}
		$nottime = $y.$m.$d.$h.$i.$s;
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
	<script>
	$(document).ready(function(){
		//when comment button is clicked take PostId to comment modal
		$("[rel-data=comment]").click(function(){
			var commId = $(this).attr("rel-comment");
			$(".comment_submit").attr("rel-commId", commId);
			$(".comment_modal").slideDown(1000);
		});

		//when comment_submit is clicked // prevent default and do something else
	$(".comment_submit").click(function(e){
		e.preventDefault();
		$(".comment_txt").hide();
		$(".loader").show();
		//getting comment input and postId
		var commTxt = $(".comment_txt").val();
		var PostId =  $(this).attr("rel-commId");
		comData = {
			txt: commTxt,
			postId: PostId,
		}
		$.ajax({
			url: "ajax/comment.php",
			method: "GET",
			data: comData,
			success: function(e){
				var ch;
				if(e == 1){
					e = "Comment Added";
					$(".comm_sus").removeClass("alert-danger").addClass("alert-success");
					ch = 1;
				}else if(e == 2){
					e = "You can comment once on a post";
					$(".comm_sus").removeClass("alert-success").addClass("alert alert-danger");
					ch = 0;
				}
				$(".comm_sus").html(e);
				var get = $("[rel-commnum="+PostId+"]").html();
				var g = get * 1;
				$("[rel-commnum="+PostId+"]").html(g+ch);
				$(".loader").hide();
				$(".comment_txt").val("");
				$(".comm_sus").show();
				$(".comment_txt").show();
				setTimeout(
				function(){
					$(".comment_modal").hide();
				},
				5000);



			}
		})
	});
		//when comment cancel is clicked
		$(".comment_cancel").click(function(e){
			e.preventDefault();
			$(".comment_modal").hide();
		});

		//when upvote is clicked
		$("[rel-upvote]").click(function(){
			var action = $(this).attr("class");
			var postId = $(this).attr("rel-upvote");
			var a;
			if(action == "upvote"){
				a = "downvote";
			} else {
				a = "upvote";
			}


			var data = {
				postId: postId,
				action: action,
			}
		//send ajax to add upvote
			$.ajax({
				url: "ajax/upvote.php",
				method: "GET",
				data: data,
				success: function(e) {
					$("[rel-upvote="+postId+"]").attr("class",a);
					var get = $("[rel-upnum="+postId+"]").text();
					var g = get * 1;
					if(action == "upvote"){
						$("[rel-upnum="+postId+"]").text(g+1);
					} else {
						$("[rel-upnum="+postId+"]").text(g-1);
					}
				}
			});
		});


	});
	//This is a function to show user that whether post image is selected or not//
	function imageselected(){
		var f = $("#file").val();
		if(f.length > 0){
			$("#image-status").text("Image Selected");
		}else{
			$("#image-status").text("Add Image");
		}
	}
	</script>

		<title>
			GMSA
		</title>
	</head>

	<body class="feeds-body" >
	<style>
	.comment_modal {
		display: none;
	z-index: 3;
	width: 100%;
	height: 100%;
	background-color: rgba(0,0,0,0.65);
	position: fixed;
	top: 0px;
	right: 0px;
	left: 0px;
}
	.comment_modal_body {
		background-color:#fff;
		padding: 20px;
		min-height: 35%;
		max-height: 50%;
	}
	.loader {
		border: 5px solid #f3f3f3;
		border-top: 5px solid #3498db;
		border-radius: 50%;
		width: 50px;
		height: 50px;
		display: none;
		animation: spin 2s linear infinite;
	}
	@keyframes spin {
		0% {
			transform: rotate(0deg)
		}
		100% {
			transform: rotate(360deg)
		}
	}
	</style>
	<?php include 'header.php'; ?>
	<?php include 'sheader.php';?>
		<div class=" marginv-5p">



			<form action="feeds.php" enctype="multipart/form-data" method="POST">
			<div class="list-group">
				<textarea placeholder=" Write Your Post Here" name="postTxt" class="form-control postTxt" ></textarea>

						<label class="custom-file" style="cursor: pointer;float:right">
							<input style="display: none" onchange="imageselected()" class="custom-file-input" id="file" type="file" accept="image/*" name="file"/>
						  <span class="custom-file-control">
								<span style="padding:3px;margin-left: 10px;color:#fff;background-color:#000" href="#">
								<span class="glyphicon glyphicon-camera"></span> <span id="image-status">Add Image</span></span></span>
						</label>

				<BR />
				<button type="submit" name="postGo" class=" btn btn-primary addpost-btn">POST</button>
			</div>
			</form>


		</div>

		<?php
		include 'dbgmsa.php';


			if(isset($_POST['postGo']))
			{
				// getting data from user input

				// the htmlspecialchars allows user to input html codes and the ENT_QUOTES attached allows apostrophes
				$postTxt = nl2br(htmlspecialchars(stripcslashes(htmlentities($_POST['postTxt'])), ENT_QUOTES));
				$userId = $_SESSION['userId'];
				$school = $_SESSION['school'];
				$rand = rand(100,100000000000000);
				$rand1 = rand(100,100000000000000);
				$postId = "a".$rand."".$rand1;
				$postImg = 0;


					//uploading post image
					$location = 'uploads/images/posts/';
					$target_file = $location . basename($_FILES["file"]["name"]);
					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
					$name = "$postId.$imageFileType";
					$tmp_name = $_FILES["file"]["tmp_name"];
					$error = $_FILES["file"]["error"];

					if(!empty($name)) {
							//message for notification to show that an image was Added
							$message = ["added a new photo","posted an image","uploaded a new image"];
							$mrand = rand(0,sizeof($message)-1);
							$message = $message[$mrand];
						if(move_uploaded_file($tmp_name, $location.$name)){
							//inserting prototype into the database
							$postImg = $imageFileType;
						}else {
							// I've got nothing to do here!
						}
					}else{
						$message = ["created a new post","wrote a new post","made a new post"];
						$mrand = rand(0,sizeof($message)-1);
						$message = $message[$mrand];
					}





				// inserting post into database
				$query = "INSERT INTO posts (id,userId,postId,likes,comments,postTxt,postImg,activity,school)VALUES(null,'$userId','$postId','0','0','$postTxt','$postImg','added a new post','$school')";
				$query1 = "CREATE TABLE `".$postId."` (
							`id` int(11) NOT NULL AUTO_INCREMENT ,
							`userId` varchar(255) NOT NULL,
							`type` int(11) NOT NULL,
							`comment` varchar(255),
							PRIMARY KEY(id)
						) ENGINE = MyISAM";

							$insert = $connect->query($query);
							$insert1 = $Postconnect->query($query1);

				//code for notification to followers
				// 1 getting Followers
				$getf = $followconnect->query("SELECT userId FROM `$activeUser` WHERE follow=1");
				while($fetchf = $getf->fetch_assoc()){
					$followersId = $fetchf['userId'];

					//notifing the follower
					$activeUserName = $_SESSION['fullname'];
					$notify = $Notconnect->query("INSERT INTO `$followersId` (id,sname,senderId,message,type,link,lc,nottime)VALUES(null, '$activeUserName', '$activeUser', '$message', '1', 'story.php?postId=$postId','1','$nottime') ");
				}




				if($insert && $insert1)
				{
					echo "<div class='alert alert-success'>Your post has been added successfully</div>";

				}
				else
				{
					echo "<div class='alert alert-danger'>There was an error adding your post</div>";
					echo $connect->error;
				}
			}


		?>


		<div class="feeds">



		<?php
				//fetch posts
				$school = $_SESSION['school'];
				$pquery = "SELECT * FROM posts WHERE school='$school' ORDER BY id DESC LIMIT 0,50";
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

					//getting post user profile pic and name
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

					$lcheck = $Postconnect->query("SELECT * FROM `$PpostId` WHERE (type='1' || type='3') && userId='$activeUser' ");
					$row = mysqli_num_rows($lcheck);
					if($row==1)
					{
						echo '<div class="panel panel-default"><div class="panel-heading"><div class="post-uimg"><img src="uploads/images/profiles/'.$Puserpic.'"/></div><div class="post-uactivity"><a href="profile.php?ref='.$PuserId.'"><span class="post-uname">'.$Pusername.'</span></a> '.$Pactivity.'</div><div class="clear"></div></div><div class="panel-body"><p class="post-text">'.$PpostTxt.'</p><span class="post-img">'.$img.'</span></div><div class="panel-footer"><b><span rel-upnum="'.$PpostId.'">'.$Plikes.'</span> . <span class="downvote"  rel-upvote="'.$PpostId.'">Upvote</span> . <span rel-commnum="'.$PpostId.'">'.$Pcomments.'</span> <span color="color:#337ab7" rel-comment="'.$PpostId.'" rel-data="comment" >Comments</span> . <a href="story.php?postId='.$PpostId.'">Story</a></b></div></div>';

					}else{
						echo '<div class="panel panel-default"><div class="panel-heading"><div class="post-uimg"><img src="uploads/images/profiles/'.$Puserpic.'"/></div><div class="post-uactivity"><a href="profile.php?ref='.$PuserId.'"><span class="post-uname">'.$Pusername.'</span></a> '.$Pactivity.'</div><div class="clear"></div></div><div class="panel-body"><p class="post-text">'.$PpostTxt.'</p><span class="post-img">'.$img.'</span></div><div class="panel-footer"><b><span rel-upnum="'.$PpostId.'">'.$Plikes.'</span> . <span class="upvote"  rel-upvote="'.$PpostId.'">Upvote</span> . <span rel-commnum="'.$PpostId.'">'.$Pcomments.'</span> <span color="#337ab7" rel-comment="'.$PpostId.'" rel-data="comment" >Comments</span> . <a href="story.php?postId='.$PpostId.'">Story</a></b></div></div>';

					}

				}




		?>







		</div>

		<div class="comment_modal">
		<form>
			<div class="comment_modal_body">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h5 style="color: #337ab7;">Comment Box</h5>
					</div>
					<div class="panel-body">
						<div style="display:none" class="alert comm_sus">Your Comment has been successfully added</div>
						<input type="text" name="comment" placeholder="Enter your comment" class="form-control comment_txt" />
						<center><div class="loader"></div></center>
					</div>
					<div class="panel-footer">
					<button class="btn btn-danger comment_cancel">Cancel</button>
						<button type="submit" name="submit_comment" class="btn btn-primary pull-right comment_submit">Submit</button>
						<div class="clear"></div>
					</div>
				</div>
			</div>
		</form>
		</div>

<?php include 'footer.php';?>
	</body>

</html>
