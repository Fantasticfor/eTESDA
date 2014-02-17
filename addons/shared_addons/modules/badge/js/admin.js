jQuery(function($){
	
	// generate a slug when the user types a title in
	pyro.generate_slug('input[name="name"]', 'input[name="slug"]');
	
});
$(document).ready(function(){
    
      $("#list_course").hide();
        $("#list_module").hide();
$(".edit").colorbox({ innerWidth:425, innerHeight:344});

$('#ddl_activity').change(function(){
   var activity =  $('#ddl_activity').val();
    //online assessment
    alert(activity);
    if( activity == 1){
        
        $("#list_course").show();
         $("#list_module").hide();
    }
    
    else if ( activity == 2){
        $("#list_course").show();
        $("#list_module").show();
    }
});
});