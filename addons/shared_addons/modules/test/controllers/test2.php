<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * This is a sample module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	Sample Module
 */
class Test extends Public_Controller {

    public function __construct() {
        parent::__construct();

        // Load the required classes
        $this->load->model('test_m');
        $this->lang->load('sample');
        $this->load->library('form_validation');
    }

    /**
     * All items
     */
    public function index($offset = 0) {
        // set the pagination limit
        $limit = 5;

        $items = $this->sample_m->limit($limit)
                ->offset($offset)
                ->get_all();

        // we'll do a quick check here so we can tell tags whether there is data or not
        $items_exist = count($items) > 0;

        // we're using the pagination helper to do the pagination for us. Params are: (module/method, total count, limit, uri segment)
        $pagination = create_pagination('sample', $this->sample_m->count_all(), $limit, 2);

        $this->template
                ->title($this->module_details['name'], 'the rest of the page title')
                ->set('items', $items)
                ->set('items_exist', $items_exist)
                ->set('pagination', $pagination)
                ->build('learn_dashboard');
    }

    public function login() {
        $this->template->build('login');
    }

    public function register() {
        $this->template->build('register');
    }

    public function test() {
        $this->template->build('learn_myTests');
    }

    public function testAssessment() {
        $this->template->build('test_onlineAssessment');
    }

    public function testSelfCheck() {
        $this->template->build('test_SelfCheck');
    }

    public function resultOnlineAssessment() {
        $this->template->build('results_OnlineAssessment');
    }

    public function sample() {

        $color = array(
            '1' => '#3498db',
        );

        //print_r($color[1]);
    }

