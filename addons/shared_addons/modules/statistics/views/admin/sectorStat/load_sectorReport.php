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

<script>
var ddl_year = new Date().getFullYear();   
    
      
  $(".viewCourse").click(function(){
      var sectorID = $('#viewCourse1',$(this).closest("td")).val();
      var typeID = $('#typeID',$(this).closest("td")).val();
      var mon = $('#mon',$(this).closest("td")).val();
      var year = $('#year',$(this).closest("td")).val();
      //alert(sectorID+'-'+typeID+'-'+mon+'-'+year);
      $('#courses').load(SITE_URL+'admin/statistics/sectorStat/load_courses?sectorID=' + sectorID + '&typeID=' + typeID + '&mon=' + mon + '&year=' + year);
   });
     //$('#ddl_month_chzn').val(ddl_month);
      //ddl_month=$('#ddl_month').val();
     //$('#sectorRepbody').load(SITE_URL+'admin/statistics/sectorStat/load_sectorReport?month=' + ddl_month + '&year=' + ddl_year + '&type=1');
</script>
<?php if($type == 1): ?>
<div class="one_full">
              <div class="one_half" id="piechart" style="float:left; margin-left:300px"></div>

             
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
                text: 'Sector Summary: No. of Enrollees'
            },
            tooltip: {
        	    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
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
                data: [   <?php if(empty($secCounts) && empty($sectName)): ?>
                                <?php else: ?>
                    <?php foreach ($sectName as $sn): ?>
                         <?php echo "[" ?>
                             <?php echo "'".$sn['title']."'"?>
                                  <?php echo ","?>   
                              <?php foreach($sectCounts[$sn['ID']] as $sc):?>
                                <?php echo $sc."]," ?> <?php endforeach; ?>
                     <?php endforeach ?>
                         <?php endif ?>
                ]
            }]
        });
    });
    
});
		</script>
             
          <div class="one_half">
                 <?php if(!empty($sectName)):?> 
              <div class="title blue" style="padding:1px"><h4 style="margin-left: 10px;"> <strong> Sectors </strong> 
                  </h4></div>

             
              <table class="tablesorter" id="sortTable">
                  <thead>
                      <tr>
                          <th>Sector</th>
                          <th style="width:100px">Enrollees</th>
                          <th style="width:100px"></th>
                          
                      </tr>
                  </thead>
                  <tbody>
                      
                        <?php foreach ($sectName as $sn): ?>
                        <tr>    
                            <td> 
                           <?php echo $sn['title']?>  
                        </td>
                            
                             <?php foreach($sectCounts[$sn['ID']] as $sc):?> 
                               <td> <?php echo $sc?> Enrollees </td>
                        <?php endforeach;?>
                             <td><input type="hidden" id="viewCourse1" value="<?php echo $sn['ID'];?>">
                                 <input type="hidden" id="typeID" value="<?php echo $type;?>" />
                                 <input type="hidden" id="mon" value="<?php echo $mon;?>" />
                                 <input type="hidden" id="year" value="<?php echo $year;?>" />
                                 <a class="btn small blue viewCourse"> View Courses </a></td>
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
               <?php endif ?>
          </div>
          <div class="one_half">
              <div class="courses" id="courses">
                  
                 
                  
              </div>
          </div>
      
<?php elseif ($type == 2):?>
                <div class="one_full">
              <div class="one_half" id="piechart" style="float:left; margin-left:300px"></div>
          
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
                text: 'Sector Summary: No. of Graduates'
            },
            tooltip: {
        	    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
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
                name: 'Graduates',
                data: [   <?php if(empty($secCounts) && empty($sectName)): ?>
                                <?php else: ?>
                    <?php foreach ($sectName as $sn): ?>
                         <?php echo "[" ?>
                             <?php echo "'".$sn['title']."'"?>
                                  <?php echo ","?>   
                              <?php foreach($sectCounts[$sn['ID']] as $sc):?>
                                <?php echo $sc."]," ?> <?php endforeach; ?>
                     <?php endforeach ?>
                         <?php endif ?>
                ]
            }]
        });
    });
    
});
		</script>
          <div class="one_half">
                 <?php if(!empty($sectName)):?> 
              <div class="title blue" style="padding:1px"><h4 style="margin-left: 10px;"> <strong> Sectors </strong>
                    
                  </h4></div>

     
              <table class="tablesorter" id="sortTable">
                  <thead>
                      <tr>
                          <th>Sector</th>
                          <th style="width:100px">Graduates</th>
                          <th style="width:100px"></th>
                          
                      </tr>
                  </thead>
                  <tbody>
   
                        <?php foreach ($sectName as $sn): ?>
                        <tr>    
                            <td> 
                           <?php echo $sn['title']?>  
                        </td>
                            
                             <?php foreach($sectCounts[$sn['ID']] as $sc):?> 
                               <td> <?php echo $sc?> Graduates </td>
                        <?php endforeach;?>
                             <td><input type="hidden" id="viewCourse1" value="<?php echo $sn['ID'];?>" />
                                 <input type="hidden" id="typeID" value="<?php echo $type;?>" />
                                 <input type="hidden" id="mon" value="<?php echo $mon;?>" />
                                 <input type="hidden" id="year" value="<?php echo $year;?>" />
                                 <a class="btn small blue viewCourse"> View Courses </a></td>
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
               <?php endif ?>
          </div>
          <div class="one_half">
              <div class="courses" id="courses">
                  
                 
                  
              </div>
          </div>
                
