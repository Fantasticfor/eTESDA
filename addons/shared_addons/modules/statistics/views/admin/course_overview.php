<div class="one_full">
  <ul id="breadcrumbs-one">
		
		<li><a href="<?php echo site_url('admin/statistics/index');?>" > Course and Test Statistics</a></li>
		<li><a href="" class="current"> <?php echo $cTitle ?> Overview </a></li>
		
	</ul>
     
    </div>
<div class="one_full">
   
       
<section class="title blue">
    <h4><strong> <?php echo $cTitle ?> Overview</strong></h4>
</section>

  <section class="item" style="padding:10px">
      
       <div class="content tabs" style="padding:25px">
        <ul class="tab-menu">
            <li style="font-size: 10pt"><a href="#sum"><small>Summary of Learners</small></a> </li>
		<li style="font-size: 10pt"><a href="#detail"><small>Module Overview</small></a></li>
	</ul>
         <div id="sum"> 
          <table width="100%">
          <thead>
              <tr>
                  <th width="25%"> Learner Name</th>
                  <th width="5%"> <center>Age</center></th>
                  <th width="15%"> <center>Country</center></th>
                  <th width="14%"> <center>Date Enrolled</center></th>
                  <th width="14%"> <center>Date Finished</center></th>
                  <th width="15%"> <center>Course Duration</center></th>
                  <th width="15%"> <center>Current Status</center></th>
                 
              </tr>
          </thead>
          <tbody>
                <?php foreach ($allLearners as $al): ?>
              <tr>
                 
                     <td> <a href="<?php echo site_url('admin/statistics/courseLearnerProfile/'.$al['learnerID']); ?>" style="color:#22688E"><?php foreach($enrNames[$al['learnerID']] as $en): ?><?php echo $en['name']?> <?php endforeach; ?></a></td>
                  <td> <center><?php foreach($enAge[$al['learnerID']] as $ea): ?><?php echo $ea['age']?> <?php endforeach; ?></center></td> 
                  <td> <center><?php foreach($enCountry[$al['learnerID']] as $ec): ?><?php echo $ec['country']?> <?php endforeach; ?></center></td> 
          <?php foreach($enDets[$al['learnerID']] as $ed):?>       
          <td> <center><?php echo format_date($ed['dateStarted']) ?></center></td> 
          <td> <center><?php if($ed['dateFinished'] != NULL):?><?php echo format_date($ed['dateFinished']) ?><?php else:?> <?php echo 'Not done with course' ?><?php endif ?></center> </td> 
          <td><center>
              
              <?php if($ed['dateFinished'] != '' ) :?>
                <?php $start = new DateTime($ed['dateStarted']); ?>
                <?php $end = new DateTime($ed['dateFinished']); ?>
          
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
              <?php else:?>
              <?php echo 'Not done with course' ?>
                <?php endif ?>
          </center></td> 
          <td> <center><?php if($ed['status'] == 1): ?><?php echo 'Following Course' ?> <?php elseif($ed['status'] == 2):?> <?php echo 'Ready for Assessment' ?>  <?php elseif($ed['status'] == 3):?><?php echo 'Candidate for Certification'?> <?php endif ?></center> </td> 
          <?php endforeach; ?>       
                  

              </tr>
              
          </tbody>
            <?php endforeach; ?>
      </table>
         </div>
        <div id="detail"> 
            <table>
          <thead>
              <tr>
                  <th> Learner Name</th>
                  <!--Module start here-->
                  <?php foreach ($cMods as $cm):?>
                      <th>
                      <center><?php echo $cm['title'] ?></center> 
                      </th>
                  <?php endforeach; ?>
              </tr>
          </thead>
          <tbody>
               <?php foreach ($allLearners as $al): ?>
              <tr>
                 
                  <td> <a href="<?php echo site_url('admin/statistics/courseLearnerProfile/'.$al['learnerID']); ?>" style="color:#22688E"><?php foreach($enrNames[$al['learnerID']] as $en): ?><?php echo $en['name']?> <?php endforeach; ?></a></td>
                  <?php foreach($cMods as $cm):?>
                  <td>
                    <?php if(!empty($ratings[$al['learnerID']][$cm['id']])): ?>  
                    <?php foreach($ratings[$al['learnerID']][$cm['id']] as $rat1):?>
                      <label class=" <?php echo $rat1['remarks'] ?>">
                        <center><?php echo $rat1['remarks'] ?></center>
                          </label>
                    <?php endforeach; ?>
                    <?php endif; ?>
                  </td>
                  <?php endforeach; ?>
<!--                  <td style="background:lightgreen"> Pass</td>
                  <td> <a class="modal smallerCbox" href="">Pass </a> </td>
                  <td> </td>
                  <td style="background:lightcoral"> Fail</td>-->
              </tr>
                <?php endforeach; ?>
          </tbody>
          
      </table>
  
        </div>
         </div>
      
      
       
        </section>
    

       
</div>
   