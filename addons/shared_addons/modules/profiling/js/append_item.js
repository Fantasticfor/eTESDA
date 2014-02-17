

$(function(){ 

$("#item_table").tablesorter();
 $('#addInterestItem').click(function(){
  
var ctr = 0 ;

if(sessionStorage.counterInt == null){
    ctr = 0;
    
}else{
    ctr = sessionStorage.counterInt;
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
//                         //alert(data);
//                }
        });

        
var newRowContent = "<tr> <td> "+input_question+"</td>\n\
<td> "+ resp+"</td>   \n\
<td > \n\
<a class='btn btn-lesson red' id='removeItem'><i class='icon-remove'></i> Remove </a> <input type='hidden' id='indexid' value="+ctr +"/></td> </tr>";
 
 $("#item_table tbody").append(newRowContent); 
  $("#item_table").trigger("update");
  ctr++;
  sessionStorage.counterInt = ctr;
$('.input_question').val('');
$('.res_radio').prop('checked', false);

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




});





$(function(){ 



$('#addAbilityItem').click(function(){
   
var ctr = 0 ;

if(sessionStorage.counterAbi == null){
    ctr = 0;
    
}else{
    ctr = sessionStorage.counterAbi;
}  
  
var input_question= $('.input_question').val();
var baseurl= $('#baseurl').val();



ability = new Array();
ability[0] = ctr;
ability[1] = input_question; // question
ability[2] = new Array(); // answers


for(i = 1; i < 4 + 1; i++){
       
            ability[2][i - 1] = new Array();
            
                    if($('#choice' + i).val().length == 0){
           
                    alert('Incomplete choices');
                    return false;
                    }
                    
            ability[2][i - 1][0] = $('#choice' + i).val();
     
            if($('#ans' + i).is(':checked'))
               ability[2][i - 1][1] = true;
            else
                ability[2][i - 1][1] = false;

       }

//alert(ability);

 
 $.ajax({
                
                type: "POST",
                data: {ability:ability},
                url: baseurl+"admin/profiling/addItemA"
//                ,success: function(data){
//                         //alert(data);
//                }
        });


var newRowContent = "<tr> <td> "+input_question+"</td>\n\
<td> "+"Multiple Choice"+"</td>   \n\
<td > \n\
<a class='btn btn-lesson blue ' id='viewRes' onclick='viewRes("+ctr+")' >View Responses</a><a class='btn btn-lesson red' id='removeItemA'><i class='icon-remove'></i> Remove </a> <input type='hidden' id='indexid' value="+ctr +"/></td> </tr>";
 
 $("#item_table tbody").append(newRowContent); 
  $("#item_table").trigger("update");
  


  ctr++;
  sessionStorage.counterAbi = ctr;
  $('.input_question').val('');
$('.res_radio').prop('checked', false);
$('.res_input').val('');

});



$('#removeItemA').live('click',function(){
  var baseurl= $('#baseurl').val();  
    //alert("hello");
    
    var index = $('#indexid',$(this).closest("td")).val();
   
    info1 = new Array();
    info1[0] = index;
    //alert(index);
    
     $.ajax({
            type: "POST",
            data: {info1:info1},
            url: baseurl+"admin/profiling/removeItemA"
//            ,success: function(data){
//                         alert(data);
//                    }
        });
     
     $(this).closest('tr').remove();
     
    
    
})




});


