<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Admin extends Admin_Controller
{
    // This will set the active section tab
    protected $section = 'faq';
    
    protected $sector_validation_rules = array(
		array(
			'field' => 'title',
			'label' => 'Title',
			'rules' => 'trim|required|max_length[100]|alpha'//|callback__check_title'
		),
		array(
			'field' => 'description',
			'label' => 'Description',
			'rules' => 'trim|required|alpha'//|callback__check_slug'
		),
		array(
			'field' => 'id',
			'rules' => 'trim|numeric'
		),array(
			'field' => 'image',
                        'label' => 'Image',
			'rules' => 'jpg|png'
		)
	);
     
     protected $course_validation_rules = array(
		array(
			'field' => 'title',
			'label' => 'Title',
			'rules' => 'trim|required|max_length[100]'
		),
		array(
			'field' => 'description',
			'label' => 'Description',
			'rules' => 'trim|required'
		),
		array(
			'field' => 'id',
			'rules' => 'trim|numeric'
		),
                array(
			'field' => 'image',
                        'label' => 'Upload Picture',
			'rules' => 'jpg|png|callback_check_type'
		),
                array(
                        'field' => 'c_upload',
                        'label' => 'Youtube Link',
			'rules' => 'required'
                    
                ),array(
                        'field' => 'c_duration',
                        'label' => 'Course Duration',
			'rules' => 'required|numeric'
                    
                ),array(
                        'field' => 'abilities',
                        'label' => 'Abilities',
			'rules' => 'required'
                    
                ),array(
                        'field' => 'interests',
                        'label' => 'Interests',
			'rules' => 'required'
                    
                )
                
                
         
	);
     protected $module_validation_rules = array(
		array(
			'field' => 'title',
			'label' => 'Module Title',
			'rules' => 'trim|required|max_length[100]|alpha'//|callback__check_title'
		),
		array(
                    'field' => 'dropdown1',
                    'label' => 'Skills1',
                    'rules' => 'required|callback_checkDropVal'
                ),array(
                    'field' => 'dropdown2',
                    'label' => 'Skills2',
                    'rules' => 'required'
                ),
	);
     protected $topic_validation_rules = array(
		array(
			'field' => 'title',
			'label' => 'Title',
			'rules' => 'trim|required|alpha'
		),
                array(
			'field' => 'text',
			'label' => 'Text',
			'rules' => 'trim|required|'
		),
                array(
			'field' => 'link',
			'label' => 'Link',
			'rules' => 'trim|required|callback_validate_link'
		),
         
	);
     protected $lesson_validation_rules = array(
//		array(
//			'field' => 'title',
//			'label' => 'Title',
//			'rules' => 'trim|required|max_length[100]|alpha|callback_check_lessontitle'//|callback__check_title'
//		),
		array(
                    
                    'field' => 'image',
                    'label' => 'Upload',
                    'rules' => 'xml|callback_check_type2'
                    
                ),
                
	);
      protected $lesson_validation_rules1 = array(
		
		array(
                    
                    'field' => 'image',
                    'label' => 'Upload',
                    'rules' => 'xml|callback_check_type2'
                    
                ),
                
	);

    public function __construct()
    {
        parent::__construct();

        $this->lang->load('syllabus');
        $this->load->driver('Streams');
        $this->load->model('syllabus_m');
        $this->load->library('files/files');
         $this->load->model('files/file_folders_m');
        $this->template
                          
                      
                        ->append_js('module::module.js')
                
               ->append_js('module::jquery.tablesorter.min.js')
                        ->append_js('module::jquery.tablesorter.pager.js')
                ->append_css('module::jquery.tablesorter.pager.css')
                 ->append_js('module::tiny.editor.packed.js')
                        ->append_js('module::admin.js')
                ->append_js('module::selectize.min.js')
                ->append_metadata($this->load->view('fragments/wysiwyg', $this->data, TRUE))
                
                        ->append_js('module::toggle_edit.js')
                        ->append_js('module::append_table.js')
                        ->append_js('module::formcheckers.js')
                   
                        ->append_css('module::admin.css')
                        ->append_css('module::tinyeditor.css')
                        ->append_css('module::css3_breadcrumbs.css')
                        ->append_css('module::selectize.default.css')
                      //  ->append_js('module::jquery.colorbox.js')
                        ->append_js('module::lesson.js')
          ->append_js('module::course.js');
        
        @session_start();
        session_start();
    }


    
    public function index(){
        $sectorlist = $this->syllabus_m->getSectorList();
        
       $this->template
			->title($this->module_details['name'])
                        ->set('sectorlist',$sectorlist)
                        ->build('admin/index');
        
    }
    
    
     public function order()
	{
		$order	= $this->input->post('order');
		$data	= $this->input->post('data');
		$root_pages	= isset($data['root_pages']) ? $data['root_pages'] : array();

		if (is_array($order))
		{

			foreach ($order as $i => $page)
			{
				$id = str_replace('page_', '', $page['id']);
				
				//set the order of the root pages
				$this->syllabus_m->update($id, array('order' => $i), true);

				//iterate through children and set their order and parent
				$this->syllabus_m->_set_children($page);
			}

			// rebuild page URIs
			$this->syllabus_m->update_lookup($root_pages);
	
		}
     
	}

    
    public function viewSector($id=0)
    {
        unset($_SESSION['modulelessonlist']);
        unset($_SESSION['lessonlist']);
        unset($_SESSION['sectorID']);
        unset($_SESSION['modules']);
        $sectorid = $this->syllabus_m->getID($id);
        $sectordetails = $this->syllabus_m->getSectorDetails($sectorid->HeirarchyID);
        $_SESSION['sectorDetails'] = $sectordetails->title;
         
        session_start();
        
        // current sector
        //print_r($_SESSION['sectorID']);
        $_SESSION['sectorID'] = $id;
        $items = $this->syllabus_m->get_tree($id);
        
       
		// Build the view with sample/views/admin/items.php
		$this->template
			->title('View Sector')
                        ->append_css('module::index.css')
                        ->append_js('jquery/jquery.ui.nestedSortable.js')
			->append_js('jquery/jquery.cooki.js')
			->append_js('jquery/jquery.stickyscroll.js')
                        ->append_js('module::index.js')
                        ->append_css('module::admin.css')
                        
                     
                        ->set('details',$sectordetails)
                        ->set('syllaid', $id)
                        
			->set('pages', $items)
			->build('admin/sector');
    }

 
    public function createSector()
    {
       
        $this->load->driver('Streams');
        $stream = $this->streams->streams->get_stream('sectors', 'sector');
        
        $sector_validation = $this->streams->streams->validation_array($stream->stream_slug, $stream->stream_namespace, 'new');
	
		// Combine our validation rules.
        $rules = array_merge($this->sector_validation_rules, $sector_validation);
        $this->form_validation->set_rules($rules);
        $item = new stdClass();
        
        //get the folder
         $folder = $this->file_folders_m->get_by('name', 'syllabus');
        
        
        if ($this->form_validation->run())
        {
            $imageid = Files::upload($folder->id,Null,'image');
            //print_r($imageid);
            if( $imageid['status']==TRUE){
            
              $entry_data = array(
             'title' => $this->input->post('title'),
             'description'   => $this->input->post('description'),
                'image' => $imageid['data']['id']
                );
            if ($id = $this->streams->entries->insert_entry($entry_data, 'sectors', 'sector'))
			{
                        //print_r($rules);
				$this->syllabus_m->addSectorSyllabus($id);
				$this->session->set_flashdata('success', sprintf($this->lang->line('sylla:succsec' ).' '.$this->input->post('title')));
                                

			}
			else
			{
				$this->session->set_flashdata('error', lang('sylla:errsec'));
			}
                         
                        redirect('admin/syllabus');
            }
            else{
               $this->session->set_flashdata('error', 'Error in uploading image. Please try again'.$imageid);
                 redirect('admin/syllabus');
               
            }
        }
        
         $item = new stdClass();
        
        foreach ($this->validation_rules as $rule)
		{
			$item->{$rule['field']} = set_value($rule['field']);
		}
        
               
        
        $this->template
			->title('Create Sector')
			->set('item', $item)
			->build('admin/formSector');
    }
    
    public function editSector($id = 0){
        $heirid = $this->syllabus_m->getHeirarchyId($id);
        $item = $this->syllabus_m->getSectorDetails($heirid);
       // print_r($item);
		// ID specified?
	$id or redirect('admin/syllabus');

	$this->form_validation->set_rules('id', 'ID', 'trim|required|numeric');
        //print_r($category);
       $this->load->driver('Streams');
       
       
        if($this->form_validation->run())
            {
             if (empty($_FILES['image']['name'])){
             $entry_data = array(
             'title' => $this->input->post('title'),
             'description'   => $this->input->post('description'),
               
                );
             }else{
             $folder = $this->file_folders_m->get_by('name', 'syllabus');
         $imageid = Files::upload($folder->id,Null,'image');
        $entry_data = array(
             'title' => $this->input->post('title'),
             'description'   => $this->input->post('description'),
                'image' => $imageid['data']['id']
                );
             
             }
             if ($id = $this->streams->entries->update_entry($item->id, $entry_data, 'sectors', 'sector'))
			{
				$this->session->set_flashdata('success', sprintf('Successfully edited Sector: '.$this->input->post('title')));
                                

			}
			else
			{
				$this->session->set_flashdata('error', lang('sylla:errsec'));
			}
                         
                        redirect('admin/syllabus');
             
        }
        
       // $item= new stdClass();
         foreach ($this->validation_rules as $rule)
		{
			$item->{$rule['field']} = set_value($rule['field']);
		}
        
                 $this->template
			->title('Edit Sector')
			->set('item', $item)
			->build('admin/formSector');
    }

    public function load_syllabus_details ($id){
            
             $details = new stdClass();
             // get syllabus details 
             //check what type for querying
             session_start();
             
             $sectordetails = $this->syllabus_m->getSyllabusDetails($id);
             
              if($sectordetails['Type'] == 2){
                 //Course
                   $_SESSION['parentcourseid'] = $sectordetails['ID'];
                     $result = $this->syllabus_m->getCourseDetails($sectordetails['HeirarchyID']);
                     $cabilities = $this->syllabus_m->getCourseAbilities($sectordetails['HeirarchyID']);
                     $cinterest = $this->syllabus_m->getCourseInterests($sectordetails['HeirarchyID']);
                     $_SESSION['courseid'] = $result->id;
                     $type = 'Course';
                     
             }
             else if($sectordetails['Type'] == 3){
                 $_SESSION['parentcourseid'] = $sectordetails['ID'];
                   $result = $this->syllabus_m->getModuleDetails($sectordetails['HeirarchyID']);
                 $coursedet =  $this->syllabus_m->getSyllabusDetails($sectordetails['ParentID']);
                    $type = 'Module';
                 //Module
             }
             else if ($sectordetails['Type'] == 4){
                 //$moduleDet = $this->syllabus_m->getSyllabusDetails($sectordetails['ParentID']);
                  $result = $this->syllabus_m->getLessonDetails($sectordetails['HeirarchyID']);
                   $type = 'Lesson';
                   
                   $tags = $this->syllabus_m->getLessonTags($sectordetails['HeirarchyID']);
                   $tagss = $this->syllabus_m->getTags();
                   
                   $tagq = array();
                   
                   foreach($tags as $t){
                       $tagq []= $t['tag']; 
                   };
                    
                   $tags = implode(",", $tagq);
             }
             else if ($sectordetails['Type'] == 5){
                  $type = 'Topic';
                  $lesson = $this->syllabus_m->getSyllabusDetails($sectordetails['ParentID']);
                  $result = $this->syllabus_m->getTopicDetails($sectordetails['HeirarchyID']);
                  $link = $this->syllabus_m->getContent($sectordetails['HeirarchyID']);
                  //echo $sectordetails['HeirarchyID'];
             }
             
           
             
             $syllabus['syllabus_id']=$id;
             $results = (object)$result;
              $options = $this->syllabus_m->getAbilitiesDropdown();
        $options2 = $this->syllabus_m->getInterestsDropdown();
        
       
             //print_r($this->syllabus_m->getSectorSyllabus($id));
             $this->load->view('admin/ajax/syllabus_details', array('coursedet'=>$coursedet['HeirarchyID'], 'topiclesson'=>$lesson['HeirarchyID'],'tagq'=>$tagq,'tagsq'=>$tags,'tagss' =>$tagss,'results' => $results,'slist'=>$slist, 'skills' => $skill, 'type' =>$sectordetails['Type'],'SyllabusType' => $type, 'syllaID' =>$sectordetails['ID'], 'link'=>$link,  'abilities' => $options, 'interests' => $options2, 'cabilities' => $cabilities, 'cinterest' => $cinterest));
            
        }
        
    public function checkDropVal(){//validation of login -> username
            
            
            if($this->input->post('dropdown1')!=$this->input->post('dropdown2')){
                
                return true;
            }
            else{
                $this->form_validation->set_message('checkDropVal','The selected skills are the same'); //setting the message for the function form_validation
                return false;
            }
        }
        
        public function create_course($parentid = 0){
        
         $_SESSION['sectorID'] = $parentid;
            
        $heirarchyID = $this->syllabus_m->getID($parentid);
        
        $coursedetail = $this->syllabus_m->getSectorDetails($heirarchyID->HeirarchyID);
        session_start();
        $_SESSION['sectorDetails'] = $coursedetail->title;
        
        $this->load->driver('Streams');
        $stream = $this->streams->streams->get_stream('courses', 'course');
        
        $sector_validation = $this->streams->streams->validation_array($stream->stream_slug, $stream->stream_namespace, 'new');
	
		// Combine our validation rules.
        $rules = array_merge($this->course_validation_rules, $sector_validation);
        $this->form_validation->set_rules($this->course_validation_rules);
        
         
        //get the folder
        
        $salary = $this->input->post('input_salary');
        $oppor = $this->input->post('input_oppur');
        
        $folder = $this->file_folders_m->get_by('name', 'syllabus');
        
        
        if ($this->form_validation->run())
        {
            $imageid = Files::upload($folder->id,Null,'image');
            
            if( $imageid['status']==TRUE){
            
              $entry_data = array(
             'title' => $this->input->post('title'),
             'description'   => $this->input->post('description'),
            'image' => $imageid['data']['id'],
            'updated' => now(),
            'status' => 'draft',
            'duration' => $this->input->post('c_duration')
                );
              $uploadid = 0;
              $courseid = 0;
            if ($id = $this->streams->entries->insert_entry($entry_data, 'courses', 'course'))
			{
                                  $courseid = $id;
				  $uploadid = $this->syllabus_m->addCourseSyllabus($id,$parentid);
                       
                                  //$this->syllabus_m->addCourseObjectives($id,$this->input->post('input_co'));
 
                                  for($i = 0; $i <= count($this->input->post('input_oppur')) &&  $i <= count($this->input->post('input_salary')); $i++ ){

                                    $this->syllabus_m->addCourseOpp($id,$salary[$i],$oppor[$i]);
                                }
                                
                                $this->syllabus_m->add_overview_video($id,2,$this->input->post('c_upload'));

                                foreach($this->input->post('abilities') as $a){
                                    $this->syllabus_m->addAbility($id,$a);
                                }
                                foreach($this->input->post('interests') as $a){
                                    $this->syllabus_m->addInterests($id,$a);
                                }
                                
                                //$this->syllabus_m->addCourseObjectives($id,$this->input->post('input_co'));
				$this->session->set_flashdata('success', sprintf($this->lang->line('sylla:succcour').$this->input->post('title')));
                                

			}
			else
			{
				$this->session->set_flashdata('error', lang('sylla:errsec'));
			}
                        session_start();
                         $_SESSION['courseid'] = $courseid;
                         $_SESSION['parentcourseid'] = $uploadid;
                         $this->syllabus_m->updateCourse($this->syllabus_m->getHeirarchyId($id));
                        $this->session->set_flashdata('success', sprintf('Course successfully created!'));
                        redirect('admin/syllabus/add_modules');
                        
            }
            else{
               $this->session->set_flashdata('error', 'File type is not supported');
               
                 redirect('admin/syllabus/create_course/'.$parentid);
               
            }
         // echo  print_r($this->input->post());
        }
        
       //$item = new stdClass();
        
        foreach ($this->course_validation_rules as $rule)
		{
                   
			$item->{$rule['field']} = set_value($rule['field']);
                        
		}
        $options = $this->syllabus_m->getAbilitiesDropdown();
        $options2 = $this->syllabus_m->getInterestsDropdown();
       
        
            $this->template
                    ->title('Create Course')
                    ->append_metadata($this->load->view('fragments/wysiwyg', $this->data, TRUE))
                    ->set('ctitle',$coursedetail)
                    ->set('parent',$parentid)
                    ->set('abilities',$options)
                    ->set('interests',$options2)
                    ->set('item',$item)
                    ->build('admin/course_form');
        }
        
        public function validate_link(){//validation of login -> username
            
            
            if($this->syllabus_m->validate_link()){
                
                return true;
            }
            else{
                $this->form_validation->set_message('validate_link','Youtube link is already in use'); //setting the message for the function form_validation
                return false;
            }
        }
        
        public function add_modules(){
           // print_r($_SESSION['modules']);
        $coursedetail = $this->syllabus_m->getCourseDetails($_SESSION['courseid']);    
        session_start();
        $_SESSION['courseName'] = $coursedetail->title;
        
        //echo print_r($_SESSION);    
        $modules = array();

        
        if(isset($_SESSION['modulelist'])){
             $modules = $_SESSION['modulelist'];   
        }
            
        
            
        $stream = $this->streams->streams->get_stream('modules', 'module');
        $sector_validation = $this->streams->streams->validation_array($stream->stream_slug, $stream->stream_namespace, 'new');
		// Combine our validation rules.
        $rules = array_merge($this->module_validation_rules, $sector_validation);
        $this->form_validation->set_rules($this->module_validation_rules);
        $item = new stdClass();
        
        
        if ($this->form_validation->run())
        {
         
            $modules[$this->input->post('title')] = array('title' =>$this->input->post('title'),
                'skill1' => $this->input->post('dropdown1'), 'skill2' => $this->input->post('dropdown2'), 'nolesson' => 0 );
            
         $_SESSION['modulelist'] = $modules;
         $tableentries = $_SESSION['modulelist'];
           
        }
        
        $item = new stdClass();
        
        foreach ($this->validation_rules as $rule)
		{
			$item->{$rule['field']} = set_value($rule['field']);
		}
        
        $query = $this->syllabus_m->getCoursesDropdown();
        $skills = $this->syllabus_m->getSkillsDropdown();
        
        $tableentries = $_SESSION['modulelist'];
        //echo print_r($parent_id);
            //print_r($_SESSION['modules']);
             //echo print_r($_SESSION);
            $this->template
                    ->title('Add Modules')
                    ->set('ctitle',$_SESSION['sectorDetails'])
                    ->set('course',$coursedetail->title)
                    ->set('skills',$skills)
                    ->set('entries',$tableentries)
                    ->build('admin/module_form');
        }
        
        public function add_lessons($modulename){
  
       $this->form_validation->set_rules('title','Title','trim|required|max_length[100]|callback_check_lessontitle['.$modulename.']');
        $lessons = array();
        $nooftopics = 0;
               //print_r($_SESSION);
         if(isset($_SESSION['modules'][$modulename]['lessonlist'])){ // previously isset Session lessonlist
            if(empty($_SESSION['modules'][$modulename]['lessonlist'])){
                 unset($_SESSION['lessonlist']);
            }else{
                if($_SESSION['modules'][$modulename]['lessonlist'] == $_SESSION['lessonlist']){
                    $lessons = $_SESSION['lessonlist'];  
                }else{
                    $lessons = $_SESSION['modules'][$modulename]['lessonlist'];
                }
                
                
            }
              
        }  else {
            unset($_SESSION['lessonlist']);
        }
        
        $stream = $this->streams->streams->get_stream('lessons', 'lesson');
        
        $sector_validation = $this->streams->streams->validation_array($stream->stream_slug, $stream->stream_namespace, 'new');
	
		// Combine our validation rules.
        $rules = array_merge($this->lesson_validation_rules, $sector_validation);
        $this->form_validation->set_rules($this->lesson_validation_rules);
        if ($this->form_validation->run())
        { 
            
            $this->load->library('files/files');
            $folder = $this->file_folders_m->get_by('name', 'syllabus');
            $imageid = Files::upload($folder->id,Null,'image');
            $topics = array();
            $xml = simplexml_load_file(FCPATH.'/uploads/'.SITE_REF.'/files/' .$imageid['data']['filename']);
         
            
               
                   foreach($xml->topic as $a){
                       
                       $links = array();
                      
                      foreach($a->links as $b){
                           //$links[] = $b->link;
                           foreach($b->link as $c)
                               $links[] = $c.'';
                       }

                       $topics[$a->title.''] = array('title' => $a->title.'', 'desc' => $a->text.'', 'link' =>$links);
                       $nooftopics++;

                   }
               
         session_start();    
          if($nooftopics == 0 ){
              $this->session->set_flashdata('error', 'The XML file is empty');
              redirect('admin/syllabus/add_lessons/'.$modulename);
             }else{
       // $_SESSION['aaaaaaa'] = "AAAAAAAA"; 
         $tags = explode(",",$this->input->post('tags'));
//         foreach ($this->input->post('tags') as $a){
////              $str = explode(",",$a);
////              print_r($str);
//                
//            }
//           
//            print_r($this->input->post('tags'));
            
        $lessons[$this->input->post('title')] = array('title'=>$this->input->post('title'),'notopics'=> $nooftopics,'assignedto' => $modulename, 'topics' =>$topics, 'tags' => $tags);
        $_SESSION['lessonlist'] = $lessons;     
        $_SESSION['modules'][$modulename]['module'][1]++;
             }
         
        } 
        //echo print_r($lessons);
        $_SESSION['modules'][$modulename]['lessonlist'] = $lessons; 
        $tagss = $this->syllabus_m->getTags();
      // print_r($_SESSION['modules'][$modulename]);
        $this->template
                ->title('Add Lessons')
                    //->set('entries',$_SESSION['modulelist'][$modulename]['lessons'])
                ->set('tagss', $tagss)
                ->set('ctitle',$_SESSION['sectorDetails'])
                ->set('course', $_SESSION['courseName'])    
                ->set('modulename', $modulename)
                    ->set('lessons', $lessons)
                    ->build('admin/lesson_form');
        }
        
        public function remove_module(){
            //print_r($POST);
            session_start();
            $array = $_POST;
            $value = $array['info'];
            $todelete = $value[0];
            $_SESSION['tryyy'] = $todelete;
            unset($_SESSION['modules'][$todelete]);
    
        }
        
        public function remove_lesson(){
            //print_r($_POST);
            session_start();
            $_SESSION['modules'][$_POST['info'][1]]['module'][1] = count($_SESSION['modules'][$_POST['info'][1]]['lessonlist']);
            unset($_SESSION['modules'][$_POST['info'][1]]['lessonlist'][$_POST['info'][0]]);
        }
        
        public function add_to_modules(){
           //print_r($_POST);
            
           $_SESSION['modules'][$_POST['module'][4]] = $_POST;
           
        }
        
        public function view_course_summary(){
           //check session if may course
            //pag save delete session of courseName, sectorDetails, modules,
            
            //print_r($_SESSION['modules']);
            if(!isset($_SESSION['modules']) || $_SESSION['modules'] == NULL){
                $this->session->set_flashdata('error', 'There are no modules');
                redirect('admin/syllabus/add_modules');
            }
           
            foreach($_SESSION['modules'] as $modules){
             
                if(empty($modules['lessonlist'])){
                      $this->session->set_flashdata('error', 'There are no lessons in '.$modules['module'][0]);
                      redirect('admin/syllabus/add_modules'); 
                }
                elseif(!isset($modules['lessonlist'])){
                      $this->session->set_flashdata('error', 'There are no lessons in '.$modules['module'][0]);
                      redirect('admin/syllabus/add_modules'); 
                }
            }
            
            $modules = $_SESSION['modules'];
            $parentcourse = $_SESSION['courseid'];
            
           // print_r($modules);
            $this->template
                    ->title('View Course Summary')
                    ->set('ctitle',$_SESSION['sectorDetails'])
                    ->set('course', $_SESSION['courseName'])    
                    ->set('modules',$modules)
                    
                    ->build('admin/courseSummary');
        }
        
        public function cancel_modules(){
            
            session_start();
            
            unset($_SESSION['modules']);
            unset($_SESSION['courseid']);
            unset($_SESSION['courseName']);
            unset($_SESSION['sectorDetails']);
            
            redirect('admin/syllabus');
        }

        public function save_modules(){
           $modules = $_SESSION['modules'];
            $parentcourse = $_SESSION['parentcourseid'];
            $parentmodule = 0;
            $parentlesson = 0;
            
            foreach($modules as $module){
                
                //add to module table
                //add skills
                
                //echo print_r($module['module']['0']);
              $entry_data = array(
             'title' => $module['module']['0'],
             'status' => 'live'
                );
              
               if ($id = $this->streams->entries->insert_entry($entry_data, 'modules', 'module')){
				//$this->syllabus_m->addModuleSyllabus($id,$parentcourse);
				//$this->session->set_flashdata('success', sprintf($this->lang->line('sylla:succmod').$this->input->post('title')));

                               
                                
                                $parentmodule = $this->syllabus_m->addModuleSyllabus($id,$parentcourse);;
		}
		else{
				$this->session->set_flashdata('error', lang('sylla:errsec'));
		}
              
                foreach($module['lessonlist'] as $lesson){
                    
                     $entry_data = array(
                    'title' => $lesson['title']
                     );
                     
                    if ($id = $this->streams->entries->insert_entry($entry_data, 'lessons', 'lesson'))
			{
				
				//$this->session->set_flashdata('success', sprintf($this->lang->line('sylla:succcour').$this->input->post('title')));
                                
                        foreach($lesson['tags'] as $a){
                            $tagid = $this->syllabus_m->tagExist($a);
                            $this->syllabus_m->addLessonTag($id,$tagid);
                        }
                       
                        
                                $parentlesson = $this->syllabus_m->addLessonSyllabus($id,$parentmodule);;   
			}
			else
			{
				$this->session->set_flashdata('error', lang('sylla:errsec'));
			}
                    //add to lessons
                        
                      
                    
                    foreach($lesson['topics'] as $topics){

                    $id = $this->syllabus_m->add_topics($topics['title'],$topics['desc']);
                    $this->syllabus_m->addTopicSyllabus($id,$parentlesson);
                    
                      foreach($topics['link'] as $link)
                      {
                          $this->syllabus_m->add_topic_video($id,$link);
                      }
                    
                    }
                   
                    
                }
                
            }
            
            session_start();
            
            unset($_SESSION['modules']);
            unset($_SESSION['courseid']);
            unset($_SESSION['courseName']);
            unset($_SESSION['sectorDetails']);
            unset($_SESSION['lessonlist']);
            
            $this->syllabus_m->updateCourse($this->syllabus_m->getHeirarchyId($parentcourse));
            $this->session->set_flashdata('success', sprintf('Course successfully updated!'));
            redirect('admin/syllabus/viewSector/'.$_SESSION['sectorID']);
            

        }
        
        public function edit_Summary(){
            $topicname= $this->input->get('topicname');
            $modkey = $this->input->get('modulekey');
            $lessonkey = $this->input->get('lesname');
            $this->load->view('admin/edit_courseSummary', array('topicname' => $topicname, 'modkey' => $modkey, 'leskey' => $lessonkey));
        }
        
        public function edit_course(){
            
        
        
             if (empty($_FILES['image']['name'])){
             $entry_data = array(
             'title' => $this->input->post('title'),
             'description'   => $this->input->post('description'),
             'status' => $this->input->post('status')
               
                );
             }else{
             $folder = $this->file_folders_m->get_by('name', 'syllabus');
         $imageid = Files::upload($folder->id,Null,'image');
        $entry_data = array(
             'title' => $this->input->post('title'),
            'status' => $this->input->post('status'),
             'description'   => $this->input->post('description'),
                'image' => $imageid['data']['id']
                );
             
             }
             
             if($entry_data['status'] == 'live-incomplete'){
                 $var = $this->syllabus_m->hasTest($this->input->post('courseid'));
                 
                 if( $var == 'true' ){
                      
                 }
                 elseif ($this->syllabus_m->modulesStatusAllDraft($this->input->post('courseid') )  == 'true') {
                         $this->session->set_flashdata('notice','All modules are a draft.'.$this->syllabus_m->modulesStatusAllDraft($this->input->post('courseid')));
                         
                         unset($entry_data['status']);
                 }
                 else{
                    $this->session->set_flashdata('notice','Please create a test first before making this live.');
                     unset($entry_data['status']);
                     
                 }
                 
             }
             
             else if($entry_data['status'] == 'live-complete'){
                 $var1 = $this->syllabus_m->hasTest($this->input->post('courseid'));
                  if($var1 == 'true' && $this->syllabus_m->hasOA($this->input->post('courseid'))){
                   
                 }else{
                     $this->session->set_flashdata('notice','Please create a test first before making this live.');
                     unset($entry_data['status']);
                     
                 }
             }
           
             if ($id1 = $this->streams->entries->update_entry($this->input->post('courseid'), $entry_data, 'courses', 'course'))
			{
                               
				$this->session->set_flashdata('success', sprintf('Successfully edited Course: '.$this->input->post('title')));
                                
                                $this->syllabus_m->deleteEntries($id1);
                                

                                 foreach($this->input->post('abilities') as $a){
                                    $this->syllabus_m->addAbility($id1,$a);
                                }
                                foreach($this->input->post('interests') as $a){
                                    $this->syllabus_m->addInterests($id1,$a);
                                }
			}
			else
			{
				$this->session->set_flashdata('error', lang('sylla:errsec'));
			}
                         
                       // redirect('admin/syllabus/viewSector/'.$_SESSION['sectorID']);
       
            redirect('admin/syllabus/viewSector/'.$_SESSION['sectorID']);            
            
        }
        
         public function edit_module(){
            
             $entry_data = array(
             'title' => $this->input->post('title'),
              'status' => $this->input->post('status')
            
               
                );
             
             
             if ($id1 = $this->streams->entries->update_entry($this->input->post('moduleid'), $entry_data, 'modules', 'module'))
			{
                                //$this->syllabus_m->updateParent($this->input->post('dropdown'),$id);
				$this->session->set_flashdata('success', sprintf('Successfully edited Module: '.$this->input->post('title')));
                                 $courseid = $this->syllabus_m->getModuleCParent($this->input->post('moduleid'));
			}
			else
			{
				$this->session->set_flashdata('error', lang('sylla:errsec'));
			}
                       
                        $this->syllabus_m->updateCourse($this->syllabus_m->getHeirarchyId($courseid->ParentID));
                        
                        if($this->syllabus_m->allDraft($courseid->ParentID) == 'true'){
                             $this->session->set_flashdata('notice','This course status is now DRAFT');
                        }
                        
                        
                        redirect('admin/syllabus/viewSector/'.$_SESSION['sectorID']);
   
        }
        
        public function edit_lesson(){
             
             $tags = explode(",",$this->input->post('tags'));
         
                       
                        
            $entry_data = array(
             'title' => $this->input->post('title'),
            
               
                );
             
             
             if ($id1 = $this->streams->entries->update_entry($this->input->post('lessonid'), $entry_data, 'lessons', 'lesson'))
			{
                         $this->syllabus_m->deleteEntries1($id1);
                                  foreach($tags as $a){
                            $tagid = $this->syllabus_m->tagExist($a);
                            $this->syllabus_m->addLessonTag($id1,$tagid);
                            }
				$this->session->set_flashdata('success', sprintf('Successfully edited Lesson: '.$this->input->post('title')));
                                
                                $courseid = $this->syllabus_m->getLessonCParent($this->input->post('lessonid'));
			}
			else
			{
				$this->session->set_flashdata('error', lang('sylla:errsec'));
			}
                         $this->syllabus_m->updateCourse($this->syllabus_m->getHeirarchyId($courseid));
                        redirect('admin/syllabus/viewSector/'.$_SESSION['sectorID']);
            
        }
        
        public function edit_topic(){
            
            $entry_data = array(
             'title' => $this->input->post('title'),
             'textCont' => $this->input->post('description')
               
                );
             
             
             $id1 = $this->syllabus_m->update_topics($this->input->post('topicid'),$entry_data);
             $this->syllabus_m->updateMedia($this->input->post('mediaid'), $this->input->post('link'));
                               
            $this->session->set_flashdata('success', sprintf('Successfully edited Topic: '.$this->input->post('title')));
              $courseid = $this->syllabus_m->getLessonCParent($this->input->post('topicid'));
              $this->syllabus_m->updateCourse($this->syllabus_m->getHeirarchyId($courseid));

                        
                        redirect('admin/syllabus/viewSector/'.$_SESSION['sectorID']);
            
        }
        
        public function editLessonSummary(){
            
            $modkey = $this->input->get('modkey');
            $leskey = $this->input->get('leskey');
            $topicname = $this->input->get('topicname');

            $_SESSION['modules'][$modkey]['lessonlist'][$leskey]['topics'][$topicname]['title'] = $this->input->post('t_title');
            $_SESSION['modules'][$modkey]['lessonlist'][$leskey]['topics'][$topicname]['desc'] = $this->input->post('sample');
           $lnks = array();
            foreach($this->input->post('utube_link') as $a){
                $links[] = $a;
            }
            $_SESSION['modules'][$modkey]['lessonlist'][$leskey]['topics'][$topicname]['link'] = $links;
            
            redirect('admin/syllabus/view_course_summary');
            
        }
        
        public function addLessons($moduleid){
            $moduleSyllaID = $_SESSION['parentcourseid'];
            
            $moduledetails = $this->syllabus_m->getModuleDetails($moduleid);
            
            $lessons = $_SESSION['modulelessonlist'];
            $nooftopics = 0;
            
            $stream = $this->streams->streams->get_stream('lessons', 'lesson');
        
            $sector_validation = $this->streams->streams->validation_array($stream->stream_slug, $stream->stream_namespace, 'new');
	
		// Combine our validation rules.
            $rules = array_merge($this->lesson_validation_rules, $sector_validation);
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run())
            { 
                $this->load->library('files/files');
                $folder = $this->file_folders_m->get_by('name', 'syllabus');
                $imageid = Files::upload($folder->id,Null,'image');
                $topics = array();
                $xml = simplexml_load_file(FCPATH.'/uploads/'.SITE_REF.'/files/' .$imageid['data']['filename']);


                   
                   foreach($xml->topic as $a){
                       
                       $links = array();
                      
                      foreach($a->links as $b){
                           //$links[] = $b->link;
                           foreach($b->link as $c)
                               $links[] = $c.'';
                       }

                       $topics[$a->title.''] = array('title' => $a->title.'', 'desc' => $a->text.'', 'link' =>$links);
                       $nooftopics++;

                   }

             session_start();    
              if($nooftopics == 0 ){
              $this->session->set_flashdata('error', 'The XML file is empty');
              redirect('admin/syllabus/addLessons/'.$moduleid);
             }else{
   
            $lessons[$this->input->post('title')] = array('title'=>$this->input->post('title'),'notopics'=> $nooftopics,'assignedto' => $modulename, 'topics' =>$topics);
            $_SESSION['modulelessonlist'] = $lessons;  
             }

            } 
            $tagss = $this->syllabus_m->getTags();
       
            $this->template
                    ->title('Add Lessons')
                    ->set('tagss',$tagss)
                    ->set('moduledetails',$moduledetails)
                    ->build('admin/lesson_form_2');
            
        }
        
          public function remove_lessonn(){
           // print_r($_POST);
            session_start();

            unset($_SESSION['modulelessonlist'][$_POST['info'][0]]);
        }
        
         public function saveLessons(){
            $moduleSyllaID = $_SESSION['parentcourseid'];
            foreach($_SESSION['modulelessonlist'] as $lesson){
                    
                     $entry_data = array(
                    'title' => $lesson['title']
                     );
                     
                    if ($id = $this->streams->entries->insert_entry($entry_data, 'lessons', 'lesson'))
			{
				
				//$this->session->set_flashdata('success', sprintf($this->lang->line('sylla:succcour').$this->input->post('title')));
                                
                                $parentlesson = $this->syllabus_m->addLessonSyllabus($id,$moduleSyllaID);;   
			}
			else
			{
				$this->session->set_flashdata('error', lang('sylla:errsec'));
			}
                    //add to lessons
                    
                    foreach($lesson['topics'] as $topics){

                    $id = $this->syllabus_m->add_topics($topics['title'],$topics['desc']);
                    $this->syllabus_m->addTopicSyllabus($id,$parentlesson);
                    
                        foreach($topics['link'] as $link)
                      {
                          $this->syllabus_m->add_topic_video($id,$link);
                      }
                    
                    }

                }
                $courseid = $this->syllabus_m->getModuleCParent($this->input->post('moduleid'));
                 $this->syllabus_m->updateCourse($this->syllabus_m->getHeirarchyId($courseid));
                $this->session->set_flashdata('success', sprintf('Module successfully updated!'));
                redirect('admin/syllabus/viewSector/'.$_SESSION['sectorID']);
        }
        
        public function loadUpload($lessonid){
            $this->load->view('admin/lesson_upload',array('lessonid'=>$lessonid));
        }
        
        public function uploadTopics($lessonid){
            $syllaid = $this->syllabus_m->getLessonSyllabus($lessonid);
            
                $this->load->library('files/files');
                $folder = $this->file_folders_m->get_by('name', 'syllabus');
                $imageid = Files::upload($folder->id,Null,'image1');
                $topicss = array();
                $xml = simplexml_load_file(FCPATH.'/uploads/'.SITE_REF.'/files/' .$imageid['data']['filename']);
                  
                foreach($xml->topic as $a){
                        
                      $links = array();
                      
                      foreach($a->links as $b){
                           //$links[] = $b->link;
                           foreach($b->link as $c)
                               $links[] = $c.'';
                       }
                      
                       $topicss[$a->title.''] = array('title' => $a->title.'', 'desc' => $a->text.'', 'link' => $links);
    
                 }
                 
                // print_r($topicss);
                
                   
                   foreach($topicss as $topics){

                    $id = $this->syllabus_m->add_topics($topics['title'],$topics['desc']);
                    $this->syllabus_m->addTopicSyllabus($id,$syllaid->ID);
                      foreach($topics['link'] as $link)
                      {
                          //echo $link;
                          $this->syllabus_m->add_topic_video($id,$link);
                      }
                    //$this->syllabus_m->add_topic_video($id,$topics['link']);
                    
                    }
                    
                    $this->session->set_flashdata('success', sprintf('Topics successfully uploaded!'));
                    $courseid = $this->syllabus_m->getLessonCParent($lessonid);
                    $this->syllabus_m->updateCourse($this->syllabus_m->getHeirarchyId($courseid));
                redirect('admin/syllabus/viewSector/'.$_SESSION['sectorID']);
            
        }


        
        public function deleteSector($Secsid){
            $details = $this->syllabus_m->getSyllabusDetails($Secsid);
            
            $this->syllabus_m->deleteSector($details['HeirarchyID']);
            
            redirect('admin/syllabus');
            
        }
        
       public function deleteCourse($courseid){
          
            
            $this->syllabus_m->deleteCourse($courseid);
            
            redirect('admin/syllabus/viewSector/'.$_SESSION['sectorID']);
        }
        
        public function deleteModule($modid){
           
            
            $this->syllabus_m->deleteModule($modid);
            
            redirect('admin/syllabus/viewSector/'.$_SESSION['sectorID']);
        }
        
        public function deleteLesson($modid){
           
            
            $this->syllabus_m->deleteLesson($modid);
            
            redirect('admin/syllabus/viewSector/'.$_SESSION['sectorID']);
        }
        
        public function deleteTopic($modid){
           
            
            $this->syllabus_m->deleteTopic($modid);
            
            redirect('admin/syllabus/viewSector/'.$_SESSION['sectorID']);
        }
        
        function check_type()
        {
    if ((($_FILES["image"]["type"] == "image/gif")
|| ($_FILES["image"]["type"] == "image/jpeg")
|| ($_FILES["image"]["type"] == "image/jpg")
|| ($_FILES["image"]["type"] == "image/pjpeg")
|| ($_FILES["image"]["type"] == "image/x-png")
|| ($_FILES["image"]["type"] == "image/png")))
      {
     
    }
    else
    {
     $this->form_validation->set_message('check_type','Please upload an Image');
        return false;
    }
  }
  function check_type2()
        {
    if ($_FILES["image"]["type"] == "text/xml" &&!empty($_FILES['image']['name'])){
     
    }
    else
    {
     
     $this->form_validation->set_message('check_type2','Please upload an XML file');
        return false;
    }
  }
  
  public function getLikes($fanpage_name){
//            echo "AAA";
//            $fanpage_name = 40796308305;
//        //print_r($this->fetch_fb_fans(40796308305, 2, 400000));
//            print_r(file_get_contents('https://api.facebook.com/method/fql.query?query=select%20like_count%20from%20link_stat%20where%20url=%27http://stackoverflow.com/%27&format=json'));
//            //$fanpage_data = json_decode(file_get_contents('http://graph.facebook.com/' . $fanpage_name), true);
      $likes = json_decode(file_get_contents('https://api.facebook.com/method/fql.query?query=select%20like_count%20from%20link_stat%20where%20url=%27http://stackoverflow.com/%27&format=json'));
      print_r(json_decode(file_get_contents('https://api.facebook.com/method/fql.query?query=select%20like_count%20from%20link_stat%20where%20url=%27http://facebook.com/%27&format=json')));
      echo $likes[0]->like_count;  //based on url
      
      echo($this->fetch_fb_fans(40796308305)); // based on id
  }
        
        public function fetch_fb_fans($fanpage_name, $no_of_retries = 10, $pause = 500000 /* 500ms */){
    $ret = array();
    // get page info from graph
    $fanpage_data = json_decode(file_get_contents('http://graph.facebook.com/' . $fanpage_name), true);
    if(empty($fanpage_data['id'])){
        // invalid fanpage name
        return $ret;
    }
//    $matches = array();
//    $url = 'http://www.facebook.com/plugins/fan.php?connections=100&id=' . $fanpage_data['id'];
//    $context = stream_context_create(array('http' => array('header' => 'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:22.0) Gecko/20100101 Firefox/22.0')));
//    for($a = 0; $a < $no_of_retries; $a++){
//        $like_html = file_get_contents($url, false, $context);
//        preg_match_all('{href="http://www\.facebook\.com/([a-zA-Z0-9._-]+)" data-jsid="anchor" target="_blank"}', $like_html, $matches);
//        if(empty($matches[1])){
//            // failed to fetch any fans - convert returning array, cause it might be not empty
//            return array_keys($ret);
//        }else{
//            // merge profiles as array keys so they will stay unique
//            $ret = array_merge($ret, array_flip($matches[1]));
//        }
//        // don't get banned as flooder
//        usleep($pause);
//         }
//    return array_keys($ret);
    return $fanpage_data['likes'];
    }

