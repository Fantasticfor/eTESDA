
<div class="one_full">
 <ul id="breadcrumbs-one">
		<li><a href="" >  Item Bank</a></li>
		<li><a href="" class="current">Add Items to (competency name)'s Item Bank</a></li>
                
		
	</ul>
  
</div>
<div class="one_full">

<section class="title blue">
<input id="baseurl" type="hidden" value="<?php echo base_url()?>">
	<h4>Add Items to (competency name)'s Item Bank</h4>


</section>

<section class="item">
<div class="content">

    <div class="one_full">

    
<?php echo form_open_multipart() ?>


	<div class="form_inputs" >
		<fieldset>
			<ul>
                            <div class="one_full"> 
                                
                                
                                
	   
                                <div class="hoy"></div>
                                  
                                        <legend > Add Items </legend>
                                        <br>
                                        <div class="one_half">
                                      <li >
                                  
                                        <label for="itemtype" class="lbl_itemtype">Item Type</label>
					<div class="input">
                                            
                                            <?php $att = ' id="select_itemtype" class="select_itemtype"'; 
                                             echo form_dropdown('select_itemtype',array('Single Answer-Multiple Choice' =>'Single Answer-Multiple Choice', 'Single Answer-Identification' => 'Single Answer-Identification', 'Single Answer-TrueFalse'=> 'Single Answer-True or False','Multiple choice - Single Response'=>'Multiple choice - Single Response','Weighted Multiple Choice'=>'Weighted Multiple Choice'),'',$att) ?></div>
                                        </li>
                                                                 
					<li>
                                            
					<label for="title">Prompt/Question <span>*</span> </label>
					<div class="input"><?php echo form_input(array('name'=>'input_question','class'=>'input_question')) ?></div>
				</li>
                              <li >
                                   
                                    <div > 
                                        <label for="difficulty">Difficulty</label>
					<div class="input"><?php $att3 = 'class="select_diff"'; echo form_dropdown('difficulty', array('easy' =>'Easy', 'medium' => 'Medium', 'hard'=> 'Hard'),'',$att3) ?></div>
                                </div>
                                  
                                  <br>   
                                  <a class="btn green" id="addtoItemTable"> Add Item</a>    
                                  
                                    </li>
                                
                                      
                                    </div>
                             
                                        
                                        <div class="one_half">

                                <li style="">
                                    <div id="responses"></div>
                                 
                                    </li>

                                    
                                  
                                    
                                    
                                   
                                 </div>
                                  

                         </div>   
                            <div class="one_full" >
                               
                             <table  id="item_table" class="tablesorter"  >
    <thead>
        <tr>
            
             <th>  Item Type </th>
              <th>Prompt | Question</th>
            <th>Difficulty</th>
             <th></th>
    
        </tr>
    </thead>
    <tbody>
       
    
    </tbody>
</table>
                          
                                </div>
                            
                            
			</ul>
		
		</fieldset>
	</div>

<div class="buttons">
    <a class="btn blue" href="<?php echo site_url('admin/test/itemBank/index')?>" > Save</a> <a class="btn gray">Cancel</a>
	
</div>


</div>
</div>
</section>
    </div>