<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a sample module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	Sample Module
 */
class Test_m extends MY_Model {

	public function __construct()
	{		
		parent::__construct();
		
		/**
		 * If the sample module's table was named "samples"
		 * then MY_Model would find it automatically. Since
		 * I named it "sample" then we just set the name here.
		 */
		
	}
	
        public function getTest($courseid){
            $result = $this->db->select('*')
                    ->where('courseID', $courseid)
                    ->where('type', "Online Assessment")
                    ->get('testbank')
                    ->row();
            
            return $result;
        }
        
        public function getSelfCheckTest($courseid){
            $result = $this->db->select('*')
                    ->where('courseID', $courseid)
                    ->where('type', "Self Check")
                    ->get('testbank')
                    ->row();
            
            return $result;
        }
        
        public function getTestSections($testID){
            $result = $this->db->select('test_sections.*')
                    
                    ->join('module_modules','module_modules.id = test_sections.moduleID')
                    ->where('module_modules.status', 'live')
                    ->where('test_sections.testbankID', $testID)
                    ->get('test_sections')
                    ->result_array();
            
            return $result;
        }
        
        public function getSelfCheck($courseID,$moduleID){
            $result =   $this->db->select('test_sections.*')
                ->join('testbank', 'testbank.testID = test_sections.testbankID')
                ->where('test_sections.moduleID',$moduleID)
                ->where('testbank.courseID',$courseID)
                ->where('testbank.type', "Self Check")
                ->get('test_sections')
                ->row();

            return $result;
        }
        
        public function getDifficultyCount($courseid,$moduleid,$testtype){
            $result = $this->db->select('difficulty')
                    ->where('courseID', $courseid)
                    ->where('moduleID',$moduleid)
                    ->where('testType', $testtype)
                    ->distinct()
                    ->get('test_itembank');
            
            return $result->num_rows();
                    
        }
        
        public function getDifficulties($courseid,$moduleid,$testtype){
            $result = $this->db->select('difficulty')
                    ->where('courseID', $courseid)
                    ->where('moduleID',$moduleid)
                    ->where('testType', $testtype)
                    ->distinct()
                    ->get('test_itembank')
                    ->result_array();
            
            return $result;
                    
        }
        
         public function getItem($courseid,$moduleid,$testtype,$difficulty,$limit,$category){
            if($category == 0){
                $notEq = 1;
            }else{
                $notEq = 0;
            }
            
            $result = $this->db->select('*')
                    ->where('courseID', $courseid)
                    ->where('moduleID',$moduleid)
                    ->where('testType', $testtype)
                    ->where('difficulty', $difficulty)
                    ->where('category !=',$notEq)
                   // ->or_where('category', 3)
                    ->limit($limit)
                    ->order_by('itemID', 'RANDOM')
                    ->get('test_itembank')
                    ->result_array();
            
            return $result;
        }
        
        
        public function getAllItem($courseid,$moduleid,$testtype,$difficulty){
            $result = $this->db->select('*')
                    ->where('courseID', $courseid)
                    ->where('moduleID',$moduleid)
                    ->where('testType', $testtype)
                    ->where('difficulty', $difficulty)
                    ->order_by('itemID', 'RANDOM')
                    ->get('test_itembank')
                    ->result_array();
            
            return $result;
        }
        
        public function getRandomItem($courseid,$moduleid,$testtype,$limit){
            $result = $this->db->select('*')
                    ->where('courseID', $courseid)
                    ->where('moduleID',$moduleid)
                    ->where('testType', $testtype)
                    
                    ->limit($limit)
                    ->order_by('itemID', 'RANDOM')
                    ->get('test_itembank')
                    ->result_array();
            
            return $result;
        }
        
        public function getChoices($itemID){
            $result = $this->db->select('*')
                    ->where('itemID',$itemID)
                    ->order_by('response','desc')
                    ->get('testmc_choices')
                    ->result_array();
            
            return $result;
        }
        
        public function getCourseDetails($id){
            
             $this->load->driver('Streams');
            
           // $entries = $this->streams->entries->get_entr($params);
            $entries = $this->streams->entries->get_entry($id,'courses','course', true);
           // print_r($entries);
            return $entries;
            
        }
        public function getModuleDetails($id){
            
             $this->load->driver('Streams');
            
           // $entries = $this->streams->entries->get_entr($params);
            $entries = $this->streams->entries->get_entry($id,'modules','module', true);
           // print_r($entries);
            return $entries;
            
        }
        
         public function getParent($id){
            $result = $this->db->select('ParentID')
                    ->where('HeirarchyID',$id)
                    ->where('Type',3)
                    ->get('syllabus')
                    ->result_array();
            return $result[0]['ParentID'];
        }
        
        public function getHid($syllaid){
            $coruseid = $this->db->select('HeirarchyID')
                    ->where('ID',$syllaid)
                    ->get('syllabus')
                    ->row();
            
            return $coruseid->HeirarchyID;
            
        }
        
