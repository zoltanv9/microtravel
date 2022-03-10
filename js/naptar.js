$(document).ready(function(){
      var date_input=$('input[name="date1"]'); // dátum bevitelünk neve "date1"
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        format: 'yyyy-mm-dd',
        container: container,
        todayHighlight: true,
        autoclose: true,
      };
      date_input.datepicker(options);
    })

	$(document).ready(function(){
      var date_input=$('input[name="date2"]'); // dátum bevitelünk neve "date2"
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        format: 'yyyy-mm-dd',
        container: container,
        todayHighlight: true,
        autoclose: true,

      };
      date_input.datepicker(options);
    })

	$.fn.datepicker.dates['en'] = {
    days: ["vasárnap", "hétfő", "kedd", "szerda", "csütörtök", "pénte", "szombat"],
    daysShort: ["va", "hé", "ke", "sze", "cs", "pé", "szo"],
    daysMin: ["va", "hé", "ke", "sze", "cs", "pé", "szo"],
    months: ["január", "február", "március", "április", "május", "június", "július", "augusztus", "szeptember", "október", "november", "december"],
    monthsShort: ["jan", "feb", "már", "ápr", "máj", "jún", "júl", "aug", "szept", "okt", "nov", "dec"],
    today: "Ma",
    clear: "törlés",
    format: "yyyy-mm-dd",
    //titleFormat: "yyyy MM", /* Használd ugyanazt a szintaxist, mint 'format' */
    weekStart: 1,
	orientation:'bottom-right'
};
