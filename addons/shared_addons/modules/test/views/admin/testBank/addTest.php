
<div class="one_full">
 <ul id="breadcrumbs-one">
		<li><a href="<?php echo site_url('admin/test/testBank#oa')?>" > Manage Online Assessment</a></li>
		
		<li><a href="<?php echo site_url($this->uri->uri_string()) ?>" class="current" ><?php echo $coursedetails ?> Online Assessment</a></li>
	</ul>
  
</div>
<div class="one_full">

<section class="title blue">

	<h4>Computer Hardware Servicing Online Assessment</h4>


</section>

<section class="item">
<div class="content">

    <div class="one_full">

    
<?php echo form_open($this->uri->uri_string()) ?>


	<div class="form_inputs" >
		<fieldset>
			<ul>
                            
                                
                                
                                
	   
                                    
                                  
                                        <legend > Add Test Section </legend>
                                        <br>
					
                       
                            <div class="one_full" >
    <table >
    <thead>
        <tr>
            <th>Section #</th>
              <th>Competency</th>
             
             <th> Item Type</th>
             <th>No. of Items</th>
            
        </tr>
    <tbody> 
        <?php $ctr = 1 ?>
        <?php foreach($modules as $m):?>
        <tr>
           
            <td><?php echo $ctr ?></td>
            <td> <?php echo form_dropdown('modules[]',$modules,$item->modules) ?></td>
           
            <td> <?php $att = 'class="sec_itemtype"'; 
                                             echo form_dropdown('testtype[]',$dropdownvalues,$item->testtpe,$att) ?></td>
             <td> <?php echo form_input( array('class'=> 'sec_noitems', 'name'=>'section_noitems[]')) ?></td>
            
            
        </tr>
        <?php $ctr++ ?>
        <?php endforeach ?>
    </tbody>
    </thead>
    <tbody>
       
        <tr>
            
        </tr>
    </tbody>
</table>
                                </div>
                            
                            
			</ul>
		
		</fieldset>
	</div>

<div class="buttons">
    <button class="btn blue" value="Save" > Save</button> <a class="btn gray">Cancel</a>
	<?php form_close(); ?>
</div>


</div>
</div>
</section>
    </div>