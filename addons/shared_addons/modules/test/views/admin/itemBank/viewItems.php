
<div class="one_full">
 <ul id="breadcrumbs-one">
		<li><a href="<?php echo site_url('admin/test/')?>" >  Item Bank</a></li>
		<li><a href="" class="current"><?php echo $moduledetails->title ?>'s Item Bank</a></li>
                
		
	</ul>
  
</div>
<div class="one_full">

<section class="title blue">
<input id="baseurl" type="hidden" value="<?php echo base_url()?>">
	<h4><?php echo $moduledetails->title ?>'s Item Bank</h4>


</section>

<section class="item">
<div class="content">

    <div class="one_full">
        <h5>Total No. of Items: <span class="label label-info"> <?php echo $itemcount ?> items</span> </h5> <a href ="<?php echo site_url('admin/test/addItem/'.$moduledetails->id) ?>" class="btn green "> Add Items</a>
        
        <hr>
        
        <table id="sortTable" class="tablesorter" >
            <thead>
                <tr>
            
            <th>Question/Prompt</th>
            <th>Item Type</th>
            <th>Difficulty</th>
            <th>Item Category</th>
            <th>Date Added</th>
            <th></th>
               
            </tr>
            </thead>
            <tbody>
            <?php foreach ($itemlist as $item): ?>
            <tr> 
                
                <td><?php echo $item['prompt'] ?> </td>
                <td><?php echo $item['testType'] ?></td>
                <td> <?php echo $item['difficulty'] ?></td>
                <td><?php 
                        if($item['category'] == 0){
                            echo "Online Assessment";
                        }
                        elseif($item['category']== 1){
                           echo "Self Check"; 
                        }else{
                            echo "Both";
                        }
                ?></td>
                <td><?php echo format_date($item['dateCreated']) ?></td>
                <td> <a href="<?php echo site_url('admin/test/modal_viewResponses1/'.$item['itemID'])?>" class=" btn btn-lesson blue cboxElement modal"> View Responses </a>
                
                    <?php if($item['status'] == 1): ?>
                    <a href="<?php echo site_url('admin/test/flag_item/').'/'.$item['itemID'] ?>" id="flag" class="btn gray"> Flag Item </a> 
                    <?php else: ?>
                    <a href="<?php echo site_url('admin/test/unflag_item').'/'.$item['itemID'] ?>" id="unflag" class="btn gray"> Unflag Item </a> 
                    <?php endif; ?>
                    
                </td>
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