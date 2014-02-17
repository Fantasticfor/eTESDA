<div class="one_full">

    <section class="title blue"> <h4> Replace Lesson</h4></section>
    <section class="item"> 
                    <?php echo form_open_multipart($this->uri->uri_string().'?modulekey='.urlencode($moduleindex).'&lessonkey='.urlencode($lessonindex)) ?>
            <ul>
                <?php echo form_hidden('lessonindex',$lessonindex) ?>
                <?php echo form_hidden('moduleindex',$moduleindex) ?>
				
                            
                          <li class="<?php echo alternator('', 'even'); ?>">
                        <label> Upload Topics (.XML) </label> 
                        <div class="input"><?php echo form_upload('image', $item->image['image'], 'class="width-15" accept="text/xml"'); ?></div>
                       
                        </li>
					
                                        
                             
                                  
                                        
                              
                  <?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel'))) ?>           
                         
			</ul>
	

    </section>

	

</div>
 
 
 