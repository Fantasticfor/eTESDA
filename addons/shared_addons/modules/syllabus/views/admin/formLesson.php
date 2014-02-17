
<section class="title">
	<?php if ($this->controller == 'admin' && $this->method === 'editLesson'): ?>
	<h4><?php echo sprintf(lang('sylla:editlesson'), $category->title);?></h4>
	<?php else: ?>
	<h4><?php echo lang('sylla:addlesson');?></h4>
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
                                 <?php echo  form_hidden('id', $item->id) ?>
                        </li>
                          <li class="<?php echo alternator('','even');?>"> 
                                  <label for="dropdown"><?php echo lang('sylla:assign'); ?> <span>*</span></label>  
				  <div class="input"><?php echo form_dropdown('dropdown', $item2 , $parent_id) ?></div>
                         </li>        
		</ul>
		
		</div>
		
		<div class="buttons">
			<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
		</div>
		
	<?php echo form_close(); ?>
</div>
</section>
  