<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a sample module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	Sample Module
 */
class XmlGenerator extends Public_Controller
{
    
	public function __construct()
	{
		parent::__construct();
                
	
	}

	/**
	 * All items
	 */
	public function index()
	{
		// set the pagination limit
		
                
                 /*     $sector_thumb=array(); 
                 $sector_thumb['thumbnail_url'] = "sector_blue/sector_Agriculture.png";
		$sector_thumb['sector_name'] = "Agriculture";
                                 
                $name="Agriculture";
                $thumb_url="sector_blue/sector_Agriculture.png";
                        $this->template 
                                 ->set((array('name' => $name, 'thumb_url' => $thumb_url)))
                                    ->build('learn_Landing');
                            */
                            $this->displaySectors();
                        
	}
        
         public function Sectors(){
            $this->template
                    ->build('learn_Landing');
            
        }
        
      //   public function Courses(){
        //    $this->template->build('learn_CourseList');
            
       // }
       
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
            
            $this->load->model('getCourses');
            $this->load->model('getSectors');
            $sectors = $this->getSectors->getSectorList();
            
            $inDemand = $this->getCourses->inDemandCourses();
            $latest = $this->getCourses->latestCourses();
            //$learnerCourses []= $this->getCourses->getLearnerCourses($this->session->userdata('userid'));
            //print_r($learnerCourses);
            //$lCount = count($learnerCourses);
            
            $sectorNames = array();
            $eCount = array();
            foreach ($inDemand as $inDemands){
                $sectorNames []= $this->getSectors->getSectorName($inDemands['id']);
                $eCount []=  $this->getCourses->countEnrolled($inDemands['id']);
                
            }
            $latestSector = array();
            foreach ($latest as $lat){
                $latestSector []= $this->getSectors->getSectorName($lat['id']);
                
            }
             
