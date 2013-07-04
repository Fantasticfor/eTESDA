<div class="container"> 
<div class="row " style="padding-bottom: 300px">
                <div class="span12">
                <h1> Edit Account</h1>
                   <ul class="nav nav-tabs" id="myTab3">
  <li  class="active" >
    <a href="#basic" data-toggle="tab">Basic Information</a>
  </li>
  <li ><a href="#account" data-toggle="tab"> Account Settings</a></li>
  
</ul>
         
               
               <!--editBasic-->
               <div class="span9 tab-content" id="myTabContent3">
                      
                     <div class="tab-pane fade active in" id="basic">
                     <form> 
                        
                        <table id="user">
                            <?php echo form_open(); ?>
                             <tr>
                                <td > Username:</td>  
                                <td >
                                    <?php
                                     $username = array('type'=>'text', 'id'=> 'username', 'placeholder'=>'Enter username');
                            echo form_input($username);?>
                                    
                                </td>  
                                
                            </tr>
                            
                            <tr>
                                <td > First Name:</td>  
                                <td > 
                                    <?php $fname = array('type'=>'text', 'id'=> 'fname', 'placeholder'=>'Enter first name');
                            echo form_input($fname);?>                                    
                                </td>  
                                
                            </tr>
                            <tr>
                                <td > Middle Name:</td>  
                                <td > 
                                
                                      <?php $mname = array('type'=>'text', 'id'=> 'mname', 'placeholder'=>'Enter middle name');
                            echo form_input($mname);?>  
                                
                                </td>  
                                
                            </tr>
                            <tr>
                                <td > Last Name:</td>  
                                <td >
                                    
                                     <?php $lname = array('type'=>'text', 'id'=> 'lname', 'placeholder'=>'Enter last name');
                            echo form_input($lname);?>  
                                
                                
                                </td>  
                                
                            </tr>
                            <tr>
                                <td > Home Address:</td>  
                                <td > 
                                    <?php $address = array('type'=>'text', 'id'=> 'address', 'placeholder'=>'Enter home address');
                            echo form_input($address);?>  
                                
                                </td>  
                                
                            </tr>
                            <tr style="height:20px"></tr> 
                           
                            <tr> 
                              <td> Profile Picture:</td>
                              
                            <td> 
                                <img src="../assets/img/kenken.jpg">
                                <input name="user_profilepic" type="file" > </td>
                            </tr>
                            </tr>
                            <tr style="height:20px"></tr>
                            <tr> 
                                <td></td> 
                                <td>
                                        <?php $save = array( 'class'=> 'btn btn-primary');
                                                echo form_submit($save,'Save Changes');?>  
                             
                                
                                </td></tr>
                             <?php echo form_close(); ?>
                        </table>
                    
                    
                    
                    </form> 
                    </div>
                            <!--editAccount-->
                     <div class="tab-pane fade " id="account">
                         
                         <?php echo $this->load->view('Profile/EditAccounts');?>
                         
                    </div>
                    </div>        
                    </div>
                   
                </div>    
                </div>      

            