
<section class="title">
	<?php if ($this->controller == 'admin' && $this->method === 'edit_course'): ?>
	<h4><?php echo sprintf(lang('sylla:editcourse'), $category->title);?></h4>
	<?php else: ?>
	<h4><?php echo lang('sylla:addcourse');?></h4>
	<?php endif ?>
</section>

<section class="item">
<div class="content">
	<?php echo form_open_multipart($this->uri->uri_string(), 'class="crud'.((isset($mode)) ? ' '.$mode : '').'"') ?>
		
		<div class="form_inputs">
	
		<ul>
			<li class="<?php echo alternator('', 'even'); ?>">
				<label for="title"><?php echo lang('sylla:title'); ?> <span>*</span></label>
				<div class="input"><?php echo form_input('title',$item->title, 'class="width-15"'); ?></div>
			</li>

			<li class="<?php echo alternator('', 'even'); ?>">
				<label for="description"><?php echo lang('sylla:description'); ?> <span>*</span></label>
				<div class="input"><?php echo form_textarea('description', $item->description, 'class="width-15"'); ?></div>
                                <?php echo  form_hidden('id', $item->id) ?>
			</li>
                        
                       <li class="<?php echo alternator('','even');?>"> 
                            <label for="userfile"><?php echo lang('sylla:upload'); ?> <span>*</span></label>
                           <div class="input"><?php echo form_upload('image', NULL, 'class="width-15" accept="image/*"'); ?></div>
                        </li>   
                       
                        <li class="<?php echo alternator('','even');?>"> 
                                  <label for="dropdown"><?php echo lang('sylla:assign'); ?> <span>*</span></label>  
				  <div class="input"><?php echo form_dropdown('dropdown', $item2 , $parent_id) ?></div>
                         </li>    
                            
		</ul>
		
                    <fieldset>
                                        <legend id="reference" > Course Objectives</legend>
                                        <div class="clonedInputobj" id="entry1">
                                    <div >
					<label for="courseObj" class="lbl_courseObjective" > Course Objective 1 <span>*</span></label>
					
                                        
                                        <div class="input"><?php echo form_input(array( 'name'=> 'input_co[1]' ,'class'=> 'course_obj')) ?></div>
				</div>
                                        
                                        
                                  
                                        </div> 

                                        </fieldset>
                    
                                         <input class="btn green" id="btnAddObjective" value="Add New Objective"/>
                                    <input class="btn red" id="btnremoveObjective" value="Remove Objective"/>
		</div>
		
		<div class="buttons">
			<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
		</div>
		
	<?php echo form_close(); ?>
</div>
</section>
  