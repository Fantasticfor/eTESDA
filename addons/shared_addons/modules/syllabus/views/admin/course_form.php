<div class="one_full">
 <ul id="breadcrumbs-one">
		<li><a href="<?php echo site_url().'admin/syllabus'?>" >Sector List</a></li>
		<li><a href="<?php echo site_url('admin/syllabus/viewSector/'.$parent)?>" ><?php echo $ctitle->title ?></a></li>
		<li><a href="" class="current">Create Course </a></li>
		
	</ul>
  
</div>

<div class="one_full">
<section class="title blue">
       <h4> Create a new Course</h4>
</section>

<section class="item">
    <div class="content">
        <?php echo form_open_multipart($this->uri->uri_string(), 'class="crud'.((isset($mode)) ? ' '.$mode : '').'"') ?>
    <div class="form_inputs">
         <ul>
        <div class="one_half">
       
          <li class="<?php echo alternator('', 'even'); ?>">
				<label for="title">Course Title <span>*</span></label>
				<div class="input"><?php echo form_input('title',$item->title, 'style="width:350px"'); ?></div>
			</li>
                        
                          <li class="<?php echo alternator('','even');?>"> 
                            <label for="userfile"><?php echo lang('sylla:upload'); ?> <span>*</span>
                                <br>
                                <small>1170x480 is the preferred size.</small>
                            </label>
                           <div class="input"><?php echo form_upload('image', NULL, 'class="width-15" style="margin-top: -10px;" accept="image/*"'); ?></div>
                        </li>   

			<li class="<?php echo alternator('', 'even'); ?>">
				<label for="description"><?php echo lang('sylla:description'); ?> <span>*</span></label>
				<div class="input"><?php echo form_textarea('description', $item->description, 'class ="wysiwyg-advanced" rows '); ?></div>
                                <?php echo  form_hidden('id', $item->id) ?>
                                <?php //echo form_textarea(array('id'=>'description', 'name'=>'description', 'class' => 'wysiwyg-simple', 'value' => isset($event->description) ? $event->description : '', 'rows' => 10)); ?>
			</li>
               
                               
                       
                              
       
            </div>
        <div class="one_half">
            
                   
                        <li>
                              <label > Course Duration(weeks) <span>*</span></label>
                           <div class="input"><?php
                           $options = array(
                  '7'  => '7 days',
                  '14'    => '14 days',
                  '28'   => '28 days',
                  '35' => '35 days',
                );
                          // echo form_dropdown('c_duration', $options, '7');
                           echo form_input('c_duration',$item->c_duration)?>
                          
                        </li>
                       
                        <li>
                            <label for="c_upload">Course Video/s <span></span> | provide a YouTube link*</label>
                                        <br> 
                                        <div class="input"><?php echo form_input('c_upload',$item->c_upload) ?></div>   
				</li>
                                <li>
                                    <label> Abilities:<span>*</span></label>
                                    <br>
                                   
                                    <?php echo form_dropdown('abilities[]', $abilities,$item->abilities, 'class="chosen-select" multiple=""') ?>
					
                                    
                                </li>
                         
                                   <li>
                                  
                                    <label >Interest:<span>*</span></label>
                                    <br>
					<?php echo form_dropdown('interests[]', $interests,$item->interests, 'class="chosen-select" multiple=""') ?>
                                    
                                </li>
          
            
        </div>
         </ul>
    </div>
        
           <div class="buttons">
	<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel'))) ?>
</div>

<?php echo form_close() ?>
</div>
    
 
</section>

    
</div>
