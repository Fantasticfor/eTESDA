<?php defined('BASEPATH') or exit('No direct script access allowed');

class Module_Syllabus extends Module
{
    public $version = '1.0';

    public function info()
    {
        return array(
            'name' => array(
                'en' => 'Syllabus'
            ),
            'description' => array(
                'en' => 'Create Syllabus'
            ),
            'frontend' => true,
            'backend' => true,
            'menu' => 'content',
            'sections' => array(
                'faq' => array(
                    'name' => 'sylla:syllabus',
                    'uri' => 'admin/Syllabus',
                    'shortcuts' => array(
                        'create' => array(
                            'name' => 'sylla:new',
                            'uri' => 'admin/Syllabus/choose_type?modal=true', //'admin/Syllabus/create',
                            'class' => 'add modal'
                        )
                    )
                )
            )
        );
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

        $this->load->language('Syllabus/syllabus');
        
        $this->load->library('files/files');
        Files::create_folder(0, 'syllabus');

        // add_stream(name, $stream_slug, $namespace, $prefix = null, $about = null, $extra = array()); 
        if ( ! $this->streams->streams->add_stream('lang:sylla:syllabus', 'syllabi', 'syllabus', 'syllabus_', null)) return false;
        //if ( ! $categories_stream_id = $this->streams->streams->add_stream('lang:faq:categories', 'categories', 'faq', 'faq_', null)) return false;
        if ( ! $this->streams->streams->add_stream('lang:sylla:course', 'courses', 'course', 'course_', null)) return false;
        if ( ! $this->streams->streams->add_stream('lang:sylla:module', 'modules', 'module', 'module_', null)) return false;
        if ( ! $this->streams->streams->add_stream('lang:sylla:sector', 'sectors', 'sector', 'sector_', null)) return false;
         //if ( ! $this->streams->streams->add_stream('lang:sylla:type', 'types', 'type', 'type_', null)) return false;
         
        
        //Add ref_type
        /*$syllabus = array(
            'syllabus' => array('id' => array('type' => 'INT', 'constraint' => 11, 'auto_increment' => true, 'primary' => true),
                                'hierarchyID' => array('type' => 'INT', 'constraint' => 11, 'null' => false),
                                'hierarchy' => array('type' => 'INT', 'constraint' => 11, 'null' => false),
                                'parentID' => array('type' => 'INT', 'constraint' => 11, 'null' => false)));
            
            */
        
        /* $types = array(
        'ref_types' => array('id' => array('type' => 'INT', 'constraint' => 11, 'auto_increment' => true, 'primary' => true),
				'name' => array('type' => 'VARCHAR', 'constraint' => 200, 'null' => false, 'unique' => true)));
         
         $this->install_tables($types);
	 
         $sector = array(
             
             'name' => 'Sector'
         );
         $module = array(
             
             'name' => 'Module'
         );
         $courses = array(
             
             'name' => 'Courses'
         );*/
        
         // Add some fields
        $fields = array(
            array(
                'name' => 'Title',
                'slug' => 'title',
                'namespace' => 'syllabus',
                'type' => 'text',
                'extra' => array('max_length' => 200),
                'assign' => 'syllabi',
                'title_column' => true,
                'required' => true,
                'unique' => true
            ),
            array(
                'name' => 'Description',
                'slug' => 'description',
                'namespace' => 'syllabus',
                'type' => 'textarea',
                'assign' => 'syllabi',
                'required' => true
            ),
            array(                                          ////////////SECTOR
                'name' => 'Title',
                'slug' => 'title',
                'namespace' => 'sector',
                'type' => 'text',
                'extra' => array('max_length' => 200),
                'assign' => 'sectors',
                'title_column' => true,
                'required' => true,
                'unique' => true
            ),
            array(
                'name' => 'Description',
                'slug' => 'description',
                'namespace' => 'sector',
                'type' => 'textarea',
                'assign' => 'sectors',
                'required' => true
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
            ),
            array(
                'name' => 'Description',
                'slug' => 'description',
                'namespace' => 'module',
                'type' => 'textarea',
                'assign' => 'modules',
                'required' => true
            )
            /*,
            array(
                'name' => 'Img',
                'slug' => 'uploadImg',
                'namespace' => 'syllabus',
                'type' => 'image',
                'assign' => 'syllabi',
                'required' =>true,
                'folder' => 'syllabus',
            )
                
                
                /*,
            array(
                'name' => 'Title',
                'slug' => 'faq_category_title',
                'namespace' => 'faq',
                'type' => 'text',
                'assign' => 'categories',
                'title_column' => true,
                'required' => true,
                'unique' => true
            ),
            array(
                'name' => 'Category',
                'slug' => 'faq_category_select',
                'namespace' => 'faq',
                'type' => 'relationship',
                'assign' => 'faqs',
                'extra' => array('choose_stream' => $categories_stream_id)
            )*/
        );

        $this->streams->fields->add_fields($fields);
        
        $this->streams->streams->update_stream('syllabi', 'syllabus', array(
            'view_options' => array(
                'id',
                'title',
                'description',
                'path'
            )
        ));
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
                'description'
               // 'path'
            )
        ));
        $this->streams->streams->update_stream('modules', 'module', array(
            'view_options' => array(
                'id',
                'title',
                'description'
              
            )
        ));
        
        
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