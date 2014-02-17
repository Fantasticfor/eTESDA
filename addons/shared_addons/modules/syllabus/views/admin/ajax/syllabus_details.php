<script type="text/javascript">

	var instance;

	function update_instance()
	{
		instance = CKEDITOR.currentInstance;
	}

	(function($) {
		$(function(){

			pyro.init_ckeditor = function(){
				$('textarea#intro.wysiwyg-simple').ckeditor({
	toolbar: [
		['pyroimages'],
		['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink']
	  ],
	extraPlugins: 'pyroimages',
	width: '99%',
	height: 100,
	dialog_backgroundCoverColor: '#000',
	defaultLanguage: 'en',
	language: 'en'
});


$('textarea.wysiwyg-simple').ckeditor({
	toolbar: [
		['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink']
	  ],
	width: '99%',
        
	height: 100,
	dialog_backgroundCoverColor: '#000',
	defaultLanguage: 'en',
	language: 'en'
});



$('textarea.wysiwyg-advanced').ckeditor({
	toolbar: [
		['Maximize'],
		['pyroimages', 'pyrofiles'],
		['Cut','Copy','Paste','PasteFromWord'],
		['Undo','Redo','-','Find','Replace'],
		['Link','Unlink'],
		['Table','HorizontalRule','SpecialChar'],
		['Bold','Italic','StrikeThrough'],
		['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl'],
		['Format', 'FontSize', 'Subscript','Superscript', 'NumberedList','BulletedList','Outdent','Indent','Blockquote'],
		['ShowBlocks', 'RemoveFormat', 'Source']
	],
	extraPlugins: 'pyroimages,pyrofiles',
	width: '99%',
	height: 400,
	dialog_backgroundCoverColor: '#000',
	removePlugins: 'elementspath',
	defaultLanguage: 'en',
	language: 'en'
});				pyro.init_ckeditor_maximize();
			};
			pyro.init_ckeditor();

		});
	})(jQuery);
</script>


<section class="title syllabus">
			<h4><?php echo "$SyllabusType" ?>  </h4> 
		</section>

<section class="item">
<div class="content" >



	<div class="form_inputs"  >
           
            <div class="one_full">
           <ul id="breadcrumbs-one" class="smaller">
		<li><a> Information Technology</a></li>
		<li><a class="current" > <?php echo $results->title ?> </a></li>
		
		
	</ul>
                </div>	
<div class="one_full">
<fieldset>
         
            <legend  > <?php echo $results->title?>
<?php if ($type == 2||$type==3): ?>               
 <?php if($results->status == 'live'):  ?>
                
                <span class="label label-success"><?php echo $results->status ?></span> 
