<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a sample module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	Sample Module
 */
class Admin_learnerStat extends Admin_Controller
{
	protected $section = 'Learner';

	public function __construct()
	{
		parent::__construct();

		// Load all the required classes
		$this->load->model('sample_m');
               
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
                     
                         ->append_css('module::css3_breadcrumbs.css')
                        ->append_css('jquery/jquery-ui.css')
                 ->append_js('jquery/jquery.ui.nestedSortable.js')
			->append_js('jquery/jquery.cooki.js')
			->append_js('jquery/jquery.stickyscroll.js')
                          ->append_css('module::index.css')
                            ->append_css('module::admin.css')
                ->append_js('module::admin.js')
                ->append_js('module::jquery.tablesorter.min.js')
                ->append_js('module::filter_dropdown.js')
                ->append_js('module::items.js')
                ->append_js('module::jquery.tablesorter.pager.js')
                ->append_js('module::highcharts.js');
                        
               
		
		
	}

	/**
	 * List all items
	 */
	public function index()
	{
            
            $this->load->model('model_users');
            $this->load->model('syllabus/getCourses');
            $courses = $this->getCourses->getAllCourses();
            $formopts = array();
            $formopts[0] = 'Filter by Course';
                
            foreach($courses as $cs){
                $formopts[$cs['id']] = $cs['title'];
            }
            $allLearners = $this->model_users->allLearnerNames();
            $learnList = $this->model_users->learnList();
            $enrNames = array();
            $gradCount = array();
            $enrCount = array();
            foreach($learnList as $ll){
                $enrNames[$ll['learnerID']]= $this->model_users->enrNames($ll['learnerID']);
                $gradCount[$ll['learnerID']]= $this->model_users->gradCount($ll['learnerID']);
                $enrCount[$ll['learnerID']]= $this->sample_m->learnEnCount($ll['learnerID']);
            }
            
		$this->template
			->title($this->module_details['name'])
			->set('learnList', $learnList)
                        ->set('courses', $formopts)
			->set('enrNames', $enrNames)
			->set('gradCount', $gradCount)
			->set('enrCount', $enrCount)
                        ->set('allLearners', $allLearners)
                        ->build('admin/learnerStat/index');
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
        
        
       public function courseStat($courseID){
           $this->load->model('syllabus/getCourses');
           $this->load->model('syllabus/getModules');
           $this->load->model('sample_m');
           
           $courseDet = $this->getCourses->getCourse($courseID);
           $enrollees = $this->getCourses->courseEnrollees($courseID);
           $inactive = $this->getCourses->courseInac($courseID, date("m"), date("Y"));
           $grads = $this->getCourses->courseGrads($courseID);
           $courseDur = $this->getCourses->aveDuration($courseID);
           $courseMods = $this->getModules->getModuleDetails($courseID);
           $modDur = array();
           foreach($courseMods as $cm){
               $modDur[$cm['title']] []= $this->sample_m->modDuration($cm['id']);
           }
           //print_r($modDur);
           $this->template
                   ->set('courseDet', $courseDet)
                   ->set('enrollees', $enrollees)
                   ->set('inactive', $inactive)
                   ->set('grads', $grads)
                   ->set('courseDur', $courseDur)
                   ->set('courseMods', $courseMods)
                   ->set('modDur', (object)$modDur)
                   ->build('admin/courseStat');
           
           
       }
       public function learnerList($courseID){
           $this->load->model('sample_m');
           $this->load->model('learner/model_users');
           
           $learnerIDs = $this->sample_m->getLearnerID($courseID);
           $learnerInfo = array();
           foreach($learnerIDs as $lIDs){
               $learnerInfo []= $this->model_users->learnerInfo($lIDs['learnerID']);
           }
           //print_r($learnerInfo);
           $this->template
                   ->set('learners', $learnerInfo)
                   ->build('admin/learnerList');
           
           
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
       public function testStatSC($moduleID){
           $this->load->model('sample_m');
           date_default_timezone_set('Hongkong');
           
           $basicInfo = $this->sample_m->scBasicInfo($moduleID);
           $basicCount = $this->sample_m->scBasicCount($moduleID);
           $comp = $this->sample_m->compCount($moduleID);
           $nr = $this->sample_m->nrCount($moduleID);
           $scTakers = $this->sample_m->scTakers($moduleID, date("m"), date("Y"));
           $bCount = count($basicCount);
           $this->template
                   ->set('basicInfo', $basicInfo)
                   ->set('bCount', $bCount)
                   ->set('comp', $comp)
                   ->set('nr', $nr)
                   ->set('scTakers', $scTakers)
                   ->build('admin/testStatisticsSC');
           
           
       }
       
       public function testStat($courseID){
           $this->load->model('sample_m');
           date_default_timezone_set('Hongkong');
           
           $basicInfo = $this->sample_m->oaBasicInfo($courseID);
           $basicCount = $this->sample_m->oaBasicCount($courseID);
           $pCount = $this->sample_m->oaPCount($courseID);
           $nrCount = $this->sample_m->oaNRCount($courseID);
           $secComp = $this->sample_m->secComp($courseID);
           $oaTakers = $this->sample_m->oaTakers($courseID, date("m"), date("Y"));
           $bCount = count($basicCount);
           $secNR = array();
           foreach($secComp as $scC){
               $secNR[$scC['title']] []= $this->sample_m->secNR($scC['id']);
           }
           
           $this->template
                   ->set('basicInfo', $basicInfo)
                   ->set('bCount', $bCount)
                   ->set('pCount', $pCount)
                   ->set('nrCount', $nrCount)
                   ->set('secComp', $secComp)
                   ->set('secNR', (object)$secNR)
                   ->set('oaTakers', $oaTakers)
                   ->build('admin/testStatisticsOA');
           
           
       }
       
       public function testList($courseID){
           $this->load->model('sample_m');
           $oaBasic = $this->sample_m->oaBasStat($courseID);
           $oaBasicC = $this->sample_m->oaBasCount($courseID);
           $oaBCount = count($oaBasicC);
           $scBasic = $this->sample_m->scBasStat($courseID);
           $sbc = array();
           $scCount = array();
           foreach($scBasic as $sb){
               $sbc[]= $this->sample_m->scBasicCount($sb['id']);
               foreach($sbc as $scc){
                   $scCount[$sb['id']] = count($scc);
               }
           }
           print_r($scCount);
           $this->template
                   ->set('oaBasic', $oaBasic)
                   ->set('oaBCount', $oaBCount)
                   ->set('scBasic', $scBasic)
                   ->set('scCount', $scCount)
                   ->build('admin/testList');
           
           
       }
       public function load_indexTable($sectorID){
           $this->load->model('syllabus/getCourses');
           $courses = $this->getCourses->sectCourse($sectorID);
           
           $this->load->view('admin/load_indexTable', array('courselist' => $courses));
           
           
       }
       
   
        public function pdf_report(){
        $this->load->helper(array('My_Pdf'));   //  Load helper
       $data =$this->thayne(); // Pass the url of html report
       //$data= '<html> <h1>Hello world </h1></html>';
        create_pdf($data); //Create pdf
        }
        
        public function emailSlack(){
            $this->load->model('model_users');
            date_default_timezone_set('Hongkong');
            
            $inactID = $this->model_users->inactLearnerID(date("m"), date("Y"));
            $inactLearners = array();
            foreach($inactID as $inact){
                $inactLearners []= $this->model_users->inactLearner($inact['learnerID']);
            }
            //print_r($inactLearners);
            foreach($inactLearners as $il){
                foreach($il as $learn){
                if($learn['fbusername'] != NULL && $learn['userpassword'] == NULL){
                   

                    Events::trigger('email', array(
                    'slug' => 'inactive-users', //email template slu
                    'to' => $learn['fbusername'].'@facebook.com',
                    'from' => Settings::get('server_email'),
                 // param sa email template
                          ), 'array');
                }else{
                    Events::trigger('email', array(
                    'slug' => 'inactive-users', //email template slu
                    'to' => $learn['email'],
                    'from' => Settings::get('server_email'),
                 // param sa email template
                          ), 'array');
                }
            }
            
            
        }
        redirect('admin');
        }
    
     
        
     public function viewLearnerMonitor(){
            
            $this->template->build('admin/learnerStat/viewLearnerProfile');
            
        }
        
        public function load_courseTable($courseID){
            $this->load->model('syllabus/getCourses');
            $this->load->model('model_users');
            $this->load->model('sample_m');
            
            
            $learnList = $this->sample_m->couLearners($courseID);
            $enrNames = array();
            $enrCount = array();
            $gradCount = array();
            foreach($learnList as $ll){
                $enrNames[$ll['learnerID']]= $this->model_users->enrNames($ll['learnerID']);
                $enrCount[$ll['learnerID']]= $this->sample_m->learnEnCount($ll['learnerID']);
                $gradCount[$ll['learnerID']]= $this->model_users->gradCount($ll['learnerID']);
            }

           $this->load->view('admin/load_learnerTable', array('learnList' => $learnList, 'enrNames' => $enrNames, 
               'enrCount' => $enrCount, 'gradCount' => $gradCount));
           
           
       }
       
       public function autoLearner($learnN){
           //session_start();
           //$first = $this->input->get('fPart');
           //$sec = $this->input->get('sPart');
           //print_r($_SESSION['gelo']);
           $this->load->model('model_users');
           $this->load->model('sample_m');
           //echo $learnN;
           //$allLearners = $this->model_users->allLearnerNames();
           $lName = urldecode($learnN);
           $learners = $this->model_users->searchLearn($lName);
           $enrNames = array();
           $enrCount = array();
           $grCount = array();
           
           foreach($learners as $lr){
               $enrNames[$lr['userid']] = $this->model_users->enrNames($lr['userid']);
               $enrCount[$lr['userid']] = $this->sample_m->learnEnCount($lr['userid']);
               $grCount[$lr['userid']] = $this->model_users->gradCount($lr['userid']);
           }
           //print_r($enrNames);
           //$lName2 = $lName.'@'.$sec;
           //echo $lName2;
           //$key1 = '';
           //$temp = array();
           //$temp2 = array();
           //foreach($allLearners as $key=>$al){
           //    $temp [$key]= $al['name'];
           //    $temp2 [$key]= $al['userid'];
          //     $key1 = array_search($lName2, $temp);
               
           //}
           //echo $key1;
           //$enrNames = $this->model_users->enrNames($temp2[$key1]);
           //print_r($temp);
           
           //foreach($key1 as $keyy){
            //$enrCount = $this->sample_m->learnEnCount($temp2[$key1]);
            //$grCount = $this->model_users->gradCount($temp2[$key1]);
           //}
          $this->load->view('admin/load_LearnerAuto', array('learners' => $learners, 'enrNames' => $enrNames, 'enrCount' => $enrCount, 'grCount' => $grCount));
       }
        
       
}
