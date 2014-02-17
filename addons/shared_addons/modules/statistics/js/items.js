$(function(){
    { 
       // $("#myTable")   .tablesorter({widthFixed: true, widgets: ['zebra']}) 
    //.tablesorterPager({container: $("#pager")}); 
    
     $("#sortTableBas").tablesorter({ 
        // pass the headers argument and assing a object 
        headers: { 
            // assign the secound column (we start counting zero) 
              1: { 
                // disable it by setting the property sorter to false 
                sorter: false 
            }, 
            2: { 
                // disable it by setting the property sorter to false 
                sorter: false 
            }, 
            // assign the third column (we start counting zero) 
            3: { 
                // disable it by setting the property sorter to false 
                sorter: false 
            },
            4: { 
                // disable it by setting the property sorter to false 
                sorter: false 
            },
             5  : { 
                // disable it by setting the property sorter to false 
                sorter: false 
            },
            
        } 
    }).tablesorterPager({container: $(".pager")});
    
   $("#sortTable").tablesorter({ 
        // pass the headers argument and assing a object 
        headers: { 
            // assign the secound column (we start counting zero) 
            2: { 
                // disable it by setting the property sorter to false 
                sorter: false 
            }, 
            // assign the third column (we start counting zero) 
            3: { 
                // disable it by setting the property sorter to false 
                sorter: false 
            },
            4: { 
                // disable it by setting the property sorter to false 
                sorter: false 
            },
             5  : { 
                // disable it by setting the property sorter to false 
                sorter: false 
            },
            
        } 
    }).tablesorterPager({container: $(".pager")});
    
    $("#sortTableLM").tablesorter({ 
        // pass the headers argument and assing a object 
        headers: { 
            // assign the secound column (we start counting zero) 
            1: { 
                // disable it by setting the property sorter to false 
                sorter: false 
            },
                2: { 
                // disable it by setting the property sorter to false 
                sorter: false 
            }, 
            // assign the third column (we start counting zero) 
            3: { 
                // disable it by setting the property sorter to false 
                sorter: false 
            },
            4: { 
                // disable it by setting the property sorter to false 
                sorter: false 
            },
             5  : { 
                // disable it by setting the property sorter to false 
                sorter: false 
            },
            
        } 
    }).tablesorterPager({container: $(".pager")});
   
   
               
    } 
}); 