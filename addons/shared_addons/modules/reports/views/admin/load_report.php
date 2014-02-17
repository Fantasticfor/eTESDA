<?php date_default_timezone_set('Hongkong');?>
<?php if($report==1):?>
<div class="one_full">
    <div style="margin:10px">
        <div style="text-align: center">
        <h2> Course Enrollees Summary Report</h2>
        <br>
        <span> For <?php echo $monthName." ".$yearN?></span>
        </div>
        <br>
        <table>
            <tr>
                <th> Learner </th>
                <th> Course </th>
                <th> Date Enrolled </th>
                <th> Learner's Status </th>
            </tr>
            <tbody>
                <?php $counter = 1; ?>
                <?php foreach($enrollee as $enr):?>
                <tr>
                    <td><?php foreach($lName[$counter] as $ln):?>
                            <?php foreach($ln as $lNa): ?>
                                <?php echo $lNa['firstname'].' '.$lNa['lastname'] ?>
                            <?php endforeach;?>
                        <?php endforeach;?>
                    
                    </td>
                    <td> <?php echo $enr['title'] ?></td>
                    <td> <?php echo format_date($enr['dateStarted']) ?></td>
                    <td> <?php if($enr['status'] == 1){
                        echo 'Following Course';
                    }elseif($enr['status'] == 2){
                        echo 'Ready for Assessment';
                    }else{
                        echo 'Candidate for Certification';
                    }   
?></td>
                    
                </tr>
                <?php $counter += 1; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        
    </div>
</div>
<?php elseif ($report==2):?>
<div class="one_full">
    <div style="text-align: center">
        <h2> Sector Summary Report</h2>
        </div>
    <div style="margin:10px">
        <?php $sCount = 1; ?>
        <?php $sTitleC = 0; ?>
<div id="sectors"></div>
<script>
    
$(function () {
    var sector;
    
    $(document).ready(function () {
    	
    	// Build the chart
        $('#sectors').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text:  <?php echo "'For ".$monthName." ".$yearN."'"?> 
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
                    <?php if(empty($secCounts) && empty($sectName)): ?>
                                <?php else: ?>
                    <?php foreach ($sectName as $sn): ?>
                    <?php echo "[" ?>
                        <?php echo "'".$sectName[$sCount - 1]['title']."'"?> 
                           
                          <?php echo ","?>   
                              <?php foreach($sectCounts[$sCount] as $sc):?>
                                <?php echo $sc[0]."]," ?> <?php endforeach; ?>
                     <?php $sCount += 1; ?>
                                    <?php endforeach; ?>
                                        <?php endif; ?>
                ]
            }]
        });
    });
    
});
		</script>
            
               
                <table>
                    <thead>
                        <tr>
                            <th width="400px"> Course</th>
                            <th> No.Enrollees</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $secCount = 1; ?>
                        <?php foreach ($sectName as $sn): ?>
                        <tr>    
                            <td> 
                           <?php echo $sn['title']?>  
                        </td>
                            
                            <td> <?php foreach($sectCounts[$secCount] as $sc):?>
                                <?php echo $sc[0]?> Enrollees
                        <?php endforeach;?></td>
                        </tr>
                        <?php $secCount += 1; ?>
                            <?php endforeach; ?>
                    </tbody>
                </table>
                    
                </div>
                </div>
<?php elseif ($report==3):?>
<div class="one_full">
    <div style="margin:10px">
        <div style="text-align: center">
        <h2>  Endorsement Report </h2>
        <span> For <?php echo $monthName." ".$yearN?> </span>
        </div>
        <br>
        <table>
            <tr>
                <th> Learner Name  </th>
                <th> Course  </th>
                <th> Date Finished</th>
                
            </tr>
            <tbody>
                <?php $endCount = 1;?>
                <?php foreach($lEnd as $le):?>
                <tr>
                    <td> <?php foreach($cEnd[$endCount] as $ce):?>
                            <?php foreach($ce as $lInfo): ?>
                                <?php echo $lInfo['firstname'].' '.$lInfo['lastname'] ?>
                            <?php endforeach;?>
                        <?php endforeach;?></td>
                    <td> <?php echo $le['title'] ?></td>
                    <td> <?php echo format_date($le['dateFinished']) ?></td>
                </tr>
                <?php $endCount += 1; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        
    </div>
</div>
<?php endif ?>


    