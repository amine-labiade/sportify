function getHistory(){
  var a = $('#dtpy').datetimepicker('getValue');
  r_date = a.getFullYear()+"-"+(a.getMonth()+1)+"-"+a.getDate();

  var xhttp;
  if (r_date == "") {
    document.getElementById("history").innerHTML = "";
    return ;
  }
  
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("history").innerHTML = this.responseText;
    }
  };
  r_date = encodeURIComponent(r_date);
  xhttp.open("GET", "history.php?dater="+r_date,true);
  xhttp.send();
}
