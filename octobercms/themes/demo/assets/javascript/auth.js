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