    public function generateOATest($courseid) {
        
        unset($_SESSION['answers']);
        unset($_SESSION['sections']);
        unset($_SESSION['questions']);
        $questions = array();
        $answers = array();
        $correct = array();
        $sectionctr = 1;
        $test = $this->test_m->getTest($courseid);
        //print_r($test);
        $coursedetails = $this->test_m->getCourseDetails($courseid);
        //print_r($coursedetails);
        $sections = $this->test_m->getTestSections($test->testID);
        //print_r($sections);
        $arrayextra = array();
        
       
        
        foreach ($sections as $sect) {
            $noOfDiff = $this->test_m->getDifficultyCount($courseid, $sect['moduleID'], $sect['testType']);
            $diff = $this->test_m->getDifficulties($courseid, $sect['moduleID'], $sect['testType']);

            $extra = $sect['noOfItems'] % $noOfDiff;
            $ctr = $sect['noOfItems'] / $noOfDiff;
            //echo $diff;

            foreach ($diff as $d) {

                if ($extra >= 1) {

                    $results = $this->test_m->getItem($courseid, $sect['moduleID'], $sect['testType'], $d['difficulty'], $ctr + 1, 0);
                    $arraycount = count($results);
                    $itemm = array();

                    //echo $arraycount;
                    foreach ($results as $key => $result) {
                        if ($key == $arraycount - 1) {
                            $arrayextra[$sectionctr][] = $result;
                        } else {
                            $itemm[] = $result;
                        }
                    }
                    //print_r($arrayextra);
//                         shuffle($arrayextra);
//                         //print_r($extra);
//                         for($i = 1; $i<=$extra; $i++){
//                             //$itemm[] = $arrayextra[$i-1];
//                             array_push($itemm, $arrayextra[$i-1]);
//                         }
                } else {
                    $itemm = $this->test_m->getItem($courseid, $sect['moduleID'], $sect['testType'], $d['difficulty'], $ctr, 0);
                }



                $questions[$sectionctr][] = $itemm;
//                     
//                         shuffle($arrayextra);
//                         //print_r($extra);
//                         for($i = 1; $i<=$extra; $i++){
//                             $questions[$sectionctr][] = array(0=>$arrayextra[$i-1]);
//                             //array_push($itemm, $arrayextra[$i-1]);
//                         }
//                     
//                     print_r($questions);
                if ($sect['testType'] == 1) {
                    foreach ($itemm as $i) {
                        $try = array();
                        //$answers[] = $this->test_m->getChoices($i['itemID']);

                        $choices = $this->test_m->getChoices($i['itemID']);

                        foreach ($choices as $key => $choice) {
                            array_push($try, $choice['choice']);
                            if ($key == 0) {
                                $correct[$sectionctr][] = $choice['choice'];
                            }
                        }

                        $answers[$i['prompt']][] = $this->shuffle_assoc($try);
                    }
                } elseif ($sect['testType'] == 2) {
                    $tf = array();
                    foreach ($itemm as $i) {
                        if ($i['response'] == 'True' || $i['response'] == 'true') {
                            $tf = array('True', 'False');
                        } else {
                            $tf = array('False', 'True');
                        }

                        $answers[$i['prompt']][] = $tf;
                        $correct[$sectionctr][] = $i['response'];
                    }
                } elseif ($sect['testType'] == 3) {
                    foreach ($itemm as $i) {
                        $answers[$i['prompt']][] = $i['response'];
                        $correct[$sectionctr][] = $i['response'];
                    }
                }
            }


            $sectionctr++;
        }

        $questions1 = $questions;
        $correct1 = $correct;
        $answers1 = $answers;

        if ($extra >= 1) {
            //print_r($arrayextra);
            $sectionctr1 = 1;
            // $indexa = count($questions[$sectionctr1]);
            foreach ($sections as $sect) {

                shuffle($arrayextra[$sectionctr1]);
                //print_r($extra);
                $itemm1 = array();
                for ($i = 0; $i < $extra; $i++) {
                    $itemm1[] = $arrayextra[$sectionctr1][$i];

                    //echo "A";
                }

                foreach ($itemm1 as $itemm2) {
                    $questions1[$sectionctr1][] = array($itemm2);
                }

                if ($sect['testType'] == 1) {
                    foreach ($itemm1 as $i) {
                        $try = array();
                        //$answers[] = $this->test_m->getChoices($i['itemID']);

                        $choices = $this->test_m->getChoices($i['itemID']);

                        foreach ($choices as $key => $choice) {
                            array_push($try, $choice['choice']);
                            if ($key == 0) {
                                $correct1[$sectionctr1][] = $choice['choice'];
                            }
                        }

                        $answers1[$i['prompt']][] = $this->shuffle_assoc($try);
                    }
                } elseif ($sect['testType'] == 2) {
                    $tf = array();
                    foreach ($itemm1 as $i) {
                        if ($i['response'] == 'True' || $i['response'] == 'true') {
                            $tf = array('True', 'False');
                        } else {
                            $tf = array('False', 'True');
                        }

                        $answers1[$i['prompt']][] = $tf;
                        $correct1[$sectionctr1][] = $i['response'];
                    }
                } elseif ($sect['testType'] == 3) {
                    foreach ($itemm1 as $i) {
                        $answers1[$i['prompt']][] = $i['response'];
                        $correct1[$sectionctr1][] = $i['response'];
                    }
                }

                $sectionctr1++;
            }
            //print_r($questions1);
        }

//             $questions = $questions1;
//             $correct = $correct1;
//             $answers = $answers1;
        //print_r($answers1);
//              print_r($sections);
//              print_r((object)$questions);
//              print_r((object)$answers);
//              print_r($coursedetails);

        $_SESSION['sections'] = $sections;
        $_SESSION['questions'] = $questions1;
        $_SESSION['answers'] = $answers1;
        $_SESSION['coursedetails'] = $coursedetails;
        $_SESSION['correct'] = $correct1;

        redirect('test/viewExam');
//              $this->template->set('questions', $questions)
//                      ->set('answers',(object) $answers)
//                      ->set('sections', $sections)
//                      ->set('course', $coursedetails)
//                      ->build('test_onlineAssessment');
    }

    public function shuffle_assoc($array) {
        //print_r($array);
        $keys = array_rand($array, count($array));

        shuffle($keys);

        foreach ($keys as $key)
            $new[$key] = $array[$key];
        $array = $new;
        return $array;
    }

