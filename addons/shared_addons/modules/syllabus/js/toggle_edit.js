
function tog_edit(){

 
  $('#abs').show();
  $('#ints').show();
  $('#atag').hide();
  $('#intag').hide();
  $('#litog').show();
  $('#lbltedit').hide();
  $('#lbldedit').hide();
  $('#cupload').show();
  $('#txtctitle').show();
  $('#txtcdes').show().addClass('wysiwyg-simple').ckeditor({
	toolbar: [
		['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink']
	  ],
	width: '99%',
        
	height: 100,
	dialog_backgroundCoverColor: '#000',
	defaultLanguage: 'en',
	language: 'en'
});
  $('#cstat').show();
  
 
  
  $('#skillsli').hide();
  $('#skilld1').show();
  $('#skilld2').show();
  
  $('#lblledit').hide();
  $('#txtlink').show();
  $('.linkscall').show();
  $('.text-info a').hide();
  
  
}


function tog_save(){

    location.reload();

//  $('#litog').hide();
//  $('#txtctitle').hide();
//   $('#lbltedit').show();
//   $('#lbldedit').show();
//   $('#cupload').hide();
//    
//   $('#txtcdes').hide();
//   $('#cstat').hide();
//   
//   $('#skilld1').hide();
//  $('#skilld2').hide();
//  $('#skillsli').show();
//  
//  $('#lbldedit').show();
//  $('#txtlink').hide();
//  $('.linkscall').hide();
//  $('.text-info a').show();
// 

}
