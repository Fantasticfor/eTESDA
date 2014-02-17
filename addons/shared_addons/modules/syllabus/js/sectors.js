$(function() {

var selectCategory=function(id){
        var ref=id.replace(' ','');
        $("  li.sector > a").removeClass("active");
        $("#"+ref).addClass("active");
        
      
   
}

$('  li.sector > a').click(function(){
            var reference=$(this).attr('id');
            selectCategory(reference);
  
$('#content_area').load( 'main/tourism_details/');
return false; 
})

});