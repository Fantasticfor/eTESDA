<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Theme_Bootstrap extends Theme {

    public $name = 'e-TESDA Learn Theme ';
    public $author = 'e-TESDA Learn';
    public $author_website = '';
    public $website = '';
    public $description = 'This is built on top of Twitter Bootstrap.';
    public $version = '1.0.0';
    public $options = array(
        'show_breadcrumbs' => array(
                     	    'title' => 'Show Breadcrumbs',
							'description'   => 'Would you like to display breadcrumbs?',
							'default'       => 'yes',
							'type'          => 'radio',
							'options'       => 'yes=Yes|no=No',
							'is_required'   => TRUE
						),
        'include_nav_fix' => array(
                            'title' => 'Include Navigation Fix',
                            'description'   => 'Would you like to include a fix for the navigation bar?',
                            'default'       => 'yes',
                            'type'          => 'radio',
                            'options'       => 'yes=Yes|no=No',
                            'is_required'   => TRUE
                        ),
        'navigation_layout' =>  array('title' => 'Navigation layout',
                                'description'   => 'How would you like the navigation displayed?',
                                'default'       => 'bar',
                                'type'          => 'select',
                                'options'       => 'bar=Bar|navbar-fixed-top=Fixed to top|navbar-fixed-bottom=Fixed to bottom',
                                'is_required'   => TRUE),
        );
}

/* End of file theme.php */