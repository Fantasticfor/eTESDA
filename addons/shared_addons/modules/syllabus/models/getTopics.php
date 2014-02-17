<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class getTopics extends MY_Model{
    
    public function __construct() {
        parent::__construct();
        
        
    }
    
    public function getTopicsList($lessonID){
        $query = $this->db->query("SELECT default_topics.id, default_topics.title
            FROM default_syllabus JOIN default_topics ON default_syllabus.HeirarchyID = default_topics.id WHERE default_syllabus.Type = 5 AND default_syllabus.ParentID = (
         SELECT ID FROM default_syllabus WHERE HeirarchyID = '$lessonID' AND Type = 4) ORDER BY default_syllabus.order ");
        $result = $query->result_array();
        
        return $result;
    }
    
    public function getTextContent($topicID){
            $query = $this->db->query("SELECT id, title, textCont FROM default_topics WHERE id = $topicID");
        
        $result = $query->result_array();
        return $result;
    }
    
    public function getVidLinks($topicID){
        $query = $this->db->query("SELECT default_media.link 
            FROM default_media JOIN default_topics ON default_media.heirarchyID = default_topics.id
            WHERE default_media.heirarchyID = $topicID AND default_media.typeID = 5 AND mediaUse = 2 AND mediaType = 2");
        $result = $query->result_array();
        $vLinks = array();
        foreach($result as $results){
            
            array_push($vLinks, $results);
        }
        return $vLinks;
    }
    
    public function learnerTopic($lID, $topicID, $dateStarted, $dateFinished){
        
        $to_insert = array(
			
			'lID' => $lID,
                        'topicID' => $topicID,
                        'dateStarted' => $dateStarted,
                        'dateFinished' => $dateFinished
              );
                        
            return $this->db->insert('default_learner_topics', $to_insert);
    
            
    }
    
    
    public function checkSameT($lID, $topicID){
        $query = $this->db->query("SELECT dll.lID, dll.lmID, dll.lessonID FROM default_learner_topics dlt 
            JOIN default_learner_lessons dll ON dll.lID = dlt.lID 
            WHERE dlt.lID = $lID
            AND dlt.topicID = $topicID");
            $result = $query->result_array();
            return $result;
        }
        
    public function lastTopic($lessonID){
        $query = $this->db->query("SELECT HeirarchyID FROM default_syllabus WHERE Type = 5 AND ParentID = (
         SELECT ID FROM default_syllabus WHERE HeirarchyID = $lessonID AND Type = 4) ORDER BY `order` DESC LIMIT 1");
        $result = $query->row();
        return $result->HeirarchyID;
    }   
    
//    public function countTopics($lessonID){
//       $query = $this->db->query("SELECT COUNT(HeirarchyID) count FROM default_syllabus WHERE Type = 5 AND ParentID = (
//        SELECT ID FROM default_syllabus WHERE HeirarchyID = $lessonID AND Type = 4)");
//       
//       $result = $query->row();
//       return $result->count;
//       
//   }
//   
   public function finishedTopics($lID){
       $query = $this->db->query("SELECT topicID FROM default_learner_topics WHERE lID = $lID");
       $result = $query->result_array();
       return $result;
   }
   
   public function getContents($lessonID){
       
        $this->load->model('topic_types_m');
        
        $content = $this->db->where('id',$lessonID)
                ->limit(1)
		->get('topics')
		->row();
        
        $content->layout = $this->topic_types_m->get($content->type_id);
        
        $this->load->vars(array('page' => $content));
        
        
        if ($content->entry_id and  $content->layout->stream_id)
		{
			$this->load->driver('Streams');

			// Get Streams
			$stream = $this->streams_m->get_stream($content->layout->stream_id);

			if ($stream)
			{
				$params = array(
					'limit' => 1,
					'stream' => $stream->stream_slug,
					'namespace' => $stream->stream_namespace,
					'id' => $content->entry_id
				);

				if ($entry = $this->streams->entries->get_entries($params))
				{
					if (isset($entry['entries'][0]))
					{
						$content1 = (object) array_merge((array)$entry['entries'][0], (array)$content);
					}
				}
			}
		}
        
        return $content1;
    }
    
    public function checkOrder($lessonID){
        $query = $this->db->query("SELECT `order` as ordering FROM default_syllabus WHERE Type = 5 AND ParentID = (
         SELECT ID FROM default_syllabus WHERE HeirarchyID = $lessonID AND Type = 4) LIMIT 1");
        $result = $query->row();
        return $result->ordering;
    }
    
    public function lastTop($lessonID){
        $query = $this->db->query("SELECT HeirarchyID FROM default_syllabus WHERE Type = 5 AND ParentID = (
         SELECT ID FROM default_syllabus WHERE HeirarchyID = $lessonID AND Type = 4) ORDER BY ID DESC LIMIT 1");
        $result = $query->row();
        return $result->HeirarchyID;
    }
    
    public function getTLessons($tagName){
        $query = $this->db->query("SELECT ll.title, ll.id
        FROM default_ref_tags rt JOIN default_lesson_tag lt ON rt.id = lt.tagID JOIN default_lesson_lessons ll
        ON ll.id = lt.lessonID WHERE rt.tag = '$tagName' GROUP BY ll.id");
        $result = $query->result_array();
        return $result;
    }
    
    public function lesTags($lesID){
        $query = $this->db->query("SELECT rt.tag
        FROM default_ref_tags rt JOIN default_lesson_tag lt ON rt.id = lt.tagID 
        WHERE lt.lessonID = $lesID");
         $result = $query->result_array();
        return $result;
    }
    
    public function getLesMod($lessonID){
       $query = $this->db->query("SELECT dmm.title, dmm.id FROM default_syllabus 
        syll JOIN default_module_modules dmm ON syll.HeirarchyID = dmm.id WHERE syll.Type = 3 AND syll.ID = (SELECT ParentID FROM default_syllabus
        WHERE HeirarchyID = $lessonID AND Type = 4)");
       
       $result = $query->result_array();
       return $result;
   }
   
   public function modCourse($modID){
       $query = $this->db->query("
        SELECT dmm.title, dmm.id FROM default_syllabus 
        syll JOIN default_course_courses dmm ON syll.HeirarchyID = dmm.id WHERE syll.Type = 2 AND syll.ID = (SELECT ParentID FROM default_syllabus
        WHERE HeirarchyID = $modID AND Type = 3)");
        $result = $query->result_array();
       return $result;
   }

}
?>
