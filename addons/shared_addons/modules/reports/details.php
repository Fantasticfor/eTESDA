<?php defined('BASEPATH') or exit('No direct script access allowed');

class Module_reports extends Module {

	public $version = '2.1';

	public function info()
	{
		return array(
			'name' => array(
				'en' => 'Reports'
			),
			'description' => array(
				'en' => 'Generate Reports of e-TESDA Learn'
			),
			'frontend' => FALSE,
			'backend' => TRUE,
			'menu' => FALSE, // You can also place modules in their top level menu. For example try: 'menu' => 'Sample',
			
		);
	}
        	public function admin_menu(&$menu)
	{
		unset($menu['Reports']);

		$menu['Reports'] = 'admin/reports';

		add_admin_menu_place('Reports', 3);
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
