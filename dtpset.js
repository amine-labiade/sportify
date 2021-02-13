$('#dtpx').datetimepicker({
  timepicker: false,
  minDate:'-1970/01/01',
  dayOfWeekStart: 1,
  format:'d.m.Y',
  onSelectDate:function(dp,$input){
  var r_date = $input.val();
  var std = $('.checkrad:checked').parent().prevAll().eq(2).text();
  jQuery.ajax({
    url : location.origin + "/allowed.php",
    method : "POST",
    data : {r_date:r_date, std:std},
    dataType:"json",
    success:function(data){
        //var result = [];
        var dta0 = data['0'];
        var dta1 = data['1'];
        var dta2 = data['2'];
        //alert(dta0[0]);

        //result.push(String(data[i]));
        //alert(String(data[i]));
        $('#tp1').datetimepicker({
          onGenerate:function(){
            for(var i in dta0){
              $('.xdsoft_time[data-hour=' + String(dta0[i]) + ']').css('background-color' , '#CB5D61');
              $('.xdsoft_time[data-hour=' + String(dta0[i]) + ']').prop('disabled' , true);
            }
            for(var j in dta1){
              $('.xdsoft_time[data-hour=' + String(dta1[j]) + ']').css('background-color' , '#CB5D61');
              $('.xdsoft_time[data-hour=' + String(dta1[j]) + ']').prop('disabled' , true);
            }
          }
        });

        $('#tp2').datetimepicker({
          onGenerate:function(){
            for(var i in dta0){
              $('.xdsoft_time[data-hour=' + String(dta0[i]) + ']').css('background-color' , '#CB5D61');
              $('.xdsoft_time[data-hour=' + String(dta0[i]) + ']').prop('disabled' , true);
            }
            for(var i in dta2){
              $('.xdsoft_time[data-hour=' + String(dta2[i]) + ']').css('background-color' , '#CB5D61');
              $('.xdsoft_time[data-hour=' + String(dta2[i]) + ']').prop('disabled' , true);
            }
          }
        });
      }
    });
  }
});

jQuery('#dtpy').datetimepicker({
  timepicker: false,
  minDate:'-1970/01/01',
  dayOfWeekStart: 1,
  format:'d.m.Y'
});



jQuery('#tp1').datetimepicker({
  datepicker: false,
  minTime: '7:00' ,
  maxTime:'21:00',
  format : 'H:i'

});
jQuery('#tp2').datetimepicker({
  datepicker: false,
  minTime: '7:00' ,
  maxTime:'21:00',
  format : 'H:i'
});


$.datetimepicker.setLocale('fr');
