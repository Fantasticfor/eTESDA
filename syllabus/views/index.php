
    <div class="container offsetdown" >
       

            <div class="span9">

               
                
               
                    <div class="row">
                    <h2 > Lost? our courses for free!</h2>
                    <h3> <em>To start, choose an industry below:</em></h3>
                    <hr>
                    
                    </div>
                
                    <ul class="thumbnails">
                       
                        <div class="row">
                             
                          <?php $sectList = $this->session->disp_sectors('path');?>
                          <?php    $counter = 0; ?>
                                    
                              <?php foreach($sectList as $sect): ?>
                              
                                 <?php if($counter != 4): ?>
                                    <li class="span2 sector ">
                                            <?php echo Asset::img($path, 'alt text' ); ?>
                                            <?php $counter += 1;?>
                                       </li>
                                        <? else: ?>
                                       <div class="row">
                                       <br>
                                         <?php   $counter = 0;?>
                                
                                   <?php endif ?>
                             <?php endforeach; ?>          
                                 
                         
                                       
                       </ul>
           </div>
                       

 </div>
                          
                         
        
  