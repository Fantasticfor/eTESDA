
<div class="one_full">
    <div class="alert warning">Heads up! You need to create a test first to live a course. <a href="<?php echo site_url('admin/test/'); ?>" > create a test now!</a></div>
 <div class="one_full">
 <ul id="breadcrumbs-one">
     <li><a href="<?php echo site_url().'admin/syllabus'?>" >Sector List</a></li>
		<li><a class="current"><?php echo $details->title?></a></li>
		
	</ul>
  
</div>
    
        
    <div class="one_full"> 
        
        <section class="title syllabus">
            <h4 class="syllabus"><?php echo $details->title?></h4> 
        </section>
        
        <section class="item">
<div class="container">
            <fieldset>
                <legend> </legend>
                <input type="hidden" id="siteurl" value='<?php echo site_url();?>'>
                 
                <fieldset>
                    <legend >Sector Description</legend>

                    <ul>
                    <li>
                        <?php //print_r($details->image) ?>
                        <?php //echo $details->image['img'] ?>
                       <img src="<?php echo $details->image['image'] ?>" width="120" height="120">
                    </li>
                    <br>
                    
                  
                    <li>
                        <label></label>
                        <p>
                            <?php echo $details->description ?>
                        </p>
                    </li>
                    <li>
                      <a class="btn blue" href='<?php echo site_url('admin/syllabus/create_course/'.$syllaid)?>' > Create Course</a>
                      <a class="btn gray" href='<?php echo site_url('admin/syllabus/editSector/'.$syllaid)?>'>Edit Sector Details</a>
                        
                    </li>
                </ul>
                    
                </fieldset>
            
            
            </fieldset>	
    </div>
        </section>
            
    </div>	
                
            
      
    
    <div class="one_half " > 
             
		<section class="title syllabus">
			<h4 class="syllabus"> <?php echo $details->title?> Courses</h4>
                        
		</section>
		
		<section class="item">
			<div class="content">
				<div id="page-list">
                                <ul class="sortable ">

                                 <?php echo tree_builder($pages, '<li id="page_{{ ID }}"><div class="T{{ Type }}"><a rel="{{ ID }}">{{ HeirarchyID }}</a> <span class="label label-lastupdate {{status}}">{{status}}</span> <span class="label label-lastupdate">{{ updated }}</span></div>{{ children }}</li>') ?>   

				</ul>
				</div>
                            
                            
			</div>
		</section>
	</div>
	
     
    
	<div class="one_half last " id ="page-details" >
             
             

             
		
	
	</div>
</div>