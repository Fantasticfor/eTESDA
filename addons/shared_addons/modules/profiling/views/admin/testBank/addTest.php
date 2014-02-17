
<div class="one_full">
 <ul id="breadcrumbs-one">
		<li><a href="" > Manage Tests</a></li>
		<li><a href="" class="current" >Computer Hardware Servicing Online Assessment </a></li>
		
	</ul>
  
</div>
<div class="one_full">

<section class="title blue">

	<h4>Computer Hardware Servicing Online Assessment</h4>


</section>

<section class="item">
<div class="content">

    <div class="one_full">

    
<?php echo form_open_multipart() ?>


	<div class="form_inputs" >
		<fieldset>
			<ul>
                            
                                
                                
                                
	   
                                    
                                  
                                        <legend > Add Test Section </legend>
                                        <br>
					
                       
                            <div class="one_full" >
    <table >
    <thead>
        <tr>
             <th>Section No.</th>
             <th>No. of Items</th>
             <th>Competency</th>
            <th> Item Type</th>
        </tr>
    <tbody> 
        <tr>
            <td> Section 1</td>
            <td> <?php echo form_input('input_noItems'); ?></td>
            <td> <?php echo form_dropdown('select_com'); ?></td>
            <td> <?php echo form_dropdown('select_type'); ?></td>
        </tr>
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
    <a class="btn blue" href="<?php echo site_url('admin/test/testBank/')?>" > Save</a> <a class="btn gray">Cancel</a>
	
</div>


</div>
</div>
</section>
    </div>