//print_r(fetch_fb_fans('Airnovapl', 2, 400000));
        
    public function replaceXML(){
        $moduleindex = $this->input->get('modulekey');
        $lessonindex = $this->input->get('lessonkey');
//        echo $lessonindex;
//        echo $moduleindex;
        //update no of items
        // print_r($_SESSION['modules'][$moduleindex]);
        
           $this->form_validation->set_rules($this->lesson_validation_rules1);
          if ($this->form_validation->run())
            { 
              
              
               //echo $lessonindex;
                $this->load->library('files/files');
                $folder = $this->file_folders_m->get_by('name', 'syllabus');
                $imageid = Files::upload($folder->id,Null,'image');
                $topics = array();
                $xml = simplexml_load_file(FCPATH.'/uploads/'.SITE_REF.'/files/' .$imageid['data']['filename']);


                    //echo $lessonindex;
                   foreach($xml->topic as $a){
                       
                       $links = array();
                      
                      foreach($a->links as $b){
                           //$links[] = $b->link;
                           foreach($b->link as $c)
                               $links[] = $c.'';
                       }

                       $topics[$a->title.''] = array('title' => $a->title.'', 'desc' => $a->text.'', 'link' =>$links);
                       $nooftopics++;
                       
                   }
                   session_start();     
                   //echo $lessonindex;
                   // $lessona['$lessonindex'] = $topics;
                   //print_r($lessona);
                    $_SESSION['modules'][$moduleindex]['lessonlist'][$lessonindex]['topics'] = $topics;
                     $_SESSION['modules'][$moduleindex]['lessonlist'][urldecode($lessonindex)]['notopics'] = $nooftopics;
                     //print_r($_SESSION['modules'][$moduleindex]);
                     //print_r($topics);
                     //redirect('admin/syllabus/view_course_summary');
            //$lessons[$this->input->post('title')] = array('title'=>$this->input->post('title'),'notopics'=> $nooftopics,'assignedto' => $modulename, 'topics' =>$topics);
           // $_SESSION['modulelessonlist'] = $lessons;     
           // 
                    //redirect('admin/syllabus/replaceXML?modulekey='.urlencode($moduleindex).'&lessonkey='.urlencode($lessonindex));
                      redirect('admin/syllabus/view_course_summary');
            }
//            else{
//                $this->session->set_flashdata('error', validation_errors());
//                redirect('admin/syllabus/view_course_summary');
//            } 
        
        
        $this->load->view('admin/replaceXML', array('lessonindex' =>$lessonindex,'moduleindex'=>$moduleindex));
    }
    
    function check_lessontitle($title,$modulename){
        
        if(!isset($_SESSION['modules'][$modulename]['lessonlist'])){
             $this->form_validation->set_message('check_lessontitle','AA');
            return true;
        }else{
            foreach($_SESSION['modules'][$modulename]['lessonlist'] as $lessons){
                if(strcasecmp($title, $lessons['title'])==0){
                    $this->form_validation->set_message('check_lessontitle','Lesson name already exist');
                    return false;
                }else{
                    return true;
                }
            }
        }
        
        
//        
//        if($title == "a"){
//               $this->form_validation->set_message('check_lessontitle',$modulename);
//        return false;
//        }else{
//            return true;
//        }
     
    }
        
        
             
}