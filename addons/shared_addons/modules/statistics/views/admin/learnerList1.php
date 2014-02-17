<div class="one_full">
 <ul id="breadcrumbs-one">
		
		<li><a href="" > Statistics</a></li>
		<li><a href="" class="current"> Learner List</a></li>
		
	</ul>
  
</div>
<div class="one_full">
<section class="title blue">
	<h4> <i class=" icon-user" style="margin-top: 4px"  ></i>Learner's List</h4>
</section>

  <section class="item">
 <div style="margin:10px 10px 10px 10px; ">  
      <fieldset id="search">
	<legend>Search </legend>
        <?php echo form_input(array('name'=>'search','placeholder'=>'Enter Learner\'s ID '))?> 
        <a class="btn blue"> Search </a>
</fieldset>  
       <table cellspacing="0">
		<thead>
			<tr>
				<th width="20"><input type="checkbox" name="action_to_all" value="" class="check-all">
</th>
				<th> Learner's ID</th>
                                <th class="collapse"> Full Name</th>
                                <th class="collapse">Date Joined</th>
				
				<th width="180"></th>
			</tr>
		</thead>
		<tbody>
							<tr>
					<td><input type="checkbox" name="action_to[]" value="">
</td>                                   <td>11018534</td>
					<td>Nero Patrick Roque</td>
                                        <td>September 10,2012</td>
                                	
					
				
					<td style="padding-top:10px;">
                        							
                        <!--?php// else: ?-->
							
                                 
						<a href="<?php echo site_url('admin/statistics/learnerProfile'); ?> "  class="button">View Profile</a>
						
					</td>
				</tr>
					</tbody>
	</table>

	

	<br>

	<div class="table_action_buttons style">
		
	
							
						<button type="submit" name="btnAction" value="flag" class="btn red confirm" disabled="">
					<span>Flag</span>
				</button>
											
						</div>
  
     </div>       
        </section>
</div>
    