<?php
 include '../dbgmsa.php';
 session_start();



	 $postId = $_GET['postId'];
	 $comment = $_GET['txt'];
	 $activeUser = $_SESSION['userId'];
   $activeUserName = $_SESSION['fullname'];
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

   //messages that will be displayed as notification to users
   $message = ['left a comment on your post','commented on your post','placed a comment on your post'];
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
				$add = "UPDATE `$postId` SET type='3' WHERE userId='$activeUser' ;";
        $add .= "UPDATE `$postId` SET comment='$comment' WHERE userId='$activeUser' ";
        if(mysqli_multi_query($Postconnect,$add)){
          $add1 = $connect->query("UPDATE posts SET comments=(comments+1) WHERE postId='$postId' ");
        }


        $link = "story.php?postId=".$postId;
        if($sendNot){
          //sending user a notification
   		    $add = $Notconnect->query("INSERT INTO `$PuserId` (id,sname,senderId,message,type,link,lc,nottime)VALUES(null, '$activeUserName', '$activeUser', '$message', '2', 'story.php?postId=$postId','1','$nottime') ");
        }

        // this 1 is recieved in the jquery script that sent the AJAX request. It will inform the user that the comment has been added.
        echo 1;
      }else if($type==2){
        // this 2 is recieved in the jquery script that sent the AJAX request. It will inform the user that comments are only once.
				echo 2;
			 }else if($type==3){
        // same as the one above.
				echo 2;
			 }else if($type==0){
				$add = $Postconnect->query("UPDATE `$postId` SET type='2' WHERE userId='$activeUser' ");
				$add1 = $connect->query("UPDATE posts SET comments=(comments+1) WHERE postId='$postId' ");
        // same as the one above.
				echo 1;
			 }
			 else{
         // I've got nothing to do here!
			 }


		 }





	 } else {
		   //inserting comment in the db
			 $add = $Postconnect->query("INSERT INTO `$postId` (id,userId,type,comment)VALUES(null, '$activeUser','2','$comment') ");
       //increasing comments number of by one
			 $add1 = $connect->query("UPDATE posts SET comments=(comments+1) WHERE postId='$postId' ");
       if($sendNot){
         //sending user a notification
  		   $add2 = $Notconnect->query("INSERT INTO `$PuserId` (id,sname,senderId,message,type,link,lc,nottime)VALUES(null, '$activeUserName', '$activeUser', '$message', '2', 'story.php?postId=$postId','1','$nottime') ");
       }
       // same as the one above.
       echo 1;
	 }






?>
