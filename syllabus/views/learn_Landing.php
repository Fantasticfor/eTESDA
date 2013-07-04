
    <div class="container offsetdown" >
       

            <div class="span9">

                
                <div class="sticky-wrapper" id="sticker-sticky-wrapper" >
                <div id="sticker" >
                           <div class="span9">

                
               
                    <div class="row">
                    <h2 > Lost? Try out our courses for free!</h2>
                    <h3> <em>To start, choose an industry below:</em></h3>
                    <hr>
                    
                    </div>
                
                    <ul class="thumbnails">
                       
                        <div class="row">
                           <?php foreach($sectors as $sector): ?>
                          
                            <li class="span2 sector ">
                                <a class="thumbnail" id="{{name}}">
                                
                                    <img src="<?php echo base_url(); ?>uploads/default/files<?php echo $sector['icon']; ?>" alt="">
                    
                                   
                                </a>
                            </li>
                            <?php endforeach; ?>

                        </div>
                       

                      
           
                

                </ul>
            </div>
        </div>
            </div>
        
                
            </div>
        
        
            
          <div class="span5" >
            
                <div class="well " id ="content_area">  
                    <div class="row" style="height: 400px">
                        <div class="offset1" style="margin-top:50px">
                            
                             <?php echo Asset::img('big_logo.png', 'alt text',array('width' => 150,'height'=> 150) );?>
                        
                        
                        </div>
                     </div>
                  
                   
                   
                   
                </div> 
                
            </div>

        



    </div><!--/span-->
    
   