<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Example Plugin
 *
 * Quick plugin to demonstrate how things work
 *
 * @author		PyroCMS Dev Team
 * @package		PyroCMS\Addon\Plugins
 * @copyright	Copyright (c) 2009 - 2010, PyroCMS
 */
class Plugin_Example extends Plugin
{
	public $version = '1.0.0';

	public $name = array(
		'en'	=> 'Example'
	);

	public $description = array(
		'en'	=> 'Example of PyroCMS plugin structure.'
	);

	/**
	 * Returns a PluginDoc array that PyroCMS uses 
	 * to build the reference in the admin panel
	 *
	 * All options are listed here but refer 
	 * to the Blog plugin for a larger example
	 *
	 * @return array
	 */
	public function _self_doc()
	{
		$info = array(
			'hello' => array(
				'description' => array(// a single sentence to explain the purpose of this method
					'en' => 'A simple "Hello World!" example.'
				),
				'single' => true,// will it work as a single tag?
				'double' => false,// how about as a double tag?
				'variables' => '',// list all variables available inside the double tag. Separate them|like|this
				'attributes' => array(
					'name' => array(// this is the name="World" attribute
						'type' => 'text',// Can be: slug, number, flag, text, array, any.
						'flags' => '',// flags are predefined values like asc|desc|random.
						'default' => 'World',// this attribute defaults to this if no value is given
						'required' => false,// is this attribute required?
					),
				),
			),
		);
	
		return $info;
	}

	/**
	 * Hello
	 *
	 * Usage:
	 * {{ example:hello }}
	 *
	 * @return string
	 */
	function hello()
	{
		$name = $this->attribute('name', 'World');
		
		return 'Hello '.$name.'!';
	}
        
        function logged_in(){
            if($this->session->userdata('is_logged_in')){
                return true;
            }else false;
        }
        
        function display_name(){
            $this->load->model('learner/model_users');
            return $this->model_users->get_name($this->session->userdata('userid'));
        }
        
        function recAct(){
            $this->load->model('learner/model_users');
            date_default_timezone_set('Hongkong');
            $dateNow1 = date("Y-m-d H:i:s");
            $allActs = $this->model_users->recentActs($dateNow1, $this->session->userdata('userid'));
            $dateNow = new DateTime(date("Y-m-d H:i:s"));
            $allLi = '';
            if(empty($allActs)){
                $allLi .= "<li>You Have No Recent Activities</li>" ;
            }else{
                
                foreach($allActs as $aa){
                    $dateDone = new DateTime($aa['dateDone']);
                    $interv = '';
                    if($dateNow->diff($dateDone)->format("%m") > 0){     
                        if($dateNow->diff($dateDone)->format("%m") == 1 || $dateNow->diff($dateDone)->format("%m") == 0){
                            $interv = $dateNow->diff($dateDone)->format("%m").' month ago';
                        }else{
                            $interv = $dateNow->diff($dateDone)->format("%m").' months ago';
                        }
                        
                    }elseif($dateNow->diff($dateDone)->format("%s") > 0 && $dateNow->diff($dateDone)->format("%i") == 0){
                            if($dateNow->diff($dateDone)->format("%s") == 1 || $dateNow->diff($dateDone)->format("%s") == 0){ 
                               $interv = $dateNow->diff($dateDone)->format("%s").' second ago';
                            }else{
                               $interv = $dateNow->diff($dateDone)->format("%s").' seconds ago';
                           
                            }
                    }elseif($dateNow->diff($dateDone)->format("%d") == 0 && $dateNow->diff($dateDone)->format("%H") == 0){     
                        if($dateNow->diff($dateDone)->format("%i") == 1 || $dateNow->diff($dateDone)->format("%i") == 0){
                            $interv = $dateNow->diff($dateDone)->format("%i").' minute ago';
                        }else{
                            $interv = $dateNow->diff($dateDone)->format("%i").' minutes ago';
                        }
                   }elseif($dateNow->diff($dateDone)->format("%H") >= 1 && $dateNow->diff($dateDone)->format("%i") >= 0 && $dateNow->diff($dateDone)->format("%d") == 0){
                        if($dateNow->diff($dateDone)->format("%H") == 1){ 
                            $interv = $dateNow->diff($dateDone)->format("%H").' hour ago';
                        }else{
                            $interv = $dateNow->diff($dateDone)->format("%H").' hours ago';
                        }
                   }elseif($dateNow->diff($dateDone)->format("%d") >= 0){
                        if($dateNow->diff($dateDone)->format("%d") == 1){
                            $interv = $dateNow->diff($dateDone)->format("%d").' day ago';
                        }else{
                            $interv = $dateNow->diff($dateDone)->format("%d").' days ago';
                        }
                   }
                   
                   $allLi .= "<li>".$aa['activity']."<br><small ><em>".$interv."</em></small></li>" ;

                }
                $allLi .= "<li class='last'><a href='{{url:site uri='learner/viewAllActivities'}}'>View All</a></li>";
            }
            return $allLi;
        }
        
