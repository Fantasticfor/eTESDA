<body data-spy="sc-test" data-target="#nav-test" data-offset="0" style="padding-top:-200px;" >
   

        
<div class="container offset1"  >
            <div class="row" style="padding-bottom:100px; ">

                <div class="span12 ">
                   <input type="hidden" id="baseurl" value="<?php echo base_url()?>"/>
                   <input type="hidden" id="stopwatch"/>
                        <div  class="well well-small well-blue">
                     <h3> <?php echo $course->title ?></h3>
                    <h5> Online Assessment<h5>
                   
                  
                    </div>
                    
                    <div class="span3" style="margin-left: -40px">
                    <div class="sticky-wrapper" id="sticker-sticky-wrapper"  >
                        <div id="sticker2" >
                    <div class="span3"> 
                         <div class="well sidebar-nav span4" id="nav-test" >
            <ul class="nav nav-list" >
                <li class="nav-header"> Section I </li>
                <li  class="testnav"> <a href="#q1" >Q1</a></li>
                <li class="testnav"><a href="#q2">Q2</a></li>
              <li class="testnav"><a href="#q3">Q3</a></li>
              <li class="testnav"><a href="#q4">Q4</a></li>
              <li class="testnav"><a href="#q5">Q5</a></li>
              <li class="testnav"><a href="#q6">Q6</a></li>
             
             
              
            </ul>
                            
          </div><!--/.well -->
                            
                    
                    </div>
</div>
                        </div>
                        </div>
                    
                    <div class="span7 offset1" style="margin-left:150px"  >
                         <?php echo form_open('test/results') ?>
                        <?php $count = 1; ?>
                        <?php $sectcount = 0 ?>
                        <?php foreach($sections as $section): ?>
                        <?php $qcount = 1; ?>
                   <h3>Section <?php echo $sectcount+1;  ?></h3>
                   <?php $sectcount++; ?>
                        <hr>
                       
                     <?php foreach($questions[$sectcount] as $ques): ?>
                       
                        <?php foreach($ques as $que): ?>
                    <div class="well" id="q1" >
                    
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
                   <?php foreach($ans as $a): ?>
                   
                                    <li class="lesson-unit" >
                                        
                                       <?php $notify = array( 'type'=> 'radio', 'name' => 'ans'.$sectcount.'['.$count.']', 'value' => $a);
                                                echo form_input($notify);?> 
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
                  
                   
                                    <li class="lesson-unit" >
                                        
                                       <?php $first= array('name'=>'ans'.$sectcount.'['.$count.']', 'type'=> 'radio', 'id' => 'ans1', 'value' => 'True');
                                         echo form_input($first);?> 
					
                                         <label>True</label>

                                          </li>
                                          
                                          
                                         <li class="lesson-unit" >
                                             
                                        
                                        <?php $second= array('name'=>'ans'.$sectcount.'['.$count.']', 'type'=> 'radio', 'id' => 'ans2', 'value' => 'False');
                                                echo form_input($second);?> 
                                        <label>False</label>
                                          </li>
                                        
                                         
                                  
                                </ul>
              <?php $count += 1; ?>
             <?php endforeach; ?>
             <?php endif; ?>
             
             
             <?php if($que['testType'] == 3): ?>
             <?php $choice=1 ?>
             <?php foreach($answers->$que['prompt'] as $ans): ?>
               <ul class="lessons" >
                   
                   
                                    <li class="lesson-unit" >
                                        
                                       <?php $first= array('name'=>'ans'.$sectcount.'[]', 'type'=> 'text', 'id' => 'ans1');
                                         echo form_input($first);?> 
					
                                        
                                
                                </ul>
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
                 
                  </div>
                                    </div><!--/span-->
                                    <?php form_close(); ?>

                                  
</div>
                                    </div><!--/row-->


</div>
    
                                  
    </body>
     