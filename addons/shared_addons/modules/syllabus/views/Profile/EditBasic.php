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
          
                        <?php foreach($compDets as $comp):?>
                        <table id="user">
                            <?php echo form_open('syllabus/submitCh'); ?>
                             <tr>
                                <td > Email:</td>  
                                <td >
                                    <?php
                                     $username = array('type'=>'text', 'name'=> 'email', 'placeholder'=>'Enter email', 'value'=> $comp['email']);
                            echo form_input($username);?>
                                    
                                </td>  
                                
                            </tr>
                            
                            <tr>
                                <td > First Name:</td>  
                                <td > 
                                    <?php $fname = array('type'=>'text', 'name'=> 'fname', 'placeholder'=>'Enter first name', 'value'=> $comp['firstname']);
                            echo form_input($fname);?>                                    
                                </td>  
                                
                            </tr>
                            <tr>
                                <td > Middle Name:</td>  
                                <td > 
                                
                                      <?php $mname = array('type'=>'text', 'name'=> 'mname', 'placeholder'=>'Enter middle name', 'value'=> $comp['middlename']);
                            echo form_input($mname);?>  
                                
                                </td>  
                                
                            </tr>
                            <tr>
                                <td > Last Name:</td>  
                                <td >
                                    
                                     <?php $lname = array('type'=>'text', 'name'=> 'lname', 'placeholder'=>'Enter last name', 'value'=> $comp['lastname']);
                            echo form_input($lname);?>  
                                
                                
                                </td>  
                                
                            </tr>
                            <tr>
                                <td > Cellphone Number:</td>  
                                <td >
                                    
                                     <?php $cpNum = array('type'=>'text', 'name'=> 'cpNum', 'placeholder'=>'Enter cellphone number', 'value'=> $comp['cellno']);
                            echo form_input($cpNum);?>  
                                
                                
                                </td>  
                                
                            </tr>
                            <tr>
                                <td > Birthday:</td>  
                                <td >
                                    
                                     <?php $bday = array('type'=>'text', 'name'=> 'bday', 'placeholder'=>'Enter birth date', 'value'=> $comp['birthday']);
                            echo form_input($bday);?>  
                                
                                
                                </td>  
                                
                            </tr>
                            <tr>
                                <td >House No:</td>  
                                <td > 
                                    <?php $houseNo = array('type'=>'text', 'name'=> 'houseNo', 'placeholder'=>'Enter house number', 'value'=> $comp['streetno']);
                            echo form_input($houseNo);?>  
                                
                                </td>  
                                
                            </tr>
                            
                            <tr>
                                <td >Barangay:</td>  
                                <td > 
                                    <?php $brgy = array('type'=>'text', 'name'=> 'brgy', 'placeholder'=>'Enter barangay', 'value'=> $comp['brgy']);
                            echo form_input($brgy);?>  
                                
                                </td>  
                                
                            </tr>
                            <tr>
                                <td >District:</td>  
                                <td > 
                                    <?php $dist = array('type'=>'text', 'name'=> 'dist', 'placeholder'=>'Enter district', 'value'=> $comp['district']);
                            echo form_input($dist);?>  
                                
                                </td>  
                                
                            </tr>
                            <tr>
                                <td >City:</td>  
                                <td > 
                                    <?php $city = array('type'=>'text', 'name'=> 'city', 'placeholder'=>'Enter city', 'value'=> $comp['city']);
                            echo form_input($city);?>  
                        
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
                               <input  type="submit" class="btn btn-primary"></input>
                                
                                </td></tr>
                             <?php echo form_close(); ?>
                        </table>
                    <?php endforeach; ?>
                    
                    
        
                    </div>
                            <!--editAccount-->
                     <div class="tab-pane fade " id="account">
                         
                         <?php echo $this->load->view('Profile/EditAccounts');?>
                         
                    </div>
                    </div>        
                    </div>
                   
                </div>    
                </div>      

            