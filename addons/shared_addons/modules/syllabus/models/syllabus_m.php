<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Create A Syllabus
 *
 * @author 		Fantastic 4
 * @website		
 * @package 	
 * @subpackage 	
 * @copyright 	MIT
 */
class syllabus_m extends MY_Model {

	private $folder;

	public function __construct()
	{
		parent::__construct();
		$this->_table = 'syllabus';
                $this->load->driver('Streams');
	}
        
        public function _set_children($page)
	{
		if (isset($page['children']))
		{
			foreach ($page['children'] as $i => $child)
			{
				$child_id = (int) str_replace('page_', '', $child['id']);
				$page_id = (int) str_replace('page_', '', $page['id']);

				$this->update($child_id, array('ParentID' => $page_id, 'order' => $i), true);

				//repeat as long as there are children
				if (isset($child['children']))
				{
					$this->_set_children($child);
				}
			}
		}
	}
        
        public function update_lookup($root_pages)
	{
		
		

		foreach ($root_pages as $page)
		{
			$this->reindex_descendants($page);
		}
	}
        
        public function reindex_descendants($id)
	{
		$descendants = $this->get_descendant_ids($id);
		foreach ($descendants as $descendant)
		{
			$this->build_lookup($descendant);
		}
	}
        
        
        
        public function get_descendant_ids($id, $id_array = array())
	{
		$id_array[] = $id;

		$children = $this->db->select('ID')
			->where('ParentID', $id)
			->get('syllabus')
			->result();

		if ($children)
		{
			// Loop through all of the children and run this function again
			foreach ($children as $child)
			{
				$id_array = $this->get_descendant_ids($child->ID, $id_array);
			}
		}

		return $id_array;
	}
        public function build_lookup($id)
	{
		$current_id = $id;

		
		do
		{
			$page = $this->db
				->select('ParentID')
				->where('ID', $current_id)
				->get('syllabus')
				->row();

			$current_id = $page->ParentID;
			//array_unshift($segments, $page->slug);
		}
		while ($page->ParentID > 0);

		
	}
        
        
        

