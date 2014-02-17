<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a sample module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	Sample Module
 */
class Model_users extends MY_Model {

        public $userdb;
    
	public function __construct()
	{		
		parent::__construct();
		
		/**
		 * If the sample module's table was named "samples"
		 * then MY_Model would find it automatically. Since
		 * I named it "sample" then we just set the name here.
		 */
            $db = array();
            $db['hostname'] = 'localhost';
            $db['username'] = 'root';
            $db['password'] = '';
            $db['database'] = 'tesda_centraldb';
            $db['dbdriver'] = 'mysql';
            $db['dbprefix'] = '';
            $db['pconnect'] = TRUE;
            $db['db_debug'] = TRUE;
            $db['cache_on'] = FALSE;
            $db['cachedir'] = '';
            $db['char_set'] = 'utf8';
            $db['dbcollat'] = 'utf8_general_ci';
            $db['swap_pre'] = '';
            $db['autoinit'] = TRUE;
            $db['stricton'] = FALSE;
            
            
            $this->userdb = $this->load->database($db, TRUE);
            
	}
	

    
    public function can_log_in(){
        
        $this->userdb->where('email',$this->input->post('email'));
        $this->userdb->where('userpassword',md5($this->input->post('password')));
        
        $query = $this->userdb->get('users');
        
        if($query->num_rows() == 1){
            
            return true;
        }else{
            return false;
        }
    }
    
    public function add_temp_user($key){
        
       $data = array(
         
           'email' => $this->input->post('email'),
           'userpassword' =>md5($this->input->post('password')),
           'key' => $key,
           'usertypeid' => 2,
           'status' => 0
           
       ); 
       
       $query = $this->userdb->insert('users',$data);
       
      //echo print_r($query);
      $this->userdb->select_max('userid');
       $getid = $this->userdb->get('users');
       $getid2 = $getid->row();
      // $row1 = $getid->row();
       
       
       $data2 = array(
           'userid' => $getid2->userid,
           'firstname' => $this->input->post('fname'),
           'middlename' => $this->input->post('mname'),
           'lastname' => $this->input->post('lname'),
           'civilstatus' => 'Single',
           'birthday' => date("Y-m-d H:i:s"), 
           'ismale' => 1,
           'dateJoined' => date("Y-m-d H:i:s")
       );
       
       $query2 = $this->userdb->insert('applicants',$data2);

       $toInsert = array( 
                'userid' => $getid2->userid
            ); 
            //print_r($toInsert);
            $this->userdb->insert('address',$toInsert);

       
       if ($query||$query2){
           return true;
       }else{
           return false;
       }
        
    }
    
    public function is_key_valid($key){
        $this->userdb->where('key',$key);
        $query = $this->userdb->get('users');
        
        
        if($query->num_rows() == 1){
            return true;
        }else return false;
    }
    
    public function add_user($key){
        
        $this->userdb->where('key',$key);
        $temp_user= $this->userdb->get('users');
        
        if($temp_user){
            $row = $temp_user->row();
            
            $this->userdb->where('userid',$row->userid);
            $userprofile1 = $this->userdb->get('applicants');
             $userprofile = $userprofile1->row();
            
            $data = array(
                
                
                'userpassword' => $row->userpassword,
                'key' => $row->key,
                'usertypeid' => $row->usertypeid,
                 'status' => 1
                
            );
            
            $did_add_user = $this->userdb->update('users', $data);
            
            
            
            /* PASSING PROFILE INFO */
            $profile = array(
              
                'fname' => $userprofile->firstname,
                'mname' => $userprofile->middlename,
                'lname' => $userprofile->lastname     
                
            );
        }
        
        if($did_add_user){
           
            return true;
        }else return false;
        
    }
    
//    public function get_user($email,$password){
//        
//        $data = array(
//          'email' => $email,
//          'userpassword' => $password
//        );
//        
//        $user = $this->userdb->get_where('users',$data);
//       
//        $row = $user->row();
//          $data1 = array(
//                
//              'userid' => $row->userid
//                
//            );
//        $userprofile1 = $this->userdb->get_where('applicants',$data1);
//        $userprofile = $userprofile1->row();//$userprofile - laman na nya yung row ng query in array form
//        //echo print_r($user); 
//        $profile = array( // lagay mo nalang dito kung ano mga kailangan mo from that row
//               'userid' => $userprofile->userid,
//                //'fname' => $userprofile->firstname,
//                //'mname' => $userprofile->middlename,
//                //'lname' => $userprofile->lastname,
//                //'contact' => $userprofile->cellno."/".$userprofile->telno
//                 //ADDRESS
//                
//            );
//       
//        return $profile;
//    }
    
    public function get_user($email,$password){
        $profile1 = array();
        $data = array(
          'email' => $email,
          'userpassword' => $password
        );
        
        $user = $this->userdb->get_where('users',$data);
        $row = $user->row();
        
//        //print_r($user);
//        if($a == '0'){
//            
//            return $user; 
//           
//        }else{
       
        $profile1['user'] = $row;
        
          $data1 = array(
                
              'userid' => $row->userid
                
            );
        $userprofile1 = $this->userdb->get_where('applicants',$data1);
        $userprofile = $userprofile1->row();//$userprofile - laman na nya yung row ng query in array form
        //echo print_r($user); 
        $profile = array( // lagay mo nalang dito kung ano mga kailangan mo from that row
               'userid' => $userprofile->userid,
                //'fname' => $userprofile->firstname,
                //'mname' => $userprofile->middlename,
                //'lname' => $userprofile->lastname,
                //'contact' => $userprofile->cellno."/".$userprofile->telno
                 //ADDRESS
                
            );
       
        $profile1['profile'] = $profile;
        return $profile1;
//        }
//        return "AA";
    }
    
