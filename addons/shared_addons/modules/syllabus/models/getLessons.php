<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class getLessons extends MY_Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getLessonList($modID){
        $query = $this->db->query("SELECT * FROM default_lesson_lessons where id = ".$modID);
        return $query->result_array();
    }
    
    public function getLessonsID($modID){
        
        $query = $this->db->query("SELECT default_syllabus.HeirarchyID, default_lesson_lessons.id, default_lesson_lessons.title as title
            FROM default_syllabus JOIN default_lesson_lessons ON default_syllabus.HeirarchyID = default_lesson_lessons.id WHERE default_syllabus.Type = 4 AND default_syllabus.ParentID = (
         SELECT ID FROM default_syllabus WHERE HeirarchyID = '$modID' AND Type = 3) ORDER BY `order`");
        $result = $query->result_array();
        
        $lessonsList = array();
        foreach($result as $results){
            
            array_push($lessonsList, $results);
        }
        return $lessonsList;
    
    }
    
    public function getFinishedLes($learnerID, $courseID){
        $query = $this->db->query("SELECT default_learner_lessons.lessonID ID FROM default_learner_lessons JOIN  default_learner_modules
        ON default_learner_modules.lmID = default_learner_lessons.lmID
        JOIN default_learner_courses ON default_learner_modules.lcID = default_learner_courses.lcID
        WHERE default_learner_courses.learnerID = '$learnerID' AND default_learner_courses.courseID= '$courseID' 
        AND default_learner_lessons.dateFinished != '' ");
        
        $result = $query->result_array();
        return $result;
    }
    
    public function getLesHID($lessonID){
         $query = $this->db->query("SELECT HeirarchyID FROM default_syllabus
            WHERE Type = 4 AND ParentID = (SELECT ParentID FROM default_syllabus WHERE HeirarchyID = $lessonID AND Type = 4) ORDER BY `order`");
         
         $result = $query->result_array();
         return $result;
    }
    
    public function learnerLes($lmID, $lessonID, $dateStarted, $lastVisited){
       $to_insert = array(
			
			'lmID' => $lmID,
                        'lessonID' => $lessonID,
                        'dateStarted' => $dateStarted,
                        'lastVisited' => $lastVisited
              );
                        
            $this->db->insert('default_learner_lessons', $to_insert);
            return $this->db->insert_id();
      
   }
   
   public function updateLes($lID, $lastVisited){
       $to_insert = array(
			
			
                        'lastVisited' => $lastVisited,
                       
              );
       
             $this->db->where('lID',$lID)
                   ->update('default_learner_lessons', $to_insert);
             return $lID;
   }
   
   public function updateFinished($lID, $dateFinished){
       $to_insert = array(
			
			
                        'dateFinished' => $dateFinished,
                       
              );
       
             $this->db->where('lID',$lID)
                   ->update('default_learner_lessons', $to_insert);
             return $lID;
   }
   
   public function checkSameL($lmID, $lessonID){
        $query = $this->db->query("SELECT dll.lID, dll.lmID, dll.lessonID FROM default_learner_lessons dll JOIN default_learner_modules dlm ON dll.lmID = dlm.lmID 
        WHERE dll.lmID = $lmID
        AND dll.lessonID = $lessonID");
        $result = $query->result_array();
        return $result;
    }
    
    public function topicLes($topicID){
        $query = $this->db->query("SELECT HeirarchyID FROM default_syllabus 
        WHERE Type = 4 AND ID = (SELECT ParentID FROM default_syllabus WHERE HeirarchyID = $topicID AND Type = 5)");
        $result = $query->row();
        return $result->HeirarchyID;
    }
    
    public function lesPrimaryKey($learnerID, $lessonID){
        $query = $this->db->query("SELECT dll.lID, dll.lessonID
            FROM default_learner_courses dlc JOIN default_learner_modules dlm ON dlc.lcID = dlm.lcID
            JOIN default_learner_lessons dll ON dlm.lmID = dll.lmID
            WHERE dlc.learnerID = $learnerID AND dll.lessonID = '$lessonID'");
        
        $result = $query->result_array();
        return $result;
    }
    
    public function lesCount($moduleID){
        $query = $this->db->query("SELECT COUNT(HeirarchyID) count FROM default_syllabus WHERE Type = 4 AND ParentID IN
        (SELECT ID FROM default_syllabus WHERE Type = 3 AND HeirarchyID = $moduleID)");
        
        $result = $query->result_array();
        return $result;
    }
    
    public function countFinLes($learnerID, $moduleID){
        $query = $this->db->query("SELECT COUNT(dll.lID) count
        FROM default_learner_courses dlc JOIN default_learner_modules dlm ON dlc.lcID = dlm.lcID
        JOIN default_learner_lessons dll ON dlm.lmID = dll.lmID
        WHERE dlc.learnerID = $learnerID AND dlm.moduleID = $moduleID");
        
        $result = $query->result_array();
        return $result;
    }
    
   
    
}

?>
