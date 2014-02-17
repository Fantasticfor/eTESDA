
<div class="one_full">
 <ul id="breadcrumbs-one">
		<li><a href="<?php echo site_url('admin/profiling') ?>" >  Profiling Test Item Bank</a></li>
		<li><a href="<?php echo $this->uri->uri_string() ?>" class="current">Add Items to <?php echo $name ?>'s Item Bank</a></li>
                
		
	</ul>
  
</div>
<div class="one_full">

<section class="title blue">
<input id="baseurl" type="hidden" value="<?php echo base_url()?>">
	<h4>Add Items to  <?php echo $name ?>'s Item Bank</h4>
       
</section>

<section class="item">
<div class="content">

    <div class="one_full">

    
<?php echo form_open() ?>


	<div class="form_inputs" >
		<fieldset>
			<ul>
                            <div class="one_full"> 
                                
                                
                                
	   
                                    
                                  
                                        <legend > Add Items </legend>
                                        <br>
                                     
                             
                                        
                                      
                                       <li>
                                            
					<label for="title">Prompt/Question <span>*</span> </label>
					<div class="input"><?php echo form_input(array('name'=>'input_question','class'=>'input_question')) ?></div>
				
                                         <li style="">
                                    
                                    <div id="responses">
                                        
                                         
                                        <legend> Response</legend>
                                        <br>
                                    <div >
                                        <?php $first= array('name'=>'isanswer', 'type'=> 'radio', 'id' => 'ans1', 'value' => 'choice1','class'=>'res_radio');
                                         echo form_input($first);?> 
					
                                         <label>Agree</label>
                                        
                                        <br>
                                        
                                        <?php $second= array('name'=>'isanswer', 'type'=> 'radio', 'id' => 'ans2', 'value' => 'choice2','class'=>'res_radio');
                                                echo form_input($second);?> 
                                        <label>Disagree</label>

				</div>
                                 
                                    </li>
                                    <a class="btn green" id="addInterestItem"> Add Item</a>
                                       </li>
                               

                                    
                                  
                                    
                                    
                               
                                  

                         </div>   
                            <div class="one_full" >
                               
                             <table id="item_table" class="tablesorter">
           <thead>
           <tr>
             <th>Prompt | Question</th>
             <th>Response</th>
             <th></th>
             </tr>
         </thead>
    <tbody>
        <?php
  if(isset($_SESSION['iitems']) && is_array($_SESSION['iitems'])){
    foreach($_SESSION['iitems'] as $key=>$input){
?> 
        <tr>
           <td> <?php echo $input[1] ?></td> 
           <?php  foreach($input[2] as $choices){
                         if($choices[1]== 'true'){
                             $answer = $choices[0];
                         }
                    }?>
           <td><?php echo $answer ?></td>
           
            <td>
              <a class='btn btn-lesson red' id='removeItem'><i class='icon-remove'></i> Remove </a><input type='hidden' id='indexid' value="<?php echo $key ?>"/> </td> 
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
       
    </tbody>
</table>
                                </div>
                            
                            
			</ul>
		
		</fieldset>
	</div>

<div class="buttons">
    <a class="btn blue" href="<?php echo site_url('admin/profiling/saveInterestItems').'/'.$sectionid?>" > Save</a> <a href="<?php echo site_url('admin/profiling') ?>"class="btn gray">Cancel</a>
	
</div>


</div>
</div>
</section>
    </div>