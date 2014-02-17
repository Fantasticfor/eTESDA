<div class="one_full">

    <section class="title blue"> <h4> <?php echo $item['item'][1] ?> </h4></section>
    <section class="item">

            <ul>
                <li>
                                   <label >Response<span></span></label>
                                    
                                        <div class="input">
                                        
				  <?php $ctr=1 ?>
                                            <?php foreach($item['item'][2] as $ans){
                                                    
                                                if($ans[1] == 'true')
                                                {
                                                
                                            $first= array('name'=>'isanswer', 'type'=> 'radio', 'id' => 'ans'.$ctr, 'value' => 'choice'.$ctr, 'checked' => 'checked', 'disabled'=>'disabled');
                                         echo form_input($first);
                                                
                                                }else{
                                                 $first= array('name'=>'isanswer', 'type'=> 'radio', 'id' => 'ans'.$ctr, 'value' => 'choice'.$ctr, 'disabled'=>'disabled');
                                         echo form_input($first);}
					
                                            $response1 = array('type'=>'text', 'id'=> 'choice'.$ctr, 'placeholder'=>'Response '.$ctr,'disabled'=>'disabled');
                                                echo form_input($response1,$ans[0]);
                                                $ctr++;
                                                echo "<br>";
                                            
                                             } ?>
                                            
                                  
                                
                                </div>
                                        </li>
                         
                        
                         
			</ul>
	

    </section>

 </div

 
 