        public function get_tree($id)
	{
            $all_pages = array();
            
            $course = $this->db->select('syllabus.ID,syllabus.HeirarchyID,syllabus.Type,course_courses.status,course_courses.updated')//$this->db->select('ID,HeirarchyID,Type')
                    ->where('syllabus.ParentID',$id)
                    ->where('syllabus.type',2)
                    ->join('course_courses','course_courses.id = syllabus.HeirarchyID')
                    ->order_by('`order`')
                    ->get('syllabus')
                    ->result_array();
            
            
            array_push($all_pages, $course);
            
            foreach($course as $a){
                 $course['ParentID'] = 0;
                $module = $this->db->select('syllabus.ID,syllabus.HeirarchyID,syllabus.ParentID,syllabus.Type,module_modules.status')//$this->db->select('syllabus.ID,syllabus.ParentID,syllabus.HeirarchyID,syllabus.Type,course_courses.*')
                    ->where('ParentID',$a['ID'])
                        ->join('module_modules','module_modules.id = syllabus.HeirarchyID')
                    //->join('course_courses','course_courses.id = syllabus.heirarchyID')
                    ->order_by('`order`')
                    ->get('syllabus')
                    ->result_array();
                //$module['ParentID'] =& $a['ID'];
                array_push($all_pages, $module);
                
                    foreach($module as $b ){
                        $lessons = $this->db->select('ID,ParentID,HeirarchyID,Type')
                    ->where('ParentID',$b['ID'])
                                ->order_by('`order`')
                    ->get('syllabus')
                    ->result_array();
                   // $lessons['ParentID'] =& $b['ID'];
                    array_push($all_pages, $lessons);
                    
                        foreach($lessons as $c){
                           // echo $c['ID'];
                            $topics = $this->db->select('ID,ParentID,HeirarchyID,Type')
                             ->where('ParentID',$c['ID'])
                             //->order_by('`order`')
                             ->get('syllabus')
                             ->result_array();
                            // $lessons['ParentID'] =& $b['ID'];
                             array_push($all_pages, $topics);
                        }
                    }
            }
                  //echo print_r($all_pages);
		$all_pages1 = $this->db
			->select('ID, ParentID, HeirarchyID, Type')
			//->order_by('`order`')
			->get('syllabus')
			->result_array();
                 //echo print_r($all_pages);
		// First, re-index the array.
		foreach ($all_pages as $row1)
		{
                    foreach($row1 as $row){
                        $row['HeirarchyID'] = $this->getName($row['HeirarchyID'],$row['Type']);
                        if($row['Type']==2)
                            {
                        $row['updated'] = 'Last update: '.format_date($row['updated']);
                        }
			$pages[$row['ID']] = $row;
                    }
		}
                
                

		unset($all_pages);

		// Build a multidimensional array of parent > children.
		foreach ($pages as $row)
		{
			if (array_key_exists($row['ParentID'], $pages))
			{
				// Add this page to the children array of the parent page.
				$pages[$row['ParentID']]['children'][] =& $pages[$row['ID']];
			}

			// This is a root page.
			if ($row['ParentID'] == 0)
			{
				$page_array[] =& $pages[$row['ID']];
			}
		}
                
               
                
		return $page_array;
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
        
        public function addSectorSyllabus($sectorid){
            
          $to_insert = array(
			
			'HeirarchyID' => $sectorid,
                        'Type' => 1,
                        'ParentID' => 0,
                        'order' => now()
              );
                        
            return $this->db->insert('syllabus', $to_insert);
        }
        
        public function getSectorsDropdown(){
            
            $result = $this->db->select('ID, ParentID, HeirarchyID, Type')
                    ->where('Type',1)
                    ->get('syllabus')
                    ->result_array();
            $form_options = array();
            foreach ($result as $row)
		{
                       
                        $row['HeirarchyID'] = $this->getName($row['HeirarchyID'],$row['Type']);
                        $form_options[$row['ID']] = $row['HeirarchyID'];
			$items[$row['ID']] = $row;
		}
             
                return $form_options;
            
            
        }
        
        public function addCourseSyllabus($courseid,$parentid){
             $to_insert = array(
			
			'HeirarchyID' => $courseid,
                        'Type' => 2,
                        'ParentID' => $parentid,
                        'order' => now()
                        
              );
                        
            $this->db->insert('syllabus', $to_insert);
             return $this->db->insert_id();
        }
        
        public function addModuleSyllabus($moduleid,$parentid){
             $to_insert = array(
			
			'HeirarchyID' => $moduleid,
                        'Type' => 3,
                        'ParentID' => $parentid,
                  'order' => now()
              );
                        
            $this->db->insert('syllabus', $to_insert);
            return $this->db->insert_id();
        }
        
        public function addLessonSyllabus($lessonid,$parentid){
            $to_insert = array(
			
			'HeirarchyID' => $lessonid,
                        'Type' => 4,
                        'ParentID' => $parentid,
                 'order' => now()
              );
                        
            $this->db->insert('syllabus', $to_insert);
            
            return $this->db->insert_id();
        }
        
        public function addTopicSyllabus($topicid,$parentid){
            $to_insert = array(
			
			'HeirarchyID' => $topicid,
                        'Type' => 5,
                        'ParentID' => $parentid,
                        'order' => now()
              );
                        
            return $this->db->insert('syllabus', $to_insert);
        }
        public function getCoursesDropdown(){
            
            $result = $this->db->select('ID, ParentID, HeirarchyID, Type')
                    ->where('Type',2)
                    ->get('syllabus')
                    ->result_array();
            $form_options = array();
            foreach ($result as $row)
		{
                       
                        $row['HeirarchyID'] = $this->getName($row['HeirarchyID'],$row['Type']);
                        $form_options[$row['ID']] = $row['HeirarchyID'];
			$items[$row['ID']] = $row;
		}
             
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
                       
                        $row['HeirarchyID'] = $this->getName($row['HeirarchyID'],$row['Type']);
                        $form_options[$row['ID']] = $row['HeirarchyID'];
			$items[$row['ID']] = $row;
		}
             
                return $form_options;
        }
        
        public function getLessonsDropdown(){
             $result = $this->db->select('ID, ParentID, HeirarchyID, Type')
                    ->where('Type',4)
                    ->get('syllabus')
                    ->result_array();
            $form_options = array();
            foreach ($result as $row)
		{
                       
                        $row['HeirarchyID'] = $this->getName($row['HeirarchyID'],$row['Type']);
                        $form_options[$row['ID']] = $row['HeirarchyID'];
			$items[$row['ID']] = $row;
		}
             
                return $form_options;
        }
        
