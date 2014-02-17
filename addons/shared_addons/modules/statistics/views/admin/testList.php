<div class="one_full">
 <ul id="breadcrumbs-one">
		
		<li><a href="" > Statistics</a></li>
		<li><a href="" class="current">  <?php echo $oaBasic->title." Tests" ?></a></li>
		
	</ul>
  
</div>
<div class="one_full">
<section class="title blue">
	<h4> <i class="icon-list-alt" style="margin-top:4px; margin-right: 4px"></i><?php echo $oaBasic->title." Tests" ?></h4>
</section>

     <section class="item">
 
         <div class="content">
             <fieldset>
                 <legend> Online Assessment</legend>
                 
                 <table class="borderless" style="width:50%">
                     <tr>
                         <td> No of Takers:</td>
                         <td> <span class="label label-info"> <?php echo $oaBCount?> Learners </span></td>
                     </tr>
                      <tr>
                         <td> No of Items:</td>
                         <td> <span class="label label-info">  <?php echo $oaBasic->noOfItems?> items</span></td>
                     </tr>
                        
                 </table>
                 <a href="<?php echo site_url('admin/statistics/testStat/'.$oaBasic->courseID)?>" class="btn blue"> View Statistics</a>
             </fieldset>
             
         </div>
   
         <div class="one_full">
             <div style="margin:10px">
         <fieldset> 
             <legend> Self Checks</legend>
             <table>
                 <thead>
                     <tr>
                         <th>Self-Check</th>
                         <th> No of Takers:</th>
                         <th> No. of Items:</th>
                         <th></th>
                     </tr>
                 </thead>
                 <tbody>
                     <?php foreach ($scBasic as $scb):?>
                     <tr>
                         <td> <?php echo $scb['title'] ?></td>
                         <td> <span class="label label-info"><?php echo $scCount[$scb['id']] ?> Learners</span> </td>
                         <td> <span class="label label-info"> <?php echo $scb['noOfItems'] ?> Items</span> </td>
                         <td> <a href="<?php echo site_url('admin/statistics/testStatSC/'.$scb['id']) ?>" class="btn blue"> View Statistics </a></td>
                     </tr>
                     <?php endforeach; ?>
                 </tbody>
             </table>
         </fieldset>
                 </div>
    </div>

		 
     
  
	

       
       
        </div>
                                    
                                        </section>
</div>
    