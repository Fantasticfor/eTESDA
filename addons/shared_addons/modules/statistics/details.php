<?php defined('BASEPATH') or exit('No direct script access allowed');

class Module_statistics extends Module {

	public $version = '2.1';

	public function info()
	{
		return array(
			'name' => array(
				'en' => 'Reports and Statistics'
			),
			'description' => array(
				'en' => ''
			),
			'frontend' => FALSE,
			'backend' => TRUE,
			'menu' => 'content', // You can also place modules in their top level menu. For example try: 'menu' => 'Sample',
		
                    
                    'sections' => array(
				 'Course' => array(
					'name' 	=> 'Course and Test Statistics', // These are translated from your language file
					'uri' 	=> 'admin/statistics/'
						
						),
                          'geo' => array(
					'name' 	=> 'Geographical Statistics', // These are translated from your language file
					'uri' 	=> 'admin/statistics/geoStat'
						
						),  
                            'Learner' => array(
					'name' 	=> 'Learner Monitoring', // These are translated from your language file
					'uri' 	=> 'admin/statistics/learnerStat',
                                   
						),
                           
                        
                          'Sector' => array(
					'name' 	=> 'Sector Summary', // These are translated from your language file
					'uri' 	=> 'admin/statistics/sectorStat'
						
						),
                       
               
                            
				)
		);
	}
        	public function admin_menu(&$menu)
	{
		unset($menu['Statistics']);

		$menu['Statistics'] = 'admin/statistics';

		add_admin_menu_place('Statistics', 2);
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