        public function getSyllabusDetails($id){
            $result = $this->db->select('ID, ParentID, HeirarchyID, Type')
                    ->where('ID',$id)
                    ->get('syllabus')
                    ->result_array();
            
            //print_r($result[0]);
            return $result[0];
        }
        
        public function getSectorDetails($id){
            
             $this->load->driver('Streams');
            
            $params = array(
        'stream'        => 'sectors',
        'namespace'     => 'sector',
        'id'            => $id
        );
            
           // $entries = $this->streams->entries->get_entr($params);
            $entries = $this->streams->entries->get_entry($id,'sectors','sector', true);
            //print_r($entries);
            return $entries;
            
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
            //print_r($entries);
            return $entries;
            
        }
        public function getLessonDetails($id){
            $this->load->driver('Streams');
            
           // $entries = $this->streams->entries->get_entr($params);
            $entries = $this->streams->entries->get_entry($id,'lessons','lesson', true);
            return $entries;
        }
        public function getTopicDetails($id){
            
            
           // $entries = $this->streams->entries->get_entr($params);
            $entries = $this->db->select('*')
                    ->where('id',$id)
                    ->get('topics')
                    ->row();
            return $entries;
        }
        
        public function getParent($id){
            $result = $this->db->select('ParentID')
                    ->where('ID',$id)
                    ->get('syllabus')
                    ->result_array();
            return $result[0]['ParentID'];
        }
        
        public function updateParent($pid,$syllaid){
           $data = array(
               'ParentID' => $pid
           );

            $this->db->where('ID',$syllaid)
                   ->update('syllabus',$data);
        }
        
        public function getHeirarchyId($id){
            $result = $this->db->select('HeirarchyID')
                    ->where('ID',$id)
                    ->get('syllabus')
                    ->result_array();
              return $result[0]['HeirarchyID'];
        }
        
        public function getSkillsDropdown(){
            $result = $this->db->select('skillID, skill')
                
                    ->get('ref_skills')
                    ->result_array();
            $form_options = array();
            foreach ($result as $row)
		{
                        $form_options[$row['skillID']] = $row['skill'];	
		}
             
                return $form_options;
        }
        
        public function getAbilitiesDropdown(){
            $result = $this->db->select('*')
                    ->where('testid',2)
                    ->order_by('sectionName','asc')
                    ->get('profiling_sections')
                    ->result_array();
            $form_options = array();
            foreach ($result as $row)
		{
                        $form_options[$row['sectionID']] = $row['sectionName'];	
		}
             
                return $form_options;
        }
        
        public function getInterestsDropdown(){
           $result = $this->db->select('*')
                    ->where('testid',1)
                    ->order_by('sectionName','asc')
                    ->get('profiling_sections')
                    ->result_array();
            $form_options = array();
            foreach ($result as $row)
		{
                        $form_options[$row['sectionID']] = $row['sectionName'];	
		}
             
                return $form_options;
        }
        
        public function addModuleSkills($moduleid,$skillid){
             $to_insert = array(
			
			'moduleID' => $moduleid,
                        'skillID' => $skillid,
                       
              );
                        
            return $this->db->insert('module_skills', $to_insert);
        }
        
        public function getModuleSkills($id){
            $result = $this->db->select('ref_skills.skill,ref_skills.skillID')
                    ->join('ref_skills', 'ref_skills.skillID = module_skills.skillID')
                   ->where('moduleID',$id)
                   ->get('module_skills')
                  ->result_array();
            //echo print_r($id);
            return $result;
        }
        
        public function getEditSkillsDropdown($id){
            $result = $this->db->select('skillID')
                   ->where('moduleID',$id)
                   ->get('module_skills')
                  ->result_array();
            //echo print_r($result);
            $form_options = array();
             foreach ($result as $row)
		{
                        $form_options[] = $row['skillID'];	
		}
             
                
            return $form_options;//$result[0]['skillID'];
        }
        public function getSkills($id){
            $result = $this->db->select('ID')
                   ->where('moduleID',$id)
                   ->get('module_skills')
                  ->result_array();
            
            return $result;
        }
        