    public function results() {
        
        $postans = $_SESSION['postans'];
        //print_r($postans);
        $startdate = $_SESSION['starttime'];
        $now = new DateTime('NOW');
        $now->setTimezone(new DateTimeZone('Asia/Hong_Kong'));
        $now->format('Y-m-d H:i:sP');
        $sincestart = $startdate->diff($now);
        
        //print_r($_POST);
        //print_r($_SESSION['correct']);
        //print_r($_SESSION);
        //print_r($_SESSION['sections']);
        $correctans = $_SESSION['correct'];
        $sectionss = $_SESSION['sections'];
        $totalitems = 0;
        
        //print_r($sectionss[1]['testbankID']);
        
        $sec = $sincestart->s;
        $min = $sincestart->i;
        $hour = $sincestart->h;
        
        //unset($_SESSION['starttime']);
        
        
        foreach ($sectionss as $sect) {

            $modulename = $this->test_m->getModuleName($sect['moduleID']);

            $sect['moduleID'] = $modulename->title;
            $sections[] = $sect;
            $totalitems += $sect['noOfItems'];
        }
        //print_r($sections);
        $sectionscores = array();
        $ctr = 1;
        $choicesctr = 0;
        $totalscore = 0;

        foreach ($postans as $postitems) {
            $score = 0;
            foreach ($postitems as $items) {
                if (strcasecmp($items, $correctans[$ctr][$choicesctr]) == 0) {
                    //echo $choicesctr;
                    $score++;
                }
                $choicesctr++;
            }
            $totalscore+=$score;
            $sectionscores[$ctr] = array('score' => $score);
            $choicesctr = 0;
            $ctr++;
        }

        //print_r($sectionscores);
        //echo $totalscore;
        $this->load->model('test_m');
        $this->load->model('learner/model_users');
        $this->load->model('syllabus/getCourses');
        $totItems = $this->test_m->getTBDet($sectionss[0]['testbankID']);
        $tbID = 0;
        date_default_timezone_set('Hongkong');
        if(($totalscore/$totItems[0]['noOfItems'])*100 >= 60){
            $courseTitle = $this->getCourses->getCourseTitle($totItems[0]['courseID']);
            $actMessage = 'You have passed '.$courseTitle.' Online Assessment!';
            $this->test_m->newActivity($this->session->userdata('userid'), $actMessage, date("Y-m-d H:i:s"));
            $tbID = $this->test_m->addTestResult($this->session->userdata('userid'), $totItems[0]['testID'], $totalscore, date("Y-m-d H:i:s"), 'Passed');
            $this->model_users->upLearnerStat($this->session->userdata('userid'), $totItems[0]['courseID'], 3);
            $this->model_users->upLearnerFin($this->session->userdata('userid'), $totItems[0]['courseID'], date("Y-m-d H:i:s"));
   
        }else{
            $tbID = $this->test_m->addTestResult($this->session->userdata('userid'), $totItems[0]['testID'], $totalscore, date("Y-m-d H:i:s"), 'Failed');
        }
        $count = 1;
        foreach($sectionss as $sctns){
            if(($sectionscores[$count]['score']/$sctns['noOfItems'])*100 >= 60){
                $this->test_m->addSectResult($tbID, $sctns['sectionID'], $sectionscores[$count]['score'], 'Competent');
            }else{
                $this->test_m->addSectResult($tbID, $sctns['sectionID'], $sectionscores[$count]['score'], 'Needs Review');
            }
         $count += 1;
        }
        $cName = $this->test_m->cName($tbID);

        $this->template
                ->set('totalscore', $totalscore)
                ->set('totalitems', $totalitems)
                ->set('sections', $sections)
                ->set('secscores', $sectionscores)
                ->set('resID', $tbID)
                ->set('cName', $cName)
                ->set('sec', $sec)
                ->set('min', $min)
                ->set('hour', $hour)
                ->build('results_OnlineAssessment');
    }

    public function viewExam() {


        $answers = $_SESSION['answers'];
        $sections = $_SESSION['sections'];
        $questions = $_SESSION['questions'];

        $coursedetails = $_SESSION['coursedetails'];
        
         if(!isset($_SESSION['starttime'])){
            $date = new DateTime('NOW');
            $date->setTimezone(new DateTimeZone('Asia/Hong_Kong'));
            $_SESSION['starttime'] = $date;
        }
        $ctr = 1;
        
        foreach($sections as $section){
            //print_r($section);
            $count = $section['noOfItems'];
            //echo $count.'|';
            for($i = 1; $i<=$count; $i++){
                //echo $i;
                $this->form_validation->set_rules('ans'.$ctr.'['.$i.']', 'Section '.$ctr.'Question '.$i, 'required');
            }
            $ctr++;
        }
        
        if($this->form_validation->run()){
            $_SESSION['postans'] = $_POST;
            redirect('test/results');
        }
        
       //print_r($this->form_validation);

        $this->template->set('questions', $questions)
                ->set('answers', (object) $answers)
                ->set('sections', $sections)
                ->set('course', $coursedetails)
                ->build('test_onlineAssessment');
    }

