


			<div id="content-body">
				

                            <div class="one_full">
 <ul id="breadcrumbs-one">
		<li><a href="" > Statistics</a></li>
                <li><a href="" >  <?php echo $basicInfo->title.' Tests' ?></a></li>
		<li><a href="" class="current" >Online Assessment Statistics</a></li>
		
		
	</ul>
                                </div>




				<div class="one_full">

   
                                    <div class="one_full">
        	<section class="title blue">
		<h4><?php echo $basicInfo->title?> Test Statistics</h4>
	</section>
        <section class="item">
 <div style="margin:10px 10px 10px 10px; ">  
   
       <table class="borderless">
		
		<tbody>
                <th width="150px"></th>
                <th ></th>
                                   <tr>
                                       <td><strong>Type:</strong></td>
				    <td> <?php echo $basicInfo->type?></td>
                                  </tr>
                                  
                                <tr>
                                    <td><strong> No. of Takers: </strong></td>
                                  <td><span class="label label-success"><?php echo $bCount.' Learners'?></span></td>
				 </tr>
                                 
					</tbody>
	</table>

	

	<br>


  
     </div>       
        </section>
                                        </div>
                                    <div class="one_full">
                                        <div class="one_half">
                                            <section class="title blue"><h4>Online Assessment Takers </h4></section>
                                            <section class="item">
                                                
                                            <div id="takers"></div> 
                                            <script type="text/javascript">
$(function () {
        $('#takers').highcharts({
            chart: {
                type: 'spline'
            },
            title: {
                text: 'Online Assessment Takers'
            },
            subtitle: {
                text: <?php date_default_timezone_set('Hongkong');?> <?php echo "'for ".date("F")." ".date("Y")."'"?>
            },
            xAxis: { 
                type: 'datetime',
                dateTimeLabelFormats:{ // don't display the dummy year
                    month: '%e. %b',
                    year: '%b'
                }
            },
            yAxis: {
                title: {
                    text: 'No of Takers'
                },
                min: 0
            },
            tooltip: {
                formatter: function() {
                        return '<b>'+ this.series.name +'</b><br/>'+
                        Highcharts.dateFormat('%e-%b', this.x) +': '+ this.y +' Taker/s';
                }
            },
            
            series: [{
                name: <?php date_default_timezone_set('Hongkong');?><?php echo "'Month of ".date("F")."'"?>,
                // Define the data points. All series have a dummy year
                // of 1970/71 in order to be compared on the same x axis. Note
                // that in JavaScript, months start at 0 for January, 1 for February etc.
                data: [<?php foreach($oaTakers as $oat):?>
                    <?php echo "[Date.UTC(".$oat['yDate'].", ".$oat['mDate'].", ".$oat['dDate']."), ".$oat['count']."],"?>
                    
                <?php endforeach; ?>
                ]
            }]
        });
    });
    

		</script>
    

		</script>
                                            </section>
                                            </div>
                                           <div class="one_half">
                                            <section class="title blue"><h4>Passed/Failed Ratio</h4></section>
                                            <section class="item">
                                                
                                            <div id="passFail"></div> 
                                            <script>
                                         $(function () {
    	
    	// Radialize the colors
		Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function(color) {
		    return {
		        radialGradient: { cx: 0.5, cy: 0.3, r: 0.7 },
		        stops: [
		            [0, color],
		            [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
		        ]
		    };
		});
		
		// Build the chart
        $('#passFail').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Passed/Failed Review Ratio'
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
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        formatter: function() {
                            return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
                        }
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'Browser share',
                data: [
                    ['Passed',   <?php echo $pCount->count?>],
                 
                    {
                        name: 'Failed',
                        y: <?php echo $nrCount->count?>,
                        sliced: true,
                        selected: true
                    }
                   
                    
                ]
            }]
        });
    });
    

		</script>
                <fieldset>
                    <legend> Sections</legend>
                <div>
                    <table class="borderless"> 
                        <thead>
                            <tr>
                                <td>Section</td>
                                <td>Pass</td>
                                <td>Fail</td>
                            </tr>
                        </thead>
                        <?php foreach($secComp as $sComp): ?>
                        <tr>
                            <td><?php echo $sComp['title'] ?></td>
                            <td> <span class="label label-success"> <?php echo $sComp['count']?> Learners</span></td>
                             <td> 
                                    <?php foreach($secNR->$sComp['title'] as $snr): ?>
                                        <?php foreach($snr as $needsR): ?>
                                          <span class="label label-warning"> <?php echo $needsR['count'] ?> Learners </span>
                                        <?php endforeach; ?>
                                    <?php endforeach; ?>
                                          </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                    </fieldset>
                                            </section>
                                            </div>
                                        </div>
                                    
        
 
	
</div>
                       
			</div>

	