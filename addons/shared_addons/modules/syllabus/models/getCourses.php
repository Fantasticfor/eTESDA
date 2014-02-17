<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class getCourses extends MY_Model{
    
    public function __construct() {
        parent::__construct();
        
        
    }
    
    public function getCourse($courseID){
             
        $query = $this->db->query("SELECT * FROM default_course_courses where id = ".$courseID);
        return $query->result_array();
        
       
        //$query1 =  $this->db
	//		->select('c1.id, c1.title, c1.description, c1.sectID')
          //           ->from('default_course_courses AS c1, default_syllabus s1')
            //           ->where('id', $sectID)
              //          ->where('c1.sectID = s1.HeirarchyID') 
                //        ->result_array();
                 
         //   return $query1; 
    }
    
    public function getAllCourses(){
         $query = $this->db->query("SELECT * FROM default_course_courses");
        return $query->result_array();
    }
    
    public function getCourseID($sectID){
        
        $query = $this->db->query("SELECT sylla.HeirarchyID FROM default_syllabus sylla JOIN default_course_courses dcc ON sylla.HeirarchyID = dcc.id
WHERE sylla.Type = 2 AND dcc.status != 'draft' AND sylla.ParentID = (
         SELECT ID FROM default_syllabus WHERE HeirarchyID = $sectID AND Type = 1) GROUP BY sylla.HeirarchyID ORDER BY sylla.HeirarchyID");
        $result = $query->result_array();
        
        $courseList = array();
   
        foreach($result as $results){
       //print_r($results['HeirarchyID']);
            $courseList[] += $results['HeirarchyID'];  
        }
   //print_r($pass);
        return $courseList;
    }
    
    public function inDemandCourses(){
        $query = $this->db->query("SELECT default_course_courses.duration, default_course_courses.image, default_course_courses.id, default_course_courses.title, 
        default_course_courses.image, COUNT(default_learner_courses.courseID) count FROM default_learner_courses JOIN
        default_course_courses ON default_course_courses.id = default_learner_courses.courseID 
        WHERE default_learner_courses.isEnrolled = 1 AND default_course_courses.status != 'draft'
        GROUP BY courseID
        ORDER BY count DESC LIMIT 4");
        $result = $query->result_array();
        
        return $result;
    }
    
    public function getCourseDetails($id){
        $query = $this->db->query("SELECT image, id ID, title, status
            FROM default_course_courses WHERE id = $id ");
        $result = $query->result_array();
        
        return $result;
    }
    
    public function getCourseOpp($id){
        $query = $this->db->query("SELECT opportunity, salary FROM default_course_opps WHERE courseID = '$id'");
        $result = $query->result_array();
        
        return $result;
    }
    
    public function latestCourses(){
        $query = $this->db->query("SELECT duration, id, title, image FROM default_course_courses WHERE status != 'draft' ORDER BY created DESC LIMIT 2");
        $result = $query->result_array();
        
        return $result;
    }
    
    public function countEnrolled($id){
      $query = $this->db->query("SELECT COUNT(courseID) count FROM default_learner_courses WHERE courseID = '$id' AND isEnrolled = 1 GROUP BY courseID");
      
      $result = $query->row();
      return $result->count;
    }
    
    public function getLearnerCourses($learnerID){
        $query = $this->db->query("SELECT default_course_courses.id ID, default_course_courses.title FROM default_course_courses JOIN default_learner_courses ON default_course_courses.id = 
            default_learner_courses.courseID WHERE default_learner_courses.learnerID = '$learnerID' AND default_learner_courses.status != 3 AND default_learner_courses.isEnrolled = 1");
        $result = $query->result_array();
        
        
        $cID = array();
   
        foreach($result as $results){
       //print_r($results['HeirarchyID']);
        $cID[] += $results['ID'];  
        }
   //print_r($pass);
        return $cID;
    }
    
    public function getAllLCourses($learnerID){
        $query = $this->db->query("SELECT default_course_courses.id ID, default_course_courses.title FROM default_course_courses JOIN default_learner_courses ON default_course_courses.id = 
            default_learner_courses.courseID WHERE default_learner_courses.learnerID = '$learnerID' AND default_learner_courses.isEnrolled = 1");
        $result = $query->result_array();
        
        
        $cID = array();
   
        foreach($result as $results){
       //print_r($results['HeirarchyID']);
        $cID[] += $results['ID'];  
        }
   print_r($cID);
        return $cID;
    }
    
    public function getFinishedCourses($learnerID){
        $query = $this->db->query("SELECT default_course_courses.id ID, default_course_courses.title FROM default_course_courses JOIN default_learner_courses ON default_course_courses.id = 
            default_learner_courses.courseID WHERE default_learner_courses.learnerID = '$learnerID' AND default_learner_courses.isEnrolled = 1 AND default_learner_courses.status = 3");
        $result = $query->result_array();
        
        
        $cID = array();
   
        foreach($result as $results){
       //print_r($results['HeirarchyID']);
        $cID[] += $results['ID'];  
        }
   //print_r($pass);
        return $cID;
    }
    
    public function addLearnerCourse($learnerID, $courseID, $dateNow){
        
         $to_insert = array(
			
			'learnerID' => $learnerID,
                        'courseID' => $courseID,
                        'dateStarted' => $dateNow,
                        'status' => 1,
                        'isEnrolled' => 0
              );
                        
            return $this->db->insert('default_learner_courses', $to_insert);
      
    }
    
    public function upIsEnrolled($learnerID, $courseID){
        $to_insert = array(
			
			
                        'isEnrolled' => 1,
                       
              );
       
             $this->db->where('learnerID',$learnerID)
                     ->where('courseID',$courseID)
                   ->update('default_learner_courses', $to_insert);
    }
    
     public function learnerCoursesID($learnerID, $courseID){
        $query = $this->db->query("SELECT default_course_courses.id ID FROM default_course_courses JOIN default_learner_courses ON default_course_courses.id = 
            default_learner_courses.courseID WHERE default_learner_courses.learnerID = '$learnerID' AND default_learner_courses.isEnrolled = 1 AND default_learner_courses.courseID = $courseID");
        $result = $query->result_array();
        
        
        //$cID = array();
   
  //      foreach($result as $results){
       //print_r($results['HeirarchyID']);
    //    $cID[] += $results['ID'];  
      //  }
   //print_r($pass);
        return $result;
    }
    
    public function getOverviewVids($cID){
       $query = $this->db->query("SELECT link FROM default_media WHERE heirarchyID = $cID AND typeID = 2 AND mediaType = 2 AND mediaUse = 1");
       $result = $query->result_array();
       return $result;
   }
   
   public function getLCourses($learnerID){
        $query = $this->db->query("SELECT default_course_courses.id ID, default_course_courses.title FROM default_course_courses JOIN default_learner_courses ON default_course_courses.id = 
            default_learner_courses.courseID WHERE default_learner_courses.learnerID = '$learnerID' AND default_learner_courses.isEnrolled = 1 ORDER BY ID");
        $result = $query->row();
        return $result->ID;
    }
    
    public function learnerCID($learnerID, $moduleID){
        $query = $this->db->query("SELECT ds.HeirarchyID, dlc.lcID FROM default_learner_courses dlc JOIN default_syllabus ds ON dlc.courseID = ds.HeirarchyID
            WHERE dlc.learnerID = $learnerID AND ds.Type = 2 AND ds.ID = (SELECT ParentID FROM default_syllabus
            WHERE HeirarchyID = $moduleID AND Type = 3) ");
        $result = $query->result_array();
        return $result;
    }
    
    public function modCourse($moduleID){
        $query = $this->db->query("SELECT HeirarchyID FROM default_syllabus 
        WHERE Type = 2 AND ID = (SELECT ParentID FROM default_syllabus WHERE HeirarchyID = $moduleID AND Type = 3)");
        $result = $query->row();
        return $result->HeirarchyID;
    }
    
    public function getFinCourses($learnerID){
        $query = $this->db->query("SELECT default_course_courses.id ID, default_course_courses.title FROM default_course_courses JOIN default_learner_courses ON default_course_courses.id = 
            default_learner_courses.courseID WHERE default_learner_courses.learnerID = '$learnerID' AND default_learner_courses.status = 3 AND default_learner_courses.isEnrolled = 1");
        $result = $query->result_array();
        
        return $result;
    }
    
    public function courseExist($courseID, $learnerID){
        $query = $this->db->query("SELECT lcID FROM default_learner_courses WHERE courseID = $courseID AND learnerID = $learnerID");
        $result = $query->result_array();
        return $result;
    }
    
    public function allLCourses($learnerID){
        $query = $this->db->query("SELECT dcc.id, dcc.title, dlc.dateStarted, dlc.dateFinished, dlc.status, dlc.learnerID FROM default_learner_courses dlc JOIN default_course_courses dcc
           ON dlc.courseID = dcc.id WHERE dlc.learnerID = $learnerID AND dlc.isEnrolled = 1");
        $result = $query->result_array();
        return $result;
    }
    
    public function allLCoursesDets($learnerID, $courseID){
        $query = $this->db->query("SELECT * FROM default_learner_courses WHERE learnerID = $learnerID AND isEnrolled = 1 AND courseID = $courseID");
        $result = $query->result_array();
        return $result;
    }
    
    
    public function sectCourse($sectorID){
        $query = $this->db->query("SELECT dcc.id, dcc.title, dcc.status FROM default_course_courses dcc JOIN default_syllabus sylla ON dcc.id = sylla.HeirarchyID
        WHERE sylla.Type = 2 AND sylla.ParentID = (SELECT ID FROM default_syllabus WHERE Type = 1 AND HeirarchyID = $sectorID)");
        $result = $query->result_array();
        return $result;
    }
    
    public function courseEnrollees($courseID){
        $query = $this->db->query("SELECT COUNT(lcID) count FROM default_learner_courses WHERE courseID = $courseID and isEnrolled = 1");
        $result = $query->result_array();
        return $result;
    }
    
    public function courseInac($courseID, $monthNow, $yearNow){
        $query = $this->db->query("SELECT COUNT(dlm.lmID) count FROM default_learner_modules dlm JOIN default_learner_courses dlc ON
        dlm.lcID = dlc.lcID JOIN default_course_courses dcc ON dcc.id = dlc.courseID 
        WHERE dlc.courseID = $courseID AND MONTH(DATE_ADD(dlm.lastVisited, INTERVAL 28 DAY)) <= $monthNow
        AND YEAR(DATE_ADD(dlm.lastVisited, INTERVAL 28 DAY)) <= $yearNow AND ISNULL(dlm.lastVisited)");
        $result = $query->result_array();
        return $result;
    }
    
    public function courseGrads($courseID){
        $query = $this->db->query("SELECT COUNT(lcID) count FROM default_learner_courses WHERE courseID = $courseID
            AND isEnrolled = 1 and status = 3");
        $result = $query->result_array();
        return $result;
    }
    
    public function aveDuration($courseID){
        $query = $this->db->query("SELECT COUNT(lcID) count, DATEDIFF(dateFinished, dateStarted) differ 
        FROM default_learner_courses WHERE courseID = $courseID
        AND status = 3 AND isEnrolled = 1
        GROUP BY DATEDIFF(dateFinished, dateStarted)");
        $result = $query->result_array();
        return $result;
    }
    
    public function getLCID($learnerID, $courseID){
        $query = $this->db->query("SELECT lcID FROM default_learner_courses WHERE courseID = $courseID AND learnerID = $learnerID");
        $result = $query->row();
        return $result->lcID;
    }
    
    public function getCourseTitle($courseID){
        $query = $this->db->query("SELECT title FROM default_course_courses WHERE id = $courseID");
        $result = $query->row();
        return $result->title;
    }
    public function getStart_End($learnerID, $courseID){
        $query = $this->db->query("SELECT dlc.dateStarted, MAX(dlm.lastVisited) last 
            FROM default_learner_courses dlc JOIN default_learner_modules dlm ON
            dlc.lcID = dlm.lcID WHERE dlc.learnerID = $learnerID AND dlc.courseID = $courseID");
        $result = $query->result_array();
        return $result;
    }
    
    public function getAllTags(){
        $query = $this->db->query("SELECT id, tag FROM default_ref_tags");
        $result = $query->result_array();
        return $result;
    }
    
    public function getCTags($tag){
        $query = $this->db->query("SELECT sy.HeirarchyID, dcc.title, dcc.status FROM default_syllabus sy JOIN default_course_courses dcc ON dcc.id = sy.HeirarchyID
        WHERE sy.Type = 2 
        AND sy.ID IN(SELECT ParentID FROM default_syllabus
        WHERE Type = 3 AND ID IN(SELECT sylla.ParentID FROM default_lesson_tag lt 
        JOIN default_ref_tags rt ON rt.id = lt.tagID JOIN default_syllabus sylla 
        ON sylla.HeirarchyID = lt.lessonID WHERE rt.tag = '$tag' AND sylla.Type = 4 ))");
        $result = $query->result_array();
        return $result;
    }
    
    public function getTagLes($courseID, $tag){
        $query = $this->db->query("SELECT sy.HeirarchyID, ll.title FROM default_syllabus sy JOIN default_lesson_tag lt ON sy.HeirarchyID = lt.lessonID
        JOIN default_ref_tags rt ON rt.id = lt.tagID JOIN default_lesson_lessons ll ON ll.id = sy.HeirarchyID
        WHERE sy.Type = 4 AND rt.tag = '$tag' AND sy.ParentID IN(
        SELECT ID FROM default_syllabus WHERE Type = 3 AND ParentID IN(
        SELECT ID FROM default_syllabus WHERE Type = 2 AND HeirarchyID = $courseID))
        GROUP BY ll.title");
        $result = $query->result_array();
        return $result;
    }
    
    public function countCourses ($learnerID){
        $query = $this->db->query("SELECT COUNT(lcID) count FROM default_learner_courses WHERE learnerID = $learnerID 
                AND isEnrolled = 1");
        $result = $query->row();
        return $result->count;
    }
    
    public function checkEnBadge($learnerID){
        $query = $this->db->query("SELECT lbID FROM default_learner_badge WHERE
            learnerID = $learnerID AND badgeID = 2");
        $result = $query->row();
        return $result;
    }
    
    public function enBadge($learnerID, $dateNow){
        
         $to_insert = array(
			
			'learnerID' => $learnerID,
                        'badgeID' => 2,
                        'dateEarned' => $dateNow
                        
              );
                        
            return $this->db->insert('default_learner_badge', $to_insert);
      
    }
    
    public function coBadge(){
        $query = $this->db->query("SELECT name FROM default_badge_badges WHERE activity = 'Enrolled 5 times'");
        $result = $query->row();
        return $result->name;
    }
    
    public function coBadgeImg(){
        $query = $this->db->query("SELECT image FROM default_badge_badges WHERE activity = 'Enrolled 5 times'");
        $result = $query->row();
        return $result->image;
    }
    
   
    
   }
    

?>