    public function generateSCTest($moduleid){
        unset($_SESSION['answers']);
        unset($_SESSION['sections']);
        unset($_SESSION['questions']);
        //echo $moduleid;
        
        
        $courseid = $this->test_m->getHid($this->test_m->getParent($moduleid));
        //print_r($courseid);
        $questions = array();
        $answers = array();
        $correct = array();
        $sectionctr = 1;
        
        $modExist = $this->test_m->ifModExist($moduleid, $this->session->userdata('userid'));
        if(empty($modExist)){
            date_default_timezone_set('Hongkong');
            $lcID = $this->test_m->getLCID($courseid, $this->session->userdata('userid'));
            $this->test_m->addMod($lcID, $moduleid, date("Y-m-d H:i:s"), date("Y-m-d H:i:s"));
        }
        
        $test = $this->test_m->getSelfCheckTest($courseid);
        //print_r($test);
        $moduledetails = $this->test_m->getModuleDetails($moduleid);
        //print_r($moduledetails);
        $sections = $this->test_m->getSelfCheck($courseid, $moduleid);
        //print_r($sections);

        $noOfDiff = $this->test_m->getDifficultyCount($courseid, $sections->moduleID, $sections->testType);
        $diff = $this->test_m->getDifficulties($courseid, $sections->moduleID, $sections->testType);

        $extra = $sections->noOfItems % $noOfDiff;
        $ctr = $sections->noOfItems / $noOfDiff;
        //echo $diff;

        foreach ($diff as $d) {

            if ($extra >= 1) {

                $results = $this->test_m->getItem($courseid, $sections->moduleID, $sections->testType, $d['difficulty'], $ctr + 1,1);
                $arraycount = count($results);
                $itemm = array();

                //echo $arraycount;
                foreach ($results as $key => $result) {
                    if ($key == $arraycount - 1) {
                        $arrayextra[$sectionctr][] = $result;
                    } else {
                        $itemm[] = $result;
                    }
                }
                //print_r($arrayextra);
            } else {


                $itemm = $this->test_m->getItem($courseid, $sections->moduleID, $sections->testType, $d['difficulty'], $ctr, 1);
            }

            $questions[$sectionctr][] = $itemm;
            //print_r($itemm);
            if ($sections->testType == 1) {
                foreach ($itemm as $i) {
                    $try = array();
                    //$answers[] = $this->test_m->getChoices($i['itemID']);

                    $choices = $this->test_m->getChoices($i['itemID']);

                    foreach ($choices as $key => $choice) {
                      
                        array_push($try, $choice['choice']);
                        if ($key == 0) {
                            $correct[$sectionctr][] = $choice['choice'];
                        }
                    }

                    $answers[$i['prompt']][] = $this->shuffle_assoc($try);
                }
            } elseif ($sections->testType == 2) {
                $tf = array();
                foreach ($itemm as $i) {
                    if ($i['response'] == 'True' || $i['response'] == 'true') {
                        $tf = array('True', 'False');
                    } else {
                        $tf = array('False', 'True');
                    }

                    $answers[$i['prompt']][] = $tf;
                    $correct[$sectionctr][] = $i['response'];
                }
            } elseif ($sections->testType == 3) {
                foreach ($itemm as $i) {
                    $answers[$i['prompt']][] = $i['response'];
                    $correct[$sectionctr][] = $i['response'];
                }
            }
        }

        $questions1 = $questions;
        $answers1 = $answers;
        $correct1 = $correct;

        if ($extra >= 1) {

            $sectionctr1 = 1;
            shuffle($arrayextra[$sectionctr1]);
            //print_r($extra);
            $itemm1 = array();
            for ($i = 0; $i < $extra; $i++) {
                $itemm1[] = $arrayextra[$sectionctr1][$i];
            }

            foreach ($itemm1 as $itemm2) {
                $questions1[$sectionctr1][] = array($itemm2);
            }

            if ($sections->testType == 1) {
                foreach ($itemm1 as $i) {
                    $try = array();
                    $choices = $this->test_m->getChoices($i['itemID']);

                    foreach ($choices as $key => $choice) {
                        array_push($try, $choice['choice']);
                        if ($key == 0) {
                            $correct1[$sectionctr1][] = $choice['choice'];
                        }
                    }

                    $answers1[$i['prompt']][] = $this->shuffle_assoc($try);
                }
            } elseif ($sections->testType == 2) {
                $tf = array();
                foreach ($itemm1 as $i) {
                    if ($i['response'] == 'True' || $i['response'] == 'true') {
                        $tf = array('True', 'False');
                    } else {
                        $tf = array('False', 'True');
                    }

                    $answers1[$i['prompt']][] = $tf;
                    $correct1[$sectionctr1][] = $i['response'];
                }
            } elseif ($sections->testType == 3) {
                foreach ($itemm1 as $i) {
                    $answers1[$i['prompt']][] = $i['response'];
                    $correct1[$sectionctr1][] = $i['response'];
                }
            }
        }


//              print_r($sections);
//              print_r((object)$questions);
//              print_r((object)$answers);
        // print_r($coursedetails);

        $_SESSION['sections'] = $sections;
        $_SESSION['questions'] = $questions1;
        $_SESSION['answers'] = $answers1;
        $_SESSION['moduledetails'] = $moduledetails;
        $_SESSION['correct'] = $correct1;

        redirect('test/selfCheck');
    }

