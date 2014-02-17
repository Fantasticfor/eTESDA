$(document).ready(function(){ 


$("#ddl_activity1").change(function () {
   
     var activity = $("#ddl_activity1").val();
   
   if(activity == "Passed an Online Assessment"){
       $('#moduleLi').hide();
   }else{
         
          $('#moduleLi').show();
      
        
   }
       
  
   
    
});
$('#ddl_course').change(function(){
    
    //alert("AA");
    var module = new Array();
    module[0] = $('#ddl_course').val();
    
    //alert(module[0]);
    var baseurl = $('#baseurl').val()
    //alert(baseurl);
        $.ajax({ type: "POST",
      url: baseurl,
      data: {module:module},
      success: function(data){
          // alert(data);
        $('#ddl_module').html(data);
       
         $('#ddl_module').chosen();
    $('#ddl_module').trigger("liszt:updated");
    $('#ddl_module').change();

      }
    });
   
     //$('#ddl_module').trigger("chosen:updated");
     
//    $('#ddl_module').chosen({
//            create_option: true,
//             persistent_create_option: true,
//             skip_no_results: true
//        });

//$.ajax({
//            type: "POST",
//            data: {module:module},
//            url: baseurl
//            ,success: function(data){
//                         alert(data);
//                    }
//        });
    
    
});




});