            $this->template
                    //->set('learnerCourses', $learnerCourses)
                    //->set('lCount', $lCount)
                    ->set('sectors',$sectors)
                    ->set('latest',$latest)
                    ->set('eCount',$eCount)
                    ->set('latestSector',$latestSector)
                    ->set('inDemand', $inDemand)
                    ->set('sectorNames', $sectorNames)
                    ->build('learn_Landing');
        }
        
        public  function displayCourses($id){
            
            //$data['courses'] = array();
            //$this->load->model('getCourses');
            //$courses = $this->getCourses->getCourse($id);
            
            $this->load->model('getCourses');
            $lCourses = $this->getCourses->getLearnerCourses($this->session->userdata('userid'));
            $lcCount = count($lCourses);
            $query = $this->getCourses->getCourseID($id);
            $courses = array();
            
            foreach($query as $a){
                $courses []= $this->getCourses->getCourse($a);
            }
            $cCount = count($courses);
            //print_r($lCourses);
            //print_r($courses);
            $this->load->model('getSectors');
            $sectors = $this->getSectors->getSectDetails($id);
            
            $this->template
                    ->set('lcCount', $lcCount)
                    ->set('lCourses', $lCourses)
                    ->set('cCount', $cCount)
                    ->set('courses', $courses)
                    ->set('sectors', $sectors)
                    ->build ('learn_CourseList');
            
        }
        
        public function displayModules($cID){
       
            //$data['modules'] = array();
            $this->load->model('getSectors');
            $this->load->model('getCourses');
            $this->load->model('getModules');
            $this->load->model('getLessons');
            $this->load->model('getTopics');
            $this->load->model('learner/model_users');
            
            $courses = $this->getCourses->getCourse($cID);
            $sectorName = $this->getSectors->getSectorName($courses[0]['id']);
            $sectorID = $this->getSectors->getSectorID($courses[0]['id']);
            $query = $this->getModules->getModuleHID($cID);
            $cDetails = $this->getCourses->getCourseDetails($cID);
            $cObjectives = $this->getCourses->getCourseOpp($cID);
            $lCourses = $this->getCourses->learnerCoursesID($this->session->userdata('userid'), $cID);
            $overviewVids= $this->getCourses->getOverviewVids($cID);
            $passCount = 0;
            $moduleCount = 0;
            
            if($this->session->userdata('userid') != NULL){
                $passedSC = $this->model_users->countPassSC($cID, $this->session->userdata('userid'));
                $passCount = count($passedSC);
                $moduleCount = $this->getModules->countMods($cID);
            }
            
            //print_r($lCourses);
            $fModCount = array();
            $mCount = array();
            $compSC = array();
            foreach($lCourses as $lcs){
                $compSC []= $this->model_users->countPassSC($lcs['ID'], $this->session->userdata('userid'));
                $mCount []= $this->getModules->countMods($lcs['ID']);
                $fModCount []= $this->getModules->finishedModCount($this->session->userdata('userid'), $lcs['ID']);
            }
            //print_r($overviewVids);
            $modules = array();
            $lessons = array();
            //$les = array();
            $lesID = array();
            foreach($query as $a){
            $modules []= $this->getModules->getModuleList($a);
            }
            
            foreach($modules as $b){
                //print_r($b);
                foreach($b as $modID){
                    //print_r($modID['id']);
                    $lessons[$modID['title']] []= $this->getLessons->getLessonsID($modID['id']);
                    //$les []= $this->getLessons->getLessonsID($modID['id']);
                    
                }
                
            }
            $lesID []= $this->getLessons->getFinishedLes($this->session->userdata('userid'), $cID);
                    
            if($this->session->userdata('userid') != NULL){
                $courseE = $this->getCourses->courseExist($courses[0]['id'], $this->session->userdata('userid'));
                if(empty($courseE)){
                    date_default_timezone_set('Hongkong');
                    $this->getCourses->addLearnerCourse($this->session->userdata('userid'), $courses[0]['id'], date("Y-m-d H:i:s"));
                }
                
            }
            //print_r($lessons);
            $lesso = (object) $lessons;
            //print_r($lesso);
            
            $this->template
                    ->set('fModCount', $fModCount)
                    ->set('mCount', $mCount)
                    ->set('sectorName', $sectorName)
                    ->set('sectorID', $sectorID)
                    ->set('overviewVids', $overviewVids)
                    ->set('modules', $modules)
                    ->set('courses', $courses)
                    ->set('lCourses', $lCourses)
                    ->set('cDetails', $cDetails)
                    ->set('cObjectives', $cObjectives)
                    ->set('lesID', $lesID)
                    ->set('compSC', $compSC)
                    ->set('lList',$lesso)
                    ->set('passCount',$passCount)
                    ->set('moduleCount',$moduleCount)
                    ->build('learn_ModuleList');
        }
        
        public function displayTopic($lessonID){
            $this->load->model('getLessons');
            $this->load->model('getModules');
            $this->load->model('getCourses');        
            $this->load->model('getTopics');
            $this->load->model('getSectors');
            
            //$lesIDList = array();
            $lesIDList = $this->getLessons->getLesHID($lessonID);
            $nextLes = 0;
            $lesID = array();
            
             $last = count($lesIDList);
            //print_r($current_index);
            foreach($lesIDList as $index=>$lID){
                if($lID['HeirarchyID'] == $lessonID){
                    $nextLes = $index + 1;
                }
            }
            //print_r($last);
            //print_r($nextLes);
            $lesMod= $this->getModules->getLesMod($lessonID);
            $modCourse = $this->getCourses->modCourse($lesMod);
            $sectorN = $this->getSectors->getSectorName($modCourse);
            $sectorID = $this->getSectors->getSectorID($modCourse);
            $courseN = $this->getCourses->getCourse($modCourse);
            $moduleN = $this->getModules->getModuleList($lesMod);
            $lessonN = $this->getLessons->getLessonList($lessonID);
            //print_r($lesMod);
            //print_r($modCourse);
            if($last != $nextLes){
                $lesID = $lesIDList[$nextLes];
            }
            
            $topicList = $this->getTopics->getTopicsList($lessonID);
            $toplID = array();
                            
            if($this->session->userdata('userid') != NULL){
                $lModID = 0;
                $aCount = 0;
                $lLesID = 0;
                $cEnrolled = $this->getCourses->learnerCID($this->session->userdata('userid'), $lesMod);
                foreach ($cEnrolled as $ce ){
                    if($ce['HeirarchyID'] == $modCourse){
                        $forSame = $this->getModules->checkSame($ce['lcID'], $lesMod);
                           if(empty($forSame)){
                               date_default_timezone_set('Hongkong');
                               $lModID = $this->getModules->startLearner($ce['lcID'], $lesMod, date("Y-m-d H:i:s"), date("Y-m-d H:i:s"));
                               
                           }else{
                            foreach($forSame as $fs){
                                if($fs['lcID'] == $ce['lcID'] AND $fs['moduleID'] == $lesMod){
                                   $aCount = $this->getModules->aCount($fs['lmID']);
                                   date_default_timezone_set('Hongkong');
                                   $lModID = $this->getModules->updateLast($fs['lmID'], date("Y-m-d H:i:s"), $aCount );
                                }
                              }
                           }
                            $forSameL = $this->getLessons->checkSameL($lModID, $lessonID);
                            if(empty($forSameL)){
                                date_default_timezone_set('Hongkong');
                                $lLesID = $this->getLessons->learnerLes($lModID, $lessonID, date("Y-m-d H:i:s"), date("Y-m-d H:i:s") );
                            }else{
                                foreach($forSameL as $fsl){
                                   if($fsl['lmID'] == $lModID AND $fsl['lessonID'] == $lessonID){
                                    $toplID []= $fsl['lID'];
                                    date_default_timezone_set('Hongkong');
                                    $lLesID = $this->getLessons->updateLes($fsl['lID'], date("Y-m-d H:i:s") );
                                } 
                                }
                            }
                            //print_r($topicList[0]['id']);
                          $count = 0;
                           foreach($topicList as $tl){
                                if($count < 1){
                                    $forSameT = $this->getTopics->checkSameT($lLesID, $tl['id']);
                                    if(empty($forSameT)){
                                         date_default_timezone_set('Hongkong');
                                         $this->getTopics->learnerTopic($lLesID, $tl['id'], date("Y-m-d H:i:s"), date("Y-m-d H:i:s") );
                                    }
                                }
                                $count += 1;
                           }
                            
                     }
              
                }
            }
            $finishedT = array();
            
            foreach ($toplID as $tlID){
                $finishedT []= $this->getTopics->finishedTopics($tlID);
            }
            
            $content = array();
            $vidLinks = array();
            foreach($topicList as $tl){
                $content []= $this->getTopics->getTextContent($tl['id']);
                $vidLinks [$tl['title']] []= $this->getTopics->getVidLinks($tl['id']);
            }
            $vLinks = (object)$vidLinks;
            //print_r($vLinks);   
            $moduleTitle = $this->getLessons->getLessonList($lessonID);
            
            $this->template
                ->set('finishedT', $finishedT)
                ->set('vLinks', $vLinks)
                ->set('lesID', $lesID)
                ->set('last', $last)
                ->set('nextLes', $nextLes)
                ->set('content', $content)
                ->set('lesMod', $lesMod)
                ->set('modCourse', $modCourse)
                ->set('topicList', $topicList)
                ->set('moduleTitle', $moduleTitle)
                ->set('sectorN', $sectorN)
                ->set('sectorID', $sectorID)
                ->set('courseN', $courseN)
                ->set('moduleN', $moduleN)
                ->set('lessonN', $lessonN)
                ->build('learn_topic');
          
        }
        
        
        public function viewedTopic(){
            $topicID = $_POST['topicId'];
            //echo "AAAAA";
            $this->load->model('getTopics');
            $this->load->model('getLessons');
            $this->load->model('getModules');
            $this->load->model('getCourses');
//            
            $topicLes = $this->getLessons->topicLes($topicID);
            $ordering = $this->getTopics->checkOrder($topicLes);
            //echo $ordering;
            
            $lastTopic = 0;
            
            if($ordering == 0){
                $lastTopic = $this->getTopics->lastTopic($topicLes);
            }else{
                $lastTopic = $this->getTopics->lastTop($topicLes);
            }
            
                    
            
            if($this->session->userdata('userid') != NULL){
//                
                $lLesID = $this->getLessons->lesPrimaryKey($this->session->userdata('userid'), $topicLes);
//              
                foreach($lLesID as $llID){
                    $sameT = $this->getTopics->checkSameT($llID['lID'], $topicID);
                    if(empty($sameT)){
                        date_default_timezone_set('Hongkong');
                        $this->getTopics->learnerTopic($llID['lID'], $topicID, date("Y-m-d H:i:s"), date("Y-m-d H:i:s") );
                    }
                    if($topicID == $lastTopic){
                       date_default_timezone_set('Hongkong');
                       $this->getLessons->updateFinished($llID['lID'], date("Y-m-d H:i:s")); 
                    }
                }
                
                
                
            }
            
            
                            
        }



        public function load_TopicContent($id){
            
              $topic['id']=$id;
            
            $this->load->view('topic_content',$topic);
            
            
            
        }
        public function modal_course(){
            $course['id']=$_POST['post_id'];
            $this->load->model('getCourses');
            $courseDetails = $this->getCourses->getCourseDetails($course['id']);
            $courseObj = $this->getCourses->getCourseOpp($course['id']);
            $this->load->view('modal_course', array('courseDetails' => $courseDetails, 'courseObj' => $courseObj) );
            
        }
        
        public function enroll($cID = 0){
            $this->load->model('getCourses');
            $this->getCourses->upIsEnrolled($this->session->userdata('userid'), $cID);
            
            
                redirect('syllabus/displayModules/'.$cID);
            
        }
        
        public function shareFB($cID = 0){
            $this->load->model('getCourses');
            $shareCourse = $this->getCourses->getCourse($cID);
            
            $message = 'I have enrolled in '.$shareCourse[0]['title'];
            $name = $shareCourse[0]['title'];
            $link = 'e-tesda.gov.ph';
            //$picture = '';
            $description = '';
            
            if($this->session->userdata('fbuser') == 1){
                $this->postFB($message, $name, $link, $description);
                redirect('syllabus/displayModules/'.$cID);
            }else{
                redirect('syllabus/displayModules/'.$cID);
            }
        }
        
        public function postFB($message, $name, $link, $description ){
            
            $this->load->library('fbconnect');
            //$this->load->model('learner/users');
            //$facebook_user = $this->fbconnect->user;
            
            $attachment = array('message' => $message, //'I am currently taking up Bartending',
            'name' => $name,//$title,
            'link' => $link, //. $urlTitle,
            'picture' => 'http://farm4.staticflickr.com/3721/9414936798_859b5e55f0_t.jpg',//'http://photos-e.ak.fbcdn.net/photos-ak-snc7/v27562/114/100643820118998/app_101_100643820118998_978948289.png',
            'description' => $description,
                'actions' => array(
                     array(
                        'name' => 'Learn',
                        'link' => 'http://e-TESDA.gov.ph'
                          )
                       )
           
                 );
             if(!($sendMessage = $this->fbconnect->api('/me/feed/','post',$attachment))){
                $errors= error_get_last();
                echo "Facebook publish error: ".$errors['type'];
                echo "<br />\n".$errors['message'];
            }
        }
      
}