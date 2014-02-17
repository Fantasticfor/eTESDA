

$(function(){
var ctr = 0;

if(sessionStorage.tcounter == null){
    ctr = 0;
    
}else{
    ctr = sessionStorage.tcounter;
}

function isNumber(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}

  $('#addtoTestTable').click(function(){


 if(!isNumber($('.sec_noitems').val())){
           
           alert('Enter a number');
           return false;    
       };
       
        if($('.sec_noitems').val().length == 0){
           
           alert('No. of items is required');
           return false;    
       };
       
//var redirect = $('#redir').val();
var select_Type= $('.sec_itemtype').val();
var no_items= $('.sec_noitems').val();
var select_diff=$('.sec_diff').val();
var sectionno = ctr+1;

var type = $('.sec_itemtype option:selected').text();
var module = $('.sec_diff option:selected').text();

section = new Array();
section[0] = select_Type; // type
section[1] = no_items;//number of items
section[2] = select_diff; // module
section[3] = ctr; // checker of index
section[4] = type;
section[5] = module;

//alert(section);


 $.ajax({
            type: "POST",
            data: {section:section},
            url: $('#baseurl').val()
//            ,success: function(data){
//                         alert(data);
//                    }
        });

var newRowContent = "<tr><td> Section"+ sectionno +"</td> <td> "+ module +"</td> <td> "+ type +"</td> <td> <span class='label label-info'>"+no_items+"</span></td>\n\
<td style='text-align:center'> \n\
<a class='btn btn-lesson red' id='removeSection'><i class='icon-remove'></i> Remove</a><input type='hidden' id='indexid' value="+ctr+"> </td> </tr>";
$(newRowContent).appendTo($("#table_id"));
 $('.sec_noitems').val('');

//var select=document.getElementById('sl');
//
//for (i=0;i<select.length;  i++) {
//   if (select.options[i].value== select_diff) {
//     select.remove(i);
//   }
//}

ctr++;
sessionStorage.tcounter = ctr;
});



$('#removeSection').live('click',function(){
    
    //alert("hello");
    
    var index = $('#indexid',$(this).closest("td")).val();
    var Id=document.getElementById("indexid").value;
    info = new Array();
    info[0] = index;
   // alert(index);
    
     $.ajax({
            type: "POST",
            data: {info:info},
            url: $('#removeurl').val()
//            ,success: function(data){
//                         alert(data);
//                    }
        });
     
     $(this).closest('tr').remove();
     
    
    
})





  $('#addtoItemTable').click(function(){

//var redirect = $('#redir').val();

var input_question= $('#input_question').val();
var select_diff2 = $('.select_diff2').val();

var newRowContent = "<tr> <td> "+input_question+"</td>\n\
<td> "+select_diff2+"</td> \n\
<td > \n\
<a class='btn btn-lesson blue'></i> View Responses</a> <a class='btn btn-lesson red'><i class='icon-remove'></i> Remove</a> </td> </tr>";
$(newRowContent).appendTo($("#table_id"));
$('#input_question').val('');


});


  




});