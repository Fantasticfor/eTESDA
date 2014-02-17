


<div class="container" style="padding-bottom: 100px">
    <?php if(empty($profArr)):?>
  <div class="alert alert-warning"> Know more about yourself, take the e-Profiling Test <a href="<?php echo base_url()."profiling/viewProf"?>"> here!</a> </div>
  <?php endif; ?>  
  <div class="well well-small" style="margin-bottom: -10px"> 
       <i class=" icon-user"></i><?php foreach ($userInfo as $ui):?> <a><?php echo $ui['firstname'];?> <?php echo $ui['lastname']; ?></a>  <?php endforeach; ?>  <a class="btn btn-small btn-primary" href="{{ url:site uri="syllabus/editProfile" }}"> Edit Profile</a>
    </div>
    <br>
<div class="row">

    <div class="span13">
     <ul class="nav nav-tabs" id="myTab">
  <li class="active" >
  <!--  <a href="{{url:site}}" data-toggle="tab" >Ongoing Courses </a>-->
  <a href="#ongoing" data-toggle="tab"> <i class="icon-book"> </i> My Dashboard </a> 
  </li>
  <li>
      <a href="#finished" data-toggle="tab"><i class="icon-tasks"> </i>  My Progress</a>  
  </li>
  <li >
      <a href="#badges" data-toggle="tab"> <i class="icon-asterisk"> </i> My Badges </a>  
  </li>
 
              </ul> 
    
         <div class=" span13 tab-content" id="myTabContent">
        <div class="tab-pane fade active in" id="ongoing">
            <div class="span12"></div>
            <div class="span9" style="margin-left:-10px">
        <div class="well well-small span8">
            
       <h4><?php echo Asset::img('glyphicons/glyphicons_351_book_open.png', 'alt text' );?> Ongoing Courses</h4>
       
         <div class="row " style="margin-left:10px;">
            <?php $count = 1; ?>
        <?php if(empty($courseDet)): ?>
             
             <div class="alert alert-info"> Still don't have course yet? <a class="btn btn-primary btn-mini" href="<?php echo base_url()."syllabus/index"?>">  Browse our courses! </a></div>
             
             <?php else: ?>
               <?php $mCount = 0 ?>
             <?php $popC = 0; ?>
      <?php foreach($courseDet as $cd): ?> 
             
             <div class="accordion" id="<?php echo 'c_accordion'.$count?>" style="background-color:white;">
  <div class="accordion-group">
    <div class="accordion-heading">
        <em class="indemandCourse" style="background:gray">Course <?php echo $count ?></em>
      <a class="accordion-toggle" data-toggle="collapse" data-parent="<?php echo '#c_accordion'.$count?>" href="<?php echo '#collapse'.$count?>"> </a>
      
      <div style="padding-left:30px">
          <?php if($cd[0]['status'] == 'draft'):?>
            <h5> <a onclick="alert('Sorry, this course is currently unavailable')"> <?php echo $cd[0]['title'].' (Drafted)'; ?> </a>
          <?php else:?>
            <h5> <a href="<?php echo base_url().'syllabus/dispMods2/'.$cd[0]['ID'] ?>"> <?php echo $cd[0]['title']; ?> </a> 
          <?php endif ?>
              <span class="label label-info">Started <?php foreach($dateStarted->$cd[0]['title'] as $ds): ?>
                  <?php echo format_date($ds) ?>
              <?php endforeach; ?></span>
               
                </h5> 
          <div style="margin-top:-15px;">
              <?php date_default_timezone_set('Hongkong'); ?>
              <?php $dateNow2 = new DateTime(date("Y-m-d H:i:s")) ?>
          <em><small>Last Progress: 
                  <?php foreach($lastP2->$cd[0]['title'] as $lp):?>
                  <?php if($lp != ''): ?>
                  <?php $dateDone2 = new DateTime($lp); ?>
                  <?php if($dateNow2->diff($dateDone2)->format("%m") > 0): ?>
                        <?php if($dateNow2->diff($dateDone2)->format("%m") == 1 || $dateNow2->diff($dateDone2)->format("%m") == 0): ?> 
                            <?php echo $dateNow2->diff($dateDone2)->format("%m").' month ago' ?>
                        <?php else: ?>
                            <?php echo $dateNow2->diff($dateDone2)->format("%m").' months ago' ?>
                        <?php endif; ?>
                  <?php elseif($dateNow2->diff($dateDone2)->format("%d") == 0 && $dateNow2->diff($dateDone2)->format("%H") == 0):?>     
                        <?php if($dateNow2->diff($dateDone2)->format("%i") == 1 || $dateNow2->diff($dateDone2)->format("%i") == 0): ?> 
                            <?php echo $dateNow2->diff($dateDone2)->format("%i").' minute ago' ?>
                        <?php else: ?>
                            <?php echo $dateNow2->diff($dateDone2)->format("%i").' minutes ago' ?>
                        <?php endif; ?>
                   <?php elseif($dateNow2->diff($dateDone2)->format("%H") >= 1 && $dateNow2->diff($dateDone2)->format("%i") >= 0 && $dateNow2->diff($dateDone2)->format("%d") == 0):?>
                        <?php if($dateNow2->diff($dateDone2)->format("%H") == 1): ?>  
                            <?php echo $dateNow2->diff($dateDone2)->format("%H").' hour ago' ?>
                        <?php else: ?>
                            <?php echo $dateNow2->diff($dateDone2)->format("%H").' hours ago' ?>
                        <?php endif ?>
                   <?php elseif($dateNow2->diff($dateDone2)->format("%d") >= 0): ?>
                        <?php if($dateNow2->diff($dateDone2)->format("%d") == 1): ?>  
                            <?php echo $dateNow2->diff($dateDone2)->format("%d").' day ago' ?>
                        <?php else: ?>
                            <?php echo $dateNow2->diff($dateDone2)->format("%d").' days ago' ?>
                        <?php endif; ?>
                   <?php endif;?>
                  <?php endif ?>
                  <?php endforeach; ?>
                  </small> </em>
          
          </div>
        
                   
                   <div class="progress" style=" height:15px; margin-left: 8px; margin-right: 50px; margin-top:10px;"> 
  
             <?php $barWidth = 99/($modCount[$count - 1] + 1); ?>
                       <?php $i = 1; ?>
                       <?php $OA = $cd[0]['title'].' Online Assessment'; ?>
                 <?php foreach($modTitles[$cd[0]['ID']] as $a): ?>
                 <?php foreach ($a as $mID): ?>  
                      
                       <?php if($i <= $finishedM[$count - 1]): ?>
                         <?php echo '<div class="bar bar-success" style="width:'.$barWidth.'%;  margin-left:1px"></div>'; ?> 
                       <?php else: ?>
                         <?php echo '<div class="bar-gray" style="width:'.$barWidth.'%;  margin-left:1px"></div>'; ?>
                       <?php endif; ?>
                       
                       <?php $i += 1; ?>
                       
            <?php endforeach; ?>
        <?php endforeach; ?>
                <?php echo '<div class="bar-gray" style="width:'.$barWidth.'%;  margin-left:1px"></div>'; ?>
                   
   
