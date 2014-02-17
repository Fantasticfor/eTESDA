<?php defined('BASEPATH') or exit('No direct script access allowed');

class Module_Syllabus extends Module
{
    public $version = '1.0';

    public function info()
    {
       $info = array(
            'name' => array(
                'en' => 'Manage Syllabus'
            ),
            'description' => array(
                'en' => ''
            ),
            'frontend' => true,
            'backend' => true,
            'menu' => 'content',
            'sections' => array(
                'faq' => array(
                    'name' => 'sylla:syllabus',
                    'uri' => 'admin/syllabus',
                    'shortcuts' => array(
                        'create' => array(
                            'name' => 'sylla:new',
                            'uri' => 'admin/syllabus/createSector', //'admin/Syllabus/create',
                            'class' => 'add'
                        )
                    )
                )
            )
        );
        
       

			// Show the correct +Add button based on the page
			if ($this->uri->segment(4) == 'fields' and $this->uri->segment(5))
			{
				$info['sections']['template']['shortcuts'] = array(
								array(
								    'name' => 'streams:new_field',
								    'uri' => 'admin/syllabus/templates/fields/'.$this->uri->segment(5).'/new_field',
								    'class' => 'add'
								)
						    );
			}
			else
			{
				$info['sections']['template']['shortcuts'] = array(
							array(
								    'name' => 'sylla:new',
								    'uri' => 'admin/syllabus/templates/create',
								    'class' => 'add'
								)
							);			
			}
		
                return $info;
    }