        public function updateSkill($msid,$skillid){
            $to_insert = array(
			
			
                        'skillID' => $skillid,
                       
              );
                        
         // echo print_r($msid);
          //echo print_r($skillid);
             $this->db->where('ID',$msid)
                   ->update('module_skills', $to_insert);
           
        }
        
        public function addCourseObjectives($id,$objective){
            $to_insert = array(
			
			'CourseID' => $id,
                        'Objective' => $objective
              );
                        
            return $this->db->insert('course_objectives', $to_insert);
        }
        
        public function addCourseOpp($id,$salary,$opp){
            $to_insert = array(
			
			'courseID' => $id,
                        'salary' => $salary,
                        'opportunity' => $opp
              );
                        
            return $this->db->insert('course_opps', $to_insert);
        }
        
        public function add_overview_video($hid,$type,$link){
           $to_insert = array(
			
			'heirarchyID' => $hid,
                        'typeID' => $type,
                        'mediaUse' => 1, //1 = overview, 2 = topic content
                        'link' => $link,
                        'mediaType' => 2, // 2 = vid 1 = pic
              );
                        
            return $this->db->insert('media', $to_insert); 
        }
        
        
        public function getSectorList(){
            $result = $this->db->select('*')
                    ->join('sector_sectors','sector_sectors.id = syllabus.HeirarchyID')
                    ->where('Type',1)
                    ->order_by('title','asc')
                    ->get('syllabus')
                    ->result_array();
           //echo print_r($result);
            return $result;
        }
        
        public function getID($id){
            $result = $this->db->select('HeirarchyID')
                    ->where('ID',$id)
                    ->get('syllabus')
                    ->row();
            
            return $result;
        }
        
        public function validate_link(){
             
        $this->db->where('link',$this->input->post('c_upload'));
       
        
        $query = $this->db->get('media');
        
        if($query->num_rows() == 1){
            
            return false;
        }else{
            return true;
        }
        }
        
        public function add_topics($title,$text)
	{
		
		// validate the data and insert it if it passes
		$to_insert = array(
			'slug'				=>$title,
			'title'				=> $title,
			'uri'				=> null,
			
			'status'			=> 'draft',
			'created_on'                    => now(),
			'order'				=> now(),
                        'author_id'        => $this->current_user->id,
                        'textCont'          => $text
		);
 

		 $this->db->insert('topics',$to_insert);
                 return $this->db->insert_id();
	}
        
        public function add_topic_video($hid,$link){
           $to_insert = array(
			
			'heirarchyID' => $hid,
                        'typeID' => 5,
                        'mediaUse' => 2, //1 = overview, 2 = topic content
                        'link' => $link,
                        'mediaType' => 2, // 2 = vid 1 = pic
              );
                        
            return $this->db->insert('media', $to_insert); 
        }
        
        public function add_topic_picture($hid,$type,$link){
           $to_insert = array(
			
			'heirarchyID' => $hid,
                        'typeID' => $type,
                        'mediaUse' => 2, //1 = overview, 2 = topic content
                        'link' => $link,
                        'mediaType' => 2, // 2 = vid 1 = pic
              );
                        
            return $this->db->insert('media', $to_insert); 
        }
        
        public function update_topics($id,$arrayy){
            
             $this->db->where('id',$id)
                   ->update('topics', $arrayy);
             
             return $this->db->insert_id();
        }
        
        public function getContent($id){
            
            $result = $this->db->select('*')
                    ->where('heirarchyID',$id)
                    ->where('typeID', 5)
                    ->get('media')
                    ->result_array();
            return $result;
        }
        
        public function updateMedia($id,$link){
            $toinsert = array(
                'link' => $link
            );
            
            $this->db->where('id',$id)
                   ->update('media', $toinsert);
        }
        
        public function getModuleCParent($moduleid){
            $result = $this->db->select('ParentID')
                    ->where('HeirarchyID',$moduleid)
                    ->where('Type',3)
                    ->get('syllabus')
                    ->row();
            return $result;
        }
        
        public function getLessonCParent($lessonid){
            $module =  $this->db->select('ParentID')
                    ->where('HeirarchyID',$lessonid)
                    ->where('Type',4)
                    ->get('syllabus')
                    ->row();
            
            $result = $this->getParent($module->ParentID);
            return $result;
           
        }
        
