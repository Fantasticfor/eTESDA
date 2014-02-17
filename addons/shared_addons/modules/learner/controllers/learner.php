<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a sample module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	Sample Module
 */
class Learner extends Public_Controller
{
	public function __construct()
	{
		parent::__construct();

		// Load the required classes
		$this->load->model('model_users');
		$this->lang->load('sample');
                $this->load->helper('download');
                $this->load->helper('file'); 
		$this->template
			->append_css('module::sample.css')
			->append_js('module::sample.js');
	}

	/**
	 * All items
	 */
	public function index($offset = 0)
	{
		// set the pagination limit
		
		$this->template
			->title($this->module_details['name'], 'the rest of the page title')
			->build('learn_dashboard_v2');
	}
        
        public function login(){
            $this->template
                    ->set('error','')
                    ->build('login');
            
        }
        
        public function error_login($error){
            $this->template
                    ->set('error',$error)
                    ->build('login');
            
        }
        
        public function dashboard(){
            
            $userid = $this->session->userdata('userid');
            //print_r($userid);
            // get user information
            // set to template
          
            $this->load->model('model_users');
            $this->load->model('syllabus/getCourses');
            $this->load->model('syllabus/getModules');
            $this->load->model('syllabus/getSectors');
            
            //Online Assessments Available
            
            
            $learnerOA = $this->model_users->getOA($userid);
            $sectorTitles = array();
            
            foreach ($learnerOA as $LOA){
                     
                     $sectorTitles []= $this->getSectors->getSectorName($LOA['id']);
            }
            //Online Assessments Taken
            $finishedOA = $this->model_users->finishedOA($userid);
            
            $fCDetails = array();
            $fSectorTitles = array();
            foreach($finishedOA as $FOA){
                $fCDetails []= $this->getCourses->getCourseDetails($FOA);
            }
            foreach($fCDetails as $fcd){
                $fSectorTitles []= $this->getSectors->getSectorName($fcd[0]['ID']);
            }
           
            // Courses Currently Being Taken
            $learnerCourses = $this->getCourses->getLearnerCourses($userid);
            $learnCourses = $this->getCourses->allLCourses($userid);
            $passedSC = array();
            $popover = array();
            $finishedM = array();
            $modCount = array();
            $fModuleIDs = array();
            $scSectors = array();
            $courseDet = array();
            $courseDeta = array();
            $mods = array();
            foreach($learnCourses as $alc){
                $courseDeta []= $this->getCourses->getCourseDetails($alc['id']);
            }
            foreach ($learnerCourses as $LC){
                if($this->session->userdata('userid') != NULL){
                        $passedSC[$LC] []= $this->model_users->countPassSC($LC, $this->session->userdata('userid'));
                }
                $courseDet []= $this->getCourses->getCourseDetails($LC);
                $modCount []= $this->getModules->countMods($LC);
                $fModuleIDs []= $this->getModules->finishedModID($userid, $LC);
                $finishedM []= $this->getModules->finishedModCount($userid, $LC);
                $popover []= $this->getModules->trackPopout($userid, $LC);
            }
            
            foreach ($courseDeta as $cDet){
                $scSectors []= $this->getSectors->getSectorName($cDet[0]['ID']);
            }
            
            //print_r($courseDet);
            
            foreach($courseDet as $cd){
               $mods[$cd[0]['title']] []= $this->getModules->getModuleDetails($cd[0]['ID']); 
            }
       
            $modTitles = (object) $mods;
            $lesCount = array();
            foreach($courseDet as $cDet){
                foreach($modTitles->$cDet[0]['title'] as $mTitle){
                    foreach($mTitle as $mt){
                            $lesCount[$mt['id']] = $this->getLessons->lesCount($mt['id']);
                    }
                }
            }
            //print_r($lesCount);
            //Courses Finished
            $finishedCourses = $this->getCourses->getFinishedCourses($userid);
            
            $fModCount = array();
            $fCourseDet = array();
            $fMods = array();
            foreach ($finishedCourses as $FC){
                $fCourseDet []= $this->getCourses->getCourseDetails($FC);
                $fModCount []= $this->getModules->countMods($FC);
            }
            foreach($fCourseDet as $fcd){
               $fMods[$fcd[0]['title']] []= $this->getModules->getModuleDetails($fcd[0]['ID']);  
            }
            
            $fModTitles = (object) $fMods;
            //print_r($fModTitles);
            
            
            print_r($fModuleIDs);
            $userInfo = $this->model_users->getInfo($userid);
            $userAdd = $this->model_users->getAddress($userid);
            $this->template
                    ->set('popover', $popover)
                    ->set('userInfo', $userInfo)
                    ->set('userAdd', $userAdd)
                    ->set('learnerOA', $learnerOA)
                    ->set('sectorTitles', $sectorTitles)
                    ->set('fCDetails', $fCDetails)
                    ->set('scSectors', $scSectors)
                    ->set('fSectorTitles', $fSectorTitles)
                    ->set('fCourseDet', $fCourseDet)
                    ->set('fModTitles', $fModTitles)
                    ->set('courseDet', $courseDet)
                    ->set('courseDeta', $courseDeta)
                    ->set('modTitles', $modTitles)
                    ->set('modCount', $modCount)
                    ->set('fModCount', $fModCount)
                    ->set('fModuleIDs', $fModuleIDs)
                    ->set('finishedM', $finishedM)
                    ->set('passedSC', $passedSC)
                    ->set('learnCourses', $learnCourses)
                    ->build('learn_dashboard');
        }
        
