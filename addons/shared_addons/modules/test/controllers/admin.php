<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Admin extends Admin_Controller
{
	    protected $section = 'Items';

	public function __construct()
	{
		parent::__construct();
                
		// Load all the required classes
		$this->load->model('test_itembank_m');
		$this->load->library('form_validation');
		
                
                
		// Set the validation rules
		$this->item_validation_rules = array(
			array(
				'field' => 'name',
				'label' => 'Name',
				'rules' => 'trim|max_length[100]|required'
			),
			array(
				'field' => 'slug',
				'label' => 'Slug',
				'rules' => 'trim|max_length[100]|required'
			)
		);

		// We'll set the partials and metadata here since they're used everywhere
		$this->template->append_js('module::admin.js')
                         ->append_css('module::css3_breadcrumbs.css')
                        ->append_js('module::append_item.js')
                        //->append_js('module::hello.js')
                        ->append_js('module::viewResponse.js')
                        ->append_css('module::jquery.tablesorter.pager.css')
                         ->append_js('module::jquery.tablesorter.min.js')
                        ->append_js('module::jquery.tablesorter.pager.js')
                        ->append_js('module::items.js')
                        ->append_js('module::filter_dropdown.js')
                        ->append_js('module::flag.js')
                        
						->append_css('module::admin.css');
	}

	/**
	 * List all items
	 */
	public function index()
	{
		$modules = $this->test_itembank_m->getAllModules(); 
                
                $courses = $this->test_itembank_m->getAllCourses();
                
                $formoptions = array();
                $formoptions[0] = 'All';
                
                foreach($courses['entries'] as $course){
                    $formoptions[$course['id']] = $course['title'];
                }
                $itemcount = array();
                foreach($modules['entries'] as $m){
                    $itemcount[] = $this->test_itembank_m->getItemCount($m['id']);
                }
                
                
		$this->template
			->title($this->module_details['name'])
                        
			->append_js('jquery/jquery.cooki.js')
			->append_js('jquery/jquery.stickyscroll.js')
                        ->set('modulelist',$modules['entries'])
                        ->set('courselist', $formoptions)
                        ->set('itemcount',$itemcount)
			->build('admin/itemBank/index');
	}
        
        public function addItem($moduleid){
            
            //$moduleid = 87;//$this->input->get('module'); //this should be syllabus id
            $moduledetails = $this->test_itembank_m->getModuleDetails($moduleid);
            $formoptions = $this->test_itembank_m->getTestTypes();
            //$formopt = array('Select one');
            //array_push($formoptions,$formopt);
            
//             print_r($_SESSION['items']);
            $this->template
                    ->title('Add Test Items')
                    ->set('module', $moduleid)
                    ->set('moduledetails',$moduledetails)
                    ->set('dropdownvalues', $formoptions)
                    ->build('admin/itemBank/addItem');
            
        }
        
        public function addQA(){
          // print_r($_POST);
           $_SESSION['items'][$_POST['item'][7]] = $_POST;
        }
        
        public function saveItems($moduleid){
            $items = $_SESSION['items'];

//            item = new Array();
//            item[0] = input_question; // question
//            item[1] = select_itemtype; // item type e.g multiple choice 
//            item[2] = select_diff; // difficutly
//            item[3] = select_skill; // module 
//            item[4] = type; // item type text for display
//            item[5] = module; // module type text for display
//            item[6] = new Array(); // answers
            
            foreach($items as $item){
                $question = $item['item'][0];
                $testtype =  $item['item'][1];
                $difficulty =  $item['item'][2];
                $module =  $moduleid;
                $course = $this->test_itembank_m->getHid($this->test_itembank_m->getModuleParent($module));
                $category = $item['item'][8];
                if($testtype == 2){
                    foreach($item['item'][6] as $choices){
                         if($choices[1]== 'true'){
                             $answer = $choices[0];
                         }
                    }
                }elseif($testtype == 3){
                
                    $answer = $item['item'][6][0][0];
                }
                else{
                    $answer = null; 
                }
                
                $testid = $this->test_itembank_m->saveToItemBank($course, $module, $question, $answer, $testtype, $difficulty, $category);
                
                if($testtype == 1 || $testtype == 4){
                    
                    foreach($item['item'][6] as $choices){
                         if($choices[1]== 'true'){
                           $this->test_itembank_m->saveChoicesMC($testid, $choices[0],1,0); 
                         }
                         else{
                              $this->test_itembank_m->saveChoicesMC($testid, $choices[0],0,0); 
                         }
                    }
 
                }elseif($testtype == 5){
                    
                    // WEIGHTED HERE
                }
  
            }
            
             unset($_SESSION['items']);
             $this->session->set_flashdata('success','Successfully added items to itembank');
             redirect('admin/test');
            
        }
        
        
        public function viewResponses($itemtype){
            
            
           $this->load->view('admin/itemBank/ajax_response',array('itemtype' => $itemtype));
            
        }
         public function modal_viewResponses(){
             $index = $this->input->get('index');
             $type = $this->input->get('type');
             $responses = $_SESSION['items'][$index];
           //  print_r($index);
             $this->load->view('admin/itemBank/modal_viewResponses', array('item' => $responses,'index'=>$index, 'type' =>$type));
         }
         
         public function modal_viewResponses1($itemid){
             $item = $this->test_itembank_m->getItem($itemid);
             $choices = array();
             if($item->testType == 1){
                 $choices = $this->test_itembank_m->getChoices($itemid);
                 $options = array();
                 foreach($choices as $choice){
                     if ($choice['response'] == 0){
                       $val = 'false'; 
                        }
                        else{
                            $val = 'true';
                        }
                     $options[] = array
                            ( '0' =>$choice['choice'],
                              '1' => $val
                         );
                 }
                 $responses = array(
                     'item' => array(
                         '0' => $item->prompt,
                         '1' => $item->testType,
                         '6' => $options
                     )
                 );
             }
             elseif($item->testType == 2){
                 $choices = $this->test_itembank_m->getChoices($itemid);
                 $options = array();
                 
                 if($item->response == "True"){
                     $options[0] = array (
                         
                         '0' => 'True',
                        '1' => 'true');
                     
                     $options[1] = array (
                         
                         '0' => 'False',
                        '1' => 'false');
                     
                 }else{
                     $options[0] = array (
                         
                         '0' => 'True',
                        '1' => 'false');
                     
                     $options[1] = array (
                         
                         '0' => 'False',
                        '1' => 'true');
                 }
                 
                 $responses = array(
                     'item' => array(
                         '0' => $item->prompt,
                         '1' => $item->testType,
                         '6' => $options
                     )
                 );
             }elseif($item->testType == 3){
                 $choices = $this->test_itembank_m->getChoices($itemid);
                 $options[0] = array(
                     '0' => $item->response,
                     '1' => 'true'
                 );
                
                 
                 $responses = array(
                     'item' => array(
                         '0' => $item->prompt,
                         '1' => $item->testType,
                         '6' => $options 
                     )
                 );
             }
             

             $this->load->view('admin/itemBank/modal_viewResponses_items', array('item' => $responses, 'itemObj' => $item));
         }
         
         
         
         public function remove_item(){
             $id=$_POST['info'][0];
           unset($_SESSION['items'][$id]);
         }
         
         public function viewItems($moduleid){
             
             $moduledetails = $this->test_itembank_m->getModuleDetails($moduleid);
             
             $itemlist = $this->test_itembank_m->getAllItems($moduleid);
             $itemcount = $this->test_itembank_m->getItemCount($moduleid);
             
             //print_r($itemlist);
             $_SESSION['currentItemsview'] = $moduleid;
             
             $this->template
                     ->set('moduledetails', $moduledetails)
                     ->set('itemlist', $itemlist)
                     ->set('itemcount', $itemcount)
                     ->build('admin/itemBank/viewItems');
         }
         
         public function loadItemTable($courseid){
             $itemcount = array();
             if($courseid == 0){
                $module = $this->test_itembank_m->getAllModules(); 
                $modules = $module['entries'];
                
                foreach($modules as $m){
                    $itemcount[] = $this->test_itembank_m->getItemCount($m['id']);
                }
             }
             else{
                 $syllacourseid = $this->test_itembank_m->getSyllabusID($courseid);
                 $modules = $this->test_itembank_m->getModules($syllacourseid);
                 
                 foreach($modules as $m){
                    $itemcount[] = $this->test_itembank_m->getItemCount($m['id']);
                }
                 
             }
             
             $this->load->view('admin/itemBank/item_table', array('modulelist' => $modules, 'itemcount' => $itemcount));
         }
         
         public function flag_item($itemid){
             $this->test_itembank_m->flag_item($itemid);
             $this->session->set_flashdata('succes','Sucessfully flagged an item');
             redirect('admin/test/viewItems/'.$_SESSION['currentItemsview']);
             
         }
         
         public function unflag_item($itemid){
             $this->test_itembank_m->unflag_item($itemid);
             $this->session->set_flashdata('succes','Sucessfully unflagged an item');
             redirect('admin/test/viewItems/'.$_SESSION['currentItemsview']);
             
         }
         
         public function updateItems(){
             //print_r($_POST);
             $_SESSION['items'][$_POST['item'][0]]['item'][6] = $_POST['item'][2];
         }
         
         public function updateItem(){
             //print_r($_POST);
             $answer='';
             $item = $_POST;
             $itemid = $_POST['item'][0];
             $testtype = $_POST['item'][1];
             $question = $_POST['item'][3];
             $category = $_POST['item'][4];
             $difficulty = $_POST['item'][5];
              if($testtype == 2){
                    foreach($item['item'][2] as $choices){
                         if($choices[1]== 'true'){
                             $answer = $choices[0];       
                         }
                         
                            $this->test_itembank_m->updateItemBank($itemid,$answer,$question,$category,$difficulty);
                    }
                }elseif($testtype == 3){
                
                    $answer = $item['item'][2][0][0];
                    $this->test_itembank_m->updateItemBank($itemid,$answer,$question,$category,$difficulty);
                }
                else{
                    $answer = null; 
                }
                
                if($testtype == 1){
                    $this->test_itembank_m->updateItemBank($itemid,$answer,$question,$category,$difficulty);
                    $this->test_itembank_m->deletePrevChoices($itemid);
                foreach($item['item'][2] as $choices){
                         if($choices[1]== 'true'){
                           $this->test_itembank_m->saveChoicesMC($itemid, $choices[0],1,0); 
                         }
                         else{
                              $this->test_itembank_m->saveChoicesMC($itemid, $choices[0],0,0); 
                         }
                    }
                }
         }
         
         
        
}
