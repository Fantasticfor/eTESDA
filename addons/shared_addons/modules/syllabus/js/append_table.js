

$(document).ready(function(){

var ctr = 0 ;
var lesson = 0;
if(sessionStorage.counter == null){
    ctr = 0;
    
}else{
    ctr = sessionStorage.counter;
}

var names = [];


if(sessionStorage.names == null){
    names = [];
}else{
    names =  JSON.parse(sessionStorage.names);
}



  $('.addtoTable').click(function(){

    if($('.input_modTitle').val().length == 0){
           
           alert('Module title is required');
           return false;    
       };
       
      if($.inArray($('.input_modTitle').val(),names) > -1){
           
           alert('Module already exist');
           return false;    
       };
      



module = new Array();
module[0] = $('.input_modTitle').val(); // tilte
module[1] = lesson;//lesson number
module[4] = ctr; // checker of index
ctr++;
sessionStorage.counter = ctr;
names.push(module[0]);
sessionStorage.setItem('names', JSON.stringify(names));
//alert(names);
//alert(info);


 $.ajax({
            type: "POST",
            data: {module:module},
            url: $('#baseurl').val()
//            ,success: function(data){
//                         alert(data);
//                    }
        });

var redirect = $('#redir').val();

var modname= $('.input_modTitle').val();
var newRowContent = "<tr><td>"+ modname+"</td><td><span class=label >0</span></td> <td style='text-align:center'> <a class='btn btn-lesson green' name="+module[4]+" href="+ redirect+"/"+module[4]+" onclick='window.open(this.href, \"child\", \"height=640,width=1200,scrollbars\"); return false'> <i class='icon-plus'></i> Add Lessons</a>\n\
<a class='btn btn-lesson red' id='removeaw' ><i class='icon-remove'></i> Remove</a> <input type='hidden' id='indexid' value="+module[4]+"> </td> </tr>";
$(newRowContent).appendTo($("#table_id"));
$('.input_modTitle').val('');


});



$('#removeaw').live('click',function(){
    
    //alert("hello");
    
    if (confirm('Are you sure you want to remove this?')){
        
   
    
    var index = $('#indexid',$(this).closest("td")).val();
    var Id=document.getElementById("indexid").value;
    info = new Array();
    info[0] = index;
    //alert(index);
    
     $.ajax({
            type: "POST",
            data: {info:info},
            url: $('#removeurl').val()
//            ,success: function(data){
//                         //alert(data);
//                    }
        });
     
     $(this).closest('tr').remove();
     
     }
     else{
         
     }
    
});

$('#removeButton').click(function(){
    //alert("AW");
        if (confirm('Are you sure you want to remove this?')){
    
    var indexx = $('#indexx',$(this).closest("td")).val();
    var mname = $('#mname',$(this).closest("td")).val();
    
    info = new Array();
    info[0] = indexx;
    info[1] = mname;
    //alert(index);
    
     $.ajax({
            type: "POST",
            data: {info:info},
            url: $('#removeurll').val()
//            ,success: function(data){
//                         alert(data);
//                    }
        });
     
     $(this).closest('tr').remove();
     
    }else{
        
    }
})
//
//$('#removeButton').live('click',function(){
//    //alert("AA");
//    if (confirm('Are you sure you want to delete this?')){
//    
//    var indexx = $('#indexx',$(this).closest("td")).val();
//    var mname = $('#mname',$(this).closest("td")).val();
//    
//    info = new Array();
//    info[0] = indexx;
//    info[1] = mname;
//    //alert(index);
//    
//     $.ajax({
//            type: "POST",
//            data: {info:info},
//            url: $('#removeurll').val()
////            ,success: function(data){
////                         alert(data);
////                    }
//        });
//     
//     $(this).closest('tr').remove();
//     
//    }else{
//        
//    }
//    
//})

$('#removeButtonn').live('click',function(){
    
    ///if (confirm('Are you sure you want to delete this?')){
    
    var indexx = $('#indexx',$(this).closest("td")).val();
    
    
    info = new Array();
    info[0] = indexx;
    
    //alert(index);
    
     $.ajax({
            type: "POST",
            data: {info:info},
            url: $('#removeurll').val()
//            ,success: function(data){
//                         alert(data);
//                    }
        });
     
     $(this).closest('tr').remove();
     
    //}
    
})

$('#cancelbutton').click(function(){
   if(confirm('Are you sure you want to cancel? ')){
       return true
   }else{
    
    return false;}

    
})

$('#closebutton').click(function(){
   //alert($('#removesession').val());
    
    $.ajax({
            type: "POST",
            data: '',
            url: $('#removesession').val()
//            ,success: function(data){
//                         alert(data);
//                    }
        });
        
    window.onunload = refreshParent;
    window.close();
   

    
})


function refreshParent() {
        window.opener.location.reload();
        
    }


$('.addtoTableL').click(function(){

//var redirect = $('#redir').val();



var modname= $('#currentmodule').val();

lesson = new Array();
lesson[0] = $('.input_modTitle').val(); // title
lesson[1] = modname; //module assigned
lesson[2] = $('#upload').val();
//lesson[1] = 0;//lesson number
//lesson[2] = $('#dropdown').val(); // skill
//lesson[3] = $('#dropdown2').val();//skill 2
//alert(lesson);


 $.ajax({
            type: "POST",
            data: {lesson:lesson},
            url: $('#baseurl').val()
//            ,success: function(data){
//                         alert(data);
//                    }
        });


var modname= $('.input_modTitle').val();
var newRowContent = "<tr><td>"+ modname+"</td><td><label class='label label-info'> 10</label></td> <td > \n\
<a class='btn btn-lesson red'><i class='icon-remove confirm'></i> Remove</a> </td> </tr>";
$(newRowContent).appendTo($("#table_id"));
$('.input_modTitle').val('');


});

  




});