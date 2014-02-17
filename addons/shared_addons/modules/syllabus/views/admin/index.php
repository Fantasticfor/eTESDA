<div class="one_full">
 
    <section class="title blue "> <h4><strong> Choose a Sector</strong> </h4></section>    
    <section class="item">
        
        <div class="content" >   
        <table cellspacing="0" class="tablesorter" id="sortTable"  >
		<thead>
			<tr>
				
                            <th width="35%"> Sector Title </th>
                                <th width="30%"> Date Created </th>
				<th width="35%"></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($sectorlist as $sector) : ?>
				<tr>
                                    <td> <strong><?php echo $sector['title']  ?> </<strong></td>
                                        <td><strong><?php echo format_date($sector['created']) ?> </strong></td>
					<td style="padding-top:10px;">
                                            <a href="<?php echo site_url('admin/syllabus/create_course/'.$sector['ID'])?>" title="<?php echo lang('global:preview')?>" class="btn blue small  " ><?php echo 'Create Course'?> </a>    
                                            <a href="<?php echo site_url('admin/syllabus/viewSector/'.$sector['ID'])?>" title="<?php echo lang('global:preview')?>" class="btn gray small" ><?php echo 'View Sector'?> </a>
                                                
						<a href="<?php echo base_url()."admin/syllabus/editSector/".$sector['ID']?>" class="btn gray small"><?php echo lang('global:edit')?></a>
						 <a href="<?php echo site_url('admin/syllabus/deleteSector/'.$sector['ID'])?>" class="btn gray confirm small"> Delete</a>
					</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>

      <div class="pager" id="pager">
<form>
    <?php echo Asset::img('module::first.png', 'alt text', array('class' => 'first')); ?>
    <input type="text" class="pagedisplay"/>
    <?php echo Asset::img('module::next.png', 'alt text', array('class' => 'next')); ?>
    <?php echo Asset::img('module::last.png', 'alt text', array('class' => 'last2')); ?>
  
 
  <select class="pagesize">
    <option selected="selected"  value="10">10</option>
    <option value="20">20</option>
    <option value="30">30</option>
    <option  value="40">40</option>
  </select>
</form>
        </div>
        </div>

        
    </section>
    
    
    </div>
    
