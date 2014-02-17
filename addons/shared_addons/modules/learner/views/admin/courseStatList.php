<div class="one_full">
 <ul id="breadcrumbs-one">
		<li><a href="" > Sectors</a></li>
		<li><a href="" class="current"> Information Technology Courses</a></li>
		
	</ul>
  
</div>
<div class="one_full">
   
    <section class="title blue "> <h4> Information Technology Courses' Statistics </h4></section>    
    <section class="item">
        
        <div class="content">
            <table>
                <thead>
                    <tr>
                        <th>Course</th>
                        <th>Enrollees</th>
                        <th>Inactives</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($sectCourses as $sc): ?>
                    <tr>
                        <td><?php echo $sc['title']; ?></td>
                        <?php foreach($enrollees->$sc['title'] as $en):?>
                            <?php foreach($en as $enrolled): ?>
                                <td><span class="label label-success"><?php echo $enrolled['count']; ?> Enrollee/s</span></td>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                        <?php foreach($inactive->$sc['title'] as $ia):?>
                            <?php foreach($ia as $inact): ?>
                        <td><span class="label label-warning"><?php echo $inact['count']; ?> Inactive/s</span></td>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                        <td><a class="btn blue" href="<?php echo site_url('admin/learner/courseStat/'.$sc['id'])?>"> View Course Statistics</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                
            </table>  
            
            
        </div>     
      
	

        
    </section>
    
    
    </div>
    
    