    public function selfCheck() {
        
        
        $answers = $_SESSION['answers'];
        $sections = $_SESSION['sections'];
        $questions = $_SESSION['questions'];
        $correct = $_SESSION['correct'];
        $moduledetails = $_SESSION['moduledetails'];
       
         if(!isset($_SESSION['starttime'])){
            $date = new DateTime('NOW');
            $date->setTimezone(new DateTimeZone('Asia/Hong_Kong'));
            $_SESSION['starttime'] = $date;
        }
        
        
        for($i = 1; $i<=count($correct[1]); $i++){
            $this->form_validation->set_rules('ans1['.$i.']', 'Question '.$i, 'required');
        }
        
        
       // $this->form_validation->set_rules('ans1', 'Answers', 'required');
//        if(!empty($_POST)){
//            foreach($_POST['ans1'] as $form){
//                $this->form_validation->set_rules('ans1[', 'Answers', 'Required');
//                echo $form;
//        print_r($form);
//            }
//        }
        
        if($this->form_validation->run()){
            $_SESSION['postans'] = $_POST;
            redirect('test/viewSelfCheckResults');
        }
        else{
         
        }
          

        $this->template->set('questions', $questions)
                ->set('answers', (object) $answers)
                ->set('sections', $sections)
                ->set('module', $moduledetails)
                ->build('test_SelfCheck');
    }


