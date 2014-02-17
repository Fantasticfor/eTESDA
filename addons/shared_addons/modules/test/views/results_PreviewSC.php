<body data-spy="scroll" data-target="#nav-test" data-offset="0" style="padding-top:-200px;">

<div class="container offset1"  >
            <div class="row" style="padding-bottom:100px; ">

                <div class="span13" style="width:1100px" >
                    <div class="span13">
                    <div  class="well well-small well-blue">
                     <h3> <?php echo $module->title ?></h3>
                    <h5> Self Check Test<h5>
                   
                  
                    </div>
                   
                          <?php if(($score/$total)*100 >= 60): ?>
                         <div class="alert alert-success">  <h4>Great job! You passed the Test! <a class="btn btn-success  btn-mini" href="<?php echo base_url().'syllabus/displayModules/'.$cID?>" > Next Module </a></h4> </div>
                         <?php else: ?>
                        <div class="alert alert-error">  <h4> Sorry, please review <a href="<?php echo base_url().'syllabus/displayModules/'.$cID?>" class="btn btn-mini btn-primary"> Review Module</a>
                             <a  class="btn btn-mini btn-primary" href="<?php echo base_url()."test/generateSCTest/".$module->id ?>"> Take Test Again</a> 
                            </h4></div>
                        <?php endif; ?>
                      
                        
                            <div class="span5" >
                             <h4><i class="icon-list-alt"></i> Results</h4>
                            <div class="span2 ">
                               <span class="label label-info" style="margin-left:10px"> Total Score:</span>
                            <h1> <?php echo $score ?>/<?php echo $total ?></h1>
                            </div>
                             <div class="span2">
                             
                                  
                             
                           
                        <ul class="thumbnails ">
                            <?php if($score/$total *100 >= 90):?>
                            <li class="span2" style=" width:128px ">
                        <div  class="thumbnail">
                     
                      <?php echo Asset::img('gold.png', 'alt text')?>
                      <h5 style="text-align:center">Gold badge earned!</h5>
                      
                      
                      <?php elseif($score/$total *100 >= 75 && $score/$total *100 < 90):?>
                      <?php echo Asset::img('silver.png', 'alt text'  );?>
                      <h5 style="text-align:center">Silver badge earned!</h5>
                      
                      
                      <?php elseif($score/$total *100 >= 60 && $score/$total *100 < 74):?>
                      <?php echo Asset::img('bronze.png', 'alt text'  );?>
                      <h5 style="text-align:center">Bronze badge earned!</h5>
               
                  </div> 
                            </li>
                            <?php endif; ?>
                            </ul>
                              
                        
                  
                      
                     
                       
                        
                       </div>
                       
                               <div class="span5">
              
              <?php if(($score/$total)*100 >= 60 && $this->session->userdata('fbuser') != 0): ?>
              
              <?php elseif(($score/$total)*100 >= 60 && $this->session->userdata('fbuser') == 0): ?>
              
              <?php endif; ?>        
              <?php if(($score/$total)*100 >= 60 && $moduleCount - $passCount == 1):?>
                       <div class="controls" style="margin-top:10px">
                            <a href='<?php echo base_url()."test/generateOATest/".$cID ?>' class="btn btn-primary" style="width:200px"> Take Online Assessment</a>
                            </div>
                       <div class="controls" style="margin-top:10px">
                            <a href='<?php echo base_url()."syllabus/index" ?>' class="btn btn-primary" style="width:200px"> Follow Other Courses</a>
                             </div>
              <?php endif; ?>
                            
                            
                           </div>
                             
                            </div>
                              
                           <div class="span7">
                            
                            <h4><i class=" icon-th-list"></i> Competencies Earned</h4>     
                          
                           <div class="media well well-small">
                <div class="media-body">
        <h5 class="media-heading"><?php echo $module->title ?> 
            <span class="label label-info"> <?php echo $score ?>/<?php echo $total ?></span> 
            
            <?php if(($score/$total)*100 >= 60): ?>
            <span class="pull-right text-success" > Competent</span></h5> 
            <?php else: ?>
                   <a href="#">  <span class="pull-right text-error" > Needs review</span> </a>        
            <?php endif ?>
            <div class="progress" style="height:15px">
  <div class="bar" style="width: <?php echo ($score/$total)*100 ?>%"></div>
