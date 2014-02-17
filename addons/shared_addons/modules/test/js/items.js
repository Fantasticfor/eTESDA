$(function(){
    { 
       // $("#myTable")   .tablesorter({widthFixed: true, widgets: ['zebra']}) 
    //.tablesorterPager({container: $("#pager")}); 
   $("#sortTable").tablesorter(({headers: {1: {sorter: false}}})).tablesorterPager({container: $(".pager")});
   $("#sortTable2").tablesorter(({headers: {1: {sorter: false}}})).tablesorterPager({container: $(".pager")});
   
               
    } 
}); 