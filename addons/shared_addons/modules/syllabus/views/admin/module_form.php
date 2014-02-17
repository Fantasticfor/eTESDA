
<div class="one_full">
 <ul id="breadcrumbs-one">
		
		<li><a href="<?php echo site_url().'admin/syllabus'?>" >Sector List</a></li>
		<li><a href="" ><?php echo $ctitle ?></a></li>
		<li><a href="" ><?php echo $course ?></a></li>
		 <li><a href="" class="current">Add Modules to <?php echo $course ?> </a></li>
	</ul>
  
</div>

<div class="one_full">
<section class="title blue">
       <h4> Add Modules to <?php echo $course ?></h4>
</section>

<section class="item">
    <div class="content">
<div class="form_inputs">
            
    <fieldset>
        <ul>
            
            <div class="one_third" style="float:left">                            
            <li>
                <label class="lbl_modTitle" > Module Title  <span>*</span></label>
					 <div class="input"><?php echo form_input(
                                                 array('class'=> 'input_modTitle',
                                                            'name'=>'input_modTitle[1]','style'=>'width:250px')) ?></div>
                </li>
               
                      
                       
                                        
                        <a class="btn green addtoTable"> Add Module</a>
                        
                      
        
                 </div>     
               <div class="one_half " style="float: left; margin-left:80px">
                   
                   <input type="hidden" id="redir" value="<?php echo site_url('admin/syllabus/add_lessons/')?>"/>
                   <input type="hidden" id="baseurl" value="<?php echo site_url('admin/syllabus/add_to_modules')?>"/>
                   <input type="hidden" id="removeurl" value="<?php echo site_url('admin/syllabus/remove_module')?>"/>
                   
                   
<table id="table_id">
    <thead>
        <tr>
            <th>Module Title</th>
            <th>Lessons</th>
            <th></th>
        </tr>
    </thead>
     <tbody>
     <h5><span class="label label-info"> Heads up!</span> To add a module, click on 'Add Module.' </h5>
         <?php
  if(isset($_SESSION['modules']) && is_array($_SESSION['modules'])){
    foreach($_SESSION['modules'] as $input){
?> 
        <tr>
            <td><?php echo $input['module'][0]; ?></td>
            <td><span class="label "><?php echo $input['module'][1] ?></span> </td>
           <td style='text-align:center'> <a class='btn btn-lesson green' name="<?php echo $input['module'][4] ?>" href="<?php echo site_url('admin/syllabus/add_lessons/'.$input['module'][4])?>" onclick="window.open(this.href, 'child', 'height=800,width=1200,scrollbars'); return false"> <i class='icon-plus'></i> Add Lessons</a>
            <a class='btn btn-lesson red' id="removeaw"><i class='icon-remove'></i> Remove</a> <input type='hidden' id='indexid' value="<?php echo $input['module'][4] ?>"/> </td>
            
        </tr>
        
        <?php
    }
  }else{
?> 
        <tr></tr> 
        
       <?php
  }?> 
    </tbody>
</table>
                                        </div>
</ul>
        
        
    </fieldset>	
</div>
    <div class="buttons" > 
        
    <a class="btn blue " href="<?php echo site_url('admin/syllabus/view_course_summary')?>"> Save </a>
    <a class="btn gray" id="cancelbutton" href="<?php echo site_url('admin/syllabus/cancel_modules')?>" > Cancel</a>
  </div>
        </div>
</section>

</div>
