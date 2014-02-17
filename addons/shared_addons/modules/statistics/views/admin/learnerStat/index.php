<div class="one_full">
<section class="title blue">
    <h4><strong>Learner Monitoring</strong> </h4>
</section>

  <section class="item">
      <div class="content">
          
         
     
     <fieldset style="padding-left:20px; padding-right:20px">
       
			<div style="float:left">
                           
                            <?php echo form_input(array('style'=>'width:250px','placeholder'=>'Search learner','id'=>'autocomplete')) ;?> 
                         
                        </div>
                        <div style="float:left;margin-left:10px">
        		     
                          <?php 
                          $att2 = 'id="select_course"';
                          
                          echo form_dropdown('',$courses,'',$att2) ;?>
       			</div>
              <script>
                 $(document).ready(function() {
     
      var availableTags = [<?php foreach($allLearners as $al):?>
          <?php echo "'".$al['name2']."'," ?>
		 <?php        endforeach; ?>
		];
		$( "#autocomplete" ).autocomplete({
			source: availableTags,
                        
                        select: function( event, ui ) {
                        var lName = ui.item.value;
                        var learnN = encodeURIComponent(lName);
                        //alert(learnN);
//                        var str = $.trim(lName.split('@')[0]);
//                        var learnN = encodeURIComponent(str);
//                        var learnNN = $.trim(lName.split('@')[1]);
//                        alert(learnN);
                      //$('div #body_table').load(SITE_URL+'admin/statistics/learnerStat/autoLearner?fPart='+learnN+'&sPart='+learnNN);
                      $('div #body_table').load(SITE_URL+'admin/statistics/learnerStat/autoLearner/'+learnN);
                        },
                          response: function(event, ui) {
            // ui.content is the array that's about to be sent to the response callback.
            if (ui.content.length === 0) {
                $("#empty-message").text("No results found");
            } else {
                $("#empty-message").empty();
            }
        },


		});
     
    });
              
              
              
              </script>
		</fieldset>
          
         
        
             
 
          <div style="padding-left:50px; padding-right:50px">
       <table cellspacing="0" class="tablesorter" id="sortTable" >
		<thead>
			<tr>
				<th> Learner's ID</th>
                                <th class="collapse"> Full Name</th>
                                <th class="collapse">Course Enrolled</th>
				 <th class="collapse">Course Finished</th>
				<th width="180"></th>
			</tr>
		</thead>
		<tbody id="body_table">
           
                    <?php foreach($learnList as $ll):?>
                    <tr>
                        <td> <?php echo $ll['learnerID'] ?></td>
                        <?php foreach($enrNames[$ll['learnerID']] as $en):?>
                        <td><?php echo $en['name'] ?></td>
                        <?php endforeach; ?>
                        <td><?php foreach($enrCount[$ll['learnerID']] as $ec):?> <a class="badge badge-info" ><?php echo $ec['count'] ?><?php endforeach; ?></a></td>
                        <td> <a class="badge badge-success"><?php foreach($gradCount[$ll['learnerID']] as $gc): ?><?php echo $gc['count'] ?> <?php endforeach; ?></a></td>
                         <td> <a class="btn blue" href="<?php echo site_url('admin/statistics/viewLearnerProfile/'.$ll['learnerID']); ?>">View Profile</a></td>
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
          
   
        </section>
</div>
    