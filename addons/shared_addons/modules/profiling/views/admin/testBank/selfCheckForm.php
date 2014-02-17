
<div class="one_full">
 <ul id="breadcrumbs-one">
		<li><a href="" > Manage Tests</a></li>
		<li><a href="" class="current" >(module name)'s Self-Check </a></li>
		
	</ul>
  
</div>
<div class="one_full">

<section class="title blue">

	<h4>(module name)'s Self-Check </h4>


</section>

<section class="item">
<div class="content">

    <div class="one_full">

    
<?php echo form_open_multipart() ?>


	<div class="form_inputs" >
		<fieldset>
			<ul>
                           <div class="one_full"> 
                                
                                
                                
	   
                                    
                                  
                                        <legend >Create Test for (module name's) Self Check </legend>
                                        <br>
					     <li >
                                  
                                        <label for="itemtype" class="lbl_itemtype">Item Type</label>
					<div class="input">
                                            
                                            <?php $att = 'name ="section_itemtype", class="sec_itemtype"'; 
                                             echo form_dropdown('',array('Single Answer-Multiple Choice' =>'Single Answer-Multiple Choice', 'Single Answer-Identification' => 'Single Answer-Identification', 'Single Answer-TrueFalse'=> 'Single Answer-True or False','Multiple 
                                                 Answer-Multiple Choice'=>'Multiple Answer-Multiple Choice','Weighted Answer-Multiple choice'=>'Weighted Answer-Multiple choice'),'',$att) ?></div>
                                        </li>
                                 
                                          <li>
                                        
                                        
                                        <label for="numitems" class="lbl_noItems" >No. of Items</label>
					<div class="input"><?php echo form_input( array('class'=> 'sec_noitems', 'name'=>'section_noitems')) ?>
                                        
                                             
                                        </div>
                                       

                                    </li>         
                                  
                                    
                                  
                                    
                                    
                                 

                                   
                                 
                                  

                         </div>   
                      
                            
			</ul>
		
		</fieldset>
	</div>

<div class="buttons">
    <a class="btn blue" href="<?php echo site_url('admin/test/testBank/')?>" > Save</a> <a class="btn gray">Cancel</a>
	
</div>


</div>
</div>
</section>
    </div>