

<div class="container" style="padding-bottom: 100px">
    
<div class="row">

    <div class="span4" >
        
        <!--side bar -->     
        <div class="well sidebar-nav">
             <ul class="nav nav-list" id="myTab2">
              <li class="nav-header"> Learner's Profile</li>
              <li class="active"><a href="#dashboard" data-toggle="tab">My Courses </a></li>
              <li><a href="#assessment" data-toggle="tab"> My Online Assessments </a></li>
              <li><a href="#achievements" data-toggle="tab"> Achievements </a></li>
              
              
            </ul>
          </div><!--/.well -->
                          
                        </div><!--/span-->
     
            
            <div class="span9 tab-content" id="myTabContent2" style="padding-left:20px" >
                <div class="tab-pane fade active in" id="dashboard">
                   
                
                
     <div class="row">
         
            <?php $this->load->view('dashboard/tabs_dashboard');    ?>

         
     <div class=" well well-small tab-content " id="myTabContent"     >
         
         
       <!-- Ongoing Courses -->
         <div class="tab-pane fade active in" id="ongoing">
              
        <?php echo $this->load->view('dashboard/OngoingCourses');?>
         
     </div>
       
         <!--Finished Courses -->
       <?php echo $this->load->view('dashboard/FinishedCourses');?>
    
     </div>     
                </div>
            </div> <!-- dashboard-->
                
               
            <div class="tab-pane fade" id="assessment">
                   <?php echo $this->load->view('dashboard/Assessment');?>
                </div><!-- assessment-->
                
                <div class="tab-pane fade" id="achievements">
                  <?php echo $this->load->view('dashboard/Achievements');?>  
                </div>
           
      
   

        
</div>
              </div>
         
         </div>
        
    
    
    





    
   
        
        