
    <div class="container offsetdown" >
    <div id="courseModal" class="modal modal-thinner hide fade" >
  <div class="modal-header" style="height:20px">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>      </h3>
  </div>
  <div class="modal-body">
   <div class="courseBody" style="display:none;">
                  
             </div>
  </div>
</div>
        
       <div class="span12 " style="width:1100px">
            <div class="row">
            <div id="myCarousel" class="carousel slide">
  <!-- Carousel items -->
  <div class="carousel-inner">
      <div class="active item">
             <?php echo Asset::img('dummy/sample3.png', 'alt text' );?>
         
     
          <div class="carousel-caption">
                      <h4>Learn Fast and Get a Job!</h4>
                      <p>Be part of the eTESDA Learn Community! Enroll now! </p>
                    </div>
      </div>
<!--      <div class="item"> 
            <?php// echo Asset::img('dummy/sample2.png', 'alt text' );?>
          
                <div class="carousel-caption">
                      <h4>Can't Get a Job? Be Part of eTESDA Learn!</h4>
                      <p></p>
                    </div>

      </div>-->
      <div class="item"> 
          <?php echo Asset::img('dummy/sample1.png', 'alt text' );?>
                <div class="carousel-caption">
                      <h4>Learn Fast and Get a Job!</h4>
                      <p>The tourism industry has one of the most in-demand sectors in the country and the world. Enrolling right away with eTESDA Learn will help you in being in the best industry.</p>
                    </div>

      </div>
  </div>
  <!-- Carousel nav -->
  <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
  <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
</div>
           </div>     
        </div>      
        <!--in demand courses-->
        
         <div class="span13" >
            
                    <div class="row" style="margin-bottom: 40px">
                        
                      <div class="well well-small"> 
                          
                      
                    
                                  <strong>Search eTESDA Learn</strong>
                      <?php echo form_input(array('class'=>'input-large  search-query','id'=>'autocompleteLand', 'placeholder'=>'example tags:Computer, Room Servicing','style'=>'width:80%; margin-bottom:5px;margin-left:10px'))?>
                           
                    
                          </div>
                          <h4>
                             <?php echo Asset::img('glyphicons/glyphicons_049_star.png', 'alt text' );?>
                            In Demand TESDA Online Courses </h4>
                        <hr>
                     
                               <input type="hidden" id="baseurl" value='<?php echo base_url()?>'/>   
               

                        <ul class="thumbnails">
                   <?php $count = 0; ?>     
                  <?php foreach ($inDemand as $dem): ?>    
                     <li class="span4 small">
                            <a class="thumbnail course" href='<?php echo base_url()."syllabus/dispMods2/".$dem['id']; ?>'>
                              
                              
                              <em class="indemandCourse"><?php echo $dem['count']; ?> enrolled! </em>
                              {{ if example:logged_in }}
                             
                              {{else}}
                              <em class="tryCourse" style="margin-top:20px;"> Try now! </em>
                              {{endif}}
                      <img class="media-object" src="{{ url:site }}files/large/<?php echo $dem['image'];?>" alt="" data-src="holder.js/160x120" > 
                      <!-- <img data-src="holder.js/260x120" alt="">-->
                        <h5><?php echo $dem['title']; ?><br>
                        <small><em> <?php echo $dem['duration']?> weeks long</em></small>
                        </h5>
                        
                        <p style="margin-top:-10px"><small><?php echo $sectorNames[$count]; ?></small> </p>
                         <?php $count += 1; ?>
                                 </a>
                                              </li>
                              
                  <?php endforeach; ?>
  
                    </ul>
                         </div>
                
             <div class="row">
                 
                 <!--New courses-->
                 <div class="span4">
                     <div class="row">
                     <h4>
                          <?php echo Asset::img('glyphicons/glyphicons_361_crown.png', 'alt text' );?>
                         
                         Latest Courses for You! </h4>
                     <hr>
                     <ul class="thumbnails">
                         <?php $count = 0; ?>     
                  <?php foreach ($latest as $la): ?> 
                     <li class="span4 small">
                   <a class="thumbnail course" href='<?php echo base_url()."syllabus/dispMods2/".$la['id']; ?>' >
                                             
                       <img class="media-object" src="{{ url:site }}files/large/<?php echo $la['image'];?>" alt="" data-src="holder.js/160x120" > 
                      <!--<img data-src="holder.js/260x120" alt="">-->
                       
                  
                      <h5><?php echo $la['title']; ?>
                          <br>
                      <small><em> <?php echo $la['duration']?> weeks long</em></small></h5>
                    <p style="margin-top:-10px"><small> <?php echo $latestSector[$count]; ?></small></p>
                    <?php $count += 1; ?>
                     </a>
                              </li>
                            <?php endforeach; ?>  
                   
                              
                    
  
                </ul>
                 </div>
                 </div>
                 
                 <!-- catalog -->
                 <div class="span9" style="margin-left:60px" >
                      <div class="row" >
                     <h4> 
                                <?php echo Asset::img('glyphicons/glyphicons_156_show_thumbnails.png','alt text' );?>
                                
                                Browse our Catalog</h4>
                           <hr>
                    <ul class="thumbnails">
                          <?php foreach($sectors as $sector): ?>  
                        <li class="span2 sector">
                                <a href="<?php echo base_url()."syllabus/displayCourses/".$sector['id']?>" class="thumbnail" id="<?php echo $sector['id']?>" >
                                   
                                       <img src="{{ url:site }}files/large/<?php echo $sector['image'];?>" alt="">
                                </a>
                            </li>
                        <?php endforeach; ?>
                           
                        </div>
                       

                      
           
                

                </ul>
        
                     </div>
      
                
            </div>
        
        
            
          
         </div>
        
        



    </div><!--/span-->
    
   