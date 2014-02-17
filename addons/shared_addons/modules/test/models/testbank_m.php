<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a sample module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	Sample Module
 */
class Testbank_m extends MY_Model {

	public function __construct()
	{		
		parent::__construct();
		
		/**
		 * If the sample module's table was named "samples"
		 * then MY_Model would find it automatically. Since
		 * I named it "sample" then we just set the name here.
		 */
		
	}
	
	public function getTestTypes(){
            
           $query =  $this->db->select('*')
                     ->get('ref_testtype')
                    ->result_array();
            
           $form_options = array();
            foreach($query as $item){
                $form_options[$item['typeID']] = $item['testType'];
            }
            
            return $form_options;
            
            
        }
        
        public function getSyllabusID($courseid){
            $result = $this->db->select('*')
                    ->where('Type',2)
                    ->where('HeirarchyID',$courseid)
                    ->get('syllabus')
                    ->row();
            
            return $result;
        }
         public function getMSyllabusID($moduleid){
             //echo $moduleid;
            $result = $this->db->select('*')
                    ->where('Type',3)
                    ->where('HeirarchyID',$moduleid)
                    ->get('syllabus')
                    ->row();
            
            return $result;
        }
        
        public function getHid($syllaid){
            $courseID = $this->db->select('HeirarchyID')
                    ->where('ID',$syllaid)
                    ->get('syllabus')
                    ->row();
            return $courseID->HeirarchyID;
            
        }
        
         public function getCourseTitle($heiraid){
             
            
             $this->load->driver('Streams');
            
           // $entries = $this->streams->entries->get_entr($params);
            $entries = $this->streams->entries->get_entry($heiraid,'courses','course', true);
           // print_r($entries);
            return $entries->title;
        }
        
        public function getModule($syllaid){
            $coruseid = $this->db->select('HeirarchyID')
                    ->where('ID',$syllaid)
                    ->get('syllabus')
                    ->row();
            
            return $coruseid->HeirarchyID;
            
        }
        
         public function getModuleTitle($heiraid){
             
            
             $this->load->driver('Streams');
            
           // $entries = $this->streams->entries->get_entr($params);
            $entries = $this->streams->entries->get_entry($heiraid,'modules','module', true);
           // print_r($entries);
            return $entries->title;
        }
        
        
        public function getModules($course){
            $modulessylla = $this->db->select('module_modules.*')
                            ->select('syllabus.*')
                            ->where('syllabus.ParentID',$course)
                            ->where('module_modules.status', 'live')
                            ->join('module_modules','module_modules.id = syllabus.HeirarchyID')
                            ->get('syllabus')
                            ->result_array();
            
            $form_options = array();
            foreach ($modulessylla as $row)
		{
                       
                        
                        $form_options[$row['id']] = $row['title'];
			
		}
             //echo print_r($modulessylla);
                return $form_options;
        }
        
        public function addOATest($courseid,$noItems){
           
            $to_insert=array(
                
                'type' => 'Online Assessment',
                'courseID' => $courseid,
                'noOfItems' => $noItems,
                'createdBy' => $this->current_user->id,
                'dateCreated' => now(),
                'dateModified'=> now()
                
                
            );
            
            $this->db->insert('testbank',$to_insert);
            return $this->db->insert_id();
        }
        
        public function addOASection($testbankid,$moduleid,$noOfItems,$type){
            $to_insert=array(
                
                'testbankID' => $testbankid,
                'moduleID' => $moduleid,
                'noOfItems' => $noOfItems,
                'testType' => $type

            );
            
            $this->db->insert('test_sections',$to_insert);
        }
        
        public function saveSCTest($courseid,$noItems){
           

            $to_insert=array(
                
                'type' => 'Self Check',
                'courseID' => $courseid,
                'noOfItems' => $noItems,
                'createdBy' => $this->current_user->id,
                'dateCreated' => now(),
                'dateModified' => now() 

            );
            
            $this->db->insert('testbank',$to_insert);
            
            return $this->db->insert_id();
        }
        
        public function getParent($id){
            $result = $this->db->select('ParentID')
                    ->where('ID',$id)
                    ->get('syllabus')
                    ->result_array();
            return $result[0]['ParentID'];
        }
        
        public function getAllOA(){
            $result = $this->db->select('profiles.display_name')
                    ->select('testbank.*')
                    ->select('course_courses.title')
                    ->join('testbank', 'testbank.courseID = course_courses.id')
                    ->join('profiles', 'profiles.user_id = testbank.createdBy', 'left')
                    
                    ->join('course_courses', 'course_courses.id = testbank.courseID')
                    ->order_by('course_courses.title','asc')
                    ->where('type', 'Online Assessment')
                    //->get('testbank')
                    ->get('course_courses')
                    ->result_array();
            
            return $result;
            
        }
        
        public function getCourseOA(){
           $result= $this->db->select('id,title')
                   ->order_by('title','asc')
                   ->get('course_courses')
                   ->result_array();
           
           return $result;
        }
        
