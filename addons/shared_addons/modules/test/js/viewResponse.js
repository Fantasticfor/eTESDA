function viewRes(index,type){
        var baseurl=$('#baseurl1').val();
//        alert(index);
//        alert(type);
        $('#arrayIndex').val(index);
        $('#testType').val(type);
        //var index = $('.index').val();
       // $(this).parents('tr').find('.wrapperDivHidden input[type="hidden"]').val();
     $.colorbox({href: baseurl+"admin/test/itemBank/modal_viewResponses?index="+index+"&type="+type,width:"60%", height:"50%"});

    }    
   
$(document).ready(function(){ 

    $('#saveButton').click(function(){
        var baseurl1=$('#update').val();
       
      var arrayIndex = $('#arrayIndex').val();
      var testType = $('#testType').val();
//       alert(arrayIndex);
//        alert(testType);
      item = new Array();
item[0] = arrayIndex; // question
item[1] = testType; // item type e.g multiple choice 
item[2] = new Array(); // answers

//      alert(arrayIndex);
//      alert(testType);
var select_itemtype = testType;
 if(select_itemtype == 2) {
            item[2][0] = new Array();
            item[2][0][0] = "True";
     
            if($('#ans' + 1).is(':checked')){
               item[2][0][1] = true;}
            else{
                item[2][0][1] = false;}
            
            
              item[2][1] = new Array();  
            item[2][1][0] = "False";
     
            if($('#ans' + 2).is(':checked')){
               item[2][1][1] = true;}
            else{
                item[2][1][1] = false;}
}else if(select_itemtype == 3){
   item[2][0] = new Array();
   item[2][0][0] = $('#ianswer').val();
   item[2][0][1] = true
}else{
     for(i = 1; i < 4 + 1; i++){
       
            item[2][i - 1] = new Array();
            
                    if($('#choice' + i).val().length == 0){
                    alert(i);
                    alert('Incomplete choices');
                    return false;
                    }
                    
            item[2][i - 1][0] = $('#choice' + i).val();
     
            if($('#ans' + i).is(':checked'))
               item[2][i - 1][1] = true;
            else
                item[2][i - 1][1] = false;

       }
 
}
    
    
 $.ajax({
                
                type: "POST",
                data: {item:item},
                url: baseurl1,
                success: function(data){
           
                         alert("Saved!");
                         $.colorbox.close()
                    }
        });




    });
    
      $('#saveButton1').click(function(){
        var baseurl1=$('#update').val();
       
      var itemID = $('#itemID').val();
      var testType = $('#testType').val();
      var question = $('#question').val();
//       alert(arrayIndex);
//        alert(testType);
      item = new Array();
item[0] = itemID; // question
item[1] = testType; // item type e.g multiple choice 
item[2] = new Array(); // answers
item[3] = question;
item[4] = $('#cat').val();
item[5] = $('#dif').val();

//      alert(arrayIndex);
//      alert(testType);
var select_itemtype = testType;
if(select_itemtype == 2) {
            item[2][0] = new Array();
            item[2][0][0] = "True";
     
            if($('#ans' + 1).is(':checked')){
               item[2][0][1] = true;}
            else{
                item[2][0][1] = false;}
            
            
              item[2][1] = new Array();  
            item[2][1][0] = "False";
     
            if($('#ans' + 2).is(':checked')){
               item[2][1][1] = true;}
            else{
                item[2][1][1] = false;}
}else if(select_itemtype == 3){
   item[2][0] = new Array();
   item[2][0][0] = $('#ianswer').val();
   item[2][0][1] = true
}else{
     for(i = 1; i < 4 + 1; i++){
       
            item[2][i - 1] = new Array();
            
                    if($('#choice' + i).val().length == 0){
                    alert(i);
                    alert('Incomplete choices');
                    return false;
                    }
                    
            item[2][i - 1][0] = $('#choice' + i).val();
     
            if($('#ans' + i).is(':checked'))
               item[2][i - 1][1] = true;
            else
                item[2][i - 1][1] = false;

       }
 
}
    
    
 $.ajax({
                
                type: "POST",
                data: {item:item},
                url: baseurl1,
                success: function(data){
                    //alert(data);
                         alert("Saved!");
                         location.reload();
                         $.colorbox.close();
                         
                    }
        });




    })
    
});



