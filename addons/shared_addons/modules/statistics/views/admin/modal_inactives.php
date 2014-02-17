
<div style='height:400px; overflow-y:auto'>
   <?php foreach($courseIn as $ci): ?>
    <hr style="margin-top:0px">
    
    
    <div class="media">
              <a style="float:left; margin-right: 15px">
                 <?php echo Asset::img('default_display.png', 'alt text',array('width'=>70, 'height'=> 64));?>                                                                                                                             
              </a><div class="media-body"><a style="float:left; margin-right: 15px">
                  </a>
                  <strong class="media-heading"><a style="float:left; margin-right: 15px"> </a><a href="<?php echo site_url('admin/statistics/viewLearnerProfile/'.$ci['learnerID']);?>"><?php foreach($enrNames[$ci['learnerID']] as $en): ?><?php echo $en['name'] ?><?php endforeach ?></a> 
                  </strong> 
                  <p style="margin-top:10px">
                     
                      <span class="label label-success"><?php if($ci['status'] == 1): ?><?php echo 'Following Course' ?> <?php elseif($ci['status'] == 2):?> <?php echo 'Ready for Assessment' ?> <?php elseif($ci['status'] == 3):?><?php echo 'Candidate for Certification'?> <?php endif ?> </span>
                      <br>
                      <em> Date Started:</em><?php echo format_date($ci['dateStarted']) ?>
                      <br>
                      <br>
                      Inactive in: <?php echo $ci['title'] ?> Module  
              </p>
              </div>
            </div>
    
    
    <?php endforeach; ?>
    <hr style="margin-top:0px">
 </div>