    /**
     * Install
     *
     * This function will set up our
     * FAQ/Category streams.
     */
    public function install()
    {
        // We're using the streams API to
        // do data setup.
        $this->load->driver('Streams');

        $this->load->language('syllabus/syllabus');
        
        $this->load->library('files/files');
        $folder = Files::create_folder(0, 'syllabus');
       // $folder = Files::create_folder('syllabus', 0);
        $folder_id = $folder['data']['id'];
        // add_stream(name, $stream_slug, $namespace, $prefix = null, $about = null, $extra = array()); 
       // if ( ! $this->streams->streams->add_stream('lang:sylla:syllabus', 'syllabi', 'syllabus', 'syllabus_', null)) return false;
        //if ( ! $categories_stream_id = $this->streams->streams->add_stream('lang:faq:categories', 'categories', 'faq', 'faq_', null)) return false;
        if ( ! $this->streams->streams->add_stream('lang:sylla:course', 'courses', 'course', 'course_', null)) return false;
        if ( ! $this->streams->streams->add_stream('lang:sylla:module', 'modules', 'module', 'module_', null)) return false;
        if ( ! $this->streams->streams->add_stream('lang:sylla:sector', 'sectors', 'sector', 'sector_', null)) return false;
        if ( ! $this->streams->streams->add_stream('lang:sylla:lesson', 'lessons', 'lesson', 'lesson_', null)) return false;
        //if ( ! $this->streams->streams->add_stream('lang:sylla:topic', 'topics', 'topic', 'topic_', null)) return false;
         //if ( ! $this->streams->streams->add_stream('lang:sylla:type', 'types', 'type', 'type_', null)) return false;
       $tables = array(
           'topics' => array(
				'id' => array('type' => 'INT', 'constraint' => 11, 'auto_increment' => true, 'primary' => true),
				'slug' => array('type' => 'VARCHAR', 'constraint' => 255, 'default' => '', 'key' => 'slug'),
				'title' => array('type' => 'VARCHAR', 'constraint' => 255, 'default' => ''),
				'uri' => array('type' => 'TEXT', 'null' => true),
				
				'entry_id' => array('type' => 'VARCHAR', 'constraint' => 255, 'null' => true),
				'status' => array('type' => 'ENUM', 'constraint' => array('draft', 'live'), 'default' => 'draft'),
				'created_on' => array('type' => 'INT', 'constraint' => 11, 'default' => 0),
				'updated_on' => array('type' => 'INT', 'constraint' => 11, 'default' => 0),
				'order' => array('type' => 'INT', 'constraint' => 11, 'default' => 0),
                                'author_id' => array('type' => 'INT', 'constraint' => 11, 'default' => 0),
                                'textCont' => array('type' => 'TEXT')
                        )
		);
       
       if ( ! $this->install_tables($tables))
		{
			return false;
		}
                
                $this->load->driver('streams');

		
	
		// add the fields to the streams
		$this->streams->fields->add_fields(config_item('pages:default_fields'));

		// Insert the page type structures
		

	
        $fields = array(

            array(                                          ////////////SECTOR
                'name' => 'Title',
                'slug' => 'title',
                'namespace' => 'sector',
                'type' => 'text',
                'extra' => array('max_length' => 200),
                'assign' => 'sectors',
                'title_column' => true,
                'required' => true,
                'unique' => true,
                'alpha' => true
            ),
            array(
                'name' => 'Description',
                'slug' => 'description',
                'namespace' => 'sector',
                'type' => 'textarea',
                'assign' => 'sectors',
                'required' => true,
                'alpha' => true
            ),
           array(                                          ////////////COURSE
                'name' => 'Title',
                'slug' => 'title',
                'namespace' => 'course',
                'type' => 'text',
                'extra' => array('max_length' => 200),
                'assign' => 'courses',
                'title_column' => true,
                'required' => true,
                'unique' => true
            ),
            array(
                'name' => 'Description',
                'slug' => 'description',
                'namespace' => 'course',
                'type' => 'textarea',
                'assign' => 'courses',
                'required' => true
            ),
             array(
                'name' => 'Status',
                'slug' => 'status',
                'namespace' => 'course',
                'type' => 'textarea',
                'assign' => 'courses',
                'required' => true
            ),array(
                'name' => 'Status',
                'slug' => 'status',
                'namespace' => 'module',
                'type' => 'textarea',
                'assign' => 'modules',
                'required' => true
            ),
            array(
                'name' => 'Duration',
                'slug' => 'duration',
                'namespace' => 'course',
                'type' => 'textarea',
                'assign' => 'courses',
                'required' => true
             ),
            array(                                          ////////////MODULE
                'name' => 'Title',
                'slug' => 'title',
                'namespace' => 'module',
                'type' => 'text',
                'extra' => array('max_length' => 200),
                'assign' => 'modules',
                'title_column' => true,
                'required' => true,
                'unique' => true
            ), array( 
                'name' => 'Image',
                'slug' => 'image',
                'namespace' => 'sector',
                'type' => 'image',
                'extra' => array('folder' => $folder_id,
                    'allowed_types' => 'jpg|png'),
                'instruction' => "Upload an image",
                'assign' => 'sectors',
                'title_column' => true,
                'required' => true,
                'unique' => true ),
            array( 
                'name' => 'Image',
                'slug' => 'image',
                'namespace' => 'course',
                'type' => 'image',
                'extra' => array('folder' => $folder_id,
                    'allowed_types' => 'jpg|png'),
                'instruction' => "Upload an image",
                'assign' => 'courses',
                'title_column' => true,
                'required' => true,
                'unique' => true 
                ),array(                                          ////////////Lesson
                'name' => 'Title',
                'slug' => 'title',
                'namespace' => 'lesson',
                'type' => 'text',
                'extra' => array('max_length' => 200),
                'assign' => 'lessons',
                'title_column' => true,
                'required' => true,
                'unique' => true
            )
        );

        $this->streams->fields->add_fields($fields);
        
//        $this->streams->streams->update_stream('syllabi', 'syllabus', array(
//            'view_options' => array(
//                'id',
//                'title',
//                'description',
//                'path'
//            )
//        ));
        $this->streams->streams->update_stream('sectors', 'sector', array(
            'view_options' => array(
                'id',
                'title',
                'description'
               // 'path'
            )
        ));
        $this->streams->streams->update_stream('courses', 'course', array(
            'view_options' => array(
                'id',
                'title',
                'description',
                'status'
            )
        ));
        $this->streams->streams->update_stream('modules', 'module', array(
            'view_options' => array(
                'id',
                'title',
                'description',
                'status'
              
            )
        ));
        
        $this->streams->streams->update_stream('lessons', 'lesson', array(
            'view_options' => array(
                'id',
                'title'
              
            )
        ));
        /*$this->streams->streams->update_stream('topics', 'topic', array(
            'view_options' => array(
                'id',
                'title'
            )
        ));*/
        
        
 /*
         $this->db->insert('ref_types', $sector);
         $this->db->insert('ref_types', $module);
         $this->db->insert('ref_types', $courses);
		
        */
        if (is_dir($this->upload_path.'syllabus') OR @mkdir($this->upload_path.'syllabus',0777,TRUE))
        {return true;}
                //return true;
    }

    /**
     * Uninstall
     *
     * Uninstall our module - this should tear down
     * all information associated with it.
     */
    public function uninstall()
    {
        $this->load->driver('Streams');

        // For this teardown we are using the simple remove_namespace
        // utility in the Streams API Utilties driver.
        $this->streams->utilities->remove_namespace('syllabus');
$this->streams->utilities->remove_namespace('course');
$this->streams->utilities->remove_namespace('sector');
$this->streams->utilities->remove_namespace('module');
$this->streams->utilities->remove_namespace('topic');
$this->streams->utilities->remove_namespace('lesson');



        return true;
    }

    public function upgrade($old_version)
    {
        return true;
    }

    public function help()
    {
        // Return a string containing help info
        // You could include a file and return it here.
        return "No documentation has been added for this module.<br />Contact the module developer for assistance.";
    }

}