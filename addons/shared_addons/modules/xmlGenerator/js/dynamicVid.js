
$(function() {
     


function downloadFile(url)
{
    var iframe;
    iframe = document.getElementById("download-container");
    if (iframe === null)
    {
        iframe = document.createElement('iframe');  
        iframe.id = "download-container";
        iframe.style.visibility = 'hidden';
        document.body.appendChild(iframe);
    }
    iframe.src = url;   
}
    
    
    
    var ctr=1; 
    $('#topicTitle').focus();
var linkInput="<br><input type='text' name='input_link[]' style='width:300px' class='links input_cl' placeholder='Youtube link here'/>"
  
    $('#addClone').click(function(){
    if (ctr !=3){
    $('#othLink').append(linkInput);
   ctr++;
   
    }
    else{
        
        alert('You have reached the maximum no. of Videos to be uploaded')
    }
});

$('#export').click(function(){
    
  
});

//$('#btnxml').click(function(){
//     $.ajax({
//    
//    url: SITE_URL+'admin/xmlGenerator/downloadXML',
//   success:function(e){
//           
//    location.reload();
//   },
//    });
//        });

$('#btnxml').click(function(){
    
//    var lessTitle= $('#lessonTitle').val();
//   if(/^[a-zA-Z0-9- ]*$/.test(lessTitle) == false) {
//    alert('Lesson Title contains illegal characters.');
//    return false;
//}
//else{
    
   
    
    
//}
    
    
  
    
});
});