         public function getModulesSC(){
           $result= $this->db->select('id,title')
                   ->order_by('title','asc')
                   ->get('module_modules')
                   ->result_array();
           
           return $result;
        }
        
        public function getCModulesSC($courseid){
            
            $result = $this->db->select('syllabus.*')
                    ->select('module_modules.title')
                    ->join('module_modules','module_modules.id = syllabus.HeirarchyID')
                    ->where('syllabus.ParentID',$courseid)
                    ->get('syllabus')
                    ->result_array();
            
            return $result;
            
        }
        
        
        
        public function getSC($moduleID){
             $result = $this->db->select('testbank.*')
                     ->select('profiles.display_name')
                    ->join('profiles', 'profiles.user_id = testbank.createdBy', 'left')
                    ->join('test_sections','test_sections.testbankID = testbank.testID')
                    ->where('test_sections.moduleID',$moduleID)
                    ->where('testbank.type','Self Check')
                    ->get('testbank')
                    ->row();
                    
                    
            return $result;
        }
        
        public function getSCType($testbankID){
            $result = $this->db->select('ref_testtype.testType')
                    ->where('testbankID',$testbankID)
                    ->join('ref_testtype','ref_testtype.typeID = test_sections.testType')
                    ->get('test_sections')
                    ->row();
            
            return $result;
        }
        
        public function getOA($courseID){
             $result = $this->db->select('testbank.*')
                     ->select('profiles.display_name')
                      ->join('profiles', 'profiles.user_id = testbank.createdBy', 'left')
                    ->where('courseID',$courseID)
                    ->where('type','Online Assessment')
                    ->get('testbank')
                    ->row();
                    
                    
            return $result;
        }
        
        public function getSections($testID){
            $result = $this->db->select('test_sections.*')
                    ->select('module_modules.title')
                    ->select('ref_testtype.testType')
                    ->join('module_modules','module_modules.id = test_sections.moduleID')
                    ->join('ref_testtype','ref_testtype.typeID = test_sections.testType')
                     ->where('test_sections.testbankID',$testID)
                    ->order_by('test_sections.moduleID', 'asc')
                    ->get('test_sections')
                    ->result_array();
            
          return $result;
        }
        
        public function removeSection($sectionid){
            $this->db->delete('test_sections')
                    ->where('sectionID',$sectionid);
        }
        
        public function getSectionDetails($sectionid){
            $result = $this->db->select('*')
                    ->where('sectionID',$sectionid)
                    ->get('test_sections')
                    ->row();
            
            return $result;
        }
        
        public function updateSection($sectionid,$noItems,$type){
            $data = array(
               'testType' => $type,
               'noOfItems' => $noItems
            );

            $this->db->where('sectionID', $sectionid);
            $this->db->update('test_sections', $data); 
            $this->updateItemCount($sectionid);
        }
        
        public function updateItemCount($sectionid){
              $result = $this->db->select('testbankID')
                    ->where('sectionID',$sectionid)
                    ->get('test_sections')
                    ->row();
              
              $oa = $this->db->select('noOfItems')
                    ->where('testbankID',$result->testbankID)
                    ->get('test_sections')
                    ->result_array();
              
              $noOfItems = 0;
              foreach($oa as $a){
                  $noOfItems += $a['noOfItems'];
              }
              
              $data = array (
                  
                'noOfItems' => $noOfItems,  
                'dateModified' => now()
              );
              
              $this->db->where('testID',$result->testbankID)
                      ->update('testbank',$data);
                      
              
              
              
        }
        
        public function getAllCourses(){
              $this->load->driver('Streams');
            $params = array(
        'stream'        => 'courses',
        'namespace'     => 'course',
        'oder_by'       => 'title'
            );
           // $entries = $this->streams->entries->get_entr($params);
            $entries = $this->streams->entries->get_entries($params);
           // print_r($entries);
            return $entries;
        }
        
        public function getSelfCheck($moduleid){
            $result= $this->db->select('testbank.*')
                    ->select('test_sections.*')
                    ->select('ref_testtype.testType AS typename')
                    ->join('testbank','testbank.testID = test_sections.testbankID')
                    ->join('ref_testtype','ref_testtype.typeID = test_sections.testType')
                    ->where('test_sections.moduleID',$moduleid)
                    ->where('testbank.type', 'Self Check')
                    ->get('test_sections')
                    ->row();
            
            return $result;
        }
        
         public function getItemCount($moduleID){
            $result = $this->db->select('*')
                    ->where('moduleID',$moduleID)
                    ->get('test_itembank');
                    
                    
            return $result->num_rows();
            
        }
        
           public function getItemCountCat($moduleID,$testType,$category){
               
               if($category == 0){
                $notEq = 1;
            }else{
                $notEq = 0;
            }
               
            $result = $this->db->select('*')
                    ->where('testType',$testType)
                    ->where('category !=',$notEq)
                    ->where('moduleID',$moduleID)
                    ->where('status',1)
                    ->get('test_itembank');
                    
                    
            return $result->num_rows();
            
        }
        
}
