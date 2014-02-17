<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a sample module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	Sample Module
 */
class Badge_m extends MY_Model {

	public function __construct()
	{		
		parent::__construct();
		
		
		
	}
        
        public function getName($heirarchyID, $typeID)
        {
          
            if ($typeID == 1 ){
                $query = $this->db
                        ->select('title')
                        ->where('id', $heirarchyID)
			//->order_by('`order`')
			->get('default_sector_sectors')
			->result_array();
                
                foreach($query as $row)
                {
                    $result[] = $row;
                }
                //print_r($result[0]['title']);
                    return $result[0]['title'];
            }
            elseif ($typeID==2) {
             $query = $this->db
                        ->select('title')
                        ->where('id', $heirarchyID)
			//->order_by('`order`')
			->get('default_course_courses')
			->result_array();
                
                foreach($query as $row)
                {
                    $result[] = $row;
                }
                //print_r($result[0]['title']);
                    return $result[0]['title'];
            }
            elseif ($typeID==3){
                 $query = $this->db
                        ->select('title')
                        ->where('id', $heirarchyID)
			//->order_by('`order`')
			->get('default_module_modules')
			->result_array();
                
                foreach($query as $row)
                {
                    $result[] = $row;
                }
               // print_r($result[0]['title']);
                    return $result[0]['title'];
            }
            elseif ($typeID==4){
                 $query = $this->db
                        ->select('title')
                        ->where('id', $heirarchyID)
			//->order_by('`order`')
			->get('default_lesson_lessons')
			->result_array();
                
                foreach($query as $row)
                {
                    $result[] = $row;
                }
               // print_r($result[0]['title']);
                    return $result[0]['title'];
            }elseif ($typeID==5){
                 $query = $this->db
                        ->select('title')
                        ->where('id', $heirarchyID)
			//->order_by('`order`')
			->get('default_topics')
			->result_array();
                
                foreach($query as $row)
                {
                    $result[] = $row;
                }
               // print_r($result[0]['title']);
                    return $result[0]['title'];
            }
            
          
          
            
        }
        
       public function getCoursesDropdown(){
            
            $result = $this->db->select('ID, ParentID, HeirarchyID, Type')
                    ->where('Type',2)
                    ->get('syllabus')
                    ->result_array();
            $form_options = array();
            foreach ($result as $row)
		{
                       
                        $row['ID'] = $this->getName($row['HeirarchyID'],$row['Type']);
                        $form_options[$row['HeirarchyID']] = $row['ID'];
			$items[$row['ID']] = $row;
		}
             //sort($form_options, SORT_NATURAL | SORT_FLAG_CASE);
                return $form_options;
         
                
            
        }
        public function getModulesDropdown(){
            $result = $this->db->select('ID, ParentID, HeirarchyID, Type')
                    ->where('Type',3)
                    ->get('syllabus')
                    ->result_array();
            $form_options = array();
            foreach ($result as $row)
		{
                       
                       
                        $row['ID'] = $this->getName($row['HeirarchyID'],$row['Type']);
                        $form_options[$row['HeirarchyID']] = $row['ID'];
			$items[$row['ID']] = $row;
		}
             //sort($form_options, SORT_NATURAL);
                return $form_options;
        }
        
        public function getAllBadges(){
           $result = $this->db->select('*')//,course_courses.title,module_modules.title')
                   //->join('course_courses','badge_badges.course = course_courses.id')
//                   ->join('module_modules','module_modules.id = badge_badges.module')
                   ->get('badge_badges')
                   ->result_array();
           
           return $result;
        }
        
        public function getBadgeDetails($id){
             
            $this->load->driver('Streams');
            
           // $entries = $this->streams->entries->get_entr($params);
            $entries = $this->streams->entries->get_entry($id,'badges','badge', true);
            return $entries;
        
        }
        
        public function getCourseDetails($id){
            
             $this->load->driver('Streams');
            
           // $entries = $this->streams->entries->get_entr($params);
            $entries = $this->streams->entries->get_entry($id,'courses','course', true);
           // print_r($entries);
            return $entries;
            
        }
        
         public function getSyllabusDetails($id){
            $result = $this->db->select('ID, ParentID, HeirarchyID, Type')
                    ->where('HeirarchyID',$id)
                    ->where('Type',2)
                    ->get('syllabus')
                    ->result_array();
            
           // print_r($result);
            return $result[0];
        }
        
        public function courseModules($courseSyllaID){
            
            $result = $this->db->select('syllabus.HeirarchyID,module_modules.title')
                    ->join('module_modules','module_modules.id = syllabus.HeirarchyID')
                    ->where('ParentID',$courseSyllaID)
                    ->where('Type', 3)
                    ->get('syllabus')
                    ->result_array();
            
            //print_r($result);
            return $result;
        }
        
        public function getModules($courseid){
            
            $courseSylla = $this->getSyllabusDetails($courseid);
            
            //print_r($courseSylla['ID']);
            
            $modules = $this->courseModules($courseSylla['ID']);
            
            print_r($modules['HeirarchyID']);
            return $modules;
            
        }
}
