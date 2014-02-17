

<section class="title blue">
       <h4> Create a new Course</h4>
   
   
 
    
    
    
</section>

<section class="item">
<div class="content">

    
<?php echo form_open_multipart() ?>

<div class="tabs">

	<ul class="tab-menu">
		<li><a href="#create-course"><span> Course Details  </span></a></li>
		<li><a href="#create-module"><span> Course Module/s</span></a></li>
		
	</ul>

	<!-- Content tab -->
	<div class="form_inputs" id="create-course">
		<div class="content">

<?php echo form_open_multipart() ?>





	
	<div class="form_inputs">
		<fieldset>
			<ul>
				<li>
					<label for="title">Course Title <span>*</span></label>
					<div class="input"><?php echo form_input('title') ?></div>
				</li>
                                
				<li>
					<label for="desc">Course Description  <span>*</span></label>
                                        <div class="input"><?php echo form_textarea('desc') ?></div>
				</li>
                                
				<li>
					<label for="status">Status </label>
					<div class="input"><?php echo form_dropdown('status', array('draft' =>'draft', 'live' => 'live')) ?></div>
				</li>
                                
                                
                                  <li style="float:left">
                                          <h4><strong> Assign to: </strong></h4>
                                    <div style="float:left">
					<label for="course">Sector </label>
					<div class="input"><?php echo form_dropdown('sector', array('sector' =>'--Choose a Sector', 'informationtech  ' => 'Information Technology')) ?>
                                        </div>
				</div>

                                    </li>
                                   
                            
                                <li style="float:left; margin-top:30px">
                                    
                                    
                                    <fieldset>
                                        <legend id="reference" > Course Objectives</legend>
                                        <div class="clonedobj" id="entry_obj1">
                                    <div >
					<label for="courseObj" class="lbl_courseObjective" > Course Objective 1 <span>*</span></label>
					
                                        
                                        <div class="input"><?php echo form_input(array( 'name'=> 'input_co[1]' ,'class'=> 'input_co')) ?></div>
				</div>
                                        
                                        
                                  
                                        </div> 

                                        </fieldset>
                                       
                                       <input class="btn green" id="btnAddObjective" value="Add New Objective"/>
                                    <input class="btn red" id="btnremoveObjective" value="Remove Objective"/>
                                    
                                <li style="float:left; margin-top:30px">
                                    
                                     
                                    <fieldset>
                                        <legend id="reference" > Job Opportunities</legend>
                                    <div class="clonedJob" id="job_entry1">
                                        <div >
					<label for="title" class="lbl_Oppurtunity" > Job Opportunity 1 <span>*</span></label>
					
                                        
                                        <div class="input"><?php echo form_input(array('class'=> 'input_oppur', 'name'=>'input_oppur[1]')) ?></div>
				</div>
                                            <div >
					<label for="title" class="lbl_Salary">Salary 1 <span>*</span></label>
					
                                        
                                        <div class="input"><?php echo form_input(array('class'=> 'input_salary', 'name'=>'input_salary[1]')) ?></div>
				</div>
                                        
                                        
                                  
                                        
</div>
                                        </fieldset>
                                        
                                    </li>
                                    <input class="btn green" id="btnaddOppurtunity" value="Add Oppurtunity"/>
                                    <input class="btn red" id="btnremoveOppurtunity" value="Remove Oppurtunity"/>
                                    </li>

                                    

			</ul>
		
		</fieldset>
	</div>

	

	
	





</div>
	</div>

	

	<div class="form_inputs" id="create-module">
            
	<div class="clonedModule" id="ModuleEntry1">	  
            <fieldset>
                                        <legend id="mod_reference" class="mod_reference" > Module 1 </legend>
                                    
                                        
					<label class="lbl_modTitle" > Module Title  <span>*</span></label>
					 <div class="input"><?php echo form_input(
                                                 array('class'=> 'input_modTitle',
                                                            'name'=>'input_modTitle[1]')) ?></div>
                                        
				
                                        <!--lesson-->
                                         
                                        <em> Add lessons to Module</em>
                                    
                                        <div class="clonedLesson" id="LessonEntry1"> 	
					<label class="lbl_LesTitle" > Lesson Title 1  <span>*</span></label>
					 <div class="input"><?php echo form_input(
                                                 array('class'=> 'input_LesTitle',
                                                            'name'=>'input_LesTitle[1]')) ?></div>
                                        </div>
				                                        <input class="btn green btn-lesson " id="btnAddLesson" value="Add Lesson"/>
                                    <input class="btn red btn-lesson" id="btnremoveLesson" value="Remove Lesson"/>
 
                                        
                                     
                   
                                        
                                     
                   </fieldset>
                                                </div>
                                         <input class="btn green " id="btnAddModule" value="Add Module"/>
                                    <input class="btn red" id="btnremoveModule" value="Remove Module"/>
            
	</div>

	

</div>

<div class="buttons">
	<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel'))) ?>
</div>

<?php echo form_close() ?>

</div>
</section>


