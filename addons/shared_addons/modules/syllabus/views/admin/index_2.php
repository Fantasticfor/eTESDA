<div class="one_full">
    <?php if (!empty($pages)): ?>
	<div class="one_half">
		<section class="title syllabus">
			<h4 class="syllabus"> Syllabus</h4>
		</section>
		
		<section class="item">
			<div class="content">
				<div id="page-list">
				<ul class="sortable ">
                                 <?php echo tree_builder($pages, '<li id="page_{{ ID }}"><div class="T{{ Type }}"><a href="admin/syllabus/load_sector" rel="{{ ID }}">{{ HeirarchyID }}</a></div>{{ children }}</li>') ?>   
                                 
				</ul>
				</div>
                            
                            
			</div>
		</section>
	</div>
	
	<div class="one_half last">	
		<section class="title syllabus">
			<h4>Description </h4>
		</section>
		
		<section class="item">
			<div class="content">
				<div id ="page-details" >
				No object is selected.	


				</div>
			</div>
		</section>
	</div>
    <?php else : ?>
				<div class="no_data"><?php echo lang('sylla:currently_no_posts') ?></div>
			<?php endif ?>
</div>