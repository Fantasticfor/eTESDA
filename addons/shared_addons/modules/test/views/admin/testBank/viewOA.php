
<div class="one_full">
 <ul id="breadcrumbs-one">
		<li><a href="<?php echo site_url('admin/test/testBank') ?>" > Manage Online Assessments </a></li>
		<li><a href="<?php echo site_url($this->uri->uri_string()) ?>" class="current" > View <?php echo $coursedetails ?> Online Assessment</a></li>
		 
	</ul>
  
</div>

<div class="one_full">
<section class="title blue">
       <h4> <?php echo $coursedetails ?> Online Assessment</h4>
</section>

<section class="item">
    <div style="margin: 10px 10px 10px 10px">
    <div class="content ">
       
        
        <ul>
              
        <div id="testSummary">
            <fieldset>
                
                <li><label>Total Items: <span class="label label-info"> <?php echo $totalitems ?></span></label>  </li>
                <hr>
                <table> 
                    
                    <th>Section no.</th>
                    <th width="80px">No. of items</th>
                    <th >Item Type</th>
                    <th >Module | Competency</th>
                    <th width="200px"></th>
                    <tbody>
                        <?php $ctr = 1 ?>
                        <?php foreach($sections as $section): ?>
                    <tr>
                        <td> Section <?php echo $ctr ?></td>
                        <td><span class="label label-info"> <?php echo $section['noOfItems'] ?> item/s</span></td>
                        <td> <?php echo $section['testType'] ?></td>
                        <td> <?php echo $section['title'] ?></td>
                        <td> <a class="btn gray modal cboxElement edit" href="<?php echo base_url().'admin/test/testBank/editTest?sectionid='.$section['sectionID'].'&secitionno='.$ctr.'&moduleid='.$section['moduleID'] ?>" >Edit</a>
                         <a class="btn red" href="<?php echo base_url().'admin/test/testBank/removeSections/'.$section['sectionID'] ?>" >Delete</a></td>
                    </tr>
                    <?php $ctr++ ?>
                         <?php endforeach; ?>  
                   
                           
                           
                    </tbody>
                </table>
                </fieldset>

	

        
    
   
        </div>
               
            </ul>
       
            </div>
              <div class="buttons"> 
        
    <a class="btn gray " href="<?php echo site_url('admin/test/testBank#oa')?>"> Back </a>
   
  </div>
        </div>
</section>

</div>
