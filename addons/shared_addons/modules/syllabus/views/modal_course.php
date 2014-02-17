<div class="" style="padding-bottom:50px">
    <?php echo Asset::img('dummy/computer hardware Servicing 260x120.jpg', 'alt text',array('class'=>"media-object",'data-src'=>"holder.js/160x120") );?>
    <h3> <?php echo $courseDetails[0]['title']; ?></h3> <a href='<?php echo base_url()."syllabus/displayModules/".$courseDetails[0]['ID']; ?>' class="btn btn-small btn-primary"> Follow Course</a>
     <div class="span4 well well-small" style="margin-top:20px">
            <span class=""><h5><i class="icon-star-empty"></i> What you will learn!</h5></span>
                               
                                <ul>
                                    <?php foreach($courseDetails as $cd): ?>
                                    <li><?php echo $cd['Objective']; ?></li> 
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <div class="span4 well well-small">
                            <span class=""> <h5> <i class="icon-star-empty"></i> Great Job Opportunities! </h5></span>
                                
                                <ul>
                                    <?php foreach($courseObj as $cob): ?>
                                    <li> <strong><?php echo $cob['opportunity']; ?></strong></li> 
                                    <?php endforeach; ?>
                                    
                                    
                                </ul>
                            </div>

</div>