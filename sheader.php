<script>
$(document).ready(function() {
	$("#livenot").load("ajax/getnot.php");
	$("#livechat").load("ajax/getchatnum.php");
	$("#livemessages").load("ajax/getmessages.php");
	setInterval(function(){
		$("#livenot").load("ajax/getnot.php");
		$("#livechat").load("ajax/getchatnum.php");
		$("#livemessages").load("ajax/getmessages.php");
	}, 1000);
});
</script>
<ul id="simple-nav">
	<a href="index.php"><li>Home</li></a>
	<a href="feeds.php"><li>Feeds </li></a>
	<a href="chat.php"><li>Chat <span id="livechat" class="badge"></span></li></a>
	<a href="messages.php"><li>Messages <span id="livemessages" class="badge"></span></li></a>
	<a href="notification.php">notifications <span id="livenot" class="badge"></span></a>
	<a href="find.php"><li>Find</li></a>
</ul>