<?php elseif ($type == 3):?>
                <div class="one_full">
              <div class="one_half" id="piechart" style="float:left; margin-left:300px"></div>
          
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
                text: 'Sector Summary: No. of Inactives'
            },
            tooltip: {
        	    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
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
                name: 'inactives',
                data: [   <?php if(empty($secCounts) && empty($sectName)): ?>
                                <?php else: ?>
                    <?php foreach ($sectName as $sn): ?>
                         <?php echo "[" ?>
                             <?php echo "'".$sn['title']."'"?>
                                  <?php echo ","?>   
                              <?php foreach($sectCounts[$sn['ID']] as $sc):?>
                                <?php echo $sc."]," ?> <?php endforeach; ?>
                     <?php endforeach ?>
                         <?php endif ?>
                ]
            }]
        });
    });
    
});
		</script>
          <div class="one_half">
                 <?php if(!empty($sectName)):?> 
              <div class="title blue" style="padding:1px"><h4 style="margin-left: 10px;"> <strong> Sectors </strong>
                   
                  </h4></div>

                  
              <table class="tablesorter" id="sortTable">
                  <thead>
                      <tr>
                          <th>Sector</th>
                          <th style="width:100px">Inactives</th>
                          <th style="width:100px"></th>
                          
                      </tr>
                  </thead>
                  <tbody>
  
                        <?php foreach ($sectName as $sn): ?>
                        <tr>    
                            <td> 
                           <?php echo $sn['title']?>  
                        </td>
                            
                             <?php foreach($sectCounts[$sn['ID']] as $sc):?> 
                               <td> <?php echo $sc?> Inactives </td>
                        <?php endforeach;?>
                             <td><input type="hidden" id="viewCourse1" value="<?php echo $sn['ID'];?>" />
                                 <input type="hidden" id="typeID" value="<?php echo $type;?>" />
                                 <input type="hidden" id="mon" value="<?php echo $mon;?>" />
                                 <input type="hidden" id="year" value="<?php echo $year;?>" />
                                 <a class="btn small blue viewCourse"> View Courses </a></td>
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
               <?php endif ?>
          </div>
          <div class="one_half">
              <div class="courses" id="courses">
                  
                 
                  
              </div>
          </div>
<?php elseif ($type == 4):?>
                <div class="one_full">
              <div class="one_half" id="piechart" style="float:left; margin-left:300px"></div>
          
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
                text: 'Sector Summary'
            },
            tooltip: {
        	    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
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
                name: 'percent',
                data: [ 
                    ['Inactive', <?php echo $sumInact ?>],
                    ['Enrollees', <?php echo $sumEn ?>],
                    ['Graduates', <?php echo $sumGr ?>]
                ]
            }]
        });
    });
    
});
		</script>
          <div class="one_full">
              <div class="title blue" style="padding:1px"><h4 style="margin-left: 10px;"> <strong> Sectors </strong> 
                 <small><a class="btn blue small" style="float:right;margin-top: -10px;
margin-right: 5px;" href="<?php echo site_url('admin/statistics/sectorStat/printAllSect?mon='.$mon.'&year='.$year.'&type='.$type);?>"> Download</a></small>   
                  </h4></div>

              <table class="tablesorter" id="sortTable" >
                  <thead>
                      <tr>
                          <th>Sector</th>
                          <th style="width:100px">Enrollees</th>
                          <th style="width:100px">Graduates</th>
                          <th style="width:100px">Inactives</th>
                          <th style="width:100px"></th>
                          
                          
                      </tr>
                  </thead>
                  <tbody>
   
                        <?php foreach ($allSects as $al): ?>
                        <tr>    
                            <td> 
                           <?php echo $al['title']?>  
                        </td>
                            
                            
                               <td> <?php foreach($totEn[$al['id']] as $te):?><strong><?php echo $te ?></strong> Enrollees 
                               
                               <?php endforeach; ?></td>
                               
                               
                               <td><?php foreach($totGr[$al['id']] as $tg):?><strong><?php echo $tg ?></strong> Graduates
                               
                               <?php endforeach; ?></td>
                               
                               
                               <td> <?php foreach($totIn[$al['id']] as $ti):?><strong><?php echo $ti ?></strong> Inactives
                               
                               <?php endforeach; ?></td>
                       
                             <td><a class="smallerCbox modal" href="<?php echo site_url('admin/statistics/sectorStat/sumModal?sectID='.$al['id'].'&mon='.$mon.'&year='.$year.'&type='.$type)?>"> View Courses </a></td>
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
    
<?php endif; ?>

      