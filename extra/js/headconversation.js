
$(document).ready(function(){
  var top = $('.ud').height()+$('#simple-nav').height();
  $('.mb').css("top", top);
  // scrolls chat to the bottom.
  function scrollToBottom(){
    $('.mb').animate({scrollTop:100000}, 'slow');
  }
  scrollToBottom();
  //fetching the messages every second
  $(".loading").load("ajax/markread.php");
  $(".mb").load("ajax/getmsg.php");
	setInterval(function(){
		$(".mb").load("ajax/getheadmsg.php");
    //This is where u mark all messages as read;
	}, 1000);

  //checking user availability every minute
  $("#user-status").load("ajax/userlastseen.php");
	setInterval(function(){
    $("#user-status").load("ajax/userlastseen.php");
	}, 60000);


  //when send button is clicked
  $("#msg-send").click(function(){
    var msg = $("#msg-txt").val();

    var data = {
      message: msg,
    }

    $.ajax({
      url: "ajax/chat.php",
      method: "GET",
      data: data,
      success: function(e) {
          if(e = 1){
            //clearing the textarea
            $("#msg-txt").val('');
            setTimeout(function(){
              scrollToBottom();
            },1500);

          }else{
            alert('There was an error sending your message!');
            //clearing the textarea
            $("#msg-txt").val('');
          }
      },
      error: function() {
        alert('error');
      }
    });



  });


});
