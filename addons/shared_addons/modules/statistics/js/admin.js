jQuery(function($){
	
	// generate a slug when the user types a title in
	pyro.generate_slug('input[name="name"]', 'input[name="slug"]');
	
             $(function() {
     var ddl_year = new Date().getFullYear();   
     var months = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'];;
     var date = new Date(); 
     var ddl_month = months[date.getMonth()]; 
     var type = 4;
     //$('#ddl_month').val(ddlMonth);
     $('#sectorRepbody').load(SITE_URL+'admin/statistics/sectorStat/load_sectorReport?month=' + ddl_month + '&year=' + ddl_year + '&type=4');

    
     $('#geoReport').load(SITE_URL+'admin/statistics/geoStat/load_geoReport?geoType=1');
    
    $( "#accordion" ).accordion({ autoHeight: false });
    
    $(".smallerCbox").colorbox({width:"500px"});
    
  
    
    
   $('#ddl_month').change(function(){
           ddl_month=$('#ddl_month').val();
       });
   
       $('#ddl_year').change(function(){
          ddl_year=$('#ddl_year').val();
         // alert(ddl_year+'-'+ddl_month+'-'+type);
         if(ddl_year != 0){
          $('#sectorRepbody').load(SITE_URL+'admin/statistics/sectorStat/load_sectorReport?month=' + ddl_month + '&year=' + ddl_year + '&type=' + type);
       }
   
});
       $('.type_btn').click(function(){
       
       type = $(this).attr('rel');
       
       
        $('#sectorRepbody').load(SITE_URL+'admin/statistics/sectorStat/load_sectorReport?month=' + ddl_month + '&year=' + ddl_year + '&type=' + type);
         $(".viewCourse").click(function(){
      var sectorID = $('#viewCourse1',$(this).closest("td")).val();
    //  alert(sectorID+'-'+ddl_year+'-'+ddl_month+'-'+type);
      $('#courses').load(SITE_URL+'admin/statistics/sectorStat/load_courses');
   });
   });
   
      
   $('.type_btn.geo').click(function(){
       
      var geotype = $(this).attr('rel');
      
        $('#geoReport').load(SITE_URL+'admin/statistics/geoStat/load_geoReport?geoType='+geotype);
   });
   
 
  
   
  
   
       
       
//       if(ddl_month != NULL && ddl_year != NULL){
//         $('#sectorRepbody').load(SITE_URL+'admin/statistics/sectorStat/load_sectorReport?month='+ ddl_month + '&year=' + ddl_year);
//       }else if(ddl_month == NULL && ddl_year != NULL){
//         $('#sectorRepbody').load(SITE_URL+'admin/statistics/sectorStat/load_sectorReport?year=' + ddl_year);
//       }
   
   $("#type_btn1").click(function(){
       
          $("#type_btn2").removeClass('gray');
          $("#type_btn3").removeClass('gray');
          $("#type_btn4").removeClass('gray');
      $("#type_btn1").addClass('gray');
      $("#type_btn2").addClass('blue');
      $("#type_btn3").addClass('blue');
      $("#type_btn4").addClass('blue');

  
 
   });
   
      $("#type_btn2").click(function(){
          $("#type_btn1").removeClass('gray');
          $("#type_btn3").removeClass('gray');
          $("#type_btn4").removeClass('gray');
      $("#type_btn1").addClass('blue');
      $("#type_btn2").addClass('gray');
      $("#type_btn3").addClass('blue');
      $("#type_btn4").addClass('blue');
  
   });
   
     $("#type_btn3").click(function(){
          $("#type_btn1").removeClass('gray');
          $("#type_btn2").removeClass('gray');
          $("#type_btn4").removeClass('gray');
      $("#type_btn1").addClass('blue');
      $("#type_btn3").addClass('gray');
      $("#type_btn2").addClass('blue');
      $("#type_btn4").addClass('blue');
  
   });
   
     $("#type_btn4").click(function(){
          $("#type_btn1").removeClass('gray');
          $("#type_btn2").removeClass('gray');
          $("#type_btn3").removeClass('gray');
      $("#type_btn1").addClass('blue');
      $("#type_btn4").addClass('gray');
      $("#type_btn2").addClass('blue');
      $("#type_btn3").addClass('blue');
  
   });
   
   
   
 $("label.Passed").parent().css({"background":"lightgreen"});
 $("label.Failed").parent().css({"background":"lightcoral"});
 });
 
});