<?php elseif($results->status == 'live-incomplete'): ?>
              
                 <span class="label label-success"><?php echo $results->status ?></span> 
                <?php elseif($results->status == 'live-complete'): ?>
                 
                  <span class="label label-success"><?php echo $results->status ?></span> 
              <?php else:?>
                 <span class="label"><?php echo $results->status ?></span> 
                <?php endif?>
               
            <?php endif ?>
                 <span >
                    <a class="btn gray " onclick="tog_edit()"  style=" margin-bottom:10px" ><i class="icon-edit"> </i></a>
                </span>
                
            </legend>
           
 
           
           
            <p> <label class="label label-info"> Heads Up!</label>  <em>To update content, click on <i class="icon-edit"> </i> </em> </p>
            <p> <strong> Author name:</strong> <?php echo $results->created_by_username ?></p>
            <p> <strong> Last update:</strong> <?php echo format_date($results->updated) ?></</p>
             
            
        </fieldset>
    
 
 <?php if ($type == 2): ?>
            <?php echo form_open_multipart('admin/syllabus/edit_course/',array('id' => 'coursef')) ?>
                	<!--Course -->
                        <script type="text/javascript">
                       $("#coursef").submit(function() {

                       if(!$('#txtctitle').val()){
           
                            alert('Course title is required');
                            return false;
            
                        }
                        
                        if(!$('#txtcdes').val()){
                            alert($('#txtcdes').val());
                            alert('Course description is required');
                            return false;
            
                        }
                        
                       
                        
                        var file = $('input:file')[0].files[0];
                        type = file.type;
                        if(file.type != 'image/png' && file.type != 'image/jpg' && file.type != 'image/jpeg' ) {
                         alert("Unsupported file type");
                            
                        return false;
                        }
                     

                        
                      
                        
                        
    
    });    
                    </script>
            <ul>
		<div style="overflow-y: scroll; height:300px">   		
                            
                            <li> <label >Course Title <span>*</span></label>
					
                                <div class="input" >
                                           
                                    <p class="text-info" id="lbltedit"><?php echo $results->title?></p>
                                            
                                            <?php echo form_input(array('name'=> 'title','id'=>'txtctitle', 'style'=>'display:none'), $results->title) ?>
                                            <?php echo form_hidden('courseid',$results->id); ?>
                                </div>
				</li>
                          
                              
                            <li>
                                  
					<label > Course Description <span>*</span></label>
					
                                        
                                        <div class="input" >
                                             <p class="text-info" id="lbldedit"><?php echo $results->description?></p>
                                            <?php echo form_textarea(array('name'=> 'description','style'=> 'width:500px; display:none', 'id'=>'txtcdes', 'class'=>''), $results->description) ?></div>
				
                                           
					
                              
                                </li>
                                
                            <li id="cstat" style="display: none">
					<label for="status">Status </label>
                                        
					<div class="input"><?php echo form_dropdown('status', array('draft' =>'draft', 'live-incomplete' => 'Live Incomplete','live-complete' => 'Live Complete'), $results->status) ?></div>
				</li>
                                
                         
                                <li style="float:left"> 
                                    
					<div class="input" style="float:left; display:none" id="cupload">
                                            <label >Course image <span>*</span></label>
                                           <?php echo form_upload('image', NULL, 'class="width-15" id = "imgup" accept="image/*"'); ?></div>
                                        <div style="float:left">
                                            <label >Current image:</label>
                                           <img src=<?php echo $results->image['thumb'] ?> width="120" height="120">   
                                           </div>     
                                        </li>
                                        
                                        
                                          
