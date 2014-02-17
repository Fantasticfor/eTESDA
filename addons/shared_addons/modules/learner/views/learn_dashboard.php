


<div class="container" style="padding-bottom: 100px">
    
<div class="row">

    <div class="span4 " >
        
        
            <ul class="thumbnails " style="margin-left: -30px; margin-top:-10px" >
  <li class="span4" >
    <div class="thumbnail well well-small">
        <?php foreach ($userInfo as $ui):?>
        <?php if($ui['picture'] == NULL):?>
             <?php echo Asset::img('default_display.png', 'alt text',array( 'class'=>'img-polaroid','data-src'=>'holder.js/260x180')  );?>
        <?php else: ?>
             <img src='<?php echo $ui['picture'] ?>' class="img-polaroid" data-src="holder.js/260x180"    >
             <?php endif; ?>
             <?php endforeach; ?>
               <table style="margin-left:20px">

                    <tr>

                 
                        <td>
                              <?php foreach ($userInfo as $ui):?>
                            <h5><?php echo $ui['firstname'];?> <?php echo $ui['lastname']; ?>
                            </h5>
                            <?php endforeach; ?>
                            <p>
                                <?php foreach($userAdd as $ua):?>
                                <?php echo $ua['streetno'];?> <?php echo $ua['brgy'];?>
                                <?php echo $ua['district'];?> <?php echo $ua['city'];?>
                                <?php echo $ua['province'];?> <?php echo $ua['zipcode'];?>
                                <?php endforeach; ?>
                            </p>
                            <?php foreach ($userInfo as $ui):?>
                            <p> <?php echo $ui['cellno'];?> </p>
                            <?php endforeach; ?>    
                        </td>
                    </tr>
                    <tr>  

                        <td> 
                            <a class="btn btn-primary pull-left" href="{{ url:site uri="syllabus/editProfile" }}">
                                
                               Edit Profile</a></td>
                        <td></td>
                    </tr>

                </table>
    </div>
  
  
       
      
  
  
  
  
  
  </li>
  
  
  
  
  
