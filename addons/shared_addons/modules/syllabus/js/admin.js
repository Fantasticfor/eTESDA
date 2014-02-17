jQuery(function(){


    
	$("#sortTable").tablesorter(({headers: {4: {sorter: false}}})).tablesorterPager({container: $(".pager")});
	// generate a slug when the user types a title in
	//pyro.generate_slug('input[name="name"]', 'input[name="slug"]');
	
});