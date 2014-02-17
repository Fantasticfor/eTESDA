<div class="one_full">
<section class="title blue">
    <h4> <strong>Course and Test Statistics </strong></h4>
</section>

  <section class="item">
 <div style="margin:10px 10px 10px 10px; ">  
      <fieldset id="search">
	<legend>Filter </legend>
        
    <?php
    $att2 = 'id="select_sector"';
    echo form_dropdown('',$sectors,'',$att2)?> 
        
      </fieldset>  
       <table cellspacing="0" class="tablesorter" id="sortTableBas" >
		<thead>
			<tr>
				
</th>
				<th> Courses</th>
                               
                                <th >Enrolled </th>
                                <th >Inactive</th>
                                <th >Graduates</th>
                                <th >Avg Duration</th>
				
				<th ></th>
			</tr>
		</thead>
               
                <tbody id="body_table">
                    <?php foreach($courses as $cl): ?>
<tr>
					          
                                        <td><?php echo $cl['title'] ?><?php if($cl['status'] == 'draft'):?><?php echo ' (Draft)'?> <?php endif ?></td>
                                        <?php foreach($noOfEnrolled[$cl['id']] as $ne): ?><td> <a href="<?php echo site_url('admin/statistics/modal_learners/'.$cl['id']);?>" title=" <?php echo $ne['count'] ?> learners" style="color:white" class="smallerCbox modal label label-success viewL"> <?php echo $ne['count'] ?> Enrollees </a></td><?php endforeach ?>
                                        
                                        <td>    <?php foreach($inactCount[$cl['id']] as $ic): ?><a href="<?php echo site_url('admin/statistics/modal_inactives/'.$cl['id']);?>" title="<?php echo $ic ?> inactive learners" style="color:white" class=" smallerCbox modal label label-warning"> <?php echo $ic?> Inactive</a> <?php endforeach; ?></td> 
                                        
                                        
                                         <?php foreach($gradCount[$cl['id']] as $gc): ?> <td> <a href="<?php echo site_url('admin/statistics/modal_graduates/'.$cl['id']);?>" title=" <?php echo $gc['count'] ?> graduates" style="color:white" class=" smallerCbox modal label label-info"><?php echo $gc['count'] ?> Graduates </a></td><?php endforeach ?>
                                         <td><?php foreach($avgDur[$cl['id']] as $avg): ?><?php if($avg['avg'] == 0):?><?php echo 'N/A' ?> <?php else:?> <?php echo $avg['avg'] ?> days  <?php endif ?><?php endforeach ?> </td>
                                         
                                        <td>
                                        <a class="btn blue" href="<?php echo site_url('admin/statistics/testList/'.$cl['id'])?>"> View Test Statistics</a> 
                                        <a class="btn blue" href="<?php echo site_url('admin/statistics/courseOverview/'.$cl['id'])?>"> Course Overview</a> 
                                        <!--<a class="btn blue"  href="<?php// echo site_url('admin/statistics/learnerList/'.$cl['id']); ?> " > View Learners </a>-->
                                        </td>
                                        
                                        
                                            
					
				
				
				</tr>
	<?php endforeach;?>		
                    
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
    