</ul>
       
             
  
       
          
                   <div class="sidebar-nav well" style="margin-left:-10px;margin-top: -20px">
                          
             <ul class="nav nav-list" id="myTab2">
              <li class="nav-header">
                  Your Profile  
              </li>
            
              
              <li class="active"> <a href="#dashboard" data-toggle="tab"> <i class="icon-book"> </i> My Courses <span class="badge badge-success">2</span> </a></li>
              <li><a href="#tests" data-toggle="tab"><i class=" icon-list-alt"> </i> My Tests <span class="badge badge-success">3</span></a></li>
              <li><a href="#achievements" data-toggle="tab"> <i class="icon-certificate"> </i>  My Achievements <span class="badge badge-success">5</span></a></li>
              <li><a href="#certificate" data-toggle="tab"> <i class="icon-asterisk"> </i>  My Certificates <span class="badge badge-success">5</span></a></li>
              
              
            </ul>
                             
                </div>
          
                          
                        </div><!--/span-->
     
                        
            
            <div class="span9 tab-content" id="myTabContent2" style="padding-left:20px" >
                <div class="alert alert-warning"> Know more about yourself, take the e-Profiling Test <a href="<?php echo base_url()."profiling/viewProf"?>"> here!</a> </div>
                <div class="tab-pane fade active in" id="dashboard">
   
                    
     <div class="row">
         <!--loads tab for my courses-->
     
           <ul class="nav nav-tabs" id="myTab">
  <li class="active" >
  <!--  <a href="{{url:site}}" data-toggle="tab" >Ongoing Courses </a>-->
  <a href="#ongoing" data-toggle="tab"> Ongoing Courses <span class="badge badge-success">1</span> </a> 
  </li>
  <li >
      <a href="#finished" data-toggle="tab"> Finished Courses <span class="badge badge-success">1</span> </a>  
  </li>
 
              </ul> 

 <div class=" well well-small tab-content " id="myTabContent">
       <div class="tab-pane fade active in" id="ongoing">
         
       <h4><?php echo Asset::img('glyphicons/glyphicons_351_book_open.png', 'alt text' );?> Ongoing Courses</h4>
       
         <div class="row " style="margin-left:10px;">
        <?php $count = 1; ?>
        <?php if(empty($courseDet)): ?>
             
             <div class="alert alert-info"> Still don't have course yet? <a class="btn btn-primary btn-mini" href="<?php echo base_url()."syllabus/index"?>">  Browse our courses! </a></div>
             
             <?php else: ?>
      <?php foreach($courseDet as $cd): ?> 
            
               
            
           
             <div class="accordion" id="<?php echo'c_accordion'.$count?>" style="background-color:white;">
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="<?php echo'#c_accordion'.$count?>" href="<?php echo'#collapse'.$count?>">
          
          <h5 > Course <?php echo $count?>: <?php echo $cd[0]['title']; ?>
             <span class="label label-info"><?php echo $finishedM[$count - 1];?> of <?php echo $modCount[$count - 1];?> modules
              </span>
              
                   
                   <div class="progress" style=" height:15px; margin-left: 20px;margin-top:10px;"> 
           <?php $barWidth = 99/($modCount[$count - 1] + 1); ?>
                       <?php $i = 1; ?>
                       <?php $OA = 'Online Assessment'; ?>
                 <?php foreach($modTitles->$cd[0]['title'] as $a): ?>
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
                   
               </h5> 
             
      </a>
    </div>
       
    <div style="padding-top:20px" id="<?php echo'collapse'.$count?>" class="accordion-body collapse in">
      <div class="accordion-inner">
          <ul style="list-style:none" id="modules">
                   
              
         <?php foreach($modTitles->$cd[0]['title'] as $a): ?>
                 <?php foreach ($a as $mTitle): ?>   
                 
                    <?php echo '<li class="lesson-unit">';?>
          
         <?php foreach($fModuleIDs as $fmID): ?>
             <?php foreach ($fmID as $fmIDs): ?>

              <?php if($fmIDs['ID'] == $mTitle['id']): ?>
              <i class="icon-ok-green"></i>
                <?php endif; ?>
             <?php endforeach; ?> 
          <?php endforeach; ?>   
              
         
      <?php echo '  <a href='.base_url().'syllabus/displayModules/'.$cd[0]['ID'].'>'.$mTitle['title'].'</a>';?> 
       <?php foreach($popover as $po): ?>
              <?php foreach($po as $popO): ?>
                <?php if($popO['id'] == $mTitle['id']): ?>
                    <a id="example" href="<?php echo base_url().'syllabus/displayTopic/'.$popO['lesID'] ?>" class="btn btn-small btn-success" style="margin-left: 10px"
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
                            <?php echo '  <a href='.base_url().'test/generateOATest/'.$cd[0]['ID'].'>'.$OA.'</a>';?> 
                        <?php else: ?>
                           <a href="" onclick="alert('Heads up! You still need to pass all your selfchecks')"> <?php echo $OA;?> </a>
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
         
        <div class="tab-pane fade" id="finished">
         
            <!-- loads Finished Courses -->
               
         <h4><?php echo Asset::img('glyphicons/glyphicons_087_log_book.png', 'alt text' );?> Finished Courses</h4>
       
         <div class="row " style="margin-left:10px;">
          <?php $fCount = 1; ?>
             <?php $OA = 'Online Assessment'; ?>
             <?php if(empty($fCourseDet)): ?>
             
             <div ><h5> You don't have finished courses yet. </h5></div>
             
             <?php else: ?>
             
      <?php foreach($fCourseDet as $fcd): ?>     
             <div class="accordion" id="<?php echo'fc_accordion'.$count?>" style="background-color:white;">
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="<?php echo'#fc_accordion'.$count?>" href="<?php echo'#fCollapse'.$count?>">
          
          <h5 > Course <?php echo $fCount?>: <?php echo $fcd[0]['title']; ?>
                           <span class="label label-info"><?php echo $fModCount[$fCount - 1];?> of <?php echo $fModCount[$fCount - 1];?> modules
              </span>
              
                   
                   <div class="progress" style=" height:15px; margin-left: 20px;margin-top:10px;"> 
           <?php $barWidth = 99/($fModCount[$fCount - 1] + 1); ?>
                 <?php foreach($fModTitles->$fcd[0]['title'] as $a): ?>
                 <?php foreach ($a as $fMTitle): ?>  
                <?php echo '<div class="bar bar-success" style="width:'.$barWidth.'%;  margin-left:1px"></div>'; ?>
            <?php endforeach; ?>
        <?php endforeach; ?>
                   <?php echo '<div class="bar bar-success" style="width:'.$barWidth.'%;  margin-left:1px"></div>'; ?>
                   
                       
