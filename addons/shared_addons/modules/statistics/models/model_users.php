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
    
    public function get_user($email,$password){
        
        $data = array(
          'email' => $email,
          'userpassword' => $password
        );
        
        $user = $this->userdb->get_where('users',$data);
       
        $row = $user->row();
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
       
        return $profile;
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
           'status' => 1
           
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
      if ($facebook_user['relationship_status']==null){
          $relstat = 'Secret';   
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
  
  public function inactiveCount($monthNow, $yearNow){
      $query = $this->db->query("SELECT dcc.title, COUNT(dlm.lmID) count FROM default_learner_modules dlm JOIN default_learner_courses dlc ON
        dlm.lcID = dlc.lcID JOIN default_course_courses dcc ON dcc.id = dlc.courseID 
        WHERE ISNULL(dlm.dateFinished) AND MONTH(DATE_ADD(dlm.lastVisited, INTERVAL 28 DAY)) <= '$monthNow' 
        AND YEAR(DATE_ADD(dlm.lastVisited, INTERVAL 28 DAY)) <= '$yearNow'
        GROUP BY dlm.lcID
        ORDER BY COUNT(dlm.lmID) DESC
        LIMIT 5");
      $result = $query->result_array();
      return $result;
  }
  
  public function totalInactive($monthNow, $yearNow){
      $query = $this->db->query("SELECT COUNT(dlm.lmID) count FROM default_learner_modules dlm JOIN default_learner_courses dlc ON
        dlm.lcID = dlc.lcID JOIN default_course_courses dcc ON dcc.id = dlc.courseID 
        WHERE ISNULL(dlm.dateFinished) AND MONTH(DATE_ADD(dlm.lastVisited, INTERVAL 28 DAY)) <= '$monthNow'
        AND YEAR(DATE_ADD(dlm.lastVisited, INTERVAL 28 DAY)) <= '$yearNow'");
      $result = $query->row();
      return $result->count;
  }
  
  public function enrollees($monthNow, $yearNow){
      $query = $this->db->query("SELECT dlc.courseID, COUNT(dlc.lcID) count, dcc.title FROM default_learner_courses dlc JOIN default_course_courses dcc ON dlc.courseID = dcc.id
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
  
  public function courseInact($courseID, $monthNow, $yearNow){
      $query = $this->db->query("SELECT dcc.title, COUNT(dlm.lmID) count FROM default_learner_modules dlm JOIN default_learner_courses dlc ON
        dlm.lcID = dlc.lcID JOIN default_course_courses dcc ON dcc.id = dlc.courseID 
        WHERE dlc.courseID = $courseID AND MONTH(DATE_ADD(dlm.lastVisited, INTERVAL 28 DAY)) <= '$monthNow' AND ISNULL(dlm.dateFinished)
        AND YEAR(DATE_ADD(dlm.lastVisited, INTERVAL 28 DAY)) <= '$yearNow'
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
  
  public function inactLearnerID($dateNow){
      $query = $this->db->query("SELECT dlc.learnerID FROM default_learner_courses dlc 
        JOIN default_learner_modules dlm ON dlc.lcID = dlm.lcID JOIN default_course_courses dcc
        ON dcc.id = dlc.courseID
        WHERE dcc.status != 'draft' AND ISNULL(dlm.dateFinished) AND TIMESTAMPDIFF(DAY, dlm.lastVisited, '$dateNow') >= 3");
       $result = $query->result_array();
      return $result;
  }
  
  public function inactLearner($learnerID){
      $query = $this->userdb->query("SELECT * FROM users WHERE userid = $learnerID");
       $result = $query->result_array();
      return $result;
  }
  
  public function countEnrolled($courseID){
      $query = $this->db->query("SELECT COUNT(lcID) count FROM default_learner_courses WHERE courseID = $courseID AND isEnrolled = 1");
      $result = $query->result_array();
      return $result;
  }
  
  public function countGrads($courseID){
      $query = $this->db->query("SELECT COUNT(lcID) count FROM default_learner_courses WHERE courseID = $courseID AND status = 3 AND isEnrolled = 1");
      $result = $query->result_array();
      return $result;
  }
  
  public function avgDur($courseID){
      $query = $this->db->query("SELECT ROUND(AVG(TIMESTAMPDIFF(DAY, dateStarted, dateFinished))) avg FROM default_learner_courses WHERE 
        courseID = $courseID AND dateFinished != ''");
      $result = $query->result_array();
      return $result;
  }
  
  public function courseEnr($courseID){
      $query = $this->db->query("SELECT learnerID, courseID, dateStarted, status FROM default_learner_courses WHERE courseID = $courseID 
        AND isEnrolled = 1");
      $result = $query->result_array();
      return $result;
  }
  
  public function courseGrad($courseID){
      $query = $this->db->query("SELECT learnerID, courseID, dateStarted, dateFinished FROM default_learner_courses WHERE courseID = $courseID 
        AND status = 3");
      $result = $query->result_array();
      return $result;
  }
  
  public function enrNames($learnerID){
      $query = $this->userdb->query("SELECT CONCAT(firstname,' ', lastname) name FROM applicants WHERE userid = $learnerID");
      $result = $query->result_array();
      return $result;
  }
  
  public function courseName($courseID){
      $query = $this->db->query("SELECT title FROM default_course_courses WHERE id = $courseID");
      $result = $query->row();
      return $result->title;
  }
  
  public function getAllLearners($courseID){
      $query = $this->db->query("SELECT learnerID FROM default_learner_courses WHERE courseID = $courseID");
      $result = $query->result_array();
      return $result;
  }
  
  public function getCourseMods($courseID){
      $query = $this->db->query("SELECT dmm.title, dmm.id, dmm.status FROM default_module_modules dmm JOIN default_syllabus syll 
        ON dmm.id = syll.HeirarchyID
        WHERE syll.Type = 3 AND syll.ParentID = (SELECT ID FROM default_syllabus WHERE
        Type = 2 AND HeirarchyID = $courseID)");
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
  
  public function learnList(){
      $query = $this->db->query("SELECT learnerID FROM default_learner_courses WHERE isEnrolled = 1
        GROUP BY learnerID");
      $result = $query->result_array();
      return $result;
  }
  
  public function gradCount($learnerID){
      $query = $this->db->query("SELECT COUNT(lcID) count FROM default_learner_courses WHERE status = 3 AND learnerID = $learnerID");
      $result = $query->result_array();
      return $result;
  }
  
  public function allLearnerNames(){
      $query = $this->userdb->query("SELECT CONCAT(app.firstname,' ',app.middlename,' ',app.lastname,' -- ',user.email) name, CONCAT(app.firstname,' ',app.middlename,' ',app.lastname) name2, app.userid FROM applicants app JOIN users user ON app.userid = user.userid");
      $result = $query->result_array();
      return $result;
  }
  
  public function searchLearn($name){
      $query = $this->userdb->query("SELECT userid FROM applicants WHERE CONCAT(firstname,' ',middlename,' ',lastname) = '$name'
        GROUP BY userid");
      $result = $query->result_array();
      return $result;
  }
  
  public function enCountry($learnerID){
      $query = $this->userdb->query("SELECT country FROM address WHERE userid = $learnerID");
      $result = $query->result_array();
      return $result;
  }
  
  public function detsEn($learnerID, $courseID){
      $query = $this->db->query("SELECT dateStarted, dateFinished, status FROM default_learner_courses
          WHERE learnerID = $learnerID AND courseID = $courseID");
      $result = $query->result_array();
      return $result;
  }
  
  public function enAge($learnerID){
      $query = $this->userdb->query("SELECT DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(birthday, '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') 
        < DATE_FORMAT(birthday, '00-%m-%d')) age
        FROM applicants WHERE userid = $learnerID");
      $result = $query->result_array();
      return $result;
  }
  
  public function getCountries(){
      $query = $this->userdb->query("SELECT country FROM address WHERE country != '' GROUP BY country");
      $result = $query->result_array();
      return $result;
  }
  
  public function enPerCount($country){
      $query = $this->userdb->query("SELECT userid FROM address WHERE country = '$country'");
      $result = $query->result_array();
      return $result;
  }
  
  public function countEnGeo($learnerID){
      $query = $this->db->query("SELECT COUNT(lcID) count FROM default_learner_courses
          WHERE isEnrolled = 1 AND learnerID = $learnerID");
      $result = $query->row();
      return $result->count;
  }
  
  public function countGrGeo($learnerID){
      $query = $this->db->query("SELECT COUNT(lcID) count FROM default_learner_courses
          WHERE isEnrolled = 1 AND status = 3 AND learnerID = $learnerID");
      $result = $query->row();
      return $result->count;
  }
  
 
  
  
  
  
  
  
          
    
}