</div>
         </div>          
             
             
     
    </div>
     <?php $alertMes = 'Sorry, contents of this course is currently unavailable'; ?>
    <div id="<?php echo 'collapse'.$count ?>" class="accordion-body collapse in">
      <div class="accordion-inner">
                    <div style="margin-bottom:4px;margin-left: 25px">
                        <h6><span class="label label-info">  What's next for you!</span></h6>
                      </div>
            
          <ul style="list-style:none" id="modules">
            
              <?php foreach($modTitles[$cd[0]['ID']] as $a): ?>
                
                 <?php foreach ($a as $mTitle): ?>   
                 
          
                 <?php echo '<li class="lesson-unit" >';?>
               
              <?php foreach($fModuleIDs as $fmID): ?>
             <?php foreach ($fmID as $fmIDs): ?>

              <?php if($fmIDs['ID'] == $mTitle['id']): ?>
              <i class="icon-ok-green"></i>
                <?php endif; ?>
             <?php endforeach; ?> 
          <?php endforeach; ?>   
                            <?php if($cd[0]['status'] == 'draft'):?>
                               <a onclick="alert('Sorry, contents of this course are currently unavailable')" > <?php echo $mTitle['title'] ?></a>
                            <?php elseif($mTitle['status']== 'draft'): ?>
                               <a onclick="alert('Sorry, contents of this module are currently unavailable')" > <?php echo $mTitle['title'] ?><?php echo ' (Draft)' ?></a>
                               <?php else: ?>
                            <?php echo '  <a href='.base_url().'learner/redLes/'.$mTitle['id'].'>'.$mTitle['title'].'</a>';?> 
                                <?php endif ?>
        
                    
                     <?php if(empty($latestSC[$mCount])): ?>
                               <?php if($cd[0]['status'] == 'draft'):?>
                               <a onclick="alert('Sorry, contents of this course are currently unavailable')" class="btn btn-primary btn-small pull-right"> Self-Check</a>
                            <?php elseif($mTitle['status'] == 'draft'):?>
                                 <a onclick="alert('Sorry, contents of this module are currently unavailable')" class="btn btn-primary btn-small pull-right"> Self-Check</a>
                                   <?php else: ?>
                         
                            <a href="<?php echo base_url().'test/generateSCTest/'.$mTitle['id']?>" class="btn btn-primary btn-small pull-right"> Self-Check</a>
                                <?php endif ?>
                       <?php else: ?>
                        
                             <?php if($latestSC[$mCount][0]['remarks'] == 'Passed' && $latestSC[$mCount][0]['moduleID'] == $mTitle['id']): ?>
                             <?php if($cd[0]['status'] == 'draft'):?>
                               <a onclick="alert('Sorry, contents of this course are currently unavailable')" class="btn btn-success btn-small pull-right"> Self-Check</a>
                            <?php elseif($mTitle['status'] == 'draft'):?>
                                 <a onclick="alert('Sorry, contents of this module are currently unavailable')" class="btn btn-success btn-small pull-right"> Self-Check</a>
                                   <?php else: ?>
                                <a href="<?php echo base_url().'test/generateSCTest/'.$mTitle['id']?>" class="btn btn-success btn-small pull-right"> Self-Check</a>
                            <?php endif ?>
                                    
                                    <?php elseif($latestSC[$mCount][0]['remarks'] == 'Failed'  && $latestSC[$mCount][0]['moduleID'] == $mTitle['id']): ?>
                               <?php if($cd[0]['status'] == 'draft'):?>
                               <a onclick="alert('Sorry, contents of this course are currently unavailable')" class="btn btn-danger btn-small pull-right"> Self-Check</a>
                            <?php elseif($mTitle['status'] == 'draft'):?>
                                 <a onclick="alert('Sorry, contents of this module are currently unavailable')" class="btn btn-danger btn-small pull-right"> Self-Check</a>
                                   <?php else: ?>
                                
                                <a href="<?php echo base_url().'test/generateSCTest/'.$mTitle['id']?>" class="btn btn-danger btn-small pull-right"> Self-Check</a>
                                <?php endif ?>
 <?php endif; ?>
                               
                       <?php endif; ?>    
                          
                                <?php $mCount+= 1 ?>
             
                   <?php foreach($popover[$cd[0]['ID']] as $po): ?>
              <?php foreach($po as $popO): ?>
                <?php if($popO['id'] == $mTitle['id']): ?>
                    <a id="example" href="<?php echo base_url().'syllabus/displayTopic/'.$popO['lesID'] ?>" class="btn btn-small btn-success example" style="margin-left: 10px"
                     data-toggle="popover" data-content="<?php echo $popO['modTitle']; ?>" data-original-title="<?php echo 'Lesson: '.$popO['lesTitle']; ?>"> 
                     Resume</a>
                <?php endif; ?>            
              <?php endforeach; ?>
              <?php endforeach; ?>
                 
     <?php endforeach; ?>  
  <?php endforeach; ?>  
              <?php echo '<li class="lesson-unit">';?>
                <?php foreach($passedSC[$cd[0]['ID']] as $pass): ?>
                    <?php $countPass = count($pass); ?>
                        <?php if($countPass == $modCount[$count - 1]): ?>
                                <?php if($cd[0]['status'] == 'draft'):?>
                                <a onclick="alert('Sorry, contents of this course are currently unavailable')"><?php echo $OA ?></a> 
                            <?php else: ?>    
                            <?php echo '  <a href='.base_url().'test/generateOATest/'.$cd[0]['ID'].'>'.$OA.'</a>';?> 
                                <?php endif ?>
                        <?php else: ?>
                                 <?php if($cd[0]['status'] == 'draft'):?>
                                <a onclick="alert('Sorry, contents of this course are currently unavailable')"><?php echo $OA ?></a> 
                            <?php else: ?>    
                           <a href="" onclick="alert('Heads up! You still need to pass all your selfchecks')"> <?php echo $OA;?> </a>
                            <?php endif ?>
 <?php endif; ?>
                <?php endforeach; ?>  
              </li>
              
          
          </ul>
          
          
      </div>
    </div>
  </div>

