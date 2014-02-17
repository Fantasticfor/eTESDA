<body data-spy="sc-test" data-target="#nav-test" data-offset="0" style="padding-top:-200px;"   >


<div class="container offset1"  >
            <div class="row" style="padding-bottom:100px; ">
                
                <div class="span13">
                  
                    
                     <h3> e-Career Profiling Test </h3>
                    <h4> Results</h4>
                   
                    <hr>
                    
                       <div class=" alert alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Congratulations!</strong> now, lets <a href="<?php echo base_url()."sectors"?>">follow some courses!</a> 
</div>
                     
                   <div class="span13" >
                        <div class='span13'> 
                        <h3><?php echo Asset::img('glyphicons/glyphicons_029_notes_2.png', 'alt text' );?> Recommend Courses
                             
                        </h3>
                            <div class="span15">
                             <ul class="thumbnails">
                                 <?php foreach($recommended as $key=>$rCourses): ?>
                            <li class="span4 small"> 
                  <a class="thumbnail course" href='<?php echo base_url()."syllabus/dispMods2/".$key; ?>'>
                      
                      
                        
                       <img class="media-object" src="{{ url:site }}files/large/<?php echo $rCourses[1];?>" alt="" data-src="holder.js/160x120" > 
                       <!--<img data-src="holder.js/260x120" alt="">-->
                       
                        <h5 style="overflow: hidden;
                        white-space: nowrap;
                        text-overflow: ellipsis;
                        width: 250px;
                        display: inline-block;">
                            <?php echo $rCourses[0] ?></h5>
                        <p><small><?php echo $rCourses[2] ?></small></p>
                    
                        
                  </a>
                              </li>
                              <?php endforeach; ?>
                                
                             </ul>
                                </div>
                        </div>
                     
                        <div class="span13">
                            <h3><?php echo Asset::img('glyphicons/glyphicons_029_notes_2.png', 'alt text' );?> Results
                            <a class="btn btn-small " onclick="window.print()"> <i class="icon-download-alt"></i></a> 
                        </h3>
                         <div class="span6">
                           
                                <h5><span class="label label-info">Interest Profile</span> </h5>
                                   
                                 <table class="table">
                                    <th>  Interest Area</th>
                                        <th> Score </th>
                                        <?php $ctr=1 ?>
                                <tbody><?php foreach($isec as $sec): ?>
                                   
                              
                                        <tr > 
                                            <td><?php echo $sec['sectionName'] ?></td>
                                            <td><?php echo $iscore[$ctr]['score'] ?></td>
                                        </tr>
                                         <?php $ctr++ ?>
                                        <?php endforeach ?>
                                </tbody>    
                            </table> 
<!--                                <label>Legend:
                                    <span class="label" style="background-color:#dff0d8; color:black">Primary</span>
                                    <span class="label" style="background-color:#d9edf7; color:black">Secondary</span>
                                    <span class="label" style="background-color:#fcf8e3; color:black">Third</span>
                                </label> -->
                            </div>
                      <div class="span6">
                                <h5><span class="label label-info"> Ability Profile </span></h5>
                                 <table class="table">
                                       <th> Ability </th>
                                <th> Score </th>
                                 <?php $ctr1=1 ?>
                                <tbody><?php foreach($asec as $sec): ?>
                              
                                        <tr> 
                                            <td><?php echo $sec['sectionName'] ?></td>
                                            <td><?php echo $ascore[$ctr1]['score'] ?>/<?php echo $sec['noOfItems'] ?></td>
                                        </tr>
                                        <?php $ctr1++ ?>
                                        <?php endforeach ?>
                                </tbody>    
                            </table> 
                            </div>
                        </div>  
                     
                       
                     
                      
                   
                    


                                    </div><!--/span-->

                                  
</div>
                                    </div><!--/row-->


</div>
 
    
  
    </body>