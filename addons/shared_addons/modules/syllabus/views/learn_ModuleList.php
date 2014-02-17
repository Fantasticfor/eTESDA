       

<div class="container">
        
            <div class="row" style="padding-bottom:100px">

                <div class="span13">
                    
              <ul class="breadcrumb">
  
  <li ><a href="<?php echo base_url().'syllabus/displayCourses/'.$sectorID?>"> <?php echo $sectorName; ?> <span class="divider"></a>/</span></li>
   <li class="active"><a href="<?php echo base_url().'syllabus/displayModules/'.$courses[0]['id']?>"><?php echo $courses[0]['title']; ?></a></li>
              </ul>
                    
                    <div class="span12">
                        
                        <div class="row">
                            
                    
                        <?php if($lCourses == NULL): ?>
                            <div class="alert alert-info">
                        <strong> Heads up!</strong> You need to enroll first to take Self Checks and Online Assessment.  </div>
                        <?php else:?>
                            <div class="alert alert-success">
                        <strong> You have successfully enrolled in this course!    <a href="<?php echo base_url().'syllabus/shareFB/'.$courses[0]['id']?>" class="btn btn-mini btn-primary"> Share in Facebook</a>
                            </strong></div>
                        <?php endif; ?>
              
                             <div id="myCarousel" class="carousel slide">
  <!-- Carousel items -->
  <div class="carousel-inner ">
      <div class="active item">
           
          <div class="span1" style="position:absolute; left:450px; top:30px; z-index: 500;">
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
                  </div>
                  
                  
              <div style="position:absolute; top:256px" class="btn-toolbar">
                  <div class="btn-group" id="myTab" class="pull-left">
                 <div class="btn-group" style="margin-bottom:-30px">
                     <?php $pCount = 1; ?>
                     <?php foreach($overviewVids as $ovp): ?>
                     <a  class="pull-left btn" href="<?php echo '#part'.$pCount;?> " data-toggle="tab">Part <?php echo $pCount; ?></a>
                     <?php $pCount += 1; ?>
                     <?php endforeach; ?>
               </div>
          
           
                      </div>
              </div>
            
              </div>
              
          <img class="media-object" src="{{ url:site }}files/large/<?php echo $courses[0]['image'];?>" alt="" > 
                      <div class="black-trans">
          <div class="carousel-caption2" style="margin-bottom:-120px">
                      <h3><?php echo $courses[0]['title']; ?>
                          <br>
                   {{if example:logged_in}}
                        <?php if($lCourses != NULL): ?>
                            <a class="btn btn-success  disabled "> Enrolled</a>
                        <?php else: ?>
                            <a href ='<?php echo base_url()."syllabus/enroll/".$courses[0]['id'] ?>' class="btn btn-success  "> Enroll</a>
                        <?php endif; ?>
                      
                     {{else}}
                     <a class="btn btn-success " href ="#RegisterModal"  data-toggle="modal"> Enroll</a>
                     {{endif}}
                     
                        </h3>
                    <p> <?php echo $courses[0]['description']; ?>
                    </p>
                       {{if example:logged_in}}
                       
                        <?php if($passCount == $moduleCount && $lCourses != NULL): ?>
                            <a href='<?php echo base_url()."test/generateOATest/".$courses[0]['id'] ?>' class="btn btn-primary"> Take Online Assessment</a>
                        <?php elseif($lCourses == NULL): ?>
                            <a class="btn btn-primary" onclick="alert('Heads up! You need to enroll to be able to take the online assessment')"> Take Online Assessment</a>
                        <?php else:?>
                            <a class="btn btn-primary" onclick="alert('Heads up! You still need to pass all your selfchecks')"> Take Online Assessment</a>
                        <?php endif; ?>
                       {{endif}}
                       <br>
                       <br>
                       <div class="fb-like" data-href="http://www.youtube.com" data-layout="button_count" data-width="450" data-show-face="true"></div>
          </div>
              </div>
      </div>
    
  </div>
  <!-- Carousel nav -->
 
</div>
                    
                  </div>

                   
                        </div>
                    
                    
                    <div class="span12">
                                        <div class="row">
                                    <div class="span8">
                                        <div class="row">
     <?php $count = 1; ?>
       <?php foreach ($modules as $module1): ?>
                    
       <?php foreach ($module1 as $module): ?>     
                    <div class="well">
                    
  <ul class="media-list">
  <li class="media">
    <div class="media-body">
      <h5 class="media-heading gray">
          <?php foreach ($compSC as $csc):?>
                            <?php foreach($csc as $comp): ?>
                                  <?php if($comp['moduleID'] == $module['id']): ?>
                                        <i class="icon-ok-green"></i>
                                  <?php endif; ?>      
                                       
                            <?php endforeach; ?> 
                        <?php endforeach; ?>
          <strong>Module <?php echo $count?>: </strong><a><?php echo $module['title']?></a>
      </h5>

         <div class="media ">
          
               <ul class="lessons" >
                   <?php foreach($lList->$module['title'] as $a): ?>
                    <?php foreach ($a as $b): ?>
                            <?php echo '<li class="lesson-unit">';?>
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
                     <?php echo '<li class="lesson-unit">';?>            
                       <?php foreach ($compSC as $csc):?>
                            <?php foreach($csc as $comp): ?>
                                  <?php if($comp['moduleID'] == $module['id']): ?>
                                        <i class="icon-ok-green"></i>
                                  <?php endif; ?>      
                                       
                            <?php endforeach; ?> 
                        <?php endforeach; ?>
                                        
                               <?php if($this->session->userdata('userid') != NULL && $lCourses != NULL):?>
                                        <?php echo '  <a href='.base_url().'test/generateSCTest/'.$module['id'].'>'.'Self Check'.'</a>';?>
                               <?php elseif($this->session->userdata('userid') == NULL):?>
                                        <a href ="#RegisterModal"  data-toggle="modal"> Self Check</a>
                               <?php elseif($lCourses == NULL): ?>
                                        <a onclick="alert('You need to enroll to be able to take the self check')"> Self Check </a>
                               <?php elseif($this->session->userdata('userid')  != NULL): ?>
                                        <a onclick="alert('You need to enroll to be able to take the self check')"> Self Check</a>
                               <?php endif; ?>
                                </ul>
       
             
             
             
    
     </div>
    </div>
  </li>
                        </ul>
                    </div>
                                            <?php $count += 1; ?>
                     <?php endforeach; ?>  
                    
         <?php endforeach; ?>
                                            </div>
                                    </div>
                                          
                                          
                                    
                                       <div class="span3 well" style="width: 255px; ">
                     <div class="row">
                         <span class=" label label-info" style="width:287px; font-size:12pt;padding:5px"> What you are about to learn!</span>
                               
                                <ul style="margin-left:35px">
                                    <?php foreach($cDetails as $det): ?>
                                    <li><?php echo $det['Objective']; ?></li> 
                                    <?php endforeach; ?>
                                    
                                </ul>
                            
                        
                            <span class="label label-info" style="width:287px; font-size:12pt;padding:5px"> Great Job Opportunities! </span>
                                
                                <ul style="margin-left:35px">
                                    <?php foreach($cObjectives as $obj): ?>
                                    <li> <strong><?php echo 'Opportunity: '.$obj['opportunity'].'  Salary: '.$obj['salary']; ?></strong></li> 
                                    <?php endforeach; ?>
                                    
                                    
                                </ul>
                            
                         </div>
                        </div>
                                            </div>
                                        <fb:comments href="http://example.com" width="470" num_posts="10"></fb:comments>
                                        </div>
                        
</div>
                
               
                
                                    </div><!--/row-->

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