    public function email_valid(){
        
        $this->userdb->where('email',$this->input->post('email'));
       
        
        $query = $this->userdb->get('users');
        
        if($query->num_rows() == 1){
            
            return false;
        }else{
            return true;
        }
    }
    
    
    ///////////////////////////////////////////////////////FB//////////////////////////////////////////////////////////
     public function is_member($facebook_user){
      
      $this->userdb->where('email', $facebook_user['email']);
      $query = $this->userdb->get('users');
      
      if($query->num_rows() == 1){
          return true;
      }else
      {
          return false;
      }
      
  }
  
  public function log_in($facebook_user){
      
       $data = array(
         'email' => $facebook_user['email']
        );
        
        $user = $this->userdb->get_where('users',$data);
        $row = $user->row();
         /* $data1 = array(
                
              'userid' => $row->userid
                
            );*/
      //  $userprofile1 = $this->userdb->get_where('applicants',$data1);
       // $userprofile = $userprofile1->row();
         $profile = array(
                /*'smallpicture' => $userprofile->smallpicture,
                'picture' => $userprofile->picture,
                'fname' => $userprofile->firstname,
                'mname' => $userprofile->middlename,
                'lname' => $userprofile->lastname,
                'contact' => $userprofile->cellno."/".$userprofile->telno*/
             'userid' => $row->userid
                
                
            );
       return $profile;
      /*
      $data = array(
        
          'is_logged_in' => 1,
          'email' => $facebook_user['email'],
          'name' => $facebook_user['name']
          
      );
      
      $this->session->set_userdata($data);
      
      */
  }
  
  public function sign_up($facebook_user){
      
      /* ADD TO USERS TABLE */
      $data = array(
         
          'email' => $facebook_user['email'],
           'userpassword' =>'',
           'key' => '',
           'usertypeid' => 2,
           'status' => 1,
          'fbusername' =>$facebook_user['username']
           
       ); 
       
       $query = $this->userdb->insert('users',$data);
      
       
       /* ADD TO APPLICATIONS TABLE */
       $this->userdb->select_max('userid');
       $getid = $this->userdb->get('users');
       $getid2 = $getid->row();
       
       $genderno = 1;
         if ($facebook_user['gender'] == 'male'){
                $genderno = 1;
            }  else {
                $genderno = 0;
           }
      
       $birthdaydate = date( "Y-m-d H:i:s", strtotime($facebook_user['birthday'] ) );
     if ($facebook_user['relationship_status']==null || isset($facebook_user['relationship_status'])){
          $relstat = '';   
      }
      else
      {
           $relstat =$facebook_user['relationship_status'];
      }
      $data2 = array(
           'userid' => $getid2->userid,
           'firstname' => $facebook_user['first_name'],
           'middlename' => '',
           'lastname' => $facebook_user['last_name'],
           'civilstatus' => $relstat,
           'birthday' => $birthdaydate, 
           'ismale' => $genderno,
           'picture' => 'http://graph.facebook.com/'.$facebook_user['username'].'/picture?type=large',
          'smallpicture' => 'http://graph.facebook.com/'.$facebook_user['username'].'/picture?width=23&height=23',
          'dateJoined' => date("Y-m-d H:i:s")
           
       );
      
        $toInsert = array( 
                'userid' => $getid2->userid 
            ); 
            
            $this->userdb->insert('address',$toInsert);

      
       $query2 = $this->userdb->insert('applicants',$data2);
      
      
     /* $data = array(
        
          'fname' => $facebook_user['first_name'],
          'lname' => $facebook_user['last_name'],
          //'email' => $facebook_user['email'],
          //'fb_id' => $facebook_user['id']
          
      );
      
      $this->db->insert('users',$data);*/
      
  }
  
  public function get_name($id){
      $data = array('userid'=>$id);
      
      $userprofile1 = $this->userdb->select('*')
              ->where('userid', $id)
              ->get('applicants');
      $userprofile = $userprofile1->row();
      
      return $userprofile->firstname;
  }
  
  public function getInfo($userID){
      $userprofile =  $this->userdb->query("SELECT firstname, middlename, lastname, cellno, picture FROM applicants WHERE userid = $userID"); 
      
      $result = $userprofile->result_array();
      return $result;
  }
  
  public function getAddress($userID){
      $useraddress = $this->userdb->query("SELECT streetno, brgy, district, city, province, zipcode FROM address WHERE userid = $userID");
      
      $result = $useraddress->result_array();
      return $result;
  }
  
