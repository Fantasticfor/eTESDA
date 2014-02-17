<body data-spy="scroll" data-target="#nav-test" data-offset="0" style="padding-top:-200px;">

<div class="container offset1"  >
            <div class="row" style="padding-bottom:100px; ">

                <div class="span12 " style="width:1100px">
                      <input type="hidden" id="baseurl" value="<?php echo base_url()?>"/>
                   <input type="hidden" id="stopwatch"/>
                        
                     <h3> <?php echo $module->title ?> </h3>
                     <h4><strong> Self Check Test </strong></h4>
                            <hr>
                    <?php $errors = validation_errors(); if( ! empty($errors)): ?>

                    <div class="alert alert-danger"><?php echo validation_errors(); ?></div>
                    
                    <?php endif; ?>
                    
                 <div class="span3" style="margin-left: -40px">
                    <div class="sticky-wrapper" id="sticker-sticky-wrapper"  >
                        <div id="sticker2" >
                    <div class="span3"> 
                         <div class="well sidebar-nav span4" id="nav-test" >
            <ul class="nav nav-list" >
                <?php $sectionC = 0; ?>
                <?php $questC = 1; ?>
                <li class="nav-header"> Section <?php echo $sectionC + 1 ?> </li>
                <?php $sectionC ++ ?>
                <?php foreach($questions[$sectionC] as $ques): ?>
                    <?php foreach($ques as $qu):?>
                <li  class="testnav"> <a href="<?php echo '#q'.$questC?>" > <strong><?php echo 'Q'.$questC ?> </strong></a></li>
                        <?php $questC ++; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
             
             
              
            </ul>
                             
          </div><!--/.well -->
                            
                    
                    </div>
