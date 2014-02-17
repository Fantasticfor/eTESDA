<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class getSectors extends MY_Model{

    public function __construct() {
        
        parent::__construct();
       
    }
    
    public function getSectorList(){
        
           // $query = $this->db->query("SELECT * FROM default_sector_sectors");
            $query1 =  $this->db
			->select('id,title,description,image')
                    ->get('default_sector_sectors')
                    ->result_array();
                 
            return $query1; 
        
    }
    
    public function getSectDetails($id){
        $query2 = $this->db->query("SELECT * FROM default_sector_sectors WHERE id = '$id'");
        return $query2->result_array();
    }
    
    public function getSectorName($id){
        $query3 = $this->db->query("SELECT default_sector_sectors.title FROM default_sector_sectors JOIN default_syllabus
        ON default_sector_sectors.id = default_syllabus.HeirarchyID WHERE default_syllabus.ID = (SELECT ParentID FROM default_syllabus WHERE HeirarchyID = '$id' and Type = 2)");
        
       $result = $query3->row();
       return $result->title;
    }
    
    public function getSectorID($id){
        $query3 = $this->db->query("SELECT default_sector_sectors.id FROM default_sector_sectors JOIN default_syllabus
        ON default_sector_sectors.id = default_syllabus.HeirarchyID WHERE default_syllabus.ID = (SELECT ParentID FROM default_syllabus WHERE HeirarchyID = '$id' and Type = 2)");
        
       $result = $query3->row();
       return $result->id;
    }
    
    public function getSectName($id){
        $query3 = $this->db->query("SELECT default_sector_sectors.title FROM default_sector_sectors JOIN default_syllabus
        ON default_sector_sectors.id = default_syllabus.HeirarchyID WHERE default_syllabus.ID = (SELECT ParentID FROM default_syllabus WHERE HeirarchyID = '$id' and Type = 2) GROUP BY default_sector_sectors.title");
        
       $result = $query3->result_array();
       return $result;
    }
    
    public function getSectTitle($sectID){
        $query = $this->db->query("SELECT title FROM default_sector_sectors WHERE id = $sectID");
        $result = $query->row();
        return $result->title;
    }

}
?>