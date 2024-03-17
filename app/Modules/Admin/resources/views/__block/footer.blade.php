<script type="text/javascript" src="/admin-asset/drobsone/js/main.js"></script>
		
	 <script src="/p/jquery-ui.js"></script>



	
<script>
  $( "#datepicker" ).datepicker({
	  	inline: true,
		dateFormat: "yy-mm-d",

	  
  });
( function( factory ) {
	if ( typeof define === "function" && define.amd ) {

		// AMD. Register as an anonymous module.
		define( [ "../widgets/datepicker" ], factory );
	} else {

		// Browser globals
		factory( jQuery.datepicker );
	}
}( function( datepicker ) {

datepicker.regional.ru = {
	closeText: "Применить",
	prevText: "&#x3C;Пред",
	nextText: "След&#x3E;",
	currentText: "Сегодня",
	monthNames: [ "Январь","Февраль","Март","Апрель","Май","Июнь",
	"Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь" ],
	monthNamesShort: [ "Янв","Фев","Мар","Апр","Май","Июн",
	"Июл","Авг","Сен","Окт","Ноя","Дек" ],
	dayNames: [ "воскресенье","понедельник","вторник","среда","четверг","пятница","суббота" ],
	dayNamesShort: [ "вск","пнд","втр","срд","чтв","птн","сбт" ],
	dayNamesMin: [ "Вс","Пн","Вт","Ср","Чт","Пт","Сб" ],
	weekHeader: "Нед",
	dateFormat: "dd.mm.yy",
	firstDay: 1,
	isRTL: false,
	showMonthAfterYear: false,
	yearSuffix: "" };
	
datepicker.setDefaults( datepicker.regional.ru );

return datepicker.regional.ru;

} ) );


	  



   $('#autosearch').on('keyup',function(){

	 
	   var query = $(this).val();
	   if(query != ''){
	     var path = $(this).attr('data-path');
		 var model = $(this).attr('data-model');
		 
		  $.ajax({
	      url:'/admin/admin_filter',
		  data:{'q':query,'path':path,'model':model},
		  headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		  type:'POST',
		  datatype:'JSON',
		  success: function(html) {
			  console.log(html);
			  if(html =='ok'){
				  
			  }else{
			  $('.wrapper-ajax').html(html);
			  }
					
		},

		});
		   
	   }
   })
	
</script>

	
	





	