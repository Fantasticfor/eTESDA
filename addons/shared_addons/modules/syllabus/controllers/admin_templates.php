<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Admin_templates extends Admin_Controller
{
   
    protected $section = 'template';
    
    private $validation_rules = array(
		array(
			'field' => 'title',
			'label' => 'lang:global:title',
			'rules' => 'trim|required|max_length[60]'
		),
		array(
			'field' => 'slug',
			'label' => 'lang:global:slug',
			'rules' => 'trim|required|alpha_dot_dash|max_length[60]|callback__check_pt_slug'
		),
        array(
             'field' => 'description',
             'label' => 'lang:global:description',
             'rules' => 'trim'
        ),
		array(
			'field' => 'body',
			'label' => 'lang:page_types.body_label',
			'rules' => 'trim|required'
		),
	);

    public function __construct()
    {
        parent::__construct();

       $this->lang->load('syllabus');
        $this->load->model('topic_types_m');
        
        $this->load->library('form_validation');

		$this->load->driver('Streams');
        
    }

   
    public function index()
    {
       $this->template->page_types = $this->topic_types_m->get_all();
       
       $this->template
			->title($this->module_details['name'], lang('pages:type_id_label'))
			->build('admin/types/index');
      
    }
    
    public function create()
	{
		role_or_die('pages', 'create_types');

		// Set the validation rules
		$this->form_validation->set_rules($this->validation_rules);

		// Set page_type_m so we can use the page_type_m
		// validation callbacks
		$this->form_validation->set_model('topic_types_m');

		$data = new stdClass();
		$data->page_type = new stdClass();

		if ($this->form_validation->run())
		{
			$input = $this->input->post();

			// they're using an existing stream or we autocreate a slug
			
				$stream_slug = url_title($input['title'], '_', true);

				// check to see if they want us to make a table and then see if we can
				if ( ! $stream_slug and $this->db->table_exists($stream_slug))
				{
					$this->session->set_flashdata('notice', lang('page_types:already_exist_error'));
					redirect('admin/syllabus/templates/create');
				}
				else
				{
					// nope, no table conflicts so let's create the stream
                                $stream_slug = url_title($input['title'], '_', true);
				$original_stream_slug = $stream_slug;
				$count = 2;
				while ($this->streams->streams->check_table_exists($stream_slug, 'topics_'))
				{
					$stream_slug = $original_stream_slug.'_'.$count;
					$count++;
				}

				$input['stream_id'] = $this->streams->streams->add_stream(lang('page_types:list_title_sing').' '.$input['title'], $stream_slug, 'topics', 'topics_');
				}
			

			 $this->load->helper('date');

      

			// Insert the page type
			$id = $this->topic_types_m->insert(array(
				'title' 			=> $input['title'],
				'slug'				=> $input['slug'],
				'description'       => $input['description'],
				'stream_id' 		=> $input['stream_id'],
				'updated_on' => now(),
				'body' 				=> ($input['body'] ? $input['body'] : false),
				
			));
                        

			// Success or fail?
			if ($id > 0)
			{
				// Should we create some files?
				

				$this->session->set_flashdata('success', lang('page_types:create_success'));

				

				// Event: page_type_created
				Events::trigger('page_type_created', $id);

				if ($this->input->post('stream_id') == 'new')
				{
					$this->session->set_flashdata('success', lang('page_types:create_success_add_fields'));

					// send them off to create their first fields
					redirect('admin/syllabus/templates/fields/' . $id);
				}
			}
			else
			{
				$this->session->set_flashdata('notice', 'Error'.$id);
			}

			redirect('admin/syllabus/templates/');
		}

		// Loop through each validation rule
		foreach ($this->validation_rules as $rule)
		{
			$data->page_type->{$rule['field']} = set_value($rule['field']);
		}

		// Extra one for the "save as files" checkbox.
		

		// Streams dropdown data.
		

		// Theme layouts dropdown data.
		

		// Load WYSIWYG editor
		$this->template
			->title($this->module_details['name'], lang('pages:type_id_label'), lang('page_types:create_title'))
			->append_js('module::page_type_form.js')
			->build('admin/types/form', $data);
	}
        private function _check_page_type($segment = 5)
	{
		if ( ! $page_type_id = $this->uri->segment($segment)) show_404();

		// Get the page type.
		$page_type = $this->db->limit(1)->where('id', $page_type_id)->get('topic_types')->row();

		if ( ! $page_type) show_404();

		return $page_type;
	}
        
        public function fields()
	{
		$page_type = $this->_check_page_type();

		// Get the stream that we are using for this page type.
		$stream = $this->db->limit(1)->where('id', $page_type->stream_id)->get('data_streams')->row();

		$this->load->driver('Streams');

		// If we are adding a field, show the field form.
		if ($this->uri->segment(6) == 'new_field')
		{
			return $this->_new_field($stream, $page_type);
		}
		elseif ($this->uri->segment(6) == 'edit_field')
		{
			return $this->_edit_field($stream, $page_type);
		}
		elseif ($this->uri->segment(6) == 'delete_field')
		{
			return $this->_delete_field($stream);
		}

		$extra = array(
			'add_uri'		=> 'adminfields/'.$page_type->id.'/new_field',
			'title'			=> $stream->stream_name.' '.lang('global:fields')
		);

		// Our buttons.
		$extra['buttons'] = array(
			array(
				'label'     => lang('global:edit'),
				'url'       => 'admin/syllabus/templates/fields/'.$this->uri->segment(5).'/edit_field/-assign_id-'
			),
			array(
				'label'     => lang('global:delete'),
				'url'       => 'admin/syllabus/templates/fields/'.$this->uri->segment(5).'/delete_field/-assign_id-',
				'confirm'   => true,
			)
		);

                //print_r($stream);
		// Show our fields list.
		$this->streams->cp->assignments_table($stream->stream_slug, $stream->stream_namespace, Settings::get('records_per_page'), 'admin/syllabus/templates/fields/'.$page_type->id, true, $extra);
	}
        
        private function _new_field($stream, $page_type)
	{
		$extra = array(
			'title'				 => $stream->stream_name.' : '.lang('streams:new_field'),
			'success_message' 		 => lang('page_types:success_add_tag'),
			'cancel_uri'			 => 'admin/syllabus/templates/fields/'.$page_type->id,
			'allow_title_column_set' => true
		);

		$this->streams->cp->field_form($stream->stream_slug, $stream->stream_namespace, 'new', 'admin/syllabus/templates/fields/'.$this->uri->segment(5), null, array(), true, $extra, array('chunks'));
	}

	// --------------------------------------------------------------------------

	/**
	 * Edit Fields for a certain page type.
	 *
	 */
	private function _edit_field($stream, $page_type)
	{
		$extra = array(
			'title'						=> $stream->stream_name.' : '.lang('streams:edit_field'),
			'success_message' 			=> lang('page_types:success_add_tag'),
			'cancel_uri'				=> 'admin/syllabus/templatesfields/'.$page_type->id,
			'allow_title_column_set' 	=> true
		);

		$this->streams->cp->field_form($stream->stream_slug, $stream->stream_namespace, 'edit', 'admin/syllabus/templates/fields/'.$this->uri->segment(5), $this->uri->segment(7), array(), true, $extra, array('chunks'));
	}

	// --------------------------------------------------------------------------

	/**
	 * Edit Fields for a certain page type.
	 *
	 */
	private function _delete_field($stream)
	{
		$this->streams->cp->teardown_assignment_field($this->uri->segment(7));

		redirect('admin/syllabus/templates/fields/'.$this->uri->segment(5));
	}

   public function edit($id = 0)
	{
		

		// Unset validation rules of required fields that are not included in the edit form
		unset($this->validation_rules[1]);

		// Set the validation rules
		$this->form_validation->set_rules($this->validation_rules);

		$data = new stdClass();
		empty($id) AND redirect('admin/syllabus/templates');

		// We use this controller property for a validation callback later on
		$this->page_type_id = $id;

		// Set data, if it exists
		if ( ! $data->page_type = $this->topic_types_m->get($id))
		{
			$this->session->set_flashdata('error', 'Page not found');
			redirect('admin/syllabus/templates/create');
		}

		// Give validation a try, who knows, it just might work!
		if ($this->form_validation->run())
		{
			$input = $this->input->post();

			// Run the update code with the POST data
			$this->topic_types_m->update($id, array(
				'title' 			=> $input['title'],
				'description'       => $input['description'],
                            'body' 				=> ($input['body'] ? $input['body'] : false),
				
			));

			// Wipe cache for this model as the data has changed
			

			$this->session->set_flashdata('success', sprintf('Edit Successful', $this->input->post('title')));

			$input['slug'] = $data->page_type->slug;
			

			

			$this->input->post('btnAction') == 'save_exit'
				? redirect('admin/syllabus/templates')
				: redirect('admin/syllabus/templates/edit/'.$id);
		}

		// Loop through each validation rule
		foreach ($this->validation_rules as $rule)
		{
			if ($this->input->post($rule['field']))
			{
				$data->page_type->{$rule['field']} = set_value($rule['field']);
			}
		}

		// Save as files.
		//$data->page_type->save_as_files = ($data->page_type->save_as_files == 'y' or $this->input->post('save_as_files') == 'y') ? 'y' : false;

		//$theme_layouts = $this->template->get_theme_layouts(Settings::get('default_theme'));
		//$data->theme_layouts = array();
		//foreach ($theme_layouts as $theme_layout)
		//{
		//	$data->theme_layouts[$theme_layout] = basename($theme_layout, '.html');
		//}

		$this->template
			->title($this->module_details['name'], lang('pages:type_id_label'), sprintf(lang('page_types:edit_title'), $data->page_type->title))
			->append_js('module::page_type_form.js')
			->build('admin/types/form', $data);
	}

}