$(function(){
    { 
       // $("#myTable")   .tablesorter({widthFixed: true, widgets: ['zebra']}) 
    //.tablesorterPager({container: $("#pager")}); 
   $("#sortTable").tablesorter(({headers: {3: {sorter: false}}})).tablesorterPager({container: $(".pager")});
   $("#sortTable2").tablesorter(({headers: {4: {sorter: false}}})).tablesorterPager({container: $(".pager")});
   
               
    } 
}); 