<!--                                        <script>
            $(':file').change(function(){
            var file = this.files[0];
            name = file.name;
            size = file.size;
            type = file.type;

            if(file.name.length < 1) {

            }
           
            else if(file.type != 'image/png' && file.type != 'image/jpg' && file.type != 'image/jpeg' ) {
                alert("Unsupported file type");
                
            }
            else { 
               
            }
    });            
                                    
                                
                            </script>-->
                                        <!-<li >
                                            <label> Abilities:</label> 
                                            <?php $arr = array(); ?>
                                            
                                            <div class="input" >
                                                 <div id="atag">
                                                 <?php foreach($cabilities as $a): ?>
                                             <?php $arr []=$a['sectionID'] ?>
                                               
                                            <span class="label"> <?php echo $a['sectionName'] ?></span> 
                                              
                                            <?php endforeach; ?>
                                             </div>
                                            <br>
                                            
                                            <div id="abs" style="display:none">
                                             <?php echo form_dropdown('abilities[]', $abilities, $arr,  'class="chosen-select" multiple="" style = "display:none"') ?>
                                            </div>
                                                </div>
                                            
                                            
                                            <label> Interests:</label> 
                                            <div class="input">
                                                <div id="intag">
                                               <?php foreach($cinterest as $b): ?>
                                                
                                            <span class="label"> <?php echo $b['sectionName'] ?></span> 
                                               
                                            <?php $arr1 []=$b['sectionID'] ?>
                                            <?php endforeach; ?>
                                                </div>
                                            <br>
                                            <div id="ints" style="display:none">
                                                <?php echo form_dropdown('interests[]', $interests, $arr1, 'class="chosen-select" multiple="" style = "display:none"') ?>    
                                            </div>
                                            </div>
                                            
                                        </li>
                                        
				 </div>
                <br>
                                        <li id="litog"  style="display: none; float:left"> 
                                         <button class="btn blue" id="courseb"  style=" margin-bottom:10px" > Save </button>    
                                       <a class="btn gray" onclick="tog_save()"  style=" margin-bottom:10px" > Cancel </a>
                                        </li>
                                        
                <br>                         
                                    

			</ul>
                        
                        <?php form_close(); ?>
                        <div class="buttons" style="margin-top: 50px">
                            <a href="<?php echo site_url('admin/syllabus/add_modules')?>" class="btn blue"> Add Modules </a>
                            <a href="<?php echo site_url('syllabus/dispMods2').'/'.$results->id ?>" class="btn gray" onclick="window.open(this.href, 'child', 'height=800,width=1800,scrollbars'); return false"> Preview </a>
                            <a href="<?php echo site_url('admin/syllabus/deleteCourse').'/'.$results->id ?>" class="btn gray confirm"> Delete</a>
                        </div>
	

                                    <!-- Module -->
     <?php elseif($type == 3): ?>
            <?php echo form_open('admin/syllabus/edit_module/') ?>
                  <ul>
				
                                
                            <li> <label >Module Title <span>*</span></label>
                                        <p class="text-info" id="lbltedit"><?php echo $results->title?></p>
					<div class="input"><?php echo form_input(array('name'=> 'title','id'=>'txtctitle', 'style'=>'display:none'), $results->title) ?>
                                        <?php echo form_hidden('moduleid',$results->id); ?></div>
				</li>
                                
                                 <li id="cstat" style="display: none">
					<label for="status">Status </label>
                                        
					<div class="input"><?php echo form_dropdown('status', array('draft' =>'Draft', 'live' => 'Live'), $results->status) ?></div>
				</li>

                                <li id="litog" style="display: none; float:left"> 
                                         <button class="btn blue"  style=" margin-bottom:10px" > Save </button>    
                                       <a class="btn gray" onclick="tog_save()"  style=" margin-bottom:10px" > Cancel </a>
                                        </li> 

			</ul>

                        <?php form_close(); ?>
                        <div class="buttons" style="margin-top: 50px">
                            <a href="<?php echo site_url('admin/syllabus/addLessons/'.$results->id)?>" class="btn blue"> Add Lessons </a>
                   <a href="<?php echo site_url('syllabus/displayModules').'/'.$coursedet ?>" class="btn gray" onclick="window.open(this.href, 'child', 'height=800,width=1800,scrollbars'); return false"> Preview </a>
                             <a href="<?php echo site_url('admin/syllabus/deleteModule').'/'.$results->id ?>" class="btn gray confirm"> Delete</a>
                        </div>
	
                                        <!--Lesson-->