</div>
             
             
        
             
             
         <?php $count += 1; ?>
   <?php endforeach; ?>    
       <?php endif; ?>       
             
             
             
        
</div>
           
         </div>
                
            </div>
            <div class="span5" style="margin-left: -30px;">
                
                <div class="span5 well well-small">
                    <h4><?php echo Asset::img('glyphicons/glyphicons_087_log_book.png', 'alt text' );?> Finished Competencies</h4>
                    <div  style="overflow-y:auto; height:250px; margin-left:-25px;">
                    <ul style="list-style:none" id="modules">
                        <?php if(empty($finishedModules)):?>
                             <li class="lesson-unit"> <a> <?php echo 'You have no finished competencies' ?></a> </li>
                        <?php else: ?>
                        <?php date_default_timezone_set('Hongkong'); ?>
                        <?php $dateNow = new DateTime(date("Y-m-d H:i:s")) ?>
                        
                        
                      <?php foreach($finishedModules as $fm):?>
                        
                        <?php $dateDone = new DateTime($fm['dateFinished']); ?>
                            <li class="lesson-unit"> <a> <?php echo $fm['title'] ?></a> 
                                <br><small><em> 
                                   <?php if($dateNow->diff($dateDone)->format("%m")> 0):?>     
                                        <?php if($dateNow->diff($dateDone)->format("%m") == 1 || $dateNow->diff($dateDone)->format("%m") == 0): ?> 
                                            <?php echo $dateNow->diff($dateDone)->format("%m").' month ago' ?>
                                        <?php else: ?>
                                            <?php echo $dateNow->diff($dateDone)->format("%m").' months ago' ?>
                                        <?php endif; ?>
                                   <?php elseif($dateNow->diff($dateDone)->format("%s") > 0 && $dateNow->diff($dateDone)->format("%i") == 0): ?>
                                        <?php if($dateNow->diff($dateDone)->format("%s") == 1 || $dateNow->diff($dateDone)->format("%s") == 0): ?> 
                                            <?php echo $dateNow->diff($dateDone)->format("%s").' second ago' ?>
                                        <?php else: ?>
                                            <?php echo $dateNow->diff($dateDone)->format("%s").' seconds ago' ?>
                                        <?php endif; ?>
                                   <?php elseif($dateNow->diff($dateDone)->format("%d") == 0 && $dateNow->diff($dateDone)->format("%H") == 0):?>     
                                        <?php if($dateNow->diff($dateDone)->format("%i") == 1 || $dateNow->diff($dateDone)->format("%i") == 0): ?> 
                                            <?php echo $dateNow->diff($dateDone)->format("%i").' minute ago' ?>
                                        <?php else: ?>
                                            <?php echo $dateNow->diff($dateDone)->format("%i").' minutes ago' ?>
                                        <?php endif; ?>
                                   <?php elseif($dateNow->diff($dateDone)->format("%H") >= 1 && $dateNow->diff($dateDone)->format("%i") >= 0 && $dateNow->diff($dateDone)->format("%d") == 0):?>
                                        <?php if($dateNow->diff($dateDone)->format("%H") == 1): ?>  
                                            <?php echo $dateNow->diff($dateDone)->format("%H").' hour ago' ?>
                                        <?php else: ?>
                                            <?php echo $dateNow->diff($dateDone)->format("%H").' hours ago' ?>
                                        <?php endif ?>
                                   <?php elseif($dateNow->diff($dateDone)->format("%d") >= 0): ?>
                                        <?php if($dateNow->diff($dateDone)->format("%d") == 1): ?>  
                                            <?php echo $dateNow->diff($dateDone)->format("%d").' day ago' ?>
                                        <?php else: ?>
                                            <?php echo $dateNow->diff($dateDone)->format("%d").' days ago' ?>
                                        <?php endif; ?>
                                   <?php endif;?>
                                    
                                    </em></small>
                            </li>          
                            <?php endforeach; ?>
                            <?php endif ?>
          </ul>
                        
                  </div>
                    <a href="#" class="pull-right"> View all</a>
                </div>
                
             <div class="span5 well well-small">
                <h4> Do you have any Feedback?</h4>
                <a class="btn btn-small btn-block btn-primary" href="<?php echo base_url().'learner/learnerFeedback' ?>" > Give us a Feedback</a>
            </div>
                </div>
                
     </div>
         
       <div class="tab-pane fade" id="finished">
            <div class="span12">      
      <div class="span12" style="margin-left:-1px">
            
     
       
         <div class="row " style="margin-left:10px;">
            <?php $count = 1; ?>
        <?php if(empty($courseDeta)): ?>
             
             <div class="alert alert-info"> Still don't have course yet? <a class="btn btn-primary btn-mini" href="<?php echo base_url()."syllabus/index"?>">  Browse our courses! </a></div>
             
             <?php else: ?>
               <?php $mCount = 0 ?>
      <?php foreach($courseDeta as $cda): ?> 
             <div class="accordion" id="<?php echo 'p_accordion'.$count?>" style="background-color:white;">
  <div class="accordion-group">
    <div class="accordion-heading">
       
      <a class="accordion-toggle" data-toggle="collapse" data-parent="<?php echo '#p_accordion'.$count?>" href="#<?php echo '#p_collapse'.$count?>"> </a>
      
      <div style="padding-left:30px">
          <?php if($cda[0]['status'] == 'draft'):?>
            <h4> <a onclick="alert('Sorry, this course is currently unavailable')"> <?php echo $cda[0]['title'].' (Drafted)'; ?> </a></h4>
          <?php else:?>
            <h4> <a href="<?php echo base_url().'syllabus/dispMods2/'.$cda[0]['ID'] ?>"><?php echo $cda[0]['title']; ?></a>   </h4> 
          <?php endif ?>
          
           
          <div style="margin-top:-10px;">
              <span class="label label-info"><?php foreach ($enCourseDets[$cda[0]['ID']] as $lCo):?>Started <?php echo format_date($lCo['dateStarted']) ?> </span>
               <?php if ($lCo['dateFinished'] != ''):?><span class="label label-success">Finished <?php echo format_date($lCo['dateFinished']) ?></span> <?php endif; ?><?php endforeach; ?>
           <a class="pull-right"style="margin-right:10px" href="<?php echo base_url().'learner/printPDF/'.$cda[0]['ID'] ?>"> Download Course Report</a>
          </div>
        
                   
          <br>
         </div>          
             
             
     
    </div>
     
    <div id="<?php echo 'p_collapse'.$count ?>" class="accordion-body collapse in">
      <div class="accordion-inner">
                  
