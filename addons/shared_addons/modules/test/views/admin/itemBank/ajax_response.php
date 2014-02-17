
<?php if($itemtype==1||$itemtype==4||$itemtype==5): ?>
<fieldset>
                                        <legend> Response </legend>
                                     
                                    <div >
                                         <?php $first= array('name'=>'isanswer', 'type'=> 'radio', 'id' => 'ans1', 'value' => 'choice1','class'=>'res_radio');
                                         echo form_input($first);?> 
					
                                           <?php $response1 = array('type'=>'text', 'id'=> 'choice1', 'placeholder'=>'Response 1','class'=>'res_input');
                            echo form_input($response1);?>
                                        
                                        <br>
                                        
                                        <?php $second= array('name'=>'isanswer', 'type'=> 'radio', 'id' => 'ans2', 'value' => 'choice2', 'class'=>'res_radio');
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
<?php endif; ?>
<?php if($itemtype==2): ?>
<fieldset>
                                        <legend> Response </legend>
                                     
                                    <div >
                                        <?php $first= array('name'=>'isanswer', 'type'=> 'radio', 'id' => 'ans1', 'value' => 'choice1','class'=>'res_radio');
                                         echo form_input($first);?> 
					
                                         <label>True</label>
                                        
                                        <br>
                                        
                                        <?php $second= array('name'=>'isanswer', 'type'=> 'radio', 'id' => 'ans2', 'value' => 'choice2','class'=>'res_radio');
                                                echo form_input($second);?> 
                                        <label>False</label>

				</div>
                                        
                                        
                                    
                                        

</fieldset>

<?php endif; ?>
<?php if($itemtype==3): ?>
<fieldset>
                                        <legend> Response </legend>
                                     
                                    <div >
                                        <?php $first= array('name'=>'isanswer', 'type'=> 'text', 'id' => 'ianswer','class'=>'res_input');
                                         echo form_input($first);?> 
					
                                       

				</div>
                                        
                                        
                                    
                                        

</fieldset>

<?php endif; ?>



