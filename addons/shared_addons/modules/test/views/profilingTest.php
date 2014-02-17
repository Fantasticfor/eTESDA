

<div class="container">
            <div class="row" style="padding-bottom:100px">
  
               
                    
                    <div class="span12">
                        <div class="alert alert-warning"> <strong>Disclaimer!</strong> The recommended courses and results produced by the e-Profiling Test are suggestions and the learner is subjected to follow it or not.  </div>
                        <div class="row">
                            
                            <div class="well well-small span12" >
                                <h3> e-Profiling Test  <a class="btn btn-success printoff" href="<?php echo base_url()."profiling/InterestTest"?>">Take Test </a> </h3>
                                
                                <div class="span5">
                                <p> This instrument is a self-assessment career exploration tool that can help clients discover the type of work activities suited to their temperament and learn about broad interest areas most relevant to themselves. They can use their interest results to explore the world of work.
                                    <br>
The O’NET Interest Profiler measures six types of occupational interests:
                                <ul>
                                    <li>Realistic</li>
                                    <li>Investigative</li>
                                    <li>Artistic</li>
                                    <li>Social</li>
                                    <li>Enterprising</li>
                                    <li>Conventional</li>
                                </ul></p>
                                </div>
                                <div class="span5">
                                <p>
                                    The instrument is a career exploration tool that can help the client identify their strengths and areas for which they might want to receive more training and education and identify occupations that fit their strengths.
                                    <br>
The O’NET Ability Profiler measures nine job-relevant abilities:
                                <ul>
                                <li>Verbal Ability</li>
                                <li>Arithmetic Reasoning</li>
                                <li>Computation</li>
                                <li>Spatial Ability</li>
                                <li>Form Perception</li>
                                <li>Clerical Perception</li>
                                </ul>
                                    
                                </p>
                                </div>
                                    
                               
                                   
                            </div>
                       
                       
                        
                   
                   
                  
                    
                    </div>
                         </div><!--/span-->
                         
                          <div class='span13'> 
                        <h3><?php echo Asset::img('glyphicons/glyphicons_029_notes_2.png', 'alt text' );?> Recommend Courses
                             
                        </h3>
                            <div class="span6">
                             <ul class="thumbnails">
                            <li class="span4 small"> 
                  <a class="thumbnail course" href='<?php echo base_url()."syllabus/Modules" ?>'>
                      
                      
                          <?php echo Asset::img('dummy/computer hardware Servicing 260x120.jpg', 'alt text',array('class'=>"media-object",'data-src'=>"holder.js/260x120") );?>
                       <!--<img data-src="holder.js/260x120" alt="">-->
                       
                        <h5>Computer Hardware Servicing 2</h5>
                    <p> Information Technology
                    </p>
                    
                        
                  </a>
                              </li>
                             </ul>
                                </div>
                        </div>
                         <div class="span13"  >
                            
                        <h3><?php echo Asset::img('glyphicons/glyphicons_029_notes_2.png', 'alt text' );?> Results
                            <a class="btn btn-small " onclick="window.print()"> <i class="icon-download-alt"></i></a> 
                        </h3>
                          
                       
                            <div class="span6">
                                <h5><span class="label label-info">Interest Profile</span> </h5>
                                
                                 <table class="table">
                                <tbody>
                                <th>  Interest Area</th>
                                        <th> Score </th>
                                        <?php foreach($intRes as $ir):?>
                                            <tr > 
                                                <td><?php echo $ir['sectionName'] ?></td>
                                                <td><?php echo $ir['result'] ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                       
                                </tbody>    
                            </table> 
<!--                               <label>Legend:
                                    <span class="label" style="background-color:#dff0d8; color:black">Primary</span>
                                    <span class="label" style="background-color:#d9edf7; color:black">Secondary</span>
                                    <span class="label" style="background-color:#fcf8e3; color:black">Third</span>
                                </label> -->
                            </div>
                            <div class="span6">
                                <h5><span class="label label-info"> Ability Profile </span></h5>
                                 <table class="table">
                                <tbody>
                                <th> Ability </th>
                                <th> Score </th>
                                <?php foreach($abRes as $ar): ?>
                                        <tr> 
                                            <td><?php echo $ar['sectionName'] ?></td>
                                            <td><?php echo $ar['result'] ?>/<?php echo $ar['noOfItems'] ?></td>
                                        </tr>
                                <?php endforeach; ?>      
                                </tbody>    
                            </table> 
                            </div>
                            
                             </div>
                        


                                   

                                  
                                    </div><!--/row-->


</div>