<table class="table table-striped" >
    <thead>
        <tr>
            <th>Module Name</th>
            <th width="100px">Rating</th>
            <th width="100px">Duration</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($modTitles2->$cda[0]['title'] as $a): ?>
                
                 <?php foreach ($a as $mTitle): ?>   
        <tr>
            <td> <?php echo $mTitle['title'] ?></td>
            <td><?php if(!empty($ratings[$mTitle['id']])): ?><?php foreach($ratings[$mTitle['id']] as $a): ?>
          <?php echo $a['remarks'] ?>  <?php endforeach ?><?php endif; ?></td>
            <td><?php foreach($dur[$mTitle['id']] as $duration):?> 
                <?php if($duration['dateFinished'] != '' ) :?>
                <?php $start = new DateTime($duration['dateStarted']); ?>
                <?php $end = new DateTime($duration['dateFinished']); ?>
          
               <?php if($end->diff($start)->format("%m") > 0):?>     
                    <?php if($end->diff($start)->format("%m") == 1 || $end->diff($start)->format("%m") == 0): ?> 
                        <?php echo $end->diff($start)->format("%m").' month' ?>
                    <?php else: ?>
                        <?php echo $end->diff($start)->format("%m").' months' ?>
                    <?php endif; ?>
               <?php elseif($end->diff($start)->format("%s") > 0 && $end->diff($start)->format("%i") == 0): ?>
                    <?php if($end->diff($start)->format("%s") == 1 || $end->diff($start)->format("%s") == 0): ?> 
                        <?php echo $end->diff($start)->format("%s").' second' ?>
                    <?php else: ?>
                        <?php echo $end->diff($start)->format("%s").' seconds' ?>
                    <?php endif; ?>
               <?php elseif($end->diff($start)->format("%d") == 0 && $end->diff($start)->format("%H") == 0):?>     
                    <?php if($end->diff($start)->format("%i") == 1 || $end->diff($start)->format("%i") == 0): ?> 
                        <?php echo $end->diff($start)->format("%i").' minute' ?>
                    <?php else: ?>
                        <?php echo $end->diff($start)->format("%i").' minutes' ?>
                    <?php endif; ?>
               <?php elseif($end->diff($start)->format("%H") >= 1 && $end->diff($start)->format("%i") >= 0 && $end->diff($start)->format("%d") == 0):?>
                    <?php if($end->diff($start)->format("%H") == 1): ?>  
                        <?php echo $end->diff($start)->format("%H").' hour' ?>
                    <?php else: ?>
                        <?php echo $end->diff($start)->format("%H").' hours' ?>
                    <?php endif ?>
               <?php elseif($end->diff($start)->format("%d") >= 0): ?>
                    <?php if($end->diff($start)->format("%d") == 1): ?>  
                        <?php echo $end->diff($start)->format("%d").' day' ?>
                    <?php else: ?>
                        <?php echo $end->diff($start)->format("%d").' days' ?>
                    <?php endif; ?>
               <?php endif;?>
                <?php endif ?>
                <?php endforeach; ?></td>
        </tr>
            <?php endforeach; ?>
            <?php endforeach; ?>
        
    </tbody>
