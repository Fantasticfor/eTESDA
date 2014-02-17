 <div class="container">
        
            <div class="row" style="padding-bottom:100px; ">
                 <ul class="breadcrumb">
  
   <li class="active"><a href ="<?php echo base_url().'syllabus/dispMods2/'.$courseN[0]['id']?>"><?php echo $courseN[0]['title']; ?></a><span class="divider">/</span></li>
   <li class="active"><a href ="<?php echo base_url().'syllabus/dispMods2/'.$courseN[0]['id']?>"><?php echo $moduleN[0]['title']; ?></a><span class="divider">/</span></li>
   <li class="active"><a href ="<?php echo base_url().'syllabus/dispMods2/'.$courseN[0]['id']?>"><?php echo $lessonN[0]['title']; ?></a></li>
              </ul>
                    <div class="span4">
                        <h4><?php echo $moduleTitle[0]['title']; ?> 
                        </h4>
                                        <div class="well sidebar-nav">
                                           
            <ul class="nav nav-list" id="myTab">
                 <input type="hidden" id="baseurl" value="<?php echo base_url()?>"/>
              <li class="nav-header"></li>
           <?php $topCount = 1; ?>
           <?php foreach($topicList as $tList): ?>
              <?php if($topCount == 1):?>
              {{if example:logged_in}}
              <span class="icon-ok-green" style="position:absolute; margin-left:-15px"></span>
              {{endif}}
              <li class="active"> <a class="topicLink " rel="<?php echo $tList['id']?>" href="#<?php echo $tList['id']?>" data-toggle="tab"> <?php echo $topCount.". "; ?><?php echo $tList['title']; ?> </a></li>
              
              <?php else: ?>
                {{if example:logged_in}}
                    <?php foreach ($finishedT as $ft):?>
                        <?php foreach($ft as $finishedTop): ?>
                            <?php if($finishedTop['topicID'] == $tList['id']):?>
                                <span class="icon-ok-green" style="position:absolute; margin-left:-15px"></span>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                 {{endif}}
                    <li ><a class="topicLink"  rel="<?php echo $tList['id']?>" href="#<?php echo $tList['id']?>" data-toggle="tab"> <?php echo $topCount.". "; ?><?php echo $tList['title']; ?> </a></li>
              <?php endif; ?>
              <?php $topCount+=1; ?>
           <?php endforeach; ?>
               
              
            </ul>
                                            
                                          
                                            
                                            
                                           
                                            
                                            
          </div><!--/.well -->
          
          
           <div class="row">
                {{if example:logged_in}}
                <?php if ($nextLes != $last): ?>
                <span class="pull-left">   <h5> <a href="<?php echo base_url().'syllabus/dispMods2/'.$modCourse; ?>"> Back to Module List </a></h5>
                                                </span>
                <span class="pull-right">   <h5> <a href="<?php echo base_url().'syllabus/displayTopic/'.$lesID['HeirarchyID']; ?>">Next Lesson </a></h5>
                                                </span>
                <?php else:?>
                <span class="pull-left">   <h5> <a href="<?php echo base_url().'syllabus/dispMods2/'.$modCourse; ?>">Back to Module List </a></h5>
                                                </span>
                <span class="pull-right">   <h5> <a href="<?php echo base_url().'test/generateSCTest/'.$lesMod; ?>">Take Self Check </a></h5>
                                                </span>
                 <?php endif; ?>   
                {{else}}
                <?php if ($nextLes != $last): ?>
                <span class="pull-left">   <h5> <a href="<?php echo base_url().'syllabus/dispMods2/'.$modCourse; ?>" > Back to Module List </a></h5>
                                                </span>
                <span class="pull-right">   <h5> <a  href="<?php echo base_url().'syllabus/displayTopic/'.$lesID['HeirarchyID']; ?>">Next Lesson </a></h5>
                                                </span>
                <?php else:?>
                <span class="pull-left">   <h5> <a href="<?php echo base_url().'syllabus/dispMods2/'.$modCourse; ?>">Back to Module List </a></h5>
                                                </span>
                 <span class="pull-right">   <h5> <a  href="#RegisterModal" data-toggle="modal" >Sign up now! </a></h5>
                                                </span>
                 <?php endif; ?>
                {{endif}}
           
                
                
            </div>
                    </div>                    
          
                
                <div class="span10 "  >
                   
                      <div class="well" >
                       
                            <!-- loop body here -->
                            <div class="row tab-content" id="myTabContentTopic" style="height:400px">
                            
                            <?php $count = 1; ?>
                            <?php foreach($content as $cont): ?>
                                <?php if($count == 1): ?>
                                    <div class="tab-pane fade active in"  id="<?php echo $cont[0]['id']; ?>">
                                    <div class="span4" style=" margin-left:10px; ">
                                        
                                        <p style="text-align:justify"><?php echo $cont[0]['textCont']; ?></p>
                                    
                                        </div>


                                    <div class="span4" style="margin-left:50px" >
                                        
                                        <div class="tab-content" id="<?php echo 'myTabContent'.$count; ?>" style="overflow:visible" >
                                        <?php $vidCount = 1; ?>
                                                <?php foreach($vLinks[$cont[0]['id']] as $vl): ?>
                                                  <?php foreach ($vl as $vls): ?>
                                            <?php if($vls['link'] != NULL):?>
                                            
                                                 <?php if($vidCount == 1):?>
                                                        <div  class="tab-pane fade active in " id="<?php echo 'part'.$count.$vidCount ?>">
                                                        <iframe class="depth" width="360" height="203" src="<?php echo $vls['link']; ?>" frameborder="0" 
                                                        allowfullscreen></iframe>
                                                        </div> 
                                                    <?php else: ?>
                                                        <div  class="tab-pane fade  " id="<?php echo 'part'.$count.$vidCount ?>">
                                                        <iframe class="depth" width="360" height="203" src="<?php echo $vls['link']; ?>" frameborder="0" 
                                                        allowfullscreen></iframe>

                                                        </div>
                                                    <?php endif; ?>
                                                    <?php $vidCount += 1;?>
                                            <?php else: ?>
                                            <?php echo Asset::img('dummy/SPECIALISTA.png', 'alt text' );?>
                                               <?php endif; ?>
                                                  <?php endforeach; ?>
                                                <?php endforeach; ?>
                 <div   class="btn-toolbar">
                 <div class="btn-group" id="<?php echo 'myTab'.$count ?>" class="pull-left">
                 <div class="btn-group" style="margin-top:-7px">
                     <?php $pCount = 1; ?>
                     <?php foreach($vLinks[$cont[0]['id']] as $vl): ?>
                                <?php foreach ($vl as $vls): ?>
                   <?php if($vls['link'] != NULL):?>
                     <a  class="pull-left btn" href="<?php echo '#part'.$count.$pCount;?> " data-toggle="tab"><?php echo $pCount; ?></a>
                      <?php $pCount += 1; ?>
            <?php else:?>
                     <?php endif ?>
                     <?php endforeach; ?>
                     <?php endforeach; ?>
               </div>
          
           
                      </div>
              </div>   
                                        </div>
                              
                                    </div>
                                    </div>
                                  <?php $count +=1 ;?>
                                <?php else: ?>
                                   <div class="tab-pane fade" id="<?php echo $cont[0]['id']; ?>">
                                    <div class="span4" style=" margin-left:10px; ">
                                        
                                        <p style="text-align:justify"><?php echo $cont[0]['textCont']; ?></p>
                                    
                                        </div>

                                    
                                    <div class="span4" style="margin-left:50px" >
                                     
                                     
                                        <div class="tab-content" id="<?php echo 'myTabContent'.$count; ?>" style="overflow:visible" >
                                        <?php $vidCount = 1; ?>
                                         
                                                <?php foreach($vLinks[$cont[0]['id']] as $vl): ?>
                                                  <?php foreach ($vl as $vls): ?>
                                              <?php if($vls['link'] != NULL):?>
                                           
                                                    <?php if($vidCount == 1):?>
                                                        <div  class="tab-pane fade active in " id="<?php echo 'part'.$count.$vidCount ?>">
                                                        <iframe class="depth" width="360" height="203" src="<?php echo $vls['link']; ?>" frameborder="0" 
                                                        allowfullscreen></iframe>
                                                        </div> 
                                                    <?php else: ?>
                                                        <div  class="tab-pane fade  " id="<?php echo 'part'.$count.$vidCount ?>">
                                                        <iframe class="depth" width="360" height="203" src="<?php echo $vls['link']; ?>" frameborder="0" 
                                                        allowfullscreen></iframe>

                                                        </div>
                                                    <?php endif; ?>
                                                    <?php $vidCount += 1;?>
                                             <?php else: ?>
                                            <?php echo Asset::img('dummy/SPECIALISTA.png', 'alt text' );?>
                                        <?php endif ?>
                                                  <?php endforeach; ?>
                                                <?php endforeach; ?>
                 <div   class="btn-toolbar">
                 <div class="btn-group" id="<?php echo 'myTab'.$count ?>" class="pull-left">
                 <div class="btn-group" style="margin-top:-7px">
                     <?php $pCount = 1; ?>
                     <?php foreach($vLinks[$cont[0]['id']] as $vl): ?>
                                <?php foreach ($vl as $vls): ?>
                      <?php if($vls['link'] != NULL):?>
                     <a  class="pull-left btn" href="<?php echo '#part'.$count.$pCount;?> " data-toggle="tab"><?php echo $pCount; ?></a>
                      <?php $pCount += 1; ?>
                  <?php else:?>
                     <?php endif; ?>
                     <?php endforeach; ?>
                     <?php endforeach; ?>
               </div>
          
           
                      </div>
              </div>   
                                        </div>
                            
                                    </div>
                                    </div>
                           
                            
                 

        <?php $count +=1 ;?>
                           <?php endif ?>   
                           <?php endforeach; ?>                     
                            
                        </div>    
                     


                           
                  
                        
                    </div>
                
                </div>
                
                
                              <!-- Sign up Modal -->
