/*
Author: Tristan Denyer (based on Charlie Griefer's original clone code, and some great help from Dan - see his comments in blog post)
Plugin and demo at http://tristandenyer.com/using-jquery-to-duplicate-a-section-of-a-form-maintaining-accessibility/
Ver: 0.9.3
Date: Mar 3, 2013
*/
$(function () {
    $('#btnAddSection').click(function () {
        var num     = $('.clonedInput').length, // how many "duplicatable" input fields we currently have
            newNum  = new Number(num + 1),      // the numeric ID of the new input field being added
            newElem = $('#entry' + num).clone().attr('id', 'entry' + newNum).fadeIn('slow'); // create the new element via clone(), and manipulate it's ID using newNum value
    // manipulate the name/id values of the input inside the new element
        // H2 - section
        newElem.find('.testSec').attr('id', 'ID' + newNum + '_reference').html('Test Section ' + newNum);

        // section Title - text
        newElem.find('.lbl_ttl').attr('for','lbl_ttl'+ newNum);
        newElem.find('.input_ttl').attr('name', 'section_title'+newNum);
                  
         newElem.find('.lbl_itemtype').attr('for', 'ID' + newNum + '_itemtype');
        newElem.find('.sec_itemtype').attr('name', 'section_itemtype' + newNum );
        
         newElem.find('.lbl_noItems').attr('for', 'ID' + newNum + '_noitems');
        newElem.find('.sec_noitems').attr('name', 'section_noitems' + newNum );
        
    // insert the new element after the last "duplicatable" input field
        $('#entry' + num).after(newElem);
        $('#ID' + newNum + '_title').focus();

    // enable the "remove" button
        $('#btnremoveSection').attr('disabled', false);

    // right now you can only add 5 sections. change '5' below to the max number of times the form can be duplicated
        if (newNum == 3)
        $('#btnAddSection').attr('disabled', true).prop('value', "You've reached the limit");
    });

    $('#btnremoveSection').click(function () {
    // confirmation
        if (confirm("Are you sure you wish to remove this section? This cannot be undone."))
            {
                var num = $('.clonedInput').length;
                // how many "duplicatable" input fields we currently have
                $('#entry' + num).slideUp('slow', function () {$(this).remove(); 
                // if only one element remains, disable the "remove" button
                    if (num -1 === 1)
                $('#btnremoveSection').attr('class','btn red disabled');
                // enable the "add" button
                $('#btnAddSection').attr('disabled', false).prop('value', "add section");});
            }
        return false;
             // remove the last element

    // enable the "add" button
        $('#btnAddSection').attr('disabled', false);
    });

    $('#btnremoveSection').attr('disabled', true);

});