</table>
          
      </div>
    </div>
  </div>

</div>
             
          
         <?php $count += 1; ?>
   <?php endforeach; ?>    
       <?php endif; ?>         
        
             
             
             
             
             
             
        
</div>
           
         </div>
             </div>  
        </div>
             
       <div class="tab-pane fade" id="badges">
           <div class="span12">
               <h4> Badges Earned</h4>
             <table class="table table-condensed">
                 <?php if(!empty($badgeEarned)): ?>
                 <thead>
                 <tr>
                     <th> Date Earned</th>
                     <th> Badge Name</th>
                 </tr>
                 </thead>
                 <tbody>
                    <?php foreach($badgeEarned as $be):?>
                     <tr>
                          
                         <td><?php echo format_date($be['dateEarned']) ?></td>
                         <td> <?php echo $be['name'] ?></td>
                        
                     </tr>
                      <?php endforeach; ?>
                 </tbody>
                 <?php else: ?>
                 <tbody>
                     <tr>
                       <strong>  <?php echo 'No badges earned yet' ?> <strong>
                     </tr>
                 </tbody>
                 <?php endif ?>
            </table>
           </div>
       
       </div>
     </div>
    
    
    </div>
    
     
    
    </div>
                        
            
          
              </div>
         
       <div id="completeProfile" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">Ã—</button>
    <h4 id="myModalLabel">eTESDA Learn wants to know you better!</h4>
  </div>
  <div class="modal-body">
      <?php foreach($compDet as $comp):?>
   
                        
                        <table id="user">
                            <?php echo form_open('learner/saveCHModal'); ?>
                           
                            
                            <tr>
                                <td > First Name:</td>  
                                <td > 
                                    <?php $fname = array('type'=>'text', 'name'=> 'fname', 'placeholder'=>'Enter first name', 'value'=> $comp['firstname']);
                            echo form_input($fname);?>                                    
                                </td>  
                                
                            </tr>
                            <tr>
                                <td > Middle Name:</td>  
                                <td > 
                                
                                      <?php $mname = array('type'=>'text', 'name'=> 'mname', 'placeholder'=>'Enter middle name', 'value'=> $comp['middlename']);
                            echo form_input($mname);?>  
                                
                                </td>  
                                
                            </tr>
                            <tr>
                                <td > Last Name:</td>  
                                <td >
                                    
                                     <?php $lname = array('type'=>'text', 'name'=> 'lname', 'placeholder'=>'Enter last name', 'value'=> $comp['lastname']);
                            echo form_input($lname);?>  
                                
                                
                                </td>  
                                
                            </tr>
                            <tr>
                                <td > Cellphone Number:</td>  
                                <td >
                                    
                                     <?php $cpNum = array('type'=>'text', 'name'=> 'cpNum', 'placeholder'=>'Enter cellphone number', 'value'=> $comp['cellno']);
                            echo form_input($cpNum);?>  
                                
                                
                                </td>  
                                
                            </tr>
                            <tr>
                                <td > Birthday:</td>  
                                <td >
                                    
                                                                    <input type="text" name="bday" placeholder ="Enter Birth Date" value="<?php echo $comp['birthday'] ?>" id="dp3" class="datepicker" >
                                
                                </td>  
                                
                            </tr>
                           
                            <tr>
                                <td >House No:</td>  
                                <td > 
                                    <?php $houseNo = array('type'=>'text', 'name'=> 'houseNo', 'placeholder'=>'Enter house number', 'value'=> $comp['streetno']);
                            echo form_input($houseNo);?>  
                                
                                </td>  
                                
                            </tr>
                            
                            <tr>
                                <td >Barangay:</td>  
                                <td > 
                                    <?php $brgy = array('type'=>'text', 'name'=> 'brgy', 'placeholder'=>'Enter barangay', 'value'=> $comp['brgy']);
                            echo form_input($brgy);?>  
                                
                                </td>  
                                
                            </tr>
                            <tr>
                                <td >District:</td>  
                                <td > 
                                    <?php $dist = array('type'=>'text', 'name'=> 'dist', 'placeholder'=>'Enter district', 'value'=> $comp['district']);
                            echo form_input($dist);?>  
                                
                                </td>  
                                
                            </tr>
                            
                            
                             <tr>
                                <td >City:</td>  
                                <td > 
                                    <?php $city = array('type'=>'text', 'name'=> 'city', 'placeholder'=>'Enter city', 'value'=> $comp['city']);
                            echo form_input($city);?>  
                        
                                </td>  
                                
                            </tr>   
                              <tr>
                                <td >Country:</td>  
                                <td >
                                    <select name="country">
                                        <option value="" >Choose Country</option>
            <option value="United States">United States</option>
            <option value="United Kingdom">United Kingdom</option>
            <option value="Afghanistan">Afghanistan</option>
            <option value="Aland Islands">Aland Islands</option>
            <option value="Albania">Albania</option>
            <option value="Algeria">Algeria</option>
            <option value="American Samoa">American Samoa</option>
            <option value="Andorra">Andorra</option>
            <option value="Angola">Angola</option>
            <option value="Anguilla">Anguilla</option>
            <option value="Antarctica">Antarctica</option>
            <option value="Antigua and Barbuda">Antigua and Barbuda</option>
            <option value="Argentina">Argentina</option>
            <option value="Armenia">Armenia</option>
            <option value="Aruba">Aruba</option>
            <option value="Australia">Australia</option>
            <option value="Austria">Austria</option>
            <option value="Azerbaijan">Azerbaijan</option>
            <option value="Bahamas">Bahamas</option>
            <option value="Bahrain">Bahrain</option>
            <option value="Bangladesh">Bangladesh</option>
            <option value="Barbados">Barbados</option>
            <option value="Belarus">Belarus</option>
            <option value="Belgium">Belgium</option>
            <option value="Belize">Belize</option>
            <option value="Benin">Benin</option>
            <option value="Bermuda">Bermuda</option>
            <option value="Bhutan">Bhutan</option>
            <option value="Bolivia, Plurinational State of">Bolivia, Plurinational State of</option>
            <option value="Bonaire, Sint Eustatius and Saba">Bonaire, Sint Eustatius and Saba</option>
            <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
            <option value="Botswana">Botswana</option>
            <option value="Bouvet Island">Bouvet Island</option>
            <option value="Brazil">Brazil</option>
            <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
            <option value="Brunei Darussalam">Brunei Darussalam</option>
            <option value="Bulgaria">Bulgaria</option>
            <option value="Burkina Faso">Burkina Faso</option>
            <option value="Burundi">Burundi</option>
            <option value="Cambodia">Cambodia</option>
            <option value="Cameroon">Cameroon</option>
            <option value="Canada">Canada</option>
            <option value="Cape Verde">Cape Verde</option>
            <option value="Cayman Islands">Cayman Islands</option>
            <option value="Central African Republic">Central African Republic</option>
            <option value="Chad">Chad</option>
            <option value="Chile">Chile</option>
            <option value="China">China</option>
            <option value="Christmas Island">Christmas Island</option>
            <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
            <option value="Colombia">Colombia</option>
            <option value="Comoros">Comoros</option>
            <option value="Congo">Congo</option>
            <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
            <option value="Cook Islands">Cook Islands</option>
            <option value="Costa Rica">Costa Rica</option>
            <option value="Cote D'ivoire">Cote D'ivoire</option>
            <option value="Croatia">Croatia</option>
            <option value="Cuba">Cuba</option>
            <option value="Curacao">Curacao</option>
            <option value="Cyprus">Cyprus</option>
            <option value="Czech Republic">Czech Republic</option>
            <option value="Denmark">Denmark</option>
            <option value="Djibouti">Djibouti</option>
            <option value="Dominica">Dominica</option>
            <option value="Dominican Republic">Dominican Republic</option>
            <option value="Ecuador">Ecuador</option>
            <option value="Egypt">Egypt</option>
            <option value="El Salvador">El Salvador</option>
            <option value="Equatorial Guinea">Equatorial Guinea</option>
            <option value="Eritrea">Eritrea</option>
            <option value="Estonia">Estonia</option>
            <option value="Ethiopia">Ethiopia</option>
            <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
            <option value="Faroe Islands">Faroe Islands</option>
            <option value="Fiji">Fiji</option>
            <option value="Finland">Finland</option>
            <option value="France">France</option>
            <option value="French Guiana">French Guiana</option>
            <option value="French Polynesia">French Polynesia</option>
            <option value="French Southern Territories">French Southern Territories</option>
            <option value="Gabon">Gabon</option>
            <option value="Gambia">Gambia</option>
            <option value="Georgia">Georgia</option>
            <option value="Germany">Germany</option>
            <option value="Ghana">Ghana</option>
            <option value="Gibraltar">Gibraltar</option>
            <option value="Greece">Greece</option>
            <option value="Greenland">Greenland</option>
            <option value="Grenada">Grenada</option>
            <option value="Guadeloupe">Guadeloupe</option>
            <option value="Guam">Guam</option>
            <option value="Guatemala">Guatemala</option>
            <option value="Guernsey">Guernsey</option>
            <option value="Guinea">Guinea</option>
            <option value="Guinea-bissau">Guinea-bissau</option>
            <option value="Guyana">Guyana</option>
            <option value="Haiti">Haiti</option>
            <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
            <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
            <option value="Honduras">Honduras</option>
            <option value="Hong Kong">Hong Kong</option>
            <option value="Hungary">Hungary</option>
            <option value="Iceland">Iceland</option>
            <option value="India">India</option>
            <option value="Indonesia">Indonesia</option>
            <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
            <option value="Iraq">Iraq</option>
            <option value="Ireland">Ireland</option>
            <option value="Isle of Man">Isle of Man</option>
            <option value="Israel">Israel</option>
            <option value="Italy">Italy</option>
            <option value="Jamaica">Jamaica</option>
            <option value="Japan">Japan</option>
            <option value="Jersey">Jersey</option>
            <option value="Jordan">Jordan</option>
            <option value="Kazakhstan">Kazakhstan</option>
            <option value="Kenya">Kenya</option>
            <option value="Kiribati">Kiribati</option>
            <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
            <option value="Korea, Republic of">Korea, Republic of</option>
            <option value="Kuwait">Kuwait</option>
            <option value="Kyrgyzstan">Kyrgyzstan</option>
            <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
            <option value="Latvia">Latvia</option>
            <option value="Lebanon">Lebanon</option>
            <option value="Lesotho">Lesotho</option>
            <option value="Liberia">Liberia</option>
            <option value="Libya">Libya</option>
            <option value="Liechtenstein">Liechtenstein</option>
            <option value="Lithuania">Lithuania</option>
            <option value="Luxembourg">Luxembourg</option>
            <option value="Macao">Macao</option>
            <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
            <option value="Madagascar">Madagascar</option>
            <option value="Malawi">Malawi</option>
            <option value="Malaysia">Malaysia</option>
            <option value="Maldives">Maldives</option>
            <option value="Mali">Mali</option>
            <option value="Malta">Malta</option>
            <option value="Marshall Islands">Marshall Islands</option>
            <option value="Martinique">Martinique</option>
            <option value="Mauritania">Mauritania</option>
            <option value="Mauritius">Mauritius</option>
            <option value="Mayotte">Mayotte</option>
            <option value="Mexico">Mexico</option>
            <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
            <option value="Moldova, Republic of">Moldova, Republic of</option>
            <option value="Monaco">Monaco</option>
            <option value="Mongolia">Mongolia</option>
            <option value="Montenegro">Montenegro</option>
            <option value="Montserrat">Montserrat</option>
            <option value="Morocco">Morocco</option>
            <option value="Mozambique">Mozambique</option>
            <option value="Myanmar">Myanmar</option>
            <option value="Namibia">Namibia</option>
            <option value="Nauru">Nauru</option>
            <option value="Nepal">Nepal</option>
            <option value="Netherlands">Netherlands</option>
            <option value="New Caledonia">New Caledonia</option>
            <option value="New Zealand">New Zealand</option>
            <option value="Nicaragua">Nicaragua</option>
            <option value="Niger">Niger</option>
            <option value="Nigeria">Nigeria</option>
            <option value="Niue">Niue</option>
            <option value="Norfolk Island">Norfolk Island</option>
            <option value="Northern Mariana Islands">Northern Mariana Islands</option>
            <option value="Norway">Norway</option>
            <option value="Oman">Oman</option>
            <option value="Pakistan">Pakistan</option>
            <option value="Palau">Palau</option>
            <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
            <option value="Panama">Panama</option>
            <option value="Papua New Guinea">Papua New Guinea</option>
            <option value="Paraguay">Paraguay</option>
            <option value="Peru">Peru</option>
            <option value="Philippines">Philippines</option>
            <option value="Pitcairn">Pitcairn</option>
            <option value="Poland">Poland</option>
            <option value="Portugal">Portugal</option>
            <option value="Puerto Rico">Puerto Rico</option>
            <option value="Qatar">Qatar</option>
            <option value="Reunion">Reunion</option>
            <option value="Romania">Romania</option>
            <option value="Russian Federation">Russian Federation</option>
            <option value="Rwanda">Rwanda</option>
            <option value="Saint Barthelemy">Saint Barthelemy</option>
            <option value="Saint Helena, Ascension and Tristan da Cunha">Saint Helena, Ascension and Tristan da Cunha</option>
            <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
            <option value="Saint Lucia">Saint Lucia</option>
            <option value="Saint Martin (French part)">Saint Martin (French part)</option>
            <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
            <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
            <option value="Samoa">Samoa</option>
            <option value="San Marino">San Marino</option>
            <option value="Sao Tome and Principe">Sao Tome and Principe</option>
            <option value="Saudi Arabia">Saudi Arabia</option>
            <option value="Senegal">Senegal</option>
            <option value="Serbia">Serbia</option>
            <option value="Seychelles">Seychelles</option>
            <option value="Sierra Leone">Sierra Leone</option>
            <option value="Singapore">Singapore</option>
            <option value="Sint Maarten (Dutch part)">Sint Maarten (Dutch part)</option>
            <option value="Slovakia">Slovakia</option>
            <option value="Slovenia">Slovenia</option>
            <option value="Solomon Islands">Solomon Islands</option>
            <option value="Somalia">Somalia</option>
            <option value="South Africa">South Africa</option>
            <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
            <option value="South Sudan">South Sudan</option>
            <option value="Spain">Spain</option>
            <option value="Sri Lanka">Sri Lanka</option>
            <option value="Sudan">Sudan</option>
            <option value="Suriname">Suriname</option>
            <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
            <option value="Swaziland">Swaziland</option>
            <option value="Sweden">Sweden</option>
            <option value="Switzerland">Switzerland</option>
            <option value="Syrian Arab Republic">Syrian Arab Republic</option>
            <option value="Taiwan, Province of China">Taiwan, Province of China</option>
            <option value="Tajikistan">Tajikistan</option>
            <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
            <option value="Thailand">Thailand</option>
            <option value="Timor-leste">Timor-leste</option>
            <option value="Togo">Togo</option>
            <option value="Tokelau">Tokelau</option>
            <option value="Tonga">Tonga</option>
            <option value="Trinidad and Tobago">Trinidad and Tobago</option>
            <option value="Tunisia">Tunisia</option>
            <option value="Turkey">Turkey</option>
            <option value="Turkmenistan">Turkmenistan</option>
            <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
            <option value="Tuvalu">Tuvalu</option>
            <option value="Uganda">Uganda</option>
            <option value="Ukraine">Ukraine</option>
            <option value="United Arab Emirates">United Arab Emirates</option>
            <option value="United Kingdom">United Kingdom</option>
            <option value="United States">United States</option>
            <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
            <option value="Uruguay">Uruguay</option>
            <option value="Uzbekistan">Uzbekistan</option>
            <option value="Vanuatu">Vanuatu</option>
            <option value="Venezuela, Bolivarian Republic of">Venezuela, Bolivarian Republic of</option>
            <option value="Viet Nam">Viet Nam</option>
            <option value="Virgin Islands, British">Virgin Islands, British</option>
            <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
            <option value="Wallis and Futuna">Wallis and Futuna</option>
            <option value="Western Sahara">Western Sahara</option>
            <option value="Yemen">Yemen</option>
            <option value="Zambia">Zambia</option>
            <option value="Zimbabwe">Zimbabwe</option>
                                    </select>
                            
                                </td>  
                                
                            </tr>
                            
                             
                          
                            
                            <tr style="height:20px"></tr> 
                           
                           
                            </tr>
                            <tr style="height:20px"></tr>
                            <tr> 
                               
                              </tr>
                             
                        </table>
                    
                    
                    
                   
      <?php endforeach; ?>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <input  type="submit" class="btn btn-primary"></input>
  </div>
</div>
        

  <div id="modalBadge" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 id="myModalLabel">Congratulations You've Earned a Badge!</h4>
  </div>
  <div class="modal-body">
      
          <ul class="thumbnails">
  <li class="span4"  style="margin-left:120px">
      
    <div href="#" class="thumbnail">
        <img class="media-object" src="{{ url:site }}files/large/<?php echo $badgeImg;?>" alt="" data-src="holder.js/160x120" > 
    
        <h5 style="text-align:center"> <strong><?php echo $badgeName ?> </strong></h5> 
    </div>
    
     
  </li>
  
</ul>
          
      
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
  </div>
</div>    
     
        
    
    
    





    
   
        
        