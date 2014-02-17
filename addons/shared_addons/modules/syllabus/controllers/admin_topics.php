<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Admin_topics extends Admin_Controller
{
   
    protected $section = 'topic';


    public function __construct()
    {
        parent::__construct();

       $this->lang->load('syllabus');
        $this->load->model('topics_m');
        $this->load->driver('Streams');
        
        
    }

    public function index()
    {
       
        $base_where = array('show_future' => true, 'status' => 'draft');
        
        $blog = $this->topics_m
			->get_many_by($base_where);
        
        $coursetitle = array();
        foreach($blog as $a){
        $courses = $this->topics_m->getCourses($a->parent);
       // echo print_r($courses);
        $coursetitle []= $courses;
        }
         
       
                //print_r($blog);
        $this->template
               ->title($this->module_details['name'])
                ->append_js('module::admin.js')
		->append_css('module::admin.css')
                ->set('title', $coursetitle)
                ->set('blog', $blog)
                ->build('admin/topics/index');
    }
    
    public function choose_type()
	{
		// Get our types.
		$this->load->model('topic_types_m');

		$all = $this->topic_types_m->get_all();

		// Do we have a parent ID?
		$parent = ($this->input->get('parent')) ? '&parent='.$this->input->get('parent') : null;
                $parent_id = $this->input->get('parent');
        $this->template->set('parent_id', $parent_id);
        // Who needs a menu when there is only one option?
        if (count($all) === 1) 
        {
           // redirect('admin/pages/create?page_type='.$all[0]->id.$parent);
        }

        // Directly output the menu if it's for the modal.
        // All we need is the <ul>.
        if ($this->input->get('modal') === 'true') 
        {
            $html  = '<h4>'.lang('pages:choose_type_title').'</h4>';
    		$html .= '<ul class="modal_select">';
    		
    		foreach ($all as $pt)
    		{
    			$html .= '<li><a href="'.site_url('admin/syllabus/topics/create?page_type='.$pt->id.$parent).'"><strong>'.$pt->title.'</strong>';

    			if (trim($pt->description))
    			{
    				$html .= ' | '.$pt->description;
    			}

    			$html .= '</a></li>';
    		}
    		
    		echo $html .= '</ul>';
            return;
        }
        
        // If this is not being displayed in the modal, we can
        // display an entire page.
        $this->template
            ->set('parent', $parent)
            ->set('page_types', $all)
            ->build('admin/choosetype');
	}
    
    public function create()
	{
		$page = new stdClass;
                //$parentID pinalitan ko ng templat_eID
		// Parent ID
		//$template_id = ($this->input->get('template')) ? $this->input->get('template') : false;
		//$this->template->set('parent_id', $template_id);
    $parent_id = $this->input->get('parent');
        $this->template->set('parent_id', $parent_id);
        // What type of page are we creating?
        $template_id = $this->input->get('page_type');
        //print_r($template_id);
        // Redirect to the page type selection menu if no page type was specified 
        if ( ! $template_id) 
        {
            redirect('admin/syllabus/topics/choose_type');
        }
        
        // Get page type
        $page_type = $this->db->limit(1)->where('id', $template_id)->get('topic_types')->row();        

		if ( ! $page_type) show_error('No page type found.');

		$stream = $this->_setup_stream_fields($page_type);

		// Run our validation. At this point, this is running the
		// compiled validation for both stream and standard.
		if ($this->form_validation->run())
		{
			$input = $this->input->post();
                       
			// do they have permission to proceed?
			if ($input['status'] == 'live')
			{
				role_or_die('pages', 'put_live');
			}

			// We need to manually add this since we don't allow
			// users to change it in the page form.
			$input['type_id'] = $template_id;

			// Insert the page data, along with
			// the stream data.
			if ($id = $this->topics_m->create($input, $stream))
			{
				$this->load->model('syllabus_m');
                                $this->syllabus_m->addTopicSyllabus($id,$this->input->post('dropdown'));
				$this->session->set_flashdata('success', lang('pages:create_success'));

				// Redirect back to the form or main page
				$input['btnAction'] == 'save_exit'
					? redirect('admin/syllabus/topics')
					: redirect('admin/syllabus/topics');
			}
		}

		// Loop through each rule for the standard page fields and 
		// set our current value for the form.
		foreach ($this->page_m->fields() as $field)
		{
			switch ($field)
			{
				case 'restricted_to[]':
					$page->restricted_to = set_value($field, array('0'));
					break;
				
				case 'navigation_group_id[]':
					$page->navigation_group_id = $this->input->post('navigation_group_id');
					break;

				case 'strict_uri':
					$page->strict_uri = set_value($field, true);
					break;

				default:
					$page->{$field} = set_value($field);
					break;
			}
		}

		// Go through our stream fields and set the current value 
		// for the form. Since we are creating a new form, this should
		// simply be the post data if it is available.
		$assignments = $this->streams->streams->get_assignments($stream->stream_slug, $stream->stream_namespace);
		$page_content_data = array();

		if ($assignments)
		{
			foreach ($assignments as $assign)
			{
				$page_content_data[$assign->field_slug] = $this->input->post($assign->field_slug);
			}
		}

		$stream_fields = $this->streams_m->get_stream_fields($this->streams_m->get_stream_id_from_slug($stream->stream_slug, $stream->stream_namespace));

		// Set Values
		$values = $this->fields->set_values($stream_fields, null, 'new');

		// Run stream field events
		$this->fields->run_field_events($stream_fields, array(), $values);

		$parent_page = new stdClass;

		// If a parent id was passed, fetch the parent details
		/*if ($parent_id > 0)
		{
			$page->parent_id = $parent_id;
			$parent_page = $this->page_m->get($parent_id);
		}*/

		// Set some data that both create and edit forms will need
		$this->_form_data();
                $this->load->model('syllabus_m');
                 $query = $this->syllabus_m->getLessonsDropdown();
		// Load WYSIWYG editor
		$this->template
			->title($this->module_details['name'], lang('pages:create_title'))
			->append_metadata($this->load->view('fragments/wysiwyg', array(), true))
			->set('page', $page)
			->set('stream_fields', $this->streams->fields->get_stream_fields($stream->stream_slug, $stream->stream_namespace, $values))
			->set('page_type', $page_type)
                        ->set('item2', $query)
			->build('admin/topics/form');
	}
        
        public function edit($id = 0)
	{
		// We are lost without an id. Redirect to the pages index.
		$id or redirect('admin/syllabus/topics');

		$this->template->set('parent_id', null);

		// The user needs to be able to edit pages.
		role_or_die('pages', 'edit_live');

		// This is a temporary global until the page chunk field type is removed
		ci()->page_id = $id;

		// Retrieve the page data along with its data as part of the array.
		//$page = //$this->page_m->get($id);
                $page = $this->topics_m->get($id);
               
		// Got page?
		if ( ! $page or empty($page))
		{
			// Maybe you would like to create one?
			$this->session->set_flashdata('error',' Page not found');
			redirect('admin/syllabus/topics/');
		}

		// Note: we don't need to get the page type
		// from the URL since it is present in the $page data

		// Get the page type.
		$page_type = $this->db->limit(1)->where('id', $page->type_id)->get('topic_types')->row();

		if ( ! $page_type) show_error('No page type found.');

		$stream = $this->_setup_stream_fields($page_type, 'edit', $page->entry_id);

		

		// Turn the CSV list back to an array
		//$page->restricted_to = explode(',', $page->restricted_to);

		// Did they even submit?
		if ($this->form_validation->run())
		{
			$input = $this->input->post();

			// do they have permission to proceed?
			if ($input['status'] == 'live')
			{
				role_or_die('pages', 'put_live');
			}

			// Were there keywords before this update?
			

			// We need to manually add this since we don't allow
			// users to change it in the page form.
			$input['type_id'] = $page->type_id;

			// validate and insert
			if ($this->topics_m->edit($id, $input, $stream, $page->entry_id))
			{
				$this->session->set_flashdata('success', sprintf('Edit successful', $input['title']));
                                 $this->load->model('syllabus_m');
                $query = $this->syllabus_m->getLessonsDropdown();
                              
                                $this->topics_m->updateParent($page->id,$this->input->post('dropdown'));
				
 //redirect('admin/syllabus/topics/'.$id
				

				// Mission accomplished!
				$input['btnAction'] == 'save_exit'
					? redirect('admin/syllabus/topics')
					: redirect('admin/syllabus/topics/'.$id);
			}
		}

		// Loop through each validation rule
		foreach ($this->topics_m->validate as $field)
		{
			$field = $field['field'];

			// Nothing to do for the navigation field
			if (in_array($field, array('navigation_group_id[]')))
			{
				continue;
			}

			// Translate the data of restricted_to to something we can use in the form.
			/*if ($field === 'restricted_to[]')
			{
				$page->restricted_to = set_value($field, $page->restricted_to);
				$page->restricted_to[0] = ($page->restricted_to[0] == '') ? '0' : $page->restricted_to[0];
				continue;
			}*/

			// Set all the other fields
			$page->{$field} = set_value($field, $page->{$field});
		}

		// Go through our stream fields and set the current value 
		// for the form. Since we are creating a new form, this should
		// simply be the post data if it is available.

		$assignments = $this->streams->streams->get_assignments($stream->stream_slug, $stream->stream_namespace);
		$page_content_data = array();

		// Get straight raw from the db
		$page_stream_entry_raw = $this->db->limit(1)->where('id', $page->entry_id)->get($stream->stream_prefix.$stream->stream_slug)->row();

		if ($assignments)
		{
			foreach ($assignments as $assign)
			{
				$from_db = isset($page_stream_entry_raw->{$assign->field_slug}) ? $page_stream_entry_raw->{$assign->field_slug} : null;

				$page_content_data[$assign->field_slug] = isset($_POST[$assign->field_slug]) ? $_POST[$assign->field_slug] : $from_db;
			}	
		}

		$stream_fields = $this->streams_m->get_stream_fields($this->streams_m->get_stream_id_from_slug($stream->stream_slug, $stream->stream_namespace));

		// Set Values
		$values = $this->fields->set_values($stream_fields, $page_stream_entry_raw, 'edit');

		// Run stream field events
		$this->fields->run_field_events($stream_fields, array(), $values);

		// If this page has a parent.
		if ($page->parent_id > 0)
		{
			// Get only the details for the parent, no data.
			$parent_page = $this->page_m->get($page->parent_id, false);
		}
		else
		{
			$parent_page = false;
		}

		$this->_form_data();
                $this->load->model('syllabus_m');
                $query = $this->syllabus_m->getLessonsDropdown();
		$this->template
			->title($this->module_details['name'], sprintf(lang('pages:edit_title'), $page->title))
			->append_metadata($this->load->view('fragments/wysiwyg', array() , true))
			->append_css('module::page-edit.css')
			->set('stream_fields', $this->streams->fields->get_stream_fields($stream->stream_slug, $stream->stream_namespace, $values, $page->entry_id))
			->set('page', $page)
			->set('parent_page', $parent_page)
			->set('page_type', $page_type)
                        ->set('item2',$query)
			->build('admin/topics/form');
	}
        
        private function _setup_stream_fields($page_type, $method = 'new', $id = null)
	{
		// Get the stream that we are using for this page type.
		$stream = $this->db->limit(1)->where('id', $page_type->stream_id)->get('data_streams')->row();
                
		$this->load->driver('Streams');
		$this->load->library('Form_validation');

		// So we can use the callbacks in page_m
		$this->load->model('topics_m');
                $this->form_validation->set_model('topics_m');
                
		// If we have renamed the title, then we need to change that in the validation array
		if ($page_type->title)
		{
			foreach ($this->topics_m->validate as $k => $v)
			{
				if ($v['field'] == 'title')
				{
					$this->topics_m->validate[$k]['label'] = lang_label($page_type->title);
				}
			}
		}

		// Get validation for our page fields.
		$page_validation = $this->streams->streams->validation_array($stream->stream_slug, $stream->stream_namespace, $method, array(), $id);
            //print_r($this->topics_m->validate);
		$this->topics_m->compiled_validate = array_merge($this->topics_m->validate, $page_validation);
               
		// Set the validation rules based on the compiled validation.
		$this->form_validation->set_rules($this->topics_m->compiled_validate);

		return $stream;
	}

    private function _form_data()
	{
		$page_types = $this->page_type_m->order_by('title')->get_all();
		$this->template->page_types = array_for_select($page_types, 'id', 'title');

		// Load navigation list
		$this->load->model('navigation/navigation_m');
		$navigation_groups = $this->navigation_m->get_groups();
		$this->template->navigation_groups = array_for_select($navigation_groups, 'id', 'title');

		$this->load->model('groups/group_m');
		$groups = $this->group_m->get_all();
		foreach ($groups as $group)
		{
			$group->name !== 'admin' && $group_options[$group->id] = $group->name;
		}
		$this->template->group_options = $group_options;

		$this->template
			->append_js('jquery/jquery.tagsinput.js')
			->append_js('jquery/jquery.cooki.js')
			->append_js('module::form.js')
			->append_css('jquery/jquery.tagsinput.css');
	}

}