<?php
session_start();
if(!isset($_SESSION['userId']))
{
	header('location: login.php');
}
if(isset($_GET['postId'])){
	$inPostId = $_GET['postId'];
}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Story</title>
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
		$(".comment_modal").hide();
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
				$("[rel-commnum="+PostId+"]").text(g+ch);
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
		//when outside modal is clicked
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
	</script>

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
	</head>
	<body>
	<?php include 'header.php';?>
	<?php include 'sheader.php';?>
	<BR />
	<?php
	include 'dbgmsa.php';
	//fetching post
				$pquery = "SELECT * FROM posts WHERE postId='$inPostId'";
				$get1 = $connect->query($pquery);
				while($get = $get1->fetch_assoc())
				{
					$PuserId = $get['userId'];
					$PpostId = $get['postId'];
					$Plikes = $get['likes'];
					$Pcomments = $get['comments'];
					$PpostTxt = $get['postTxt'];
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
						$img = '';
					}

					$lcheck = $Postconnect->query("SELECT * FROM `$PpostId` WHERE (type='1' || type='3') && userId='$_SESSION[userId]' ");
					$row = mysqli_num_rows($lcheck);
					if($row==1)
					{
						echo '<div style="border-radius:0px" class="panel panel-default"><div class="panel-heading"><div class="post-uimg"><img src="uploads/images/profiles/'.$Puserpic.'"/></div><div class="post-uactivity"><span class="post-uname">'.$Pusername.'</span></div><div class="clear"></div></div><div class="panel-body"><p class="post-text">'.$PpostTxt.'</p><span class="post-img">'.$img.'</span></div><div class="panel-footer"><b><span rel-upnum="'.$PpostId.'">'.$Plikes.'</span> . <a href="#" class="downvote"  rel-upvote="'.$PpostId.'">Upvote</a> . <span rel-commnum="'.$PpostId.'">'.$Pcomments.'</span> <span rel-comment="'.$PpostId.'" rel-data="comment" >Comments</span> </b></div></div>';

					}else{
						echo '<div style="border-radius:0px"  class="panel panel-default"><div class="panel-heading"><div class="post-uimg"><img src="uploads/images/profiles/'.$Puserpic.'"/></div><div class="post-uactivity"><span class="post-uname">'.$Pusername.'</span></div><div class="clear"></div></div><div class="panel-body"><p class="post-text">'.$PpostTxt.'</p><span class="post-img">'.$img.'</span></div><div class="panel-footer"><b><span rel-upnum="'.$PpostId.'">'.$Plikes.'</span> . <a href="#" class="upvote"  rel-upvote="'.$PpostId.'">Upvote</a> . <span rel-commnum="'.$PpostId.'">'.$Pcomments.'</span> <span rel-comment="'.$PpostId.'" rel-data="comment" >Comments</span> </b></div></div>';

					}

				}

				echo "<HR><center><b>Comments</b></center><ol class='list-group'>";
				//fetching comments of the post
				$cquery = "SELECT * FROM `$inPostId` WHERE type='2' || type='3'";
				$cFetch1 = $Postconnect->query($cquery);
				$color_switch = 1;
				while($cFetch = $cFetch1->fetch_assoc())
				{
					$cUserId = $cFetch['userId'];
					$cComment = $cFetch['comment'];
					if($color_switch == 1)
					{
						$bg_color = "#333";
						$color = "#fff";
					}else{
						$bg_color = "#fff";
						$color = "#333";
					}
					echo '<li style="background-color: '.$bg_color.';color: '.$color.';border-radius: 0px" class="list-group-item"><b>'.$cUserId.'</b><p>'.$cComment.'</p></li>';
					$color_switch = $color_switch * -1;
				}

				echo "</ol>";
	?>

	</ol>


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

	</body>
</html>
