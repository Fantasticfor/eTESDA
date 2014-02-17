<div class="form_inputs" style="height:300px">
	 <?php echo form_open_multipart('admin/badge/editBadge/'.$badgeDetails->id) ?>
		<ul>
			<li class="<?php echo alternator('', 'even'); ?>">
				<label for="name"> Badge Name<span>*</span></label>
				<div class="input"><?php echo form_input('name',$badgeDetails->name, 'class="width-15"'); ?></div>
			</li>

                        	<li class="<?php echo alternator('', 'even'); ?>">
				<label for="slug">Badge Image <span>*</span></label>
				<div class="input"><?php echo form_upload('image', NULL, 'class="width-15" accept="image/*"'); ?></div>
			</li>
                        
                          <div class="buttons">
	<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel'))) ?>
                              <?php echo form_close() ?>
</div>
		</ul>
    
               
		
		</div>