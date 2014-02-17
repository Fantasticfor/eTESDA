<?php foreach($learners as $lr):?>
<tr>
  <td><?php echo $lr['userid'] ?> </td>
                      
                        <td>
                            <?php foreach($enrNames[$lr['userid']] as $en):?><?php echo $en['name']; ?> <?php endforeach; ?>
                        </td>
                    
                        <td><?php foreach($enrCount[$lr['userid']] as $ec):?><a class="badge badge-info" ><?php echo $ec['count'] ?></a><?php endforeach; ?></td>
                        <td><?php foreach($grCount[$lr['userid']] as $gc):?> <a class="badge badge-success"><?php echo $gc['count'] ?></a><?php endforeach; ?></td>
                         <td> <a class="btn blue" href="<?php echo site_url('admin/statistics/viewLearnerProfile/'.$lr['userid']); ?>">View Profile</a></td>
 
</tr>
<?php endforeach; ?>