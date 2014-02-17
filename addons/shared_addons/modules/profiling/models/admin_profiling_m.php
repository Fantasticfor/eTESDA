<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a sample module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	Sample Module
 */
class Admin_profiling_m extends MY_Model {

	public function __construct()
	{		
		parent::__construct();
		
		/**
		 * If the sample module's table was named "samples"
		 * then MY_Model would find it automatically. Since
		 * I named it "sample" then we just set the name here.
		 */
		
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
        
         public function getItem($itemid){
            $result = $this->db->select('*')
                    ->where('itemID',$itemid)
                    ->get('profiling_itembank')
                    ->row();
                    
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
        
        public function editSection($secid,$noItems){
            $data = array(
              'noOfItems' => $noItems  
            );
            
            $this->db->where('sectionId',$secid)
                    ->update('profiling_sections',$data);
        }
        
        public function addToItemBank($secid,$prompt,$response,$testType){
            $data = array(
              'sectionID' => $secid,
                'prompt' =>$prompt,
                'response' => $response,
                'testType' => $testType
                
            );
            
            $this->db->insert('profiling_itembank',$data);
            
            return $this->db->insert_id();
        }
        
        public function removeItem($itemid){
            $this->db->where('itemID',$itemid)
                    ->delete('profiling_itembank');
        }
        
         public function saveChoicesMC($itemid, $choice, $response){
            $to_insert= array(
                    
                    'itemID' => $itemid,
                    'choice' => $choice,
                    'response' => $response,
                    

                  

                    
                    );
            
            $this->db->insert('profiling_choices', $to_insert);
            
        }
        
        public function getChoices($itemid){
            $result = $this->db->select('*')
                    ->where('itemID',$itemid)
                    ->order_by('response','desc')
                    ->get('profiling_choices')
                    ->result_array();
            
            return $result;
        }
}
