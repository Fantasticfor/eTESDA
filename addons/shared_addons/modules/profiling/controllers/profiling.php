<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a sample module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	Sample Module
 */
class Profiling extends Public_Controller
{
	public function __construct()
	{
		parent::__construct();

		// Load the required classes
		
                $this->load->model('profiling_m');
		
	}

	/**
	 * All items
	 */
	public function index($offset = 0)
	{
            //echo 'AAAA';
	}
        
        public function InterestTest(){
//            unset($_SESSION['interestTestInfo']);
            if(isset($_SESSION['interestTestInfo'])){
                $testinfo = $_SESSION['interestTestInfo'];
            }else{
            
                $testinfo = $this->generateProfiling(1);
                $_SESSION['interestTestInfo'] = $testinfo;
            }
           
            $ctr = 1;
            foreach($testinfo['sections'] as $section){
            //print_r($testinfo['answers']);
            $count = $section['noOfItems'];
            //echo $count.'|';
            for($i = 1; $i<=$count; $i++){
                
                $this->form_validation->set_rules('ans'.$ctr.'['.$i.']', 'Section '.$ctr. 'Question '.$i, 'required');
            }
            
            $ctr++;
            }
            
                if($this->form_validation->run()){
                    
                        $sectionscores = array();
                        $ctr = 1;
                        $choicesctr = 0;
                        $totalscore = 0;

                        foreach ($this->input->post() as $postitems) {
                            $score = 0;
                            foreach ($postitems as $items) {
                                if (strcasecmp($items, $testinfo['correct'][$ctr][$choicesctr]) == 0) {
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
                        $_SESSION['Intscores'] = $sectionscores;
                      redirect('profiling/AbilityTest');
                    
                    
                }
            
            $this->template
                    ->set('sections',$testinfo['sections'])
                    ->set('questions',$testinfo['questions'])
                    ->set('answers',$testinfo['answers'])
                    ->build('test_Interest');
        }
        
        public function AbilityTest(){
//            unset($_SESSION['abilityTestInfo']);
//            unset($_SESSION['counterr']); 
//            unset(  $_SESSION['postabs']);
            if(isset($_SESSION['abilityTestInfo'])){
                $testinfo = $_SESSION['abilityTestInfo'];
            }else{
            
                $testinfo = $this->generateProfiling(0);
                $_SESSION['abilityTestInfo'] = $testinfo;
            }
            
            if(isset($_SESSION['counterr'])){
                $ctr = $_SESSION['counterr'];
            }else{
                $ctr = 1;
                $_SESSION['counterr'] = $ctr;
                
            }
            
            $_SESSION['secAbCnt'] = count($testinfo['sections']);

            
            //print_r($testinfo['answers'][$ctr]);
            //print_r($testinfo['sections']);
            $this->template
                    ->set('sections',$testinfo['sections'][$ctr-1])
                    ->set('questions',$testinfo['questions'][$ctr])
                    ->set('answers',$testinfo['answers'][$ctr])
                    ->build('test_Ability');
        }
        
        public function nextSection(){
            //print_r($this->input->post());
          
           
            if( $_SESSION['secAbCnt'] <= $_SESSION['counterr'] ){
                $postans = $this->input->post();
                 $_SESSION['postabs'][] = $postans['ans1'];
               //print_r($_SESSION['postabs']);
//                print_r($_SESSION['abilityTestInfo']['correct']);
                $sectionscores = array();
                        $ctr = 1;
                        $choicesctr = 0;
                        $totalscore = 0;

                        foreach ($_SESSION['postabs'] as $postitems) {
                            $score = 0;
                            if(empty($postitems)){
                                
                            }else{
                            
                                foreach ($postitems as $key => $items) {
    //                                echo $key;
    //                                echo $_SESSION['abilityTestInfo']['correct'][$ctr][$key];
                                    //$a = $key-1;
                                    if (strcasecmp($items, $_SESSION['abilityTestInfo']['correct'][$ctr][$key]) == 0) {
                                        //echo $choicesctr;
                                        $score++;
                                    }
                                    $choicesctr++;
                                }
                            }
                            $totalscore+=$score;
                            $sectionscores[$ctr] = array('score' => $score);
                            $choicesctr = 0;
                            $ctr++;
                        }
//                        print_r($sectionscores);
                        $_SESSION['Abscores'] = $sectionscores;
                        redirect('profiling/results');
                
                
            }else{
                   $postans = $this->input->post();
          $_SESSION['counterr']++;
          $_SESSION['postabs'][] = $postans['ans1'];
          //print_r($postans);
             
                  redirect('profiling/AbilityTest');
            }
            
          
        }
        
        public function results(){
            $this->load->model('profiling_m');
             $interestSections = $this->profiling_m->getAllInterest();
             $abilitySections = $this->profiling_m->getAllAbility();
             date_default_timezone_set('Hongkong');
             $iscore = $_SESSION['Intscores'];
             $ascore = $_SESSION['Abscores'];
//             print_r($ascore);
//             print_r($_SESSION['postabs']);
//              print_r($_SESSION['abilityTestInfo']['correct']);
            unset($_SESSION['abilityTestInfo']);
            unset($_SESSION['counterr']); 
            unset(  $_SESSION['postabs']);
            
            $itrID = $this->profiling_m->trInterest($this->session->userdata('userid'), $interestSections[1]['testID'],date("Y-m-d H:i:s"));
            $atrID = $this->profiling_m->trAbility($this->session->userdata('userid'), $abilitySections[1]['testID'],date("Y-m-d H:i:s"));
            
            $iCount = 1;
            $aCount = 1;
            
            foreach($interestSections as $is){
                $this->profiling_m->secInterest($itrID, $is['sectionID'], $iscore[$iCount]['score']);
                $iCount += 1;
            }
            
            foreach($abilitySections as $as){
                $this->profiling_m->secAbility($atrID, $as['sectionID'], $ascore[$aCount]['score']);
                $aCount += 1;
            }
            
            $interestHighscore = max($iscore);
            $interestIndexHS = array_keys($iscore,$interestHighscore);
            
            foreach($interestIndexHS as $intIndex){
                $interestSectionsHS []= $interestSections[$intIndex-1]['sectionID'];
            }
           // print_r($interestSectionsHS);
            
            
            $abilityHighscore = max($ascore);
            $abilityIndexHS = array_keys($ascore,$abilityHighscore);
            
            foreach($abilityIndexHS as $abIndex){
                $abilitySectionsHS []= $abilitySections[$abIndex-1]['sectionID'];
            }
           
            
            foreach($interestSectionsHS as $interests){
                 
                $resultI []= $this->profiling_m->getInterestsCourse($interests);
            }
            
            foreach($abilitySectionsHS as $abilities){
                $resultA []= $this->profiling_m->getAbilitiesCourse($abilities);
            }
            
//            print_r($resultA);
//            print_r($resultI);
            
            $recommended = array();
            
            foreach($resultA as $a){
                foreach($a as $x){
                    
                    if(isset($recommended[$x['courseID']])){

                    }else{
                        $recommended[$x['courseID']] = array($x['title'],$x['image'],$this->profiling_m->getSector($x['courseID']));
                    }
                    
                }
                
            }
            
             foreach($resultI as $b){
                 foreach($b as $z){
                     
                    if(isset($recommended[$z['courseID']])){

                    }else{
                        $recommended[$z['courseID']] = array($z['title'],$z['image'],$this->profiling_m->getSector($z['courseID']));
                    }
                 }
            }
            
            //print_r($recommended);
//            print_r($interestSectionsHS);
//            print_r($abilitySectionsHS);
//            
//            //print_r($interestIndexHS);
//            //print_r(max($iscore));
//            //print_r(array_keys($iscore,max($iscore)));
////            print_r(array_search($interestHighscore, $iscore));
////            
//            print_r($abilitySections);
//            print_r($ascore);
            
            $this->template
                    ->set('isec',$interestSections)
                    ->set('asec',$abilitySections)
                    ->set('iscore',$iscore)
                    ->set('ascore',$ascore)
                    ->set('recommended',$recommended)
                    ->build('results_ProfilingTest');
        }
        

        public function generateProfiling($type) {
        $interestQuestions = array();
        $abilityQuestions = array();
        $interestAnswers = array();
        $abilityAnswers = array();
        $interestCorrect = array();
        $abilityCorrect = array();
        $isectionctr = 1;
        $asectionctr = 1;
        
         $retarray = array();
       
         if($type == 1){
                $interestSections = $this->profiling_m->getAllInterest();
                



                foreach($interestSections as $intsec){
                    $interestItems = $this->profiling_m->getItems($intsec['sectionID'],$intsec['noOfItems']);
                    //$interestQuestions[] = $interestItems;

                    $tf = array();
                            foreach ($interestItems as $i) {
                                 $interestQuestions[$isectionctr][] = $i;
                                if ($i['response'] == 'Agree' || $i['response'] == 'agree') {
                                    $tf = array('Agree', 'Disagree');
                                } else {
                                    $tf = array('Disagree', 'Agree');
                                }

                                $interestAnswers[$i['prompt']][] = $tf;
                                $interestCorrect[$isectionctr][] = $i['response'];
                            }
                            $isectionctr++;
                }
                            $retarray['questions'] = $interestQuestions;
                            $retarray['answers'] = $interestAnswers;
                            $retarray['correct'] = $interestCorrect;
                            $retarray['sections'] = $interestSections;
         }
         else{
          $abilitySections = $this->profiling_m->getAllAbility();
        
                foreach($abilitySections as $absec){
                    $abilityItems = $this->profiling_m->getItems($absec['sectionID'],$absec['noOfItems']);

                    //$abilityQuestions[$asectionctr][] = $abilityItems;
                    $asd = 1;
                    foreach ($abilityItems as $i) {
                          $abilityQuestions[$asectionctr][] = $i;
                                $try = array();

                                $choices = $this->profiling_m->getChoices($i['itemID']);
                              
                                foreach ($choices as $key => $choice) {
                                    array_push($try, $choice['choice']);
                                    if ($key == 0) {
                                        $abilityCorrect[$asectionctr][$asd] = $choice['choice'];
                                    }
                                    
                                }
                                $asd++;
                                $abilityAnswers[$asectionctr][$i['prompt']] = $this->shuffle_assoc($try);
                            }

                  $asectionctr++;  
                }

                  $retarray['questions'] = $abilityQuestions;
                  $retarray['answers'] = $abilityAnswers;
                  $retarray['correct'] = $abilityCorrect;
                  $retarray['sections'] = $abilitySections;
               
         }
         
         return $retarray;
        

    }
    
    
    
    
    

    public function shuffle_assoc($array) {
        $keys = array_rand($array, count($array));

        shuffle($keys);

        foreach ($keys as $key)
            $new[$key] = $array[$key];
        $array = $new;
        return $array;
    }
    
    public function viewProf(){
        $this->load->model('profiling_m');
        
        $intLat = $this->profiling_m->latInterest($this->session->userdata('userid'));
        $abLat = $this->profiling_m->latAbility($this->session->userdata('userid'));
        
        $intRes = $this->profiling_m->intRes($this->session->userdata('userid'), $intLat->latest);
        $abRes = $this->profiling_m->abRes($this->session->userdata('userid'), $intLat->latest);
        
        
        
        $this->template
                ->set('intRes', $intRes)
                ->set('abRes', $abRes)
                ->build('profilingTest');
    }

    
    
         
            
        
}