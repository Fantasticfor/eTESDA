<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Admin extends Admin_Controller
{
    // This will set the active section tab
  
    public function __construct()
    {
        parent::__construct();

        $this->lang->load('xmlgen');
        $this->load->library('xml_writer');
        $this->load->helper('download');
       // $this->load->model('syllabus_m');
        $this->load->library('files/files');
         $this->load->model('files/file_folders_m');
        $this->template
                          
                        ->append_js('module::course.js')
                        ->append_js('module::module.js')
                      
                    
                        ->append_css('module::tinyeditor.css')
                    ->append_js('module::tiny.editor.packed.js')
                  ->append_js('module::admin.js')
                ->append_js('module::toggle_edit.js')
                    ->append_js('module::append_table.js')
                    ->append_js('module::dynamicVid.js')
                        ->append_css('module::admin.css')
                        ->append_css('module::css3_breadcrumbs.css')
                        ->append_css('module::css3_breadcrumbs.css')
                      //  ->append_js('module::jquery.colorbox.js')
                ->append_metadata($this->load->view('fragments/wysiwyg', $this->data, TRUE))
                        ->append_js('module::lesson.js');
       
        @session_start();
        session_start();
    }


    
    public function index(){
        
        //print_r($sectorlist);
       $this->template
			->title('XML Generator')
                        
                        ->build('admin/index');
         $xml = new Xml_writer();
        $xml->setRootName('lesson');
        $xml->initiate();
        
        // Start branch 'cars'
        $xml->startBranch('topic');
        
        // Set children for branch 'cars'
       
        $xml->addNode('title', 'Ford');
        $xml->addNode('text', 'T-Ford');

            $xml->startBranch('links');
            $xml->addNode('link', 'Ford');
            $xml->addNode('link', 'T-Ford');
            $xml->endBranch();
            
        $xml->endBranch();
        
         $xml->startBranch('topic');
        
        // Set children for branch 'cars'
       
        $xml->addNode('title', 'Ford');
        $xml->addNode('text', 'T-Ford');

            $xml->startBranch('links');
            $xml->addNode('link', 'Ford');
            $xml->addNode('link', 'T-Ford');
            $xml->endBranch();
            
        $xml->endBranch();
        
        // Pass the XML to the view
        $data = array();
        $data['xml'] = $xml->getXml(FALSE);
        
        //print_r($_SESSION['xml']);
        
        
        $this->load->helper('file');
//        if ( ! write_file('uploads/default/jm12.xml', $data['xml']))
//        {
//             echo 'Unable to write the file';
//        }
//        else
//        {
//             echo 'File written!';
//        }
    }
    
    public function downloadXML(){
        
       
        //print_r();
        $xml = new Xml_writer();
        $xml->setRootName('lesson');
        $xml->initiate();
        
        // Start branch 'cars'
       
        
        foreach($_SESSION['xml'] as $lesson){
        $xml->startBranch('topic');
        $xml->addNode('title', $lesson['topic'][0]);
        $xml->addNode('text', $lesson['topic'][1]);

            $xml->startBranch('links');
            foreach($lesson['topic'][2] as $links){
                $xml->addNode('link', $links);

               
            }
             $xml->endBranch();
        
        
        $xml->endBranch();
        }
        $xml->endBranch();
        
        // Pass the XML to the view
        $data = array();
        $data['xml'] = $xml->getXml(FALSE);
        
        //print_r($data);
        
        
        
        $this->load->helper('file');
        if ( ! write_file('uploads/default/xml/'.$_SESSION['lessonTitle'].'.xml', $data['xml']))
        {
          
             echo 'Unable to write the file';
              
              }
        else
        {  $data1 = file_get_contents("uploads/default/xml/".$_SESSION['lessonTitle'].".xml"); // Read the file's contents
            $name = $_SESSION['lessonTitle'].'.xml';
           
             //echo 'File written!';
           //redirect('admin/xmlGenerator/redirDL');
//                 redirect('admin/xmlGenerator/redirDL');
            
        }
//        redirect('admin/xmlGenerator/redirDL');
       
    }
    public function redirDL(){
      
        $data1 = file_get_contents("uploads/default/xml/".$_SESSION['lessonTitle'].".xml"); // Read the file's contents
            $name = $_SESSION['lessonTitle'].'.xml';
         unset($_SESSION['lessonTitle']);
            unset($_SESSION['xml']);
            force_download($name, $data1);
          //$this->load->view('admin/redir'); 
    }
    
    
    
    public function addXMLTopic(){
        $_SESSION['xml'][$_POST['topic'][0]] = $_POST;
        $_SESSION['lessonTitle'] = $_POST['topic'][3];
    }
    
    public function remove(){
            $array = $_POST;
           
            $value = $array['info'];
            $todelete = $value[0];
           
            unset($_SESSION['xml'][$todelete]);
    }
    
}