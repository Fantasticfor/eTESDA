$(document).ready(function(){ 

var ctr = 0 ;

if(sessionStorage.counterItem == null){
    ctr = 0;
    
}else{
    ctr = sessionStorage.counterItem;
}


$("#item_table").tablesorter();
 $('div #responses').load(SITE_URL+'admin/test/itemBank/viewResponses/1');
 $('#addtoItemTable').click(function(){



if($('.input_question').val().length < 10){
           
           alert('Question must be at least 5 characters');
           return false;
           
       }

var redirect = $('#redir').val();

var baseurl= $('#baseurl').val();
var input_question= $('.input_question').val();
var select_itemtype = $('.select_itemtype').val();
var select_diff= $('.select_diff').val();
var select_skill= $('.select_skill').val();
var category = $('.select_cat').val();
var type =  $('.select_itemtype option:selected').text();
var module = $('.select_skill option:selected').text();
var selectedT = $('.select_cat option:selected').text();

item = new Array();
item[0] = input_question; // question
item[1] = select_itemtype; // item type e.g multiple choice 
item[2] = select_diff; // difficutly
//item[3] = select_skill; // module 
item[4] = type; // item type text for display
//item[5] = module; // module type text for display
item[6] = new Array(); // answers
item[7] = ctr; // counter 
item[8] = category;


if(select_itemtype == 5){
   //weighted
}else if(select_itemtype == 2) {
            item[6][0] = new Array();
            item[6][0][0] = "True";
     
            if($('#ans' + 1).is(':checked')){
               item[6][0][1] = true;}
            else{
                item[6][0][1] = false;}
            
            
              item[6][1] = new Array();  
            item[6][1][0] = "False";
     
            if($('#ans' + 2).is(':checked')){
               item[6][1][1] = true;}
            else{
                item[6][1][1] = false;}
}else if(select_itemtype == 3){
   item[6][0] = new Array();
   item[6][0][0] = $('#ianswer').val();
   item[6][0][1] = true
}else{
     for(i = 1; i < 4 + 1; i++){
       
            item[6][i - 1] = new Array();
            
                    if($('#choice' + i).val().length == 0){
           
                    alert('Incomplete choices');
                    return false;
                    }
                    
            item[6][i - 1][0] = $('#choice' + i).val();
     
            if($('#ans' + i).is(':checked'))
               item[6][i - 1][1] = true;
            else
                item[6][i - 1][1] = false;

       }
 
}
//alert(item);



 $.ajax({
                
                type: "POST",
                data: {item:item},
                url: baseurl
        });



var newRowContent = "<tr> <td> "+input_question+"</td>\n\
<td> "+type+"</td><td>"+selectedT+"<td> "+select_diff+"</td> \n\
<td > \n\
 <a class='btn btn-lesson blue modal cboxElement' id='viewRes' href='admin/test/itemBank/modal_viewResponses?index="+ctr+"&type="+select_itemtype+"' >View Responses</a>  <input type='hidden' id='index' value="+ctr+"><a class='btn btn-lesson red' id='removeItem'><i class='icon-remove'></i> Remove</a><input type='hidden' id='indexid' value="+ctr+"> </td> </tr>";

 $("#item_table tbody").append(newRowContent);
 
  $("#item_table").trigger("update");
  ctr++;
  sessionStorage.counterItem = ctr;
$('.input_question').val('');
$('.res_input').val('');
$('.res_radio').prop('checked', false);
location.reload();
});


$('#removeItem').live('click',function(){
    
    //alert("hello");
    if(confirm('Are you sure you want to remove this?')){
    var index = $('#indexid',$(this).closest("td")).val();
   
    info = new Array();
    info[0] = index;
    //alert(index);
    
     $.ajax({
            type: "POST",
            data: {info:info},
            url: $('#removeurl').val()
//            ,success: function(data){
//                         alert(data);
//                    }
        });
     
     $(this).closest('tr').remove();
     
}
    
})



$(".select_itemtype").change(function () {
   
        var itemtype=$(".select_itemtype").val();
      
       
     $('#ctra').val(itemtype);   
    $('div #responses').load(SITE_URL+'admin/test/itemBank/viewResponses/'+itemtype);
    return false;
    
   
    
});

});




