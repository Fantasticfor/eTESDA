/*
Author: Tristan Denyer (based on Charlie Griefer's original clone code, and some great help from Dan - see his comments in blog post)
Plugin and demo at http://tristandenyer.com/using-jquery-to-duplicate-a-section-of-a-form-maintaining-accessibility/
Ver: 0.9.3
Date: Mar 3, 2013
*/
$(function () {
       $('#btnAddModule').click(function () {
        var num     = $('.clonedModule').length, // how many "duplicatable" input fields we currently have
            newNum  = new Number(num + 1),      // the numeric ID of the new input field being added
            newElem = $('#ModuleEntry' + num).clone().attr('id', 'ModuleEntry' + newNum).fadeIn('slow'); // create the new element via clone(), and manipulate it's ID using newNum value
    // manipulate the name/id values of the input inside the new element
        
        
        newElem.find('.mod_reference').attr('id', 'mod_reference' + newNum ).html('Module ' + newNum);

        
        newElem.find('.lbl_modTitle').attr('class', 'lbl_modTitle'+newNum);
        newElem.find('.input_modTitle').attr('name', 'input_modTitle['+newNum+']') .attr('id', 'input_modTitle'+newNum);
      
    // insert the new element after the last "duplicatable" input field
        $('#ModuleEntry' + num).after(newElem);
        $('#input_modTitle'+newNum).focus();

    // enable the "remove" button
        $('#btnremoveModule').attr('disabled', false);

    // right now you can only add 5 sections. change '5' below to the max number of times the form can be duplicated
        if (newNum == 5)
        $('#btnAddModule').attr('disabled', true).prop('value', "You've reached the limit");
    });

    $('#btnremoveModule').click(function () {
    // confirmation
        if (confirm("Are you sure you wish to remove this module? This cannot be undone."))
            {
                var num = $('.clonedModule').length;
                // how many "duplicatable" input fields we currently have
                $('#ModuleEntry' + num).slideUp('slow', function () {$(this).remove(); 
                // if only one element remains, disable the "remove" button
                    if (num -1 === 1)
                $('#btnremoveModule').attr('disabled',true);
                // enable the "add" button
                $('#btnAddModule').attr('disabled', false).prop('value', "Add Module");});
            }
        return false;
             // remove the last element

    // enable the "add" button
        $('#btnAddModule').attr('disabled', false);
    });

    $('#btnremoveModule').attr('disabled', true);




});