         public function register(){
            $this->template
                    ->set('error','')
                    ->build('register');
 
            }
        
        public function register_error($validation_message){
            $this->template
                    ->set('error',$validation_message)
                    ->build('register');
            
 
            }
            
             public function onlineAssessment(){
            $this-> template->build('learn_myOnlineAsessement');
            
            
        }
         public function testAssessment(){
            $this-> template->build('test_onlineAssessment');
         }
         public function testSelfCheck(){
            $this-> template->build('test_SelfCheck');
         }
         public function resultSelfCheck(){
            $this-> template->build('results_SelfCheck');
         }
         
         public function logout(){
            $this->session->sess_destroy();
            redirect(index_page());
        }
         
         ////////////////////////////////////////////LOGIN & SIGNUP///////////////////////////////////////////////////
         
          public function login_validation(){//validates login
            
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('email','Email','required|trim|xss_clean|valid_email|callback_validate_credentials');
            $this->form_validation->set_rules('password','Password','required|md5|trim');
           
         
        
            
            if($this->form_validation->run()){// true if above has no errors
                
                //get user data
                $this->load->model('model_users');

                $profile = $this->model_users->get_user($this->input->post('email'), $this->input->post('password'));
                //print_r($profile);
                if(!empty($profile)){
                if($profile['user']->status == 0){
                    $this->error_login('Please confirm your account before logging in');
                   
                }else{
                /* set to session */
                 $data = array(
                   'userid' => $profile['profile']['userid'],
                   'fbuser' => 0,
                   'is_logged_in' => 1 // laging ganto for checker kung nakalogin
               );
                $this->session->set_userdata($data);
                
                //redirect('main/dashboard'); // Palitan mo nalang kung saan ireredirect na view
                
                //$this->dashboard();
                 redirect('learner/dash2');
                }
                }
            }else // Ako na bahala dito :))
            {
                $data['validationerror'] = validation_errors();
            $this->error_login(validation_errors());    
            //echo "REDIRECT SA PAGE PASSING THE DATA".  validation_errors().$this->input->post('password');
            }
            
           
        }
        
