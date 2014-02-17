
$(function(){

   $('.course').click(function(){
      var courseID= $(this).data('id');
      var baseurl=$('#baseurl').val();
       $.ajax({
          type : 'post',
           url : baseurl+'syllabus/modal_course', // in here you should put your query 
          data :  'post_id='+ courseID, // here you pass your id via ajax .
                     // in php you should use $_POST['post_id'] to get this value 
      success : function(r)
           {
              // now you can show output in your modal 
            //  $('#courseModal').show();  // put your modal id 
             $('.courseBody').show().html(r);
           }
    });

});
  $('.viewHistory').click(function(){
      var ID= $(this).data('id');
      var baseurl=$('#baseurl').val();
       $.ajax({
          type : 'post',
           url : baseurl+'learner/viewSCHistory', // in here you should put your query 
          data :  'post_id='+ ID, // here you pass your id via ajax .
                     // in php you should use $_POST['post_id'] to get this value 
      success : function(r)
           {
              // now you can show output in your modal 
            //  $('#courseModal').show();  // put your modal id 
             $('.modal-body').show().html(r);
           }
    });


});

$('.viewRes').click(function(){
      var ID= $(this).data('id');
      var baseurl=$('#baseurl').val();
       $.ajax({
          type : 'post',
           url : baseurl+'learner/modal_viewResultsOA', // in here you should put your query 
          data :  'post_id='+ ID, // here you pass your id via ajax .
                     // in php you should use $_POST['post_id'] to get this value 
      success : function(r)
           {
              // now you can show output in your modal 
            //  $('#courseModal').show();  // put your modal id 
             $('.modal-body').show().html(r);
           }
    });


});

   });
   