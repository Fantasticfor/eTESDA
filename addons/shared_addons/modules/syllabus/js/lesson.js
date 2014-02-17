/*
Author: Tristan Denyer (based on Charlie Griefer's original clone code, and some great help from Dan - see his comments in blog post)
Plugin and demo at http://tristandenyer.com/using-jquery-to-duplicate-a-section-of-a-form-maintaining-accessibility/
Ver: 0.9.3
Date: Mar 3, 2013
*/
$(function () {
       $('#btnAddLesson').click(function () {
        var num     = $('.clonedLesson').length, // how many "duplicatable" input fields we currently have
            newNum  = new Number(num + 1),      // the numeric ID of the new input field being added
            newElem = $('#LessonEntry' + num).clone().attr('id', 'LessonEntry' + newNum).fadeIn('slow'); // create the new element via clone(), and manipulate it's ID using newNum value
    // manipulate the name/id values of the input inside the new element
        
        
        newElem.find('.lbl_LesTitle').attr('id', 'lbl_LesTitle' + newNum ).html('Lesson Title  ' + newNum);

        newElem.find('.input_LesTitle').attr('name', 'input_LesTitle['+newNum+']') .attr('id', 'input_LesTitle'+newNum);
      
    // insert the new element after the last "duplicatable" input field
        $('#LessonEntry' + num).after(newElem);
        $('#input_LesTitle'+newNum).focus();

    // enable the "remove" button
        $('#btnremoveLesson').attr('disabled', false);

    // right now you can only add 5 sections. change '5' below to the max number of times the form can be duplicated
        if (newNum == 5)
        $('#btnAddLesson').attr('disabled', true).prop('value', "You've reached the limit");
    });

    $('#btnremoveLesson').click(function () {
    // confirmation
        if (confirm("Are you sure you wish to remove this module? This cannot be undone."))
            {
                var num = $('.clonedLesson').length;
                // how many "duplicatable" input fields we currently have
                $('#LessonEntry' + num).slideUp('slow', function () {$(this).remove(); 
                // if only one element remains, disable the "remove" button
                    if (num -1 === 1)
                $('#btnremoveLesson').attr('disabled',true);
                // enable the "add" button
                $('#btnAddLesson').attr('disabled', false).prop('value', "Add Lesson");});
            }
        return false;
             // remove the last element

    // enable the "add" button
        $('#btnAddLesson').attr('disabled', false);
    });

    $('#btnremoveLesson').attr('disabled', true);




});