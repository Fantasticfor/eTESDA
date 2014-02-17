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
	protected $section = 'Admin';

	public function __construct()
	{
		parent::__construct();

		// Load all the required classes
		//$this->load->model('model_users');
		//$this->load->library('form_validation');
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
                        ->append_css('jquery/jquery-ui.css')
                        ->append_js('module::admin.js')
                        ->append_css('module::admin.css')
                         ->append_js('jquery/jquery.ui.nestedSortable.js')
                         ->append_js('module::highcharts.js')
			->append_js('jquery/jquery.cooki.js')
			->append_js('jquery/jquery.stickyscroll.js');

	}

	/**
	 * List all items
	 */
	public function index()
	{
            $this->load->model('model_users');
            $learners = $this->model_users->allLearners();
            //print_r($learners);
		// here we use MY_Model's get_all() method to fetch everything
		//$items = $this->model_users->get_all();

		// Build the view with sample/views/admin/items.php
		$this->template
			//->title($this->module_details['name'])
			//->set('items', $items)
                        ->set('learners', $learners)
			->build('admin/index');
	}
        
        public function reasonMod($reasonID){
           $this->load->model('model_users');
           $reas = $this->model_users->getReqReason($reasonID);
           $this->load->view('admin/reasonModal', array('reas' => $reas));
           
       }
       
       public function feedbackMod($feedID){
           $this->load->model('model_users');
           $feedbacks = $this->model_users->getFeeds($feedID);
                $feedLearner = array();
                foreach($feedbacks as $feeds){
                    if($feeds['learnerID'] != NULL){
                        $feedLearner = $this->model_users->learnerInfo($feeds['learnerID']);
                    }
                }
           $this->load->view('admin/feedback_modal', array('feedbacks' => $feedbacks, 'feedLearner' => $feedLearner));
       }

	public function viewLearnerProfile($learnerID){
            $this->load->model('model_users');
            $this->load->model('syllabus/getCourses');
            $this->load->model('syllabus/getModules');
            
            $learnerInfo = $this->model_users->learnerInfo($learnerID);
            $fLearnerCourses = $this->getCourses->getFinCourses($learnerID);
            $learnerCourses = $this->getCourses->allLCourses($learnerID);
            $latestSC = array();
            $latestOA = array();
            $courseMods = array();
            $mSC = array();
            $coMods = array();
            $sects = array();
            $lOA = array();
            $mSeC = array();
            $enAge = $this->model_users->enAge($learnerID);
            //print_r($learnerCourses);
            foreach($learnerCourses as $lc){
                
                $latestSC []= $this->model_users->latDateSC($lc['id'], $learnerID);
                //print_r($latestSC);
                $courseMods [$lc['title']] []= $this->getModules->courseMods($lc['id'], $learnerID);
                foreach($latestSC as $la){
                    foreach($la as $lat){
                        $mSC[$lc['title']] []= $this->model_users->modSC($learnerID, $lc['id'], $lat['latest']);
                    }
                }
                
//                print_r($mSeC);
//                $modTitle = array();
//                foreach($mSeC as $msc){
//                    foreach($msc as $modSelf){
//                        $modTitle[$lc['title']] []= $this->model_users->scMod($modSelf['sectionID'], $lc['id']);
//                    }
//                }
                
                
                
                $latestOA []= $this->model_users->latOA($lc['id'], $learnerID);
                
                foreach($latestOA as $latOA){
                    foreach($latOA as $latest){
                        $lOA[$lc['title']] []= $this->model_users->oaRes($learnerID, $lc['id'], $latest['latest']);
                        $sects[$lc['title']] []= $this->model_users->sectRes($learnerID, $lc['id'], $latest['latest']);
                    }
                }
                $coMods []= $this->getModules->courseMods($lc['id'], $learnerID);
            }
            //print_r($coMods);
            $scAt = array();
            $modTime = array();
            foreach($coMods as $cm){
                foreach($cm as $cmo){
                    $modTime [$cmo['title']] []= $this->getModules->modTime($cmo['id'], $learnerID);
                    $scAt [$cmo['title']] []= $this->model_users->scAttempts($learnerID, $cmo['id']);
                }
            }
            
//            $scTitle = (object)$modTitle;
//            print_r($scTitle);
            $oaSect = (object)$sects;
            $oaRes = (object)$lOA;
            $scAttempt = (object)$scAt;
            $modSC = (object)$mSC;
            $dura = (object)$modTime;
            $cMods = (object)$courseMods;
            //print_r($modSC);
            $this->template
                    ->set('learnerInfo', $learnerInfo)
                    ->set('fLearnerCourses', $fLearnerCourses)
                    ->set('learnerCourses', $learnerCourses)
                    ->set('cMods', $cMods)
                    ->set('dura', $dura)
                    ->set('modSC', $modSC)
                    //->set('scTitle', $scTitle)
                    ->set('scAttempt', $scAttempt)
                    ->set('oaRes', $oaRes)
                    ->set('oaSect', $oaSect)
                    ->set('enAge', $enAge)
                    ->build('admin/learnerProfile');
            
        }
        
       public function viewHistory(){
           $learnerID = $this->input->get('var1');
           $moduleID = $this->input->get('var2');
           
           $this->load->model('model_users');
           $history = $this->model_users->scHistory($learnerID, $moduleID);
           $attempts = $this->model_users->scAttempts($learnerID, $moduleID);
           
           $this->load->view('admin/modal_viewHistory', array('att' => $attempts, 'scHis' => $history) );
       }
       
       public function courseList(){
           $this->load->model('syllabus/getCourses');
           date_default_timezone_set('Hongkong');
           
           $sectCourses = $this->getCourses->sectCourse(1);
           $enrollees = array();
           $inactive = array();
           foreach($sectCourses as $sc){
               $enrollees[$sc['title']] []= $this->getCourses->courseEnrollees($sc['id']);
               $inactive[$sc['title']] []= $this->getCourses->courseInac($sc['id'], date("m"), date("Y"));
           }
           
           
           
           $this->template
                   ->set('sectCourses', $sectCourses)
                   ->set('enrollees', (object)$enrollees)
                   ->set('inactive', (object)$inactive)
                   ->build('admin/courseStatList');
       }
       
       public function courseStat($courseID){
           $this->load->model('syllabus/getCourses');
           $this->load->model('syllabus/getModules');
           
           $courseDet = $this->getCourses->getCourse($courseID);
           $enrollees = $this->getCourses->courseEnrollees($courseID);
           $inactive = $this->getCourses->courseInac($courseID, date("m"), date("Y"));
           $grads = $this->getCourses->courseGrads($courseID);
           $courseDur = $this->getCourses->aveDuration($courseID);
           $courseMods = $this->getModules->getModuleDetails($courseID);
           
           $this->template
                   ->set('courseDet', $courseDet)
                   ->set('enrollees', $enrollees)
                   ->set('inactive', $inactive)
                   ->set('grads', $grads)
                   ->set('courseDur', $courseDur)
                   ->set('courseMods', $courseMods)
                   ->build('admin/courseStat');
       }
       
}
