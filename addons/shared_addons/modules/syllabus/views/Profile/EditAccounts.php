    <h5 class="gray">Change your Password</h5>
                                     <hr>
                                   
                        <table id="user">
                            
                            <?php echo form_open(); ?>
                             <tr>
                                <td > Current Password:</td>  
                                <td >
                                    <?php
                                     $currentPass = array('type'=>'password', 'id'=> 'current', 'placeholder'=>'current Password');
                            echo form_input($currentPass);?>
                                
                                </td>  
                                
                            </tr>
                            
                            <tr>
                                <td >New Password:</td>  
                                <td > 
                                <?php $NewPass = array('type'=>'password', 'id'=> 'New', 'placeholder'=>'New Password');
                            echo form_input($NewPass);?>
                                
                                </td>  
                                
                            </tr>
                            <tr>
                                <td > Re-enter New Password:</td>  
                                <td > 
                                <?php $reNewPass = array('type'=>'password', 'id'=> 'New', 'placeholder'=>'Re enter New Password');
                            echo form_input($reNewPass);?>
                                
                                </td>  
                           
                            </tr>
                            
                            <tr> </tr>
                            <tr style="height:20px"></tr>
                          
                            <tr> <td></td> <td  >
                                    <?php $change = array( 'class'=> 'btn btn-primary pull-right');
                                                echo form_submit($change,'Change Password');?>  
                                     </td></tr>
                           <?php echo form_close(); ?> 
                        </table>
                                    
                                      
                                <h5 class="gray"> Notifications</h5>
                                <hr>
                                <form>
                                    <table id="user">
                                        <?php form_open();?>  
                                     
                             <tr>
                                <td style="width:300px"> Receive updates of new courses  </td>  
                                <td style="text-align:center"> 
                                    
                                     <?php $updates = array( 'type'=> 'checkbox');
                                                echo form_input($updates);?>  
                                 </td>  
                                
                            </tr>
                            
                            <tr>
                                <td style="width:300px" >Notify me when I'm slacking off</td>  
                                <td style="text-align:center" >
                                      <?php $notify = array( 'type'=> 'checkbox');
                                                echo form_input($notify);?>  
                                    
                                </td>  
                                
                            </tr>
                            
                            
                            <tr> </tr>
                            <tr style="height:20px"></tr>
                            <tr><td></td>
                                <td>
                            <?php $save2 = array( 'class'=> 'btn btn-primary');
                                                echo form_submit($save2,'Save Changes');?>  
                           
                                    
                                    </td></tr>
                          
                             <?php form_close();?>  
                         
                        </table>
                                
                             </form> 
                                
                                      <h5 class="gray"> Link my Account</h5> 
                                   
                            <hr>
                            
                           
                                
                             <table id="user">
                              
                             <tr>
                                <td style="width:270px"> Link my Account to Facebook </td>  
                                <td style="text-align:center"> <btn class="btn"> Unlink Account</btn></td>  
                                
                            </tr>
                             <tr style="height:20px"></tr>
                          
                            
                            
                            <tr> </tr>
                           
                          
                         
                            
                        </table>
                              
                            
                                
                                
                                
                                     
                                   <h5 class="gray"> Facebook Settings</h5> 
                                   
                            <hr>
                            
                            <form>
                             <table id="user">
                              
                             <tr>
                                <td style="width:270px"> Publish activities to my Timeline  </td>  
                                <td style="text-align:center">
                                    <?php $timeline = array( 'type'=> 'checkbox');
                                                echo form_submit($timeline);?>
                                   </td>  
                                
                            </tr>
                             <tr style="height:20px"></tr>
                            <tr>
                                <td></td>
                                   
                                <td ><?php $save3 = array( 'class'=> 'btn btn-primary');
                                                echo form_submit($save3,'Save Changes');?></td>  
                                                                
                            </tr>
                            
                            
                            <tr> </tr>
                           
                          
                         
                            
                        </table>
                              
                             </form>     
                    
                         