        public function getTopicCParent($topicid){
            $lesson =  $this->db->select('ParentID')
                    ->where('HeirarchyID',$topicid)
                    ->where('Type',5)
                    ->get('syllabus')
                    ->row();
             $module = $this->getParent($lesson->ParentID);
             $course = $this->getParent($module);
             
             return $course;
        }
        
        public function updateCourse($courseid){
            
            $data = array('updated' => date('Y-m-d H:i:s'));
            
            $this->db->where('id',$courseid)
                    ->update('course_courses',$data);
        }
        
        public function getLessonSyllabus($lessonid){
            $result = $this->db->select('*')
                    ->where('HeirarchyID',$lessonid)
                    ->where('Type',4)
                    ->get('syllabus')
                    ->row();
            
            return $result;
        }
        
        public function deleteSection($HeirarchyID){
            $this->db->where('HeirarchyID',$HeirarchyID)
                    ->where('Type',1)
                    ->delete('syllabus');
            
            $this->streams->entries->delete_entry($HeirarchyID,'sectors','sector');
            
        }
        public function deleteCourse($HeirarchyID){
            $this->db->where('HeirarchyID',$HeirarchyID)
                    ->where('Type',2)
                    ->delete('syllabus');
            
            $this->streams->entries->delete_entry($HeirarchyID,'courses','course');
            
        }
        public function deleteModule($HeirarchyID){
            $this->db->where('HeirarchyID',$HeirarchyID)
                    ->where('Type',3)
                    ->delete('syllabus');
            
            $this->streams->entries->delete_entry($HeirarchyID,'modules','module');
            
        }
        
        public function deleteLesson($HeirarchyID){
            $this->db->where('HeirarchyID',$HeirarchyID)
                    ->where('Type',4)
                    ->delete('syllabus');
            
            $this->streams->entries->delete_entry($HeirarchyID,'lessons','lesson');
            
        }
        public function deleteTopic($HeirarchyID){
            $this->db->where('HeirarchyID',$HeirarchyID)
                    ->where('Type',5)
                    ->delete('syllabus');
            
            $this->db->where('id',$HeirarchyID)
                    ->delete('topics');
            
            //$this->streams->entries->delete_entry($HeirarchyID,'course','courses');
            
        }
        
        public function addInterests($courseid,$sectionid){
             $to_insert = array(
			
			'courseID' => $courseid,
                        'sectionID' => $sectionid,
                        'type' => 2
              );
                        
            return $this->db->insert('course_profiling_sections', $to_insert); 
        }
        public function addAbility($courseid,$sectionid){
             $to_insert = array(
			
			'courseID' => $courseid,
                        'sectionID' => $sectionid,
                        'type' => 1
              );
            return $this->db->insert('course_profiling_sections', $to_insert); 
        }
        
        public function getTags(){
            $result = $this->db->select('*')
                    
                    ->get('ref_tags')
                    ->result_array();
            return $result;
        }
        
        public function tagExist($tag){
            $result = $this->db->select('*')
                    ->where('tag',$tag)
                    ->get('ref_tags')
                    ->row();
            
            if(empty($result)){
                return $this->addTag($tag);
            }else{
                return $result->id;
            }
            
        }
        
        public function addTag($tag){
             $to_insert = array(
			
			'tag' => $tag
                        
              );
             $this->db->insert('ref_tags', $to_insert);
            return $this->db->insert_id();
        }
        
        public function addLessonTag($lessonid,$tagid){
            $to_insert = array(
			'lessonID' =>$lessonid,
			'tagID' => $tagid
                        
              );
             
            return $this->db->insert('lesson_tag', $to_insert);
        }
        
        public function getCourseAbilities($courseid){
            $result = $this->db->select('profiling_sections.sectionName,profiling_sections.sectionID')
                    
                    
                    ->where('type',1)
                    ->where('courseID',$courseid)
                    ->join('profiling_sections','course_profiling_sections.sectionID = profiling_sections.sectionID')
                    ->get('course_profiling_sections`')
                    ->result_array();
            
            return $result;
            
        }
        
