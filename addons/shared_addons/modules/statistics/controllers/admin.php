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
	protected $section = 'Course';

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
		// here we use MY_Model's get_all() method to fetch everything
		//$items = $this->sample_m->get_all();

		// Build the view with sample/views/admin/items.php
                $this->load->model('syllabus/getSectors');
                $this->load->model('syllabus/getCourses');
                $this->load->model('model_users');
                $this->load->model('sample_m');
                date_default_timezone_set('Hongkong');
                $dateNow = date("Y-m-d H:i:s");
                
                $allSects = $this->getSectors->getSectorList();
                $courses = $this->getCourses->getAllCourses();
                $formopts = array();
                $formopts[0] = 'All';
                
                foreach($allSects as $sector){
                    $formopts[$sector['id']] = $sector['title'];
                }
                $noOfEnrolled = array();
                $inactCount = array();
                $gradCount = array();
                $avgDur = array();
                foreach($courses as $cs){
                    $noOfEnrolled[$cs['id']] = $this->model_users->countEnrolled($cs['id']);
                    $inactCount[$cs['id']] []= $this->sample_m->couInCount($cs['id'], $dateNow);
                    $gradCount[$cs['id']] = $this->model_users->countGrads($cs['id']);
                    $avgDur[$cs['id']] = $this->model_users->avgDur($cs['id']);
                }
                //print_r($noOfEnrolled);
		$this->template
			->title($this->module_details['name'])
			->set('sectors', $formopts)
			->set('courses', $courses)
			->set('noOfEnrolled', $noOfEnrolled)
			->set('inactCount', $inactCount)
			->set('gradCount', $gradCount)
			
			->set('avgDur', $avgDur)
                      
                       
                      
			->build('admin/index');
	}
        
        public function load_indexTable($sectorID){
            $this->load->model('syllabus/getCourses');
            $this->load->model('model_users');
            $this->load->model('sample_m');
            date_default_timezone_set('Hongkong');
            $dateNow = date("Y-m-d H:i:s");
            
            $courses = $this->getCourses->sectCourse($sectorID);
            
            $noOfEnrolled = array();
            $inactCount = array();
            $gradCount = array();
            $avgDur = array();
            foreach($courses as $cs){
                $noOfEnrolled[$cs['id']] = $this->model_users->countEnrolled($cs['id']);
                $inactCount[$cs['id']] []= $this->sample_m->couInCount($cs['id'], $dateNow);
                $gradCount[$cs['id']] = $this->model_users->countGrads($cs['id']);
                $avgDur[$cs['id']] = $this->model_users->avgDur($cs['id']);
            }
           $this->load->view('admin/load_indexTable', array('courses' => $courses, 'noOfEnrolled' => $noOfEnrolled, 
               'inactCount' => $inactCount, 'gradCount' => $gradCount, 'avgDur' => $avgDur));
           
           
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
           //print_r($scCount);
           $this->template
                   ->set('oaBasic', $oaBasic)
                   ->set('oaBCount', $oaBCount)
                   ->set('scBasic', $scBasic)
                   ->set('scCount', $scCount)
                   ->build('admin/testList');
           
           
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
            $dateNow = date("Y-m-d H:i:s");
            $inactID = $this->model_users->inactLearnerID($dateNow);
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
       

        public function modal_learners($courseID){
            $this->load->model('model_users');
            $courseEnr = $this->model_users->courseEnr($courseID);
            $enrNames = array();
            foreach($courseEnr as $ce){
                $enrNames[$ce['learnerID']] = $this->model_users->enrNames($ce['learnerID']);
            }
            $this->load->view('admin/modal_learners', array('courseEnr' => $courseEnr, 'enrNames' => $enrNames));
            
        }
        
        public function modal_inactives($courseID){
            $this->load->model("sample_m");
            $this->load->model("model_users");
            date_default_timezone_set('Hongkong');
            $dateNow = date("Y-m-d H:i:s");
            $courseIn = $this->sample_m->leaInInfo($courseID, $dateNow);
            $enrNames = array();
            foreach($courseIn as $ci){
                $enrNames[$ci['learnerID']] = $this->model_users->enrNames($ci['learnerID']);
            }    
                
            $this->load->view('admin/modal_inactives', array('courseIn' => $courseIn, 'enrNames' => $enrNames));
        }


        public function modal_graduates($courseID){
            $this->load->model('model_users');
            $courseEnr = $this->model_users->courseGrad($courseID);
            $enrNames = array();
            foreach($courseEnr as $ce){
                $enrNames[$ce['learnerID']] = $this->model_users->enrNames($ce['learnerID']);
            }
            $this->load->view('admin/modal_graduates', array('courseEnr' => $courseEnr, 'enrNames' => $enrNames));
            
        }
     
         public function courseLearnerProfile($learnerID){
            $this->load->model('model_users');
            $this->load->model('syllabus/getCourses');
            $this->load->model('syllabus/getModules');
            $enAge = $this->model_users->enAge($learnerID);
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
                    ->set('enAge', $enAge)
                    ->build('admin/course_LearnerProfile');
            
        }
        
   public function courseOverview($courseID){
       $this->load->model('model_users');
       $this->load->model('learner/model_users');
       $cTitle = $this->model_users->courseName($courseID);
       $allLearners = $this->model_users->getAllLearners($courseID);
       $cMods = $this->model_users->getCourseMods($courseID);
       
       $enrNames = array();
       $lateDate = array();
       $ratings = array();
       $enCountry = array();
       $enDets = array();
       $enAge = array();
       foreach($allLearners as $al){
           $enrNames[$al['learnerID']]= $this->model_users->enrNames($al['learnerID']);
           $enCountry[$al['learnerID']]= $this->model_users->enCountry($al['learnerID']);
           $enDets[$al['learnerID']]= $this->model_users->detsEn($al['learnerID'], $courseID);
           $enAge[$al['learnerID']]= $this->model_users->enAge($al['learnerID']);
           foreach($cMods as $cm){
               $lateDate []= $this->model_users->latSC($al['learnerID'], $cm['id']);
               foreach($lateDate as $ld){
                   foreach($ld as $lat){
                    $ratings[$al['learnerID']][$cm['id']] = $this->model_users->moduleSC($al['learnerID'], $cm['id'], $lat['latest']);
                   }
               }
           }
       }
       //print_r($ratings);
       $this->template
               ->set('cTitle', $cTitle)
               ->set('allLearners', $allLearners)
               ->set('enrNames', $enrNames)
               ->set('cMods', $cMods)
               ->set('ratings', $ratings)
               ->set('enCountry', $enCountry)
               ->set('enDets', $enDets)
               ->set('enAge', $enAge)
               ->build('admin/course_overview');
       
   }
   
   
      
       
}
