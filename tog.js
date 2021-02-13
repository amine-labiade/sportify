$(document).ready(function(){
  $('.register').hide();

  $('#btn_1').on('click', function(){
    $('.login').show(300),
    $('.register').hide();
  });

$('#btn_2').on('click', function(){
  $('.login').hide(),
  $('.register').show(300);
});
});
