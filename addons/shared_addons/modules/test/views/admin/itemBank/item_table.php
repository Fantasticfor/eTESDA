
            <?php $ctr = 0; ?>
           <?php if(empty($modulelist)): ?>
           
           <?php else: ?>
            <?php foreach($modulelist as $module): ?>
            <?php print_r($itemcount); ?> 
            <?php print_r($modulelist); ?>
             <tr>
                 <td><?php echo $module['title']?></td>
                 <td> <span class="label label-info"><?php echo $itemcount[$ctr] ?></span></td>
                 <td><a class="btn blue" href="<?php echo site_url('admin/test/viewItems/'.$module['id'])?>"> View Items</a>
                 <a class="btn green" href="<?php echo site_url('admin/test/addItem/'.$module['id'] ) ;?>"> Add Items</a></td>
             </tr>
              <?php $ctr++; ?>
           <?php              endforeach; ?>
           <?php endif; ?>
             
          
         