        public function signup_validation(){//validates signup
           
            $this->load->library('form_validation');
          
            
           // $this->form_validation->set_rules('username','Username','required|trim|is_unique[users.username]|');
           
            $this->form_validation->set_rules('fname','First Name','required|trim');
            $this->form_validation->set_rules('mname','Middle Name','required|trim');
            $this->form_validation->set_rules('lname','Last Name','required|trim');
           // $this->form_validation->set_rules('homeadd','Home Address','required|trim');
            $this->form_validation->set_rules('password','Password','required|trim');
            $this->form_validation->set_rules('cpassword','Confirm Password','required|trim|matches(password)');
            $this->form_validation->set_rules('email','Email','required|trim|valid_email|callback_email_valid|', $this->input->post('email'));
            
            
            
            if($this->form_validation->run()){
             //generate a random key
                $key = md5(uniqid());
                
                $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
                'smtp_timeout'=>'30',
                'smtp_user' => 'secret.secret.secret.12345@gmail.com',
                'smtp_pass' => '',
                'mailtype'  => 'html', 
                'charset'   => 'utf-8'
                );
                
                $this->load->library('email', $config);//by default it is text
                $this->email->set_newline("\r\n");
                $this->load->model('model_users');
                
                $this->email->from('try@etesda.com','Secret');
                $this->email->to($this->input->post('email'));
                $this->email->subject('Account Confirmation.');
                
                
                
                $message = "<p> Click the link to confirm your registration ";
                $message2 = "<p><a href='".base_url()."learner/register_user/$key' >Click here</a></p>";
                
           
               
                
               
                //send an email
                    //add them to the tem_users db
                if($this->model_users->add_temp_user($key)){
                    
                      $this->email->message($message.$message2);
//                       
//                      if ($this->email->send()){
                            
//                            echo "Sent!";
//                             echo $this->email->print_debugger();
//                            echo $this->email->print_debugger();
//                            echo $this->input->post('email');
                            //redirect to page na telling to check email for confirmation
                           Events::trigger('email', array(
                     'slug' => 'confirmation-email', //email template slu
                    'to' => $this->input->post('email'),
                    'from' =>  Settings::get('server_email'),
                     'first_name' => $this->input->post('fname'),
                    'activation_code'=> $key// param sa email template
                          ), 'array');
                          
                           redirect('learner/confirm_account');
//                      }else{
//                          echo "not sent";
//                          echo $this->email->print_debugger();
//                          //resend
//                          
//                      }
                }else{
                    $this->register_error('An error has occured, please try again');
                    //redirect to error pae "An error occured pls try again"
                }      
                
            }else {
                //echo "No pass";
                //pass validation errors
                $this->register_error(validation_errors());
            }
            
        }
        
        public function confirm_account(){
            $this->template->build('page_confirmation');
        }
        
        public function register_user($key){
            $this->load->model('model_users');
          
            if($this->model_users->is_key_valid($key)){
                if($this->model_users->add_user($key)){//set user session here
                   

                    redirect(index_page());
                }else echo "failed"; // error page
            }else $this->register_error('Invalid Key'); // error 
                
        }
        
         public function validate_credentials(){//validation of login -> username
            $this->load->model('model_users');
            
            if($this->model_users->can_log_in()){
                
                return true;
            }
            else{
                $this->form_validation->set_message('validate_credentials','Incorrect username/password'); //setting the message for the function form_validation
                return false;
            }
        }
        
        public function email_valid(){
            $this->load->model('model_users');
            
            if($this->model_users->email_valid()){
                
                return true;
            }
            else{
               $this->form_validation->set_message('email_valid',"The email address is already used."); //setting the message for the function form_validation
                return false;
            }
        }
 
        public function facebook_request(){
            
            $this->load->library('fbconnect');
            
            $data = array(
              'redirect_uri' => site_url('learner/handle_facebook_login'),  
              'scope' => 'user_relationships,user_birthday,email,publish_stream' 
            );
            
            redirect($this->fbconnect->getLoginUrl($data));
            
        }
        
        public function handle_facebook_login(){
           
            $this->load->library('fbconnect');
            $this->load->model('model_users');
            $facebook_user = $this->fbconnect->user;
            
            if($this->fbconnect->user){
                //print_r($facebook_user);
                 if($this->model_users->is_member($facebook_user)){
                     
                    $profile = $this->model_users->log_in($facebook_user);
                    
                     /* set to session */
                 $data = array(
                     'userid' => $profile['userid'],
                     'fbuser' => 1,
                     //ADDRESS
                   'is_logged_in' => 1
                    
               );
                $this->session->set_userdata($data);
                     redirect('learner/dash2');
                    //print_r($facebook_user);
                    
                    
                 }else{
                     
                     $this->model_users->sign_up($facebook_user);
                     $profile =$this->model_users->log_in($facebook_user);
                      $data = array(
                     'userid' => $profile['userid'],
                     'fbuser' => 1,
                   'is_logged_in' => 1
                          
               );
                $this->session->set_userdata($data);
                     redirect('learner/dash2');
                 }
                
                
            }else{
                redirect('learner/login');
            }
            
        }
        
        
        public function displayOA(){
            $this->load->model('model_users');
            $this->load->model('syllabus/getSectors');
            
            $learnerOA = $this->model_users->getOA($this->session->userdata('userid'));
            
             foreach ($learnerOA as $LOA){
                $sectorTitles []= $this->getSectors->getSectorName($LOA['id']);
            }
            
            //print_r($sectorTitles);
            
           // $this->template
                //    ->set('learnerOA', $learnerOA)
                 //   ->set('sectorTitles', $sectorTitles)
                 //   ->build('content_myTest');
        }
        public function test(){
            
            $this->template->build('content_myTest');
            
        }
        
        public function scResults($courseID){
            $this->load->model('model_users');
            $this->load->model('syllabus/getCourses');
            
            $course = $this->getCourses->getCourse($courseID);
            $latDate = $this->model_users->latDateSC($courseID, $this->session->userdata('userid'));
            
            
            $latSC = array();
            foreach($latDate as $ld){
                $latSC []= $this->model_users->modSC($this->session->userdata('userid'), $courseID, $ld['latest']);
            }
            $attempts = array();
            foreach($latSC as $lsc){
                foreach($lsc as $latest){
                     $attempts[$latest['title']] []= $this->model_users->scAttempts($this->session->userdata('userid'), $latest['id'] );
                }
               
            }
                
            
            $this->template
                    ->set('course', $course)
                    ->set('attempts', (object)$attempts)
                    ->set('latSC', $latSC)
                    ->build('view_SelfCheck');
        }
        
        public function viewSCHistory(){
          $moduleID = $_POST['post_id'];
          $this->load->model('model_users');
          //print_r($moduleID);
           $history = $this->model_users->scHistory($this->session->userdata('userid'), $moduleID);
           $this->load->view('modal_ViewSelfCheck', array('scHis' => $history) );
        }
        
        public function viewResultsOA($courseID){
         $this->load->model('model_users');
         $this->load->model('syllabus/getCourses');
         
         $course = $this->getCourses->getCourse($courseID);
         $allOA = $this->model_users->allOA($this->session->userdata('userid'), $courseID);
         $this->template
                 ->set('course', $course)
                 ->set('allOA', $allOA)
                 ->build('view_resultsOA');
            
        }
        public function modal_viewResultsOA(){
            $resultID = $_POST['post_id'];
            $this->load->model('model_users');
            //print_r($resultID);
            $secResults = $this->model_users->oaSect($this->session->userdata('userid'), $resultID);
            $this->load->view('modal_viewResultsOA', array('secResults' => $secResults));
            
        }
        
        public function learnerFeedback(){
            $this->template->build('learnerFeedback');
        }
        
        public function getFeedback(){
            $this->load->model('model_users');
            date_default_timezone_set('Hongkong');
            
            $title = $this->input->post('title');
            $feedback = $this->input->post('feedback');
                
            if($this->session->userdata('userid') == NULL){
                $email = $this->input->post('email');
                $this->model_users->unregisteredFeedback($title, $feedback, $email, date("Y-m-d H:i:s"));
                redirect ('syllabus/index');
            }else{
                $this->model_users->learnerFeedback($title, $feedback, $this->session->userdata('userid'), date("Y-m-d H:i:s"));
                redirect ('learner/dash2');
            }
            
        }
        
        public function endorsePage(){
            
            $this->load->view('learner/endorsePage');
        }
             
        public function dash2(){
            
            $userid = $this->session->userdata('userid');
            //print_r($userid);
            // get user information
            // set to template
          
            $this->load->model('model_users');
            $this->load->model('syllabus/getCourses');
            $this->load->model('syllabus/getModules');
            $this->load->model('syllabus/getSectors');
            $this->load->model('syllabus/getLessons');
            
            //Online Assessments Available
            
            
            $learnerOA = $this->model_users->getOA($userid);
            $sectorTitles = array();
            $badgeName = $this->model_users->compPBad();
            $badgeImg = $this->model_users->compPBadImg();
            foreach ($learnerOA as $LOA){
                     
                     $sectorTitles []= $this->getSectors->getSectorName($LOA['id']);
            }
            //Online Assessments Taken
            $finishedOA = $this->model_users->finishedOA($userid);
            
            $fCDetails = array();
            $fSectorTitles = array();
            foreach($finishedOA as $FOA){
                $fCDetails []= $this->getCourses->getCourseDetails($FOA);
            }
            foreach($fCDetails as $fcd){
                $fSectorTitles []= $this->getSectors->getSectorName($fcd[0]['ID']);
            }
            $profArr = $this->model_users->ifProfDone($userid);
            // Courses Currently Being Taken
            $learnerCourses = $this->getCourses->getLearnerCourses($userid);
            $learnCourses = $this->getCourses->allLCourses($userid);
            $passedSC = array();
            $popover = array();
            $finishedM = array();
            $modCount = array();
            $fModuleIDs = array();
            $scSectors = array();
            $courseDet = array();
            $courseDeta = array();
            $mods = array();
            $modCount2 = array();
            $finishedM2 = array();
            $enCourseDets = array();
            foreach($learnCourses as $alc){
                $courseDeta []= $this->getCourses->getCourseDetails($alc['id']);
                $enCourseDets[$alc['id']]= $this->getCourses->allLCoursesDets($userid, $alc['id']);
                $modCount2 []= $this->getModules->countMods($alc['id']);
                $finishedM2 []= $this->getModules->finishedModCount($userid, $alc['id']);
            }
            foreach ($learnerCourses as $LC){
                if($this->session->userdata('userid') != NULL){
                        $passedSC[$LC] []= $this->model_users->countPassSC($LC, $this->session->userdata('userid'));
                }
                $courseDet []= $this->getCourses->getCourseDetails($LC);
                $modCount []= $this->getModules->countMods($LC);
                $fModuleIDs []= $this->getModules->finishedModID($userid, $LC);
                $finishedM []= $this->getModules->finishedModCount($userid, $LC);
                $popover[$LC] []= $this->getModules->trackPopout($userid, $LC);
            }
            //print_r($courseDeta);
            foreach ($courseDeta as $cDet){
                $scSectors []= $this->getSectors->getSectorName($cDet[0]['ID']);
            }
            $compDet = $this->model_users->getCompDets($userid);
            //print_r($userid);
            //print_r($courseDet);
            $lastP = array();
            $ds = array();
            foreach($courseDet as $cd){
               $mods[$cd[0]['ID']] []= $this->getModules->getModuleDetails($cd[0]['ID']);
               $lastP[$cd[0]['title']] []=  $this->model_users->lastProg($userid, $cd[0]['ID']);
               $ds[$cd[0]['title']] []= $this->model_users->startDate($userid, $cd[0]['ID']);
            }
            $dateStarted = (object)$ds;
            $lastP2 = (object)$lastP;
            $mods2 = array();
            $mods3 = array();
            $lateDate = array();
            $ratings = array();
            $dur = array();
            foreach($courseDeta as $cda){
                $mods2[$cda[0]['title']] []= $this->getModules->getModuleDetails($cda[0]['ID']);  
                $mods3[$cda[0]['ID']] []= $this->getModules->getModuleDetails($cda[0]['ID']); 
                foreach($mods3[$cda[0]['ID']] as $modIDss){
                    foreach($modIDss as $modIDs){
                        $lateDate []= $this->model_users->latSC($userid, $modIDs['id']);
                        $dur[$modIDs['id']]= $this->model_users->getDur($userid, $modIDs['id']);
                        foreach($lateDate as $ld){
                            foreach($ld as $latestD){
                                $ratings[$modIDs['id']]= $this->model_users->moduleSC($userid, $modIDs['id'], $latestD['latest']);
                            }
                        }
                    }
                }
            }
            //print_r($ratings);
            //print_r($ratings);
            //$modTitles = (object) $mods;
            $modTitles2 = (object) $mods2;
            
            $lesCount = array();
            $finLesCount = array();
            $latDate = array();
            $modSC = array();
            $latestSC = array();
            foreach($courseDet as $cDets){
                foreach($mods[$cDets[0]['ID']] as $mTitle){
                    foreach($mTitle as $mt){
                            $lesCount[$mt['id']] = $this->getLessons->lesCount($mt['id']);
                            $finLesCount[$mt['id']] = $this->getLessons->countFinLes($userid, $mt['id']);
                            
                            $latestSC []= $this->model_users->getRes($this->session->userdata('userid'), $mt['id']);
                            
                    }
                }
            }
            //Courses Finished
            $finishedCourses = $this->getCourses->getFinishedCourses($userid);
            
            $fModCount = array();
            $fCourseDet = array();
            $fMods = array();
            foreach ($finishedCourses as $FC){
                $fCourseDet []= $this->getCourses->getCourseDetails($FC);
                $fModCount []= $this->getModules->countMods($FC);
            }
            foreach($fCourseDet as $fcd){
               $fMods[$fcd[0]['title']] []= $this->getModules->getModuleDetails($fcd[0]['ID']);  
            }
            
            $fModTitles = (object) $fMods;
            //print_r($fModTitles);
            
            //print_r($fModuleIDs);
            
            $finishedModules = $this->getModules->doneMods($this->session->userdata('userid'));
            //print_r($finishedModules);
            
//            date_default_timezone_set('Hongkong');
//            $dateNow = date("Y-m-d H:i:s");
//            $allActs = $this->model_users->recentActs($dateNow, $this->session->userdata('userid'));
//            print_r($allActs);
            
            $badgeEarned = $this->model_users->badgeEarned($userid);
            //print_r($badgeEarned);
            $userInfo = $this->model_users->getInfo($userid);
            $userAdd = $this->model_users->getAddress($userid);
            $this->template
                    ->set('popover', $popover)
                    ->set('userInfo', $userInfo)
                    ->set('userAdd', $userAdd)
                    ->set('learnerOA', $learnerOA)
                    ->set('sectorTitles', $sectorTitles)
                    ->set('fCDetails', $fCDetails)
                    ->set('scSectors', $scSectors)
                    ->set('fSectorTitles', $fSectorTitles)
                    ->set('fCourseDet', $fCourseDet)
                    ->set('fModTitles', $fModTitles)
                    ->set('courseDet', $courseDet)
                    ->set('courseDeta', $courseDeta)
                    ->set('modTitles', $mods)
                    ->set('modTitles2', $modTitles2)
                    ->set('modCount', $modCount)
                    ->set('modCount2', $modCount2)
                    ->set('fModCount', $fModCount)
                    ->set('fModuleIDs', $fModuleIDs)
                    ->set('finishedM', $finishedM)
                    ->set('finishedM2', $finishedM2)
                    ->set('passedSC', $passedSC)
                    ->set('lesCount', $lesCount)
                    ->set('finLesCount', $finLesCount)
                    ->set('modSC', $modSC)
                    ->set('latestSC', $latestSC)
                    ->set('finishedModules', $finishedModules)
                    ->set('enCourseDets', $enCourseDets)
                    ->set('ratings', $ratings)
                    ->set('dur', $dur)
                    ->set('lastP2', $lastP2)
                    ->set('dateStarted', $dateStarted)
                    ->set('badgeEarned', $badgeEarned)
                    ->set('compDet', $compDet)
                    ->set('profArr', $profArr)
                    ->set('badgeName', $badgeName)
                    ->set('badgeImg', $badgeImg)
                    ->build('learn_dashboard_v2');
         
       }
       
        public function saveCHModal(){
            $this->load->model('model_users');
            $learnerID = $this->session->userdata('userid');
            $fName = $this->input->post('fname');
            $mName = $this->input->post('mname');
            $lName = $this->input->post('lname');
            $cpNum = $this->input->post('cpNum');
            $bday = $this->input->post('bday');
            $mName = $this->input->post('mname');
            $houseNo = $this->input->post('houseNo');
            $brgy = $this->input->post('brgy');
            $dist = $this->input->post('dist');
            $city = $this->input->post('city');
            $country = $this->input->post('country');
            
            $this->model_users->upAppProf($learnerID, $fName, $mName, $lName, $cpNum, $bday);
            $this->model_users->upAddProf($learnerID, $houseNo, $brgy, $dist, $city, $country);
            
            redirect('learner/dash2');
            
            
      }
  
       
       public function printPDF($courseID){
           $this->load->model('model_users');
           $this->load->model('syllabus/getModules');
           $this->load->model('syllabus/getCourses');
           
           $courseDet = $this->model_users->repGetCourse($this->session->userdata('userid'), $courseID);
            $filename= $courseDet[0]['title'].' Course Report.pdf';
            $pdfFilePath = "uploads/default/CourseReports/".$filename;
            $userPics = $this->model_users->getPics($this->session->userdata('userid'));
            //$pdfFilePath = FCPATH."$filename.pdf";
            $learnName = $this->model_users->fullName($this->session->userdata('userid'));
            $mods = $this->getModules->getModuleDetails($courseID);
            $enCourseDets = $this->getCourses->allLCoursesDets($this->session->userdata('userid'), $courseID);
            $oaRes = array();
            $oaSect = array();
            $stat = $this->model_users->getStat($this->session->userdata('userid'), $courseID);
            $latestOA []= $this->model_users->latOA($courseID, $this->session->userdata('userid'), $courseID);
            foreach($latestOA as $latOA){
                foreach($latOA as $latest){
                    $oaRes []= $this->model_users->oaRes($this->session->userdata('userid'), $courseID, $latest['latest']);
                    $oaSect []= $this->model_users->sectRes($this->session->userdata('userid'), $courseID, $latest['latest']);
                }
            }
            
            $allBadges = $this->model_users->allBadges($courseID, $this->session->userdata('userid'));
            $cmName = array();
            foreach($allBadges as $ab){
                if($ab['module'] == NULL){
                    $cmName[$ab['course']][]= $this->model_users->getCourseName($ab['course']);
                }else{
                    $cmName[$ab['course']][]= $this->model_users->getModName($ab['module']);
                }
                
            }
            
            $lateDate = array();
            $dur = array();
            $ratings = array();
            foreach($mods as $modIDss){
                        $lateDate []= $this->model_users->latSC($this->session->userdata('userid'), $modIDss['id']);
                        $dur[$modIDss['id']]= $this->model_users->getDur($this->session->userdata('userid'), $modIDss['id']);
                        foreach($lateDate as $ld){
                            foreach($ld as $latestD){
                                $ratings[$modIDss['id']]= $this->model_users->moduleSC($this->session->userdata('userid'), $modIDss['id'], $latestD['latest']);
                            
                        }
                    }
                }
             
    $html = $this->load->view('CourseReport',array('courseDet' => $courseDet, 'mods' => $mods, 'lateDate' => $lateDate, 'dur' => $dur, 'ratings' => $ratings, 'enCourseDets' => $enCourseDets, 'learnName' => $learnName, 'oaRes' => $oaRes, 'oaSect' => $oaSect, 'stat' => $stat, 'userPics' => $userPics, 'allBadges' => $allBadges, 'cmName' => $cmName) , true); // render the view into HTML
  
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
       
       public function redLes($moduleID){
           $this->load->model('model_users');
           $lesID = $this->model_users->getFirstLes($moduleID);
           redirect('syllabus/displayTopic/'.$lesID);
       }
       
       
      public function printPDFz($courseID){
           $this->load->model('model_users');
           $this->load->model('syllabus/getModules');
           $this->load->model('syllabus/getCourses');
           
           $courseDet = $this->model_users->repGetCourse($this->session->userdata('userid'), $courseID);
            $filename= $courseDet[0]['title'].' Course Report.pdf';
            $pdfFilePath = "uploads/default/CourseReports/".$filename;
            //$pdfFilePath = FCPATH."$filename.pdf";
            $learnName = $this->model_users->fullName($this->session->userdata('userid'));
            $mods = $this->getModules->getModuleDetails($courseID);
            $enCourseDets = $this->getCourses->allLCoursesDets($this->session->userdata('userid'), $courseID);
            $oaRes = array();
            $oaSect = array();
            $stat = $this->model_users->getStat($this->session->userdata('userid'), $courseID);
            $latestOA []= $this->model_users->latOA($courseID, $this->session->userdata('userid'), $courseID);
            foreach($latestOA as $latOA){
                foreach($latOA as $latest){
                    $oaRes []= $this->model_users->oaRes($this->session->userdata('userid'), $courseID, $latest['latest']);
                    $oaSect []= $this->model_users->sectRes($this->session->userdata('userid'), $courseID, $latest['latest']);
                }
            }
            
            $lateDate = array();
            $dur = array();
            $ratings = array();
            foreach($mods as $modIDss){
                        $lateDate []= $this->model_users->latSC($this->session->userdata('userid'), $modIDss['id']);
                        $dur[$modIDss['id']]= $this->model_users->getDur($this->session->userdata('userid'), $modIDss['id']);
                        foreach($lateDate as $ld){
                            foreach($ld as $latestD){
                                $ratings[$modIDss['id']]= $this->model_users->moduleSC($this->session->userdata('userid'), $modIDss['id'], $latestD['latest']);
                            
                        }
                    }
                }
             
     $this->load->view('CourseReport',array('courseDet' => $courseDet, 'mods' => $mods, 'lateDate' => $lateDate, 'dur' => $dur, 'ratings' => $ratings, 'enCourseDets' => $enCourseDets, 'learnName' => $learnName, 'oaRes' => $oaRes, 'oaSect' => $oaSect, 'stat' => $stat) ); // render the view into HTML
  
      }
        
        
        
}