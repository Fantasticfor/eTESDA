<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a sample module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	Sample Module
 */
class Admin_testBank extends Admin_Controller
{
	

	public function __construct()
	{
		parent::__construct();

		// Load all the required classes
		
		$this->load->library('form_validation');
		$this->load->model('admin_profiling_m');
                
                
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
                         ->append_js('module::test.js')
                        ->append_js('module::course.js')
                        ->append_js('module::module.js')
                        ->append_js('module::lesson.js')
                      ->append_css('module::css3_breadcrumbs.css')
                        ->append_js('module::admin.js')
                        ->append_js('module::append_test.js')
                        ->append_js('module::testItems.js')
                        ->append_css('module::admin.css')
                        ->append_js('module::jquery.metadata.js')
                        ->append_js('module::jquery.tablesorter.min.js')
                        ->append_js('module::jquery.tablesorter.pager.js')
                        ->append_js('module::items.js')
                        ->append_js('module::viewResponse.js')
                        ->append_js('module::append_item.js');
	}

	
	public function index()
	{
		 $interests = array();
            $interest = $this->admin_profiling_m->getAllInterest();
            
                
            
            $abilities = array();
            $ability = $this->admin_profiling_m->getAllAbility();
            
              
		$this->template
			->title($this->module_details['name'])
			//>set('items', $items)
                        ->set('ability',$ability)
                        ->set('interest',$interest)
                         ->append_js('jquery/jquery.ui.nestedSortable.js')
			->append_js('jquery/jquery.cooki.js')
			->append_js('jquery/jquery.stickyscroll.js')
                      
			->build('admin/testBank/index');
	}

        
        public function addTest(){
            
            $this->template
                  ->build('admin/testBank/addTest');
            
        }
        public function test_addItems(){
            
            $this->template
                  ->build('admin/testBank/test_addItem');
            
        }
        
         public function viewTest(){
             $this->template->build('admin/testBank/viewTest');
             
         }
 
          public function addItem(){
            
            $this->template->build('admin/testBank/addItem');
            
        }
          public function editTest($secid){
            
              $this->form_validation->set_rules('noItems','no. of items','required|numeric|trim');
              
              if($this->form_validation->run()){
                  $noItems = $this->input->post('noItems');
                  $this->admin_profiling_m->editSection($secid,$noItems);
                  $this->session->set_flashdata('success','Saved!');
                  redirect('admin/profiling/testBank');
              }
              
            $this->load->view('admin/testBank/editTest',array('secid'=>$secid));
            
        }
         public function CreateSelfCheck(){
             
             $this->template->build('admin/testBank/selfCheckForm');
         }
}
