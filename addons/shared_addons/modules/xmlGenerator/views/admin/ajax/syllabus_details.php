<section class="title syllabus">
			<h4><?php echo "$SyllabusType" ?>  </h4> 
		</section>

<section class="item">
<div class="content" >



	<div class="form_inputs"  >
           
            <div class="one_full">
           <ul id="breadcrumbs-one" class="smaller">
		<li><a> Information Technology</a></li>
		<li><a class="current" > <?php echo $results->title ?> </a></li>
		
		
	</ul>
                </div>	
<div class="one_full">
<fieldset>
         
            <legend  > <?php echo $results->title?>
                <?php if( $results->status == live):  ?>
                
                <span class="label label-success"><?php echo $results->status ?></span> 
              <?php else:?>
                 <span class="label"><?php echo $results->status ?></span> 
                <?php endif?>
            
                 <span >
                    <a class="btn gray " onclick="tog_edit()"  style=" margin-bottom:10px" ><i class="icon-edit"> </i></a>
                </span>
                
            </legend>
           
 
           
           
            <p> <label class="label label-info"> Heads Up!</label>  <em>To update content, click on <i class="icon-edit"> </i> </em> </p>
            <p> <strong> Author name:</strong> <?php echo $results->created_by_username ?></p>
            <p> <strong> Last update:</strong> <?php echo format_date($results->updated) ?></</p>
             
            
        </fieldset>
    
 
 <?php if ($type == 2): ?>
            <?php echo form_open_multipart('admin/syllabus/edit_course/') ?>
                	<!--Course -->
            <ul>
		<div style="overflow-y: scroll; height:300px">   		
                            
                            <li> <label >Course Title <span>*</span></label>
					
                                <div class="input" >
                                           
                                    <p class="text-info" id="lbltedit"><?php echo $results->title?></p>
                                            
                                            <?php echo form_input(array('name'=> 'title','id'=>'txtctitle', 'style'=>'display:none'), $results->title) ?>
                                            <?php echo form_hidden('courseid',$results->id); ?>
                                </div>
				</li>
                                
                            <li>
                                  <div>
					<label > Course Description <span>*</span></label>
					
                                        
                                        <div class="input">
                                             <p class="text-info" id="lbldedit"><?php echo $results->description?></p>
                                            <?php echo form_textarea(array('name'=> 'description','style'=> 'width:500px; display:none', 'id'=>'txtcdes'), $results->description) ?></div>
				</div>
                                           
					
                              
                                </li>
                                
                            <li id="cstat" style="display: none">
					<label for="status">Status </label>
                                        
					<div class="input"><?php echo form_dropdown('status', array('draft' =>'draft', 'live' => 'live')) ?></div>
				</li>
                                
                         
                                <li style="float:left"> 
                                    
					<div class="input" style="float:left; display:none" id="cupload">
                                            <label >Course image <span>*</span></label>
                                           <?php echo form_upload('image', NULL, 'class="width-15"'); ?></div>
                                        <div style="float:left">
                                            <label >Current image:</label>
                                           <img src=<?php echo $results->image['thumb'] ?> width="120" height="120">   
                                           </div>     
                                        </li>
				 </div>
                                        <li id="litog"  style="display: none; float:left"> 
                                         <button class="btn blue"  style=" margin-bottom:10px" > Save </button>    
                                       <a class="btn gray" onclick="tog_save()"  style=" margin-bottom:10px" > Cancel </a>
                                        </li>
                                        
                                        
                                    

			</ul>
                        
                        <?php form_close(); ?>
                        <div class="buttons" style="margin-top: 50px">
                            <a href="<?php echo site_url('admin/syllabus/add_modules')?>" class="btn blue"> Add Modules </a>
                            <a class="btn gray"> Preview </a>
                            <a href="<?php echo site_url('admin/syllabus/deleteCourse').'/'.$results->id ?>" class="btn gray confirm"> Delete</a>
                        </div>
	

                                    <!-- Module -->
     <?php elseif($type == 3): ?>
            <?php echo form_open('admin/syllabus/edit_module/') ?>
                  <ul>
				
                                
                            <li> <label >Module Title <span>*</span></label>
                                        <p class="text-info" id="lbltedit"><?php echo $results->title?></p>
					<div class="input"><?php echo form_input(array('name'=> 'title','id'=>'txtctitle', 'style'=>'display:none'), $results->title) ?>
                                        <?php echo form_hidden('moduleid',$results->id); ?></div>
				</li>
                                

                                <li id="litog" style="display: none; float:left"> 
                                         <button class="btn blue"  style=" margin-bottom:10px" > Save </button>    
                                       <a class="btn gray" onclick="tog_save()"  style=" margin-bottom:10px" > Cancel </a>
                                        </li> 

			</ul>

                        <?php form_close(); ?>
                        <div class="buttons" style="margin-top: 50px">
                            <a href="<?php echo site_url('admin/syllabus/addLessons/'.$results->id)?>" class="btn blue"> Add Lessons </a>
                            <a class="btn gray"> Preview </a>
                             <a href="<?php echo site_url('admin/syllabus/deleteModule').'/'.$results->id ?>" class="btn gray confirm"> Delete</a>
                        </div>
	
                                        <!--Lesson-->
