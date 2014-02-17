<div class="span12">
<div class="span8">
<ul class="nav nav-tabs" id="myTab3">
  <li class="active" >
  <a href="#ongoingAssessment" data-toggle="tab"> Ongoing Assessments</a>
  </li>
  <li >
      <a href="#FinishedAssessment" data-toggle="tab"> Finished Assessments</a></li>
 
              </ul>


<div class=" well well-small tab-content " id="myTabContent3">

   <div class="tab-pane fade active in" id="ongoingAssessment">
         <h4><?php echo Asset::img('glyphicons/glyphicons_039_notes.png', 'alt text' );?> Ongoing Online Assessments</h4>
    
     <div class="row offset1 mini" style="padding-top:20px">
         
         <ul class="thumbnails">
  <li class="span3">
    <div class="thumbnail">
      <?php echo Asset::img('hk.jpg', 'alt text', array('width'=> 300 ,'height'=> 200) );?>
      <h4>Guestroom Servicing </h4>
      
      <p>
          
      </p>
      <p>
          
          <a class="btn btn-primary" href='<?php echo base_url()."learner/testAssessment" ?>'> Take Test</a>
      </p >
    </div>
  </li>
  
  <li class="span3">
    <div class="thumbnail">
      <?php echo Asset::img('hk.jpg', 'alt text', array('width'=> 300 ,'height'=> 200) );?>
      <h4>Guestroom Servicing </h4>
      
      <p>
          
      </p>
      <p>
          
          <a class="btn btn-primary"> Take Test</a>
      </p>
    </div>
  </li>
  
  <li class="span3">
    <div class="thumbnail">
      <?php echo Asset::img('hk.jpg', 'alt text', array('width'=> 300 ,'height'=> 200) );?>
      <h4>Guestroom Servicing </h4>
      
      <p>
          
      </p>
      <p>
          
          <a class="btn btn-primary"> Take Test</a>
      </p>
    </div>
  </li>
  
</ul>
         
         
     </div>
               
       
                
                        </div>
                    
                    
      <div class="tab-pane fade in"  id="FinishedAssessment">
          <h4><?php echo Asset::img('glyphicons/glyphicons_039_notes_check.png', 'alt text' );?> Finished Online Assessments</h4>
    
     <div class="row offset1 mini" style="padding-top:20px">
         
         <ul class="thumbnails">
  <li class="span3">
    <div class="thumbnail">
      <?php echo Asset::img('hk.jpg', 'alt text', array('width'=> 300 ,'height'=> 200) );?>
      <h4>Guestroom Servicing </h4>
      
      <p>
          <h5>Score: 80/100</h5>
      </p>
      <p>
          
          <a class="btn btn-primary"> Take Test</a>
          <a class="btn"> View Results </a>
      </p>
    </div>
  </li>
  
 
  
</ul>
         
         
     </div>
                         
                        </div>
   
         
 </div>
  </div>  
  </div>  
     
  
         
         
 