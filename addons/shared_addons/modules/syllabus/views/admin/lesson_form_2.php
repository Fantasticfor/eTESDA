
<div class="one_full">
 <ul id="breadcrumbs-one">
		<li><a href="" ><?php echo $moduledetails->title ?> </a></li>
                 <li><a href="" class="current">Add Lessons to <?php echo $moduledetails->title ?> </a></li>
	</ul>
  
</div>

<div class="one_full">
<section class="title blue">
       <h4> Add Lessons to <?php echo $moduledetails->title ?></h4>
</section>

<section class="item">
    <div class="content">
<div class="form_inputs">
            <?php echo form_open_multipart($this->uri->uri_string(), 'class="crud'.((isset($mode)) ? ' '.$mode : '').'"') ?>
    <fieldset>
        <ul>
            
            <div class="one_half" style="float:left">                            
            <li class="<?php echo alternator('', 'even'); ?>">
				<label for="title"><?php echo lang('sylla:title'); ?> <span>*</span></label>
				<div class="input"><?php echo form_input('title',$item->title, 'class="width-15"'); ?></div>
                                 <?php echo  form_hidden('id', $item->id) ?>
                        </li>
                        
                    
                        <li class="<?php echo alternator('', 'even'); ?>">
                        <label> Upload Topics (.XML) </label> 
                        <div class="input"><?php echo form_upload('image', $item->image['image'], 'class="width-15"'); ?></div>
                       
                        </li>
                        
                        <li class="<?php echo alternator('', 'even'); ?>">
                            <label> Tags: </label>
                             <div class="input">
                            <?php echo form_input('tags',$item->tags,'class="demo-default"') ?>
                                
                             </div>
                      
                       </li>
                        <button class="btn green"> Add Topic </button>
                      
                        <?php echo form_close(); ?>
                 </div>     
               <div class="one_half" style="float: left">
                   
                  
                   
                                           <table id="table_id">
    <thead>
        <tr>
            <th>Lesson Title</th>
            <th>Topics</th>
            <th><?php echo $modulename ?></th>
        </tr>
    </thead>
    <tbody><?php foreach ($_SESSION['modulelessonlist'] as $key=>$lesson) : ?>
        <tr>
            <td><?php echo $lesson['title']; ?></td>
            <td><label class='label label-info'><?php echo $lesson['notopics'] ?></label></td>
            <td style='text-align:center'> <a class='btn btn-lesson red' id="removeButtonn"><input type="hidden" id="indexx" value="<?php echo $key ?>"><input type="hidden" id="mname" value="<?php echo $modulename ?>"><i class='icon-remove' ></i> Remove </a> </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
                                        </div>
</ul>
        <input type="hidden" id="removeurll" value="<?php echo site_url('admin/syllabus/remove_lessonn')?>"/>
        
    </fieldset>	
</div>
    <div class="buttons"> 

        <a class="btn blue" href="<?php echo site_url('admin/syllabus/saveLessons') ?>"> Save </a>
        <a class="btn gray" href="<?php echo site_url('admin/syllabus/viewSector/'.$_SESSION['sectorID']) ?>"> Cancel </a>
          
  </div>
        </div>
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