</div>
                    </div>
                    </div>
                        
                         
                            
                        
                   </div>
                        
                        
                        
                        
                     </div>  
                    
                   
                    <div class="span13"> 
                        <hr>
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
                        <li  class="testnav"> <a href="<?php echo '#q'.$questC?>" ><?php echo 'Q'.$questC ?></a></li>
                        <?php $questC ++; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
             
              
            </ul>
                             
          </div><!--/.well -->
          
             
                    </div>
</div>
                        </div>
                        </div>
                    
                     <div class="span8" style="margin-left:150px" >
                        
                     
                      
                    <?php $count = 1; ?>
                        <?php $sectcount = 0 ?>
                        
                        <?php $qcount = 1; ?>
                   
                   <?php $sectcount++; ?>
                        
                    
<?php foreach($questions[$sectcount] as $ques): ?>
                       
                        <?php foreach($ques as $que): ?>
                    <div class="well" id="<?php echo 'q'.$qcount?>" >
                    
  <ul class="media-list">
  <li class="media" >
    <div class="media-body">
      <h5  class="media-heading gray" >

          <?php echo "Question ".$qcount.": ".$que['prompt'] ?>
           
          <?php $qcount++; ?>
      </h5>
         <div class="media ">
           
           <?php if($que['testType'] == 1): ?>
             
             <?php foreach($answers->$que['prompt'] as $ans): ?>
            
               <ul class="lessons" >
                   <?php foreach($ans as $key=>$a): ?>
                   
                                    <?php if($key == 0 && $a == $userans['ans1'][$count]):  ?>
                                   <li class="answer-unit correct">
                                       <i class="icon-ok-green" style="position: absolute; margin-left: -20px;margin-top: 2px;"></i> 
                                       <?php $notify = array( 'type'=> 'radio', 'name' => 'ans'.$sectcount.'['.$count.']', 'value' => $a, 'checked' => 'checked','disabled'=>'disabled');
                                                echo form_input($notify);?> 
                                        <?php echo $a ?>
                                    <?php  elseif($key == 0):?>
                                   <li class="answer-unit correct">
                                       
                                       <?php $notify = array( 'type'=> 'radio', 'name' => 'ans'.$sectcount.'['.$count.']', 'value' => $a,'disabled'=>'disabled');
                                                echo form_input($notify);?> 
                                        <?php echo $a ?>
                                   <?php  elseif($a == $userans['ans1'][$count] && $key != 0): ?>
                                   <li class="answer-unit wrong">
                                       <i class="icon-remove-red" style="position: absolute;margin-left: -20px;margin-top: 2px;"></i>
                                       <?php $notify = array( 'type'=> 'radio', 'name' => 'ans'.$sectcount.'['.$count.']', 'value' => $a, 'checked' => 'checked','disabled'=>'disabled');
                                                echo form_input($notify);?> 
                                        <?php echo $a ?>   
                                    <?php else: ?>
                                   <li class="answer-unit">    
                                           
                                       <?php $notify = array( 'type'=> 'radio', 'name' => 'ans'.$sectcount.'['.$count.']', 'value' => $a,'disabled'=>'disabled');
                                                echo form_input($notify);?> 
                                        <?php echo $a ?>

                                    <?php endif; ?>
                                     
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
                            
                             <?php  if($ans[0]== "True"):  ?>
                                    
                    <li class="answer-unit correct">
                            <?php if($ans[0] == "True" && $userans['ans1'][$count] == "True"): ?>
                      <i class="icon-ok-green" style="position: absolute;margin-left: -20px;margin-top: 2px;"></i> <label class="radio"> 
                          <?php $first= array('name'=>'ans'.$sectcount.'['.$count.']', 'type'=> 'radio', 'id' => 'ans1', 'value' => 'True', 'checked'=> 'checked','disabled'=>'disabled');
                                         echo form_input($first);?>  True</label>    
                      
                           <?php else: ?>
                       <label class="radio"> 
                          <?php $first= array('name'=>'ans'.$sectcount.'['.$count.']', 'type'=> 'radio', 'id' => 'ans1', 'value' => 'True','disabled'=>'disabled');
                                         echo form_input($first);?>  True</label>    
                      
                          <?php endif; ?>
                                       
                                       
                             <?php elseif($ans[0]== "False" && $userans['ans1'][$count] == "True"): ?>
                                  <li class="answer-unit wrong">
                                      <i class="icon-remove-red" style="position: absolute;margin-left: -15px;margin-top: 2px;"></i>
                                      <label class="radio"> 
                                       <?php $first= array('name'=>'ans'.$sectcount.'['.$count.']', 'type'=> 'radio', 'id' => 'ans1', 'value' => 'True', 'checked'=> 'checked','disabled'=>'disabled');
                                         echo form_input($first);?>  True</label>
                             <?php else: ?>
                                       
                                   <li class="answer-unit">    
                                       <label class="radio"> 
                                       <?php $first= array('name'=>'ans'.$sectcount.'['.$count.']', 'type'=> 'radio', 'id' => 'ans1', 'value' => 'True','disabled'=>'disabled');
                                         echo form_input($first);?>  True</label>
                             <?php endif; ?>
                                       
					
                                        

                                          </li>
                                          
                                    <?php  if($ans[0]== "False"):  ?>
                                    
                                   <li class="answer-unit correct">
                                        <?php if($ans[0] == "False" && $userans['ans1'][$count] == "False"): ?>
                      <i class="icon-ok-green" style="position: absolute;margin-left: -20px;margin-top: 2px;"></i> 
                                        <label class="radio"> 
                                            <?php $second= array('name'=>'ans'.$sectcount.'['.$count.']', 'type'=> 'radio', 'id' => 'ans2', 'value' => 'False', 'checked'=> 'checked', 'disabled'=>'disabled');
                                                echo form_input($second);?>  False</label>
                                        <?php else: ?>        
                                                 <label class="radio"> 
                                            <?php $second= array('name'=>'ans'.$sectcount.'['.$count.']', 'type'=> 'radio', 'id' => 'ans2', 'value' => 'False','disabled'=>'disabled');
                                                echo form_input($second);?>  False</label>  
                                                    <?php endif; ?>
                      
                      
                      
                             <?php elseif($ans[0]== "True" && $userans['ans1'][$count] == "False"): ?>
                                  <li class="answer-unit wrong">
                                        <i class="icon-remove-red" style="position: absolute;margin-left: -20px;margin-top: 2px;"></i>
                                      <label class="radio"> 
                                            <?php $second= array('name'=>'ans'.$sectcount.'['.$count.']', 'type'=> 'radio', 'id' => 'ans2', 'value' => 'False', 'checked'=> 'checked','disabled'=>'disabled');
                                                echo form_input($second);?>  False</label>
                             <?php else: ?>
                                       
                                   <li class="answer-unit">    
                                       <label class="radio"> 
                                            <?php $second= array('name'=>'ans'.$sectcount.'['.$count.']', 'type'=> 'radio', 'id' => 'ans2', 'value' => 'False','disabled'=>'disabled');
                                                echo form_input($second);?>  False</label>
                             <?php endif; ?>
                                      
                                          </li>
                                        
                                         
                                  
                                </ul>
              <?php $count += 1; ?>
             <?php endforeach; ?>
             <?php endif; ?>
             
             
             <?php if($que['testType'] == 3): ?>
             
             <?php foreach($answers->$que['prompt'] as $ans): ?>
           
               <ul class="lessons" >
                   
                            
                                    <li class="answer-unit" >
                                       
                                         <?php  if(strcasecmp($ans,$userans['ans1'][$count]) == 0):  ?>
                                     <i class="icon-ok-green" style="position: absolute;margin-left: -20px;margin-top: 2px;"></i> 
                                     <?php $first= array('name'=>'ans'.$sectcount.'['.$count.']', 'type'=> 'text', 'id' => 'ans1', 'value' => $userans['ans1'][$count], 'disabled' => 'disabled');
                                         echo form_input($first);?>
                                        <?php else: ?>
                                      <i class="icon-remove-red" style="position: absolute;margin-left: -20px;margin-top: 2px;"></i>
                                      <?php $first= array('name'=>'ans'.$sectcount.'['.$count.']', 'type'=> 'text', 'id' => 'ans1', 'value' => $userans['ans1'][$count], 'disabled' => 'disabled');
                                      echo form_input($first);?> <label class="text-warning"><?php echo $ans ?></label> 
                                        <?php endif;?>
                                     
                                        
                                
                                </ul>
              <?php $count+=1;; ?>
             <?php endforeach; ?>
             <?php endif; ?>
             
             
             
             
             
             
             
             
    
     </div>
    </div>
  </li>
                        </ul>
                     </div><!--/span-->
                        <?php endforeach; ?>
                        <?php endforeach; ?>                   
     

</div>
                                   
            </div>
                                  
</div>
                                    </div><!--/row-->
                                    </div><!--/row-->


</div>
    </body>