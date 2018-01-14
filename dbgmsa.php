<?php
//linking the site to the GMSA database
	$connect = mysqli_connect("127.0.0.1","root","","gmsa");
//linking the site to the GMSA posts database
	$Postconnect = mysqli_connect("127.0.0.1","root","","gmsaposts");
//linking the site to the GMSA notifications database
	$Notconnect = mysqli_connect("127.0.0.1","root","","gmsanot");
//linking the site to the GMSA users chat database
	$chatconnect = mysqli_connect("127.0.0.1","root","","users_chat");
	//linking the site to the GMSA follow database
		$followconnect = mysqli_connect("127.0.0.1","root","","gmsafollow");
?>
