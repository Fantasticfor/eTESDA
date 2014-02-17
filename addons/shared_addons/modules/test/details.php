<?php defined('BASEPATH') or exit('No direct script access allowed');

class Module_Test extends Module {

	public $version = '2.1';

	public function info()
	{
		return array(
			'name' => array(
				'en' => 'Manage Test'
			),
			'description' => array(
				'en' => 'Create Test items, publish to item bank, and create a test'
			),
			'frontend' => TRUE,
			'backend' => TRUE,
			'menu' => 'content', // You can also place modules in their top level menu. For example try: 'menu' => 'Sample',
			'sections' => array(
				
                            'Items' => array(
					'name' 	=> 'Items', // These are translated from your language file
					'uri' 	=> 'admin/test/',
                                        'shortcuts' => array(
                                                'create' => array(
                                                'name' => 'test:new',
                                                'uri' => 'admin/test/addItem', //'admin/Syllabus/create',
                                                'class' => 'add'
                        )
                    )
						),
                            'Tests' => array(
					'name' 	=> 'Tests', // These are translated from your language file
					'uri' 	=> 'admin/test/testBank'
						
						),
                            
				)
		);
	}

	public function install()
	{
		return true;
	}

	public function uninstall()
	{
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
