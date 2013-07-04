<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class getCourses extends MY_Model{
    
    public function __construct() {
        parent::__construct();
        
        
    }
    
    public function getCourseList($sectID){
             
        $query = $this->db->query("SELECT * FROM courses WHERE sectorID == '$sectID' ");
        return $query->result();
    }
}
?>
