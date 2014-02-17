
         <?php foreach($modulelist as $module): ?>

                                  <tr>
                                    
                                     <?php if(empty($module['details'])&&empty($module['type'])): ?>
                                     <td><?php echo $module['title'] ?></td>
					<td>No items yet</td>
					<td>-</td>
                                        <td>-</td>
					<td>-</td>
                                        <td><a href="<?php echo site_url('admin/test/testBank/addSelfCheck/'.$module['HeirarchyID'] ) ;?>" class="btn blue">Create Test</a></td>
                                     
                                     
                                        <?php else: ?>
					                                   
					<td><?php echo $module['title'] ?></td>
					<td><?php echo $module['details']->noOfItems ?></td>
					<td><?php echo $module['type'] ?></td>
                                        <td> <?php echo$module['details']->display_name ?></td>
                                        <td><?php echo format_date($module['details']->dateModified) ?></td>
                                        <td><a href="<?php echo SITE_URL('admin/test/testBank/viewSelfCheck/'.$module['HeirarchyID']); ?>" class="btn gray cboxElement modal">Edit Test</a></td>
                                        
				</tr>
                                <?php endif; ?>
                                <?php        endforeach; ?>
          
         