    
<div class="container">
<div class="row " style="padding-bottom:100px">

    
      <ul class="breadcrumb">
  
  <li class="active"><a href="<?php echo base_url().'syllabus/displayCourses/'.$sectors[0]['id'] ?>"><?php echo $sectors[0]['title']; ?></a></li>
     
  
   
                            <form class="form-search pull-right">
   <div style="position:absolute; padding-left:11px;padding-top: 5px" >
       <?php echo Asset::img('glyphicons/glyphicons_027_search.png', 'alt text',array('height'=>15, 'width'=>15) );?>
     </div>
       <input style="padding-left:40px" type="text" class="input-large search-query" placeholder="Search">
  
</form>
  
   <select class="pull-right" style="margin-right:5px">
  <option >--Choose a Sector--</option>
  <option> Tourism</option>
  <option>Information Technology</option>
 
</select>
      </ul>
     <div class="span12"   >
  
        <div >
<h2 ><?php echo $sectors[0]['title']; ?></h2>
 <p ><?php echo $sectors[0]['description']; ?>
                        
                   </p> 
                   <hr>
                   </div>
        
                   
               
                   
                
                   
                    
                   
                    <div class="row">
                        
                      
 
             
                        
                        
                       
                               
                        
                        
                    </div>
                  <!-- if learner has a course in this sector, show this -->
                 {{ if example:logged_in }}
                  <h4> <?php echo Asset::img('glyphicons/glyphicons_351_book_open.png', 'alt text' );?> Course Enrolled</h4>
                      <ul class="thumbnails">
                          <?php $counter = 0; ?>
                          <?php foreach ($courses as $lc): ?>
                     <?php foreach ($lc as $lCourse): ?>
                          <?php if($counter < $lcCount): ?>
                          <?php if($lCourse['id'] == $lCourses[$counter]): ?>
                            <li class="span4 small"> 
                  <a class="thumbnail course" href='<?php echo base_url()."syllabus/dispMods2/".$lCourse['id'] ?>'>
                      
                      
                   <!--   <em class="tryCourse" style="width:100px"> resume </em>-->
                       <img src="{{ url:site }}files/large/<?php echo $lCourse['image'];?>" alt=""><!--<img data-src="holder.js/260x120" alt="">-->
                       
                       <h5><?php echo $lCourse['title']; ?></h5>
                    <p> <?php echo $sectors[0]['title']; ?>
                    </p>
                    
                        
                  </a>
                              </li>
                              <?php endif; ?>
                              <?php endif; ?>
                               <?php $counter += 1;?>
                              <?php endforeach; ?>
                             
                              <?php endforeach; ?>
                  
                  
  
                    </ul>
                    <hr>
                    {{endif }}
                    <!-- Course that are not enrolled  -->
                      <span class="pull-right"> Sort by 
                        <select>
  <option> Alphabetically</option>
  <option> Newest</option>
  <option>Oldest</option>
 
</select>
                           </span>
                    
                    <h4> <?php echo Asset::img('glyphicons/glyphicons_071_book.png', 'alt text' );?> Courses Offered</h4>    
                    <br>
                         <ul class="thumbnails">
                             <?php $count = 0; ?>
                              <?php foreach ($courses as $course1): ?>
                          <?php foreach ($course1 as $course): ?>
                             <li class="span4 small"> 
                                    <a  href="<?php echo base_url()."syllabus/dispMods2/".$course['id'] ?>" class="thumbnail course">
                      
                                     <img src="{{ url:site }}files/large/<?php echo $course['image'];?>" alt="">
                       <!--<img data-src="holder.js/260x120" alt="">-->
                       
                                    <h5><?php echo $course['title']; ?></h5>
                                    <p> <?php echo $sectors[0]['title']; ?>
                                    </p>
                    
                        
                                    </a>
                              </li>
                           
                        <?php $count += 1;?>       
                    <?php endforeach; ?> 
                    <?php endforeach; ?>   
                              
                   
                              
                        
  
                    </ul>


                </div><!--/span-->

               

            </div><!--/row-->
</div>