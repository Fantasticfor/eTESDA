


			<div id="content-body">
				






				<div class="one_full">

   
     
        	<section class="title blue">
                    <h4>Profiling Item Bank </h4> 
	</section>
        <section class="item">
            
                
    

            
 <div style="margin:10px 10px 10px 10px; ">  
     <div class="content tabs">
        <ul class="tab-menu">
		<li><a href="#Interest"><span>Interests Item Bank</span></a></li>
		<li><a href="#Ability"><span>Abilities Item Bank</span></a></li>
	</ul>
           <div id="Interest">
              
       <table class="tablesorter" id="sortTable">
	<thead>
			<tr>
                                <th> Interest</th>
                                <th> Item count</th>
                                <th width="500"></th>
			</tr>
		</thead>
                <tbody><?php foreach($interests as $interest): ?>
			<tr>
			<td><?php echo$interest['sectionName'] ?></td>
                        <td><span class="label label-info"> <?php echo $interest['itemcount'] ?> item/s</span></td>
                        <td style="padding-top:10px;">
                        <a href="<?php echo site_url('admin/profiling/viewItem').'/'.$interest['sectionID'] ;?>" class="btn blue">View Items</a>
                        <a href="<?php echo site_url('admin/profiling/addItem_Interest').'/'.$interest['sectionID'] ;?>" class="btn green">Add Items</a>
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
         
         <div id="Ability">
   
             
       <table class="tablesorter" id="sortTable2">
		<thead>
			<tr>
                                <th> Ability</th>
                                <th> Item count </th>
                                <th width="500"></th>
			</tr>
		</thead>
                <tbody><?php foreach($abilities as $ab): ?>
			<tr>
			<td><?php echo$ab['sectionName'] ?></td>
                        <td><span class="label label-info"><?php echo$ab['itemcount'] ?> item/s </span></td>
                        <td style="padding-top:10px;">
                        <a href="<?php echo site_url('admin/profiling/viewItem').'/'.$ab['sectionID'] ;?>" class="btn blue">View Items</a>
                        <a href="<?php echo site_url('admin/profiling/addItem_Ability').'/'.$ab['sectionID'] ;?>" class="btn green">Add Items</a>
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
                            
                          
			</div>

	