    public function viewSelfCheckResults() {

        //$date = date('Y-m-d H:i:s');
        $startdate = $_SESSION['starttime'];
        $now = new DateTime('NOW');
        $now->setTimezone(new DateTimeZone('Asia/Hong_Kong'));
        $now->format('Y-m-d H:i:sP');
        $sincestart = $startdate->diff($now);
        $answers = $_SESSION['answers'];
        $sections = $_SESSION['sections'];
        $questions = $_SESSION['questions'];
        //$duration =  new DateTime($_SESSION['duration']);
        
        //print_r($startdate);
        //print_r($duration);
        //print_r($sincestart);
        $sec = $sincestart->s;
        $min = $sincestart->i;
        $hour = $sincestart->h;
        
        
        //unset($_SESSION['starttime']);
//        
        
        
        
       // print_r($sections->testbankID);
       // print_r($answers);
        $correctans = $_SESSION['correct'];

        $sectionscores = array();
        $ctr = 1;
        $choicesctr = 0;
        $totalscore = 0;
        
        $postans = $_SESSION['postans'];
      
        foreach ($postans as $postitems) {
            
            $score = 0;
            
            foreach ($postitems as $items) {
            //print_r($correctans[$ctr][$choicesctr]);
                if (strcasecmp($items, $correctans[$ctr][$choicesctr]) == 0) {
                    //echo $choicesctr;
                    $score++;
                }
                $choicesctr++;
            }
            $totalscore+=$score;
            $sectionscores[$ctr][] = array('score' => $score);
            $choicesctr = 0;
            $ctr++;
        }
        $this->load->model('syllabus/getModules');
        $this->load->model('syllabus/getCourses');
        $this->load->model('learner/model_users');
        
        $itemsNum = $sections->noOfItems;
        //print_r($sections);
        $existM = $this->getModules->checkSameM($this->session->userdata('userid'), $sections->moduleID);
        $tbID = 0;
        $passCount = 0;
        $moduleCount = 0;
        $moduleID = $sections->moduleID;
        $thisCourse = $this->getCourses->modCourse($sections->moduleID);
        $learnCID = $this->getCourses->getLCID($this->session->userdata('userid'), $thisCourse);
        date_default_timezone_set('Hongkong');
        //print_r($existM);
        if($this->session->userdata('userid') != NULL){
                $passedSC = $this->model_users->countPassSC($thisCourse, $this->session->userdata('userid'));
                $passCount = count($passedSC);
                $moduleCount = $this->getModules->countMods($thisCourse);
        }
        
        if(($totalscore/$itemsNum)*100 >= 60){
            if(empty($existM)){
                 $this->getModules->startFLearner($learnCID, $sections->moduleID, date("Y-m-d H:i:s"), date("Y-m-d H:i:s"), date("Y-m-d H:i:s"));
            }
            if($moduleCount-$passCount == 1){
                $this->model_users->upLearnerStat($this->session->userdata('userid'), $thisCourse, 2);
            }
            $moduleTitle = $this->getModules->getModuleName($sections->moduleID);
            $actMessage = 'You have passed '.$moduleTitle.' Self Check!';
            $this->test_m->newActivity($this->session->userdata('userid'), $actMessage, date("Y-m-d H:i:s"));
            $modPK = $this->test_m->getModPK($this->session->userdata('userid'), $sections->moduleID);
            $tbID = $this->test_m->addTestResult($this->session->userdata('userid'), $sections->testbankID, $totalscore, date("Y-m-d H:i:s"), 'Passed');
            $this->test_m->addSectResult($tbID, $sections->sectionID, $totalscore, 'Competent');
            $this->test_m->updateModFin($modPK, date("Y-m-d H:i:s"));
        }else{
            if(empty($existM)){
                $this->getModules->startLearner($learnCID, $sections->moduleID, date("Y-m-d H:i:s"), date("Y-m-d H:i:s"));
            }
            
            $tbID = $this->test_m->addTestResult($this->session->userdata('userid'), $sections->testbankID, $totalscore, date("Y-m-d H:i:s"), 'Failed');
            $this->test_m->addSectResult($tbID, $sections->sectionID, $totalscore, 'Needs Review');
        }
        
        
        //print_r($sectionscores);
        //echo $totalscore;


        $this->template
                ->title('Self Check Results')
                ->set('userans', $postans)
                ->set('questions', $questions)
                ->set('answers', (object) $answers)
                ->set('sections', $sections)
                ->set('moduleCount', $moduleCount)
                ->set('passCount', $passCount)
                ->set('module', $_SESSION['moduledetails'])
                ->set('score', $score)
                ->set('total', $sections->noOfItems)
                ->set('resID', $tbID)
                ->set('cID', $thisCourse)
                ->set('moduleID', $moduleID)
                ->build('results_selfCheck');
//        }
//        
//        else{
//           
//            redirect('test/selfCheck');
//            $this->session->set_flashdata('success', sprintf('Successfully edited Sector'));
//        }
    }
    
    public function shareSCFB($resID){
        $this->load->model('test_m');
        $forShare = $this->test_m->shareSC($resID);
        
        
        foreach($forShare as $fs){
            $message = 'I got '.$fs['result'].' out of '.$fs['noOfItems'].' items for my self check in '.$fs['title'].' module';
            $name = 'I Passed a Self Check!';
            $link = 'e-tesda.gov.ph';
            $description = '';
            $this->postFB($message, $name, $link, $description);
        }
        
        redirect('syllabus/displayModules/'.$forShare[0]['id']);
        
    }
    
    public function shareOAFB($resID){
        $this->load->model('test_m');
        $forShare = $this->test_m->shareOA($resID);
        
        foreach($forShare as $fs){
            $message = 'I got '.$fs['result'].' out of '.$fs['noOfItems'].' items for '.$fs['title'].' Online Assessment';
            $name = 'I Passed an Online Assessment!';
            $link = 'e-tesda.gov.ph';
            $description = '';
            $this->postFB($message, $name, $link, $description);
        }
        redirect('syllabus/displayModules/'.$forShare[0]['id']);
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