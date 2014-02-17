


<section class="title blue">
       <h4> Edit <?php echo $title ?>'s Self-Check</h4>
</section>

<section class="item" style="height: 300px">
    <?php echo form_open('admin/test/testBank/editSelfCheck') ?>
    <div style="margin: 10px 10px 10px 10px">
        
    <div class="content ">
       
        
        <ul>
            
              

         
                
            <li><label>Total Items:</label><span class="label label-info"><?php echo $details->noOfItems ?> </span></li>
                <?php echo form_hidden('sectid', $details->sectionID) ?>
            <?php echo form_hidden('moduleID', $moduleid) ?>
                <hr>
                 <li>
					<label for="itemType">Item Type </label>
					<?php echo form_dropdown('itemType',$formoptions, $details->testType) ?>
				</li>
                <li><label> No.Of Items</label> <?php echo form_input('noItems', $details->noOfItems )?> </li>
              
              

	

        
    
   
  
               
            </ul>
        <?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
            <?php form_close() ?>
            </div>
          
        </div>
</section>


