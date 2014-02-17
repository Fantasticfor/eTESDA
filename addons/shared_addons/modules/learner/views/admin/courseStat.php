<div class="one_full">
 <ul id="breadcrumbs-one">
		<li><a href="" > Sectors</a></li>
		<li><a href="" > Information Technology Courses</a></li>
		<li><a href="" class="current"> Computer Hardware Servicing Statistics</a></li>
		
	</ul>
  
</div>

<div class="one_full">
    <section class="title blue"><h4><?php echo $courseDet[0]['title']; ?> Statistics</h4></section>
    <section class="item ">
        <div>
        <div class="content">
            
            <div class="one_half">
                <fieldset> 
                    <legend>
                        Overview Stats
                    </legend>
                <table class="borderless">
                    <tbody>
                        <tr>
                            <td> <label>Enrollees</label></td>
                            <td> <span class="label label-success"><?php echo $enrollees[0]['count']; ?> Enrollees</span></td>
                        </tr>
                        <tr>
                            <td> <label> Inactives </label></td>
                            <td> <span class="label label-warning"> <?php echo $inactive[0]['count']; ?> Inactive</span></td>
                        </tr>
                        <tr>
                            <td> <label> Graduates</label></td>
                            <td> <span class="label label-info"><?php echo $grads[0]['count']; ?>  Graduates</span></td>
                        </tr>
                    </tbody>
                    
                </table>    
                </fieldset>
                
            </div>
            <div class="one_half">
                <div id="courseDuration"  ></div>
             <script type="text/javascript">
$(function () {
        $('#courseDuration').highcharts({
            chart: {
                type: 'line'
            },
            title: {
                text: 'Course Duration'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: [<?php foreach($courseDur as $cd):?><?php echo "'".$cd['differ']."',"; ?><?php endforeach; ?>
                ]
            },
            yAxis: {
                title: {
                    text: 'No. of Graduates'
                }
            },
            tooltip: {
                enabled: false,
                formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                        this.x +': '+ this.y +'°C';
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [{
                name: 'Duration(days)',
                data: [<?php foreach($courseDur as $cd):?><?php echo $cd['count'].","; ?><?php endforeach; ?>]
            }]
        });
    });
    

		</script>
                
            </div>
            
       
         <div class="one_full">
                <fieldset>
                    <legend>Course Modules</legend>
                     <div id="accordion">
                        <?php foreach($courseMods as $cm):?>
                        <h3> <?php echo $cm['title']; ?></h3>
                        <div>
                            <div id="modDuration"></div>
                            <script type="text/javascript">
$(function () {
        $('#modDuration').highcharts({
            chart: {
                type: 'line'
            },
            title: {
                text: 'Average Module Duration'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                title: {
                    text: 'Hour/s'
                },
                categories: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12']
            },
            yAxis: {
                title: {
                    text: 'Learner'
                }
            },
            tooltip: {
                enabled: false,
                formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                        this.x +': '+ this.y +'°C';
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [{
                name: 'Learner',
                data: [7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
            }]
        });
    });
    

		</script>
                        </div>
                     <?php endforeach; ?>
                    </div>
                   
               </fieldset>
      
                
        </div>
        </div>
            
    </section>
   
    
</div>