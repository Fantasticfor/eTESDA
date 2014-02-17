
<div class="one_full">
 <ul id="breadcrumbs-one">
		<li><a href="<?php echo site_url('admin/test/')?>" > Item Bank </a></li>
		<li><a href="" class="current">Add Items to <?php echo $moduledetails->title ?> Item Bank</a></li>
                
		
	</ul>
  
</div>
<div class="one_full">

<section class="title blue">

	<h4>Add Items to <?php echo $moduledetails->title ?> Item Bank</h4>


</section>

<section class="item">
<div class="content">

    <div class="one_full">
           
    
<?php echo form_open_multipart() ?>


	<div class="form_inputs" >
		<fieldset>
			<ul>
                            <div class="one_full"> 

                                <div class="hoy"></div>
                                  
                                        <legend > Add Items </legend>
                                        <br>
                                        <div class="one_half">
                                      <li >
                                  
                                        <label for="itemtype" class="lbl_itemtype">Item Type</label>
					<div class="input">
                                            
                                            <?php $att = 'name ="select_itemtype", id="select_itemtype", class="select_itemtype" '; 
                                             echo form_dropdown('',$dropdownvalues,'Select',$att) ?></div>
                                        
                                        </li>
                                        
                                        <li >
                                    
                                    <div> 
                                        <label for="catgory">Test Type</label>
					<div class="input"><?php $att3 = 'class="select_cat"'; echo form_dropdown('catgory', array('0' =>'Online Assessment', '1' => 'Self Check', '2'=> 'Both'),'',$att3) ?></div>
                                </div>
                                  
                                  <br>   
                                 
                                  
                                    </li>
                                     
                              <li >
                                    
                                    <div> 
                                        <label for="difficulty">Difficulty</label>
					<div class="input"><?php $att3 = 'class="select_diff"'; echo form_dropdown('difficulty', array('Easy' =>'Easy', 'Medium' => 'Medium', 'Hard'=> 'Hard'),'',$att3) ?></div>
                                </div>
                                  
                                  <br>   
                                  <a class="btn green" id="addtoItemTable"> Add Item</a>    
                                  
                                    </li>
                                    
                                    
                                
                                
                                      
                                    </div>
                             
                                        
                                        <div class="one_half">

                                <li style="">
                                                                
					<li>
                                            
					<label for="title">Prompt/Question <span>*</span> </label>
					<div class="input"><?php echo form_input(array('name'=>'input_question','class'=>'input_question')) ?></div>
				</li>
                                    <div id="responses"></div>
                                 
                                    </li>

                    <input type="hidden" id="baseurl" value="<?php echo site_url('admin/test/addQA')?>">
                     <input type="hidden" id="baseurl1" value="<?php echo BASE_URL()?>">
                      <input type="hidden" id="removeurl" value="<?php echo site_url('admin/test/remove_item')?>">
                                 </div>
                                  

                         </div>   
                            <div class="one_full" >
                               
                             <table  id="item_table" class="tablesorter"  >
    <thead>
        <tr>
            
             
              <th>Prompt | Question</th>
             <th> Item Type </th>
             <th> Test Type </th>
              <th>Difficulty</th>
             <th></th>
    
        </tr>
    </thead>
    <tbody><?php
  if(isset($_SESSION['items']) && is_array($_SESSION['items'])){
    foreach($_SESSION['items'] as $key=>$input){
?> 
        <tr>
           
           <td><?php echo $input['item'][0] ?></td>
           <td> <?php echo $input['item'][4] ?></td> 
           <td> <?php if($input['item'][8] == 1){
               echo "Self Check";
           }else if($input['item'][8] == 0){
               echo "Online Assessment";
           }else
               {
               echo "Both";
           }
           
           ?>
           <td><?php echo $input['item'][2] ?> </td>
            <td>
              <!--<a class='btn btn-lesson blue modal cboxElement' id='viewRes' onclick="viewRes(<?php echo $key.','.$input['item'][1] ?>)" >View Responses</a>  <a class='btn btn-lesson red' id='removeItem'><i class='icon-remove'></i> Remove </a><input type='hidden' id='indexid' value="<?php echo $key ?>"/> </td> -->
             <a class='btn btn-lesson blue modal cboxElement' id='viewRes' href="admin/test/itemBank/modal_viewResponses?index=<?php echo $key ?>&type=<?php echo $input['item'][1]?>" >View Responses</a>  <a class='btn btn-lesson red' id='removeItem'><i class='icon-remove'></i> Remove </a><input type='hidden' id='indexid' value="<?php echo $key ?>"/> </td> 
        </tr>
        
        <?php
    }
  }else{
?> 
        <tr>
            
            
            
            
        </tr>
        
        
       <?php
  }
?> 
    </tbody>
</table>
                                </div>
                            
                            
			</ul>
		
		</fieldset>
	</div>

<div class="buttons">
    <a class="btn blue" href="<?php echo site_url('admin/test/saveItems/'.$moduledetails->id)?>" > Save</a> <a class="btn gray" href="<?php echo site_url('admin/test') ?>" onclick=" return confirm('Are you sure you want to cancel?') ">Cancel</a>
	
</div>


</div>
</div>
</section>
    </div>