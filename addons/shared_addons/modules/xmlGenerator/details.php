<?php defined('BASEPATH') or exit('No direct script access allowed');

class Module_XmlGenerator extends Module
{
    public $version = '1.0';

    public function info()
    {
       $info = array(
            'name' => array(
                'en' => 'Lesson Creator'
            ),
            'description' => array(
                'en' => 'A tool used to create Lessons for eTESDA Learn'
            ),
            'frontend' => false,
            'backend' => true,
            'menu' => 'content',
           
        );
        
       

			
		
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
       return true;
    }

    /**
     * Uninstall
     *
     * Uninstall our module - this should tear down
     * all information associated with it.
     */
    public function uninstall()
    {


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