</div>
                        </div>
                        </div>
                        
                    <div class="span9" style="margin-left:150px"  >
                        <?php echo form_open($this->uri->uri_string()) ?>
                         <?php echo form_hidden('aa','') ?>
                        <?php $count = 1; ?>
                        <?php $sectcount = 0 ?>
                        
                        <?php $qcount = 1; ?>
                  
                   <?php $sectcount++; ?>
                     
                       
                     <?php foreach($questions[$sectcount] as $ques): ?>
                       
                        <?php foreach($ques as $que): ?>
                    <div class="well well-small" id="<?php echo 'q'.$qcount?>" >
                    
  <ul class="media-list">
  <li class="media" >
    <div class="media-body">
      <h5  class="media-heading" >

          <?php echo "Question ".$qcount.": ".$que['prompt'] ?>
          <?php $qcount++; ?>
      </h5>
         <div class="media ">
           
           <?php if($que['testType'] == 1): ?>
             
             <?php foreach($answers->$que['prompt'] as $ans): ?>
            
               <ul class="lessons" >
                   <?php foreach($ans as $a): ?>
                   
                                    <li class="answer-unit" >
                                        
                                        
                             <?php if(array_key_exists('ans1',$_POST)): ?>
                                        <?php if(array_key_exists($count,$_POST['ans1'])): ?>
                                                <?php if($a == $_POST['ans1'][$count] && isset($_POST['ans1'][$count])): ?>
                                       
                                                        <?php $notify = array( 'type'=> 'radio', 'name' => 'ans'.$sectcount.'['.$count.']', 'value' => $a, 'checked'=>'checked');
                                                                 echo form_input($notify);?> 
                                                        <?php else: ?>

                                                        <?php $notify = array( 'type'=> 'radio', 'name' => 'ans'.$sectcount.'['.$count.']', 'value' => $a);
                                                              echo form_input($notify);?> 
                                        
                                                <?php endif; ?>
                                        <?php else: ?>
                                        
                                        <?php $notify = array( 'type'=> 'radio', 'name' => 'ans'.$sectcount.'['.$count.']', 'value' => $a);
                                                echo form_input($notify);?> 
                                        <?php endif ?>
                                        
                             <?php else: ?>
                                        
                                      
                                       <?php $notify = array( 'name' => 'ans'.$sectcount.'['.$count.']', 'value' => $a);
                                                echo form_radio($notify, set_radio('ans'.$sectcount.'['.$count.']', $a));?> 
                                       
                                        
                             <?php endif; ?>
                                      <?php echo $a ?>
                                        
                                          </li>
                                         
                                  <?php  endforeach; ?>
                                         
                                </ul>
             
             <?php $count += 1; ?>
             <?php endforeach; ?>
             <?php endif; ?>
             
             
             
             
             <?php if($que['testType'] == 2): ?>
             <?php $choice=1 ?>
             <?php foreach($answers->$que['prompt'] as $ans): ?>
               <ul class="lessons" >
                  
                   
                   <?php if(array_key_exists('ans1',$_POST)): ?>
                    
                            <?php if(array_key_exists($count,$_POST['ans1'])): ?>
                                    <?php echo $ans[0].'|'.$_POST['ans1'][$count] ?>
                                     <?php if( $_POST['ans1'][$count] == 'True'): ?>
                                       
                                          <li class="answer-unit" >
                                           <label class="radio"> 
                                          <?php $first= array('name'=>'ans'.$sectcount.'['.$count.']', 'type'=> 'radio', 'id' => 'ans1', 'value' => 'True', 'checked' => 'checked');
                                         echo form_input($first);?>  True</label>
                                          </li>
                                     <?php else: ?>
                                          <?php echo "aw1" ?>
                                         <li class="answer-unit" >
                                           <label class="radio"> 
                                          <?php $first= array('name'=>'ans'.$sectcount.'['.$count.']', 'type'=> 'radio', 'id' => 'ans1', 'value' => 'True');
                                         echo form_input($first);?>  True</label>
                                          </li>
                                     <?php endif; ?>
               
                                          
                                          
                                          
                                    <?php if($_POST['ans1'][$count] == 'False'): ?>
                                          <li class="answer-unit" >
                                         <?php echo "aw3" ?>    
                                        <label class="radio"> 
                                        <?php $second= array('name'=>'ans'.$sectcount.'['.$count.']', 'type'=> 'radio', 'id' => 'ans2', 'value' => 'False', 'checked' => 'checked');
                                                echo form_input($second);?>  False</label>
                                          </li>
                                     <?php else: ?>
                                         <li class="answer-unit" >
                                           <?php echo "aw4" ?>  
                                        <label class="radio">
                                       <?php $second= array('name'=>'ans'.$sectcount.'['.$count.']', 'type'=> 'radio', 'id' => 'ans2', 'value' => 'False');
                                                echo form_input($second);?>  False</label>
                                         </li>
                                     <?php endif; ?>
                                    
                   
                            <?php else: ?>
                   
                                <li class="answer-unit" >
                                       <label class="radio"> 
                                       <?php $first= array('name'=>'ans'.$sectcount.'['.$count.']', 'type'=> 'radio', 'id' => 'ans1', 'value' => 'True');
                                         echo form_input($first);?>  True</label>
					
                                        

                                          </li>
                                          
                                          
                                         <li class="answer-unit" >
                                             
                                        <label class="radio">
                                        <?php $second= array('name'=>'ans'.$sectcount.'['.$count.']', 'type'=> 'radio', 'id' => 'ans2', 'value' => 'False');
                                                echo form_input($second);?>  False</label>
                                       
                                          </li>
                   
                            <?php endif; ?>
                   
                   <?php else: ?>
                   
                                    <li class="answer-unit" >
                                       <label class="radio"> 
                                       <?php $first= array('name'=>'ans'.$sectcount.'['.$count.']', 'type'=> 'radio', 'id' => 'ans1', 'value' => 'True');
                                         echo form_input($first);?>  True</label>
					
                                        

                                          </li>
                                          
                                          
                                         <li class="answer-unit" >
                                             
                                        <label class="radio">
                                        <?php $second= array('name'=>'ans'.$sectcount.'['.$count.']', 'type'=> 'radio', 'id' => 'ans2', 'value' => 'False');
                                                echo form_input($second);?>  False</label>
                                       
                                          </li>
                                        
                           <?php endif; ?>
                                  
                                </ul>
              <?php $count += 1; ?>
             <?php endforeach; ?>
             <?php endif; ?>
             
             
             <?php if($que['testType'] == 3): ?>
             <?php $choice=1 ?>
             <?php foreach($answers->$que['prompt'] as $ans): ?>
               <ul class="lessons" >
                   <li class="answer-unit" >
                 
                      <?php if(array_key_exists('ans1',$_POST)): ?>
                      
                            <?php if(array_key_exists($count,$_POST['ans1'])): ?>
                              <?php $first= array('name'=>'ans'.$sectcount.'['.$count.']', 'type'=> 'text', 'id' => 'ans1');
                                             echo form_input($first, set_value('ans'.$sectcount.'['.$count.']', $_POST['ans1'][$count]));?> 
                           <?php else: ?>
                                <?php $first= array('name'=>'ans'.$sectcount.'['.$count.']', 'type'=> 'text', 'id' => 'ans1');
                                             echo form_input($first);?> 

                           <?php endif; ?>
                      <?php else: ?>
                   
                                    
                                        
                                       <?php $first= array('name'=>'ans'.$sectcount.'['.$count.']', 'type'=> 'text', 'id' => 'ans1');
                                         echo form_input($first);?> 
                       <?php endif; ?>
                   </li>
                                        
                                
                                </ul>
              <?php $count += 1; ?>
             <?php endforeach; ?>
             <?php endif; ?>
             
             
             
             
             
             
             
             
    
     </div>
    </div>
  </li>
                        </ul>
                    </div>
                        <?php endforeach; ?>
                        <?php endforeach; ?>
                        
                        

                             <div class="pull-right"> 
                                    <button  class="btn btn-primary"  style="margin-left: 30px" > I'm done answering!</button>
                                    </div>
                  
                                    </div><!--/span-->

                                   
                                  
</div>
                                    </div><!--/row-->


</div>
    </body>