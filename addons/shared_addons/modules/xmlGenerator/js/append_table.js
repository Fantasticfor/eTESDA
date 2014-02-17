

$(document).ready(function(){
    
    

var ctr = 0 ;
var lesson = 0;
if(sessionStorage.counter == null){
    ctr = 0;
    
}else{
    ctr = sessionStorage.counter;
}

var names = [];

if(sessionStorage.names1 == null){
    names = [];
}else{
    names =  JSON.parse(sessionStorage.names1);
}
//
//$('#lessonTitle').keyup(function(){
//    
//      if(/^[a-zA-Z0-9- ]*$/.test($('#lessonTitle'))== false){
//   alert('Lesson Title can\'t contain special characters');
//      }      
//
//});

  $('.addtoTable').click(function(){

    

 
       
       var topicTitle= $('#topicTitle').val();
       var text = $('#text').val();
       var links =[];
       var lessTitle = $('#lessonTitle').val();
       
       
          if($('#topicTitle').val().length == 0){
           
           alert('Topic title is required.');
           return false;
       };
        if($('#text').val().length == 0){
           
           alert('Text is required.');
           return false;
       };
        if($.inArray($('#topicTitle').val(),names) > -1){
           
           alert('Topic already exist');
           return false;    
       };
       
     

       $(".links").each(function() {
           
			    links.push($(this).val());
			});
//var newRowContent = "<tr><td>"+ topicTitle+"</td> <td> <a class='btn btn-lesson red'> Remove</a> </td> </tr>";
//$(newRowContent).appendTo($("#topicTable"));
//$('#topicTitle').val('');

var newRowContent = "<tr><td>"+topicTitle+"</td><td><a class='btn btn-lesson red removeaw' id='removeaw'> Remove</a> <input type='hidden' id='indexid' value='"+topicTitle+"'/></td></tr>"
$(newRowContent).appendTo($("#topicTable"));


$('#topicTitle').val('');
$('#text').val('');
$(".links").each(function() {
           
			   $(this).val('');
			});

topic = new Array();
topic[0] = topicTitle;
topic[1] = text;
topic[2] = links;
topic[3] = lessTitle;

names.push(topic[0]);
sessionStorage.setItem('names1',  JSON.stringify(names));
alert('successfully added topic  \''+topic[0]+'\' to queue!');

     $.ajax({
            type: "POST",
            data: {topic:topic},
            url: $('#baseurl').val()
//            ,success: function(data){
//                         alert(data);
//                    }
        });



});

$('#btnxml').click(function(){
 if(topic.length === 0){
        
        alert('You can\'t create a blank xml file. ' );
        return false;
    }
    else{
        
        
        
        
        $.ajax({
      
      
    url: SITE_URL+'admin/xmlGenerator/downloadXML',
   success:function(){
        //    window.open( SITE_URL+'admin/xmlGenerator/redirDL', "popupWindow", "width=600,height=600,scrollbars=yes");   
  
   location.reload();
          }
         }
      );
     
    }

});
  
   
 
    
         
  



$('#removeaw').live('click',function(){
    
    //alert("hello");
     if (confirm("Are you sure you want to remove this topic?")) {
        $(this).closest('tr').remove();
   
    var index = $('#indexid',$(this).closest("td")).val();
  
    info = new Array();
    info[0] = index;
    //alert(index);
    
    
//        names.splice(index,1);
//        localStorage["names"] =  JSON.stringify(names);
        
    
     $.ajax({
            type: "POST",
            data: {info:info},
            url: $('#removeurl').val()
            ,success: function(data){
                   //      alert(data);
                    }
        });
    
      }
    
    
});


});