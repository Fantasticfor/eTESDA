$(function () {
    
    $('#select_sector').change(function(){
   if($('#select_sector').val()==0){
       location.reload();
   }
      else{  
        var val = $('#select_sector').val();
        $('div #body_table').load(SITE_URL+'admin/statistics/load_indexTable/'+val);
      }
    })
    
     $('#select_course').change(function(){
   if($('#select_course').val()==0){
       location.reload();
   }
      else{  
        var val = $('#select_course').val();

        $('div #body_table').load(SITE_URL+'admin/statistics/learnerStat/load_courseTable/'+val);
      }
    })
    
  
    
    
});