  public function getOA($userID){
          $query = $this->db->query("SELECT default_course_courses.title, default_course_courses.id, default_course_courses.image
              FROM default_course_courses JOIN default_learner_courses ON default_course_courses.id = default_learner_courses.courseID
              WHERE default_learner_courses.learnerID = '$userID' AND default_learner_courses.status = 2");
          
          $result = $query->result_array();
          return $result;
  }
  
  public function finishedOA($userID){
          $query = $this->db->query("SELECT default_testbank.courseID cID, default_testbank.noOfItems FROM default_testbank JOIN
          default_testresult ON default_testbank.testID = default_testresult.testID WHERE
          default_testresult.learnerID = $userID AND default_testbank.type = 'Online Assessment' GROUP BY cID");
          $result = $query->result_array();
          $cID = array();
   
        foreach($result as $results){
       //print_r($results['HeirarchyID']);
        $cID[] += $results['cID'];  
        }
        //print_r($pass);
        return $cID;
  }
  
  public function finishedSC($userID){
          $query = $this->db->query("SELECT default_testbank.courseID cID, default_testbank.noOfItems FROM default_testbank JOIN
          default_testresult ON default_testbank.testID = default_testresult.testID WHERE
          default_testresult.learnerID = $userID AND default_testbank.type = 'Self Check' GROUP BY cID");
          
          $result = $query->result_array();
          return $result;
  }
  
  public function allLearners(){
      $query = $this->userdb->query("SELECT applicants.userid, applicants.firstname, applicants.middlename, applicants.dateJoined, applicants.lastname, users.email
            FROM users JOIN applicants on applicants.userid = users.userid
            WHERE users.usertypeid = 2
            ");
      $result = $query->result_array();
      return $result;
  }
  
  public function learnerInfo($learnerID){
      $query = $this->userdb->query("SELECT applicants.userid, applicants.firstname, applicants.middlename, applicants.dateJoined, applicants.lastname, applicants.picture, users.email
            FROM users JOIN applicants on applicants.userid = users.userid
            WHERE users.usertypeid = 2 and users.userid = $learnerID
            ");
      $result = $query->result_array();
      return $result;
  }
  
  public function latDateSC($courseID, $learnerID){
      $query = $this->db->query("SELECT MAX(tr.dateTaken) latest FROM default_testbank tb JOIN default_testresult tr ON tb.testID = tr.testID 
        JOIN default_test_sections ts ON tb.testID = ts.testbankID 
        JOIN default_module_modules dmm ON ts.moduleID = dmm.id  
        JOIN default_section_results sr ON tr.resultID = sr.resultID AND ts.sectionID = sr.sectionID
        WHERE tb.type = 'Self Check' AND tr.learnerID = $learnerID
        AND tb.courseID = $courseID GROUP BY sr.sectionID");
      $result = $query->result_array();
      return $result;
  }
  
  public function latSC($learnerID, $moduleID){
      $query = $this->db->query("SELECT MAX(tr.dateTaken) latest FROM default_testbank tb JOIN default_testresult tr ON tb.testID = tr.testID 
        JOIN default_test_sections ts ON tb.testID = ts.testbankID 
        JOIN default_module_modules dmm ON ts.moduleID = dmm.id  
        JOIN default_section_results sr ON tr.resultID = sr.resultID AND ts.sectionID = sr.sectionID
        WHERE tb.type = 'Self Check' AND tr.learnerID = $learnerID
        AND ts.moduleID = $moduleID GROUP BY sr.sectionID");
      
      $result = $query->result_array();
      return $result;
  }
  
  public function modSC($learnerID, $courseID, $dateTaken){
      $query = $this->db->query("SELECT dmm.id, dmm.title, tr.dateTaken, tr.result, tb.noOfItems, tr.remarks  FROM default_testbank tb 
           JOIN default_testresult tr ON tb.testID = tr.testID 
          JOIN default_test_sections ts ON tb.testID = ts.testbankID 
          JOIN default_module_modules dmm ON ts.moduleID = dmm.id
          JOIN default_section_results sr ON sr.resultID = tr.resultID AND ts.sectionID = sr.sectionID
          WHERE tb.type = 'Self Check' AND tr.learnerID = $learnerID AND tb.courseID = $courseID
              AND tr.dateTaken = '$dateTaken'
              GROUP BY sr.sectionID");
      $result = $query->result_array();
      return $result;
  }
  
  public function moduleSC($learnerID, $moduleID, $dateTaken){
      $query = $this->db->query("SELECT dmm.id, tr.remarks  FROM default_testbank tb 
           JOIN default_testresult tr ON tb.testID = tr.testID 
          JOIN default_test_sections ts ON tb.testID = ts.testbankID 
          JOIN default_module_modules dmm ON ts.moduleID = dmm.id
          JOIN default_section_results sr ON sr.resultID = tr.resultID AND ts.sectionID = sr.sectionID
          WHERE tb.type = 'Self Check' AND tr.learnerID = $learnerID AND ts.moduleID = $moduleID
              AND tr.dateTaken = '$dateTaken'
              GROUP BY sr.sectionID");
      $result = $query->result_array();
      return $result;
  }
  
  public function scAttempts($learnerID, $moduleID){
      $query = $this->db->query("SELECT COUNT(sr.sResID) count FROM default_testbank tb JOIN default_testresult tr ON tb.testID = tr.testID
          JOIN default_test_sections ts ON ts.testbankID = tb.testID
          JOIN default_section_results sr ON sr.resultID = tr.resultID AND ts.sectionID = sr.sectionID
        WHERE tb.type = 'Self Check' AND tr.learnerID = $learnerID AND ts.moduleID = $moduleID");
      $result = $query->result_array();
      return $result;
  }
  
  public function latOA($courseID, $learnerID){
      $query = $this->db->query("SELECT MAX(tr.dateTaken) latest FROM default_testbank tb JOIN default_testresult tr ON tb.testID = tr.testID
          JOIN default_test_sections ts ON ts.testbankID = tb.testID JOIN default_module_modules dmm
        ON ts.moduleID = dmm.id WHERE tb.type = 'Online Assessment' AND tr.learnerID = $learnerID
        AND tb.courseID = $courseID ");
      $result = $query->result_array();
      return $result;
  }
  
  public function oaRes($learnerID, $courseID, $dateTaken){
      $query = $this->db->query("SELECT tb.noOfItems, tr.result, HOUR(tr.tDuration) h, MINUTE(tr.tDuration) m, SECOND(tr.tDuration) s FROM default_testbank tb JOIN default_testresult tr 
        ON tb.testID = tr.testID WHERE tb.type = 'Online Assessment' AND tb.courseID = $courseID AND tr.learnerID = $learnerID AND
        tr.dateTaken = '$dateTaken'");
      $result = $query->result_array();
      return $result;
  }
  
  public function allOA($learnerID, $courseID){
      $query = $this->db->query("SELECT tb.noOfItems, tr.result, tr.dateTaken, tr.resultID, tr.remarks FROM default_testbank tb JOIN default_testresult tr 
        ON tb.testID = tr.testID WHERE tb.type = 'Online Assessment' AND tb.courseID = $courseID
        AND tr.learnerID = $learnerID");
      
      $result = $query->result_array();
      return $result;
  }
  
  public function oaSect($learnerID, $resultID){
      $query = $this->db->query("SELECT dmm.title, dcc.title cTitle, sr.result, ts.noOfItems, sr.remarks FROM default_testbank tb JOIN default_testresult tr 
            ON tb.testID = tr.testID
            JOIN default_test_sections ts ON tb.testID = ts.testbankID
            JOIN default_section_results sr ON tr.resultID = sr.resultID AND ts.sectionID = sr.sectionID
            JOIN default_module_modules dmm ON dmm.id = ts.moduleID
            JOIN default_course_courses dcc ON dcc.id = tb.courseID
            WHERE tb.type = 'Online Assessment' AND sr.resultID = $resultID AND tr.learnerID = $learnerID
              GROUP BY sr.sectionID ");
      $result = $query->result_array();
      return $result;
  }
  
  public function sectRes($learnerID, $courseID, $dateTaken){
      $query = $this->db->query("SELECT ts.sectionID, sr.result, ts.noOfItems FROM default_testbank tb JOIN default_testresult tr 
            ON tb.testID = tr.testID
            JOIN default_test_sections ts ON tb.testID = ts.testbankID
            JOIN default_section_results sr ON tr.resultID = sr.resultID
            WHERE tb.type = 'Online Assessment' AND tb.courseID = $courseID AND tr.learnerID = $learnerID
            AND tr.dateTaken = '$dateTaken'
            GROUP BY sr.sectionID");
      $result = $query->result_array();
      return $result;
  }
  
  public function scHistory($learnerID, $moduleID){
      $query = $this->db->query("SELECT dmm.title, sec.noOfItems, tr.dateTaken, tr.result, dmm.title
        FROM default_testbank tb JOIN default_testresult tr ON tr.testID = tb.testID 
        JOIN default_test_sections sec ON tb.testID = sec.testbankID
        JOIN default_module_modules dmm ON dmm.id = sec.moduleID
        JOIN default_section_results sr ON tr.resultID = sr.resultID AND sec.sectionID = sr.sectionID
        WHERE sec.moduleID = $moduleID AND tr.learnerID = $learnerID AND tb.type = 'Self Check'
  ");
      
      $result = $query->result_array();
      return $result;
  }
  
  public function countPassSC($courseID, $learnerID){
      $query = $this->db->query("SELECT sr.sResID, ts.moduleID
        FROM default_testbank tb JOIN default_testresult tr ON tb.testID = tr.testID
        JOIN default_test_sections ts ON tb.testID = ts.testbankID
        JOIN default_section_results sr ON tr.resultID = sr.resultID AND ts.sectionID = sr.sectionID 
        WHERE tb.courseID = $courseID AND tr.learnerID = $learnerID  AND tb.type = 'Self Check' AND sr.remarks = 'Competent'
        GROUP BY sr.sectionID");
      $result = $query->result_array();
      return $result;
  }
  
  public function learnerFeedback($title, $feedback, $learnerID, $dateNow){
      $to_insert = array(
			
			'learnerID' => $learnerID,
                        'title' => $title,
                        'feedback' => $feedback,
                        'feedbackDate' => $dateNow
              );
                        
            $this->db->insert('default_feedbacks', $to_insert);
  }
  
  public function unregisteredFeedback($title, $feedback, $email, $dateNow){
      $to_insert = array(
			
			'email' => $email,
                        'title' => $title,
                        'feedback' => $feedback,
                        'feedbackDate' => $dateNow
              );
                        
            $this->db->insert('default_feedbacks', $to_insert);
  }
  
  public function noOfReg($yearNow){
      $query = $this->userdb->query("SELECT COUNT(userid) count, DATE_FORMAT(dateJoined, '%b') mName, YEAR(dateJoined) yNow FROM applicants WHERE YEAR(dateJoined) = $yearNow 
        GROUP BY MONTH(dateJoined)");
      $result = $query->result_array();
      return $result;
  }
  
  public function totalReg($yearNow){
      $query = $this->userdb->query("SELECT COUNT(userID) count FROM applicants WHERE YEAR(dateJoined) = '$yearNow'");
      $result = $query->row();
      return $result->count;
  }
  
  public function inactiveCount($dateNow){
      $query = $this->db->query("SELECT dcc.title, COUNT(dlm.lmID) count FROM default_learner_modules dlm JOIN default_learner_courses dlc ON
        dlm.lcID = dlc.lcID JOIN default_course_courses dcc ON dcc.id = dlc.courseID 
        WHERE ISNULL(dlm.dateFinished) AND TIMESTAMPDIFF(DAY, dlm.lastVisited, '$dateNow') >= 3
            AND dcc.status != 'draft'
        GROUP BY dcc.title
        ORDER BY COUNT(dlm.lmID) DESC
        LIMIT 5");
      $result = $query->result_array();
      return $result;
  }
  
  public function totalInactive($dateNow){
      $query = $this->db->query("SELECT COUNT(dlm.lmID) count FROM default_learner_modules dlm JOIN default_learner_courses dlc ON
        dlm.lcID = dlc.lcID JOIN default_course_courses dcc ON dcc.id = dlc.courseID 
        WHERE ISNULL(dlm.dateFinished) AND TIMESTAMPDIFF(DAY, dlm.lastVisited, '$dateNow') >= 3
              AND dcc.status != 'draft'");
      $result = $query->row();
      return $result->count;
  }
  
  public function enrollees($monthNow, $yearNow){
      $query = $this->db->query("SELECT dlc.courseID, COUNT(dlc.lcID) count, dcc.title, dcc.status FROM default_learner_courses dlc JOIN default_course_courses dcc ON dlc.courseID = dcc.id
        WHERE dlc.isEnrolled = 1 AND MONTH(dlc.dateStarted) = '$monthNow' AND YEAR(dlc.dateStarted) = '$yearNow' GROUP BY dlc.courseID
        ORDER BY COUNT(dlc.lcID) DESC
        LIMIT 5");
      $result = $query->result_array();
      return $result;
  }
  
  public function totEnrollees($monthNow, $yearNow){
      $query = $this->db->query("SELECT COUNT(dlc.lcID) count FROM default_learner_courses dlc JOIN default_course_courses dcc ON dlc.courseID = dcc.id
        WHERE dlc.isEnrolled = 1 AND MONTH(dlc.dateStarted) = '$monthNow' AND YEAR(dlc.dateStarted) = '$yearNow'");
      $result = $query->row();
      return $result->count;
  }
  
  public function courseInact($courseID, $dateNow){
      $query = $this->db->query("SELECT dcc.title, COUNT(dlm.lmID) count FROM default_learner_modules dlm JOIN default_learner_courses dlc ON
        dlm.lcID = dlc.lcID JOIN default_course_courses dcc ON dcc.id = dlc.courseID 
        WHERE dlc.courseID = $courseID AND ISNULL(dlm.dateFinished)
        AND TIMESTAMPDIFF(DAY, dlm.lastVisited, '$dateNow') >= 3 AND dcc.status != 'draft'
        ");
      $result = $query->result_array();
      return $result;
  }
  
  public function passOA($monthNow, $yearNow){
      $query = $this->db->query("SELECT dcc.id, dcc.title, COUNT(tr.resultID) count FROM default_testbank tb JOIN default_testresult tr ON tb.testID = tr.testID
        JOIN default_course_courses dcc ON tb.courseID = dcc.id WHERE tr.remarks = 'Passed' AND tb.type = 'Online Assessment' AND MONTH(tr.dateTaken) = '$monthNow' AND YEAR(tr.dateTaken) = '$yearNow'
        GROUP BY tb.courseID
        ORDER BY COUNT(tr.resultID) DESC
        LIMIT 5 ");
      $result = $query->result_array();
      return $result;
  }
  
  public function failOA($courseID, $monthNow, $yearNow){
      $query = $this->db->query("SELECT dcc.title, COUNT(tr.resultID) count FROM default_testbank tb JOIN default_testresult tr ON tb.testID = tr.testID
        JOIN default_course_courses dcc ON tb.courseID = dcc.id WHERE tb.courseID = $courseID AND tr.remarks = 'Failed' AND tb.type = 'Online Assessment' AND MONTH(tr.dateTaken) = '$monthNow' AND YEAR(tr.dateTaken) = '$yearNow'");
      $result = $query->result_array();
      return $result;
  }
  
  public function passSC($monthNow, $yearNow){
      $query = $this->db->query("SELECT dmm.id, dmm.title, COUNT(tr.resultID) count 
        FROM default_testbank tb JOIN default_testresult tr ON tb.testID = tr.testID
        JOIN default_test_sections ts ON ts.testbankID = tb.testID
        JOIN default_section_results sr ON tr.resultID = sr.resultID AND ts.sectionID = sr.sectionID 
        JOIN default_module_modules dmm ON dmm.id = ts.moduleID
        WHERE sr.remarks = 'Competent' AND tb.type = 'Self Check' 
        AND MONTH(tr.dateTaken) = '$monthNow' AND YEAR(tr.dateTaken) = '$yearNow'
        GROUP BY sr.sectionID
        ORDER BY COUNT(tr.resultID) DESC
        LIMIT 5");
      $result = $query->result_array();
      return $result;
  }
  
  public function failSC($moduleID, $monthNow, $yearNow){
      $query = $this->db->query("SELECT dmm.id, dmm.title, COUNT(tr.resultID) count 
        FROM default_testbank tb JOIN default_testresult tr ON tb.testID = tr.testID
        JOIN default_test_sections ts ON ts.testbankID = tb.testID
        JOIN default_section_results sr ON tr.resultID = sr.resultID AND ts.sectionID = sr.sectionID 
        JOIN default_module_modules dmm ON dmm.id = ts.moduleID
        WHERE sr.remarks = 'Needs Review' AND tb.type = 'Self Check' 
        AND MONTH(tr.dateTaken) = '$monthNow' AND YEAR(tr.dateTaken) = '$yearNow' AND ts.moduleID = $moduleID");
      $result = $query->result_array();
      return $result;
  }
  
  public function allFeedbacks(){
      $query = $this->db->query("SELECT * FROM default_feedbacks ORDER BY feedbackDate DESC");
      $result = $query->result_array();
      return $result;
  }
  
  public function getFeeds($id){
      $query = $this->db->query("SELECT * FROM default_feedbacks WHERE feedbackID = $id");
      $result = $query->result_array();
      return $result;
  }
  
  public function upLearnerStat($learnerID, $courseID, $stat){
      $to_insert = array(
			
			'status' => $stat
                        
              );
                        
            $this->db->where('learnerID',$learnerID)
                    ->where('courseID',$courseID)
                   ->update('default_learner_courses', $to_insert);
  }
  
  public function upLearnerFin($learnerID, $courseID, $dateFin){
      $to_insert = array(
			
			'dateFinished' => $dateFin
                        
              );
                        
            $this->db->where('learnerID',$learnerID)
                    ->where('courseID',$courseID)
                   ->update('default_learner_courses', $to_insert);
  }
  
  public function inactLearnerID($monthNow, $yearNow){
      $query = $this->db->query("SELECT dlc.learnerID FROM default_learner_courses dlc 
        JOIN default_learner_modules dlm ON dlc.lcID = dlm.lcID
        WHERE ISNULL(dlm.dateFinished) AND MONTH(DATE_ADD(dlm.lastVisited, INTERVAL 28 DAY)) <= $monthNow
        AND YEAR(DATE_ADD(dlm.lastVisited, INTERVAL 28 DAY)) <= $yearNow");
       $result = $query->result_array();
      return $result;
  }
  
  public function inactLearner($learnerID){
      $query = $this->userdb->query("SELECT * FROM users WHERE userid = $learnerID");
       $result = $query->result_array();
      return $result;
  }
  
  public function getRes($learnerID, $moduleID){
      $query = $this->db->query("SELECT tr.remarks, ts.moduleID
        FROM default_testbank tb JOIN default_test_sections ts ON tb.testID = ts.testbankID JOIN
        default_testresult tr ON tr.testID = tb.testID 
        WHERE tr.learnerID = $learnerID AND ts.moduleID = $moduleID AND tb.type = 'Self Check'
        ORDER BY tr.dateTaken DESC
        LIMIT 1");
      
      $result = $query->result_array();
      return $result;
  }
  
  public function getCourseReq(){
      $query = $this->userdb->query("SELECT * FROM jp_coursereq WHERE status = 0");
      $result = $query->result_array();
      return $result;
      }
      
       public function getReqReason($id){
      $query = $this->userdb->query("SELECT reason FROM jp_coursereq WHERE jpcrID = $id");
      $result = $query->row();
      return $result->reason;
      }
      
      public function getHeirID($id){
      $query = $this->db->query("SELECT ds.ID, dss.title FROM default_syllabus ds JOIN 
          default_sector_sectors dss ON ds.HeirarchyID = dss.id WHERE ds.HeirarchyID = $id AND ds.Type = 1");
      $result = $query->result_array();
      return $result;
      }
      
      public function getDur($learnerID, $moduleID){
          $query = $this->db->query("SELECT dlm.dateStarted, dlm.dateFinished FROM default_learner_courses dlc JOIN default_learner_modules
            dlm ON dlc.lcID = dlm.lcID WHERE dlc.learnerID = $learnerID AND dlm.moduleID = $moduleID");
          $result = $query->result_array();
          return $result;
      }
      
      public function recentActs($dateNow, $learnerID){
          $query = $this->db->query("SELECT * FROM default_recentactivity WHERE 
            TIMESTAMPDIFF(DAY, dateDone, '$dateNow') <= 7 AND learnerID = $learnerID ORDER BY dateDone DESC ");
          $result = $query->result_array();
          return $result;
      }
      
      public function lastProg($learnerID, $courseID){
          $query = $this->db->query("SELECT MAX(dlm.lastVisited) lv FROM default_learner_courses dlc JOIN default_learner_modules dlm ON dlc.lcID = dlm.lcID
            WHERE dlc.learnerID = $learnerID AND dlc.courseID = $courseID ");
          $result = $query->row();
          return $result->lv;
      }
      
      public function startDate($learnerID, $courseID){
          $query = $this->db->query("SELECT dateStarted FROM default_learner_courses 
              WHERE learnerID = $learnerID AND courseID = $courseID");
          $result = $query->row();
          return $result->dateStarted;
      }
      
      public function badgeEarned($learnerID){
          $query = $this->db->query("SELECT lb.dateEarned, rb.name, rb.module, rb.course
            FROM default_badge_badges rb JOIN default_learner_badge lb ON lb.badgeID = rb.id WHERE lb.learnerID = $learnerID");
          $result = $query->result_array();
          return $result;
      }
      
      public function repGetCourse($learnerID, $courseID){
          $query = $this->db->query("SELECT dcc.title, dcc.id, dlc.dateStarted FROM default_learner_courses dlc JOIN 
              default_course_courses dcc ON dlc.courseID = dcc.id WHERE dlc.learnerID = $learnerID AND 
                  dlc.courseID = $courseID");
          $result = $query->result_array();
          return $result;
      }
      
      public function getCompDets($learnerID){
          $query = $this->userdb->query("SELECT app.firstname, app.middlename, app.lastname, app.birthday,
              app.cellno, addr.streetno, addr.brgy, addr.district, addr.city, addr.country
              FROM applicants app JOIN address addr ON app.userid = addr.userid 
              WHERE app.userid = $learnerID ");
          $result = $query->result_array();
          return $result;
      }
      
      public function getProf($learnerID){
          $query = $this->userdb->query("SELECT users.email, app.firstname, app.middlename, app.lastname, app.birthday,
              app.cellno, addr.streetno, addr.brgy, addr.district, addr.city
              FROM applicants app JOIN address addr ON app.userid = addr.userid JOIN users ON users.userid = app.userid
              WHERE app.userid = $learnerID ");
          $result = $query->result_array();
          return $result;
      }
      
      public function compProfBadge($learnerID){
          $query = $this->db->query("SELECT badgeID FROM default_learner_badge WHERE learnerID = $learnerID 
                  AND badgeID = 1");
          $result = $query->result_array();
          return $result;
      }
      
      public function upAppProf($learnerID, $fName, $mName, $lName, $cpNum, $bday){
      $to_insert = array(
			
			'firstname' => $fName,
                        'middlename' => $mName,
                        'lastname' => $lName,
                        'cellno' => $cpNum,
                        'birthday' => $bday
                        
              );
                        
            $this->userdb->where('userid',$learnerID)
                   ->update('applicants', $to_insert);
      }
      
      public function upAddProf($learnerID, $houseNo, $brgy, $dist, $city, $country){
      $to_insert = array(
			
			'streetno' => $houseNo,
                        'brgy' => $brgy,
                        'district' => $dist,
                        'city' => $city,
                        'country' => $country
                        
              );
                        
            $this->userdb->where('userid',$learnerID)
                   ->update('address', $to_insert);
      }
      
       public function upUsersProf($learnerID, $email){
      $to_insert = array(
			
			'email' => $email
                        
              );
                        
            $this->userdb->where('userid',$learnerID)
                   ->update('users', $to_insert);
      }
      
      public function addCompProfBadge($learnerID){
        date_default_timezone_set('Hongkong');
         $to_insert = array(
			
			'learnerID' => $learnerID,
                        'badgeID' => 1,
                        'dateEarned' => date("Y-m-d H:i:s")
              );
                        
            return $this->db->insert('default_learner_badge', $to_insert);
      
    }
    
    public function newActivity($learnerID, $activity, $dateDone){
        
         $to_insert = array(
			
			'learnerID' => $learnerID,
                        'activity' => $activity,
                        'dateDone' => $dateDone
              );
                        
            $this->db->insert('default_recentactivity', $to_insert);
        }
        
    public function getFirstLes($moduleID){
        $query = $this->db->query("SELECT HeirarchyID FROM default_syllabus WHERE Type = 4 AND ParentID = (SELECT ID FROM default_syllabus
WHERE Type = 3 AND HeirarchyID = $moduleID) ORDER BY `order` ");
        $result = $query->row();
        return $result->HeirarchyID;
    }
    
    public function fullName($learnerID){
        $query = $this->userdb->query("SELECT CONCAT(firstname,' ',lastname) name FROM applicants WHERE userid = $learnerID");
        $result = $query->row();
        return $result->name;
    }
    
    public function getStat($learnerID, $courseID){
        $query = $this->db->query("SELECT status FROM default_learner_courses WHERE learnerID = $learnerID AND courseID = $courseID");
        $result = $query->row();
        return $result->status;
    }
    
    public function ifProfDone($learnerID){
        $query = $this->db->query("SELECT * FROM default_profiling_result WHERE learnerID = $learnerID");
        $result = $query->result_array();
        return $result;
    }
    
    public function getPics($learnerID){
        $query = $this->userdb->query("SELECT picture, smallpicture FROM applicants WHERE userid = 54");
        $result = $query->result_array();
        return $result;
    }
    
    public function allBadges($courseID, $learnerID){
        $query = $this->db->query("SELECT lb.dateEarned, bb.name, bb.activity, bb.course, bb.module
        FROM default_badge_badges bb JOIN default_learner_badge lb ON bb.id = lb.badgeID
        WHERE lb.learnerID = $learnerID AND bb.course = $courseID");
        $result = $query->result_array();
        return $result;
    }
    
    public function getCourseName($courseID){
        $query = $this->db->query("SELECT title FROM default_course_courses WHERE id = $courseID");
        $result = $query->row();
        return $result->title;
    }
    
    public function getModName($moduleID){
        $query = $this->db->query("SELECT title FROM default_module_modules WHERE id = $moduleID");
        $result = $query->row();
        return $result->title;
    }
    
    public function badLatestOA($learnerID){
        $query = $this->db->query("SELECT MAX(tr.dateTaken) latest
        FROM default_testresult tr JOIN default_testbank tb ON tr.testID = tb.testID
        WHERE tb.type = 'Online Assessment' AND tr.learnerID = $learnerID");
        $result = $query->result_array();
        return $result;
    }
    
    public function badLatRem($learnerID, $dateTaken ){
        $query = $this->db->query("SELECT tr.remarks, tb.courseID  
            FROM default_testresult tr JOIN default_testbank tb ON tr.testID = tb.testID
            WHERE
            tr.learnerID = $learnerID AND tr.dateTaken = '$dateTaken' AND tb.type= 'Online Assessment'"); 
        $result = $query->result_array();
        return $result;
    }
    
    public function checkOABadge($learnerID, $courseID){
        $query = $this->db->query("SELECT lb.lbID
        FROM default_learner_badge lb JOIN default_badge_badges bb ON bb.id = lb.badgeID
        WHERE bb.activity = 'Passed an Online Assessment' AND bb.course = $courseID
        AND lb.learnerID = $learnerID");
        $result = $query->row();
        return $result;
    }
    
    public function getOAID($courseID){
        $query = $this->db->query("SELECT id FROM default_badge_badges
        WHERE activity = 'Passed an Online Assessment' AND course = $courseID
        ");
        $result = $query->row();
        $numrows = $query->num_rows();
        if($numrows ==0){
            return '';
        }else{
            return $result->id;
        }
    }
    
     public function oaBadge($learnerID, $badgeID, $dateNow){
        
         $to_insert = array(
			
			'learnerID' => $learnerID,
                        'badgeID' => $badgeID,
                        'dateEarned' => $dateNow
                        
              );
                        
            return $this->db->insert('default_learner_badge', $to_insert);
      
    }
    
    public function badLatestSC($learnerID){
        $query = $this->db->query("SELECT MAX(tr.dateTaken) latest
        FROM default_testresult tr JOIN default_testbank tb ON tr.testID = tb.testID
        WHERE tb.type = 'Self Check' AND tr.learnerID = $learnerID");
        $result = $query->result_array();
        return $result;
    }
    
    public function badLatSCRem($learnerID, $dateTaken){
        $query = $this->db->query("SELECT tr.remarks, tb.courseID, ts.moduleID
            FROM default_testresult tr JOIN default_testbank tb ON tr.testID = tb.testID
            JOIN default_test_sections ts ON ts.testbankID = tb.testID
            WHERE
            tr.learnerID = $learnerID AND tr.dateTaken = '$dateTaken'
                AND tb.type = 'Self Check'");
        $result = $query->result_array();
        return $result;
    }
    
    public function checkSCBadge($learnerID, $courseID, $moduleID){
        $query = $this->db->query("SELECT lb.lbID
        FROM default_learner_badge lb JOIN default_badge_badges bb ON bb.id = lb.badgeID
        WHERE bb.activity = 'Passed a Self-Check' AND bb.course = $courseID AND bb.module = $moduleID
        AND lb.learnerID = $learnerID");
        $result = $query->row();
        return $result;
    }
    
    public function getSCID($courseID, $moduleID){
        $query = $this->db->query("SELECT id FROM default_badge_badges
        WHERE activity = 'Passed a Self-Check' AND course = $courseID AND module = $moduleID
        ");
        $result = $query->row();
        $numrows = $query->num_rows();
        if($numrows ==0){
            return '';
        }else{
            return $result->id;
        }
    }
    
    public function badSCName($courseID, $moduleID){
        $query = $this->db->query("SELECT name FROM default_badge_badges WHERE activity = 'Passed a Self-Check' 
        AND module = $moduleID AND course = $courseID");
        $result = $query->row();
        $numrows = $query->num_rows();
        if($numrows == 0){
            return '';
        }else{
            return $result->name;
        }
    }
    
    public function badSCImg($courseID, $moduleID){
        $query = $this->db->query("SELECT image FROM default_badge_badges WHERE activity = 'Passed a Self-Check' 
        AND module = $moduleID AND course = $courseID");
        $result = $query->row();
        $numrows = $query->num_rows();
        if($numrows == 0){
            return '';
        }else{
            return $result->image;
        }
    }
    
     public function enAge($learnerID){
      $query = $this->userdb->query("SELECT DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(birthday, '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') 
        < DATE_FORMAT(birthday, '00-%m-%d')) age
        FROM applicants WHERE userid = $learnerID");
      $result = $query->result_array();
      return $result;
  }
  
  public function compPBad(){
      $query = $this->db->query("SELECT name FROM default_badge_badges WHERE activity = 'Completed Profile' ");
      $result = $query->row();
      return $result->name;
  }
  
  public function compPBadImg(){
      $query = $this->db->query("SELECT image FROM default_badge_badges WHERE activity = 'Completed Profile' ");
      $result = $query->row();
      return $result->image;
  }
     
     
          
    
}
