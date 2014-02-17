<?php defined('BASEPATH') or exit('No direct script access allowed');

class Module_Badge extends Module {

	public $version = '2.1';

	public function info()
	{
		return array(
			'name' => array(
				'en' => 'Manage Badges'
			),
			'description' => array(
				'en' => 'Manage the System\'s Badges'
			),
			'frontend' => False,
			'backend' => TRUE,
			'menu' => 'content', // You can also place modules in their top level menu. For example try: 'menu' => 'Sample',
			'sections' => array(
                            'badge' => array(
                                'name' => 'Badge',
                                'uri' => 'admin/badge',
                                'shortcuts' => array(
                                    'create' => array(
                                        'name' => 'badge:new',
                                        'uri' => 'admin/badge/addBadge', //'admin/Syllabus/create',
                                        'class' => 'add'
                                    )
                                )
                            )
                        )
		);
	}

	public function install()
	{
            
         $this->load->driver('Streams');

       
        $this->load->language('badge/badge');
        $this->load->library('files/files');
        $folder = Files::create_folder(0, 'badges');
       // $folder = Files::create_folder('syllabus', 0);
        $folder_id = $folder['data']['id'];
        
         if ( ! $this->streams->streams->add_stream('lang:badge:badge', 'badges', 'badge', 'badge_', null)) return false;
        
         $fields = array(

            array(                                          ////////////SECTOR
                'name' => 'Name',
                'slug' => 'name',
                'namespace' => 'badge',
                'type' => 'text',
                'extra' => array('max_length' => 200),
                'assign' => 'badges',
                'title_column' => true,
                'required' => true,
                'unique' => true,
                'alpha' => true
            ),
            array(
                'name' => 'Activity',
                'slug' => 'activity',
                'namespace' => 'badge',
                'type' => 'text',
                'assign' => 'badges',
                'required' => true,
               
            )
             ,
            array(
                'name' => 'Module',
                'slug' => 'module',
                'namespace' => 'badge',
                'type' => 'text',
                'assign' => 'badges',
                'required' => true,
               
            ),
            array(
                'name' => 'Course',
                'slug' => 'course',
                'namespace' => 'badge',
                'type' => 'text',
                'assign' => 'badges',
                'required' => true,
               
            ),
             array(
                'name' => 'Status',
                'slug' => 'status',
                'namespace' => 'badge',
                'type' => 'text',
                'assign' => 'badges',
                
               
            ),
             
            array( 
                'name' => 'Image',
                'slug' => 'image',
                'namespace' => 'badge',
                'type' => 'image',
                'extra' => array('folder' => $folder_id,
                    'allowed_types' => 'jpg|png'),
                'instruction' => "Upload an image",
                'assign' => 'badges',
                'title_column' => true,
                'required' => true,
                'unique' => true 
                ),
             
        );
         
          $this->streams->fields->add_fields($fields);
         
          $this->streams->streams->update_stream('badges', 'badge', array(
            'view_options' => array(
                'id',
                'name',
                'description'
              
            )
        ));
          
           if (is_dir($this->upload_path.'badge') OR @mkdir($this->upload_path.'badge',0777,TRUE))
        {return true;}
            
		return true;
	}

	public function uninstall()
	{
             $this->streams->utilities->remove_namespace('badge');
		return true;
	}


	public function upgrade($old_version)
	{
		// Your Upgrade Logic
		return TRUE;
	}

	public function help()
	{
		// Return a string containing help info
		// You could include a file and return it here.
		return "No documentation has been added for this module.<br />Contact the module developer for assistance.";
	}
}
/* End of file details.php */
