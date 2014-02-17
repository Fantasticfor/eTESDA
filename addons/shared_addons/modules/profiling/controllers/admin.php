<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a sample module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	Sample Module
 */
class Admin extends Admin_Controller
{
	protected $section = 'items';

	public function __construct()
	{
		parent::__construct();

		// Load all the required classes
		$this->load->model('admin_profiling_m');
		$this->load->library('form_validation');
		$this->lang->load('sample');

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
		$this->template
                        ->append_css('module::admin.css')
                          ->append_css('module::css3_breadcrumbs.css')
                        ->append_js('module::admin.js')
                        ->append_js('module::append_test.js')
                         ->append_js('module::jquery.metadata.js')
                        ->append_js('module::jquery.tablesorter.min.js')
                        ->append_js('module::jquery.tablesorter.pager.js')
                        ->append_js('module::append_item.js')
                        ->append_js('module::viewResponse.js')
                        ->append_js('module::items.js');
	}

	/**
	 * List all items
	 */
	public function index()
	{
	
            $interests = array();
            $interest = $this->admin_profiling_m->getAllInterest();
            
                foreach($interest as $i){
                    $i['itemcount'] = $this->admin_profiling_m->getItemCount($i['sectionID']);
                    $interests[] = $i;
                }
            
            $abilities = array();
            $ability = $this->admin_profiling_m->getAllAbility();
            
              foreach($ability as $a){
                    $a['itemcount'] = $this->admin_profiling_m->getItemCount($a['sectionID']);
                    $abilities[] = $a;
                }
                
              
		$this->template
			->title($this->module_details['name'])
			->set('interests',$interests)
                        ->set('abilities', $abilities)
                        ->append_js('jquery/jquery.ui.nestedSortable.js')
			->append_js('jquery/jquery.cooki.js')
			->append_js('jquery/jquery.stickyscroll.js')
			->build('admin/itemBank/index');
	}

	public function addItem_Interest($sectionid){
            //unset($_SESSION['iitems']);
            $name = $this->admin_profiling_m->getSectionName($sectionid);
            
           
            $this->template
                    ->title('Add Item to Interests bank')
                    ->set('sectionid',$sectionid)
                    ->set('name', $name)
                    ->build('admin/itemBank/addItem_Interest');
            
        }
        
        public function addItemI(){
            //print_r($_POST['interest']);
            $_SESSION['iitems'][$_POST['interest'][0]] = $_POST['interest'];
        }
        
        public function removeItemI(){
            $id=$_POST['info'][0];
           unset($_SESSION['iitems'][$id]);
        }
        
        public function saveInterestItems($secid){
             $items = $_SESSION['iitems'];
             
             //1 = question 2 = //options
             foreach($items as $item){
                 $question = $item[1];
                 
                 foreach($item[2] as $choices){
                         if($choices[1]== 'true'){
                             $answer = $choices[0];
                         }
                    }
                    
                    $this->admin_profiling_m->addToItemBank($secid,$question,$answer,2);
                 
             }
             
             unset($_SESSION['iitems']);
             $this->session->set_flashdata('success','Added an Interest Item!');
             redirect('admin/profiling');
        }
        
        
        
        public function addItemA(){
            //print_r($_POST['ability']);
            $_SESSION['aitems'][$_POST['ability'][0]] = $_POST['ability'];
        }
        
        public function removeItemA(){
            $id=$_POST['info1'][0];
           // print_r($_SESSION['aitems']);
           unset($_SESSION['aitems'][$id]);
        }
        
        public function saveAbilityItems($secid){
            $items = $_SESSION['aitems'];
            
            foreach($items as $item){
                 $question = $item[1];
                 $answer = NULL;
                 $testid = $this->admin_profiling_m->addToItemBank($secid,$question,$answer,1);
                 
               
                    
                    foreach($item[2] as $choices){
                         if($choices[1]== 'true'){
                           $this->admin_profiling_m->saveChoicesMC($testid, $choices[0],1); 
                         }
                         else{
                              $this->admin_profiling_m->saveChoicesMC($testid, $choices[0],0); 
                         }
                    }
                 
                 
             }
             
             unset($_SESSION['aitems']);
             $this->session->set_flashdata('success','Added an Ability Item!');
             redirect('admin/profiling');
        }
        
        public function addItem_Ability($sectionid){
            //unset($_SESSION['aitems']);
            $name = $this->admin_profiling_m->getSectionName($sectionid);
             
            $this->template
                    ->title('Add Item to Abilities bank')
                    ->set('sectionid',$sectionid)
                     ->set('name', $name)
                    ->build('admin/itemBank/addItem_Ability');
            
        }
        public function viewItem($sectionid){
            $_SESSION['currecntsectionview'] = $sectionid;
            $secdet = $this->admin_profiling_m->getSecDet($sectionid);
            
            $items =  $this->admin_profiling_m->getAllItems($sectionid);
            $icount = $this->admin_profiling_m->getItemCount($sectionid);
            
            $this->template
                    ->set('sectiondet', $secdet)
                    ->set('secid',$sectionid)
                    ->set('items', $items)
                    ->set('count', $icount)
                    ->build('admin/itemBank/viewItems');
            
        }
        public function viewResponses(){
           $this->load->view('admin/itemBank/ajax_response');
            
        }
         public function modal_viewResponses($itemid){
             
              $item = $this->admin_profiling_m->getItem($itemid);
             
            
                 $choices = $this->admin_profiling_m->getChoices($itemid);
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
                         '1' => $item->prompt,
                         '2' => $options
                     )
                 );
             
             
             $this->load->view('admin/itemBank/modal_viewResponses',array('item' => $responses));
         }
         
         public function modal_viewResponses1($index){
             $responses['item'] = $_SESSION['aitems'][$index];
            
             
             $this->load->view('admin/itemBank/modal_viewResponses',array('item' => $responses));
         }
         
         public function removeItem($itemid){
             $this->admin_profiling_m->removeItem($itemid);
              $this->session->set_flashdata('error','Removed an item');
             redirect('admin/profiling/viewItem/'.$_SESSION['currecntsectionview']);
         }
}
