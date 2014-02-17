<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Admin extends Admin_Controller
{
	    protected $section = 'badge';
            
            protected $badge_validation_rules = array(
		array(
			'field' => 'name',
			'label' => 'Name',
			'rules' => 'trim|required|'
		)
            );

	public function __construct()
	{
		parent::__construct();
                
		// Load all the required classes
		$this->load->model('badge_m');
		$this->load->library('form_validation');
		  $this->load->library('files/files');
                
                
	

		// We'll set the partials and metadata here since they're used everywhere
		$this->template->append_js('module::admin.js')
                         ->append_css('module::css3_breadcrumbs.css')
                        ->append_js('module::append_item.js')
                        //->append_js('module::hello.js')
                       
                        ->append_css('module::jquery.tablesorter.pager.css')
                         ->append_js('module::jquery.tablesorter.min.js')
                        ->append_js('module::jquery.tablesorter.pager.js')
                     
                        ->append_js('module::filter_dropdown.js')
                        ->append_js('module::flag.js')
                        
						->append_css('module::admin.css');
	}

	/**
	 * List all items
	 */
	public function index()
	{
                $badges = $this->badge_m->getAllBadges();
            
		$this->template
			->title($this->module_details['name'])
                        ->set('badges',$badges)
			->append_js('jquery/jquery.cooki.js')
			->append_js('jquery/jquery.stickyscroll.js')
                        
			->build('admin/index');
	}
        
      
         public function addBadge(){
            
           
             $this->load->driver('Streams');
        $stream = $this->streams->streams->get_stream('badges', 'badge');
        
        $sector_validation = $this->streams->streams->validation_array($stream->stream_slug, $stream->stream_namespace, 'new');
	 $this->form_validation->set_rules($sector_validation);
       
        
        //get the folder
         $folder = $this->file_folders_m->get_by('name', 'badges');
        
        
        if ($this->form_validation->run())
        {
            $imageid = Files::upload($folder->id,Null,'image');
            //print_r($imageid);
            if( $imageid['status']==TRUE){
                    $entry_data = array(
             'name' => $this->input->post('name'),
             'activity'   => $this->input->post('activity'),
             'course' => $this->input->post('course'),
             'module' => $this->input->post('module'),
             'status' => 0,
                'image' => $imageid['data']['id']
                );
                    
                if($this->input->post('activity') == 'Passed an Online Assessment'){
                    $entry_data = array(
             'name' => $this->input->post('name'),
             'activity'   => $this->input->post('activity'),
             'course' => $this->input->post('course'),
             
             'status' => 0,
                'image' => $imageid['data']['id']
                );
                    
                    
          
                }
            
                
            if ($id = $this->streams->entries->insert_entry($entry_data, 'badges', 'badge'))
			{
                        //print_r($rules);
				
				$this->session->set_flashdata('success', "Successfully added a new badge!");
                                

			}
			else
			{
				$this->session->set_flashdata('error',"Error! Please try again");
			}
                         
                        redirect('admin/badge');
            }
            else{
               $this->session->set_flashdata('error', 'Error in uploading image. Please try again');
                 redirect('admin/badge');
               
            }
        }
        
         $item = new stdClass();
        
        foreach ($this->validation_rules as $rule)
		{
			$item->{$rule['field']} = set_value($rule['field']);
		}
        
               
             
             
             
           $courses = $this->badge_m->getCoursesDropdown();
           $modules = $this->badge_m->getModulesDropdown();
           
             
           $this->template
                   ->title('Add New Badge')
                   ->set('item',$item)
                   ->set('courses',$courses)
                   ->set('modules',$modules)
                   ->build('admin/addBadge');
             
             
         }
         
         public function ajax_edit($badgeid){
             
             $badgeDetails = $this->badge_m->getBadgeDetails($badgeid);
             
             $this->load->view('admin/ajax_edit',array('badgeDetails' => $badgeDetails));
             
             
         }
         
         public function editBadge($bID){
             $this->form_validation->set_rules($this->badge_validation_rules);
           
             if($this->form_validation->run()){
             
            if (empty($_FILES['image']['name'])){
             $entry_data = array(
              'name' => $this->input->post('name'),
               
                );
             }else{
             $folder = $this->file_folders_m->get_by('name', 'badges');
         $imageid = Files::upload($folder->id,Null,'image');
        $entry_data = array(
              'name' => $this->input->post('name'),
                'image' => $imageid['data']['id']
                );
             
             }
             
             if ($id1 = $this->streams->entries->update_entry($bID, $entry_data, 'badges', 'badge'))
			{
                               
				$this->session->set_flashdata('success', sprintf('Successfully edited a badge!'));
                                
                                
			}
			else
			{
				$this->session->set_flashdata('error', 'Please try again');
			}
                         
                       // redirect('admin/syllabus/viewSector/'.$_SESSION['sectorID']);
       
                    redirect('admin/badge'); 
             }else{
                 echo 'AWW';
             }
             
             
         }
         
         public function flagBadge($bID){
             $entry_data = array(
              'status' => 1,
               
                );
             
             if ($id1 = $this->streams->entries->update_entry($bID, $entry_data, 'badges', 'badge'))
			{
                               
				$this->session->set_flashdata('success', sprintf('Successfully edited a badge!'));
                                
                                
			}
			else
			{
				$this->session->set_flashdata('error', 'Please try again');
			}
                         
                       // redirect('admin/syllabus/viewSector/'.$_SESSION['sectorID']);
       
                    redirect('admin/badge'); 
             
             
         }
         
         public function unflagBadge($bID){
             $entry_data = array(
              'status' => 0,
               
                );
             
             if ($id1 = $this->streams->entries->update_entry($bID, $entry_data, 'badges', 'badge'))
			{
                               
				$this->session->set_flashdata('success', sprintf('Successfully edited a badge!'));
                                
                                
			}
			else
			{
				$this->session->set_flashdata('error', 'Please try again');
			}
                         
                       // redirect('admin/syllabus/viewSector/'.$_SESSION['sectorID']);
       
                    redirect('admin/badge'); 
             
             
         }
         
         public function getModules(){
             
             $courseid = $_POST['module'][0];
             
             $modules = $this->badge_m->getModules($courseid);
                $data ="";
                //print_r($modules);
                
                //for($i = 0; )
             foreach($modules as $m){
                 //echo $m['HeirarchyID'];
                 $data= $data.'<option value="'.$m['HeirarchyID'].'">'.$m['title'].'</option>';
             }
             
             echo $data;
             //echo "AA";
         }
        
        
}
