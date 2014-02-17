<body data-spy="scroll"  data-target="#nav-test" data-offset="0" style="padding-top:-200px;" >
   

        
<div class="container offset1"  >
            <div class="row" style="padding-bottom:100px; ">

                <div class="span12" style="width:1100px">
                    
                        <div>
                     <h3> e-Career Profiling Test</h3>
                    <h5> Ability Test</h5>
                   <hr/>
                  
                    </div>
                    
                    <div class="span3" style="margin-left: -40px">
                    <div class="sticky-wrapper" id="sticker-sticky-wrapper"  >
                        <div id="sticker2" >
                    <div class="span3"> 
                
                        <div class="well sidebar-nav span4" id="nav-test" >
                            
            <ul class="nav nav-list"  >
                 <span class="label label-info" id="countdown">  -- : -- : --</span>
                 <?php $queNav = 1; ?>
                <li class="nav-header"> <?php echo $sections['sectionName'] ?> </li>
                <?php foreach ($questions as $qs):?>
                <li> <a href="<?php echo '#q'.$queNav.$sections['sectionName']; ?>"><?php echo 'Question '.$queNav ?></a></li>
                <?php $queNav ++ ?>
                    <?php endforeach ?>
           
             
             
              
            </ul>
                             
          </div><!--/.well -->
                         
                    
                    </div>
</div>
                        </div>
                        </div>
                        
                    <div class="span8" style="margin-left:150px"  >
                          <?php echo form_open('profiling/nextSection',array('id'=>'profilingSec')) ?>
                        <h3><?php echo $sections['sectionName'] ?></h3>
                        <h5> Instructions:</h5>
                        <p>
                          <?php echo $sections['instruction'] ?>
                            <br>
                           <a class="btn btn-success startTest"  style="margin-top:10px" > Start Test</a>
                        </p>
                        
                        <hr>
                        <div id="testItems" class="hide">
                   <?php $qcount = 1; ?>
                            <?php $sectcount = 1 ?>
                      <?php $count = 1; ?>      
                            <?php foreach($questions as $ques): ?>
                       
                       
                       
                    <div class="well " id="<?php echo 'q'.$qcount.$sections['sectionName']?>"  >
                    
  <ul class="media-list">
  <li class="media" >
    <div class="media-body">
      <h5  class="media-heading " >
          
   
   
          Question <?php echo $qcount ?>: <?php echo $ques['prompt'] ?>
           <?php $qcount++ ?>
      </h5>
         <div class="media ">
             <?php foreach($answers[$ques['prompt']] as $ans): ?>
               <ul class="lessons" >
                  
                   
                                    <li class="answer-unit" >
                                        
                                        
                                        
                                        <input name ="<?php echo 'ans'.$sectcount.'['.$count.']'?>" type="radio" value="<?php echo $ans?>" <?php echo set_radio('ans'.$sectcount.'['.$count.']',$ans) ?> >
                                          <?php echo $ans ?>
                                        
                                        
                                      
                                        
                                          </li>
                                                
                                
                                </ul>
                            
                              <?php endforeach; ?>   
                <?php $count++ ?>
                                </ul>
            
    
     </div>
          <?php endforeach;?>
    </div>
  </li>
                        </ul>
                           <button rel="2" class="btn btn-primary pull-right next"  style="margin-left: 30px" > Next</button>
                    </div>
                        
                        
                        
                   
                           
                        
                         
                            
                       

                         
                            
                  </div>
                        
                        
                       
                  
                     
                    
                    
   
                                    </div><!--/span-->

                                  
</div>
                
                                    </div><!--/row-->


</div>
    
                                  
    </body>
     