</div>
                   
               </h5> 
             
      </a>
    </div>
     
    <div id="<?php echo 'fCollapse'.$count?>" class="accordion-body collapse in">
      <div class="accordion-inner">
          <ul style="list-style:none" id="modules">
              
               <?php $fCount += 1; ?>
              <?php foreach($fModTitles->$fcd[0]['title'] as $a): ?>
                 <?php foreach ($a as $fMTitle): ?>   
                   
                 <?php echo '<li class="lesson-unit">';?>
                 <?php echo Asset::img('icons/check.png', 'alt text');?>
                 <?php echo '  <a href='.base_url().'syllabus/displayModules/'.$fcd[0]['ID'].'>'.$fMTitle['title'].'</a>';?> 
                 <?php endforeach; ?> 
                <?php endforeach; ?>  
              
                  <?php echo '<li class="lesson-unit">';?>
              <?php echo Asset::img('icons/check.png', 'alt text');?>
                      <?php echo '  <a href='.base_url().'test/generateOATest/'.$fcd[0]['ID'].'>'.$OA.'</a>';?> 
                
           
          </ul>
          
          
      </div>
    </div>
  </div>

</div>
             <?php endforeach; ?>
             <?php endif; ?>
             
        
             
             
             
             
             
             
        
</div>
             
            
        </div>
     </div>

                </div>
            
                </div> <!-- dashboard-->
                
            
               
            <div class="tab-pane fade" id="tests">
                
                <!--loads tests-->
               
                        <ul class="nav nav-tabs" id="myTab3">
  <li class="active" >
  <a href="#onlineAssessment" data-toggle="tab"> Online Assessments</a>
  </li>
  <li >
      <a href="#SelfCheck" data-toggle="tab">Self-Check Tests</a></li>
 
              </ul>
                        <div class=" well well-small tab-content " id="myTabContent3">

   <div class="tab-pane fade active in" id="onlineAssessment">
         <h4><?php echo Asset::img('glyphicons/glyphicons_039_notes.png', 'alt text' );?> Pending Online Assessments</h4>
    
     <div class="row offset1 mini" style="padding-top:20px">
         
        <ul class="thumbnails">
            <?php $oaCount = 0; ?>
            <?php foreach ($learnerOA as $LOA): ?> 
                            <li class="span4 small"> 
                  <div class="thumbnail course" href='<?php echo base_url()."syllabus/Modules" ?>'>
            <img class="media-object" src="{{ url:site }}files/large/<?php echo $LOA['image'];?>" alt="" data-src="holder.js/160x120" >
                       <!--<img data-src="holder.js/260x120" alt="">-->
                        
                        <h5><?php echo $LOA['title']; ?> Assessment</h5>
                        <p><?php echo $sectorTitles[$oaCount]; ?> </p>
                        <?php $oaCount += 1; ?>
                    <a class="btn btn-success" href="<?php echo base_url().'test/generateOATest/'.$LOA['id']?>"> Take Test</a>
                        
                  </div>
                              </li>
                              <?php endforeach; ?>
                      
                    </ul>
         
         
     </div>
         
         <hr>
                <h4><?php echo Asset::img('glyphicons/glyphicons_039_notes_check.png', 'alt text' );?> Finished Online Assessments</h4>
    
     <div class="row offset1 mini" style="padding-top:20px">
         <ul class="thumbnails">
            <?php $foaCount = 0; ?>
            <?php foreach ($fCDetails as $FOA): ?> 
                            <li class="span4 small"> 
                  <div class="thumbnail course" href='<?php echo base_url()."syllabus/Modules" ?>'>
            <img class="media-object" src="{{ url:site }}files/large/<?php echo $FOA[0]['image'];?>" alt="" data-src="holder.js/160x120" >
                       <!--<img data-src="holder.js/260x120" alt="">-->
                      
                        <h5><?php echo $FOA[0]['title']; ?> Assessment </h5>
                    <p><?php echo $fSectorTitles[$foaCount]; ?> </p>
                         <?php $foaCount += 1; ?>
                    <a class="btn btn-success" href="<?php echo base_url()."test/generateOATest/".$FOA[0]['ID']; ?>" > Take Test</a>
                   <a class="btn btn-primary" href="<?php echo base_url()."learner/viewResultsOA/".$FOA[0]['ID']; ?>" > View Results </a>
                        
                  </div>
                              </li>
                              <?php endforeach; ?>
                      
                    </ul>
         
         
               
       
                
                        </div>
                
                    
                    
    
                         
                        </div>
   
      <div class="tab-pane fade in"  id="SelfCheck">
   
            <div class="row offset1 mini" style="padding-top:20px">
         
         <ul class="thumbnails">
               <?php $scCount = 0; ?>
      <?php foreach($courseDeta as $cDet): ?>  
      
                            <li class="span4 small"> 
                  <div class="thumbnail course" href='<?php echo base_url()."syllabus/Modules" ?>'>
             <img class="media-object" src="{{ url:site }}files/large/<?php echo $cDet[0]['image'];?>" alt="" data-src="holder.js/160x120" >
                       <!--<img data-src="holder.js/260x120" alt="">-->
                      
                        <h5><?php echo $cDet[0]['title']; ?> Self-Check</h5>
                    <p> <?php echo $scSectors[$scCount]; ?> </p>
                    <?php $scCount += 1; ?>
                    <a class="btn btn-primary" href='<?php echo base_url()."learner/scResults/".$cDet[0]['ID']?>'> View Results</a>    
                  </div>
                              </li>
                              
                              <?php endforeach; ?>
                      
                    </ul>
         
         
               
       
                
                        </div>
         
     </div>
    
         
 </div>
    
     
  
         
         
 
                
                 
               
                </div>
                
                
                <div class="tab-pane fade" id="achievements">
             
                      


