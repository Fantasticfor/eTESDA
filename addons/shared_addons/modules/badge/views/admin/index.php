<section class="title blue">
    <h4><strong>View All Badges</strong>
        <small style="float:right;margin-top: -10px;margin-right: 10px;"> <a class="btn blue" href="<?php echo site_url('admin/badge/addBadge');?>"> Add New Badge</a></small>
    </h4>
    
    
</section>

<section class="item">
    <div class="content" style="padding-left:50px; padding-right:50px;">
        	
        <table>
            <thead>
                <tr>
                <th>Badge Name</th>
                <th width="100px"> Date Created</th>
                <th> Activity </th>
                <th>Image</th>
                <th width=100px"></th>
                </tr>
            </thead>
            
            <tbody>
                <?php foreach($badges as $badge): ?> 
                <tr>
                    <td><?php echo $badge['name'] ?> </td>
                    <td> <?php echo format_date($badge['created']) ?> </td>
                    <td><?php echo $badge['activity'] ?> </td>
                    <td>  <img class="media-object" src="<?php echo base_url().'files/thumb/'.$badge['image'];?>" alt="" data-src="holder.js/128x128" >  </td>
                    <td> <a class="btn gray small smallerCbox modal " style="text-align:center" href="<?php echo site_url('admin/badge/ajax_edit/'.$badge['id'])?>" > Edit </a>
                        <?php if($badge['status'] == 0): ?>
                        <a class="btn red small" href="<?php echo site_url('admin/badge/flagBadge/'.$badge['id']) ?>">Flag</a>
                        <?php else: ?>
                          <a class="btn green small" href="<?php echo site_url('admin/badge/unflagBadge/'.$badge['id']) ?>">Unflag</a>
                        <?php endif; ?>
                        
                    </td>
                </tr>
                <?php  endforeach; ?>
            </tbody>
        </table>
        
    </div>
</section>