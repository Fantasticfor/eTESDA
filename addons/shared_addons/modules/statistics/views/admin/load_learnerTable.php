
<?php foreach($learnList as $ll):?>
<tr>
                        <td><?php echo $ll['learnerID'] ?> </td>
                      
                        <td>
                            <?php foreach($enrNames[$ll['learnerID']] as $en):?>
                            <?php echo $en['name'] ?>
                            <?php endforeach; ?>
                        </td>
                    
                        <td><?php foreach($enrCount[$ll['learnerID']] as $ec):?><a class="badge badge-info" ><?php echo $ec['count'] ?></a><?php endforeach; ?></td>
                        <td><?php foreach($gradCount[$ll['learnerID']] as $eg): ?> <a class="badge badge-success"><?php echo $eg['count'] ?></a><?php endforeach; ?></td>
                         <td> <a class="btn blue" href="<?php echo site_url('admin/statistics/viewLearnerProfile/'.$ll['learnerID']); ?>">View Profile</a></td>
</tr>
<?php endforeach; ?>