<div class=" well well-small " >

   <div class="tab-pane fade active in" id="onlineAssessment">
         <h4><?php echo Asset::img('glyphicons/glyphicons_332_certificate.png', 'alt text' );?> Badges Earned</h4>
    
     <div class="row offset1 mini" style="padding-top:20px">
         
        <ul class="thumbnails">
            <li class="span2 small"> 
                  <div  class="thumbnail">
                      <span  style="position:absolute; display:block; vertical-align: baseline" class="label label-success"> <strong> x5 </strong></span>
                      <?php echo Asset::img('gold.png', 'alt text' );?>
                      <h5 style="text-align:center">Gold badge</h5>
                       
                  </div>
                </li>
             
            <li class="span2 small"> 
                  <div  class="thumbnail">
        <span  style="position:absolute; display:block; vertical-align: baseline" class="label label-success"> <strong> x2 </strong></span>        
              <?php echo Asset::img('silver.png', 'alt text' );?>
                        <h5 style="text-align:center">Silver badge</h5>
                  </div>
                </li>
             
            <li class="span2 small"> 
                  <div  class="thumbnail">
<span  style="position:absolute; display:block; vertical-align: baseline" class="label label-success"> <strong> x3 </strong></span>        
              <?php echo Asset::img('bronze.png', 'alt text' );?>
                        <h5 style="text-align:center">Bronze badge</h5>
                  </div>
                </li>
             </ul>
         
         
     </div>
         
        
    
      
    
     
         
 </div>
    
     
  
         
  </div>       
 
                    
                    
                </div>
                <div class="tab-pane fade" id="certificate">
             
  


<div class=" well well-small " >

   <div class="tab-pane fade active in" id="onlineAssessment">
         <h4><?php echo Asset::img('glyphicons/glyphicons_332_certificate.png', 'alt text' );?> My Certificates</h4>
    
       <div class="row offset1 mini" style="padding-top:20px">
         
        <ul class="thumbnails">
            <li class="span4 small"> 
                  <div  class="thumbnail course" href='<?php echo base_url()."syllabus/Modules" ?>'>
                      <?php echo Asset::img('dummy/CHS_1170x480.png', 'alt text',array('class'=>"media-object",'data-src'=>"holder.js/260x120") );?>
                        <h5>Computer Hardware Servicing Assessment </h5>
                    <p> Information Technology
                    </p>
                    <a class="btn btn-success" data-toggle="modal" href="#ViewCertificate"> View Certificate</a>
                  </div>
                </li>
             </ul>
         
         
     </div>
         
        <div id="ViewCertificate" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header" style="height:30px">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    
  </div>
  <div class="modal-body">
      <div class="well well-small">
      <h3> <?php echo Asset::img('glyphicons/glyphicons_332_certificate.png', 'alt text' );?>  Certificate of Completion</h3>
      <hr>
      <h5>Computer Hardware Servicing Online Assessment</h5>
    <p > This certifies that Ken Ken Albudin has passed the Online Assessment of Computer Hardware Servicing
        <br>
        <small> on February 10,2013</small>
    </p>
    
    
    </div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
  
  </div>
</div>
    
      
    
     
         
 </div>
    
     
  
         
  </div>       
 
    
 
                    
                    
                </div>
           
      
   

        
</div>
              </div>
         
         </div>
        
    
    
    





    
   
        
        