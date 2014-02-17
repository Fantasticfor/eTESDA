$(document).ready(function(){

    var cocctr = 1;
    var sactr = 0;
    var theoctr = 0;
    var pracctr = 0;
    var theochoicecount = 1;
    
    sactr = $('#sacount').val();
    pracctr = $('#praccount').val();
    theoctr = $('#theocount').val();
    
    $("#save_ncv").click(function(){
        
       if($('#overview').val().length < 100){
           
           alert('Overview must be at least 100 characters');
           return;
       }
   
       $('#ncv').submit();
       
       return;
       
    });

    $(document).on("click", "input#delcoc", function(){ 
 
        if(confirm('Do you really want to delete this COC?')){
            
            info = new Array();
             
            info[0] = $(this).attr('name');
            // alert(info[0]);
            $.ajax({
                type: "POST",
                data: {info:info},
                url: $('#baseurlval').val() + "admin/add_nvc_remove_coc",
                success: function(data){
                        // alert(data);
                }
            });
          
            nTr = this.parentNode;
            position = $('#ACtable').dataTable().fnGetPosition(nTr);
            $('#ACtable').dataTable().fnDeleteRow(position[0], position[1], position[2]);
            return false; 
            
        }
        
        return false;
    
    }); 
    
    $(document).on("click", "input#delsa", function(){
        
        if(confirm('Do you really want to delete this question?')){
            
            info = new Array();
            
            info[0] = $(this).attr('name');
            info[1] = $('#sakey').val();
       
            $.ajax({
                
                type: "POST",
                data: {info:info},
                url: $('#burl').val() + "admin/remove_sa_item_from_coc"
//                ,success: function(data){
//                        // alert(data);
//                }
            });
    
            n = this.parentNode;
            positiont = $('#SAtable').dataTable().fnGetPosition(n);
            $('#SAtable').dataTable().fnDeleteRow(positiont[0], positiont[1], positiont[2]);

            return false; 
            
        }
        
        return false;
    
    });
    
    $(document).on("click", "input#deltheo", function(){
        
        if(confirm('Do you really want to delete this question?')){
            
            info = new Array();
            info[0] = $(this).attr('name');
            info[1] = $('#theokey').val();

            $.ajax({
                
                type: "POST",
                data: {info:info},
                url: $('#burl').val() + "admin/remove_theo_item_to_coc",
                success: function(data){
                        // alert(data);
                }
            });

            n = this.parentNode;
            positiont = $('#THEOtable').dataTable().fnGetPosition(n);
            $('#THEOtable').dataTable().fnDeleteRow(positiont[0], positiont[1], positiont[2]);

            return false;
            
        }
        
    });
    
    $(document).on("click", "input#delprac", function(){
        
        if(confirm('Do you really want to delete this task?')){
            
            info = new Array();
            info[0] = $(this).attr('name');
            info[1] = $('#prackey').val();

            $.ajax({
                
                type: "POST",
                data: {info:info},
                url: $('#burl').val() + "admin/remove_prac_item_from_coc",
                success: function(data){
                        // alert(data);
                }
            });

            n = this.parentNode;
            positiont = $('#PRACtable').dataTable().fnGetPosition(n);
            $('#PRACtable').dataTable().fnDeleteRow(positiont[0], positiont[1], positiont[2]);
            return false;
            
        }

        return false;

    });
 
    $(document).on("click", "input#addsa", function(){ 
        
        window.open($('#burl').val() + 'admin/add_sa_to_coc/' + $(this).attr('name'));
        return false;
    
    }); 
    
    $(document).on("click", "input#addtheo", function(){ 
        
        window.open($('#burl').val() + 'admin/add_theo_to_coc/' + $(this).attr('name'));
        return false;
    
    }); 
    
    $(document).on("click", "input#addprac", function(){ 
        
        window.open($('#burl').val() + 'admin/add_prac_to_coc/' + $(this).attr('name'));
        return false;
    
    }); 
    
    $(document).on("click", "input#add_theo_choice", function(){ 
        
       theochoicecount++;
       this.remove();
       $('#choices').append('<tr>' +
                                '<td></td>' +
                                '<td><input id="ans' + theochoicecount + '" value="choice' + theochoicecount +'" name="isanswer" type="radio"/><input type="text" id="choice' + theochoicecount + '"  style="width:40em;"></td>' +
                                '<td><input type="submit" value="Add" class="btn" id="add_theo_choice" /></td>' +
                            '</tr>');
       

    }); 
    
   $('#add_theo').click(function(){
       
       if($('#mquestion').val().length < 10){
           
           alert('Question must be at least 10 characters');
           return false;
           
       }
       
       if(theochoicecount < 2){
           
           alert('There should be at least 2 choices')
           return false;
           
       }
       
       theoctr++;
       question = new Array();
       question[0] = $('#mquestion').val();
       question[1] = new Array();
       question[2] = theoctr;
       question[3] = $('#theokey').val();
       
       for(i = 1; i < theochoicecount + 1; i++){
       
            question[1][i - 1] = new Array();
            question[1][i - 1][0] = $('#choice' + i).val();
     
            if($('#ans' + i).is(':checked'))
                question[1][i - 1][1] = true;
            else
                question[1][i - 1][1] = false;

       }
  
       $.ajax({
                
                type: "POST",
                data: {question:question},
                url: $('#burl').val() + "admin/add_theo_item_to_coc",
                success: function(data){
                        // alert(data);
                }
        });

        theochoicecount = 1;
        $('#choices').empty();
        $('#choices').append('<tr>' +
                                '<td></td>' +
				'<td><input id="ans' + theochoicecount + '" value="choice' + theochoicecount +'" name="isanswer" type="radio"/><input id="choice1" type="text" style="width:40em;"></td>' +
				'<td><input type="submit" value="Add" class="btn" id="add_theo_choice" /></td>' +
                             '</tr>');
                         
        $('#THEOtable').dataTable().fnAddData([
            theoctr,
            $('#mquestion').val(),
            '<input type="image" src="' + $('#burl').val() + 'assets/img/admin/icn_categories.png" id="viewtheochoices" name="' + theoctr + '" title="View Choices" />' +
            '<input type="image" src="' + $('#burl').val() + 'assets/img/admin/icn_trash.png" id="deltheo" name="' + theoctr + '" title="Delete" />',
            "Delete"
        ]);
                         
   });

   $('#add_prac').click(function(){
       
       if($('#task').val().length < 10){
           
           alert('Task must be at least 10 characters');
           return false;
           
       }
       
       info = new Array();
       info[0] = $('#task').val();
       info[1] = $('#prackey').val();
       
        $.ajax({
           
            type: "POST",
            data: {info:info},
            url: $('#burl').val() + "admin/add_prac_item_to_coc",
            success: function(data){
                       // alert(data);
                    }
        });
        
        pracctr++;

        $('#PRACtable').dataTable().fnAddData( [
		pracctr,
		$('#task').val(),
                "<input name=\"" + pracctr + "\" id=\"delprac\" type=\"image\" src=\"" + $('#burl').val() + "assets/img/admin/icn_trash.png\" title=\"Delete\">"
            ] );
  
        
        $('#task').val('');

   });
    
   $('#add_sa').click(function(){

       if($('#question').val().length < 10){
           
           alert('Question must be at least 10 characters');
           return false;
           
       }
       
       info = new Array();
       info[0] = $('#question').val();
       info[1] = $('#sakey').val();
       
       $.ajax({
           
            type: "POST",
            data: {info:info},
            url: $('#burl').val() + "admin/add_sa_item_to_coc",
            success: function(data){
                       // alert(data);
                    }
        });
        
        sactr++;

        $('#SAtable').dataTable().fnAddData( [
		sactr,
		info[0],
                "<input name=\"" + sactr + "\" id=\"delsa\" type=\"image\" src=\"" + $('#burl').val() + "assets/img/admin/icn_trash.png\" title=\"Delete\">"
            ] );
  
        
        $('#question').val('');
       
   });
 
   $('#add_coc').click(function(){
       
       if($('#cocname').val().length < 10){
           
           alert('COC name must be at least 10 characters');
           return false;    
       }
       
       info = new Array();
       info[0] = $('#cocname').val(); // COC name
       info[1] = 1; // Default module value
       info[2] = cocctr; // Key identifier
       info[3] = 
       cocctr++;
       
       $.ajax({
            type: "POST",
            data: {info:info},
            url: $('#burl').val() + "admin/add_nvc_add_coc",
            success: function(data){
                        // alert(data);
                    }
        });
        
                        
        $('#ACtable').dataTable().fnAddData( [
		"<input type=\"hidden\" id=\"" + info[2] + "\">",
		info[0],
		info[1],
		"<input name=\"" + info[2] + "\" id=\"addsa\" type=\"image\" src=\"" + $('#burl').val() + "assets/img/admin/icn_categories.png\" title=\"Update Self Assessment Guide\">"+
                "<input name=\"" + info[2] + "\" id=\"addtheo\" type=\"image\" src=\"" + $('#burl').val() + "assets/img/admin/icn_exam.png\" title=\"View Theoretical exam\">" + 
                "<input name=\"" + info[2] + "\" id=\"addprac\" type=\"image\" src=\"" + $('#burl').val() + "assets/img/admin/icn_settings.png\" title=\"View practical exam\">" +
                "<input name=\"" + info[2] + "\" id=\"delcoc\" type=\"image\" src=\"" + $('#burl').val() + "assets/img/admin/icn_alert_error.png\" title=\"Delete\">"] );
  
       $('#cocname').val('');
  
   });

});
    
    
    

