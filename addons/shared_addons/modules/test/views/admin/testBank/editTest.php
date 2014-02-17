<div class="one_full">
<?php echo form_open('admin/test/testBank/edit_section') ?>
    <section class="title blue"> <h4> Section <?php echo $no ?> </h4></section>
    <section class="item" style="height: 300px">

            <ul>
				
                                
                           
                                <?php echo form_hidden('sectionID', $section->sectionID) ?>
                                <?php echo form_hidden('moduleID', $moduleid) ?>
                                   <li >
                                  <div >
					<label > No. of Items <span>*</span></label>
					
                                        
                                        <div class="input">
                                        <div class="input"><?php echo form_input(array('name'=> 'no_items', 'id'=>'no_items', 'value' => $section->noOfItems)) ?>  
                                        </div>
				</div>
                                            <div >
					
                                        
                                        
                                  
                                        
                              
                                </li>
                                <li>
                                   <label >Item Type<span>*</span></label>
                                   <div class="input"> <?php   
                                             echo form_dropdown('section_itemtype',$formoptions,$section->testType) ?>
                                    </div>
                                </li>
                         
                                
                         
			</ul>
        <div style="margin-top: 100px">	
<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel'))) ?>
        </div>
    </section>
    
</div>
                                        

 
 