<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a sample module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	Sample Module
 */
class Admin_sectorStat extends Admin_Controller
{
	protected $section = 'Sector';

	public function __construct()
	{
		parent::__construct();

		// Load all the required classes
		$this->load->model('sample_m');
                $this->load->helper('download');
                $this->load->helper('file'); 
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
                        ->append_css('jquery/jquery-ui.css')
                 ->append_js('jquery/jquery.ui.nestedSortable.js')
			->append_js('jquery/jquery.cooki.js')
			->append_js('jquery/jquery.stickyscroll.js')
                          ->append_css('module::index.css')
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
                $allSects = $this->getSectors->getSectorList();
                $courses = $this->getCourses->getAllCourses();
                $formopts = array();
                $formopts[0] = 'All';
                
                foreach($allSects as $sector){
                    $formopts[$sector['id']] = $sector['title'];
                }
            
		$this->template
			->title($this->module_details['name'])
			->set('sectors', $formopts)
			->set('courses', $courses)
                      
                       
                      
			->build('admin/sectorStat/index');
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
       

        public function modal_learners2(){
            $cID = $this->input->get("cID");
            $type = $this->input->get("type");
            $mon = $this->input->get("mon");
            $year = $this->input->get("year");
            date_default_timezone_set('Hongkong');
            $dateNow = date("Y-m-d H:i:s");
            $this->load->model("sample_m");
            $this->load->model("model_users");
            $modInfo = array();
            $learnN = array();
            if($type == 1){
                if($mon != 0 && $year != 0){
                    $modInfo = $this->sample_m->leaEnCountMY($mon, $year, $cID);
                    foreach($modInfo as $mi){
                        $learnN[$mi['learnerID']]= $this->model_users->enrNames($mi['learnerID']);
                    }
                }else if ($mon == 0 && $year != 0){
                    $modInfo = $this->sample_m->leaEnCountY($year, $cID);
                    foreach($modInfo as $mi){
                        $learnN[$mi['learnerID']]= $this->model_users->enrNames($mi['learnerID']);
                    }
                }
            }else if ($type == 2){
                if($mon != 0 && $year != 0){
                    $modInfo = $this->sample_m->leaGrCountMY($mon, $year, $cID);
                    foreach($modInfo as $mi){
                        $learnN[$mi['learnerID']]= $this->model_users->enrNames($mi['learnerID']);
                    }
                }else if ($mon == 0 && $year != 0){
                    $modInfo = $this->sample_m->leaGrCountY($year, $cID);
                    foreach($modInfo as $mi){
                        $learnN[$mi['learnerID']]= $this->model_users->enrNames($mi['learnerID']);
                    }
                }
            }else if ($type == 3){
                if($mon != 0 && $year != 0){
                    $modInfo = $this->sample_m->leaInCountMY($mon, $year, $cID, $dateNow);
                    foreach($modInfo as $mi){
                        $learnN[$mi['learnerID']]= $this->model_users->enrNames($mi['learnerID']);
                    }
                }else if ($mon == 0 && $year != 0){
                    $modInfo = $this->sample_m->leaInCountY($year, $cID, $dateNow);
                    foreach($modInfo as $mi){
                        $learnN[$mi['learnerID']]= $this->model_users->enrNames($mi['learnerID']);
                    }
                }
            }
            
            
            
            $this->load->view('admin/modal_learners2', array('modInfo' => $modInfo, 'learnN' => $learnN, 'type' => $type));
            
        }
        
        public function sumModal(){
            $sectID = $this->input->get("sectID");
            $type = $this->input->get("type");
            $mon = $this->input->get("mon");
            $year = $this->input->get("year");
            $this->load->model('sample_m');
            $this->load->model('syllabus/getSectors');
            date_default_timezone_set('Hongkong');
            $dateNow = date("Y-m-d H:i:s");
            $sectName = $this->getSectors->getSectTitle($sectID);
            $coNames = $this->sample_m->getSectCourses($sectID);
            $totEn = array();
            $totGr = array();
            $totIn = array();
            if($mon != 0 && $year != 0){
                foreach($coNames as $cn){
                    $totEn[$cn['id']] []= $this->sample_m->couEnCountMY($mon, $year, $cn['id']);
                    $totGr[$cn['id']] [] = $this->sample_m->couGrCountMY($mon, $year, $cn['id']);
                    $totIn[$cn['id']] [] = $this->sample_m->couInCountMY($mon, $year, $cn['id'], $dateNow);
                }
            }else if ($mon == 0 && $year != 0){
                foreach($coNames as $cn){
                    $totEn[$cn['id']] [] = $this->sample_m->couEnCountY($year, $cn['id']);
                    $totGr[$cn['id']] [] = $this->sample_m->couGrCountY($year, $cn['id']);
                    $totIn[$cn['id']] [] = $this->sample_m->couInCountY($year, $cn['id'], $dateNow);
                }
            }
            
            $this->load->view('admin/modal_summary', array('coNames' => $coNames, 'totEn' => $totEn, 'totGr' => $totGr, 'totIn' => $totIn, 'sectName' => $sectName, 'mon' => $mon, 'year' => $year, 'type' => $type, 'sectID' => $sectID));
        }
     
        public function load_courses(){
            $sectID = $this->input->get("sectorID");
            $typeID = $this->input->get("typeID");
            $mon = $this->input->get("mon");
            $year = $this->input->get("year");
            $this->load->model('sample_m');
            $this->load->model('syllabus/getSectors');
            $sectName = $this->getSectors->getSectTitle($sectID);
            date_default_timezone_set('Hongkong');
            $dateNow = date("Y-m-d H:i:s");
            $cNames = array();
            $sectCounts = array();
            
            if($typeID == 1){
                $cNames = $this->sample_m->getSectCourses($sectID);
                if($mon != 0 && $year != 0){
                    foreach($cNames as $cn){
                        $sectCounts[$cn['id']] []= $this->sample_m->couEnCountMY($mon, $year, $cn['id']);
                    }
                    
                }else if ($mon == 0 && $year != 0){
                    foreach($cNames as $cn){
                        $sectCounts[$cn['id']] []= $this->sample_m->couEnCountY($year, $cn['id']);
                    }
                    
                }
            }else if ($typeID == 2){
                $cNames = $this->sample_m->getSectCourses($sectID);
                if($mon != 0 && $year != 0){
                    foreach($cNames as $cn){
                        $sectCounts[$cn['id']] []= $this->sample_m->couGrCountMY($mon, $year, $cn['id']);
                    }
                    
                }else if ($mon == 0 && $year != 0){
                    foreach($cNames as $cn){
                        $sectCounts[$cn['id']] []= $this->sample_m->couGrCountY($year, $cn['id']);
                    }
                    
                }
            }else if ($typeID == 3){
                $cNames = $this->sample_m->getSectCourses($sectID);
                if($mon != 0 && $year != 0){
                    foreach($cNames as $cn){
                        $sectCounts[$cn['id']] []= $this->sample_m->couInCountMY($mon, $year, $cn['id'], $dateNow);
                    }
                    
                }else if ($mon == 0 && $year != 0){
                    foreach($cNames as $cn){
                        $sectCounts[$cn['id']] []= $this->sample_m->couInCountY($year, $cn['id'], $dateNow);
                    }
                    
                }
            }
            //print_r($sectCounts);    
            $this->load->view('admin/sectorStat/load_courses', array('cNames' => $cNames, 'sectCounts' => $sectCounts, 'sectName' => $sectName, 'mon' => $mon, 'year' => $year, 'type' => $typeID, 'sectID' => $sectID));
        }
         public function load_sectorReport(){
            $mon = $this->input->get("month");
            $year = $this->input->get("year");
            $type = $this->input->get("type");
            //echo $mon;
            $sectCounts = array();
            $sectName = array();
            $sumEn = array();
            $sumGr = array();
            $sumInact = array();
            $allSects = array();
            $totEn = array();
            $totGr = array();
            $totIn = array();
            if($type == 1){
                if($mon != 0 && $year != 0){
                    $sectName = $this->sample_m->enCountMY($mon, $year);

                    foreach($sectName as $sn){
                        $sectCounts[$sn['ID']] []= $this->sample_m->secCountMY($mon, $year, $sn['ID']);

                    }
                }else if ($mon == 0 && $year != 0){
                    $sectName = $this->sample_m->enCountY($year);

                    foreach($sectName as $sn){
                        $sectCounts[$sn['ID']] []= $this->sample_m->secCountY($year, $sn['ID']);

                    }
                }
            }else if($type == 2){
                if($mon != 0 && $year != 0){
                    $sectName = $this->sample_m->secGrCountMY($mon, $year);

                    foreach($sectName as $sn){
                        $sectCounts[$sn['ID']] []= $this->sample_m->grCountMY($mon, $year, $sn['ID']);

                    }
                }else if ($mon == 0 && $year != 0){
                    $sectName = $this->sample_m->secGrCountY($year);

                    foreach($sectName as $sn){
                        $sectCounts[$sn['ID']] []= $this->sample_m->grCountY($year, $sn['ID']);

                    }
                }
            }else if($type == 3){
                date_default_timezone_set('Hongkong');
                $dateNow = date("Y-m-d H:i:s");
                if($mon != 0 && $year != 0){
                    $sectName = $this->sample_m->inactSectCountMY($mon, $year, $dateNow);

                    foreach($sectName as $sn){
                        $sectCounts[$sn['ID']] []= $this->sample_m->inactCountMY($mon, $year, $sn['ID'], $dateNow);

                    }
                }else if ($mon == 0 && $year != 0){
                    $sectName = $this->sample_m->inactSectCountY($year, $dateNow);

                    foreach($sectName as $sn){
                        $sectCounts[$sn['ID']] []= $this->sample_m->inactCountY($year, $sn['ID'], $dateNow);

                    }
                }
            }else if($type = 4){
                date_default_timezone_set('Hongkong');
                $dateNow = date("Y-m-d H:i:s");
                $allSects = $this->sample_m->getAllSects();
                 if($mon != 0 && $year != 0){
                   $sumEn = $this->sample_m->sumEnCountMY($mon, $year);
                   $sumGr = $this->sample_m->sumGrCountMY($mon, $year);
                   $sumInact = $this->sample_m->sumInactCountMY($mon, $year, $dateNow);
                   foreach($allSects as $as){
                       $totEn[$as['id']] []= $this->sample_m->secCountMY($mon, $year, $as['id']);
                       $totGr[$as['id']] []= $this->sample_m->grCountMY($mon, $year, $as['id']);
                       $totIn[$as['id']] []= $this->sample_m->inactCountMY($mon, $year, $as['id'], $dateNow);
                   }
                   
                }else if ($mon == 0 && $year != 0){
                   $sumEn = $this->sample_m->sumEnCountY($year);
                   $sumGr = $this->sample_m->sumGrCountY($year);
                   $sumInact = $this->sample_m->sumInactCountY($year, $dateNow); 
                   foreach($allSects as $as){
                       $totEn[$as['id']] []= $this->sample_m->secCountY($year, $as['id']);
                       $totGr[$as['id']] []= $this->sample_m->grCountY($year, $as['id']);
                       $totIn[$as['id']] []= $this->sample_m->inactCountY($year, $as['id'], $dateNow);
                   }

                }
            }
            //print_r($totEn);
            //print_r($sectCounts);
            $this->load->view('admin/sectorStat/load_sectorReport', array('sectName' => $sectName, 'sectCounts' => $sectCounts, 'type' => $type, 'sumEn' => $sumEn, 'sumGr' => $sumGr, 'sumInact' => $sumInact, 'mon' => $mon, 'year' => $year, 'allSects' => $allSects, 'totEn' => $totEn, 'totGr' => $totGr, 'totIn' => $totIn));
        }
        
        public function printRep(){
            $sectID = $this->input->get('sectID');
            $mon = $this->input->get('mon');
            $year = $this->input->get('year');
            $type = $this->input->get('type');
            
            //echo $sectID.' '.$mon.' '.$year.' '.$type;
            
            $this->load->model('sample_m');
            $this->load->model('model_users');
            $this->load->model('syllabus/getSectors');
            $sName = $this->sample_m->getCName($sectID);
            $filename = $sName;
            
            
            
            $sectName = $this->getSectors->getSectTitle($sectID);
            date_default_timezone_set('Hongkong');
            $dateNow = date("Y-m-d H:i:s");
            $cNames = array();
            $sectCounts = array();
            $enrNames = array();
            $enrDets = array();
            $countFollow = '';
            $countReady = '';
            $countCert = '';
            $redi = '';
            $secEnTotal = array();
            $secGrTotal = array();
            $secInTotal = array();
            //$sectName = $this->getSectors->getSectTitle($sectID);
            $coNames = array();
            $totEn = array();
            $totGr = array();
            $totIn = array();
            if($type == 1){
                $cNames = $this->sample_m->getSectCourses($sectID);
                
                    foreach($cNames as $cn){
                        $sectCounts[$cn['id']] []= $this->sample_m->couEnCountMY($mon, $year, $cn['id']);
                        $enrDets[$cn['id']] = $this->sample_m->learnCourseDets($cn['id'], $mon, $year);
                        foreach($enrDets[$cn['id']] as $ed){
                            $enrNames[$ed['learnerID']]= $this->model_users->enrNames($ed['learnerID']);
                        }
                        $countFollow[$cn['id']]= $this->sample_m->countFollow($cn['id'], $mon, $year);
                        $countReady[$cn['id']]= $this->sample_m->countReady($cn['id'], $mon, $year);
                        $countCert[$cn['id']]= $this->sample_m->countCert($cn['id'], $mon, $year);
                    }
                    $redi = 'admin/sector_Sum_Enroll';
               $filename .= ' Sector Summary Enrollee Report.pdf';
            }else if ($type == 2){
                $cNames = $this->sample_m->getSectCourses($sectID);
                
                    foreach($cNames as $cn){
                        $sectCounts[$cn['id']] []= $this->sample_m->couGrCountMY($mon, $year, $cn['id']);
                        $enrDets[$cn['id']] = $this->sample_m->gradCourseDets($cn['id'], $mon, $year);
                        foreach($enrDets[$cn['id']] as $ed){
                            $enrNames[$ed['learnerID']]= $this->model_users->enrNames($ed['learnerID']);
                        }
                    }
                    $redi ='admin/sector_Sum_Graduates'; 
                $filename .= ' Sector Summary Graduate Report.pdf';
            }else if ($type == 3){
                $cNames = $this->sample_m->getSectCourses($sectID);
                
                    foreach($cNames as $cn){
                        $sectCounts[$cn['id']] []= $this->sample_m->couInCountMY($mon, $year, $cn['id'], $dateNow);
                        $enrDets[$cn['id']] = $this->sample_m->inactCourseDets($cn['id'], $dateNow);
                        foreach($enrDets[$cn['id']] as $ed){
                            $enrNames[$ed['learnerID']]= $this->model_users->enrNames($ed['learnerID']);
                        }
                    }
                    $redi ='admin/sector_Sum_Inactive'; 
                $filename .= ' Sector Summary Inactive Report.pdf';
            }else if ($type == 4){
                $coNames = $this->sample_m->getSectCourses($sectID);
                if($mon != 0 && $year != 0){
                    foreach($coNames as $cn){
                        $totEn[$cn['id']] []= $this->sample_m->couEnCountMY($mon, $year, $cn['id']);
                        $totGr[$cn['id']] [] = $this->sample_m->couGrCountMY($mon, $year, $cn['id']);
                        $totIn[$cn['id']] [] = $this->sample_m->couInCountMY($mon, $year, $cn['id'], $dateNow);
                        $secEnTotal[$cn['id']]  []= $this->sample_m->secCountMY($mon, $year, $sectID);
                        $secGrTotal[$cn['id']]  []= $this->sample_m->grCountMY($mon, $year, $sectID);
                        $secInTotal[$cn['id']]  []= $this->sample_m->grCountMY($mon, $year, $sectID, $dateNow);
                    }
                }else if ($mon == 0 && $year != 0){
                    foreach($coNames as $cn){
                        $totEn[$cn['id']] [] = $this->sample_m->couEnCountY($year, $cn['id']);
                        $totGr[$cn['id']] [] = $this->sample_m->couGrCountY($year, $cn['id']);
                        $totIn[$cn['id']] [] = $this->sample_m->couInCountY($year, $cn['id'], $dateNow);
                        $secEnTotal[$cn['id']] [] = $this->sample_m->secCountY($year, $sectID);
                        $secGrTotal[$cn['id']]  []= $this->sample_m->grCountY($year, $sectID);
                        $secInTotal[$cn['id']]  []= $this->sample_m->grCountY($year, $sectID, $dateNow);
                    }
                }
                $redi = 'admin/sector_Sum_all';
                $filename .= ' Sector Summary Report.pdf';
            }
            $pdfFilePath = "uploads/default/CourseReports/".$filename;
            $html = $this->load->view($redi,array('cNames' => $cNames, 'enrDets' => $enrDets, 'sectCounts' => $sectCounts, 'enrNames' => $enrNames, 'countFollow' => $countFollow, 'countReady' => $countReady, 'countCert' => $countCert, 'coNames' => $coNames, 'totEn' => $totEn, 'totGr' => $totGr, 'totIn' => $totIn, 'sectName' => $sectName, 'mon' => $mon, 'year' => $year, 'secEnTotal' => $secEnTotal, 'secGrTotal' => $secGrTotal, 'secInTotal' => $secInTotal) , true); // render the view into HTML
  
          $stylesheet = file_get_contents(site_url('addons/shared_addons/themes/bootstrap/css/mpdfstyletables.css'));

           $this->load->library('pdf');
           $pdf = $this->pdf->load();
           //$pdf->SetHeader('{DATE j-m-Y}|{PAGENO}/2|My document');
//$pdf->SetFooter('{PAGENO}'); 
         $pdf->WriteHTML($stylesheet,1);
           $pdf->WriteHTML($html,2); // write the HTML into the PDF
           $pdf->Output($pdfFilePath); // save to file because we can

                //$data1 = file_get_contents($pdfFilePath); // Read the file's contents 
        if (file_exists($pdfFilePath) ){
        $dl =  file_get_contents($pdfFilePath);
            $this->dl($filename, $dl);
              }
        }
   
 
 public function printAllSect(){
        $mon = $this->input->get('mon');
        $year = $this->input->get('year');
        
        date_default_timezone_set('Hongkong');
        $dateNow = date("Y-m-d H:i:s");
        $allSects = $this->sample_m->getAllSects();
        $sumEn = array();
        $sumGr = array();
        $sumInact = array();
        $totEn = array();
        $totGr = array();
        $totIn = array();
         if($mon != 0 && $year != 0){
           $sumEn = $this->sample_m->sumEnCountMY($mon, $year);
           $sumGr = $this->sample_m->sumGrCountMY($mon, $year);
           $sumInact = $this->sample_m->sumInactCountMY($mon, $year, $dateNow);
           foreach($allSects as $as){
               $totEn[$as['id']] []= $this->sample_m->secCountMY($mon, $year, $as['id']);
               $totGr[$as['id']] []= $this->sample_m->grCountMY($mon, $year, $as['id']);
               $totIn[$as['id']] []= $this->sample_m->inactCountMY($mon, $year, $as['id'], $dateNow);
           }

        }else if ($mon == 0 && $year != 0){
           $sumEn = $this->sample_m->sumEnCountY($year);
           $sumGr = $this->sample_m->sumGrCountY($year);
           $sumInact = $this->sample_m->sumInactCountY($year, $dateNow); 
           foreach($allSects as $as){
               $totEn[$as['id']] []= $this->sample_m->secCountY($year, $as['id']);
               $totGr[$as['id']] []= $this->sample_m->grCountY($year, $as['id']);
               $totIn[$as['id']] []= $this->sample_m->inactCountY($year, $as['id'], $dateNow);
           }

        }
        
        $filename = 'Sector Summary Report';
        $pdfFilePath = "uploads/default/CourseReports/".$filename;
            $html = $this->load->view('admin/sector_sum_all2',array('allSects' => $allSects, 'sumEn' => $sumEn, 'sumGr' => $sumGr, 'sumInact' => $sumInact, 'totEn' => $totEn, 'totGr' => $totGr, 'totIn' => $totIn, 'mon' => $mon, 'year' => $year) , true); // render the view into HTML
  
          $stylesheet = file_get_contents(site_url('addons/shared_addons/themes/bootstrap/css/mpdfstyletables.css'));

           $this->load->library('pdf');
           $pdf = $this->pdf->load();
           //$pdf->SetHeader('{DATE j-m-Y}|{PAGENO}/2|My document');
//$pdf->SetFooter('{PAGENO}'); 
         $pdf->WriteHTML($stylesheet,1);
           $pdf->WriteHTML($html,2); // write the HTML into the PDF
           $pdf->Output($pdfFilePath); // save to file because we can

                //$data1 = file_get_contents($pdfFilePath); // Read the file's contents 
        if (file_exists($pdfFilePath) ){
        $dl =  file_get_contents($pdfFilePath);
            $this->dl($filename, $dl);
              }
 }
 
      
          public function dl ($filename, $dl){
      // $dl =  file_get_contents("uploads/default/xml/".$filename.".pdf");
      force_download($filename.'.pdf',$dl );
     
 }
        
        
   
        
       
}