<?php elseif($type == 4): ?>
                                        <?php echo form_open('admin/syllabus/edit_lesson/') ?>
     <ul>
				
                                
                            <li> <label >Lesson Title <span>*</span></label>
					 <p class="text-info" id="lbltedit"><?php echo $results->title?></p>
					<div class="input"><?php echo form_input(array('name'=> 'title','id'=>'txtctitle', 'style'=>'display:none'), $results->title) ?>
                                        <?php echo form_hidden('lessonid',$results->id); ?></div>
				</li>
                                
                             <li id="litog" style="display: none; float:left"> 
                                         <button class="btn blue"  style=" margin-bottom:10px" > Save </button>    
                                       <a class="btn gray" onclick="tog_save()"  style=" margin-bottom:10px" > Cancel </a>
                                        </li>    

			</ul>
                                            <?php form_close(); ?>
                             <div class="buttons" style="margin-top: 50px">
                            <a href="<?php echo site_url('admin/syllabus/loadUpload/'.$results->id)?>" class="btn blue cboxElement modal"> Add Topics </a>
                            <a class="btn gray"> Preview </a>
                             <a href="<?php echo site_url('admin/syllabus/deleteLesson').'/'.$results->id ?>" class="btn gray confirm"> Delete</a>
                        </div>         
<?php elseif($type == 5): ?>
    
                                      <?php echo form_open('admin/syllabus/edit_topic') ?>  
                                        <ul>
				
                                
                            <li><label >Topic Title <span>*</span></label>
				 <p class="text-info" id="lbltedit"><?php echo $results->title?></p>
					<div class="input"><?php echo form_input(array('name'=> 'title','id'=>'txtctitle', 'style'=>'display:none'), $results->title) ?>
                                        <?php echo form_hidden('topicid',$results->id); ?></div>
			   </li>
                           
                           <li><label> Text Content </label>
                                
                                        <div class="input">
                                             <p class="text-info" id="lbldedit"><?php echo  $results->textCont?></p>
                                            <?php echo form_textarea(array('name'=> 'description','style'=> 'width:500px; display:none', 'id'=>'txtcdes'), $results->textCont) ?></div>
                           </li>
                           
                           <li><label > Youtube Link</label>
				 <p class="text-info" id="lblledit"><?php echo $link->link?></p>
					<div class="input"><?php echo form_input(array('name'=> 'link','id'=>'txtlink', 'style'=>'display:none'), $link->link) ?>
                                        <?php echo form_hidden('mediaid',$link->id); ?></div>
			   </li>
                                
                                
			<li id="litog" style="display: none; float:left"> 
                                         <button class="btn blue"  style=" margin-bottom:10px" > Save </button>    
                                       <a class="btn gray" onclick="tog_save()"  style=" margin-bottom:10px" > Cancel </a>
                                        </li>    	 
                                        
                                   
                                      

			</ul>
                                        <?php form_close(); ?>
                                         <a href="<?php echo site_url('admin/syllabus/deleteTopic').'/'.$results->id ?>" class="btn gray confirm"> Delete</a>
    <?php endif ?>


</div>

            
	</div>
          
          
</div>
         <div class="buttons" id="tog_button" style="margin:10px; display: none">
          <?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel'))) ?>
</div>  
         
</section> 

	