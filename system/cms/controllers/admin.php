<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * The admin class is basically the main controller for the backend.
 *
 * @author      PyroCMS Dev Team
 * @copyright   Copyright (c) 2012, PyroCMS LLC
 * @package	 	PyroCMS\Core\Controllers
 */
class Admin extends Admin_Controller
{
	/**
	 * Constructor method
	 */
	public function __construct()
	{
		parent::__construct();

		$this->load->helper('users/user');
	}

	/**
	 * Show the control panel
	 */
	public function index()
	{
		$this->template
			->enable_parser(true)
			->title(lang('global:dashboard'));

		if (is_dir('./installer'))
		{
			$this->template
				->set('messages', array('notice' => '<button id="remove_installer_directory" class="button">'.lang('cp:delete_installer').'</button>'.lang('cp:delete_installer_message')));
		}
                
                $this->load->model('learner/model_users');
                
                $courseReqs = $this->model_users->getCourseReq();
                $sectNames = array();
                foreach($courseReqs as $cReq){
                    $sectNames[$cReq['sectorID']]= $this->model_users->getHeirID($cReq['sectorID']);
                }
                date_default_timezone_set('Hongkong');
                $dateNow = date("Y-m-d H:i:s");
                $registered = $this->model_users->noOfReg(date("Y"));
                $totalReg = $this->model_users->totalReg(date("Y"));
                $inactive = $this->model_users->inactiveCount($dateNow);
                $totalInactive = $this->model_users->totalInactive($dateNow);
                $enrolleesC = $this->model_users->enrollees(date("m"), date("Y"));
                $totalEnrollees = $this->model_users->totEnrollees(date("m"), date("Y"));
                
                $courseInact = array();
                foreach($enrolleesC as $ec){
                    $courseInact[$ec['title']] []=  $this->model_users->courseInact($ec['courseID'], $dateNow);
                }
                $cInact = (object)$courseInact;
                
                $oaPass = $this->model_users->passOA(date("m"), date("Y"));
                $failOA = array();
                foreach($oaPass as $passOA){
                    $failOA[$passOA['title']] []= $this->model_users->failOA($passOA['id'], date("m"), date("Y"));
                }
                $oaFail = (object)$failOA;
                
                $feedbacks = $this->model_users->allFeedbacks();
                $feedLearner = array();
                foreach($feedbacks as $feeds){
                    if($feeds['learnerID'] != NULL){
                        $feedLearner[$feeds['title']] []= $this->model_users->learnerInfo($feeds['learnerID']);
                    }
                }
                
                $failSC = array();
                $passSC = $this->model_users->passSC(date("m"), date("Y"));
                foreach($passSC as $pSC){
                    $failSC[$pSC['title']] []= $this->model_users->failSC($pSC['id'], date("m"), date("Y"));
                }
                $scFail = (object)$failSC;
                
                $this->template
                        ->set('registered', $registered)
                        ->set('totalReg', $totalReg)
                        ->set('inactive', $inactive)
                        ->set('totalInactive', $totalInactive)
                        ->set('cInact', $cInact)
                        ->set('enrolleesC',$enrolleesC)
                        ->set('totalEnrollees',$totalEnrollees)
                        ->set('oaPass',$oaPass)
                        ->set('oaFail',$oaFail)
                        ->set('scFail',$scFail)
                        ->set('passSC',$passSC)
                        ->set('feedbacks',$feedbacks)
                        ->set('feedLearner', $feedLearner)
                        ->set('courseReqs', $courseReqs)
                        ->set('sectNames', $sectNames)
			->build('admin/dashboard');
	}
        
        

	/**
	 * Log in
	 */
	public function login()
	{
		// Set the validation rules
		$this->validation_rules = array(
			array(
				'field' => 'email',
				'label' => lang('global:email'),
				'rules' => 'required|callback__check_login'
			),
			array(
				'field' => 'password',
				'label' => lang('global:password'),
				'rules' => 'required'
			)
		);

		// Call validation and set rules
		$this->load->library('form_validation');
		$this->form_validation->set_rules($this->validation_rules);

		// If the validation worked, or the user is already logged in
		if ($this->form_validation->run() or $this->ion_auth->logged_in())
		{
			// if they were trying to go someplace besides the 
			// dashboard we'll have stored it in the session
			$redirect = $this->session->userdata('admin_redirect');
			$this->session->unset_userdata('admin_redirect');

			redirect($redirect ? $redirect : 'admin');
		}

		$this->template
			->set_layout(false)
			->build('admin/login');
	}

	/**
	 * Logout
	 */
	public function logout()
	{
		$this->load->language('users/user');
		$this->ion_auth->logout();
		$this->session->set_flashdata('success', lang('user:logged_out'));
		redirect('admin/login');
	}

	/**
	 * Callback From: login()
	 *
	 * @param string $email The Email address to validate
	 *
	 * @return bool
	 */
	public function _check_login($email)
	{
		if ($this->ion_auth->login($email, $this->input->post('password'), (bool)$this->input->post('remember')))
		{
			Events::trigger('post_admin_login');
			
			return true;
		}

		Events::trigger('login_failed', $email);
		error_log('Login failed for user '.$email);

		$this->form_validation->set_message('_check_login', $this->ion_auth->errors());
		return false;
	}

	/**
	 * Display the help string from a module's
	 * details.php file in a modal window
	 *
	 * @param	string	$slug	The module to fetch help for
	 *
	 * @return	void
	 */
	public function help($slug)
	{
		$this->template
			->set_layout('modal', 'admin')
			->set('help', $this->module_m->help($slug))
			->build('admin/partials/help');
	}

	public function remove_installer_directory()
	{
		if ( ! $this->input->is_ajax_request())
		{
			die('Nope, sorry');
		}

		header('Content-Type: application/json');

		if (is_dir('./installer'))
		{
			$this->load->helper('file');
			// if the contents of "installer" delete successfully then finish off the installer dir
			if (delete_files('./installer', true) and count(scandir('./installer')) == 2)
			{
				rmdir('./installer');
				// This is the end, tell Sally I loved her.
				die(json_encode(array('status' => 'success', 'message' => lang('cp:delete_installer_successfully_message'))));
			}
		}

		die(json_encode(array('status' => 'error', 'message' => lang('cp:delete_installer_manually_message'))));
	}
        
        public function emailSlack(){
            $this->load->model('learner/model_users');
            
            $inactID = $this->model_users->inactLearnerID();
            $inactLearners = array();
            foreach($inactID as $inact){
                $inactLearners []= $this->model_users->inactLearner($inact['learnerID']);
            }
            
            foreach($inactLearners as $il){
                if($il['fbusername'] != NULL AND $il['userpassword'] != NULL){
                    Events::trigger('email', array(
                    'slug' => 'inactive-users', //email template slu
                    'to' => $il['fbusername'].'facebook.com',
                    'from' => Settings::get('server_email'),
                 // param sa email template
                          ), 'array');
                }else{
                    Events::trigger('email', array(
                    'slug' => 'inactive-users', //email template slu
                    'to' => $il['email'],
                    'from' => Settings::get('server_email'),
                 // param sa email template
                          ), 'array');
                }
            }
            
            redirect('admin');
        }
}