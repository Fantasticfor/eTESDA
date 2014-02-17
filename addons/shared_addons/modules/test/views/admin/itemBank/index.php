


			<div id="content-body">
				






				<div class="one_full">

   
     
        	<section class="title blue">
		<h4>Item Bank</h4>
	</section>
        <section class="item" >
 <div class="content">
   
      <fieldset  >
	<legend>Filter</legend>
<ul style="float:left;" >
			

			<li style="display:inline-block;margin-left:20px">
        		<label for="f_course">Course</label>
                        <?php $att2 = 'name ="select_Course", id="select_Course", class="select_Course"'; 
                                             echo form_dropdown('',$courselist,'',$att2) ?>
                            
       			</li>

		</ul>
	</fieldset>  
     <div>
         <table id="sortTable" class="tablesorter">
             <thead>
             <tr>
             <th>Competency</th>
             <th>Item Count</th>
             <th></th>
             </tr>
             </thead>
              <tbody id="item_table">
                 <?php $ctr = 0; ?>
                  
                  <?php foreach($modulelist as $module): ?>
                  
             <tr>
                 <td><?php echo $module['title']?></td>
                 <td> <span class="label label-info"><?php echo $itemcount[$ctr] ?> item/s</span></td>
                 <td><a class="btn blue" href="<?php echo site_url('admin/test/viewItems/'.$module['id'])?>"> View Items</a>
                 <a class="btn green" href="<?php echo site_url('admin/test/addItem/'.$module['id'] ) ;?>"> Add Items</a></td>
             </tr>
             <?php $ctr++; ?>
           <?php              endforeach; ?>
             
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
        </section>
        
 
	
</div>
			</div>

	