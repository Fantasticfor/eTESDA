<body data-spy="scroll"  data-target="#nav-test" data-offset="0" style="padding-top:-200px;" >
   

        
<div class="container offset1"  >
            <div class="row" style="padding-bottom:100px; ">

                <div class="span12" style="width:1100px">
                   
                        
                     <h3> e-Career Profiling Test</h3>
                    <h4> Interest Test</h4>
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
                 <?php $secNav = 1; ?>
                
                <?php foreach($sections as $sc):?>
                <?php $queNav = 1; ?>
                <li class="nav-header " > <?php echo 'Section '.$secNav ?> </li>
                <?php foreach($questions[$secNav] as $qs):?>
                <li > <a href="<?php echo '#q'.$queNav.$secNav?>" ><?php echo 'Question '.$queNav ?></a></li>
                <?php $queNav ++; ?>
               <?php endforeach ?>
                <?php $secNav ++; ?>
             <?php               endforeach; ?>
             
              
            </ul>
                             
          </div><!--/.well -->
                            
                    
                    </div>
</div>
                        </div>
                        </div>
                        
                    <div class="span9" style="margin-left:150px"  >
                        <?php echo form_open($this->uri->uri_string()) ?>
                          <?php $sectcount = 1 ?>
                        
                        <?php foreach($sections as $section): ?>
                             <?php $count = 1; ?>
                            <?php $qcount = 1; ?>
                   <h3>Section <?php echo $sectcount ?></h3>
                   
                     <?php foreach($questions[$sectcount] as $ques): ?>
                  
                       
                   <hr style="margin-top:5px">
                       
                    <div class="well well-small" id="<?php echo 'q'.$qcount.$sectcount?>">
                        <ul class="media-list">
                                    <li class="media" >
                                        <div class="media-body">
                                             <h5  class="media-heading" >  <?php echo "Question ".$qcount.": ".$ques['prompt'] ?></h5>
                                               <?php $qcount++; ?>
                                  <div class="media">
                            <ul class="lessons" >
                                     <?php $choice=1 ?>
             
                <?php foreach($answers[$ques['prompt']] as $ans): ?>
               <ul class="lessons" >
                  
                   
                                    <li class="lesson-unit" >
                                        
                                       <label class="radio">
					<input name ="<?php echo 'ans'.$sectcount.'['.$count.']'?>" type="radio" value="Agree" <?php echo set_radio('ans'.$sectcount.'['.$count.']',"Agree") ?> >
                                        Agree</label>

                                          </li>
                                          
                                          
                                         <li class="lesson-unit" >
                                             
                                        
                                     <label class="radio">
                                             <input name ="<?php echo 'ans'.$sectcount.'['.$count.']'?>" type="radio" value="Disagree" <?php echo set_radio('ans'.$sectcount.'['.$count.']',"Disagree") ?> >
                                        Disagree</label>
                                          </li>
                                        
                                         
                                  
                                </ul>
              <?php $count += 1; ?>
             <?php endforeach; ?>
                                  
                                </ul>
    
     </div>
    </div>
  </li>
                        </ul>
                    </div>
                      
                        
                        
                        
                 
                  
                     
                        <?php endforeach; ?>
                    
                   <hr>   <?php $sectcount++; ?>
                   <?php endforeach; ?>
                                    </div><!--/span-->
<button class="btn btn-primary pull-right" style="margin-left: 30px" id="doneAns" > I'm done answering!</button>
                                  
</div>
                                    </div><!--/row-->


</div>
    
                                  
    </body>
     