<div id="RegisterModal" class="modal modal-thin  hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Be a part of e-TESDA Learn! Join us now!</h3>
  </div>
  <div class="modal-body">
  
        <div class="alert">
            
            Already have an account? <a href=""> Sign in here</a>!
                
         </div>
       
       <div class="span3">
                                
                                     <div class="control-group ">
                                       
                                        <div class="controls">
                                              <?php
                                    echo form_open('learner/signup_validation');
                                    echo form_input(array(
                                       'name' => 'fname',
                                       'id' => 'fname',
                                       'value' => '',
                                        'placeholder' => 'First Name'
                                       )); 
                                    ?>   
                                            <br>
                                            <?php
                               
                                    echo form_input(array(
                                       'name' => 'mname',
                                       'id' => 'mname',
                                       'value' => '',
                                        'placeholder' => 'Middle Name'
                                       )); 
                     
                                    ?>
                                            <br>
                                            
                                           <?php
                                     echo form_input(array(
                                       'name' => 'lname',
                                       'id' => 'lname',
                                       'value' => '',
                                         'placeholder' => 'Last Name'
                                        
                                       )); 
                     
                                    ?>
                                        </div>
                                         
                                          <div class="controls">
                                                <?php
                                     echo form_input(array(
                                       'name' => 'email',
                                       'id' => 'email',
                                       'value' => '',
                                         'placeholder' => 'example@email.com'
                                       )); 
                     
                                    ?>

                                        </div>
                                         
                                          <div class="controls">
                                               <?php
                                     echo form_password(array(
                                       'name' => 'password',
                                       'id' => 'password',
                                       'value' => '',
                                         'placeholder' => '&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;'
                                       )); 
                     
                                    ?>


                                        </div>
                                         
                                          <div class="controls">
                                               <?php
                                     echo form_password(array(
                                       'name' => 'cpassword',
                                       'id' => 'cpassword',
                                       'value' => '',
                                         'placeholder' => '&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;'
                                       )); 
                     
                                    ?>


                                        </div>
                                         
                                           <div class="controls">
                                              <a class="btn btn-link" style="font-size:8pt; margin-left:-10px"> Terms and Condition</a>


                                        </div>
                                         
                                         <div class="controls">
                                              <?php
                                  
                                $data = array(
                                'name'        => 'signup_submit',
                                'class'       => 'btn btn-success',
                                  );
                                 echo form_submit($data,'Sign up!');
                                  echo form_close();
                                 ?>


                                        </div>
                                    </div>
 
                                
       </div>
       <div class="span1" style="width:3px;height:250px">
           <span class="" style="position:relative;top:40%; left:5px; "><strong>  OR </strong> </span>
      </div>
       <div class="span3" style="margin-left:55px"> 
           <div class="control-group">
           
               <div class="controls" style="margin-top: 95px">              
        <a href="<?php echo base_url()."learner/facebook_request" ?> "> 
         <?php echo Asset::img('fb_connect.png', 'alt text');?></a>
                   
                   </div>
           </div>
       </div>          
      
                              
                                

                   
                  
      
  </div>
 
</div><!--/span-->    
                                    
        
                                    
 
 
</div
          
                                    </div><!--/span-->         
          
          
                   

                
                
                    


                                    </div><!--/span-->

                                

                                           
<!--/row-->


                         