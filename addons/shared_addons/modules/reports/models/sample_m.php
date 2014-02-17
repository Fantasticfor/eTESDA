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
        
        public function enrolleeRep($monthNow, $yearNow){
            $query = $this->db->query("SELECT dcc.title, dlc.learnerID, dlc.status, dlc.dateStarted 
            FROM default_learner_courses dlc JOIN default_course_courses dcc ON dcc.id = dlc.courseID
            WHERE MONTH(dlc.dateStarted) = $monthNow AND YEAR(dlc.dateStarted) = $yearNow AND dlc.isEnrolled = 1");
            $result = $query->result_array();
            return $result;
        }
        
//        public function enCount($monthNow, $yearNow){
//            $query = $this->db->query("SELECT courseID, COUNT(lcID) count FROM default_learner_courses 
//            WHERE MONTH(dateStarted) = $monthNow
//            AND YEAR(dateStarted) = $yearNow AND isEnrolled = 1 GROUP BY courseID");
//            $result = $query->result_array();
//            return $result;
//        }
        public function enCount($monthNow, $yearNow){
           $query = $this->db->query("
            SELECT default_sector_sectors.title, default_sector_sectors.ID FROM default_sector_sectors JOIN default_syllabus
            ON default_sector_sectors.id = default_syllabus.HeirarchyID WHERE default_syllabus.ID IN
            (SELECT ParentID FROM default_syllabus WHERE HeirarchyID IN (SELECT courseID 
            FROM default_learner_courses WHERE 
            MONTH(dateStarted) = $monthNow
            AND YEAR(dateStarted) = $yearNow AND isEnrolled = 1
            GROUP BY courseID) and Type = 2) GROUP BY 
            default_sector_sectors.title
            ");
            $result = $query->result_array();
           return $result;
        }
        
        public function secCount($monthNow, $yearNow, $sectID){
            $query = $this->db->query("SELECT COUNT(lcID) count FROM default_learner_courses WHERE MONTH(dateStarted) = $monthNow
            AND YEAR(dateStarted) = $yearNow AND isEnrolled = 1 AND courseID IN (SELECT HeirarchyID FROM
            default_syllabus WHERE Type = 2 AND ParentID IN (SELECT ID FROM default_syllabus WHERE 
            Type = 1 AND HeirarchyID = $sectID))");
            
            $result = $query->row();
            return $result->count;
        }

        
        public function lEndorse($monthNow, $yearNow){
            $query = $this->db->query("SELECT dcc.title, dlc.learnerID, dlc.dateFinished 
            FROM default_learner_courses dlc JOIN default_course_courses dcc ON dcc.id = dlc.courseID
            WHERE MONTH(dlc.dateFinished) = $monthNow AND YEAR(dlc.dateFinished) = $yearNow AND dlc.isEnrolled = 1 AND dlc.status = 3");
            $result = $query->result_array();
            return $result;
        }
}
