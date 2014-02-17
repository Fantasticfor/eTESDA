
<section class="title">
	<?php if ($this->controller == 'admin' && $this->method === 'editSector'): ?>
	<h4><?php echo sprintf(lang('sylla:editsector'), $category->title);?></h4>
	<?php else: ?>
	<h4><?php echo lang('sylla:addsector');?></h4>
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
                           <div class="input"><?php echo form_upload('image', $item->image['image'], 'class="width-15"'); ?>  <?php if (isset($item->image['image'])): ?>
					<small>Current File: <img src=<?php echo $item->image['thumb'] ?> width="120" height="120"></small>
					<?php endif; ?></div>
                        
                        </li>   
                       
                         
                            
		</ul>
		
		</div>
		
		<div class="buttons">
			<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
		</div>
		
	<?php echo form_close(); ?>
</div>
</section>
  