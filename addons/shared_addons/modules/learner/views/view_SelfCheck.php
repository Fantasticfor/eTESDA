<div class="container offsetdown" >
<div class="span13">
      <ul class="breadcrumb">
  <li><a href="<?php echo base_url()."learner/test"?>"> Test</a> <span class="divider">/</span></li>
  <li class="active"><?php echo $course[0]['title']; ?>'s Self-Check</li>
</ul>
    <div class="span13">
        <input type="hidden" id="baseurl" value='<?php echo base_url()?>' >
        <h4> <?php echo $course[0]['title']; ?>'s Self-Checks</h4>
        <hr>
        <div class="well">
	<table class="table table-striped">
            <tbody>
                <th>Self-Check</th>
                <th > Recent Score</th>
                <th > No of Attempts </th>
                <th> Last Date Taken </th>
                 <th> </th>
                 <th> </th>
                
                    <?php foreach($latSC as $lsc):?>
                   
                        <?php foreach($lsc as $modLat):?>
                  <?php if($modLat['remarks'] == 'Passed'):?>
                  <tr class="success">
                            <td></i><?php echo $modLat['title'];?></td>
                            <td> <?php echo $modLat['result']; ?>/<?php echo $modLat['noOfItems']; ?></td>
                       
                            
                    <?php foreach($attempts->$modLat['title'] as $at):?>
                        <?php foreach($at as $att): ?>
                            <td><span class="label label-info"> <?php echo $att['count']; ?></span></td>
                        <?php endforeach;?>
                    <?php endforeach;?>
                    
                            <td><?php echo format_date($modLat['dateTaken']); ?></td>
                                    <td> <label class="text-success"> Competent</label></td>
                                
                            <td> <a class="btn btn-primary viewHistory" data-toggle="modal"  data-id="<?php echo $modLat['id']?>" href="#modalViewHistory">View History</a></td>
                            </tr>     
                            
                            
                     <?php else: ?>
                            <tr class="warning">
                            <td></i><?php echo $modLat['title'];?></td>
                            <td> <?php echo $modLat['result']; ?>/<?php echo $modLat['noOfItems']; ?></td>
                       
                            
                    <?php foreach($attempts->$modLat['title'] as $at):?>
                        <?php foreach($at as $att): ?>
                            <td><span class="label label-info"> <?php echo $att['count']; ?></span></td>
                        <?php endforeach;?>
                    <?php endforeach;?>
                    
                            <td><?php echo format_date($modLat['dateTaken']); ?></td>
                            <td> <label class="text-error"> Needs review</label></td>
                            <td> <a class="btn btn-primary viewHistory" data-toggle="modal"  data-id="<?php echo $modLat['id']?>" href="#modalViewHistory">View History</a></td>
                            </tr>     
                            
                            <?php endif; ?>
                           <?php endforeach; ?>
                         
                    <?php endforeach; ?>
                
                            
            </tbody>
        </table>
        </div>
</div>
    
    
    </div>
    </div>


    
<div id="modalViewHistory" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header" style="height: 20px">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    
  </div>
  <div class="modal-body" style="overflow:scroll; max-height:300px">
 
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
  
  </div>
</div>