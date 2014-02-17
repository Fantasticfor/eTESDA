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


<div class="title blue" style="padding:1px"><h4 style="margin-left: 10px;"> <strong> <?php echo $sectName ?> Sector <small style="color:white">for <?php if($mon !=0) :?><?php echo date("F", mktime(0, 0, 0, $mon, 10)); ?><?php endif; ?> <?php echo $year ?></small> </strong>
    
        <?php if($mon !=0): ?>
        
        <small><a class="btn blue small" style="float:right;margin-top: -10px;
margin-right: 5px;" href="<?php echo site_url('admin/statistics/sectorStat/printRep?sectID='.$sectID.'&mon='.$mon.'&year='.$year.'&type='.$type);?>"> Download</a></small>
        <?php else: ?>
       <?php date_default_timezone_set('Hongkong');
            $monNow = date("m"); ?>
        <small><a class="btn blue small" style="float:right;margin-top: -10px;
margin-right: 5px;" href="<?php echo site_url('admin/statistics/sectorStat/printRep?sectID='.$sectID.'&mon='.$monNow.'&year='.$year.'&type='.$type);?>"> Download</a></small>
        <?php endif; ?>
    
    </h4></div>
<table class="tablesorter" id="sortTable">
                  <thead>
                      <tr>
                          <th>Course</th>
                          <th style="width:100px">Learners  </th>
                          
                          
                      </tr>
                  </thead>
                  <tbody>
                      <?php foreach($cNames as $cn):?>
                      <tr>
                          <td><?php echo $cn['title'] ?><?php if($cn['status'] == 'draft'): ?><?php echo ' (Draft)' ?><?php endif?></td>
                          <td><?php foreach($sectCounts[$cn['id']] as $sc):?> 
                          <a class="smallerCbox modal" href="<?php echo site_url('admin/statistics/sectorStat/modal_learners2?cID='.$cn['id'].'&mon='.$mon.'&year='.$year.'&type='.$type);?>">
                                  <center><strong><?php echo $sc ?></strong></center></a>
                          <?php endforeach; ?></td>
                         
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