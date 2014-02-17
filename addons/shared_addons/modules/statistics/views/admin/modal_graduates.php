
<div style='height:400px; overflow-y:auto'>
   <?php foreach($courseEnr as $ce): ?>
    <hr style="margin-top:0px">
    
    
    <div class="media">
              <a style="float:left; margin-right: 15px">
                 <?php echo Asset::img('default_display.png', 'alt text',array('width'=>70, 'height'=> 64));?>                                                                                                                             
              </a><div class="media-body"><a style="float:left; margin-right: 15px">
                  </a>
                  <strong class="media-heading"><a style="float:left; margin-right: 15px"> </a><a href="<?php echo site_url('admin/statistics/viewLearnerProfile/'.$ce['learnerID']);?>"><?php foreach($enrNames[$ce['learnerID']] as $en): ?><?php echo $en['name'] ?><?php endforeach ?></a> 
                  </strong> 
                  <p style="margin-top:10px">
                     
                      <em> Date Started: </em><?php echo format_date($ce['dateStarted']) ?><br><br>
                      <em> Date Finished: </em><?php echo format_date($ce['dateFinished']) ?>   
              </p>
              </div>
            </div>
    
    
    <?php endforeach; ?>
    <hr style="margin-top:0px">
 </div>