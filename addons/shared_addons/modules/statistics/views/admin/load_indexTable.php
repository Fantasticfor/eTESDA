                                <?php if($courses==null):?>

    <h5> No Courses yet</h5>


<?php else:?>
 <?php foreach($courses as $cl): ?>
<tr>
					          
                                        <td><?php echo $cl['title'] ?><?php if($cl['status'] == 'draft'): ?><?php echo ' (Draft)' ?><?php endif ?></td>
                                        <?php foreach($noOfEnrolled[$cl['id']] as $ne): ?><td> <a href="<?php echo site_url('admin/statistics/modal_learners/'.$cl['id']);?>" title=" <?php echo $ne['count'] ?> learners " style="color:white" class="smallerCbox modal label label-success viewL"> <?php echo $ne['count'] ?> Enrollees </a></td><?php endforeach ?>
                                        
                                        <td>    <?php foreach($inactCount[$cl['id']] as $ic): ?><a href="<?php echo site_url('admin/statistics/modal_inactives/'.$cl['id']);?>" title=" <?php echo $ic?> inactive learners" style="color:white" class=" smallerCbox modal label label-warning"> <?php echo $ic?> Inactive</a> <?php endforeach; ?></td> 
                                        
                                        
                                         <?php foreach($gradCount[$cl['id']] as $gc): ?> <td> <a href="<?php echo site_url('admin/statistics/modal_graduates/'.$cl['id']);?>" title=" <?php echo $gc['count'] ?> graduates" style="color:white" class=" smallerCbox modal label label-info"><?php echo $gc['count'] ?> Graduates </a></td><?php endforeach ?>
                                         <td><?php foreach($avgDur[$cl['id']] as $avg): ?><?php if($avg['avg'] == 0):?><?php echo 'N/A' ?> <?php else:?> <?php echo $avg['avg'] ?> days  <?php endif ?><?php endforeach ?> </td>
                                         
                                        <td>
                                        <a class="btn blue" href="<?php echo site_url('admin/statistics/testList/'.$cl['id'])?>"> View Test Statistics</a> 
                                        <a class="btn blue" href="<?php echo site_url('admin/statistics/courseOverview/'.$cl['id'])?>"> Course Overview</a> 
                                        <!--<a class="btn blue"  href="<?php// echo site_url('admin/statistics/learnerList/'.$cl['id']); ?> " > View Learners </a>-->
                                        </td>
                                        
                                        
                                            
					
				
				
				</tr>
	<?php endforeach;?>	
<?php endif?>
                                