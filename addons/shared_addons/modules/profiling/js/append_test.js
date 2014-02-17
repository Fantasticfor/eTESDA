

$(function(){

  $('#addtoTestTable').click(function(){

//var redirect = $('#redir').val();
var select_Type= $('.sec_itemtype').val();
var no_items= $('.sec_noitems').val();

var newRowContent = "<tr><td> Section 1</td> <td> "+ select_Type+"</td> <td> <span class='label label-info'>"+no_items+"</span></td>\n\
<td style='text-align:center'> \n\
<a class='btn btn-lesson red'><i class='icon-remove'></i> Remove</a> </td> </tr>";
$(newRowContent).appendTo($("#table_id"));
 $('.sec_noitems').val('');



});




  




});