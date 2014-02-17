<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a sample module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	Sample Module
 */
class Test_itembank_m extends MY_Model {

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
        public function getHid($syllaid){
            $coruseid = $this->db->select('HeirarchyID')
                    ->where('ID',$syllaid)
                    ->get('syllabus')
                    ->row();
            
            return $coruseid->HeirarchyID;
            
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
        
         public function getModuleDetails($heiraid){
             
            
             $this->load->driver('Streams');
            
           // $entries = $this->streams->entries->get_entr($params);
            $entries = $this->streams->entries->get_entry($heiraid,'modules','module', true);
           // print_r($entries);
            return $entries;
        }
        
        public function getSyllabusID($heirarchyid){
              $coruseid = $this->db->select('ID')
                    ->where('HeirarchyID',$heirarchyid)
                    ->where('Type',2)
                    ->get('syllabus')
                    ->row();
            
            return $coruseid->ID;
        }
        
        
        public function getModules($syllaid){
            $modulessylla = $this->db->select('module_modules.*')
                            ->where('syllabus.ParentID',$syllaid)
                            ->join('module_modules','module_modules.id = syllabus.HeirarchyID')
                            ->get('syllabus')
                            ->result_array();
            
            $form_options = array();
           
          
            // echo print_r($modulessylla);
                return $modulessylla;
        }
        
       
        
        
        
        public function getParent($id){
            $result = $this->db->select('ParentID')
                    ->where('ID',$id)
                    ->get('syllabus')
                    ->result_array();
            return $result[0]['ParentID'];
        }
        
         public function getModuleParent($id){
            $result = $this->db->select('ParentID')
                    ->where('HeirarchyID',$id)
                    ->where('Type', 3)
                    ->get('syllabus')
                    ->result_array();
            return $result[0]['ParentID'];
        }
        
        public function saveToItemBank($courseid,$moduleid,$prompt,$response,$testtype,$difficulty){
            $to_insert= array(
                    
                    'courseID' => $courseid,
                    'moduleID' => $moduleid,
                    'prompt' => $prompt,
                    'response' => $response,
                    'testType' => $testtype,
                    'difficulty' => $difficulty,
                    'dateCreated' => now(),
                    'status' => 1

                    
                    );
            
            $this->db->insert('test_itembank', $to_insert);
            
            return $this->db->insert_id();
        }
        
        public function saveChoicesMC($itemid, $choice, $response, $weight){
            $to_insert= array(
                    
                    'itemID' => $itemid,
                    'choice' => $choice,
                    'response' => $response,
                    'weight' => $weight,

                  

                    
                    );
            
            $this->db->insert('testmc_choices', $to_insert);
            
        }
        
        public function getAllModules(){
            $this->load->driver('Streams');
            $params = array(
        'stream'        => 'modules',
        'namespace'     => 'module'
            );
           // $entries = $this->streams->entries->get_entr($params);
            $entries = $this->streams->entries->get_entries($params);
           // print_r($entries);
            return $entries;
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
        
        public function getItemCount($moduleID){
            $result = $this->db->select('*')
                    ->where('moduleID',$moduleID)
                    ->get('test_itembank');
                    
                    
            return $result->num_rows();
            
        }
        
        public function getAllItems($moduleID){
         $result = $this->db->select('test_itembank.*,ref_testtype.*')
                    ->where('moduleID',$moduleID)
                    ->join('ref_testtype','ref_testtype.typeID = test_itembank.testType')
                  ->order_by("dateCreated","desc")   
                 ->get('test_itembank')
                   
                    
                    ->result_array();
         
         return $result;
        }
        
        public function getItem($itemid){
            $result = $this->db->select('*')
                    ->where('itemID',$itemid)
                    ->get('test_itembank')
                    ->row();
                    
                    return $result;
        }
        
        public function getChoices($itemid){
            $result = $this->db->select('*')
                    ->where('itemID',$itemid)
                    ->order_by('response','desc')
                    ->get('testmc_choices')
                    ->result_array();
            
            return $result;
        }
        
        public function flag_item($itemid){
            $data = array(
              'status' => 0  
            );
            
            $this->db->where('itemID',$itemid)
                    ->update('test_itembank',$data);
        }
        
        public function unflag_item($itemid){
            $data = array(
              'status' => 1  
            );
            
            $this->db->where('itemID',$itemid)
                    ->update('test_itembank',$data);
        }
        

        
        
        
        
}
