<body data-spy="sc-test" data-target="#nav-test" data-offset="0" style="padding-top:-200px;" onload="//loadMOA()"  >

    
 <div id="ViewCertificate" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header" style="height:30px">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    
  </div>
  <div class="modal-body">
      <div class="well well-small">
      <h3> <?php echo Asset::img('glyphicons/glyphicons_332_certificate.png', 'alt text' );?>  Certificate of Completion</h3>
      <hr>
      <h5>Computer Hardware Servicing Online Assessment</h5>
    <p > This certifies that Ken Ken Albudin has passed the Online Assessment of Computer Hardware Servicing
        <br>
        <small> on February 10,2013</small>
    </p>
    
    
    </div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
  
  </div>
</div>
<div class="container offset1"  >
            <div class="row" style="padding-bottom:100px; ">
                
                <div class="span13 ">
                   
                    <div class="span12">
                     <div  class="well well-small well-blue">
                     <h3> <?php echo $cName->title; ?></h3>
                    <h5> Online Assessment</h5>
                   </div>
                  </div>
                    
                 
                        
                    
                    <div class="span13" >
                        
                         <?php if(($totalscore/$totalitems)*100 >= 60):?>
                        <div class="alert alert-success "> <h4>Great Job! You've passed the Test! <a class="btn btn-success  btn-mini" href="<?php echo base_url().'learner/endorsePage'?>"  target="_blank"> Endorse to E-Cert </a></h4>  </div>
                       <?php else:?>
                        <div class="alert alert-error "> <h4>Sorry, but you have to failed the test,<a href="<?php echo base_url().'test/generateOATest/'.$cName->id ?>"> Try again?</a>  </h4> </div>
                        <?php endif?>
                       
                        
                               <div class="span5" >
                             <h4><i class="icon-list-alt"></i> Results</h4>
                            <div class="span2 ">
                        <span class="label label-info" > Total Score:</span>
                            <h1> <?php echo $totalscore ?>/<?php echo $totalitems?> </h1>
                              <span class="label label-info" > Test Duration:</span>
                            <h5> <?php echo $hour.' hr ' .$min.' min '.$sec.' sec'?></h5>
                            
                                
                            </div>
                             <div class="span2">
                             
                        <ul class="thumbnails ">
                            
                            <li class="span2" style=" width:128px ">
                                 <?php if($totalscore/$totalitems *100 >= 90):?>
                        <div  class="thumbnail">
                      
                      <?php echo Asset::img('gold.png', 'alt text');?>
                      <h5 style="text-align:center">Gold badge earned!</h5>
                      
                      
                       <?php elseif($totalscore/$totalitems *100 >= 75 && $totalscore/$totalitems *100 < 90):?>
                      <?php echo Asset::img('silver.png', 'alt text');?>
                      <h5 style="text-align:center">Silver badge earned!</h5>
                    
                      
                      <?php elseif($totalscore/$totalitems *100 >= 60 && $totalscore/$totalitems *100 < 74):?>
                      <?php echo Asset::img('bronze.png', 'alt text');?>
                      <h5 style="text-align:center">Bronze badge earned!</h5>
                      
                     
                
                  </div> 
                                 <?php endif; ?>
                            </li>
                                 
                            </ul>
                     
                       
                        
                       </div>
                            <div class="span5">
                           <?php if(($totalscore/$totalitems)*100 >= 60): ?>   
                                <?php if($this->session->userdata('fbuser') != 0): ?>
                                <a href="<?php echo base_url().'test/shareOAFB/'.$resID?>" class="btn btn-primary " style="margin-bottom:10px;width:200px "> Share on FB </a>
                                <?php elseif($this->session->userdata('fbuser') == 0): ?>
                                <a onclick="alert('You need to connect your facebook account')" class="btn btn-primary" style="margin-bottom:10px;width:200px "> Share on FB</a>
                                <?php endif; ?>
                                
                                <a class="btn btn-primary "  href="<?php echo base_url().'syllabus/index'?>" style="margin-bottom:10px;width:200px"> Follow Another Course</a>
                            <?php else: ?>
                                <a href="<?php echo base_url().'syllabus/dispMods2/'.$cName->id?>" class="btn btn-primary " style="margin-bottom:10px;width:200px"> Review Modules  </a>
                            <?php endif; ?>
                            
                           </div>
                            </div>
                        
                        
                        
                     
                            <div class="span7">
                         
                            <h4><i class=" icon-th-list"></i> Competencies Earned</h4> 
                            <div style="overflow-y:scroll; max-height:400px">
                            <?php $sectionctr = 1; ?>
                            <?php foreach($sections as $section): ?>
                             <div class="media well well-small">
                <div class="media-body">
        <h5 class="media-heading"><?php echo $section['moduleID'] ?>
            <span class="label label-info"> <?php echo $secscores[$sectionctr]['score'] ?>/<?php echo $section['noOfItems'] ?></span> 
            
            <?php if(($secscores[$sectionctr]['score']/$section['noOfItems'])*100 >= 60): ?>
            <span class="pull-right text-success" > Competent</span></h5> 
            <?php else: ?>
           <span class="pull-right text-error"> Needs review</span>       
           <?php endif; ?>
            
            
            
            <div class="progress" style="height:15px">
  <div class="bar" style="width: <?php echo ($secscores[$sectionctr]['score']/$section['noOfItems'])*100?>%"></div>
</div>
                    </div>
                    </div>
                        <?php $sectionctr++; ?>
                        <?php endforeach; ?>
</div>
                   </div> 
                        </div>
                   
                
                        
                        
                     
                    
                    


                                    

                                  
</div>
                                    </div><!--/row-->


</div>
 
    
  
    </body>