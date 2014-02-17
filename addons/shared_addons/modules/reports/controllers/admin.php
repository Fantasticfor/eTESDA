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
		//$this->load->model('sample_m');
               
		$this->load->library('form_validation');
		$this->lang->load('syllabus');
                $this->lang->load('topic');
         
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
                $this->template
                         ->append_css('module::admin.css')
                         ->append_css('module::css3_breadcrumbs.css')
                        
                       
                 ->append_js('jquery/jquery.ui.nestedSortable.js')
			->append_js('jquery/jquery.cooki.js')
			->append_js('jquery/jquery.stickyscroll.js')
                          ->append_css('module::index.css')
                ->append_js('module::admin.js')
               ->append_js('module::generate_report.js')
                
                ->append_js('module::highcharts.js');
                        
               
		
		
	}

	/**
	 * List all items
	 */
	public function index()
	{
		// here we use MY_Model's get_all() method to fetch everything
		//$items = $this->sample_m->get_all();

		// Build the view with sample/views/admin/items.php
              
            
		$this->template
			->title($this->module_details['name'])
			//->set('items', $items)
                      
                       
                      
			->build('admin/index');
	}

	public function create()
	{
		// Set the validation rules from the array above
		$this->form_validation->set_rules($this->item_validation_rules);

		// check if the form validation passed
		if ($this->form_validation->run())
		{
			// See if the model can create the record
			if ($this->sample_m->create($this->input->post()))
			{
				// All good...
				$this->session->set_flashdata('success', lang('sample.success'));
				redirect('admin/sample');
			}
			// Something went wrong. Show them an error
			else
			{
				$this->session->set_flashdata('error', lang('sample.error'));
				redirect('admin/sample/create');
			}
		}
		
		$sample = new stdClass;
		foreach ($this->item_validation_rules as $rule)
		{
			$sample->{$rule['field']} = $this->input->post($rule['field']);
		}

		// Build the view using sample/views/admin/form.php
		$this->template
			->title($this->module_details['name'], lang('sample.new_item'))
			->set('sample', $sample)
			->build('admin/form');
	}
	
	public function edit($id = 0)
	{
		$sample = $this->sample_m->get($id);

		// Set the validation rules from the array above
		$this->form_validation->set_rules($this->item_validation_rules);

		// check if the form validation passed
		if ($this->form_validation->run())
		{
			// get rid of the btnAction item that tells us which button was clicked.
			// If we don't unset it MY_Model will try to insert it
			unset($_POST['btnAction']);
			
			// See if the model can create the record
			if ($this->sample_m->update($id, $this->input->post()))
			{
				// All good...
				$this->session->set_flashdata('success', lang('sample.success'));
				redirect('admin/sample');
			}
			// Something went wrong. Show them an error
			else
			{
				$this->session->set_flashdata('error', lang('sample.error'));
				redirect('admin/sample/create');
			}
		}

		// Build the view using sample/views/admin/form.php
		$this->template
			->title($this->module_details['name'], lang('sample.edit'))
			->build('admin/form');
	}
	
	public function delete($id = 0)
	{
		// make sure the button was clicked and that there is an array of ids
		if (isset($_POST['btnAction']) AND is_array($_POST['action_to']))
		{
			// pass the ids and let MY_Model delete the items
			$this->sample_m->delete_many($this->input->post('action_to'));
		}
		elseif (is_numeric($id))
		{
			// they just clicked the link so we'll delete that one
			$this->sample_m->delete($id);
		}
		redirect('admin/sample');
	}
        
        
       public function courseStat(){
           $this->template->build('admin/courseStat');
           
           
       }
       public function learnerList(){
           $this->template->build('admin/learnerList');
           
           
       }
       public function learnerProfile(){
           $this->template->build('admin/learnerProfile');
           
           
       }
       public function testStat(){
           $this->template->build('admin/testStatistics');
           
           
       }
       
       public function testList(){
           $this->template->build('admin/testList');
           
           
       }
       public function load_indexTable(){
           $this->load->view('admin/load_indexTable');
           
           
       }
       public function thayne(){
           
           return '<html> <h1>Hello world </h1></html>';
           
       }
   
        public function pdf_report(){
 $this->load->helper(array('My_Pdf'));   //  Load helper
$data =$this->thayne(); // Pass the url of html report
//$data= '<html> <h1>Hello world </h1></html>';
 create_pdf($data); //Create pdf
 }
        public function load_report(){
            $this->load->model('sample_m');
            $this->load->model('learner/model_users');
            $this->load->model('syllabus/getSectors');
            
            $ySelected = $this->input->get('year');
            $rSelected = $this->input->get('report');
            $mSelected = $this->input->get('month');
            $counter = 1;
            
            $enrollee = $this->sample_m->enrolleeRep($mSelected, $ySelected);
            $lName = array();
            foreach($enrollee as $en){
                $lName[$counter] []= $this->model_users->learnerInfo($en['learnerID']);
                $counter += 1;
            }
            
            $cIDs = $this->sample_m->enCount($mSelected, $ySelected);
            $sectCounts = array();
            //print_r($cIDs);
            $sectName = $this->sample_m->enCount($mSelected, $ySelected);
            $sCount = 1;
            foreach($sectName as $sn){
                $sectCounts[$sCount] []= $this->sample_m->secCount($mSelected, $ySelected, $sn['ID']);
                $sCount += 1;
            }
            
            //print_r($sectCounts);    
            
            $monthName = date("F", mktime(0, 0, 0, $mSelected, 10));
            
            $lEnd = $this->sample_m->lEndorse($mSelected, $ySelected);
            $endC = 1; 
            $cEnd = array();
            foreach($lEnd as $le){
                $cEnd[$endC] []= $this->model_users->learnerInfo($le['learnerID']);
                $endC += 1;
            }
            
            $this->load->view('admin/load_report', array('report'=>$rSelected, 'monthName'=>$monthName , 'yearN'=>$ySelected,'enrollee'=>$enrollee, 'lName'=>$lName, 'counts'=>$cIDs, 'sectName'=>$sectName, 'sectCounts' => $sectCounts,'lEnd'=>$lEnd,  'cEnd'=>$cEnd ));
 }
       

        
     
        
   
        
       
}
