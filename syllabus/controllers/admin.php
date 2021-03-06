<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * FAQ Module
 *
 * This is a sample module for PyroCMS
 * that illustrates how to use the streams core API
 * for data management. It is also a fully-functional
 * FAQ module so feel free to use it on your sites.
 *
 * Most of these functions use the Streams API CP driver which
 * is designed to handle repetitive CP tasks, down to even loading the page.
 *
 * @author 		Adam Fairholm - PyroCMS Dev Team
 * @package 	PyroCMS
 * @subpackage 	Streams Sample Module
 */
class Admin extends Admin_Controller
{
    // This will set the active section tab
    protected $section = 'faq';

    public function __construct()
    {
        parent::__construct();

        $this->lang->load('syllabus');
        $this->load->driver('Streams');
    }

    /**
     * List all FAQs using Streams CP Driver
     *
     * We are using the Streams API to grab
     * data from the faqs database. It handles
     * pagination as well.
     *
     * @return	void
     */
    public function index()
    {
        // The extra array is where most of our
        // customization options go.
        $extra = array();

        // The title can be a string, or a language
        // string, prefixed by lang:
        $extra['title'] = 'lang:sylla:syllabus';
        
        // We can customize the buttons that appear
        // for each row. They point to our own functions
        // elsewhere in this controller. -entry_id- will
        // be replaced by the entry id of the row.
        $extra['buttons'] = array(
            array(
                'label' => lang('global:edit'),
                'url' => 'admin/Syllabus/edit/-entry_id-'
            ),
            array(
                'label' => lang('global:delete'),
                'url' => 'admin/Syllabus/delete/-entry_id-',
                'confirm' => true
            )
        );

        // In this example, we are setting the 5th parameter to true. This
        // signals the function to use the template library to build the page
        // so we don't have to. If we had that set to false, the function
        // would return a string with just the form.
        $this->streams->cp->entries_table('syllabi', 'syllabus', 3, 'admin/Syllabus/index', true, $extra);
    }

    /**
     * List all FAQs (Alternate)
     *
     * This example is similar to index(), but we are
     * getting entries manually using the entries API
     * and displaying the output in a custom view file.
     *
     * @return  void
     */
    public function index_alt()
    {
        // Get our entries. We are simply specifying
        // the stream/namespace, and then setting the pagination up.
        $params = array(
            'stream' => 'syllabi',
            'namespace' => 'syllabus',
            'paginate' => 'yes',
            'limit' => 4,
            'pag_segment' => 4
        );
        $data['syllabi'] = $this->streams->entries->get_entries($params);

        // Build the page. See views/admin/index.php
        // for the view code.
        $this->template
                    ->title($this->module_details['name'])
                    ->build('admin/index', $data);
    }

    /**
     * Create a new FAQ entry
     *
     * We're using the entry_form function
     * to generate the form.
     *
     * @return	void
     */
    public function createSylla()
    {
        $extra = array(
            'return' => 'admin/Syllabus',
            'success_message' => lang('faq:submit_success'),
            'failure_message' => lang('faq:submit_failure'),
            'title' => 'lang:sylla:addsector',
         );

        $this->streams->cp->entry_form('syllabi', 'syllabus', 'new', null, true, $extra);
    }
    
    public function createSector()
    {
        $extra = array(
            'return' => 'admin/Syllabus',
            'success_message' => lang('faq:submit_success'),
            'failure_message' => lang('faq:submit_failure'),
            'title' => 'lang:sylla:addsector',
         );

        $this->streams->cp->entry_form('sectors', 'sector', 'new', null, true, $extra);
    }
      public function createModule()
    {
        $extra = array(
            'return' => 'admin/Syllabus',
            'success_message' => lang('faq:submit_success'),
            'failure_message' => lang('faq:submit_failure'),
            'title' => 'lang:sylla:addmodule',
         );

        $this->streams->cp->entry_form('modules', 'module', 'new', null, true, $extra);
    }
    public function createCourse()
    {
        $extra = array(
            'return' => 'admin/Syllabus',
            'success_message' => lang('faq:submit_success'),
            'failure_message' => lang('faq:submit_failure'),
            'title' => 'lang:sylla:addcourse',
         );

        $this->streams->cp->entry_form('modules', 'module', 'new', null, true, $extra);
    }
    
    /**
     * Edit a FAQ entry
     *
     * We're using the entry_form function
     * to generate the edit form. We're passing the
     * id of the entry, which will allow entry_form to
     * repopulate the data from the database.
     *
     * @param   int [$id] The id of the FAQ to the be deleted.
     * @return	void
     */
    public function edit($id = 0)
    {
        $extra = array(
            'return' => 'admin/Syllabus',
            'success_message' => lang('faq:submit_success'),
            'failure_message' => lang('faq:submit_failure'),
            'title' => 'lang:faq:edit'
        );

        $this->streams->cp->entry_form('syllabi', 'syllabus', 'edit', $id, true, $extra);
    }

    /**
     * Delete a FAQ entry
     * 
     * @param   int [$id] The id of FAQ to be deleted
     * @return  void
     */
    public function delete($id = 0)
    {
        $this->streams->entries->delete_entry($id, 'syllabi', 'syllabus');
        $this->session->set_flashdata('error', lang('faq:deleted'));
 
        redirect('admin/Syllabus/');
    }
    
    public function choose_type()
	{
		// Get our types.
		$this->load->model('ref_type_m');

		$all = $this->ref_type_m->get_all();

		// Do we have a parent ID?
		$parent = ($this->input->get('parent')) ? '&parent='.$this->input->get('parent') : null;

        // Who needs a menu when there is only one option?
        if (count($all) === 1) 
        {
            redirect('admin/pages/create?page_type='.$all[0]->id.$parent);
        }

        // Directly output the menu if it's for the modal.
        // All we need is the <ul>.
        if ($this->input->get('modal') === 'true') 
        {
             $link = site_url('admin/Syllabus/createSector');
             $link1 = site_url('admin/Syllabus/createCourse');
             $link2 = site_url('admin/Syllabus/createModule');
            $html  = '<h4>Add</h4>';
    		$html .= '<ul class="modal_select">';
    		$html .= '<li><a href="'.$link.'"><strong>Sector</strong>';
                $html .= '<li><a href="'.$link1.'"><strong>Course</strong>';
                $html .= '<li><a href="'.$link2.'"><strong>Module</strong>';
                $html .= '</a></li>';
    		/*foreach ($all as $pt)
    		{
    			$html .= '<li><a href="'.site_url('admin/pages/create?page_type='.$pt->id.$parent).'"><strong>'.$pt->name.'</strong>';

    			if (trim($pt->id))
    			{
    				$html .= ' | '.$pt->id;
    			}

    			$html .= '</a></li>';
    		}*/
    		
    		echo $html .= '</ul>';
            return;
        }
        
        // If this is not being displayed in the modal, we can
        // display an entire page.
        /*$this->template
            ->set('parent', $parent)
            ->set('page_types', $all)
            ->build('admin/choosetype');*/
	}

}