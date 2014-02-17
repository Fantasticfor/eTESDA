<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class getModules extends MY_Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getModuleList($mID){
        //$a = $this->getCourseHID($HID);
        $query = $this->db->query("SELECT * FROM default_module_modules WHERE id = ".$mID);
        //print_r($a);  
            //(SELECT HeirarchyID FROM default_syllabus WHERE Type = 3 AND 
            //ParentID = (SELECT ID FROM default_syllabus WHERE HeirarchyID = '$HID' AND Type = 2))");
        return $query->result_array();
    }
    
   public function getModuleHID($cID){
       $item = $this->db->query("SELECT HeirarchyID FROM default_syllabus WHERE Type = 3 AND ParentID = (
         SELECT ID FROM default_syllabus WHERE HeirarchyID = '$cID' AND Type = 2) ORDER BY `order`");
   $result = $item->result_array();
   
   //print_r($result);
   $pass = array();
   
   foreach($result as $results){
       //print_r($results['HeirarchyID']);
      $pass[] += $results['HeirarchyID'];  
   }
   //print_r($pass);
    return $pass;
   }
   
   public function getModuleDetails($cID){
       $query = $this->db->query("SELECT default_syllabus.HeirarchyID, default_module_modules.id as id, default_module_modules.title as title, default_module_modules.status
            FROM default_syllabus JOIN default_module_modules ON default_syllabus.HeirarchyID = default_module_modules.id WHERE default_syllabus.Type = 3 AND default_syllabus.ParentID = (
         SELECT ID FROM default_syllabus WHERE HeirarchyID = '$cID' AND Type = 2) ORDER BY default_syllabus.order");
        $result = $query->result_array();
        
        $moduleList = array();
        foreach($result as $results){
            
            array_push($moduleList, $results);
            //array_push($listID, $results['id']);
       //print_r($results['HeirarchyID']);
            //$lessonsList[] += $results['Title'];  
        }
   //print_r($pass);
        return $moduleList;
   }
   
   public function countMods($cID){
       $query = $this->db->query("SELECT COUNT(HeirarchyID) count FROM default_syllabus WHERE Type = 3 AND ParentID = (
        SELECT ID FROM default_syllabus WHERE HeirarchyID = '$cID' AND Type = 2)");
       
       $result = $query->row();
       return $result->count;
       
   }
   
   public function finishedModID($learnerID, $courseID){
       $query = $this->db->query("SELECT default_learner_modules.moduleID ID FROM default_learner_modules JOIN  default_learner_courses
        ON default_learner_modules.lcID = default_learner_courses.lcID
        WHERE default_learner_courses.learnerID = '$learnerID' AND default_learner_courses.courseID = '$courseID' AND default_learner_modules.dateFinished != '' 
        GROUP BY default_learner_modules.moduleID");
       
       $result = $query->result_array();
       return $result;
   }
   
   public function finishedModCount($learnerID, $courseID){
       $query = $this->db->query("SELECT COUNT(default_learner_modules.moduleID) count FROM default_learner_modules JOIN  default_learner_courses
        ON default_learner_modules.lcID = default_learner_courses.lcID
        WHERE default_learner_courses.learnerID = '$learnerID' AND default_learner_courses.courseID = '$courseID' AND default_learner_modules.dateFinished != '' ");
       
       $result = $query->row();
       return $result->count;
   }
   
   public function getLesMod($lessonID){
       $query = $this->db->query("SELECT HeirarchyID FROM default_syllabus WHERE Type = 3 AND ID = (SELECT ParentID FROM default_syllabus
        WHERE HeirarchyID = $lessonID AND Type = 4)");
       
       $result = $query->row();
       return $result->HeirarchyID;
   }
   
   public function startLearner($lcID, $moduleID, $dateStarted, $lastVisited){
       $to_insert = array(
			
			'lcID' => $lcID,
                        'moduleID' => $moduleID,
                        'dateStarted' => $dateStarted,
                        'lastVisited' => $lastVisited,
                        'accessCount' => 1
              );
                        
            $this->db->insert('default_learner_modules', $to_insert);
            return $this->db->insert_id();
   }
   
   public function startFLearner($lcID, $moduleID, $dateStarted, $lastVisited, $dateFinished){
       $to_insert = array(
			
			'lcID' => $lcID,
                        'moduleID' => $moduleID,
                        'dateStarted' => $dateStarted,
                        'lastVisited' => $lastVisited,
                        'dateFinished' => $dateFinished,
                        'accessCount' => 1
              );
                        
            $this->db->insert('default_learner_modules', $to_insert);
            return $this->db->insert_id();
   }
   
   public function aCount($lmID){
       $query = $this->db->query("SELECT accessCount FROM default_learner_modules WHERE lmID = $lmID");
       $result = $query->row();
       
       return $result->accessCount;
   }
   public function updateLast($lmID, $lastVisited, $accessCount){
       $to_insert = array(
			
			
                        'lastVisited' => $lastVisited,
                        'accessCount' => $accessCount += 1
                       
              );
       
             $this->db->where('lmID',$lmID)
                   ->update('default_learner_modules', $to_insert);
             return $lmID;
   }
   
   public function trackPopout($learnerID, $courseID){
       $query = $this->db->query("SELECT dmm.id, dll.id lesID, dll.title lesTitle, dmm.title modTitle FROM default_learner_modules dlm 
                JOIN default_module_modules dmm ON dlm.moduleID = dmm.id
                JOIN default_learner_lessons ON default_learner_lessons.lmID = dlm.lmID
                JOIN default_lesson_lessons dll ON default_learner_lessons.lessonID = dll.id 
                JOIN default_learner_courses dlc ON dlm.lcID = dlc.lcID
                WHERE dlc.courseID = $courseID AND dlc.learnerID = $learnerID AND dlc.isEnrolled = 1 AND ISNULL(dlm.dateFinished) AND ISNULL(default_learner_lessons.dateFinished) LIMIT 1 ");
       
       $result = $query->result_array();
       return $result;
   }
   
   public function checkSame($lcID, $moduleID){
        $query = $this->db->query("SELECT dlm.lmID, dlc.learnerID, dlm.lcID, dlm.moduleID FROM default_learner_modules dlm JOIN default_learner_courses dlc ON dlm.lcID = dlc.lcID WHERE dlm.lcID = $lcID
        AND dlm.moduleID = $moduleID");
        $result = $query->result_array();
        return $result;
    }
    
   public function courseMods($courseID, $learnerID){
       $query = $this->db->query("SELECT dmm.id, dmm.title, dlm.dateStarted, dlm.accessCount FROM default_learner_courses dlc JOIN default_learner_modules dlm
           ON dlc.lcID = dlm.lcID JOIN default_module_modules dmm ON
           dmm.id = dlm.moduleID WHERE dlc.courseID = $courseID AND dlc.learnerID = $learnerID AND dlc.isEnrolled = 1");
       $result = $query->result_array();
       return $result;
   }
   
   
   public function modTime($moduleID, $learnerID){
       $query = $this->db->query("SELECT dmm.title, dlm.dateStarted, dlm.dateFinished FROM default_learner_courses dlc JOIN default_learner_modules dlm
           ON dlc.lcID = dlm.lcID JOIN default_module_modules dmm ON
           dmm.id = dlm.moduleID WHERE dlm.moduleID = $moduleID AND dlc.learnerID = $learnerID AND dlc.isEnrolled = 1");
       $result = $query->result_array();
       return $result;
   }
   
   public function checkSameM($learnerID, $moduleID){
       $query = $this->db->query("SELECT dlm.lmID, dlc.learnerID, dlm.lcID, dlm.moduleID FROM default_learner_modules dlm 
        JOIN default_learner_courses dlc ON dlm.lcID = dlc.lcID WHERE dlc.learnerID = $learnerID
        AND dlm.moduleID = $moduleID");
       $result = $query->result_array();
       return $result;
   }
   
   public function getModuleName($moduleID){
       $query = $this->db->query("SELECT title FROM default_module_modules WHERE id = $moduleID");
       $result = $query->row();
       return $result->title;
   }
   
   public function doneMods($learnerID){
       $query = $this->db->query("SELECT dmm.id, dmm.title, dlm.dateFinished FROM default_learner_courses dlc JOIN default_learner_modules dlm ON dlc.lcID = dlm.lcID 
        JOIN default_module_modules dmm ON dmm.id = dlm.moduleID
        WHERE dlm.dateFinished != ' ' AND dlc.learnerID = $learnerID
        ORDER BY dlm.dateFinished DESC");
       $result = $query->result_array();
       return $result;
   }
       
   
}

?>