        public function getModuleName($modid){
            $modulename = $this->db->select('title')
                    ->where('id',$modid)
                    ->get('module_modules')
                    ->row();
            
            return $modulename;
        }
        
         public function addTestResult($learnerID, $testID, $result, $dateTaken, $remarks){
        
         $to_insert = array(
			
			'learnerID' => $learnerID,
                        'testID' => $testID,
                        'result' => $result,
                        'dateTaken' => $dateTaken,
                        'remarks' => $remarks
              );
                        
            $this->db->insert('default_testresult', $to_insert);
            return $this->db->insert_id();
        }
        
        public function addSectResult($resultID, $sectionID, $result, $remarks){
        
         $to_insert = array(
			
			'resultID' => $resultID,
                        'sectionID' => $sectionID,
                        'result' => $result,
                        'remarks' => $remarks
              );
                        
            $this->db->insert('default_section_results', $to_insert);
            return $sectionID;
        }
        
        public function getModPK($learnerID, $moduleID){
            $query = $this->db->query("SELECT dlm.lmID FROM default_learner_courses dlc JOIN default_learner_modules dlm ON dlc.lcID = dlm.lcID
            WHERE dlc.learnerID = $learnerID AND dlm.moduleID = $moduleID");
            $result = $query->row();
            return $result->lmID;
        }
        
        public function updateModFin($lmID, $dateFinished){
        
         $to_insert = array(
			
			'dateFinished' => $dateFinished
              );
                        
            $this->db->where('lmID',$lmID)
                   ->update('default_learner_modules', $to_insert);
        }
        
        public function getTBDet($testID){
            $query = $this->db->query("SELECT * FROM default_testbank WHERE testID = $testID");
            $result = $query->result_array();
            return $result;
        }
        
        public function shareSC($resID){
            $query = $this->db->query("SELECT dcc.id, dmm.title, tr.result, ts.noOfItems
            FROM default_testbank tb JOIN default_testresult tr ON tb.testID = tr.testID
            JOIN default_test_sections ts ON ts.testbankID = tb.testID
            JOIN default_module_modules dmm ON dmm.id = ts.moduleID
            JOIN default_course_courses dcc ON dcc.id = tb.courseID
            WHERE tr.resultID = $resID AND tb.type = 'Self Check'");
            $result = $query->result_array();
            return $result;
        
        }
        
        public function shareOA($resID){
            $query = $this->db->query("SELECT dcc.id, dcc.title, tr.result, tb.noOfItems
            FROM default_testbank tb JOIN default_testresult tr ON tb.testID = tr.testID
            JOIN default_course_courses dcc ON dcc.id = tb.courseID
            WHERE tr.resultID = $resID AND tb.type = 'Online Assessment'");
            $result = $query->result_array();
            return $result;
        }
        
        public function cName($resID){
            $query = $this->db->query("SELECT dcc.id, dcc.title FROM default_testbank tb JOIN default_testresult tr ON tb.testID = tr.testID
            JOIN default_course_courses dcc ON dcc.id = tb.courseID
            WHERE tr.resultID = $resID");
            $result = $query->row();
            return $result;
        }
        
        public function ifModExist($moduleID, $learnerID){
            $query = $this->db->query("SELECT dlm.moduleID FROM default_learner_modules dlm JOIN default_learner_courses dlc 
            ON dlm.lcID = dlc.lcID WHERE dlc.learnerID = $learnerID
            AND dlm.moduleID = $moduleID");
            $result = $query->result_array();
            return $result;
        }
        
        public function getLCID($courseID, $learnerID){
            $query = $this->db->query("SELECT lcID FROM default_learner_courses WHERE 
                courseID = $courseID AND learnerID = $learnerID");
            $result = $query->row();
            return $result->lcID;
        }
        
        public function addMod($lcID, $moduleID, $dateStarted, $lastVisited){
        
         $to_insert = array(
			
			'lcID' => $lcID,
                        'moduleID' => $moduleID,
                        'dateStarted' => $dateStarted,
                        'lastVisited' => $lastVisited
              );
                        
            $this->db->insert('default_learner_modules', $to_insert);
          
        }
        
        public function newActivity($learnerID, $activity, $dateDone){
        
         $to_insert = array(
			
			'learnerID' => $learnerID,
                        'activity' => $activity,
                        'dateDone' => $dateDone
              );
                        
            $this->db->insert('default_recentactivity', $to_insert);
        }
        
        public function getBadName($courseID){
            $query = $this->db->query("SELECT name FROM default_badge_badges
                WHERE activity = 'Passed an Online Assessment' AND course = $courseID");
            $result = $query->row();
            $numrows = $query->num_rows();
            if($numrows == 0){
                return '';
            }else{
                return $result->name;
            }
        }
        
        public function getBadImg($courseID){
            $query = $this->db->query("SELECT image FROM default_badge_badges
                WHERE activity = 'Passed an Online Assessment' AND course = $courseID");
            $result = $query->row();
            $numrows = $query->num_rows();
            if($numrows == 0){
                return '';
            }else{
                return $result->image;
            }
        }
        
        
        
}
