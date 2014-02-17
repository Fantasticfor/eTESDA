
<div class="one_full">
 <ul id="breadcrumbs-one">
		<li><a href="" > Sector List </a></li>
		<li><a href="" ><?php echo $ctitle ?></a></li>
		<li><a href="" ><?php echo $course ?></a></li>
		<li><a href="" >Add Modules to <?php echo $course ?> </a></li>
                 <li><a href="" class="current">Course Summary for <?php echo $course ?></a></li>
	</ul>
  
</div>

<div class="one_full">
<section class="title blue">
       <h4> Course Summary for <?php echo $course ?> </h4>
       <?php echo form_open('admin/syllabus/save_modules') ?>
</section>

<section class="item">
    <div style="margin: 10px 10px 10px 10px">
    <div class="content tabs">
        <ul class="tab-menu" ><?php $ctr=0 ?>
            <?php foreach($modules as $item): ?>
		<li ><a href="#<?php echo $ctr ?>" ><span   style="  overflow: hidden;
    white-space:nowrap;
    text-overflow:ellipsis;
    width: 80px;
    display:inline-block;"><?php echo $item['module'][0]?></span></a></li>
            <?php $ctr++; ?>
                    <?php endforeach; ?>    
	</ul>
        
        
        <ol><?php $ctr1=0 ?>
         <?php foreach($modules as $key=>$item): ?>     
        <div id="<?php echo $ctr1 ?>">
            <?php $ctr1++; ?>
            <?php foreach($item['lessonlist'] as $key1=>$lesson): ?>
            <li>
               
                <h3 ><?php echo $lesson['title'] ?>   <a style="font-size:8pt;" href="admin/syllabus/replaceXML?modulekey=<?php echo urlencode($key)?>&lessonkey=<?php echo urlencode($key1)?>" class=" modal cboxElement"> Replace XML </a> </h3>
                
               
              
                

               
              <table cellspacing="0" width="100%">
		<thead>
			<tr>
				
				<th width="20%"> Topic Title </th>
                                <th > Text </th>
				<th width="20%" > YouTube Embed Links</th>
                                <th width="10%"></th>
				
			</tr>
		</thead>
		<tbody> <?php foreach($lesson['topics'] as $topic): ?>
			
				<tr>
					
					<td><?php echo $topic['title'] ?></td>
                                        <td><div><?php echo $topic['desc'] ?></div></td>
                                       
                                        <td> <?php foreach($topic['link'] as $tLink):?> <a href="<?php echo "http://".$tLink ?>" class="modal cboxElement vid"><?php echo $tLink ?></a>
                                        <?php endforeach; ?>
                                        </td>
                                        
                                        <td> <a class="btn gray modal cboxElement" href="<?php echo base_url().'admin/syllabus/edit_Summary?topicname='.urlencode($topic['title']).'&modulekey='.urlencode($key).'&lesname='.urlencode($key1)?>">Edit</a></td>
				</tr>
				
					
				
			 <?php endforeach; ?>
		</tbody>
	</table>
              
                  <h5>Tags: </h5>
                
                  
                  <?php foreach($lesson['tags'] as $tags): ?>
                  
                  <span class="label label-info"><?php echo $tags ?></span>
                  <?php endforeach ?>
               
                  
               
	</li>
        <?php endforeach; ?>
           
   
        </div><?php endforeach; ?>
                
            </ol>
       
            </div>
              <div class="buttons"> 
        
    <button class="btn blue " > Save </button>
    <a class="btn gray" href="<?php echo site_url('admin/syllabus/add_modules') ?>"> Back</a>
  </div>
        </div>
</section>

</div>
  <script>
				$('.demo-default').selectize({
					delimeter: ',',
					persist: false,
                                        options:[{value: "a",text: "a"}],
					create: function(input) {
						return {
							value: input,
							text: input
						}
					}
				});
				</script>
