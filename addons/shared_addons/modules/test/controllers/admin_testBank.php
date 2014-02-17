<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_testBank extends Admin_Controller
{
    
        protected $val_rule = array(
		array(
                    'field' => 'modules[]',
                    'label' => 'Module dropdown',
                    'rules' => 'required|callback_checkDropVal'
                ),
            array(
                'field' => 'testtype[]',
                'label' => 'Test Type',
                'rules' => 'required'
            )
	);
        
	protected $number_validation_rules = array(
		array(
			'field' => 'noitems',
			'label' => 'No. of Items',
			'rules' => 'trim|required|numeric'//|callback__check_title'
		)
            );

	public function __construct()
	{
		parent::__construct();
                
		// Load all the required classes
		$this->load->model('testbank_m');
                $this->load->model('test_m');
		$this->load->library('form_validation');
		
                
                //session_start();
		

		// We'll set the partials and metadata here since they're used everywhere
		$this->template
                         ->append_js('module::test.js')
                        
                      ->append_css('module::css3_breadcrumbs.css')
                        ->append_js('module::admin.js')
                        ->append_js('module::append_test.js')
                        ->append_js('module::testItems.js')
                        ->append_css('module::jquery.tablesorter.pager.css')
                        ->append_js('module::jquery.tablesorter.min.js')
                        ->append_js('module::jquery.tablesorter.pager.js')
                        ->append_js('module::items.js')
                        ->append_js('module::filter_dropdown.js')
						->append_css('module::admin.css');
	}
        
        

	
	public function index()
	{
	
            $courses = $this->testbank_m->getCourseOA();
            $courselist = array();
            
            foreach($courses as $course){
                //$course['noOfItems'] = $this->testbank_m->getItemCount($course['courseID']);
               
                $course['details'] = $this->testbank_m->getOA($course['id']);
                $courselist[] = $course;
            }
            
            $courses1 = $this->testbank_m->getAllCourses();
                
                $formoptions = array();
                $formoptions[0] = 'All';
                
                foreach($courses1['entries'] as $course){
                    $formoptions[$course['id']] = $course['title'];
                }
            
                $modules = $this->testbank_m->getModulesSC();
                $modulelist = array();
                
                foreach($modules as $module){
                    $details =  $this->testbank_m->getSC($module['id']);
                    $module['details'] = $details;
                   $type = $this->testbank_m->getSCType($details->testID);
                    $module['type'] = $type->testType;
                    $modulelist[] = $module;
                    
                   
                }
                
           
		$this->template
			->title($this->module_details['name'])
			->set('courselist',$courselist)
                        ->set('courselists',$formoptions)
                        ->set('modulelist', $modulelist)
			->build('admin/testBank/index');
	}

	
        
        public function addOATest($courseid){
             //echo print_r($_SESSION);
            $_SESSION['cour'] = $courseid;
            
            $course = $this->testbank_m->getSyllabusID($courseid);
            $modules = $this->testbank_m->getModules($course->ID);
        
             $types = $this->input->post('testtype');
            
            $ctr = 0;
            foreach($modules as $key=>$m){
                $params = $key.",".$m.",0,".$types[$ctr];
                $this->form_validation->set_rules("section_noitems[".$ctr."]", "No of items in Module".$m, "required|numeric|callback_valid[".$params."]");
                $newarray = array(
			'field' => "section_noitems[".$ctr."]",
			'label' => "No of items in Module".$m,
			'rules' => "required|callback_valid[".$params."]"
		);
                array_push($this->val_rule,$newarray);
                $ctr++;
            }
                $this->form_validation->set_rules($this->val_rule);
            //  print_r($this->form_validation);
            if($this->form_validation->run()){
                $totalitems = 0;
                $noOfItems = $this->input->post('section_noitems');
                $types = $this->input->post('testtype');
                foreach ($this->input->post('section_noitems') as $itemcount){
                     $totalitems += $itemcount;
                }
              

                //$courseid = $this->testbank_m->getHid($course);

                $testbankid = $this->testbank_m->addOATest($courseid,$totalitems);
                
                $ctr1 = 0;
                
                foreach($this->input->post('modules') as $key=>$m){
                $this->testbank_m->addOASection($testbankid,$m,$noOfItems[$ctr1],$types[$ctr1]);
                $ctr1++;
                }
                $this->session->set_flashdata('success', sprintf('Successfully added an Online Assessment!'));
            redirect('admin/test/testBank');
            }
            
            $item = new stdClass();
        
            foreach ($this->val_rule as $rule)
		{
                    
			$item->{$rule['field']} = set_value($rule['field']);
		}
             //$course = 86;//$this->input->get('course'); this should be syllabus id
             $coursedetails = $this->testbank_m->getCourseTitle($courseid);
             $formoptions = $this->testbank_m->getTestTypes();
             
           //  print_r($_SESSION['tsections']);
             $this->template
                     ->title('Add Online Assessment')
                  ->set('course',$course->ID)
                  ->set('item',$item)
                  ->set('coursedetails',$coursedetails)
                  ->set('modules', $modules)
                  ->set('dropdownvalues', $formoptions)
                  ->build('admin/testBank/addTest');
            
        }
        
        
         public function viewTest(){
             $this->template->build('admin/testBank/viewTest');
             
         }
 
          public function addSelfCheck($moduleid){
           
           $module = $this->testbank_m->getMSyllabusID($moduleid);//$this->input->get('course'); this should be syllabus id
           $moduledetails = $this->testbank_m->getModuleTitle($moduleid);
           //$this->form_validation->set_rules($this->number_validation_rules);
           
           $courseparent = $this->testbank_m->getParent($module->ID);
           //print_r($courseparent);
           $courseid = $this->testbank_m->getHid($courseparent);
           //print_r($courseid);
           $params = $moduleid.','.$moduledetails.",0,".$this->input->post('section_itemtype');
           $this->form_validation->set_rules("noitems", "No of items", "required|numeric|callback_valid[".$params."]");
           if($this->form_validation->run()){
              //echo $this->input->post('section_itemtype');
               
              
             $testbankid = $this->testbank_m->saveSCTest($courseid,$this->input->post('noitems'));
               $this->testbank_m->addOASection($testbankid,$moduleid,$this->input->post('noitems'),$this->input->post('section_itemtype'));
              $this->session->set_flashdata('success', sprintf('Successfully added a Self Check!'));
               redirect('admin/test/testBank');
               
               
           }
           
           
           
           //$this->input->get('course'));
            $formoptions = $this->testbank_m->getTestTypes();   
            $this->template
                    ->title('Add Self Check')
                    ->set('moduledetails', $moduledetails)
                     ->set('dropdownvalues', $formoptions)
                    ->build('admin/testBank/selfCheckForm');
            
        }
          public function editTest(){
              $sectionid = $this->input->get('sectionid');
              $sectionno = $this->input->get('secitionno');
              $moduleid = $this->input->get('moduleid');
             
              $sectiondetails = $this->testbank_m->getSectionDetails($sectionid);
              $formoptions = $this->testbank_m->getTestTypes();
            
              
            $this->load->view('admin/testBank/editTest', array('formoptions' => $formoptions, 'section' => $sectiondetails, 'no' => $sectionno, 'moduleid' => $moduleid));
            
        }
        
        public function addTestSection(){
           // print_r($_POST['section'][3]);
            $_SESSION['tsections'][$_POST['section'][3]] = $_POST;
        }
        
        public function removeSection(){
           //print_r($_POST);
            $id=$_POST['info'][0];
           unset($_SESSION['tsections'][$id]);
        }
        
        public function saveTestSections(){
            $sections = $_SESSION['tsections'];
            $totalitems = 0;
            foreach($sections as $section){
                //echo print_r($section);
                $totalitems += $section['section'][1];
            }
            //echo $totalitems;
            //echo $this->input->get('course');
            $courseid = $this->testbank_m->getHid($this->input->get('course'));
            
            $testbankid = $this->testbank_m->addOATest($courseid,$totalitems);
            

//section[0] = select_Type; // type
//section[1] = no_items;//number of items
//section[2] = select_diff; // module
//section[3] = ctr; // checker of index
//section[4] = type;
//section[5] = module;
            foreach($sections as $section){
                $this->testbank_m->addOASection($testbankid,$section['section'][2],$section['section'][1],$section['section'][0]);
            }
            
            unset($_SESSION['tsections']);
             $this->session->set_flashdata('success', sprintf('Successfully added an Online Assessment!'));
            redirect('admin/test/testBank');
            
        }
        
        public function saveSections(){
            $this->form_validation->set_rules($this->val_rule);
            
//            foreach($this->input->post('section_noitems') as rule)
            if($this->form_validation->run()){
            $totalitems = 0;
            //print_r($this->input->post('section_noitems'));
            //print_r($this->input->post('testtype'));
            foreach ($this->input->post('section_noitems') as $itemcount){
                 $totalitems += $itemcount;
            }
            echo $totalitems;
//            
//            $courseid = $this->testbank_m->getHid($this->input->get('course'));
//            
//            $testbankid = $this->testbank_m->addOATest($courseid,$totalitems);
            }
            else{
                
            }
        }
        
        public function viewOnlineAssessment($courseid){
            $coursedetails = $this->testbank_m->getCourseTitle($courseid);
            $courseOA= $this->testbank_m->getOA($courseid);
            
            $_SESSION['courseOA'] = $courseid;
            $sections = $this->testbank_m->getSections($courseOA->testID);
            
            //print_r($sections);
            
            $this->template
                    ->title('View Online Assessment')
                    ->set('sections',$sections)
                    ->set('totalitems',$courseOA->noOfItems)
                    ->set('coursedetails', $coursedetails)
                    ->build('admin/testBank/viewOA');
        }
        
        public function removeSections($sectionID){
            $this->testbank_m->removeSection($sectionID);
            
              $this->session->set_flashdata('success', sprintf('Deleted a section'));
              
              redirect('admin/test/testBank/viewOnlineAssessment/'.$_SESSION['courseOA']);
            
        }
        
        public function edit_section(){
            $noItems = $this->input->post('no_items');
            $testtype = $this->input->post('section_itemtype');
            $sectionid = $this->input->post('sectionID');
            $moduleid = $this->input->post('moduleID');
            $params = $moduleid.",0,".$testtype;
            $this->form_validation->set_rules("no_items", "No of items", "required|numeric|callback_valid1[".$params."]");
            
            if($this->form_validation->run()){
            
            
            $this->testbank_m->updateSection($sectionid,$noItems,$testtype);
             $this->session->set_flashdata('success', sprintf('Saved!'));
            
             
             
            redirect('admin/test/testBank/viewOnlineAssessment/'.$_SESSION['courseOA']);
            }else{
                 $this->session->set_flashdata('error', 'Not enough items');
            }
            
            redirect('admin/test/testBank/viewOnlineAssessment/'.$_SESSION['courseOA']);
        }
        
        
        public function loadItemTable($courseid){
             
              $modulelist = array();
             if($courseid == 0){
               $modules = $this->testbank_m->getModulesSC();
               
                
                foreach($modules as $module){
                    print_r($module);
                        
                    $details =  $this->testbank_m->getSC($module['id']);
                    $module['HeirarchyID'] = $module['id'];
                    if(empty($details)){
                        $modulelist[] = $module;
                        
                    }else{
                   
                    $module['details'] = $details;
                   $type = $this->testbank_m->getSCType($details->testID);
                    $module['type'] = $type->testType;
                    $module['HeirarchyID'] = $module['id'];
                    $modulelist[] = $module;
                    }
                }
             }
           
             else{
                 $coursesylla = $this->testbank_m->getSyllabusID($courseid);
                 //$msyllabus = $this->testbank_m->getMSyllabusID($coursesylla->ID);
                 $modules = $this->testbank_m->getCModulesSC($coursesylla->ID);
                
                 foreach($modules as $module){
                    
                        
                    $details =  $this->testbank_m->getSC($module['HeirarchyID']);
                    
                    if(empty($details)){
                        $modulelist[] = $module;
                    }else{
                   
                    $module['details'] = $details;
                   $type = $this->testbank_m->getSCType($details->testID);
                    $module['type'] = $type->testType;
                    $modulelist[] = $module;
                    }
                }
                 

                 
            }
            
            //print_r($modulelist);
             
             $this->load->view('admin/testBank/item_table', array('modulelist' => $modulelist));
         }
         
         public function viewSelfCheck($moduleid){
             $moduletitle = $this->testbank_m->getModuleTitle($moduleid);
             $scdetails = $this->testbank_m->getSelfCheck($moduleid);
             $formoptions = $this->testbank_m->getTestTypes();
             //print_r($scdetails);
             
             $this->load->view('admin/testBank/viewSelfCheck',array('title' => $moduletitle, 'details' => $scdetails, 'formoptions' => $formoptions, 'moduleid'=>$moduleid));
         }
         
         public function editSelfCheck(){
             $secttid = $this->input->post('sectid');
             $noItems = $this->input->post('noItems');
             $testtype = $this->input->post('itemType');
              $moduleid = $this->input->post('moduleID');
            $params = $moduleid.",1,".$testtype;
            $this->form_validation->set_rules("noItems", "No of items", "required|numeric|callback_valid1[".$params."]");
            
            if($this->form_validation->run()){
            
            
             $this->session->set_flashdata('success', sprintf('Saved!'));
             $this->testbank_m->updateSection($secttid,$noItems,$testtype);
             redirect('admin/test/testBank#selfcheck');
            }else{
                $this->session->set_flashdata('error', "Not enought items");
            }
             
             redirect('admin/test/testBank#selfcheck');
         }
         
         
         public function previewOnlineAssessment($courseid){
            $questions = array();
            $answers = array();
            $correct = array();
            $sectionctr = 1;
            $test = $this->test_m->getTest($courseid);
            $coursedetails = $this->test_m->getCourseDetails($courseid);
            $sections = $this->test_m->getTestSections($test->testID);
            $arrayextra = array();



            foreach ($sections as $sect) {
                $noOfDiff = $this->test_m->getDifficultyCount($courseid, $sect['moduleID'], $sect['testType']);
                $diff = $this->test_m->getDifficulties($courseid, $sect['moduleID'], $sect['testType']);

                $extra = $sect['noOfItems'] % $noOfDiff;
                $ctr = $sect['noOfItems'] / $noOfDiff;
                //echo $diff;

                foreach ($diff as $d) {

                    if ($extra >= 1) {

                        $results = $this->test_m->getItem($courseid, $sect['moduleID'], $sect['testType'], $d['difficulty'], $ctr + 1);
                        $arraycount = count($results);
                        $itemm = array();

                        //echo $arraycount;
                        foreach ($results as $key => $result) {
                            if ($key == $arraycount - 1) {
                                $arrayextra[$sectionctr][] = $result;
                            } else {
                                $itemm[] = $result;
                            }
                        }

                    } else {
                        $itemm = $this->test_m->getItem($courseid, $sect['moduleID'], $sect['testType'], $d['difficulty'], $ctr);
                    }



                    $questions[$sectionctr][] = $itemm;

                    if ($sect['testType'] == 1) {
                        foreach ($itemm as $i) {
                            $try = array();
                            //$answers[] = $this->test_m->getChoices($i['itemID']);

                            $choices = $this->test_m->getChoices($i['itemID']);

                            foreach ($choices as $key => $choice) {
                                array_push($try, $choice['choice']);
                                if ($key == 0) {
                                    $correct[$sectionctr][] = $choice['choice'];
                                }
                            }

                            $answers[$i['prompt']][] = $this->shuffle_assoc($try);
                        }
                    } elseif ($sect['testType'] == 2) {
                        $tf = array();
                        foreach ($itemm as $i) {
                            if ($i['response'] == 'True' || $i['response'] == 'true') {
                                $tf = array('True', 'False');
                            } else {
                                $tf = array('False', 'True');
                            }

                            $answers[$i['prompt']][] = $tf;
                            $correct[$sectionctr][] = $i['response'];
                        }
                    } elseif ($sect['testType'] == 3) {
                        foreach ($itemm as $i) {
                            $answers[$i['prompt']][] = $i['response'];
                            $correct[$sectionctr][] = $i['response'];
                        }
                    }
                }


                $sectionctr++;
            }

            $questions1 = $questions;
            $correct1 = $correct;
            $answers1 = $answers;

            if ($extra >= 1) {
                //print_r($arrayextra);
                $sectionctr1 = 1;
                // $indexa = count($questions[$sectionctr1]);
                foreach ($sections as $sect) {

                    shuffle($arrayextra[$sectionctr1]);
                    //print_r($extra);
                    $itemm1 = array();
                    for ($i = 0; $i < $extra; $i++) {
                        $itemm1[] = $arrayextra[$sectionctr1][$i];

                        //echo "A";
                    }

                    foreach ($itemm1 as $itemm2) {
                        $questions1[$sectionctr1][] = array($itemm2);
                    }

                    if ($sect['testType'] == 1) {
                        foreach ($itemm1 as $i) {
                            $try = array();
                            //$answers[] = $this->test_m->getChoices($i['itemID']);

                            $choices = $this->test_m->getChoices($i['itemID']);

                            foreach ($choices as $key => $choice) {
                                array_push($try, $choice['choice']);
                                if ($key == 0) {
                                    $correct1[$sectionctr1][] = $choice['choice'];
                                }
                            }

                            $answers1[$i['prompt']][] = $this->shuffle_assoc($try);
                        }
                    } elseif ($sect['testType'] == 2) {
                        $tf = array();
                        foreach ($itemm1 as $i) {
                            if ($i['response'] == 'True' || $i['response'] == 'true') {
                                $tf = array('True', 'False');
                            } else {
                                $tf = array('False', 'True');
                            }

                            $answers1[$i['prompt']][] = $tf;
                            $correct1[$sectionctr1][] = $i['response'];
                        }
                    } elseif ($sect['testType'] == 3) {
                        foreach ($itemm1 as $i) {
                            $answers1[$i['prompt']][] = $i['response'];
                            $correct1[$sectionctr1][] = $i['response'];
                        }
                    }

                    $sectionctr1++;
                }
                //print_r($questions1);
            }

           // $this->load->view('admin/testBank/preview_OA', array('questions'=>$questions1, 'answers'=>(object)$answers1, 'sections'=>$sections, 'course'=>$coursedetails));
                  $this->template->set('questions', $questions1)
                          ->set('answers',(object) $answers1)
                          ->set('sections', $sections)
                          ->set('course', $coursedetails)
                          ->build('admin/testBank/preview_OA');
             
            //echo "AAAA";
         }
         
         public function shuffle_assoc($array) {
                $keys = array_rand($array, count($array));

                shuffle($keys);

                foreach ($keys as $key)
                    $new[$key] = $array[$key];
                $array = $new;
                return $array;
        }
         
        public function previewSelfCheck($moduleid){
            $courseid = $this->test_m->getHid($this->test_m->getParent($moduleid));

        $questions = array();
        $answers = array();
        $correct = array();
        $sectionctr = 1;
        $test = $this->test_m->getSelfCheckTest($courseid);
        $moduledetails = $this->test_m->getModuleDetails($moduleid);
        $sections = $this->test_m->getSelfCheck($test->testID, $moduleid);



        $noOfDiff = $this->test_m->getDifficultyCount($courseid, $sections->moduleID, $sections->testType);
        $diff = $this->test_m->getDifficulties($courseid, $sections->moduleID, $sections->testType);

        $extra = $sections->noOfItems % $noOfDiff;
        $ctr = $sections->noOfItems / $noOfDiff;
        //echo $diff;

        foreach ($diff as $d) {

            if ($extra >= 1) {

                $results = $this->test_m->getItem($courseid, $sections->moduleID, $sections->testType, $d['difficulty'], $ctr + 1);
                $arraycount = count($results);
                $itemm = array();

                //echo $arraycount;
                foreach ($results as $key => $result) {
                    if ($key == $arraycount - 1) {
                        $arrayextra[$sectionctr][] = $result;
                    } else {
                        $itemm[] = $result;
                    }
                }
                //print_r($arrayextra);
            } else {


                $itemm = $this->test_m->getItem($courseid, $sections->moduleID, $sections->testType, $d['difficulty'], $ctr);
            }

            $questions[$sectionctr][] = $itemm;
            //print_r($itemm);
            if ($sections->testType == 1) {
                foreach ($itemm as $i) {
                    $try = array();
                    //$answers[] = $this->test_m->getChoices($i['itemID']);

                    $choices = $this->test_m->getChoices($i['itemID']);

                    foreach ($choices as $key => $choice) {
                        array_push($try, $choice['choice']);
                        if ($key == 0) {
                            $correct[$sectionctr][] = $choice['choice'];
                        }
                    }

                    $answers[$i['prompt']][] = $this->shuffle_assoc($try);
                }
            } elseif ($sections->testType == 2) {
                $tf = array();
                foreach ($itemm as $i) {
                    if ($i['response'] == 'True' || $i['response'] == 'true') {
                        $tf = array('True', 'False');
                    } else {
                        $tf = array('False', 'True');
                    }

                    $answers[$i['prompt']][] = $tf;
                    $correct[$sectionctr][] = $i['response'];
                }
            } elseif ($sections->testType == 3) {
                foreach ($itemm as $i) {
                    $answers[$i['prompt']][] = $i['response'];
                    $correct[$sectionctr][] = $i['response'];
                }
            }
        }

        $questions1 = $questions;
        $answers1 = $answers;
        $correct1 = $correct;

        if ($extra >= 1) {

            $sectionctr1 = 1;
            shuffle($arrayextra[$sectionctr1]);
            //print_r($extra);
            $itemm1 = array();
            for ($i = 0; $i < $extra; $i++) {
                $itemm1[] = $arrayextra[$sectionctr1][$i];
            }

            foreach ($itemm1 as $itemm2) {
                $questions1[$sectionctr1][] = array($itemm2);
            }

            if ($sections->testType == 1) {
                foreach ($itemm1 as $i) {
                    $try = array();
                    $choices = $this->test_m->getChoices($i['itemID']);

                    foreach ($choices as $key => $choice) {
                        array_push($try, $choice['choice']);
                        if ($key == 0) {
                            $correct1[$sectionctr1][] = $choice['choice'];
                        }
                    }

                    $answers1[$i['prompt']][] = $this->shuffle_assoc($try);
                }
            } elseif ($sections->testType == 2) {
                $tf = array();
                foreach ($itemm1 as $i) {
                    if ($i['response'] == 'True' || $i['response'] == 'true') {
                        $tf = array('True', 'False');
                    } else {
                        $tf = array('False', 'True');
                    }

                    $answers1[$i['prompt']][] = $tf;
                    $correct1[$sectionctr1][] = $i['response'];
                }
            } elseif ($sections->testType == 3) {
                foreach ($itemm1 as $i) {
                    $answers1[$i['prompt']][] = $i['response'];
                    $correct1[$sectionctr1][] = $i['response'];
                }
            }
        }


        
          $this->template->set('questions', $questions1)
                ->set('answers', (object) $answers1)
                ->set('sections', $sections)
                ->set('module', $moduledetails)
                ->build('admin/testBank/preview_SC');
        }
       public function checkDropVal(){//validation of login -> username
            
           $input = $this->input->post('modules');
           
           foreach($input as $key=>$a){
             
               $ctr = $key+1;
             
               for($x = $ctr; $x<=count($input)-1; $x++){
                   
                   if($x == count($input)){
                       
                   }else{
                      
                   
                        if($a == $input[$x]){
                            $this->form_validation->set_message('checkDropVal','The selected modules are the same'); //setting the message for the function form_validation
                            return false;
                        }else
                        {
                           
                        }
                   }
                  
               }

               
           }
            return true;
            
        }
        
        public function valid($value,$paramarray){
              
            list($moduleid, $modulename, $category, $testType) = explode(",",$paramarray);
              
              $modItemCount = $this->testbank_m->getItemCountCat($moduleid, $testType, $category);
          
            if (!is_numeric($value))
                {
                  $this->form_validation->set_message('valid',"Input is not numeric in ".$modulename);
                  return false;
                }
            
            if($value > $modItemCount ){
                $this->form_validation->set_message('valid',"Not enough items for module ".$modulename);
                 return false;
                
            }
            return true;
            //$this->form_validation->set_message('valid',$a); //setting the message for the function form_validation
                           
        }
        
         public function valid1($value,$paramarray){
              
            list($moduleid, $category, $testType) = explode(",",$paramarray);
              
              $modItemCount = $this->testbank_m->getItemCountCat($moduleid, $testType, $category);
          
            if (!is_numeric($value))
                {
                  $this->form_validation->set_message('valid',"Input is not numeric ");
                  return false;
                }
            
            if($value > $modItemCount ){
                $this->form_validation->set_message('valid',"Not enough items");
                 return false;
                
            }
            return true;
            //$this->form_validation->set_message('valid',$a); //setting the message for the function form_validation
                           
        }
}
