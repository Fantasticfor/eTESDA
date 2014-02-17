  

      <div class="span7 well">
    
	<h3 >Sign in to e-TESDA Learn</h3>

<?php //echo form_open('users/login', array('id'=>'login'), array('redirect_to' => $redirect_to)) ?>
        
       
           <div class="alert">
               <?php if(!($error)): ?>
                        No account yet?
                             <a href="{{ url:site }}users/login">Sign up here!</a>
               <?php else: ?>
                             <?php echo $error ?>
               <?php endif; ?>
                                
                        </div>
      
        <div class="span2">                  
                       <div class="control-group ">
                           <div class="controls">   
                         <?php 
                          echo form_open('learner/login_validation');
                         
                         echo form_input(array(
                          'name' => 'email',
                          'id' => 'email',
                          'value' => '',
                          'placeholder' => 'Email address',
                          )); 
                        
                         ?>
                               </div>
                        <div class="controls">
                         <?php 
                         
                         echo form_password(array(
                          'name' => 'password',
                          'value' => '',
                          'placeholder' => 'Password',
                          )); 
           
                        
                         
                         ?>
                        </div>
                           <!--
                           <div class="controls">
                           <a class="btn btn-link"> forget your Password?</a>
                           </div>-->
                            <div class="controls">
                                
                                <?php 
                                $data = array(
                        'name'        => 'login_submit',
                        'class'       => 'btn btn-primary',
                          );
                        echo form_submit($data,'Sign in');
                     
                        
                        echo form_close();
                        ?>
                           
                           </div>
                       </div>
                     
             </div>    
        
        <div class="span1" style="width:3px;height:150px">
           <span class="" style="position:relative;top:20%; left:80px; "><strong>  OR </strong> </span>
      </div>
        <div class="span3" style="margin-left:130px"> 
            <div class="control-group" > 
                <div class="controls" style="margin-top: 25px">  
                
                        <a href=<?php echo base_url()."learner/facebook_request" ?> > 
            <?php echo Asset::img('fb_login.png', 'alt text');?>
                             
                             </a>
                </div>
            
            </div>
        </div>
                        
                       
       </div>                
                    
    
                       
                    
        
       
        