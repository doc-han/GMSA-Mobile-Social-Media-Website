$(document).ready(function(){
  //function sends ajax to php code
  function update(){

    var data = {
      action: "update",
    }

    $.ajax({
      url: "ajax/lastActivity.php",
      method: "GET",
      data: data
    });
  }
  update();

  //calling the update function every 2 minutes
  setInterval(function(){
    update();
  },60000);

});