        function countRec(){
            $this->load->model('learner/model_users');
            date_default_timezone_set('Hongkong');
            $dateNow1 = date("Y-m-d H:i:s");
            $allActs = $this->model_users->recentActs($dateNow1, $this->session->userdata('userid'));
            $count = 0;
            if(empty($allActs)){
                return $count;
            }else{
                $count = count($allActs);
                return $count;
            }
        }
        
        function checkCompModal(){
            $this->load->model('learner/model_users');
            if($this->session->userdata('userid') != ''){
                $compDets = $this->model_users->getCompDets($this->session->userdata('userid'));
                foreach($compDets as $cd){
                    if($cd['firstname'] != NULL && $cd['middlename'] != NULL && $cd['lastname'] != NULL && $cd['firstname'] != NULL && $cd['birthday'] != NULL && $cd['cellno'] != NULL && $cd['streetno'] != NULL && $cd['brgy'] != NULL && $cd['district'] != NULL && $cd['city'] != NULL && $cd['country'] != NULL){
                        return true;
                    }
                }
            }
        }
        function checkBadgeModal(){
            $this->load->model('learner/model_users');
            if($this->session->userdata('userid') != ''){
                $compDets = $this->model_users->getCompDets($this->session->userdata('userid'));
                $compProfBadge = $this->model_users->compProfBadge($this->session->userdata('userid'));
                //print_r($compProfBadge);
                foreach($compDets as $cd){
                    if($cd['firstname'] != '' && $cd['middlename'] != '' && $cd['lastname'] != '' && $cd['birthday'] != '' && $cd['cellno'] != '' && $cd['streetno'] != '' && $cd['brgy'] != '' && $cd['district'] != '' && $cd['city'] != '' && $cd['country'] != '' && empty($compProfBadge)){
                        $this->model_users->addCompProfBadge($this->session->userdata('userid'));
                        $actMessage = 'You have completed your profile!';
                        date_default_timezone_set('Hongkong');
                        $this->model_users->newActivity($this->session->userdata('userid'), $actMessage, date("Y-m-d H:i:s"));
                        return true;
                    }
                }
            }
        }
        
        function allTags(){
            $this->load->model('syllabus/getCourses');
            $allTags = $this->getCourses->getAllTags();
            $tList = '';
            foreach($allTags as $at){
                $tList .= "'".$at['tag']."'," ;
            }
            return $tList;
        }
        
        function enMaster(){
            $this->load->model('syllabus/getCourses');
            if($this->session->userdata('userid') != ''){
                $enCount = $this->getCourses->countCourses($this->session->userdata('userid'));
                $enBadge = $this->getCourses->checkEnBadge($this->session->userdata('userid'));
                if($enCount == 5 && $enBadge == NULL){
                    
                    date_default_timezone_set('Hongkong');
                    $dateNow = date("Y-m-d H:i:s");
                    $this->getCourses->enBadge($this->session->userdata('userid'), $dateNow);
                    return true;
                }
                 
            }
           
        }
        
        function badgeOA(){
            $this->load->model('learner/model_users');
            date_default_timezone_set('Hongkong');
            $dateNow = date("Y-m-d H:i:s");
            if($this->session->userdata('userid') != ''){
              $lateOA1 = $this->model_users->badLatestOA($this->session->userdata('userid'));
              foreach($lateOA1 as $loa1){
              $lateOA = $this->model_users->badLatRem($this->session->userdata('userid'), $loa1['latest']);
              //print_r($lateOA);
              
                  foreach($lateOA as $loa){
                      $checkOAB = $this->model_users->checkOABadge($this->session->userdata('userid'), $loa['courseID']);
                      //print_r($loa['remarks']);
                      //print_r($checkOAB);
                      
                      if($loa['remarks'] == 'Passed' && $checkOAB == null){
                          $getID = $this->model_users->getOAID($loa['courseID']);
                          if($getID != ''){
                          $this->model_users->oaBadge($this->session->userdata('userid'), $getID, $dateNow);
                          return true;
                          }
                      }
                  }
              }
            }
        }
        
        function badgeSC(){
            $this->load->model('learner/model_users');
            date_default_timezone_set('Hongkong');
            $dateNow = date("Y-m-d H:i:s");
             if($this->session->userdata('userid') != ''){
                 $latSC1 = $this->model_users->badLatestSC($this->session->userdata('userid'));
                 foreach($latSC1 as $lsc1){
                     $latSC = $this->model_users->badLatSCRem($this->session->userdata('userid'), $lsc1['latest']);
                     foreach($latSC as $lsc){
                         $checkSCB = $this->model_users->checkSCBadge($this->session->userdata('userid'), $lsc['courseID'], $lsc['moduleID']);
                         if($lsc['remarks'] == 'Passed' && $checkSCB == NULL){
                          $getID = $this->model_users->getSCID($lsc['courseID'], $lsc['moduleID']);
                          if($getID != ''){
                            $this->model_users->oaBadge($this->session->userdata('userid'), $getID, $dateNow);
                            return true;
                          }
                      }
                     }
                 }
             }
        }
}

/* End of file example.php */