<?php
// $src3=site_url('addons/shared_addons/modules/statistics/css/admin.css');
 
           $src=site_url('addons/shared_addons/modules/syllabus/js/ckeditor.js');
//           $src2=site_url('addons/shared_addons/modules/statistics/js/jquery.tablesorter.pager.js');
//           $src4=site_url('addons/shared_addons/modules/statistics/js/items.js');
//         
           
              
      

?>

    <script type="text/javascript" src="<?php echo $src ?>"></script>
<script type="text/javascript" src="http://localhost/eTESDA/system/cms/themes/pyrocms/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="http://localhost/eTESDA/system/cms/themes/pyrocms/js/ckeditor/adapters/jquery.js"></script>
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


<div class="one_full">

    <section class="title blue"> <h4> <?php echo $_SESSION['modules'][$modkey]['lessonlist'][$leskey]['topics'][$topicname]['title'] ?> </h4></section>
    <section class="item">
                    <?php echo form_open('admin/syllabus/editLessonSummary?modkey='.$modkey.'&leskey='.$leskey.'&topicname='.$topicname) ?>
            <ul>
                
				
                            
                            <li> <label >Topic Title <span>*</span></label>
					<div class="input"><?php echo form_input(array('name'=> 't_title', 'id'=>'t_title', 'value' =>$_SESSION['modules'][$modkey]['lessonlist'][$leskey]['topics'][$topicname]['title'] )) ?></div>
				</li>
                                
                                   <li >
                                  <div >
					<label > Topic Text <span>*</span></label>
					
 
                                        <div class="input">
                                            <?php echo form_textarea(array('id' => 'body', 'name' => 'sample', 'value' =>  $_SESSION['modules'][$modkey]['lessonlist'][$leskey]['topics'][$topicname]['desc'], 'rows' => 30, 'class' => 'wysiwyg-advanced')) ?>

                                            <?php //echo form_textarea(array('name'=> 'sample','class'=>'wysiwyg-advanced')) ?></div>
				</div>
                                            <div >
					
                                        
                                        
                                  
                                        
                              
                                </li>
                                <li>
                                   <label >YouTube Link<span>*</span></label>
                                    <?php foreach($_SESSION['modules'][$modkey]['lessonlist'][$leskey]['topics'][$topicname]['link'] as $key=>$a): ?>
					<div class="input"><?php echo form_input(array('name'=> 'utube_link[]', 'id'=>'utube_link'),$a ) ?> 
                                    <?php endforeach; ?>
                                    
                                </li>
                         
			</ul>
	

    </section>

	<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel'))) ?>

</div>
 
 
 