<div class="one_full">
<section class="title blue">
	<h4> <i class=" icon-user" style="margin-top: 4px"  ></i>Learner's List</h4>
</section>

  <section class="item">
 <div style="margin:10px 10px 10px 10px; ">  
      <fieldset id="search">
	<legend>Search </legend>

	<form action="http://localhost/e-TESDA_Learnv4/admin/syllabus/topics" method="post" accept-charset="utf-8">
<div style="display:none;">
<input type="hidden" name="csrf_hash_name" value="0f8e1b1b2c9e66f5ac094fd62a020dfc">
</div>		<ul>
    <a href="<?php echo site_url('admin/learner/courseList')?>" class="button">Course Stat!!</a>	
    <li> 
        <div class="input"><?php echo form_input(array('name'=>'learner_search','style'=>'width:300px','placeholder'=>'Search Learner Name')) ?></div>
    
    </li>
		</ul>
	</form></fieldset>  
       <table cellspacing="0">
		<thead>
			<tr>
				<th width="20"><input type="checkbox" name="action_to_all" value="" class="check-all">
</th>
				<th> Learner's ID</th>
                                <th class="collapse"> Full Name</th>
                                <th class="collapse">Date Joined</th>
				<th class="collapse">Email Address</th>
				<th width="180"></th>
			</tr>
		</thead>
		<tbody>
                    <?php foreach($learners as $learn): ?>
							<tr>
					<td><input type="checkbox" name="action_to[]" value=""></td>                                   
                                        <td><?php echo $learn['userid']; ?></td>
					<td><?php echo $learn['firstname']; ?> <?php echo $learn['middlename']; ?> <?php echo $learn['lastname']; ?></td>
                                        <td><?php echo format_date($learn['dateJoined']); ?></td>
                                        <td><?php echo $learn['email']; ?></td>
                                	
                    <td style="padding-top:10px;">
                        							
                        <!--?php// else: ?-->
							
                                 
						<a href="<?php echo site_url('admin/learner/viewLearnerProfile/'.$learn['userid']); ?> "  class="button">View Profile</a>
						
					</td>
				</tr>
                                <?php endforeach; ?>
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
    