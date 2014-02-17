
<div class="one_full">
 <ul id="breadcrumbs-one">
		<li><a href="<?php echo site_url('admin/profiling')?>" >  Profiling Test Item Bank</a></li>
		<li><a href=" <?php echo $this->uri->uri_string() ?>" class="current"><?php echo $sectiondet->sectionName?>'s Item Bank</a></li>
                
		
	</ul>
  
</div>
<div class="one_full">

<section class="title blue">
<input id="baseurl" type="hidden" value="<?php echo base_url()?>">
	<h4><?php echo $sectiondet->sectionName ?>'s Item Bank</h4>


</section>

<section class="item">
<div class="content">

    <div class="one_full">
        <h5>Total No. of Items: <span class="label label-info"> <?php echo $count ?> items</span> </h5> 
        
         <?php if($sectiondet->testID== 1): ?>
                      <a href="<?php echo site_url('admin/profiling/addItem_Interest').'/'.$secid ?>" class="btn green "> Add Items</a>
                    <?php else: ?>
                        <a href="<?php echo site_url('admin/profiling/addItem_Ability').'/'.$secid ?>" class="btn green "> Add Items</a>
                    <?php endif; ?>
        
       
        <hr>
        
        <table id="sortTable" class="tablesorter" >
            <thead>
                <tr>
            <th>Question/Prompt</th>
            <th>Item Type</th>
            <th>Responses</th>
            <th></th>   
            </tr>
            </thead>
            <tbody>
              <tr> <?php foreach ($items as $item): ?>
                
                <td><?php echo $item['prompt'] ?></td>
                <?php if($item['testType']==1):?>
                <td>Multiple Choice</td>
                <?php else: ?>
                 <td>Agree or Disagree</td>
                <?php endif; ?>  
                <td> 
                    <?php if($item['response']== NULL): ?>
                        <a href="<?php echo site_url('admin/profiling/modal_viewResponses/'.$item['itemID'])?>" class=" btn btn-lesson blue cboxElement modal"> View Responses </a>
                    <?php else: ?>
                        <?php echo $item['response'] ?>
                    <?php endif; ?>
                </td>
                <td><a href="<?php echo site_url('admin/profiling/removeItem').'/'.$item['itemID']?>" class="btn red confirm">Remove</a></td>
            
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
</div>
</section>
    </div>