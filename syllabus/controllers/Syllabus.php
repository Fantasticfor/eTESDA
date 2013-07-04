<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a sample module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	Sample Module
 */
class Syllabus extends Public_Controller
{
	public function __construct()
	{
		parent::__construct();

	$this->template->append_js('module::sectors.js');
	}

	/**
	 * All items
	 */
	public function index()
	{
		// set the pagination limit
		
                
                if ( is_logged_in())
		{
                    //redirect( base_url()."learner");
                    $this->template->build('dashboard/learn_dashboard');
                }
                        
                        else{
                      $sector_thumb=array(); 
                            $sector_thumb['thumbnail_url'] = "sector_blue/sector_Agriculture.png";
		$sector_thumb['sector_name'] = "Agriculture";
                                 
                $name="Agriculture";
                $thumb_url="sector_blue/sector_Agriculture.png";
                        $this->template 
                                 ->set((array('name' => $name, 'thumb_url' => $thumb_url)))
                                    ->build('learn_Landing');
                            
                        }
	}
        
        public function load_details($id){
            
         $sector['title']=$id;
            
         $this->load->view('landing_Details',$sector);
            
        }
         
               
        public function Sectors(){
            $this->template->build('learn_SectorList');
            
        }
        
         public function Courses(){
            $this->template->build('learn_CourseList');
            
        }
           public function Modules(){
            $this->template->build('learn_ModuleList');
            
        }
        
              public function viewProfile(){
            $this->template->build('profile/learn_ViewProfile');
            
        }
       
         public function editProfile(){
            $this->template->build('profile/EditBasic');
            
        }
        
        
        public function login(){
            $this->load->view('Profile/login_modal');
            
        }
        
        public function displaySectors(){
        
            $data['sectors'] = array();
            $this->load->model('getSectors');
            $sectors = $this->publicuser->getSectorList()->result();
		
            foreach($sectors as $sector):
            
                $data['sectors'][] = array('name' => $sector->title,
                                           'icon' => $sector->image,
                                           'desc' => $sector->description,
                                           'sectID' => $sector->id);
            
            endforeach;
        
            
            $this->load->view('learn_Landing');
            
        }
        
        public function showCourses($id){
            $this->load->model('getCourses');
                      
            $this->getCourses->getCourseList($id);
        
            $coursesData = array(
            'cName' => 'coursename',
            'picPath' => 'path'
            );
            $this->session->disp_courses($coursesData);
        }
      
}