<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class getSectors extends CI_Controller{

    public function __construct() {
        
        parent::__construct();
       
    }
    
    public function getSectorList(){
        
            $query = $this->db->query("SELECT * FROM default_sector_sectors");
            return $query->result(); 
        
    }

}
?>