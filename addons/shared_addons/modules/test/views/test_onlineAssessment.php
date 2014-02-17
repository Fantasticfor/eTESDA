<body data-spy="sc-test" data-target="#nav-test" data-offset="0" style="padding-top:-200px;" >
   

        
<div class="container offset1"  >
            <div class="row" style="padding-bottom:100px; ">

                <div class="span13" style="width:1100px" >
                   <input type="hidden" id="baseurl" value="<?php echo base_url()?>"/>
                   <input type="hidden" id="stopwatch"/>
                     
                     <h3> <?php echo $course->title ?></h3>
                    <h4> Online Assessment</h4>
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
                <?php $sectiC = 0; ?>
                <?php foreach($sections as $section): ?>
                <?php $queCount = 1; ?>
                <li class="nav-header"> Section <?php echo $sectiC + 1 ?> </li>
                 <?php $sectiC++; ?>
                <?php foreach($questions[$sectiC] as $ques): ?>
                       
                        <?php foreach($ques as $que): ?>
                <li  > <a href="<?php echo '#q'.$queCount.$sectiC?>" ><?php echo 'Question'.$queCount?></a></li>
                <?php $queCount += 1;?>
             <?php endforeach; ?>
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
                       
                        <?php $sectcount = 0 ?>
                        
                        <?php foreach($sections as $section): ?>
                         <?php $count = 1; ?>
                        <?php $qcount = 1; ?>
                   <h3>Section <?php echo $sectcount+1;  ?></h3>
                   <?php $sectcount++; ?>
                        <hr>
                       
                     <?php foreach($questions[$sectcount] as $ques): ?>
                       
                        <?php foreach($ques as $que): ?>
                    <div class="well well-small" id="<?php echo 'q'.$qcount.$sectcount?>" >
                    
  <ul class="media-list">
  <li class="media" >
    <div class="media-body">
      <h5  class="media-heading " >

          <?php echo "Question ".$qcount.": ".$que['prompt'] ?>
          <?php $qcount++; ?>
      </h5>
         <div class="media ">
           
           <?php if($que['testType'] == 1): ?>
             
             <?php foreach($answers->$que['prompt'] as $ans): ?>
            
               <ul class="lessons" >
                   <?php foreach($ans as $a): ?>
                   
                                    <li class="answer-unit" >
                                        
                                      
                                        
                                        <input name ="<?php echo 'ans'.$sectcount.'['.$count.']'?>" type="radio" value="<?php echo $a?>" <?php echo set_radio('ans'.$sectcount.'['.$count.']',$a) ?> >
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
                  
                   
                                    <li class="answer-unit" >
                                        
                                      <label class="radio">
					<input name ="<?php echo 'ans'.$sectcount.'['.$count.']'?>" type="radio" value="True" <?php echo set_radio('ans'.$sectcount.'['.$count.']',"True") ?> >
                                         True</label>

                                          </li>
                                          
                                          
                                         <li class="answer-unit" >
                                             
                                          <label class="radio">
                                      
                                             <input name ="<?php echo 'ans'.$sectcount.'['.$count.']'?>" type="radio" value="False" <?php echo set_radio('ans'.$sectcount.'['.$count.']',"False") ?> >
                                      False</label>
                                          </li>
                                        
                                         
                                  
                                </ul>
              <?php $count += 1; ?>
             <?php endforeach; ?>
             <?php endif; ?>
             
             
             <?php if($que['testType'] == 3): ?>
             <?php $choice=1 ?>
             <?php foreach($answers->$que['prompt'] as $ans): ?>
               <ul class="lessons" >
                   
                   
                                    <li class="answer-unit" >
                                        
                                       <?php $first= array('name'=>'ans'.$sectcount.'['.$count.']', 'type'=> 'text', 'id' => 'ans1');
                                         echo form_input($first, set_value('ans'.$sectcount.'['.$count.']'));?> 
					
                                        
                                
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
                        
                        

                            <hr>
                  <?php endforeach ?><!-- section -->
                  <div class="pull-right">
                 <button class="btn btn-primary " id="doneAns" style="margin-left: 30px" onclick="stopTime()" > I'm done answering!</button> 
                  </div>
                                    </div><!--/span-->
                                    <?php form_close(); ?>

                                  
</div>
                                    </div><!--/row-->


</div>
    
                                  
    </body>
     