<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a sample module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	Sample Module
 */
class Admin_itemBank extends Admin_Controller
{
            protected $section = 'Items';

	public function __construct()
	{
		parent::__construct();

		// Load all the required classes
		$this->load->model('sample_m');
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
		$this->template
                        ->append_css('module::admin.css')
                         ->append_css('module::css3_breadcrumbs.css')
                        ->append_js('module::admin.js')
                        ->append_js('module::jquery.metadata.js')
                        ->append_js('module::jquery.tablesorter.min.js')
                        ->append_js('module::jquery.tablesorter.pager.js')
                        ->append_js('module::items.js')
                        ->append_js('module::viewResponse.js')
                        ->append_js('module::append_item.js');
						
	}

	/**
	 * List all items
	 */
	public function index()
	{
		// here we use MY_Model's get_all() method to fetch everything
		$items = $this->sample_m->get_all();

		// Build the view with sample/views/admin/items.php
                
		$this->template
			->title($this->module_details['name'])
			->set('items', $items)
                         ->append_js('jquery/jquery.ui.nestedSortable.js')
			->append_js('jquery/jquery.cooki.js')
			->append_js('jquery/jquery.stickyscroll.js')
                      
			->build('admin/itemBank/index');
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
        
        public function addItem_Interest(){
            
            $this->template->build('admin/itemBank/addItem_Interest');
            
        }
        public function addItem_Ability(){
            
            $this->template->build('admin/itemBank/addItem_Ability');
            
        }
        public function viewItem(){
            
            $this->template->build('admin/itemBank/viewItems');
            
        }
        public function viewResponses(){
           $this->load->view('admin/itemBank/ajax_response');
            
        }
         public function modal_viewResponses(){
             
             $this->load->view('admin/itemBank/modal_viewResponses');
         }
        
        
}
