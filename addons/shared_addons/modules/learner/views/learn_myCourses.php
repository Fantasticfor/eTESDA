  <ul class="nav nav-tabs" id="myTab">
  <li class="active" >
  <!--  <a href="{{url:site}}" data-toggle="tab" >Ongoing Courses </a>-->
  <a href="#ongoing" data-toggle="tab"> Ongoing Courses <span class="badge badge-success">1</span> </a> 
  </li>
  <li >
      <a href="#finished" data-toggle="tab"> Finished Courses <span class="badge badge-success">1</span> </a>  
  </li>
 
              </ul> 

 <div class=" well well-small tab-content " id="myTabContent"     >
       <div class="tab-pane fade active in" id="ongoing">
         
       <h4><?php echo Asset::img('glyphicons/glyphicons_351_book_open.png', 'alt text' );?> Ongoing Courses</h4>
       
         <div class="row " style="margin-left:10px;">
      <?php foreach($learnerCourses as $lc): ?>      
             <div class="accordion" id="accordion2" style="background-color:white;">
  <div class="accordion-group">
    <div class="accordion-heading">
         <div  style="position:absolute;"><a class="btn close " > &times; </a> </div>
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne"> </a>
      
      <div style="padding-left:30px">
          <h5> <a> 1/3 <?php echo $lc[0]['title']; ?></a> 
              <span class="label label-info">3 of 7 modules
              </span>
                </h5> 
          
       
          
        
                   
                   <div class="progress" style=" height:15px; margin-left: 19px; margin-right: 50px; margin-top:10px;"> 
  
                       <div class="bar bar-success" style="width:14.14%;"></div>
  <div class="bar bar-success" style="width: 14.14%;  margin-left:1px"></div>
   <div class="bar bar-success" style="width: 14.14%;  margin-left:1px"></div>
   <div class="bar-gray" style="width: 14.14%;  margin-left:1px; "></div>
    <div class="bar-gray" style="width: 14.14%;  margin-left:1px; "></div>
     <div class="bar-gray" style="width: 14.14%;  margin-left:1px; "></div>
      <div class="bar-gray" style="width: 14.14%;  margin-left:1px; "></div>
   
   
</div>
         </div>          
             
             
     
    </div>
     
    <div id="collapseOne" class="accordion-body collapse in">
      <div class="accordion-inner">
          <ul style="list-style:none" id="modules">
              <li class="modules">
<a  href="#" >                    
                      <?php echo Asset::img('icons/check.png', 'alt text');?> 
                          
    Getting Ready for Work </a> 
                  
                
              </li>
           
              <li><a href="#">
                      
                        <?php echo Asset::img('icons/check.png', 'alt text');?> 
                         
                      Preparing the Housekeeping Cart </a>  </li>
              
              <li><a href="#">   Entering the Room</a> 
             <a id="example" href="#" class="btn btn-small btn-success" style="margin-left: 10px"
                     data-toggle="popover" data-content="Washing your plates" data-original-title="Lesson 3"
                     > Resume</a> 
              
              </li>
              <li><a href="#" >
                      
                     
                      
                        Stripping Beddings </a>  </li>
              <li><a href="#"> 
                      
                      
                        Stripping Beddings
                      Making the bed </a>  </li>
              <li><a href="#" > 
                      Cleaning the Floor and Furniture </a>  </li>
              
              <li><a href="#" >  
                      Guest Room Servicing Online Assessment </a>  </li>
              
          
          </ul>
          
          
      </div>
    </div>
  </div>

</div>
   <?php endforeach; ?>          
             
        
             
             
             
             
             
             
        
</div>
           
         
     </div>
         
        <div class="tab-pane fade" id="finished">
         
            <!-- loads Finished Courses -->
               
         <h4><?php echo Asset::img('glyphicons/glyphicons_087_log_book.png', 'alt text' );?> Finished Courses</h4>
       
         <div class="row " style="margin-left:10px;">
            
             <div class="accordion" id="accordion3" style="background-color:white;">
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collapseTwo">
          
          <h5 >1/3 Guest Room Attendant Servicing  
                           <span class="label label-info">7 of 7 modules
              </span>
              
                   
                   <div class="progress" style=" height:15px; margin-left: 20px;margin-top:10px;"> 
  
                       <div class="bar bar-success" style="width:14.28%;"></div>
  <div class="bar bar-success" style="width: 14.1%;  margin-left:1px"></div>
   <div class="bar bar-success" style="width: 14.1%;  margin-left:1px"></div>
   <div class="bar bar-success" style="width: 14.1%;  margin-left:1px; "></div>
    <div class="bar bar-success" style="width: 14.1%;  margin-left:1px; "></div>
     <div class="bar bar-success" style="width: 14.1%;  margin-left:1px; "></div>
      <div class="bar bar-success" style="width: 14.1%;  margin-left:1px; "></div>
                       
                       
</div>
                   
               </h5> 
             
      </a>
    </div>
     
    <div id="collapseTwo" class="accordion-body collapse in">
      <div class="accordion-inner">
          <ul style="list-style:none" id="modules">
              <li class="modules"><a href="#" id="Current" rel="popover" data-content="Lesson 1 " >
                    
                      <?php echo Asset::img('icons/check.png', 'alt text' );?> 
                         
                     Getting Ready for Work </a> 
                
              </li>
           
              <li><a href="#">
                     
                       <?php echo Asset::img('icons/check.png', 'alt text' );?> 
                          
                      Preparing the Housekeeping Cart </a>  </li>
              
            
             <li><a href="#">
                     
                      <?php echo Asset::img('icons/check.png', 'alt text' );?>  
                          
                      Preparing the Housekeeping Cart </a>  </li>
             <li><a href="#">
                    
                       <?php echo Asset::img('icons/check.png', 'alt text' );?>  
                
                      Preparing the Housekeeping Cart </a>  </li>
             <li><a href="#">
                
                      <?php echo Asset::img('icons/check.png', 'alt text' );?>  
                          
                      Preparing the Housekeeping Cart </a>  </li>
          </ul>
          
          
      </div>
    </div>
  </div>

</div>
             
             
        
             
             
             
             
             
             
        
</div>
             
            
        </div>
     </div>


 
   
              
         
    
    
        
     
         
        



 
 

             