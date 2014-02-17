$(function(){ 
 
$("#item_table").tablesorter();
 $('#addtoItemTable').click(function(){
  

//var redirect = $('#redir').val();

//var baseurl=$('#baseurl').val();
var input_question= $('.input_question').val();
var select_itemtype = $('.select_itemtype').val();

//var select_skill= $('.select_skill').val();

var newRowContent = "<tr> <td> "+ select_itemtype+"</td>\n\
<td> "+input_question+"</td>   \n\
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
       //alert(itemtype);
       
   $('div #responses').load(SITE_URL+'admin/test/itemBank/viewResponses');
    return false;

});

});


$(function(){ 
 
$("#item_table").tablesorter();
 $('#addInterestItem').click(function(){
  

//var redirect = $('#redir').val();

//var baseurl=$('#baseurl').val();
var input_question= $('.input_question').val();
var response = $('.response').val();

//var select_skill= $('.select_skill').val();

var newRowContent = "<tr> <td> "+input_question+"</td>\n\
<td> "+ response+"</td>   \n\
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
       //alert(itemtype);
       
   $('div #responses').load(SITE_URL+'admin/test/itemBank/viewResponses');
    return false;

});

});



//////////////////////////////////////////////////////////////////////////////////////////////////


$('#addAbilityItem').click(function(){
  
var ctr = 0 ;

if(sessionStorage.counterItem == null){
    ctr = 0;
    
}else{
    ctr = sessionStorage.counterItem;
}  
  
var input_question= $('.input_question').val();
var baseurl= $('#baseurl').val();
var resp = "";

if($('#ans' + 1).is(':checked')){
             resp = "Agree";
         }
         else{
             resp = "Disagree"
         }
 

interest = new Array();
interest[0] = ctr;
interest[1] = input_question; // question
interest[2] = new Array(); // answers

            interest[2][0] = new Array();
            interest[2][0][0] = "Agree";
     
            if($('#ans' + 1).is(':checked')){
               interest[2][0][1] = true;}
            else{
               interest[2][0][1] = false;}
            
            
            interest[2][1] = new Array();  
            interest[2][1][0] = "Disagree";
     
            if($('#ans' + 2).is(':checked')){
               interest[2][1][1] = true;}
            else{
                interest[2][1][1] = false;}
            
           

//var select_skill= $('.select_skill').val();
 //alert(interest);
 
 $.ajax({
                
                type: "POST",
                data: {interest:interest},
                url: baseurl+"admin/profiling/addItemI"
//                ,success: function(data){
//                         alert(data);
//                }
        });

        
var newRowContent = "<tr> <td> "+input_question+"</td>\n\
<td> "+ resp+"</td>   \n\
<td > \n\
<a class='btn btn-lesson red'><i class='icon-remove'></i> Remove</a> </td> </tr>";
 
 $("#item_table tbody").append(newRowContent); 
  $("#item_table").trigger("update");
$('.input_question').val('');

  ctr++;
  sessionStorage.counterItem = ctr;

});

$("#select_itemtype").change(function(){
  //  alert($(".select_itemtype").val());
   
       var itemtype=$(".select_itemtype").val();
       //alert(itemtype);
       
   $('div #responses').load(SITE_URL+'admin/test/itemBank/viewResponses');
    return false;

});



$('#removeItem').live('click',function(){
  var baseurl= $('#baseurl').val();  
    //alert("hello");
    
    var index = $('#indexid',$(this).closest("td")).val();
   
    info = new Array();
    info[0] = index;
    //alert(index);
    
     $.ajax({
            type: "POST",
            data: {info:info},
            url: baseurl+"admin/profiling/removeItemI"
//            ,success: function(data){
//                         alert(data);
//                    }
        });
     
     $(this).closest('tr').remove();
     
    
    
})