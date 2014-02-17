
<div class="one_full">
 <ul id="breadcrumbs-one">
		<li><a href="<?php echo site_url().'admin/syllabus'?>" >Sector List</a></li>
		<li><a href="" ><?php echo $ctitle ?></a></li>
		<li><a href="" ><?php echo $course ?></a></li>
		<li><a href="" >Add Modules to <?php echo$course ?> </a></li>
                 <li><a href="" class="current">Add Lessons to <?php echo $_SESSION['modules'][$modulename]['module'][0] ?> </a></li>
	</ul>
  
</div>

<div class="one_full" > 
<section class="title blue">
       <h4> Add Lessons to <?php echo $_SESSION['modules'][$modulename]['module'][0] ?></h4>
</section>

<section class="item" >
    
<div class="content" style="height:70%" >
            <?php echo form_open_multipart($this->uri->uri_string(), 'class="crud'.((isset($mode)) ? ' '.$mode : '').'"') ?>
    <fieldset style="height:30%">
        <ul>
            
            <div class="one_half" style="float:left">                            
            <li class="<?php echo alternator('', 'even'); ?>">
				<label for="title"><?php echo lang('sylla:title'); ?> <span>*</span></label>
				<div class="input"><?php echo form_input('title',$item->title, 'class="width-15"'); ?></div>
                                 <?php echo  form_hidden('id', $item->id) ?>
                        </li>
              <!--  <li>        
                                        
                                         <label for="status">Status </label>
					<div class="input"><?php echo form_dropdown('m_status', array('draft' =>'draft', 'live' => 'live')) ?></div>
                    </li>-->
                    <li class="<?php echo alternator('', 'even'); ?>">
                        <label> Upload Topics (.XML) </label> 
                        <div class="input"><?php echo form_upload('image', $item->image['image'], 'class="width-15" accept="text/xml"'); ?></div>
                       
                        </li>
                        <li class="<?php echo alternator('', 'even'); ?>">
                            <label> Tags: </label>
                             <div class="input">
                            <?php echo form_input('tags',$item->tags,'class="demo-default"') ?>
                             </div>
                      
                       </li>
                        <button class="btn green"> Add Lesson  </button>
                        <?php echo form_close(); ?>
                 </div>     
               <div class="one_half" style="float: left">
                   
                  
                   
                                           <table id="table_id">
    <thead>
        <tr>
            <th>Lesson Title</th>
            <th>Topics</th>
            <th></th>
        </tr>
    </thead>
    <tbody><?php foreach ($_SESSION['modules'][$modulename]['lessonlist'] as $key=>$lesson) : ?>
        <tr>
            <td><?php echo $lesson['title']; ?></td>
            <td><label class='label label-info'><?php echo $lesson['notopics'] ?></label></td>
            <td style='text-align:center'> <a class='btn btn-lesson red' id="removeButton"><input type="hidden" id="indexx" value="<?php echo $key ?>"><input type="hidden" id="mname" value="<?php echo $modulename ?>"><i class='icon-remove' ></i> Remove </a> </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
                                        </div>
           
</ul>
        <input type="hidden" id="removeurll" value="<?php echo site_url('admin/syllabus/remove_lesson')?>"/>
         
    </fieldset>	
     
</div>
  
        
       
 
     <a class="btn blue" style="float:right; margin:10px" id="closebutton" > Save </a>
  
</section>
       
</div>
 <script>
				$('.demo-default').selectize({
					delimeter: ',',
					persist: false,
                                        options:[
                                        <?php foreach($tagss as $a): ?>    
                                        {value: "<?php echo $a['tag'] ?>",text: "<?php echo $a['tag'] ?>"},
                                        <?php endforeach; ?>
                                        ],
					create: function(input) {
						return {
							value: input,
							text: input
						}
					}
				});
				</script>