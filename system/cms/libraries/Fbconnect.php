<?php

include (APPPATH.'libraries/Fblib/facebook.php');

class Fbconnect extends Facebook{
    
     public $user = null;
     public $user_id = null;
     public $fb = false;
     public $fbSession = false;
     public $appkey = 0;
    
    public function Fbconnect(){
        
        
        $ci =& get_instance();
        
        $ci->config->load('facebook', TRUE);
        
        $config = $ci->config->item('facebook');
        
        parent::__construct($config);
        $_REQUEST = $_GET;
        
        $this->user_id = $this->getUser();
        $me = null;
        
        if($this->user_id){
            try{
                $me = $this->api('/me');
                $this->user = $me;
            }catch(FacebookApiException $e){
                error_log($e);
            }
        }
  
    }
    
    public function send_back($value){
        return $value;
    }
    
    public function test(){
        
        $ci =& get_instance();
        
        $ci->load->library('form_validation');
        
    }
    
}

?>
