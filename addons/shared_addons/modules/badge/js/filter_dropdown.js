$(function () {
    
    $('#select_Course').change(function(){
        var val = $('#select_Course').val();
        $('div #item_table').load(SITE_URL+'admin/test/loadItemTable/'+val);
        
    })
    
    $('#select_Course1').change(function(){
        var val1 = $('#select_Course1').val();
        $('div #item_table').load(SITE_URL+'admin/test/testBank/loadItemTable/'+val1);
        
    })
    
    
});


