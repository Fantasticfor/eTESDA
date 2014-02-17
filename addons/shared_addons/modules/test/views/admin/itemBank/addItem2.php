<section class="title blue">

	<h4>Add Item</h4>


</section>

<section class="item">
<div class="content">

<?php echo form_open_multipart() ?>





	
	<div class="form_inputs">
		<fieldset>
			<ul>
				<li>
					<label for="title">Question / Item Title: <span>*</span> </label>
					<div class="input"><?php echo form_input('title') ?></div>
				</li>
	
				
	
				<li>
					<label for="itemType">Item Type </label>
					<div class="input"><?php echo form_dropdown('itemType', array('Multiple Choice' =>'Multiple Choice', 'Identification' => 'Identification','True or False'=>'True or False')) ?></div>
				</li>
                                   
                              
                                      <li style="float:left">
                                          <h4><strong> Assign to: </strong></h4>
                                    <div style="float:left">
					<label for="course">Course </label>
					<div class="input"><?php echo form_dropdown('course', array('course' =>'--Choose a Course', 'computer hardware servicing' => 'Computer Hardware Servicing')) ?>
                                        </div>
				</div>
                                    <div style="float:left;margin-left:20px">
                                        <label for="module">Module</label>
					<div class="input"><?php echo form_dropdown('module', array('module' =>'--Choose a Module--', 'Installing Computers' => 'Installing Computers', 'Installing Network Hardware'=> 'Installing Network Hardware')) ?></div>
                                </div>
                                    </li>
                                    
                                      <li style="float:left">
                                    <div style="float:left">
					<label for="skill">Skill </label>
					<div class="input"><?php echo form_dropdown('skill', array('Installing Computers' =>'Installing Computers', 'Installing Networking Systems' => 'Installing Networking Systems')) ?></div>
				</div>
                                    <div style="float:left;margin-left:20px">
                                        <label for="difficulty">Difficulty</label>
					<div class="input"><?php echo form_dropdown('difficulty', array('easy' =>'Easy', 'medium' => 'Medium', 'hard'=> 'Hard')) ?></div>
                                </div>
                                    </li>
                                    

                                <li style="float:left; margin-top:30px">
                                   
                                    <fieldset>
                                        <legend> Response</legend>
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
                                        
                                        
                                    
                                        

                                        </fieldset>
                                    </li>

                                    

			</ul>
		
		</fieldset>
	</div>

	

	
	

<div class="buttons">
	<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'save_exit', 'cancel'))) ?>
</div>



</div>
</section>