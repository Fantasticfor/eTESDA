function viewRes(index){
    var baseurl=$('#baseurl1').val();
    //var index = $('.index').val();
   // $(this).parents('tr').find('.wrapperDivHidden input[type="hidden"]').val();
 $.colorbox({href: baseurl+"admin/test/itemBank/modal_viewResponses?index="+index,width:"60%", height:"50%"}

);
    
   
 
}
