<div class="span9 offset1">   
<ul class="nav nav-tabs" id="myTab3">
  <li class="active" >
  <a href="#onlineAssessment" data-toggle="tab"> Online Assessments</a>
  </li>
  <li >
      <a href="#SelfCheck" data-toggle="tab">Self-Check Tests</a></li>
 
              </ul>


<div class=" well well-small tab-content " id="myTabContent3">

   <div class="tab-pane fade active in" id="onlineAssessment">
         <h4><?php echo Asset::img('glyphicons/glyphicons_039_notes.png', 'alt text' );?> Ongoing Online Assessments</h4>
    
     <div class="row offset1 mini" style="padding-top:20px">
         
        <ul class="thumbnails">
            
                            <li class="span4 small"> 
                  <div class="thumbnail course" href='<?php echo base_url()."syllabus/Modules" ?>'>
             <?php echo Asset::img('dummy/computer hardware Servicing 260x120.jpg', 'alt text',array('class'=>"media-object",'data-src'=>"holder.js/260x120") );?>
                       <!--<img data-src="holder.js/260x120" alt="">-->
                      
                        <h5>Computer Hardware Servicing Assessment <span class="label label-info">50 items</span> </h5>
                    <p> Information Technology </p>
                    <a class="btn btn-success"> Take Test</a>
                        
                  </div>
                              </li>
                      
                    </ul>
         
         
     </div>
         
         <hr>
                <h4><?php echo Asset::img('glyphicons/glyphicons_039_notes_check.png', 'alt text' );?> Finished Online Assessments</h4>
    
     <div class="row offset1 mini" style="padding-top:20px">
         
         <ul class="thumbnails">
                            <li class="span4 small"> 
                  <div class="thumbnail course" href='<?php echo base_url()."syllabus/Modules" ?>'>
             <?php echo Asset::img('dummy/computer hardware Servicing 260x120.jpg', 'alt text',array('class'=>"media-object",'data-src'=>"holder.js/260x120") );?>
                       <!--<img data-src="holder.js/260x120" alt="">-->
                      
                        <h5>Computer Hardware Servicing Assessment <span class="label label-info">50 items</span> </h5>
                    <p> Information Technology </p>
                    <a class="btn btn-success"> Take Test</a>
                    <a class="btn btn-primary"> View Results</a>    
                  </div>
                              </li>
                      
                    </ul>
         
         
               
       
                
                        </div>
                
                    
                    
    
                         
                        </div>
   
      <div class="tab-pane fade in"  id="SelfCheck">
   
            <div class="row offset1 mini" style="padding-top:20px">
         
         <ul class="thumbnails">
                            <li class="span4 small"> 
                  <div class="thumbnail course" href='<?php echo base_url()."syllabus/Modules" ?>'>
             <?php echo Asset::img('dummy/computer hardware Servicing 260x120.jpg', 'alt text',array('class'=>"media-object",'data-src'=>"holder.js/260x120") );?>
                       <!--<img data-src="holder.js/260x120" alt="">-->
                      
                        <h5>Computer Hardware Servicing Self-Check <span class="label label-info">50 items</span> </h5>
                    <p> Information Technology </p>
                    
                    <a class="btn btn-primary" href='<?php echo base_url()."learner/viewSelfCheck"?>'> View Results</a>    
                  </div>
                              </li>
                      
                    </ul>
         
         
               
       
                
                        </div>
         
     </div>
    
         
 </div>
    </div>
    
     
  
         
         
 