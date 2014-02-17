<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Profiling_m extends MY_Model {

	public function __construct()
	{		
		parent::__construct();
		
		
	}
	
	//create a new item
	public function getAllInterest(){
            $result = $this->db->select('*')
                    ->where('testid',1)
                    ->order_by('sectionName','asc')
                    ->get('profiling_sections')
                    ->result_array();
            return $result;
        }
        
        public function getAllAbility(){
            $result = $this->db->select('*')
                    ->where('testid',2)
                    ->order_by('sectionName','asc')
                    ->get('profiling_sections')
                    ->result_array();
            return $result;
        }
        
        public function getItemCount($secid){
            $result = $this->db->select('*')
                    ->where('sectionID',$secid)
                    ->get('profiling_itembank');
                    
                    
            return $result->num_rows();
            
        }
        
         public function getItems($itemid,$limit){
            $result = $this->db->select('*')
                    ->where('sectionID',$itemid)
                    ->limit($limit)
                    ->order_by('itemID', 'RANDOM')
                    ->get('profiling_itembank')
                    ->result_array();
                    
                    return $result;
        }
        
        public function getSectionName($secid){
             $result = $this->db->select('sectionName')
                    ->where('sectionID',$secid)
                    ->get('profiling_sections')
                     ->row();
                    
                    
            return $result->sectionName;
        }
        
        public function getSecDet($secid){
             $result = $this->db->select('*')
                    ->where('sectionID',$secid)
                    ->get('profiling_sections')
                     ->row();
                    
                    
            return $result;
        }
        
        public function getAllItems($secid){
            $result = $this->db->select('*')
                    ->where('sectionID',$secid)
                    ->get('profiling_itembank')
                    ->result_array();
            
            return $result;
        }
        
        
        
        public function getChoices($itemid){
            $result = $this->db->select('*')
                    ->where('itemID',$itemid)
                    ->order_by('response','desc')
                    ->get('profiling_choices')
                    ->result_array();
            
            return $result;
        }
        
        public function trInterest($learnerID, $testID, $dateNow){
        
         $to_insert = array(
			
			'learnerID' => $learnerID,
                        'testID' => $testID,
                        'dateTaken' => $dateNow
              );
                        
            $this->db->insert('default_profiling_result', $to_insert);
            return $this->db->insert_id();
      
        }
        
        public function secInterest($resultID, $sectionID, $result){
        
         $to_insert = array(
			
			'resultID' => $resultID,
                        'sectionID' => $sectionID,
                        'result' => $result
              );
                        
            $this->db->insert('default_profiling_secresults', $to_insert);
            return $this->db->insert_id();
      
        }
        
        public function trAbility($learnerID, $testID, $dateNow){
        
         $to_insert = array(
			
			'learnerID' => $learnerID,
                        'testID' => $testID,
                        'dateTaken' => $dateNow
              );
                        
            $this->db->insert('default_profiling_result', $to_insert);
            return $this->db->insert_id();
      
        }
        
        public function secAbility($resultID, $sectionID, $result){
        
         $to_insert = array(
			
			'resultID' => $resultID,
                        'sectionID' => $sectionID,
                        'result' => $result
              );
                        
            $this->db->insert('default_profiling_secresults', $to_insert);
            return $this->db->insert_id();
      
        }
        
        public function latInterest($learnerID){
            $query = $this->db->query("SELECT MAX(pr.dateTaken) latest FROM default_profiling_result pr JOIN default_profiling_testbank pt 
            ON pt.bankID = pr.testID
            WHERE pt.type = 'Interest' AND pr.learnerID = $learnerID");
            $result = $query->row();
            return $result;
        }
        
        public function latAbility($learnerID){
            $query = $this->db->query("SELECT MAX(pr.dateTaken) latest FROM default_profiling_result pr JOIN default_profiling_testbank pt 
            ON pt.bankID = pr.testID
            WHERE pt.type = 'Ability' AND pr.learnerID = $learnerID");
            $result = $query->row();
            return $result;
        }
        
        public function intRes($learnerID, $dateTaken){
            $query = $this->db->query("SELECT ps.sectionName, psr.result
            FROM default_profiling_testbank pt JOIN default_profiling_result pr ON pt.bankID = pr.testID
            JOIN default_profiling_sections ps ON ps.testID = pt.bankID
            JOIN default_profiling_secresults psr ON psr.resultID = pr.resultID AND psr.sectionID = ps.sectionID 
            WHERE pr.dateTaken = '$dateTaken' AND pr.learnerID = $learnerID AND pt.type = 'Interest'");
            $result = $query->result_array();
            return $result;
        }
        
        public function abRes($learnerID, $dateTaken){
            $query = $this->db->query("SELECT ps.sectionName, psr.result, ps.noOfItems
            FROM default_profiling_testbank pt JOIN default_profiling_result pr ON pt.bankID = pr.testID
            JOIN default_profiling_sections ps ON ps.testID = pt.bankID
            JOIN default_profiling_secresults psr ON psr.resultID = pr.resultID AND psr.sectionID = ps.sectionID 
            WHERE pr.dateTaken = '$dateTaken' AND pr.learnerID = $learnerID AND pt.type = 'Ability'");
            $result = $query->result_array();
            return $result;
        }
        
        public function getAbilitiesCourse($sectionID){
            $result = $this->db->select('course_profiling_sections.courseID,course_courses.title,course_courses.image')
                    ->join('course_courses','course_profiling_sections.courseID = course_courses.id')
                    ->where('course_profiling_sections.sectionID',$sectionID)
                    ->where('course_profiling_sections.type',1)
                    ->get('course_profiling_sections')
                    ->result_array();
            
            return $result;
                    
                    
        }
        
         public function getInterestsCourse($sectionID){
            $result = $this->db->select('course_profiling_sections.courseID,course_courses.title,course_courses.image')
                    ->join('course_courses','course_profiling_sections.courseID = course_courses.id')
                    ->where('course_courses.status !=', 'draft')
                    ->where('course_profiling_sections.sectionID',$sectionID)
                    ->where('course_profiling_sections.type',2)
                    
                    ->get('course_profiling_sections')
                    ->result_array();
            
            return $result;
                    
                    
        }
        
        public function getSector($courseID){
            $result = $this->db->select('ParentID')
                    ->where('HeirarchyID',$courseID)
                    ->where('Type', 2)
                    ->get('syllabus')
                    ->row();
            
            $result2 = $this->db->select('syllabus.HeirarchyID,sector_sectors.title')
                    ->join('sector_sectors','sector_sectors.ID=syllabus.HeirarchyID')
                    ->where('syllabus.ID',$result->ParentID)
                    ->get('syllabus')
                    ->row();
            
            return $result2->title;
                    
        }
}
