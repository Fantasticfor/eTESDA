<div class="one_full">
      <ul id="breadcrumbs-one">
		   <?php foreach($learnerInfo as $li):?>
		<li><a href="<?php echo site_url('admin/statistics/learnerStat'); ?>" > Learner Monitoring</a></li>
		<li><a href="" class="current"> <?php echo $li['firstname']; ?> <?php echo $li['middlename']; ?> <?php echo $li['lastname']; ?> 's Profile</a></li>
		
	</ul>

    
</div>


<div class="one_full">
    


 
          <div class="one_full">
          <section class="title blue"> 
              <h4>  <i class=" icon-user" style="margin-top: 4px"  ></i>
                  <strong>Learner's Profile Details </strong> </h4> 
        
                  
          </section>
        
          
          <section class="item"> 
              <div class="one_full" style="padding:20px">
                      
                  
                  <div class="one_third">
             <ul class="thumbnails">
  <li class="one_third">
    <div class="thumbnail">
     
                 <?php if($li['picture'] == NULL): ?>
                         <?php echo Asset::img('default_display.png', 'alt text',array( 'class'=>'img-polaroid','data-src'=>'holder.js/260x180')  );?>
                 <?php else: ?>
                        <img src='<?php echo $li['picture']; ?>' class="img-polaroid" data-src="holder.js/260x180">
                        <?php endif ?>
        
        <div class="caption">
            <h4> <strong><?php echo $li['firstname']; ?> <?php echo $li['middlename']; ?> <?php echo $li['lastname']; ?>  </strong></h4>
            <p> 
               
                <em>Date Joined: </em> <?php echo format_date($li['dateJoined']); ?> 
            
            </p>
        </div>
            
    </div>
  </li>
 
</ul>
                  
              </div>
                  
              <div class="one_third" style="width:500px;margin-left:10px">
                  
              
              <table border="0" class="borderless">
                  
                
                    
                  
                  <tr><td> Name:</td><td><?php echo $li['firstname']; ?> <?php echo $li['middlename']; ?> <?php echo $li['lastname']; ?> </td></tr>
                    <tr><td> Email Address:</td><td><?php echo $li['email']; ?></td></tr>
                    <tr><td> Date Joined:</td><td><?php echo format_date($li['dateJoined']); ?></td></tr>
                    <tr><td> Age:</td><td><?php foreach ($enAge as $ea):?><?php echo $ea['age']?><?php endforeach; ?></td></tr>
                  <?php endforeach; ?> 
                    <tr><td> Course/s Finished:</td>
                        <td>
                            <?php $count = 1; ?>
                            <?php $arrCount = count($fLearnerCourses); ?>
                            <?php foreach($fLearnerCourses as $flc): ?>
                                <?php if($count == $arrCount): ?>
                                        <?php echo $flc['title']; ?>
                                    <?php else:?>
                                        <?php echo $flc['title'].', '; ?>
                                <?php endif; ?>
                                <?php $count += 1; ?>
                            <?php endforeach; ?>
                        </td>
                        
                    </tr>
              </table>          
              </div>
              
                  </div>
          </section>    
          </div>
         
          <div class="one_full">
      <section class="title blue">
          <h4><i class="icon-book" style="margin-top: 4px"></i><strong>Course/s Taken </strong></h4>
</section>

 
   
          
          
            
              <div id="accordion">
                  
                  <?php foreach($learnerCourses as $lc): ?>
                  <h3 style="font-size:12pt"><?php echo $lc['title']; ?> 
                      <?php if($lc['status'] == 1): ?>
                      <span class="label ">Following Course</span>
                      <?php endif; ?>
                      <?php if($lc['status'] == 2): ?>
                      <span class="label label-warning">Ready for Assessment</span>
                      <?php endif; ?>
                      <?php if($lc['status'] == 3): ?>
                      <span class="label label-success">Candidate for Certification</span>
                      <?php endif; ?>
                  </h3>
  <div>
     
      <div style="margin-left: 10px">
         <h3> <i class=" icon-time" style="margin-top:4px"></i>Course Duration </h3>
         </div>
      
      <table border="0" class="borderless">
          <tr>
          <td>Date Started: <?php echo format_date($lc['dateStarted']); ?> </td>
         
      </tr>
                <tr>
  
          <td>Date Finished:
          <?php if($lc['dateFinished'] != NULL):?>
              <?php echo format_date($lc['dateFinished']); ?>
          <?php else:?>
              <?php echo 'Learner not done with course yet'; ?>
          <?php endif; ?>
          </td>
      </tr>

      </table>
      <div style="margin-left: 10px">
         <h3> <i class=" icon-time" style="margin-top:4px"></i>Module Duration </h3>
         </div>
        <table border="0" class="borderless">
          
          <th>Module Title</th>
          <th>Date Started</th>
          <th>Module Duration</th>
         
           <?php foreach($cMods->$lc['title'] as $a): ?>
            <?php foreach($a as $mods):?>
                <tr>
                    <td> <?php echo $mods['title']; ?> </td>
                    <td><?php echo format_date($mods['dateStarted']); ?></td>
                    <?php foreach($dura->$mods['title'] as $b): ?>
                        <?php foreach($b as $duration):?>
                               <td>
                             <?php if($duration['dateFinished'] != '' ) :?>
                <?php $start = new DateTime($duration['dateStarted']); ?>
                <?php $end = new DateTime($duration['dateFinished']); ?>
                    
               <?php if($end->diff($start)->format("%m") > 0):?>     
                    <?php if($end->diff($start)->format("%m") == 1 || $end->diff($start)->format("%m") == 0): ?> 
                        <?php echo $end->diff($start)->format("%m").' month' ?>
                    <?php else: ?>
                        <?php echo $end->diff($start)->format("%m").' months' ?>
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
                        <?php else: ?>
                        <?php echo 'Module not done yet' ?>
                <?php endif ?></td>
                        <?php endforeach; ?>
                    <?php endforeach; ?>

                </tr>
            <?php endforeach;?>
          <?php endforeach;?>
          
      </table>
      
      <hr>
      <script type="text/javascript">
