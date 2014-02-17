<div class="one_full">

    <section class="title blue"> <h4> <?php echo "Section ".$secid ?> </h4></section>
    <section class="item">
        <?php echo form_open($this->uri->uri_string()) ?>
            <ul>
				
                                
                           
                                
                                   <li>
                                    <div>
					<label > No. of Items <span>*</span></label>
					
                                        
                                        
                                        <div class="input"><?php echo form_input('noItems') ?>  
                                        </div>
                                    </div>
                                            <div >
					
                                        
                                        
                                  
                                        
                              
                                </li>
                               
			</ul>
	
    <div class="buttons">
            <?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel'))) ?>
    </div>
     </section>

 </div
 
 