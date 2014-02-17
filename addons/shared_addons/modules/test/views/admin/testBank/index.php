
				<div class="one_full">
                                       <section class="title blue">
		<h4>Test Bank</h4>
	</section>
                                    <section class="item">
 <div class="content tabs">
        <ul class="tab-menu">
            <li><a href="#oa"><span>Online Assessments</span></a> </li>
		<li><a href="#selfcheck"><span>Self-Checks</span></a></li>
	</ul>
     <div id="oa">
     
    <div style="margin:10px 10px 10px 10px; ">  
   
       <table class="tablesorter" id="sortTable" cellspacing="0">
            
		<thead>
			<tr>

				
                                <th class="collapse"> Test Name</th>
                               <th class="collapse header">Items</th>
				<th class="collapse">Created By</th>
				<th class="collapse">Last Modified</th>
				
				<th width="250" class=" "></th>
			</tr>
		</thead>
		<tbody>
                    <?php foreach($courselist as $course): ?>
				<tr>
				              <td><?php echo $course['title'] ?></td>
                                              
                                              <?php if(empty($course['details'])): ?>
                                              <td>No items yet</td>
                                              <td>None</td>
                                              <td>None</td>
                                               <td style="padding-top:10px;">
                                              <a href="<?php echo site_url('admin/test/testBank/addOATest/'.$course['id'] ) ;?>" class="btn blue">Create Test</a>
                                               </td>
                                               
                                              <?php else: ?>
                                               <td><span class="label label-info"> <?php echo $course['details']->noOfItems ?> item/s</span></td>
                                        
                                              <td> <?php echo $course['details']->display_name?></td>
                                        <td > <?php echo format_date( $course['details']->dateModified) ?></td>
                                        <td style="padding-top:10px;">
                                      
                                                <a href="<?php echo site_url('admin/test/testBank/viewOnlineAssessment/'.$course['details']->courseID ) ;?>" class="btn gray">View Test</a>
						<a href="<?php echo site_url('test/previewOA/'.$course['details']->courseID) ;?>" class="btn gray" target="_blank">Preview</a>
                                        <?php endif; ?>
                                        </td>
                                        
                                </tr>
                                
                   <?php endforeach; ?>          
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
       
        </div>
     
     <div id="selfcheck">
       
         <div style="margin:10px 10px 10px 10px; ">  
      <fieldset id="filters">
	<legend>Filters</legend>
<ul style="float:left;" >
			

			<li style="display:inline-block;margin-left:20px">
        		<label for="f_course">Course</label>
                        <?php $att2 = 'name ="select_Course", id="select_Course1", class="select_Course"'; 
                                             echo form_dropdown('',$courselists,'',$att2) ?>
                            
       			</li>

		</ul>
	</fieldset>  
       <table  class="tablesorter" id="sortTable2" cellspacing="0">
		<thead>
			<tr>
			<th> Test Name</th>
                        <th> Items </th>
                        <th> Item Type </th>
                        <th>Created By</th>
			<th>Last Modified</th>
			<th width="280"> </th>
			</tr>
		</thead>
                
		 <tbody id="item_table">
                     <?php foreach($modulelist as $module): ?>
                                 <tr>
                                     <?php if(empty($module['details'])&&empty($module['type'])): ?>
                                     <td><?php echo $module['title'] ?></td>
					<td>No items yet</td>
					<td>None</td>
                                        <td>None</td>
					<td>None</td>
                                        <td><a href="<?php echo site_url('admin/test/testBank/addSelfCheck/'.$module['id'] ) ;?>" class="btn blue">Create Test</a></td>
                                     
                                     
                                     <?php else: ?>
					                                   
					<td><?php echo $module['title'] ?></td>
                                        <td><span class="label label-info"> <?php echo $module['details']->noOfItems ?> item/s </span></td>
					<td><?php echo $module['type'] ?></td>
                                        <td> <?php echo$module['details']->display_name ?></td>
                                        <td><?php echo $module['details']->lastModified ?></td>
                                        <td><a href="<?php echo SITE_URL('admin/test/testBank/viewSelfCheck/'.$module['id']); ?>" class="btn gray cboxElement modal edit">Edit Test</a>
                                          <a href="<?php echo site_url('test/previewSC/'.$module['id']) ;?>" class="btn gray" target="_blank">Preview</a>
                                        </td>
                                        
				</tr>
                                <?php endif; ?>
                                <?php        endforeach; ?>
                    
                    
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
       
        </div>
                                    </div>
                                        </section>
</div>
                            
			

	