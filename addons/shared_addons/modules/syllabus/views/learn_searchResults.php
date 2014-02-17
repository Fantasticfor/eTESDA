    
<div class="container">
<div class="row " style="padding-bottom:100px">

    
      <ul class="breadcrumb">
          <li><a href="<?php echo base_url().'syllabus'?>"> Home</a><span class="divider">/</span></li>
  <li class="active"><a href=""> Search Results</a></li>
     
  
   
      </ul>
    
     <div class="span12">
    <div class="row">
    <div class="well well-small"> 
                          
                      
                          <form class="form-search" style="margin-bottom:0px">
                                  
                      <?php echo form_input(array('class'=>'input-large  search-query','id'=>'autocompleteLand', 'placeholder'=>'example tags:Computer, Room Servicing','style'=>'width:80%; margin-bottom:5px;margin-left:10px'))?>
                           
                          </form>
                          </div>
  
        <h4><?php echo count($les) ?> Lessons founds for <span class="label label-info"> <?php echo $var ?>  </span> </h4>
            <hr style="margin-top:0px">
            <div class="row">
            <div class="dropdown" style="margin-top:-15px">
<!--            <label class="pull-right"> Filter by: <a data-toggle="dropdown" class="" >Course<b class="caret" style="margin-top: 8px;"></b></a>
              <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel" style="margin-top:20px">
                   <li><a> Name </a></li>
                   <li><a> Course</a></li>
                </ul>
             </label>-->
            </div>
                </div>
                   
                           
            <div class="span10 ">    
                <div class="row">
            <?php foreach($tCourses as $tc):?>      
                    <h4> <?php echo $tc['title'] ?> <?php if($tc['status'] == 'draft'):?><?php echo ' (Draft)'?><?php endif ?></h4>
                   
                    <hr>
                    <?php foreach($tLessons[$tc['HeirarchyID']] as $le): ?>
               <div class="media well well-small">
               
                <div class="media-body">
                    <?php if($tc['status'] == 'draft'):?>
                    <h4 class="media-heading"><a onclick="alert('Sorry, contents of this lesson are currently unavailable')"><?php echo $le['title'] ?></a></h4>
                    <?php else:?>
                    <h4 class="media-heading"><a href="<?php echo base_url().'syllabus/displayTopic/'.$le['HeirarchyID'] ?>" ><?php echo $le['title'] ?></a></h4>
                    <?php endif ?>
                    <p> 
                      Module:<small><?php foreach($lesMod[$le['HeirarchyID']] as $lm ):?> <?php echo $lm['title'] ?> <?php endforeach; ?></small>
                      <br>
                      Tags:<?php foreach($lesTags[$le['HeirarchyID']] as $lt):?>
                      <span class="label label-info"> <?php echo $lt['tag'] ?></span>
                      <?php endforeach; ?>
                  </p>
                </div>
               
              </div>
            
                <?php endforeach; ?>
             <hr>
             <?php endforeach; ?>
                      </div>  
             </div>           
                       
                               
                        
                        
               
             
                   


                </div><!--/span-->
    </div>
               

            </div><!--/row-->
</div>