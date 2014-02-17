


			<div id="content-body">
				






				<div class="one_full">

   
     
        	<section class="title blue">
		<h4>Profiling Test Bank</h4>
	</section>
        <section class="item">
 <div style="margin:10px 10px 10px 10px; "> 
     <div class="content tabs">
        <ul class="tab-menu">
           
		<li><a href="#Interest"><span>Interest Test</span></a></li>
                 <li><a href="#Ability"><span>Ability Test  </span></a> </li>
	</ul>
         
          <div id="Interest">

              <a class="btn green" href="<?php echo site_url('admin/profiling/testBank/addTest' ) ;?>" style="margin-left:20px; margin-top:15px">Add Section </a>
              <hr>
          <table class="tablesorter" id="sortTable"> 
                    <thead>
                    <tr>
                    <th width="200px">Section no.</th>
                    <th  width="200px">Interest</th>
                    <th width="80px">No. of items</th>
                    
                    
                    <th width="300px"></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $ctr = 1 ?>
                        <?php foreach($interest as $i): ?>
                    <tr>
                        <td> Section   <?php echo $ctr ?></td>
                         <td> <?php echo $i['sectionName'] ?></td>
                        <td><span class="label label-info"> <?php echo $i['noOfItems'] ?></span></td>
                        
     
                        <td> <a class="btn gray modal cboxElement" href="<?php echo base_url().'admin/profiling/testBank/editTest/'.$i['sectionID']?>" >Edit</a></td>
                    </tr>
                    
                   
                           <?php $ctr++ ?>
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
            <a class="btn green" href="<?php echo site_url('admin/profiling/testBank/addTest' ) ;?>" style="margin-left:20px; margin-top:15px">Add Section </a>
              <hr>
             
                <table class="tablesorter" id="sortTable2"> 
                    <thead>
                    <tr>
                    <th>Section no.</th>
                    <th >Ability</th>
                    <th width="80px">No. of items</th>
                    <th width="80px"></th>
                    </tr>
                    </thead>
                    <tbody>
                         <?php $ctr = 1 ?>
                        <?php foreach($ability as $i): ?>
                    <tr>
                        <td> Section <?php echo $ctr ?></td>
                        <td> <?php echo $i['sectionName'] ?></td>
                        <td><span class="label label-info"> <?php echo $i['noOfItems'] ?> </span></td>
                        
                        <td> <a class="btn gray modal cboxElement" href="<?php echo base_url().'admin/profiling/testBank/editTest/'.$i['sectionID']?>" >Edit</a></td>
                    </tr>
                           
                    
                           <?php $ctr++; ?>
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
  
     </div>       
        </section>
        
 
	
</div>
                         
			</div>

	