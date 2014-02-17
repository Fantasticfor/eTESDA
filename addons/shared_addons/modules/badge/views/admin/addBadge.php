<div class="one_full">
    
      <ul id="breadcrumbs-one">
		
		<li><a href="<?php echo site_url('admin/badge/index');?>" > Manage Badges</a></li>
		<li><a href="" class="current"> Add a Badge</a></li>
		
	</ul>
    
</div>

<div class="one_full">

<section class="title blue">
    <h4><strong>Manage Badges</strong></h4>
</section>

<section class="item">
    <div class="content">
        <input type="hidden" id="baseurl" value="<?php echo site_url('admin/badge/getModules') ?>"/>
          <?php echo form_open_multipart($this->uri->uri_string()) ?>
        	<div class="form_inputs">
                  
		<ul>
                    <div class="one_full">
                    <div class="one_third">
                    <li class="<?php echo alternator('', 'even'); ?>">
                        
				<label for="name"> Badge Name <span>*</span></label>
                                <div class="input"><?php echo form_input('name','',''); ?></div>
                                
                                  <label for="slug">Upload a Badge Image<span>*</span><small> *Size must be 128x128</small></label>
                            <div class="input"  style="margin-top: -35px;" ><?php echo form_upload('image', NULL, 'class="width-15" accept="image/*"'); ?></div>
                              
                        </li>     
                    </div>
                    <div class="one_third">
			<li class="<?php echo alternator('', 'even'); ?>">
				    <label for="name"> Choose an Activity<span>*</span></label>
                                <div class="input"><?php echo form_dropdown('activity',array('0'=>'Choose Activity', 'Passed an Online Assessment'=>'Passed an Online Assessment', 'Passed a Self-Check'=>'Passed a Self-Check'),'','id="ddl_activity1" '); ?></div>
                                 
			</li>
                        
                        <div >
                        <li class="<?php echo alternator('', 'even'); ?>"   >
				    <label for="name"> Course<span>*</span></label>
                                <div class="input"><?php echo form_dropdown('course',$courses,$item->course,'id="ddl_course" '); ?></div>
                                
                        </div>
                        <div  >
                        <li id="moduleLi" class="<?php echo alternator('', 'even'); ?>" >
				    <label for="name"> Module<span>*</span></label>
                              <div class="input"><?php echo form_dropdown('module','','','id="ddl_module" '); ?></div>
                                 
			</li>
                        </div>
                        </div>
			
</div>
			
		</ul>
		
		</div>
        <div> 
          <div class="buttons">
	<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel'))) ?>
</div>
            <?php form_close() ?>
        </div> 
    </div>
</section>
    </div>