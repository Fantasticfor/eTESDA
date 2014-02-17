
    <div class="one_full">
        <div class="one_full">
          <div class="one_half "  >
           	<section class="title blue">
                    <h4> <i class="icon-eye-open" style="margin-top:4px; margin-right: 4px"> </i> <strong>  Statistics Overview </strong></h4>
			
		</section>
		
		<section class="item">
			<div class="content" style="height:690px">
                           
                            <div style="width:50%;float:left" >
                              <div id="enroll" class="enroll"></div>
                               </div>
                            <div style="width:50%; float:left">
                                
                               <div id="inactive" class="inactive"></div>
                               </div>
         <script type="text/javascript">
$(function () {
    var chart;
    
    $(document).ready(function () {
    	
    	// Build the chart
        $('.enroll').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text:<?php  date_default_timezone_set('Hongkong'); $monthE = date('F'); $yearE = date('Y');?> <?php echo  "'".$totalEnrollees." Enrollees for $monthE $yearE '" ?>
            },
            tooltip: {
        	    pointFormat: '{series.name}: <b>{point.percentage}%</b>',
            	percentageDecimals: 1
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                type: 'pie',
                name: 'Enrollees',
                data: [<?php foreach($enrolleesC as $ec):?>
                    <?php echo "['".$ec['title']."',".$ec['count']."]," ?>
                                 <?php endforeach; ?>
                ]
            }]
        });
    });
    
});
$(function () {
    var chart;
    
    $(document).ready(function () {
    	
    	// Build the chart
        $('.inactive').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text:<?php  date_default_timezone_set('Hongkong'); $monthN = date('F'); $yearN = date('Y');?> <?php echo  "'".$totalInactive." Inactives for $monthN $yearN '" ?>
            },
            tooltip: {
        	    pointFormat: '{series.name}: <b>{point.percentage}%</b>',
            	percentageDecimals: 1
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                type: 'pie',
                name: 'Enrollees',
                data: [
                    <?php foreach($inactive as $ia):?>
                    <?php echo "['".$ia['title']."',".$ia['count']."]," ?>
                     <?php endforeach; ?>
                ]
            }]
        });
    });
    
});



		</script>
	
                               
                <div class="one_full">               
                                 
                                  
                <div style="overflow-y:auto; height: 220px">
                    
                                        <table border="0" class="borderless">
                                            <th>Course </th>              
                                            <th> Enrollees</th>              
                                            <th>Inactive</th>              
                                            
<?php foreach($enrolleesC as $ec):?>                                            
<tr>
<td><?php echo $ec['title']; ?><?php if($ec['status'] == 'draft'): ?><?php echo ' (Draft)' ?><?php endif ?></td>
<td>     <span class="badge badge-success"><?php echo $ec['count'].' Enrollee/s' ?></span> </td>

        <td>     
   <?php foreach($cInact->$ec['title'] as $cIn):?>
      <?php foreach($cIn as $inactive):?>
         <span class="badge badge-warning"> <?php echo $inactive['count'].' inactives'; ?>  </span>
      <?php endforeach; ?>
    <?php endforeach; ?>
           </td>
          
</tr>
<?php endforeach; ?>
</table></div>
                                        
                                        <a class ="btn gray" style="float:right" href="<?php echo site_url('admin/statistics');?>"> View More</a>
                                     
                                        
                                   
                                 
                    
                                
                             </div>   
                            
                            	
                           
			
                        
                        </div>
		</section>

	</div>     

                <div class="one_half ">
                    <div class="one_full">
		<section class="title blue">

                    <h4> <i class="icon-user" style="margin-top:4px; margin-right: 4px"> </i> <strong>Learner's Profile Overview </strong></h4>
			
		</section>
		
		<section class="item">
			<div class="content">
                            <div id="learner"></div>
                           
                                    <script type="text/javascript">
