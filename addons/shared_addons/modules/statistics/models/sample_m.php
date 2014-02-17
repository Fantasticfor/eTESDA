<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a sample module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	Sample Module
 */
class Sample_m extends MY_Model {

	public function __construct()
	{		
		parent::__construct();
		
		/**
		 * If the sample module's table was named "samples"
		 * then MY_Model would find it automatically. Since
		 * I named it "sample" then we just set the name here.
		 */
		$this->_table = 'sample';
	}
	
	//create a new item
	public function create($input)
	{
		$to_insert = array(
			'name' => $input['name'],
			'slug' => $this->_check_slug($input['slug'])
		);

		return $this->db->insert('sample', $to_insert);
	}

	//make sure the slug is valid
	public function _check_slug($slug)
	{
		$slug = strtolower($slug);
		$slug = preg_replace('/\s+/', '-', $slug);

		return $slug;
	}
        
        public function oaBasStat($courseID){
            $query = $this->db->query("SELECT dcc.title, tb.noOfItems, tb.courseID, tb.dateCreated, COUNT(tr.resultID) count FROM default_testbank tb 
            JOIN default_course_courses dcc ON tb.courseID = dcc.id
            JOIN default_testresult tr ON tb.testID = tr.testID
            WHERE tb.type = 'Online Assessment' AND tb.courseID = $courseID");
            $result = $query->row();
            return $result;
        }
        
         public function oaBasCount($courseID){
            $query = $this->db->query("SELECT dcc.title, tb.noOfItems, tb.courseID, tb.dateCreated, COUNT(tr.resultID) count FROM default_testbank tb 
            JOIN default_course_courses dcc ON tb.courseID = dcc.id
            JOIN default_testresult tr ON tb.testID = tr.testID
            WHERE tb.type = 'Online Assessment' AND tb.courseID = $courseID
                    GROUP BY tr.learnerID");
            $result = $query->result_array();
            return $result;
        }
        
        public function scBasStat($courseID){
            $query = $this->db->query("SELECT dmm.title, dmm.id, ts.noOfItems, COUNT(tr.resultID) count
            FROM default_testbank tb
            JOIN default_test_sections ts ON ts.testbankID = tb.testID
            JOIN default_module_modules dmm ON dmm.id = ts.moduleID
            JOIN default_testresult tr ON tr.testID = tb.testID
            WHERE tb.type = 'Self Check' AND tb.courseID = $courseID
            GROUP BY dmm.title");
            $result = $query->result_array();
            return $result;
        }
        
        public function oaBasicInfo($courseID){
            $query = $this->db->query("SELECT dcc.title, tb.courseID, tb.type, COUNT(tr.resultID) count FROM default_testbank tb 
            JOIN default_course_courses dcc ON tb.courseID = dcc.id
            JOIN default_testresult tr ON tb.testID = tr.testID
            WHERE tb.type = 'Online Assessment' AND tb.courseID = $courseID GROUP BY tr.learnerID
            ");
            
            $result = $query->row();
            return $result;
        }
        
        public function oaBasicCount($courseID){
            $query = $this->db->query("SELECT COUNT(tr.resultID) count FROM default_testbank tb 
            JOIN default_course_courses dcc ON tb.courseID = dcc.id
            JOIN default_testresult tr ON tb.testID = tr.testID
            WHERE tb.type = 'Online Assessment' AND tb.courseID = $courseID GROUP BY tr.learnerID
            ");
            
            $result = $query->result_array();
            return $result;
        }
        
        public function scBasicInfo($moduleID){
            $query = $this->db->query("SELECT dcc.title cTitle, dmm.title, dmm.id, ts.noOfItems, COUNT(tr.resultID) count, tb.type, ROUND(AVG(tr.result)) aver
            FROM default_testbank tb
            JOIN default_test_sections ts ON ts.testbankID = tb.testID
            JOIN default_module_modules dmm ON dmm.id = ts.moduleID
            JOIN default_testresult tr ON tr.testID = tb.testID
            JOIN default_course_courses dcc ON dcc.id = tb.courseID
            WHERE tb.type = 'Self Check' AND ts.moduleID = $moduleID
            GROUP BY dmm.title");
            
            $result = $query->row();
            return $result;
        }
        
        public function scBasicCount($moduleID){
            $query = $this->db->query("SELECT dcc.title cTitle, dmm.title, dmm.id, ts.noOfItems, COUNT(tr.resultID) count, tb.type, ROUND(AVG(tr.result)) aver
            FROM default_testbank tb
            JOIN default_test_sections ts ON ts.testbankID = tb.testID
            JOIN default_module_modules dmm ON dmm.id = ts.moduleID
            JOIN default_testresult tr ON tr.testID = tb.testID
            JOIN default_course_courses dcc ON dcc.id = tb.courseID
            WHERE tb.type = 'Self Check' AND ts.moduleID = $moduleID
            GROUP BY tr.learnerID");
            
            $result = $query->result_array();
            return $result;
        }
        
        public function compCount($moduleID){
            $query = $this->db->query("SELECT COUNT(tr.resultID) count
            FROM default_testbank tb JOIN default_testresult tr ON tb.testID = tr.testID
            JOIN default_test_sections ts ON ts.testbankID = tb.testID
            JOIN default_section_results sr ON sr.sectionID = ts.sectionID AND tr.resultID = sr.resultID
            WHERE tb.type = 'Self Check' AND ts.moduleID = $moduleID AND tr.remarks = 'Passed'");
            $result = $query->row();
            return $result;
        }
        
        public function nrCount($moduleID){
            $query = $this->db->query("SELECT COUNT(tr.resultID) count
            FROM default_testbank tb JOIN default_testresult tr ON tb.testID = tr.testID
            JOIN default_test_sections ts ON ts.testbankID = tb.testID
            JOIN default_section_results sr ON sr.sectionID = ts.sectionID AND tr.resultID = sr.resultID
            WHERE tb.type = 'Self Check' AND ts.moduleID = $moduleID AND tr.remarks = 'Failed'");
            $result = $query->row();
            return $result;
        }
        
        public function oaPCount($courseID){
            $query = $this->db->query("SELECT COUNT(tr.resultID) count
            FROM default_testbank tb JOIN default_testresult tr ON tb.testID = tr.testID
            WHERE tb.type = 'Online Assessment' AND tb.courseID = $courseID AND tr.remarks = 'Passed'");
            $result = $query->row();
            return $result;
        }
        
        public function oaNRCount($courseID){
            $query = $this->db->query("SELECT COUNT(tr.resultID) count
            FROM default_testbank tb JOIN default_testresult tr ON tb.testID = tr.testID
            WHERE tb.type = 'Online Assessment' AND tb.courseID = $courseID AND tr.remarks = 'Failed'");
            $result = $query->row();
            return $result;
        }
        
        public function secComp($courseID){
            $query = $this->db->query("SELECT dmm.id, dmm.title, COUNT(tr.resultID) count 
            FROM default_testbank tb JOIN default_testresult tr ON tb.testID = tr.testID
            JOIN default_test_sections ts ON ts.testbankID = tb.testID
            JOIN default_section_results sr ON tr.resultID = sr.resultID AND ts.sectionID = sr.sectionID 
            JOIN default_module_modules dmm ON dmm.id = ts.moduleID
            WHERE sr.remarks = 'Competent' AND tb.type = 'Online Assessment' AND tb.courseID = $courseID
            GROUP BY sr.sectionID");
            $result = $query->result_array();
            return $result;
        }
        
        public function secNR($moduleID){
            $query = $this->db->query("SELECT dmm.id, dmm.title, COUNT(tr.resultID) count 
            FROM default_testbank tb JOIN default_testresult tr ON tb.testID = tr.testID
            JOIN default_test_sections ts ON ts.testbankID = tb.testID
            JOIN default_section_results sr ON tr.resultID = sr.resultID AND ts.sectionID = sr.sectionID 
            JOIN default_module_modules dmm ON dmm.id = ts.moduleID
            WHERE sr.remarks = 'Needs Review' AND tb.type = 'Online Assessment' AND ts.moduleID = $moduleID");
            $result = $query->result_array();
            return $result;
        }
        
        public function getLearnerID($courseID){
            $query = $this->db->query("SELECT learnerID FROM default_learner_courses WHERE courseID = $courseID");
            $result = $query->result_array();
            return $result;
        }
        
        public function modDuration($moduleID){
            $query = $this->db->query("SELECT COUNT(lmID) count, DATEDIFF(dateFinished, dateStarted) diffD FROM default_learner_modules
            WHERE dateFinished != '' AND moduleID = $moduleID
            GROUP BY DATEDIFF(dateFinished, dateStarted)");
            $result = $query->result_array();
            return $result;
        }
        
        public function oaTakers($courseID, $mNow, $yNow){
            $query = $this->db->query("SELECT COUNT(tr.resultID) count, YEAR(tr.dateTaken) yDate, MONTH(tr.dateTaken)-1 mDate, DAY(tr.dateTaken) dDate
            FROM default_testbank tb JOIN default_testresult tr ON tb.testID = tr.testID
            WHERE MONTH(tr.dateTaken) = $mNow AND YEAR(tr.dateTaken) = $yNow
            AND tb.courseID = $courseID AND tb.type = 'Online Assessment'
            GROUP BY DATE(tr.dateTaken)");
            $result = $query->result_array();
            return $result;
        }
        
        public function scTakers($moduleID, $mNow, $yNow){
            $query = $this->db->query("SELECT COUNT(tr.resultID) count, YEAR(tr.dateTaken) yDate, MONTH(tr.dateTaken)-1 mDate, DAY(tr.dateTaken) dDate
            FROM default_testbank tb JOIN default_testresult tr ON tb.testID = tr.testID
            JOIN default_test_sections ts ON ts.testbankID = tb.testID
            WHERE MONTH(tr.dateTaken) = $mNow AND YEAR(tr.dateTaken) = $yNow
            AND ts.moduleID = $moduleID AND tb.type = 'Self Check'
            GROUP BY DATE(tr.dateTaken)");
            $result = $query->result_array();
            return $result;
        }
        
        public function enCountMY($monthNow, $yearNow){
           $query = $this->db->query("
            SELECT default_sector_sectors.title, default_sector_sectors.ID FROM default_sector_sectors JOIN default_syllabus
            ON default_sector_sectors.id = default_syllabus.HeirarchyID WHERE default_syllabus.ID IN
            (SELECT ParentID FROM default_syllabus WHERE HeirarchyID IN (SELECT courseID 
            FROM default_learner_courses  WHERE
            MONTH(dateStarted) = $monthNow
            AND YEAR(dateStarted) = $yearNow AND isEnrolled = 1
            GROUP BY courseID) and Type = 2) GROUP BY 
            default_sector_sectors.title
            ");
            $result = $query->result_array();
           return $result;
        }
        
        public function secCountMY($monthNow, $yearNow, $sectID){
            $query = $this->db->query("SELECT COUNT(lcID) count FROM default_learner_courses WHERE MONTH(dateStarted) = $monthNow
            AND YEAR(dateStarted) = $yearNow AND isEnrolled = 1 AND courseID IN (SELECT HeirarchyID FROM
            default_syllabus WHERE Type = 2 AND ParentID IN (SELECT ID FROM default_syllabus WHERE 
            Type = 1 AND HeirarchyID = $sectID))");
            
            $result = $query->row();
            return $result->count;
        }
        
        public function enCountY($yearNow){
           $query = $this->db->query("
            SELECT default_sector_sectors.title, default_sector_sectors.ID FROM default_sector_sectors JOIN default_syllabus
            ON default_sector_sectors.id = default_syllabus.HeirarchyID WHERE default_syllabus.ID IN
            (SELECT ParentID FROM default_syllabus WHERE HeirarchyID IN (SELECT courseID 
            FROM default_learner_courses WHERE 
            YEAR(dateStarted) = $yearNow AND isEnrolled = 1
            GROUP BY courseID) and Type = 2) GROUP BY 
            default_sector_sectors.title
            ");
            $result = $query->result_array();
           return $result;
        }
        
        public function secCountY($yearNow, $sectID){
            $query = $this->db->query("SELECT COUNT(lcID) count FROM default_learner_courses WHERE
            YEAR(dateStarted) = $yearNow AND isEnrolled = 1 AND courseID IN (SELECT HeirarchyID FROM
            default_syllabus WHERE Type = 2 AND ParentID IN (SELECT ID FROM default_syllabus WHERE 
            Type = 1 AND HeirarchyID = $sectID))");
            
            $result = $query->row();
            return $result->count;
        }
        
        public function secGrCountMY($monthNow, $yearNow){
           $query = $this->db->query("
            SELECT default_sector_sectors.title, default_sector_sectors.ID FROM default_sector_sectors JOIN default_syllabus
            ON default_sector_sectors.id = default_syllabus.HeirarchyID WHERE default_syllabus.ID IN
            (SELECT ParentID FROM default_syllabus WHERE HeirarchyID IN (SELECT courseID 
            FROM default_learner_courses WHERE status = 3 AND
            MONTH(dateFinished) = $monthNow
            AND YEAR(dateFinished) = $yearNow AND isEnrolled = 1
            GROUP BY courseID) and Type = 2) GROUP BY 
            default_sector_sectors.title
            ");
            $result = $query->result_array();
           return $result;
        }
        
        public function grCountMY($monthNow, $yearNow, $sectID){
            $query = $this->db->query("SELECT COUNT(lcID) count FROM default_learner_courses WHERE MONTH(dateFinished) = $monthNow
            AND YEAR(dateFinished) = $yearNow AND isEnrolled = 1 AND status = 3 AND courseID IN (SELECT HeirarchyID FROM
            default_syllabus WHERE Type = 2 AND ParentID IN (SELECT ID FROM default_syllabus WHERE 
            Type = 1 AND HeirarchyID = $sectID))");
            
            $result = $query->row();
            return $result->count;
        }
        
        public function secGrCountY($yearNow){
           $query = $this->db->query("
            SELECT default_sector_sectors.title, default_sector_sectors.ID FROM default_sector_sectors JOIN default_syllabus
            ON default_sector_sectors.id = default_syllabus.HeirarchyID WHERE default_syllabus.ID IN
            (SELECT ParentID FROM default_syllabus WHERE HeirarchyID IN (SELECT courseID 
            FROM default_learner_courses WHERE status = 3 AND
            YEAR(dateStarted) = $yearNow AND isEnrolled = 1
            GROUP BY courseID) and Type = 2) GROUP BY 
            default_sector_sectors.title
            ");
            $result = $query->result_array();
           return $result;
        }
        
        public function grCountY($yearNow, $sectID){
            $query = $this->db->query("SELECT COUNT(lcID) count FROM default_learner_courses WHERE
            YEAR(dateStarted) = $yearNow AND isEnrolled = 1 AND status = 3 AND courseID IN (SELECT HeirarchyID FROM
            default_syllabus WHERE Type = 2 AND ParentID IN (SELECT ID FROM default_syllabus WHERE 
            Type = 1 AND HeirarchyID = $sectID))");
            
            $result = $query->row();
            return $result->count;
        }
        
        public function inactSectCountMY($monthNow, $yearNow, $dateNow){
           $query = $this->db->query("
            SELECT default_sector_sectors.title, default_sector_sectors.ID FROM default_sector_sectors JOIN default_syllabus
            ON default_sector_sectors.id = default_syllabus.HeirarchyID WHERE default_syllabus.ID IN
            (SELECT ParentID FROM default_syllabus WHERE HeirarchyID IN (SELECT dlc.courseID 
            FROM default_learner_courses dlc JOIN default_learner_modules dlm ON dlc.lcID
            = dlm.lcID JOIN default_course_courses dcc ON dcc.id = dlc.courseID
            WHERE dcc.status != 'draft' AND dlc.status != 3 
            AND dlc.isEnrolled = 1
            AND ISNULL(dlm.dateFinished) AND TIMESTAMPDIFF(DAY, dlm.lastVisited, '$dateNow') >= 3
            GROUP BY dlc.courseID) and Type = 2) GROUP BY 
            default_sector_sectors.title
            ");
            $result = $query->result_array();
           return $result;
        }
        
        public function inactCountMY($monthNow, $yearNow, $sectID, $dateNow){
            $query = $this->db->query("SELECT COUNT(dlc.lcID) count FROM default_learner_courses dlc JOIN default_learner_modules dlm
            ON dlc.lcID = dlm.lcID JOIN default_course_courses dcc ON dcc.id = dlc.courseID
            WHERE dcc.status != 'draft'
             AND dlc.isEnrolled = 1 
            AND ISNULL(dlm.dateFinished) AND TIMESTAMPDIFF(DAY, dlm.lastVisited, '$dateNow') >= 3
            AND dlc.courseID IN 
            (SELECT HeirarchyID FROM
            default_syllabus WHERE Type = 2 AND ParentID IN (SELECT ID FROM default_syllabus WHERE 
            Type = 1 AND HeirarchyID = $sectID))");
            
            $result = $query->row();
            return $result->count;
        }
        
        public function inactSectCountY($yearNow, $dateNow){
           $query = $this->db->query("
            SELECT default_sector_sectors.title, default_sector_sectors.ID FROM default_sector_sectors JOIN default_syllabus
            ON default_sector_sectors.id = default_syllabus.HeirarchyID WHERE default_syllabus.ID IN
            (SELECT ParentID FROM default_syllabus WHERE HeirarchyID IN (SELECT dlc.courseID 
            FROM default_learner_courses dlc JOIN default_learner_modules dlm ON dlc.lcID
            = dlm.lcID JOIN default_course_courses dcc ON dcc.id = dlc.courseID WHERE
            dcc.status != 'draft' AND dlc.status != 3
            AND dlc.isEnrolled = 1
            AND ISNULL(dlm.dateFinished) AND TIMESTAMPDIFF(DAY, dlm.lastVisited, '$dateNow') >= 3
            GROUP BY dlc.courseID) and Type = 2) GROUP BY 
            default_sector_sectors.title
            ");
            $result = $query->result_array();
           return $result;
        }
        
        public function inactCountY($yearNow, $sectID, $dateNow){
            $query = $this->db->query("SELECT COUNT(dlc.lcID) count FROM default_learner_courses dlc JOIN default_learner_modules dlm
            ON dlc.lcID = dlm.lcID JOIN default_course_courses dcc ON dcc.id = dlc.courseID
            WHERE dlc.isEnrolled = 1  AND dcc.status != 'draft'
            AND ISNULL(dlm.dateFinished) AND TIMESTAMPDIFF(DAY, dlm.lastVisited, '$dateNow') >= 3
            AND dlc.courseID IN 
            (SELECT HeirarchyID FROM
            default_syllabus WHERE Type = 2 AND ParentID IN (SELECT ID FROM default_syllabus WHERE 
            Type = 1 AND HeirarchyID = $sectID))");
            
            $result = $query->row();
            return $result->count;
        }
        
        public function sumEnCountMY($monthNow, $yearNow){
            $query = $this->db->query("SELECT COUNT(lcID) count FROM default_learner_courses WHERE MONTH(dateStarted) = $monthNow
            AND YEAR(dateStarted) = $yearNow AND isEnrolled = 1 ");
            
            $result = $query->row();
            return $result->count;
        }
        
        public function sumEnCountY($yearNow){
            $query = $this->db->query("SELECT COUNT(lcID) count FROM default_learner_courses WHERE
            YEAR(dateStarted) = $yearNow AND isEnrolled = 1");
            
            $result = $query->row();
            return $result->count;
        }
        
        public function sumGrCountMY($monthNow, $yearNow){
            $query = $this->db->query("SELECT COUNT(lcID) count FROM default_learner_courses WHERE MONTH(dateStarted) = $monthNow
            AND YEAR(dateStarted) = $yearNow AND isEnrolled = 1 AND status = 3 ");
            
            $result = $query->row();
            return $result->count;
        }
        
        public function sumGrCountY($yearNow){
            $query = $this->db->query("SELECT COUNT(lcID) count FROM default_learner_courses WHERE
            YEAR(dateStarted) = $yearNow AND isEnrolled = 1 AND status = 3 ");
            
            $result = $query->row();
            return $result->count;
        }
        
        public function sumInactCountMY($monthNow, $yearNow, $dateNow){
            $query = $this->db->query("SELECT COUNT(dlc.lcID) count FROM default_learner_courses dlc JOIN default_learner_modules dlm
            ON dlc.lcID = dlm.lcID JOIN default_course_courses dcc ON dcc.id = dlc.courseID
            WHERE dcc.status != 'draft' AND dlc.isEnrolled = 1 
            AND ISNULL(dlm.dateFinished) AND TIMESTAMPDIFF(DAY, dlm.lastVisited, '$dateNow') >= 3
            ");
            
            $result = $query->row();
            return $result->count;
        }
        
        public function sumInactCountY($yearNow, $dateNow){
            $query = $this->db->query("SELECT COUNT(dlc.lcID) count FROM default_learner_courses dlc JOIN default_learner_modules dlm
            ON dlc.lcID = dlm.lcID JOIN default_course_courses dcc ON dcc.id = dlc.courseID
            WHERE dlc.isEnrolled = 1 AND dcc.status != 'draft' 
            AND ISNULL(dlm.dateFinished) AND TIMESTAMPDIFF(DAY, dlm.lastVisited, '$dateNow') >= 3
            ");
            
            $result = $query->row();
            return $result->count;
        }
        
        public function getSectCourses($sectID){
            $query = $this->db->query("SELECT dcc.id, dcc.title, dcc.status
            FROM default_course_courses dcc JOIN default_syllabus syll ON dcc.ID = syll.HeirarchyID WHERE 
            syll.Type = 2 AND syll.ParentID = (SELECT ID FROM default_syllabus WHERE Type = 1 AND HeirarchyID = $sectID)");
            $result = $query->result_array();
            return $result;
        }
        
        
        public function couEnCountMY($monthNow, $yearNow, $courseID){
            $query = $this->db->query("SELECT COUNT(lcID) count FROM default_learner_courses WHERE MONTH(dateStarted) = $monthNow
            AND YEAR(dateStarted) = $yearNow AND isEnrolled = 1 AND courseID = $courseID");
            
            $result = $query->row();
            return $result->count;
        }
        
        public function couEnCountY($yearNow, $courseID){
            $query = $this->db->query("SELECT COUNT(lcID) count FROM default_learner_courses WHERE YEAR(dateStarted) = $yearNow AND isEnrolled = 1 AND courseID = $courseID");
            
            $result = $query->row();
            return $result->count;
        }
        
        public function couGrCountMY($monthNow, $yearNow, $courseID){
            $query = $this->db->query("SELECT COUNT(lcID) count FROM default_learner_courses WHERE MONTH(dateFinished) = $monthNow
            AND YEAR(dateFinished) = $yearNow AND isEnrolled = 1 AND status = 3 AND courseID = $courseID");
            
            $result = $query->row();
            return $result->count;
        }
        
        public function couGrCountY($yearNow, $courseID){
            $query = $this->db->query("SELECT COUNT(lcID) count FROM default_learner_courses WHERE YEAR(dateFinished) = $yearNow AND isEnrolled = 1 AND status = 3 AND courseID = $courseID");
            
            $result = $query->row();
            return $result->count;
        }
        
        public function couInCountMY($monthNow, $yearNow, $courseID, $dateNow){
            $query = $this->db->query("SELECT COUNT(dlc.lcID) count FROM default_learner_courses dlc JOIN default_learner_modules dlm
            ON dlc.lcID = dlm.lcID JOIN default_course_courses dcc ON dcc.id = dlc.courseID
            WHERE dcc.status != 'draft'
            AND dlc.isEnrolled = 1 
            AND ISNULL(dlm.dateFinished) AND TIMESTAMPDIFF(DAY, dlm.lastVisited, '$dateNow') >= 3
            AND dlc.courseID = $courseID");
            
            $result = $query->row();
            return $result->count;
        }
        
        public function couInCountY($yearNow, $courseID, $dateNow){
            $query = $this->db->query("SELECT COUNT(dlc.lcID) count FROM default_learner_courses dlc JOIN default_learner_modules dlm
            ON dlc.lcID = dlm.lcID JOIN default_course_courses dcc ON dcc.id = dlc.courseID
            WHERE dlc.isEnrolled = 1 AND dcc.status != 'draft'
            AND ISNULL(dlm.dateFinished) AND TIMESTAMPDIFF(DAY, dlm.lastVisited, '$dateNow') >= 3
            AND dlc.courseID = $courseID");
            
            $result = $query->row();
            return $result->count;
        }
        
        public function leaEnCountMY($monthNow, $yearNow, $courseID){
            $query = $this->db->query("SELECT learnerID, dateStarted, status FROM default_learner_courses WHERE MONTH(dateStarted) = $monthNow
            AND YEAR(dateStarted) = $yearNow AND isEnrolled = 1 AND courseID = $courseID");
            
            $result = $query->result_array();
            return $result;
        }
        
        public function leaEnCountY($yearNow, $courseID){
            $query = $this->db->query("SELECT learnerID, dateStarted, status FROM default_learner_courses 
                WHERE YEAR(dateStarted) = $yearNow AND isEnrolled = 1 AND courseID = $courseID");
            
            $result = $query->result_array();
            return $result;
        }
        
        public function leaGrCountMY($monthNow, $yearNow, $courseID){
            $query = $this->db->query("SELECT learnerID, dateStarted, dateFinished FROM default_learner_courses WHERE MONTH(dateFinished) = $monthNow
            AND YEAR(dateFinished) = $yearNow AND isEnrolled = 1 AND status = 3 AND courseID = $courseID");
            
            $result = $query->result_array();
            return $result;
        }
        
        public function leaGrCountY($yearNow, $courseID){
            $query = $this->db->query("SELECT learnerID, dateStarted, dateFinished FROM default_learner_courses WHERE YEAR(dateFinished) = $yearNow AND isEnrolled = 1 AND status = 3 AND courseID = $courseID");
            
            $result = $query->result_array();
            return $result;
        }
        
        public function leaInCountMY($monthNow, $yearNow, $courseID, $dateNow){
            $query = $this->db->query("SELECT dlc.learnerID, dlc.dateStarted, dlc.status, dmm.title FROM default_learner_courses dlc JOIN default_learner_modules dlm
            ON dlc.lcID = dlm.lcID JOIN default_module_modules dmm ON dmm.id = dlm.moduleID
            JOIN default_course_courses dcc ON dcc.id = dlc.courseID
            WHERE dcc.status != 'draft'
            AND dlc.isEnrolled = 1 
            AND ISNULL(dlm.dateFinished) AND TIMESTAMPDIFF(DAY, dlm.lastVisited, '$dateNow') >= 3
            AND dlc.courseID = $courseID");
            
            $result = $query->result_array();
            return $result;
        }
        
        public function leaInCountY($yearNow, $courseID, $dateNow){
            $query = $this->db->query("SELECT dlc.learnerID, dlc.dateStarted, dlc.status FROM default_learner_courses dlc JOIN default_learner_modules dlm
            ON dlc.lcID = dlm.lcID JOIN default_course_courses dcc ON dcc.id = dlc.courseID
            WHERE dlc.isEnrolled = 1 AND dcc.status != 'draft'
            AND ISNULL(dlm.dateFinished) AND TIMESTAMPDIFF(DAY, dlm.lastVisited, '$dateNow') >= 3
            AND dlc.courseID = $courseID");
            
            $result = $query->result_array();
            return $result;
        }
        
        public function couInCount($courseID, $dateNow){
            $query = $this->db->query("SELECT COUNT(dlc.lcID) count FROM default_learner_courses dlc JOIN default_learner_modules dlm
            ON dlc.lcID = dlm.lcID JOIN default_course_courses dcc ON dcc.id = dlc.courseID
            WHERE dlc.isEnrolled = 1 
            AND dcc.status != 'draft' AND ISNULL(dlm.dateFinished) AND TIMESTAMPDIFF(DAY, dlm.lastVisited, '$dateNow') >= 3
            AND dlc.courseID = $courseID");
            
            $result = $query->row();
            return $result->count;
        }
        
        public function leaInInfo($courseID, $dateNow){
            $query = $this->db->query("SELECT dlc.learnerID, dlc.dateStarted, dlc.status, dmm.title  FROM default_learner_courses dlc JOIN default_learner_modules dlm
            ON dlc.lcID = dlm.lcID JOIN default_module_modules dmm ON dmm.id = dlm.moduleID
            JOIN default_course_courses dcc ON dcc.id = dlc.courseID
            WHERE dlc.isEnrolled = 1 AND dcc.status != 'draft'
            AND ISNULL(dlm.dateFinished) AND TIMESTAMPDIFF(DAY, dlm.lastVisited, '$dateNow') >= 3
            AND dlc.courseID = $courseID");
            
            $result = $query->result_array();
            return $result;
        }
        
        public function getAllSects(){
            $query = $this->db->query("SELECT id, title FROM default_sector_sectors");
            $result = $query->result_array();
            return $result;
        }
        
        public function couLearners($courseID){
            $query = $this->db->query("SELECT learnerID FROM default_learner_courses WHERE isEnrolled = 1 AND courseID = $courseID");
            $result = $query->result_array();
            return $result;
        }
        
        public function learnEnCount($learnerID){
            $query = $this->db->query("SELECT COUNT(lcID) count
                FROM default_learner_courses WHERE isEnrolled = 1 AND learnerID = $learnerID");
            $result = $query->result_array();
            return $result;
        }
        
        public function learnCourseDets($courseID, $mon, $year){
            $query = $this->db->query("SELECT learnerID, dateStarted, status FROM default_learner_courses 
            WHERE courseID = $courseID AND isEnrolled = 1 
            AND MONTH(dateStarted) = $mon AND YEAR(dateStarted) = $year");
            $result = $query->result_array();
            return $result;
        }
        
        public function countFollow($courseID, $mon, $year){
            $query = $this->db->query("SELECT COUNT(lcID) count FROM default_learner_courses 
            WHERE courseID = $courseID AND isEnrolled = 1 AND status = 1
            AND MONTH(dateStarted) = $mon AND YEAR(dateStarted) = $year");
            $result = $query->result_array();
            return $result;
        }
        
        public function countReady($courseID, $mon, $year){
            $query = $this->db->query("SELECT COUNT(lcID) count FROM default_learner_courses 
            WHERE courseID = $courseID AND isEnrolled = 1 AND status = 2
            AND MONTH(dateStarted) = $mon AND YEAR(dateStarted) = $year");
            $result = $query->result_array();
            return $result;
        }
        
        public function countCert($courseID, $mon, $year){
            $query = $this->db->query("SELECT COUNT(lcID) count FROM default_learner_courses 
            WHERE courseID = $courseID AND isEnrolled = 1 AND status = 3
            AND MONTH(dateStarted) = $mon AND YEAR(dateStarted) = $year");
            $result = $query->result_array();
            return $result;
        }
        
        public function gradCourseDets($courseID, $mon, $year){
            $query = $this->db->query("SELECT learnerID, dateStarted, dateFinished FROM default_learner_courses 
            WHERE courseID = $courseID AND isEnrolled = 1 
            AND MONTH(dateFinished) = $mon AND YEAR(dateFinished) = $year AND status = 3");
            $result = $query->result_array();
            return $result;
        }
        
        public function inactCourseDets($courseID, $dateNow){
            $query = $this->db->query("SELECT dlc.learnerID, dlc.dateStarted, dmm.title FROM default_learner_courses dlc JOIN default_learner_modules dlm
            ON dlc.lcID = dlm.lcID JOIN default_module_modules dmm ON dmm.id = dlm.moduleID
            JOIN default_course_courses dcc ON dcc.id = dlc.courseID
            WHERE dlc.isEnrolled = 1 AND dcc.status != 'draft'
            AND ISNULL(dlm.dateFinished) AND TIMESTAMPDIFF(DAY, dlm.lastVisited, '$dateNow') >= 3
            AND dlc.courseID = $courseID GROUP BY dlm.lcID");
            $result = $query->result_array();
            return $result;
        }
        
        public function getCName($sectID){
            $query = $this->db->query("SELECT title FROM default_sector_sectors WHERE id = $sectID");
            $result = $query->row();
            return $result->title;
        }
        
        
}
