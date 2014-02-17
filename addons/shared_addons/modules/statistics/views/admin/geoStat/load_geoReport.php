<?php
 $src3=site_url('addons/shared_addons/modules/statistics/css/admin.css');
           $src=site_url('addons/shared_addons/modules/statistics/js/jquery.tablesorter.min.js');
           $src2=site_url('addons/shared_addons/modules/statistics/js/jquery.tablesorter.pager.js');
           $src4=site_url('addons/shared_addons/modules/statistics/js/items.js');
         
           
              
      

?>
 <link rel="stylesheet" href="<?php echo $src3 ?>">
    <script type="text/javascript" src="<?php echo $src ?>"
    <script type="text/javascript" src="<?php echo $src2; ?>"></script>
    <script type="text/javascript" src="<?php echo $src4; ?>"></script>   

<div class="one_half" style="float:left; margin-left:300px">
                  <div  id="piechart"></div>
                     <div class="one_full">
                   <section class="title blue"> </section>
                   
             <table width="100%" class="tablesorter"  id="sortTable"> 
                 <thead>
                     <tr>
                         <th width="60%">Country</th>
                         <th width="20%"><?php if($geoType == 1): ?> <?php echo 'Enrollees'?>
                         <?php else: ?> <?php echo 'Graduates' ?><?php endif ?></th>
                         
                     </tr>
                 </thead>
                 <tbody>
                     <?php $cCtr = 0; ?>
                     <?php foreach($allCountries as $ac):?>
                     <tr>
                         <td><?php echo $ac['country'] ?></td>
                         <td><?php foreach($totalPerC[$cCtr] as $tpc):?>
                        <?php echo $tpc?> Learners
                        <?php endforeach; ?></td>
                     </tr>
                 </tbody>
                 <?php $cCtr ++ ?>
                 <?php endforeach; ?>
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
              
               <script type="text/javascript">
$(function () {
    var chart;
    
    $(document).ready(function () {
    	
    	// Build the chart
        $('#piechart').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Geographical Location of<?php if($geoType == 1):?> <?php echo 'Enrollees'?><?php else:?><?php echo ' Graduates' ?><?php endif ?>[Current]'
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
                name: 'Learners',
                data: [<?php $ctr = 0; ?>
                    <?php foreach($allCountries as $ac):?>
                    <?php echo "['"?><?php echo$ac['country']?><?php echo "'," ?> 
                        <?php foreach($totalPerC[$ctr] as $tpc):?>
                        <?php echo $tpc."],"?>
                        <?php endforeach; ?>
                            <?php $ctr++; ?>
                <?php endforeach; ?>
                ]
            }]
        });
    });
    
});
		</script>