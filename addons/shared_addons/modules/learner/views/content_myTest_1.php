   <ul class="nav nav-tabs" id="myTab3">
  <li class="active" ><a href="#onlineAssessment" data-toggle="tab"> Online Assessments <span class="badge badge-success">1</span> </a> </li>
  <li ><a href="#SelfCheck" data-toggle="tab">Self-Check Tests</a></li>
  
              </ul>


<div class=" well well-small tab-content " id="myTabContent3">
  <input type="hidden" id="baseurl" value='<?php echo base_url()?>' >
   <div class="tab-pane fade active in" id="onlineAssessment">
         <h4><?php echo Asset::img('glyphicons/glyphicons_039_notes.png', 'alt text' );?> Ongoing Online Assessments</h4>
    
     <div class="row offset1 mini" style="padding-top:20px">
         
        <ul class="thumbnails">
            <li class="span4 small"> 
                  <div  class="thumbnail course" href='<?php echo base_url()."syllabus/Modules" ?>'>
                      <?php echo Asset::img('dummy/CHS_1170x480.png', 'alt text',array('class'=>"media-object",'data-src'=>"holder.js/260x120") );?>
                        <h5>Computer Hardware Servicing Assessment </h5>
                    <p> Information Technology
                        <br>
                        Total Test Items:<span class="label label-success"> 50 items</span>
                        <br> 
                        Score: <span class="label"> --</span>
                        <br>
                        Test Duration: <span class="label "> --</span>
                    </p>
                    <a class="btn btn-success"> Take Test</a>
                  </div>
                </li>
             </ul>
         
         
     </div>
         
         <hr>
                <h4><?php echo Asset::img('glyphicons/glyphicons_039_notes_check.png', 'alt text' );?> Passed Online Assessments</h4>
    
     <div class="row offset1 mini" style="padding-top:20px">
         
         
          <ul class="thumbnails">
            <li class="span4 small"> 
                  <div  class="thumbnail course" href='<?php echo base_url()."syllabus/Modules" ?>'>
                      <?php echo Asset::img('dummy/CHS_1170x480.png', 'alt text',array('class'=>"media-object",'data-src'=>"holder.js/260x120") );?>
                        <h5>Computer Hardware Servicing Assessment</h5>
                    <p>
                        Information Technology
                        <br>
                        Total Test Items:<span class="label label-success"> 50 items</span>
                        <br>
                        Score: <span class="label label-success"> 38/40</span>
                        <br>
                        Test Duration: <span class="label "> 18 min and 30 secs</span>
                        
                    </p>
                    <a class="btn btn-success"> Take Test</a>
                     <a class="btn btn-primary" href="<?php echo base_url()."learner/viewResultsOA " ?>" data-id="1" id="viewRes" data-toggle="modal"> View Results </a>
                  </div>
                </li>
             </ul>
        </div>
                
      
   </div>
    
   
      <div class="tab-pane fade in"  id="SelfCheck">
   
            <div class="row offset1 mini" style="padding-top:20px">
         
                <h4><?php echo Asset::img('glyphicons/glyphicons_039_notes.png', 'alt text' );?> Self-Checks</h4>
         <ul class="thumbnails">
                            <li class="span4 small"> 
                  <div class="thumbnail course" href='<?php echo base_url()."syllabus/Modules" ?>'>
             <?php echo Asset::img('dummy/computer hardware Servicing 260x120.jpg', 'alt text',array('class'=>"media-object",'data-src'=>"holder.js/260x120") );?>
                       <!--<img data-src="holder.js/260x120" alt="">-->
                      
                        <h5>Computer Hardware Servicing Self-Check </h5>
                    <p> Information Technology </p>
                    
                    <a class="btn btn-primary" href='<?php echo base_url()."learner/viewSelfCheck"?>'> View Self-Checks</a>    
                  </div>
                              </li>
                      
                    </ul>
         
         
               
       
                
                        </div>
         
     </div>
    
     
         
 </div>
    
     
  
         
         
 