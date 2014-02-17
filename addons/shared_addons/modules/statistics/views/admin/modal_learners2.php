<?php if($type == 1): ?>

<div style='height:400px; overflow-y:auto'>
<?php foreach($modInfo as $mi):?>
    <hr style="margin-top:0px">
    
    
    <div class="media">
              <a style="float:left; margin-right: 15px">
                 <?php echo Asset::img('default_display.png', 'alt text',array('width'=>70, 'height'=> 64));?>                                                                                                                             
              </a><div class="media-body"><a style="float:left; margin-right: 15px">
                  </a>
                  <strong class="media-heading"><a style="float:left; margin-right: 15px"> </a><a href="<?php echo site_url('admin/statistics/viewLearnerProfile/'.$mi['learnerID']) ?>"><?php foreach($learnN[$mi['learnerID']] as $ln): ?><?php echo $ln['name'] ?> <?php endforeach; ?></a> 
                  </strong> 
                  <p style="margin-top:10px">
                      <span class="label label-success"><?php if($mi['status']==1):?><?php echo 'Following Course'?> <?php elseif($mi['status']==2):?><?php echo 'Ready For Assessment' ?> <?php elseif($mi['status'] == 3):?><?php echo 'Candidate for Certification'?>  <?php endif; ?> </span>
                      <br>
                      <br>
                      <em> Date Started: </em><?php echo format_date($mi['dateStarted']) ?>
                         
              </p>
              </div>
            </div>
    
    

    <hr style="margin-top:0px">
    <?php endforeach; ?>
 </div>

<?php elseif($type == 2):?>

<div style='height:400px; overflow-y:auto'>
<?php foreach($modInfo as $mi):?>
    <hr style="margin-top:0px">
    
    
    <div class="media">
              <a style="float:left; margin-right: 15px">
                 <?php echo Asset::img('default_display.png', 'alt text',array('width'=>70, 'height'=> 64));?>                                                                                                                             
              </a><div class="media-body"><a style="float:left; margin-right: 15px">
                  </a>
                  <strong class="media-heading"><a style="float:left; margin-right: 15px"> </a><a href="<?php echo site_url('admin/statistics/viewLearnerProfile/'.$mi['learnerID']) ?>"><?php foreach($learnN[$mi['learnerID']] as $ln): ?><?php echo $ln['name'] ?> <?php endforeach; ?></a> 
                  </strong> 
                  <p style="margin-top:10px">
                      
                      <em> Date Started: </em><?php echo format_date($mi['dateStarted']) ?>
                      <br>
                      <br>
                      <em> Date Finished: </em><?php echo format_date($mi['dateFinished']) ?>
                         
              </p>
              </div>
            </div>
    
    

    <hr style="margin-top:0px">
    <?php endforeach; ?>
 </div>

<?php elseif($type == 3):?>
<div style='height:400px; overflow-y:auto'>
<?php foreach($modInfo as $mi):?>
    <hr style="margin-top:0px">
    
    
    <div class="media">
              <a style="float:left; margin-right: 15px">
                 <?php echo Asset::img('default_display.png', 'alt text',array('width'=>70, 'height'=> 64));?>                                                                                                                             
              </a><div class="media-body"><a style="float:left; margin-right: 15px">
                  </a>
                  <strong class="media-heading"><a style="float:left; margin-right: 15px"> </a><a href="<?php echo site_url('admin/statistics/viewLearnerProfile/'.$mi['learnerID']) ?>"><?php foreach($learnN[$mi['learnerID']] as $ln): ?><?php echo $ln['name'] ?> <?php endforeach; ?></a> 
                  </strong> 
                  <p style="margin-top:10px">
                      <span class="label label-success"><?php if($mi['status']==1):?><?php echo 'Following Course'?> <?php elseif($mi['status']==2):?><?php echo 'Ready For Assessment' ?> <?php endif; ?> </span>
                      <br>
                      <br>
                      <em> Date Started: </em><?php echo format_date($mi['dateStarted']) ?>
                      <br>
                      <br>
                       Inactive in: <?php echo $mi['title'] ?>
                         
              </p>
              </div>
            </div>
    
    

    <hr style="margin-top:0px">
    <?php endforeach; ?>
 </div>
<?php endif; ?>
