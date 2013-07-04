<section class="title">
	<!-- We'll use $this->method to switch between faq.create & faq.edit -->
	<h4><?php echo lang('faq:'.$this->method); ?></h4>
</section>

<section class="item">

	<?php echo form_open_multipart($this->uri->uri_string(), 'class="crud"'); ?>
		
		<div class="form_inputs">
	
		<ul>
			<li class="<?php echo alternator('', 'even'); ?>">
				<label for="title"><?php echo lang('faq:title'); ?> <span>*</span></label>
				<div class="input"><?php echo form_input('title', set_value('title', $title), 'class="width-15"'); ?></div>
			</li>

			<li class="<?php echo alternator('', 'even'); ?>">
				<label for="description"><?php echo lang('faq:description'); ?> <span>*</span></label>
				<div class="input"><?php echo form_textarea('description', set_value('description', $description), 'class="width-15"'); ?></div>
			</li>
		</ul>
		
		</div>
		
		<div class="buttons">
			<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
		</div>
		
	<?php echo form_close(); ?>

</section>