$(function () {
        $('#learner').highcharts({
            chart: {
                type: 'line',
                marginRight: 130,
                marginBottom: 25
            },
            title: {
                text: 'Registered ',
                x: -20 //center
            },
            subtitle: {
                text: <?php echo "'For Year ".$registered[0]['yNow']."'" ?> ,
                x: -20
            },
            xAxis: {
                categories: [<?php foreach($registered as $reg):?><?php echo "'".$reg['mName']."'," ?><?php endforeach; ?>]
            },
            yAxis: {
                title: {
                    text: 'No. Registered Learners'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: ' Registered'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -10,
                y: 100,
                borderWidth: 0
            },
            series: [{
                name: 'Registered',
                data: [<?php foreach($registered as $reg):?><?php echo $reg['count']."," ?><?php endforeach; ?>]
            }]
        });
    });
    

		</script>
	</head>
                                     
                                   
                                     
                                        <table border="0" class="borderless">

<tr>
<td>Total Registered Learners This Year  <span class="label label-info"> <?php echo $totalReg; ?>  </span> </td>

</tr>
     
</table>
  
                                    
                               
                                  
                    
                        </div>
		</section>
                        </div>
                    <div class="one_full">
                  <section class=" title blue" >
                      <h4><strong><?php echo lang('cp:admin_quick_links') ?></strong></h4>
			
		</section>
                    
		<section id="quick_links" class="item">
			<div class="content">
				<ul>
					
					<li>
						<a class="tooltip-s" title="<?php echo 'Manage Tests' ?>" href="<?php echo site_url('admin/comments') ?>"><?php echo Asset::img('icons/test.png', 'manage Tests')?></a>
					</li>
					
					
					
					<li>
						<a class="tooltip-s" title="<?php echo 'Manage Syllabus' ?>" href="<?php echo site_url('admin/pages') ?>"><?php echo Asset::img('icons/pages.png', lang('cp:manage_pages')) ?></a>
					</li>
					
					
					
					<li>
						<a class="tooltip-s" title="<?php echo 'Learner'."'s".'Profile'; ?>" href="<?php echo site_url('admin/files') ?>"><?php echo Asset::img('icons/learner.png', lang('cp:manage_files')) ?></a>
					</li>
					
					
					<li>
						<a class="tooltip-s" title="<?php echo lang('cp:manage_users') ?>" href="<?php echo site_url('admin/users') ?>"><?php echo Asset::img('icons/reports.png', lang('cp:manage_users')) ?></a>
					</li>
					<li>
						<a class="tooltip-s" title="Email Inactives" href="<?php echo site_url('admin/statistics/emailSlack') ?>"><?php echo Asset::img('icons/reports.png', lang('cp:manage_users')) ?></a>
					</li>
					
				</ul>
			</div>
		</section>
                    </div>
                    
	</div> 
           
         	
    </div>
    
	<div class="one_full">
                 <div class="one_half" >
                     <section class="title blue"><h4> <i class="icon-list-alt" style="margin-top:4px; margin-right: 4px"></i><strong> Job Portal Course Request </strong></h4> </section>
                <section class="item">
                 <div class="content" >
                      <fieldset>
                         
                <div style="overflow-y:auto; height: 160px">
                    
                                        <table border="0" class="borderless">
                                            <th>Industry </th>              
                                            <th> Course Name</th> 
                                            <th> Reason for Request</th> 
                                            <th></th>              
        <?php foreach($courseReqs as $cReq): ?>
        <tr>
        
       <td>   <label><?php foreach($sectNames[$cReq['sectorID']] as $sn):?>
          <?php echo $sn['title'] ?> <?php endforeach; ?></label> </td>
       <td><?php echo $cReq['courseName']; ?></td>
       <td><h4 class="media-heading"> <a href="<?php echo site_url('admin/learner/reasonMod/'.$cReq['jpcrID'])?>" title="Request Reason" class="modal cboxElement" > View Reason</a></h4></td>
       <td>  <?php foreach($sectNames[$cReq['sectorID']] as $sn2):?>  <a class="btn blue small" href="<?php echo site_url('admin/syllabus/create_course/'.$sn2['ID'])?>"> Create</a> <?php endforeach; ?> </td>
        </tr>
        <?php endforeach; ?>
        </table> 
          </div>
                          </fieldset>
                      
                    
                       <a class ="btn gray" style="float:right; margin-bottom: 5px;"> View More</a>
                      </div>
                                       
                                       
                                     
                                        
                                   
                                 
                    
                    
                </section>
                
            </div>
            
       <div class="one_half">

        <div class="one_full">	
		<section class=" title blue">
                    <h4> <i class="icon-comment" style="margin-top:4px; margin-right: 4px"> </i> <strong>Learner Feedbacks </strong> </h4> 
                      
		</section>
		
		<section class="item">
			<div class="content" >
                            <div style="overflow-y:auto; height: 200px">
                            <fieldset>
                                
              <?php foreach($feedbacks as $feeds): ?>
                            <div class="media" >
              <a style="float:left; margin-right: 15px">
                  <?php if($feeds['learnerID'] == NULL):?>
                     <?php echo Asset::img('default_display.png', 'alt text',array('width'=>70, 'height'=> 64));?>
                  <?php else: ?>
                            <?php foreach($feedLearner[$feeds['title']] as $fl): ?>
                                <?php foreach ($fl as $learner): ?>
                                    <?php if($learner['picture'] != NULL): ?>
                                        <img src='<?php echo $learner['picture']; ?>' width="70px" height="64px"'>
                                    <?php else:?>
                                        <?php echo Asset::img('default_display.png', 'alt text',array('width'=>70, 'height'=> 64));?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                  <?php endif; ?>
             <div class="media-body">
                  <h4 class="media-heading"> <a href="<?php echo site_url('admin/learner/feedbackMod/'.$feeds['feedbackID'])?>" title="<?php echo $feeds['title'] ?>" class="modal cboxElement" > <?php echo $feeds['title'] ?> </a></h4>
                <p> by <?php if($feeds['learnerID'] == NULL):?>
                            <?php echo $feeds['email']; ?>
                       <?php else:?>
                            <?php foreach($feedLearner[$feeds['title']] as $fl): ?>
                                <?php foreach ($fl as $learner): ?>
                                    <?php echo $learner['firstname'].' '.$learner['lastname'] ?>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                       <?php endif; ?>
                    
                    
                    
                    , <?php echo format_date($feeds['feedbackDate']); ?>
                    <br>
                </p>
               
              </div>
            </div>
             <?php endforeach; ?>  
								
			</fieldset>			
                                </div>                      
                           <a class="btn gray" style="float:right;margin-bottom: 5px;" href="#"> View More </a>   
			</div>
                    
                   
		</section>
    
    
    
</div>	
	
</div>
	
       
	</div>	
	
	</div>
	
		
	
	
	
	

