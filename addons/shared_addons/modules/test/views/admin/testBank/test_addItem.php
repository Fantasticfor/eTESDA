
<div class="one_full">
 <ul id="breadcrumbs-one">
		<li><a href="" > Manage Tests</a></li>
		<li><a href="" >Create Test</a></li>
		<li><a href="" class="current"> Add Items to (Test Name)</a></li>
		
	</ul>
  
</div>
<div class="one_full">

<section class="title blue">

	<h4> Add Items to (Test Name)</h4>


</section>

<section class="item">
<div class="content">

    <div class="one_full">

    
<?php echo form_open_multipart() ?>


	<div class="form_inputs" >
		<fieldset>
			<ul>
                            <div class="one_half"> 
                                
                                
                                
	   
                                    
                                  
                                        <legend > Add Multiple Choice Items </legend>
                                        <br>
					     <li >
                                  
                                        <label for="itemtype" class="lbl_itemtype"> Question </label>
					<div class="input">
                                            
                                            <?php  echo form_input(array('id'=>'input_question')) ?></div>
                                
                                    
                                          </li>
                                        
                                          <li>
                                   
                                        <label for="numitems" class="lbl_noItems" >Responses</label>
					
                                        <div >
                                         <?php $first= array( 'type'=> 'radio');
                                                echo form_input($first);?> 
					
                                           <?php $response1 = array('type'=>'text', 'id'=> 'res1', 'placeholder'=>'Response 1');
                            echo form_input($response1);?>
                                        
                                        <br>
                                        
                                        <?php $second= array( 'type'=> 'radio');
                                                echo form_input($second);?> 
					
                                           <?php $response2 = array('type'=>'text', 'id'=> 'res2', 'placeholder'=>'Response 2');
                            echo form_input($response2);?>
			
                                        <br>
                                        
                                         <?php $third= array( 'type'=> 'radio');
                                                echo form_input($third);?> 
					
                                           <?php $response3 = array('type'=>'text', 'id'=> 'res3', 'placeholder'=>'Response 3');
                            echo form_input($response3);?>
                                        <br>
                                         <?php $fourth= array( 'type'=> 'radio');
                                                echo form_input($fourth);?> 
					
                                           <?php $response4 = array('type'=>'text', 'id'=> 'res4', 'placeholder'=>'Response 4');
                            echo form_input($response4);?>
				</div>
                                       <a class="btn green" id="addtoItemTable"> Add Item</a>  

                                    </li>
                                       
                                       <div style="float:left">
                                        
                                        </div>

                                   
                                 
                                  

                         </div>   
                            <div class="one_half" style="float:left;margin-left:20px">
                                <input type="hidden" id="redir" value="<?php echo site_url('admin/test/itemBank/addItem')?>">
                             <table id="table_id">
    <thead>
        <tr>
             <th>Question ID</th>
            <th> Question </th>
            
            <th></th>
        </tr>
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
    <a class="btn blue" onclick="closeTestItems()"> back</a>
	<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel'))) ?>
</div>


</div>
</div>
</section>
    </div>