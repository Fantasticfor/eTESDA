

    <div class="one_full">
 <ul id="breadcrumbs-one">
		<li><a href="<?php echo site_url('admin/profiling') ?>" >  Profiling Test Item Bank</a></li>
		<li><a href="<?php echo $this->uri->uri_string() ?>" class="current">Add Items to  <?php echo $name ?>'s Item Bank</a></li>
                
		
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

    
<?php echo form_open_multipart() ?>



	
<div class="form_inputs" >
		<fieldset>
			<ul>
                            <div class="one_full"> 
                                
                                  
                                        <legend > Add Items </legend>
                                        <br>
                                        <div class="one_full">
                                                                 
					<li>
                                            
					<label for="title">Prompt/Question <span>*</span> </label>
					<div class="input"><?php echo form_input(array('name'=>'input_question','class'=>'input_question')) ?></div>
				</li>
                         
                                 <li style="">
                                    
                                           <fieldset>
                                        <legend> Response</legend>
                                     
                                    <div >
                                         <?php $first= array('name'=>'isanswer', 'type'=> 'radio', 'id' => 'ans1', 'value' => 'choice1','class'=>'res_radio');
                                         echo form_input($first);?> 
					
                                           <?php $response1 = array('type'=>'text', 'id'=> 'choice1', 'placeholder'=>'Response 1','class'=>'res_input');
                            echo form_input($response1);?>
                                        
                                        <br>
                                        
                                        <?php $second= array('name'=>'isanswer', 'type'=> 'radio', 'id' => 'ans2', 'value' => 'choice2','class'=>'res_radio');
                                                echo form_input($second);?> 
					
                                           <?php $response2 = array('type'=>'text', 'id'=> 'choice2', 'placeholder'=>'Response 2','class'=>'res_input');
                            echo form_input($response2);?>
			
                                        <br>
                                        
                                         <?php $third= array('name'=>'isanswer', 'type'=> 'radio', 'id' => 'ans3', 'value' => 'choice3','class'=>'res_radio');
                                                echo form_input($third);?> 
					
                                           <?php $response3 = array('type'=>'text', 'id'=> 'choice3', 'placeholder'=>'Response 3','class'=>'res_input');
                            echo form_input($response3);?>
                                        <br>
                                        
                                         <?php $fourth= array('name'=>'isanswer', 'type'=> 'radio', 'id' => 'ans4', 'value' => 'choice4','class'=>'res_radio');
                                                echo form_input($fourth);?> 
					
                                           <?php $response4 = array('type'=>'text', 'id'=> 'choice4', 'placeholder'=>'Response 4','class'=>'res_input');
                            echo form_input($response4);?>
				</div>
                                        
                                        
                                    
                                        

                                        </fieldset>
                                        
                                      
                                    </li>
                                
                                 <a class="btn green" id="addAbilityItem"> Add Item</a>  
                                      
                                    </div>
                             
                                        
                                    
                                  

                         </div>   
                            <div class="one_full" >
                               
                             <table  id="item_table" class="tablesorter"  >
    <thead>
        <tr>
            
             
              <th>Prompt | Question</th>
              <th>  Item Type </th>
             <th></th>
    
        </tr>
    </thead>
    <tbody>
        <?php
  if(isset($_SESSION['aitems']) && is_array($_SESSION['aitems'])){
    foreach($_SESSION['aitems'] as $key=>$input){
?> 
        <tr>
           <td> <?php echo $input[1] ?></td> 
         
           <td>Multiple Choice</td>
           
            <td>
              <a class='btn btn-lesson blue ' id='viewRes' onclick='viewRes(<?php echo $key ?>)' >View Responses</a><a class='btn btn-lesson red' id='removeItemA'><i class='icon-remove'></i> Remove </a><input type='hidden' id='indexid' value="<?php echo $key ?>"/> </td> 
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
   <a class="btn blue" href="<?php echo site_url('admin/profiling/saveAbilityItems').'/'.$sectionid?>" > Save</a> <a href="<?php echo site_url('admin/profiling') ?>"class="btn gray">Cancel</a>
	
</div>


</div>
</div>
</section>
    </div>