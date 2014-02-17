$(function(){ 
 
$("#item_table").tablesorter();
 $('#addtoItemTable').click(function(){
  

//var redirect = $('#redir').val();

//var baseurl=$('#baseurl').val();
var input_question= $('.input_question').val();
var select_itemtype = $('.select_itemtype').val();
var select_diff= $('.select_diff').val();
//var select_skill= $('.select_skill').val();

var newRowContent = "<tr> <td> "+ select_itemtype+"</td>\n\
<td> "+input_question+"</td> <td> "+select_diff+"</td>  \n\
<td > \n\
<a class='btn btn-lesson blue ' id='viewRes' onclick='viewRes()' >View Responses</a> <a class='btn btn-lesson red'><i class='icon-remove'></i> Remove</a> </td> </tr>";
 
 $("#item_table tbody").append(newRowContent); 
  $("#item_table").trigger("update");
$('.input_question').val('');

//clear textbox


});

$("#select_itemtype").change(function(){
  //  alert($(".select_itemtype").val());
   
       var itemtype=$(".select_itemtype").val();
       alert(itemtype);
       
   $('div #responses').load(SITE_URL+'admin/test/itemBank/viewResponses');
    return false;

});

});



