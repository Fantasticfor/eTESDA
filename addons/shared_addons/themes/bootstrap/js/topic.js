
    
  $(".topicLink").click(function(){
      var baseurl=$('#baseurl').val();
      var topicId= $(this).attr('rel');
      $(this).prepend('<span class="icon-ok-green" style="position:absolute; margin-left:-15px"></span>')
   
 $.ajax({
     type: "POST",
    url: baseurl+'syllabus/viewedTopic',
   data:'topicId='+topicId  //assign the var here 
    
     
    
});  
}); 
     


//});


//function check(elem){
  //  var id= elem.id;
   // var id2 = '#'+elem.id;
    //var newRowContent = "<i class='icon-ok-green'></i>";
    //alert(id);
    //$(newRowContent).appendTo($('span'+id2));
   
//}

//$('#myTab2 li a').click(function (e) {
    
  //  var id = 
  //$(newRowContent).appendTo($("#table_id"));
  
//  e.preventDefault();
  
//})
