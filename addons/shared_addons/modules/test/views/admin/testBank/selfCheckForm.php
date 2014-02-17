
<div class="one_full">
 <ul id="breadcrumbs-one">
		<li><a href="<?php echo site_url('admin/test/testBank#selfcheck')?>" > Manage Self Check</a></li>
		<li><a href="<?php echo site_url($this->uri->uri_string()) ?>" class="current" ><?php echo $moduledetails ?>'s Self-Check </a></li>
		
	</ul>
  
</div>
<div class="one_full">

<section class="title blue">

	<h4><?php echo $moduledetails ?>'s Self-Check </h4>


</section>

<section class="item">
<div class="content">

    <div class="one_full">

    
<?php echo form_open_multipart($this->uri->uri_string(), 'class="crud'.((isset($mode)) ? ' '.$mode : '').'"') ?>


	<div class="form_inputs" >
		<fieldset>
			<ul>
                           <div class="one_full"> 
                                
                                
                                
	   
                                    
                                  
                                        <legend >Create Test for <?php echo $moduledetails?>'s Self Check </legend>
                                        <br>
					     <li >
                                  
                                        <label for="itemtype" class="lbl_itemtype">Item Type</label>
					<div class="input">
                                            
                                            <?php $att = 'class="sec_itemtype"'; 
                                             echo form_dropdown('section_itemtype',$dropdownvalues,$att) ?></div>
                                        </li>
                                 
                                          <li>
                                        
                                        
                                        <label for="numitems" class="lbl_noItems" >No. of Items</label>
					<div class="input"><?php echo form_input( array('class'=> 'sec_noitems', 'name'=>'noitems')) ?>
                                        
                                             
                                        </div>
                                       

                                    </li>         
                                  
                                    
                                  
                                    
                                    
                                 

                                   
                                 
                                  

                         </div>   
                      
                            
			</ul>
		
		</fieldset>
	</div>

<div class="buttons">
    <?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
	
</div>


</div>
</div>
    <?php echo form_close(); ?>
</section>
    </div>