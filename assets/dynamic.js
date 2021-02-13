function getTypo(str){
  var xhttp;
  if (str == "") {
    document.getElementById("type").innerHTML = "<option>--Choose a type--</option>";
    return ;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("type").innerHTML = this.responseText;
    }
  };
  str = encodeURIComponent(str);
  xhttp.open("GET", "/assets/dynamic1.php?city="+str,true);
  xhttp.send();
}


function getSTD(str1 , str2){
  var xhttp;
  if (str1 == "" || str2 == ""){
    document.getElementById("showcase").innerHTML = "";
    return ;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("showcase").innerHTML = this.responseText;
    }
  };
  str1 = encodeURIComponent(str1);
  str2 = encodeURIComponent(str2);
  xhttp.open("GET", "/assets/dynamic2.php?type="+str1+"&city="+str2 ,true);
  xhttp.send()
}


function dtpPop(){
    $('.checkrad').on('click', function(){
        $('.checkrad').closest('.sc').hide();
        $('.checkrad:checked').closest('.sc').show();
        var div_data = "<div class=\"card cdtp \">\r\n  <div class=\"dtp\">\r\n    <div>\r\n      <label for=\"dtpx\">Date:<\/label>\r\n      <input class=\"form-control datetimepicker\" class=\"datetimepicker\" id=\"dtpx\" type=\"text\" name=\"start\"  autocomplete=\"off\">\r\n    <\/div>\r\n    <div class=\"row\">\r\n      <div class=\"col-6\">\r\n        <label for=\"tp1\">From : <\/label>\r\n        <input class=\"form-control datetimepicker\" class=\"datetimepicker\" id=\"tp1\" type=\"text\" name=\"start\"  autocomplete=\"off\">\r\n      <\/div>\r\n      <div class=\"col-6\">\r\n        <label for=\"tp2\">To :\u200E\u200F\u200F\u200E<\/label>\r\n        <input class=\"form-control datetimepicker\" class=\"datetimepicker\" id=\"tp2\" type=\"text\" name=\"start\"  autocomplete=\"off\">\r\n      <\/div>\r\n    <\/div>\r\n    <button id=\"book\" class=\"btn btn-primary mt-3\" type=\"button\" name=\"button\" onclick=\"book(storeBookingData()[0],storeBookingData()[1],storeBookingData()[2],storeBookingData()[3])\">book<\/button>\r\n    <script src=\"\/dtpset.js\"><\/script>\r\n  <\/div>    \r\n<\/div>" ;
        if($('.checkrad:checked').closest('.sc').hasClass("cleft")){
          if($(this).closest('.sc').next().length != 0){
            $(this).closest('.sc').next().html(div_data).show();
          }else{
            var div_data = "<div class=\"col-6 cright\">\r\n  <div class=\"card cdtp \">\r\n    <div class=\"dtp\">\r\n      <div>\r\n        <label for=\"dtpx\">Date:<\/label>\r\n        <input class=\"form-control datetimepicker\" class=\"datetimepicker\" id=\"dtpx\" type=\"text\" name=\"start\"  autocomplete=\"off\">\r\n      <\/div>\r\n      <div class=\"row\">\r\n        <div class=\"col-6\">\r\n          <label for=\"tp1\">From : <\/label>\r\n          <input class=\"form-control datetimepicker\" class=\"datetimepicker\" id=\"tp1\" type=\"text\" name=\"start\"  autocomplete=\"off\">\r\n        <\/div>\r\n        <div class=\"col-6\">\r\n          <label for=\"tp2\">To :\u200E\u200F\u200F\u200E<\/label>\r\n          <input class=\"form-control datetimepicker\" class=\"datetimepicker\" id=\"tp2\" type=\"text\" name=\"start\"  autocomplete=\"off\">\r\n        <\/div>\r\n      <\/div>\r\n      <button id=\"book\" class=\"btn btn-primary mt-3\" type=\"button\" name=\"button\" onclick=\"book(storeBookingData()[0],storeBookingData()[1],storeBookingData()[2],storeBookingData()[3])\">book<\/button>\r\n      <script src=\"\/dtpset.js\"><\/script>\r\n    <\/div>    \r\n  <\/div>\r\n<\/div>" ;
            $(this).closest('.sc').after(div_data).show();
          }
        }else {
            $(this).closest('.sc').prev().html(div_data).show();
          }
    });
}


function book(str1 , str2  , str3 , str4){
  var xhttp;
  if (str1 == "" || str2 == "" || str3 == "" || str4 == "") {
    alert("something is missing");
    return ;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      $(function(){
        $('#notify').fadeOut(5000);
      });
      str1 = encodeURIComponent(str1);
      str2 = encodeURIComponent(str2);
      str3 = encodeURIComponent(str3);
      str4 = encodeURIComponent(str4);
      document.getElementById("v-pills-book").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "/assets/dynamic3.php?std="+str1+"&r_date="+str2+"&start="+str3+"&end="+str4,true);
  xhttp.send();
}


function addZero(i) {
  if (i < 10) {
    i = "0" + i;
  }
  return i;
}

function storeBookingData(){

      var std = $('.checkrad:checked').parent().prevAll().eq(2).text();

      var a = $('#dtpx').datetimepicker('getValue');
      var b = $('#tp1').datetimepicker('getValue');
      var c = $('#tp2').datetimepicker('getValue');

      r_date = a.getFullYear()+"-"+(a.getMonth()+1)+"-"+a.getDate();
      startTime = addZero(b.getHours())+":00";
      endTime = addZero(c.getHours())+":00";
      var all = [std ,r_date , startTime , endTime];
      return all ;
}


function storeCity(){
  var x = document.getElementById("city");
  var val = x.options[x.selectedIndex].value;
  return val;
}

$(function(){
  $('#city').on('change', function() {
    $('.showy').hide();
  });
});
