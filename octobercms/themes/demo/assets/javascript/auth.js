/*
*   Send login form and get json response
*/
$(function(){
  $('form[name=login]').submit(function(){
    $.post($(this).attr('action'), $(this).serialize(), function(json) {
      alert(json);
    }, 'json');
    return false;
  });
});



$("#login").submit(function(event) {

    var formData = new FormData();
    formData.append("uploadFiles", $('[name="file"]')[0].files[0]);
    event.stopPropagation();
    event.preventDefault();
    $.ajax({
      url: $(this).attr("action"),
      data: formData,
      processData: false,
      contentType: false,
      type: 'POST',
      success: function(data) {
        alert(data);
        loadFiles()
      }
    });
    return false;
  });
  
  
  
  
  	$(document).ready(function(){
  $("#submit").click(function(){
    $.post("demo_test_post.asp",
    {
      name: "Donald Duck",
      city: "Duckburg"
    },
    function(data,status){
      alert("Data: " + data + "\nStatus: " + status);
    });
  });
});