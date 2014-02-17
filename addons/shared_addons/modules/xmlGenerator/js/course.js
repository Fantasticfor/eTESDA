/*
Author: Tristan Denyer (based on Charlie Griefer's original clone code, and some great help from Dan - see his comments in blog post)
Plugin and demo at http://tristandenyer.com/using-jquery-to-duplicate-a-section-of-a-form-maintaining-accessibility/
Ver: 0.9.3
Date: Mar 3, 2013
*/
$(function () {
    $('#btnAddObjective').click(function () {
        var num     = $('.clonedobj').length, // how many "duplicatable" input fields we currently have
            newNum  = new Number(num + 1),      // the numeric ID of the new input field being added
            newElem = $('#entry_obj' + num).clone().attr('id', 'entry_obj' + newNum).fadeIn('slow'); // create the new element via clone(), and manipulate it's ID using newNum value
    // manipulate the name/id values of the input inside the new element
        // H2 - section
        newElem.find('.lbl_courseObjective').attr('id', 'lbl_courseObjective' + newNum ).html('Course Objective ' + newNum);

        // section Title - text
        
        newElem.find('.input_co').attr('name', 'input_co['+newNum+']');
         newElem.find('.input_co').attr('id', 'input_co'+newNum);
           newElem.find('.input_co').attr('value', null);
                  
       
        
    // insert the new element after the last "duplicatable" input field
        $('#entry_obj' + num).after(newElem);
        $('#input_co'+newNum).focus();

    // enable the "remove" button
        $('#btnremoveObjective').attr('disabled', false);

    // right now you can only add 5 sections. change '5' below to the max number of times the form can be duplicated
        if (newNum == 5)
        $('#btnAddObjective').attr('disabled', true).prop('value', "You've reached the limit");
    });

    $('#btnremoveObjective').click(function () {
    // confirmation
        if (confirm("Are you sure you wish to remove this section? This cannot be undone."))
            {
                var num = $('.clonedobj').length;
                // how many "duplicatable" input fields we currently have
                $('#entry_obj' + num).slideUp('slow', function () {$(this).remove(); 
                // if only one element remains, disable the "remove" button
                    if (num -1 === 1)
                $('#btnremoveObjective').attr('disabled',true);
                // enable the "add" button
                $('#btnAddObjective').attr('disabled', false).prop('value', "Add New Objective");});
            }
        return false;
             // remove the last element

    // enable the "add" button
        $('#btnAddObjective').attr('disabled', false);
    });

    $('#btnremoveObjective').attr('disabled', true);





 $('#btnaddOppurtunity').click(function () {
        var num     = $('.clonedJob').length, // how many "duplicatable" input fields we currently have
            newNum  = new Number(num + 1),      // the numeric ID of the new input field being added
            newElem = $('#job_entry' + num).clone().attr('id', 'job_entry' + newNum).fadeIn('slow'); // create the new element via clone(), and manipulate it's ID using newNum value
    // manipulate the name/id values of the input inside the new element
        // H2 - section
        newElem.find('.lbl_Oppurtunity').attr('id', 'lbl_courseObjective' + newNum ).html('Job Oppurtunity ' + newNum);

        // section Title - text
        
        newElem.find('.input_oppur').attr('name', 'input_oppur'+[newNum]);
        newElem.find('.input_oppur').attr('id', 'input_oppur'+newNum);
        newElem.find('.input_oppur').attr('value', null);
        
        
         newElem.find('.lbl_Salary').attr('id', 'lbl_Salary'+newNum).html('Salary ' + newNum);
        newElem.find('.input_salary').attr('name', 'input_salary'+[newNum]);
        newElem.find('.input_salary').attr('value', null);
        
    // insert the new element after the last "duplicatable" input field
        $('#job_entry' + num).after(newElem);
        $('#input_oppur'+newNum).focus();

    // enable the "remove" button
        $('#btnremoveOppurtunity').attr('disabled', false);

    // right now you can only add 5 sections. change '5' below to the max number of times the form can be duplicated
        if (newNum == 5)
        $('#btnaddOppurtunity').attr('disabled', true).prop('value', "You've reached the limit");
    });

    $('#btnremoveOppurtunity').click(function () {
    // confirmation
        if (confirm("Are you sure you wish to remove this section? This cannot be undone."))
            {
                var num = $('.clonedInputJob').length;
                // how many "duplicatable" input fields we currently have
                $('#job_entry' + num).slideUp('slow', function () {$(this).remove(); 
                // if only one element remains, disable the "remove" button
                    if (num -1 === 1)
                $('#btnremoveOppurtunity').attr('disabled',true);
                // enable the "add" button
                $('#btnaddOppurtunity').attr('disabled', false).prop('value', "Add Oppurtunity");});
            }
        return false;
             // remove the last element

    // enable the "add" button
        $('#btnaddOppurtunity').attr('disabled', false);
    });

    $('#btnremoveOppurtunity').attr('disabled', true);




});