<?php elseif($type == 4): ?>
                                        <?php echo form_open('admin/syllabus/edit_lesson/') ?>
     <ul>
				
                                
                            <li> <label >Lesson Title <span>*</span></label>
					 <p class="text-info" id="lbltedit"><?php echo $results->title?></p>
					<div class="input"><?php echo form_input(array('name'=> 'title','id'=>'txtctitle', 'style'=>'display:none'), $results->title) ?>
                                        <?php echo form_hidden('lessonid',$results->id); ?></div>
				</li>
                                
                                      <li>
                                    <label>Tags</label>
                                    <div class="input"><?php foreach($tagq as $t): ?>
                                    <span class="label label-info"><?php echo $t?></span>
                                    
                                    <?php endforeach ?>
                                    <br>
                                   
                        <?php echo form_input('tags',$tagsq,'class="demo-default" style="display:none') ?>
                                <script>
				var $select = $('.demo-default').selectize({
					delimeter: ',',
					persist: false,
                                        options:[
                                        <?php foreach($tagss as $a): ?>    
                                        {value: "<?php echo $a['tag'] ?>",text: "<?php echo $a['tag'] ?>"},
                                        <?php endforeach ?>
                                        ],
					create: function(input) {
						return {
							value: input,
							text: input
						}
					}
				});
                                
                                $select.addItem("tags1");
				</script>
                                    </div>
                                    
                                    <div style="">
                                        
                                    </div>
                                    </li>
                                
                             <li id="litog" style="display: none; float:left"> 
                                         <button class="btn blue"  style=" margin-bottom:10px" > Save </button>    
                                       <a class="btn gray" onclick="tog_save()"  style=" margin-bottom:10px" > Cancel </a>
                                        </li>    

			</ul>
                                            <?php form_close(); ?>
                             <div class="buttons" style="margin-top: 50px">
                            <a href="<?php echo site_url('admin/syllabus/loadUpload/'.$results->id)?>" class="btn blue cboxElement modal"> Add Topics </a>
                            <a href="<?php echo site_url('syllabus/displayTopic').'/'.$results->id ?>" class="btn gray" onclick="window.open(this.href, 'child', 'height=800,width=1800,scrollbars'); return false"> Preview </a>
                             <a href="<?php echo site_url('admin/syllabus/deleteLesson').'/'.$results->id ?>" class="btn gray confirm"> Delete</a>
                        </div>         
<?php elseif($type == 5): ?>
    
                                      <?php echo form_open('admin/syllabus/edit_topic') ?>  
                                        <ul>
				
                                
                            <li><label >Topic Title <span>*</span></label>
				 <p class="text-info" id="lbltedit"><?php echo $results->title?></p>
					<div class="input"><?php echo form_input(array('name'=> 'title','id'=>'txtctitle', 'style'=>'display:none'), $results->title) ?>
                                        <?php echo form_hidden('topicid',$results->id); ?></div>
			   </li>
                           
                           <li><label> Text Content </label>
                                
                                        <div class="input">
                                             <p class="text-info" id="lbldedit"><?php echo  $results->textCont?></p>
                                            <?php echo form_textarea(array('name'=> 'description','style'=> 'width:500px; display:none', 'id'=>'txtcdes'), $results->textCont) ?></div>
                           </li>
                           
                           <li><label > Youtube Links</label>
                               <?php foreach($link as $a):?>
                               
				 <p class="text-info a" id="lblledit"><?php echo $a['link']?></p>
                                 
					<div class="input"><?php echo form_input(array('name'=> 'link[]','id'=>'txtlink', 'style'=>'display:none', 'class' => 'linkscall'), $a['link']) ?>
                                        <?php echo form_hidden('mediaid',$a['id']); ?></div>
                                 <?php endforeach ?>
			   </li>
                                
                                
			<li id="litog" style="display: none; float:left"> 
                                         <button class="btn blue"  style=" margin-bottom:10px" > Save </button>    
                                       <a class="btn gray" onclick="tog_save()"  style=" margin-bottom:10px" > Cancel </a>
                                        </li>    	 
                                        
                                   
                                      

			</ul>
                                        <?php form_close(); ?>
                                         <a href="<?php echo site_url('syllabus/displayTopic').'/'.$topiclesson ?>" class="btn gray" onclick="window.open(this.href, 'child', 'height=800,width=1800,scrollbars'); return false"> Preview </a>
                                         <a href="<?php echo site_url('admin/syllabus/deleteTopic').'/'.$results->id ?>" class="btn gray confirm"> Delete</a>
    <?php endif ?>


</div>

            
	</div>
          
          
</div>
         <div class="buttons" id="tog_button" style="margin:10px; display: none">
          <?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel'))) ?>
</div>  
         
</section> 

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