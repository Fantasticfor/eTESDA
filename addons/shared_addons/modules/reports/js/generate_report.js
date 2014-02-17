$(function () {
    
    $('#generate').click(function(){
        var year=$('#select_year').val();
        var report=$('#select_report').val();
        var month=$('#select_month').val();
        
        $('div #report').load(SITE_URL+'admin/reports/load_report?year='+year+"&report="+report+"&month="+month);
        
    })
    
    
});