$(function () {
        $('#graph<?php echo $lc['id']; ?>').highcharts({
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Self-Checks'
            },
            subtitle: {
                text: '<?php echo $lc['title']; ?>'
            },
            xAxis: {
                categories:[
                    <?php foreach($modSC->$lc['title'] as $msc): ?>
                        <?php foreach($msc as $scM):?>
                          <?php echo "'". $scM['title']."(".$scM['noOfItems'].' items'.")"."',"?><?php endforeach; ?><?php endforeach; ?>
                    ],title: {
                    text: 'Self-Checks'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Score',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
            },
            
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -100,
                y: 100,
                floating: true,
                borderWidth: 1,
                backgroundColor: '#FFFFFF',
                shadow: true
            },
            credits: {
                enabled: false
            },
            series: [{
                name: 'Score',
                data: [<?php foreach($modSC->$lc['title'] as $msc): ?>
                        <?php foreach($msc as $scM):?>
                          <?php echo $scM['result'].","?><?php endforeach; ?><?php endforeach; ?>]
            } ]
        });
    });
    

		</script>
                
      <div style="margin-left: 10px">
          <h3> <i class=" icon-check" style="margin-top:4px"></i>Self-Check </h3>
      </div>
                
                <div id="graph<?php echo $lc['id']; ?>" style="width:90%"></div>
      <table border="0" class="borderless">
          <th>Module Title</th>
          <th>Date Taken</th>
          <th>No. of Attempts</th>
          <th>Rating</th>
          <th></th>
          <?php foreach($modSC->$lc['title'] as $msc): ?>
            <?php foreach($msc as $scM):?>
          <tr>
              <td> <?php echo $scM['title'] ?></td>
              <td><?php echo format_date($scM['dateTaken']); ?></td>
              <?php foreach($scAttempt->$scM['title'] as $scm): ?>
                  <?php foreach($scm as $scAt):?>
                    <td><span class="label label-info"> 
                            <?php echo $scAt['count']; ?></span>
                    </td>
                  <?php endforeach; ?>
              <?php endforeach; ?>
              <td><?php echo $scM['remarks'] ?></td>
              <td><a class="btn blue cboxElement modal" href="<?php echo site_url('admin/statistics/viewHistory?var1='.$lc['learnerID'].'&var2='.$scM['id'])?>"> View History</a></td>
              
          </tr>
            <?php endforeach; ?>
          <?php endforeach; ?>
          
      </table>
      
      <hr>
      <div style="margin-left: 10px">
          
          <h3> <i class=" icon-list" style="margin-top:4px"></i>Online Assessment 
              <?php foreach($oaRes->$lc['title'] as $oar): ?>
                  <?php foreach($oar as $resOA):?>
         <?php if(($resOA['result']/$resOA['noOfItems'])*100 >= 60):?>    <small><span class="label label-success">Passed</span></small> <?php endif ?>
          <?php endforeach ?>
          <?php endforeach ?></h3>
      <div class="one_third" style="float:left"> 
          
    
          <span class="label label-info">Total Score:</span>
          <?php foreach($oaRes->$lc['title'] as $oar): ?>
                  <?php foreach($oar as $resOA):?>
                        <h2><?php echo $resOA['result']; ?>/<?php echo $resOA['noOfItems']; ?> or <?php echo ($resOA['result']/$resOA['noOfItems'])*100 ?>%</h2>
                  <?php endforeach;?>
          <?php endforeach;?>
      </div>
      <div class="one_half" style="float:left">
          <table class="borderless">
              <tbody>
                   
                  <?php foreach($oaRes->$lc['title'] as $oare): ?>
                    <?php foreach($oare as $resultOA):?>
            
                    <?php endforeach;?>
                  <?php endforeach;?>
                  <?php $sCount = 1; ?>
                  <?php foreach($oaSect->$lc['title'] as $oas): ?>
                    <?php foreach($oas as $sectOA):?>
                        <tr> <td> Section <?php echo $sCount ?> Score:</td><td> <?php echo $sectOA['result']?>/<?php echo $sectOA['noOfItems'] ?></td></tr>
                        <?php $sCount += 1; ?>
                    <?php endforeach; ?>
                  <?php endforeach; ?>
              </tbody>
          </table>
      </div>

       
        
      </div>
      <!-- skill competency-->
      <hr>
    
          
     
  </div>
                  <?php endforeach; ?>
  
</div>
                 
        
   
          
     
            
    </div>
      </div>