        public function getCourseInterests($courseid){
            $result = $this->db->select('profiling_sections.sectionName,profiling_sections.sectionID')
                    
                    
                    ->where('type',2)
                    ->where('courseID',$courseid)
                    ->join('profiling_sections','course_profiling_sections.sectionID = profiling_sections.sectionID')
                    ->get('course_profiling_sections`')
                    ->result_array();
            
            return $result;
            
        }
        
        public function deleteEntries($courseid){
            $this->db->delete('course_profiling_sections', array('courseID' => $courseid)); 

        }
        
        public function deleteEntries1($lessonid){
            $this->db->delete('lesson_tag', array('lessonID' => $lessonid)); 

        }
        public function getLessonTags($lessonid){
             $result = $this->db->select('ref_tags.tag,ref_tags.id')

                    ->where('lessonID',$lessonid)
                    ->join('ref_tags','ref_tags.id = lesson_tag.tagID')
                    ->get('lesson_tag')
                    ->result_array();
            
            return $result;
        }
        
        public function hasTest($courseid){
            $r = 'true';
            //echo($r);
            //Get the course syllabus details
             $courseSyllaDet = $this->db->select('ID')
                    ->where('HeirarchyID',$courseid)
                    ->where('Type',2)
                    ->get('syllabus')
                    ->row();
             //get Modules heirid under the course
             $modules = $this->db->select('syllabus.HeirarchyID')
                     ->join('module_modules', 'module_modules.ID = syllabus.HeirarchyID' )
                     ->where('module_modules.status','live')
                     ->where('syllabus.ParentID',$courseSyllaDet->ID)
                     ->get('syllabus')
                     ->result_array();
             //print_r($modules);
             
            
             if(count($modules) == 0){
                 $r = 'false';
             }
            // echo $r;
                foreach($modules as $m){
                    
                    $aa=   $this->db->select('test_sections.*')
                ->join('testbank', 'testbank.testID = test_sections.testbankID')
                ->where('test_sections.moduleID',$m['HeirarchyID'])
                ->where('testbank.courseID',$courseid)
                ->where('testbank.type', "Self Check")
                ->get('test_sections');
                    
                    $resCount = $aa->num_rows();

                    if($resCount == 0){
                        $r = 'false';
                    }

                }
             //echo $r;
             
             return $r;
                     
            
//           $a = $this->db->select('*')
//                    ->where('courseID',$courseid)
//                    ->get('testbank');
//                    
//            $result = $a->num_rows();
//            if($result>=1){
//                return true;
//            }else{
//                return false;
//            }
//            
//      
        }
        
        public function hasOA($courseid){
            $a = $this->db->select('*')
                    ->where('courseID',$courseid)
                    ->where('type','Online Assessment')
                    ->get('testbank');
                    
            $result = $a->num_rows();
            if($result>=1){
                return true;
            }else{
                return false;
            }
        }
        
        public function allDraft($courseSyllaID){
            $r = 'true';
            $result = $this->db->select('syllabus.HeirarchyID,module_modules.status')
                    ->join('module_modules','module_modules.id = syllabus.HeirarchyID')
                    ->where('ParentID',$courseSyllaID)
                    ->get('syllabus')
                    ->result_array();
            
            //return $result;
            
            foreach($result as $a){
                if($a['status']=='live'){
                    $r = 'false';
                    return $r;
                }else{
                     $to_insert= array(
                        'status' => daft
                    );
                    
                     $this->db->where('id',$this->syllabus_m->getHeirarchyId($courseSyllaID))
                         ->update('course_courses',$to_insert);
                    $r = 'true';
                }
                
            }
            
            return $r;
            
            
        }
        
         public function modulesStatusAllDraft($courseID){
            $r = 'true';
            $result = $this->db->select('syllabus.HeirarchyID,module_modules.status')
                    ->join('module_modules','module_modules.id = syllabus.HeirarchyID')
                    ->where('HeirarchyID',$courseID)
                    ->where('Type', 2)
                    ->get('syllabus')
                    ->result_array();
            
            //return $result;
            
            foreach($result as $a){
                if($a['status']=='live'){
                    return 'false';
                }else{
                     $to_insert= array(
                        'status' => daft
                    );
                    
                     $this->db->where('id',$this->syllabus_m->getHeirarchyId($courseSyllaID))
                         ->update('course_courses',$to_insert);
                    $r = 'true';
                }
                
            }
            
            return $r;
            
            
        }
        
        
        
        
        
        

}
