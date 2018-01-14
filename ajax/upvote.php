<?php
 include '../dbgmsa.php';
 session_start();


	 $postId = $_GET['postId'];
	 $activeUser = $_SESSION['userId'];
   $activeUserName = $_SESSION['fullname'];

   //message that will be displayed as notification to users
   $message = ['gave an upvote on your post','upvoted on your post','raised an upvote on your post'];
   $rand = rand(0,sizeof($message)-1);
   $message = $message[$rand];
   //getting Id of Post owner in order to be able to send notifications
   $getPuserId = $connect->query("SELECT userId FROM posts WHERE postId='$postId' ");
   while($getPuserId1 = $getPuserId->fetch_assoc()){
     $PuserId = $getPuserId1['userId'];
   }
   if($PuserId == $activeUser){
     $sendNot = false;
   }else{
     $sendNot = true;
   }

	 $check1 = $Postconnect->query("SELECT * FROM `$postId` WHERE userId='$activeUser' ");
	 $check = mysqli_num_rows($check1);
	 if($check == 1)
	 {
		 $check2 = $Postconnect->query("SELECT * FROM `$postId` WHERE userId='$activeUser' ");
		 while($check3 = $check2->fetch_assoc())
		 {
			 $type = $check3['type'];

			 if($type==1)
			 {
				$add = $Postconnect->query("UPDATE `$postId` SET type='0' WHERE userId='$activeUser' ");
				$add1 = $connect->query("UPDATE posts SET likes=(likes-1) WHERE postId='$postId' ");
			 }
			 else if($type==2)
			 {
        $link = "story.php?postId=".$postId;
        $check = $Notconnect->query("SELECT lc FROM `$PuserId` WHERE link='$link' AND type='2'");
        while($check1 = $check->fetch_assoc()){
          $lc = $check1['lc'];
        }
        if($lc == 0){
          if($sendNot){
            //sending user a notification
     		   $add = $Notconnect->query("INSERT INTO `$PuserId` (id,sname,senderId,message,type,link,lc)VALUES(null, '$activeUserName', '$activeUser', '$message', '1', 'story.php?postId=$postId','1') ");
          }
        }
        //updating post type
        $add = $Postconnect->query("UPDATE `$postId` SET type='3' WHERE userId='$activeUser' ");
        //increasing likes by one
        $add1 = $connect->query("UPDATE posts SET likes=(likes+1) WHERE postId='$postId' ");

			 }
			 else if($type==3)
			 {
				$add = $Postconnect->query("UPDATE `$postId` SET type='2' WHERE userId='$activeUser' ");
				$add1 = $connect->query("UPDATE posts SET likes=(likes-1) WHERE postId='$postId' ");

			 }
			 else if($type==0)
			 {
				$add = $Postconnect->query("UPDATE `$postId` SET type='1' WHERE userId='$activeUser' ");
				$add1 = $connect->query("UPDATE posts SET likes=(likes+1) WHERE postId='$postId' ");

			 }else{
         // I've got nothing to do here!
			 }

		 }





	 } else {
        //inserting upvote in the db
        $add = $Postconnect->query("INSERT INTO `$postId` (id,userId,type,comment)VALUES(null, '$activeUser','1','') ");
        //increasing likes by one
        $add1 = $connect->query("UPDATE posts SET likes=(likes+1) WHERE postId='$postId' ");
        if($sendNot){
        //sending user a notification
        $add2 = $Notconnect->query("INSERT INTO `$PuserId` (id,sname,senderId,message,type,link,lc)VALUES(null, '$activeUserName', '$activeUser', '$message', '1', 'story.php?postId=$postId','1') ");
      }
		}






?>
