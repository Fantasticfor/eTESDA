  <div class="alert">
            
             <?php if(!($error)): ?>
              Already have an account? <a href=""> Sign in here</a>!
             <?php else: ?>
              <?php echo $error ?>
             <?php endif; ?>
                
         </div>
       
       <div class="span3">
                                
                                     <div class="control-group ">
                                       
                                        <div class="controls">
                                              <?php
                                    echo form_open('learner/signup_validation');
                                    echo form_input(array(
                                       'name' => 'fname',
                                       'id' => 'fname',
                                       'value' => '',
                                        'placeholder' => 'First Name'
                                       )); 
                                    ?>   
                                            <br>
                                            <?php
                               
                                    echo form_input(array(
                                       'name' => 'mname',
                                       'id' => 'mname',
                                       'value' => '',
                                        'placeholder' => 'Middle Name'
                                       )); 
                     
                                    ?>
                                            <br>
                                            
                                           <?php
                                     echo form_input(array(
                                       'name' => 'lname',
                                       'id' => 'lname',
                                       'value' => '',
                                         'placeholder' => 'Last Name'
                                        
                                       )); 
                     
                                    ?>
                                        </div>
                                         
                                          <div class="controls">
                                                <?php
                                     echo form_input(array(
                                       'name' => 'email',
                                       'id' => 'email',
                                       'value' => '',
                                         'placeholder' => 'example@email.com'
                                       )); 
                     
                                    ?>

                                        </div>
                                         
                                          <div class="controls">
                                               <?php
                                     echo form_password(array(
                                       'name' => 'password',
                                       'id' => 'password',
                                       'value' => '',
                                         'placeholder' => '&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;'
                                       )); 
                     
                                    ?>


                                        </div>
                                         
                                          <div class="controls">
                                               <?php
                                     echo form_password(array(
                                       'name' => 'cpassword',
                                       'id' => 'cpassword',
                                       'value' => '',
                                         'placeholder' => '&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;'
                                       )); 
                     
                                    ?>


                                        </div>
                                         
                                           <div class="controls">
                                              <a class="btn btn-link" style="font-size:8pt; margin-left:-10px"> Terms and Condition</a>


                                        </div>
                                         
                                         <div class="controls">
                                              <?php
                                  
                                $data = array(
                                'name'        => 'signup_submit',
                                'class'       => 'btn btn-success',
                                  );
                                 echo form_submit($data,'Sign up!');
                                  echo form_close();
                                 ?>


                                        </div>
                                    </div>
 
                                
       </div>
       <div class="span1" style="width:3px;height:250px">
           <span class="" style="position:relative;top:40%; left:5px; "><strong>  OR </strong> </span>
      </div>
       <div class="span3" style="margin-left:55px"> 
           <div class="control-group">
           
               <div class="controls" style="margin-top: 95px">              
<a href="<?php echo base_url()."learner/facebook_request" ?> ">  <?php echo Asset::img('fb_connect.png', 'alt text');?></a>
                   
                   </div>
           </div>
       </div>