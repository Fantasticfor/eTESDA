<div class="one_full">

    <section class="title blue"> <h4> <?php echo $item['item'][0] ?> </h4></section>
    <section class="item">
       
            <ul>
                <li>
                 <script src="http://localhost/eTESDA/addons/shared_addons/modules/test/js/viewResponse.js"></script>
                <input type="hidden" id="arrayIndex" value="<?php echo $index ?>"/>
             <input type="hidden" id="testType" value="<?php echo $type ?>"/>
             <input type="hidden" id="update" value="<?php echo site_url('admin/test/updateItems')?>">
                                   <label >Response<span></span></label>
       <?php if($item['item'][1] == 1): ?>   
                                        <div class="input">
                                                
                                            <?php $ctr=1 ?>
                                            <?php foreach($item['item'][6] as $ans){
                                                    
                                                if($ans[1] == 'true')
                                                {
                                                
                                            $first= array('name'=>'isanswer', 'type'=> 'radio', 'id' => 'ans'.$ctr, 'value' => 'choice'.$ctr, 'checked' => 'checked');
                                         echo form_input($first);
                                                
                                                }else{
                                                 $first= array('name'=>'isanswer', 'type'=> 'radio', 'id' => 'ans'.$ctr, 'value' => 'choice'.$ctr);
                                         echo form_input($first);}
					
                                            $response1 = array('type'=>'text', 'id'=> 'choice'.$ctr, 'placeholder'=>'Response '.$ctr);
                                                echo form_input($response1,$ans[0]);
                                                $ctr++;
                                                echo "<br>";
                                            
                                             } ?>
                                            
                                  
                                
                                      
                                        </div>
   <?php elseif($item['item'][1] == 2): ?>   
                                        <div class="input">
                                           
                                            <?php if($item['item'][6][0][1] == 'true')
                                                {   
                                        $first= array('name'=>'isanswer', 'type'=> 'radio', 'id' => 'ans1', 'value' => 'choice1', 'checked' => 'checked');
                                         echo form_input($first);
					}  else {
                                            $first= array('name'=>'isanswer', 'type'=> 'radio', 'id' => 'ans1', 'value' => 'choice1');
                                         echo form_input($first);
                                        
                                            
                                        } ?>
                                         <label>True</label>
                                        
                                        <br>
                                          <?php if($item['item'][6][1][1] == 'true')
                                                {   
                                        $second= array('name'=>'isanswer', 'type'=> 'radio', 'id' => 'ans2', 'value' => 'choice2','checked' => 'checked');
                                                echo form_input($second);
                                                }else{
                                                     $second= array('name'=>'isanswer', 'type'=> 'radio', 'id' => 'ans2', 'value' => 'choice2');
                                                echo form_input($second);
                                                } ?>
                                                
                                        <label>False</label>

                                            
                                  
                                
                                      
                                        </div>                                
    
    <?php elseif($item['item'][1] == 3): ?>   
                                        <div class="input">
                                           
                                         
                                        <?php       
                                        
					echo form_input('isanswer',$item['item'][6][0][0]);
                                            ?>
                                        
                                        
                                            
                                  
                                
                                      
                                        </div>
                                   
                                  
                                      
                                        </div>
    <?php endif ?>                             
                                        </li>
                         
                        
                         
			</ul>
	

    </section>
      
 </div
 <div class="buttons">
     <button class="btn blue" id="saveButton" >Save </button>
	
</div>
 
 