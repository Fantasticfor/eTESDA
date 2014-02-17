<div class="container offsetdown" >
<div class="span13">
      <ul class="breadcrumb">
  <li><a href="<?php echo base_url()."learner/test"?>"> Test</a> <span class="divider">/</span></li>
  <li class="active"><?php echo $course[0]['title']; ?>'s Online Assessment</li>
</ul>
    <div class="span11">
        <input type="hidden" id="baseurl" value='<?php echo base_url()?>' >
        <h4> <?php echo $course[0]['title']; ?>'s Online Assessment</h4>
        <hr>
        <div class="well">
	<table class="table table-striped">
            <tbody>
                <th>Date Taken </th>
                <th > Total Score</th>
                
                 <th> </th>
                 <th> </th>
                <?php foreach($allOA as $aoa): ?>
                    <?php if($aoa['remarks'] == 'Failed'): ?>
                <tr class="warning">
                    <td><?php echo format_date($aoa['dateTaken']); ?></td>
                    <td> <?php echo $aoa['result']; ?>/<?php echo $aoa['noOfItems']; ?></td>
                  
                   <td> <label class="text-error"> Failed</label></td>
                    <td> <a class="btn btn-primary viewRes" href="#OA_modal" data-id="<?php echo $aoa['resultID']; ?>"  data-toggle="modal"> View Section Results</a></td>
                </tr>
                <?php else: ?>
                
                <tr class="success">
                    <td><?php echo format_date($aoa['dateTaken']); ?></td>
                    <td> <?php echo $aoa['result']; ?>/<?php echo $aoa['noOfItems']; ?></td>
                    <td> <label class="text-success"> Passed</label></td>
                   <td> <a class="btn btn-primary viewRes" href="#OA_modal" data-id="<?php echo $aoa['resultID']; ?>"  data-toggle="modal"> View Section Results</a></td>
                </tr>
                        <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
</div>
    
    
    </div>
    </div>


  <div class="modal hide fade" id="OA_modal">
  <div class="modal-header" style="height:20px " >
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    
  </div>
  <div class="modal-body" style="overflow:scroll; max-height:300px">
      <h3> </h3>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
  
  </div>
</div>