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
                         <?php $modCount = 1; ?>
                        <?php foreach($courseMods as $cm):?>
                        <h3> <?php echo $cm['title']; ?></h3>
                        <div>
                            <div id="modDuration<?php echo $modCount?>"></div>
               
                            <script type="text/javascript">
$(function () {
        $('#modDuration'+<?php echo $modCount ?>).highcharts({
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
                    text: 'Day/s'
                },
                categories: [<?php foreach($modDur->$cm['title'] as $md): ?><?php foreach($md as $mDur): ?> <?php echo "'".$mDur['diffD']."',"?><?php endforeach; ?> <?php endforeach;?>]
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
                data: [<?php foreach($modDur->$cm['title'] as $md): ?><?php foreach($md as $mDur): ?> <?php echo $mDur['diffD'].","?><?php endforeach; ?> <?php endforeach;?>]
            }]
        });
    });
    

		</script>
                  
                        </div>
                        <?php $modCount += 1; ?>
                    <?php endforeach; ?>
                    </div>
                  
               </fieldset>
      
                
        </div>
        </div>
            
    </section>
   
    
</div>