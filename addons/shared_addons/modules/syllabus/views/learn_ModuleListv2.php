

<div class="container">
    
            <div class="row" style="padding-bottom:100px">
 <ul class="breadcrumb">
  
  <li ><a href="<?php echo base_url().'syllabus/displayCourses/'.$sectorID?>"> <?php echo $sectorName; ?> <span class="divider"></a>/</span></li>
   <li class="active"><a href="<?php echo base_url().'syllabus/dispMods2/'.$courses[0]['id']?>"><?php echo $courses[0]['title']; ?></a></li>
              </ul>
                <div class="span13">
             
                    
                        <?php if($lCourses == NULL): ?>
                            <div class="alert alert-info">
                        <strong> Heads up!</strong> You need to enroll first to take Self Checks and Online Assessment.  </div>
                        <?php else:?>
                            <?php if($this->session->userdata('fbuser') == 1):?>
                            <div class="alert alert-success">
                        <strong> You have successfully enrolled in this course!    <a href="<?php echo base_url().'syllabus/shareFB/'.$courses[0]['id']?>" class="btn btn-mini btn-primary"> Share in Facebook</a>
                            </strong></div>
                            <?php else:?>
                            <div class="alert alert-success">
                        <strong> You have successfully enrolled in this course!    <a onclick="alert('You must sign in with facebook to use this feature')" class="btn btn-mini btn-primary"> Share in Facebook</a>
                            </strong></div>
                            <?php endif ?>
                        <?php endif; ?>
                  
                        <div class="span6" style="margin-left:-10px;">
                          <div class="sticky-wrapper" id="sticker-sticky-wrapper"  >
                             <div id="sticker2" >
                                 <div class="well well-small span6">
                                     <h4><?php echo $courses[0]['title']; ?><div class="fb-like" data-href="http://www.youtube.com" data-layout="button_count" data-width="450" data-show-face="true" style="top:3px"></div></h4>                   
                                     

                                      <div class="tab-content" id="myTabContent" style="overflow:visible">
             <?php $count = 1; ?>
              <?php foreach($overviewVids as $OV): ?>
                <?php if ($count == 1):?>
              <div  class="tab-pane fade active in " id="<?php echo 'part'.$count ?>">
              <iframe class="depth" width="460" height="259" src="<?php echo $OV['link']; ?>" frameborder="0" 
          allowfullscreen></iframe>
                <?php else:?>
              <div  class="tab-pane fade " id="<?php echo 'part'.$count ?>">
              <iframe class="depth" width="460" height="259" src="<?php echo $OV['link']; ?>" frameborder="0" 
          allowfullscreen></iframe>
                <?php endif; ?>
              
              </div>
              <?php $count += 1;?>
              <?php endforeach; ?>
                                          
              <div style=" margin-top:-4px" class="btn-toolbar">
                  <div class="btn-group" id="myTab" class="pull-left">
                 <div class="btn-group">
                     <?php $pCount = 1; ?>
                     <?php foreach($overviewVids as $ovp): ?>
                     <a  class="pull-left btn" href="<?php echo '#part'.$pCount;?> " data-toggle="tab"><?php echo $pCount; ?></a>
                     <?php $pCount += 1; ?>
                     <?php endforeach; ?>
               </div>
                     
           
                      </div>
                 
                   {{if example:logged_in}}
                       
                        <?php if($passCount == $moduleCount && $lCourses != NULL): ?>
                            <a href='<?php echo base_url()."test/generateOATest/".$courses[0]['id'] ?>' class="btn btn-small btn-primary pull-right"> Take Online Assessment</a>
                        <?php elseif($lCourses == NULL): ?>
                            <a class="btn btn-small btn-primary pull-right" onclick="alert('Heads up! You need to enroll to be able to take the online assessment')"> Take Online Assessment</a>
                        <?php else:?>
                            <a class="btn btn-small btn-primary pull-right" onclick="alert('Heads up! You still need to pass all your selfchecks')"> Take Online Assessment</a>
                        <?php endif; ?>
                       {{endif}}
                    {{if example:logged_in}}
                        <?php if($lCourses != NULL): ?>
                            <a class="btn btn-small btn-success pull-right  disabled "> Enrolled</a>
                        <?php else: ?>
                            <a href ='<?php echo base_url()."syllabus/enroll/".$courses[0]['id'] ?>' class="btn btn-small btn-success pull-right"> Enroll</a>
                        <?php endif; ?>
                      
                     {{else}}
                     <a class="btn btn-small btn-success pull-right" href ="#RegisterModal"  data-toggle="modal"> Enroll</a>
                     {{endif}}
              </div>
            
              </div>
                                     
                                     <span><strong>Estimated Course Duration:</strong><em> <?php echo $courses[0]['duration']; ?> weeks </em> </span>
                                     <br>
                                     {{if example:logged_in}}
                                     <?php foreach($startLast as $sl): ?>
                                     <span><strong>Date Started:</strong><em><?php if($sl['dateStarted']!= ''):?> <?php echo format_date($sl['dateStarted']) ?><?php endif; ?></em></span>
                                     <br>
                                     <span><strong>Last Progress:</strong> <em><?php if($sl['last']!= ''):?><?php echo format_date($sl['last']) ?><?php endif; ?></em></span>
                                     <?php endforeach; ?>
                                     {{endif}}
                                     <hr style="margin-top:2px">
                                     
                                     
                                     <div class="comment more" >
                                         
                                         <?php echo $courses[0]['description']; ?> 
                                         </div>
                                    
                                     
                                 </div>   
                             </div>
                        
                            </div>
                          
                            </div>
                        
                        <div class="span8">
                            
                            <div class="well well-small" style=" margin-left:50px;height:auto">
                                
                                <h4> <?php echo Asset::img('glyphicons/glyphicons_114_list.png', 'alt text' );?>  Modules </h4>
                                  
                                <div class="accordion" id="accordion2" style="background-color:white;">
        <?php $count = 1; ?>
       <?php foreach ($modules as $module1): ?>
                    
       <?php foreach ($module1 as $module): ?>
      <div class="accordion-group">
    <div class="accordion-heading" >
      <div class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="<?php echo '#collapse'.$count?>">
          <h6 style="max-width:400px"> 
               <?php foreach ($compSC as $csc):?>
                            <?php foreach($csc as $comp): ?>
                                  <?php if($comp['moduleID'] == $module['id']): ?>
                                        <i class="icon-ok-green"></i>
                                  <?php endif; ?>      
                                       
                            <?php endforeach; ?> 
                        <?php endforeach; ?>
                                        <?php echo $module['title']?><?php if($module['status'] == 'draft'):?><?php echo ' (Draft)' ?><?php endif?>
                                      
          </h6>
      </div>
    </div>
            <div class="pull-right" style="margin-top: -40px;margin-right: 10px;">
              <?php if($this->session->userdata('userid')!= NULL):?>
             
                               <?php if($this->session->userdata('userid') != NULL && $lCourses != NULL):?>
                                   <?php if(empty($latestSC[$count-1])): ?>
                                           <?php if($module['status'] == 'draft'):?>
                                            <a onclick="alert('Sorry, contents of this module are current unavailable')" class="btn btn-primary btn-small pull-right"> Self-Check</a>
                                           <?php else:?>
                                        <a href="<?php echo base_url().'test/generateSCTest/'.$module['id']?>" class="btn btn-primary btn-small pull-right"> Self-Check</a>
                                            <?php endif ?>
                                            <?php else:?>
                                        <?php if($latestSC[$count-1][0]['remarks'] == 'Passed' && $latestSC[$count-1][0]['moduleID'] == $module['id']): ?>
                                            
                                        <?php if($module['status'] == 'draft'):?>
                                            <a onclick="alert('Sorry, contents of this module are current unavailable')" class="btn btn-success btn-small pull-right"> Self-Check</a>
                                           <?php else:?>
                                        <a href="<?php echo base_url().'test/generateSCTest/'.$module['id']?>" class="btn btn-success btn-small pull-right"> Self-Check</a>
                                            <?php endif ?>
                                            <?php elseif($latestSC[$count-1][0]['remarks'] == 'Failed'  && $latestSC[$count-1][0]['moduleID'] == $module['id']): ?>
                                        <?php if($module['status'] == 'draft'):?>
                                            <a onclick="alert('Sorry, contents of this module are current unavailable')" class="btn btn-danger btn-small pull-right"> Self-Check</a>
                                           <?php else:?>   
                                        
                                        <a href="<?php echo base_url().'test/generateSCTest/'.$module['id']?>" class="btn btn-danger btn-small pull-right"> Self-Check</a>
                                        <?php endif ?>
                                            <?php endif; ?>
                                   <?php endif; ?>
                               
                              <?php elseif($lCourses == NULL): ?>
                                        <a class="btn btn-primary btn-small " onclick="alert('You need to enroll to be able to take the self check')"> Self Check </a>
                              
                               <?php endif; ?>
               
               <?php else:?>
                          <a class="btn btn-primary btn-small " href ="#RegisterModal"  data-toggle="modal"> Self Check</a>
               <?php endif; ?>
          </div>
          <?php if($count == 1):?>
           <div id="<?php echo 'collapse'.$count ?>" class="accordion-body collapse in">
      <div class="accordion-inner">
      <ul style="list-style:none; margin-left:-5px" id="modules" >
           <?php foreach($lList[$module['id']] as $a): ?>
                    <?php foreach ($a as $b): ?>
                            <?php echo '<li >';?>
                        <?php foreach ($lesID as $a):?>
                            <?php foreach($a as $lID): ?>
                                  <?php if($lID['ID'] == $b['id']): ?>
                                        <i class="icon-ok-green"></i>
                                  <?php endif; ?>      
                                       
                            <?php endforeach; ?> 
                        <?php endforeach; ?> 
                            <?php if($module['status'] == 'draft'):?>
                                       <a onclick="alert('Sorry, contents of this module are current unavailable')" ><?php echo $b['title'] ?></a> 
                             <!-- <?php echo ' <span class=" label label-info pull-right" >'; ?> of topics </span> </li>  -->  
                                        <?php else:?>
                             <?php echo '  <a href='.base_url().'syllabus/displayTopic/'.$b['id'].'>'.$b['title'].'</a>';?> 
                             <!-- <?php echo ' <span class=" label label-info pull-right" >'; ?> of topics </span> </li>  -->             
                       <?php endif ?>
                                 <?php endforeach; ?> 
                    <?php endforeach; ?> 
              
             
          </ul>
      </div>
    </div>
          <?php else:?>
          <div id="<?php echo 'collapse'.$count ?>" class="accordion-body collapse ">
      <div class="accordion-inner">
      <ul style="list-style:none; margin-left:-5px" id="modules" >
           <?php foreach($lList[$module['id']] as $a): ?>
                    <?php foreach ($a as $b): ?>
                            <?php echo '<li >';?>
                        <?php foreach ($lesID as $a):?>
                            <?php foreach($a as $lID): ?>
                                  <?php if($lID['ID'] == $b['id']): ?>
                                        <i class="icon-ok-green"></i>
                                  <?php endif; ?>      
                                       
                            <?php endforeach; ?> 
                        <?php endforeach; ?> 
                             <?php echo '  <a href='.base_url().'syllabus/displayTopic/'.$b['id'].'>'.$b['title'].'</a>';?> 
                             <!-- <?php echo ' <span class=" label label-info pull-right" >'; ?> of topics </span> </li>  -->             
                       <?php endforeach; ?> 
                    <?php endforeach; ?> 
              
             
          </ul>
      </div>
    </div>
          <?php endif; ?>
   
          
                          
             
  </div>
         <?php $count += 1; ?>
                     <?php endforeach; ?>  
                    
         <?php endforeach; ?>               
                                   
</div>
                                
                
                        </div>
                
                               <div class="span4" style="margin-left:50px">
                                    
 <fb:comments href="http://example.com" width="550" num_posts="10"></fb:comments>
 </div>
                            
                    </div>
                         
                         
                       
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
 
</div>   
                      
             


                                   

                                  
</div>
                                    </div><!--/row-->


</div>
    
    <div id="modalEnrollBadge" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 id="myModalLabel">Congratulations You've Earned a Badge!</h4>
  </div>
  <div class="modal-body">
      
          <ul class="thumbnails">
  <li class="span4"  style="margin-left:120px">
      
    <div href="#" class="thumbnail">
      <img class="media-object" src="{{ url:site }}files/large/<?php echo $badgeImg;?>" alt="" data-src="holder.js/160x120" > 
        <h5 style="text-align:center"> <strong><?php echo $badgeName ?></strong></h5> 
    </div>
    
     
  </li>
  
</ul>
          
      
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
  </div>
</div>   
