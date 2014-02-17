
<div class="one_full">
 <ul id="breadcrumbs-one">
		<li><a href="<?php echo site_url('admin/test/testBank') ?>" >Manage Online Assessments</a></li>
		<li><a href="<?php echo site_url($this->uri->uri_string()) ?>" class="current" ><?php echo $coursedetails ?> Online Assessment </a></li>
		
	</ul>
  
</div>
<div class="one_full">

<section class="title blue">

	<h4><?php echo $coursedetails ?> Online Assessment</h4>


</section>

<section class="item">
<div class="content">

    <div class="one_full">

    
<?php echo form_open_multipart() ?>


	<div class="form_inputs" >
		<fieldset>
			<ul>
                            <div class="one_third"> 
                                
                                
                                
	   
                                    
                                  
                                        <legend > Add Test Section </legend>
                                        <br>
					     <li >
                                  
                                        <label for="itemtype" class="lbl_itemtype">Item Type</label>
					<div class="input">
                                            
                                            <?php $att = 'name ="section_itemtype", class="sec_itemtype"'; 
                                             echo form_dropdown('',$dropdownvalues,'',$att) ?></div>
                                
                                      <li>
                                   
                                        <label class="lbl_comp" > Module | Competency </label>
					<div class="input">
                                                                                       <?php $att = 'id = "sl" class="sec_diff"'; 
                                             echo form_dropdown('',$modules,'',$att) ?>
                                             
                                        </div>
                                       

                                    </li>
                                        
                                          </li>
                                        
                                        
                                        <label for="numitems" class="lbl_noItems" >No. of Items</label>
					<div class="input"><?php echo form_input( array('class'=> 'sec_noitems', 'name'=>'section_noitems')) ?>
                                        
                                             
                                        </div>
                                       

                                    </li>         
                                  
                                    
                                  
                                    
                                    
                                       <div style="float:left">
                                     <a class="btn green" id="addtoTestTable"> Add Section</a>     
                                        </div>

                                   
                                 
                                  

                         </div>   
                            <div class="one_half" style="float:left;margin-left:20px; width:60%">
                                <input type="hidden" id="redir" value="<?php echo site_url('admin/test/testBank/addItems')?>">
                                 <input type="hidden" id="baseurl" value="<?php echo site_url('admin/test/testBank/addTestSection')?>">
                                 <input type="hidden" id="removeurl" value="<?php echo site_url('admin/test/testBank/removeSection')?>">
                             <table id="table_id">
    <thead>
        <tr>
             <th>Section No.</th>
             <th>Module | Competency</th>
            <th> Item Type</th>
            <th>No. of Items</th>
            <th></th>
        </tr>
    </thead>
    <tbody><?php
  if(isset($_SESSION['tsections']) && is_array($_SESSION['tsections'])){
    foreach($_SESSION['tsections'] as $input){
?> 
        <tr>
           <td> <?php echo "Section".($input['section'][3]+1) ?></td> 
           <td><?php echo $input['section'][5] ?></td>
           <td><?php echo $input['section'][4] ?> </td>
           <td> <span class='label label-info'><?php echo $input['section'][1] ?> </span></td>
            <td style='text-align:center'>
                <a class='btn btn-lesson red' id='removeSection'><i class='icon-remove'></i> Remove </a><input type='hidden' id='indexid' value="<?php echo $input['section'][3]?>"/> </td> 
        </tr>
        
        <?php
    }
  }else{
?> 
        <tr>
            
            
            
            
        </tr>
        
        
       <?php
  }
?> 
</table>
                                </div>
                            
                            
			</ul>
		
		</fieldset>
	</div>

<div class="buttons">
    <a class="btn blue" href="<?php echo site_url('admin/test/testBank/saveTestSections?course='.$course)?>" > Save</a> <a class="btn gray">Cancel</a>
	
</div>


</div>
</div>
</section>
    </div>