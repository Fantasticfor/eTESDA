<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
$route['Syllabus(/:num)?']			= 'Syllabus/index$1';

$route['faq/admin/categories(:any)'] = 'admin_categories$1';
$route['Syllabus/admin/streams(:any)'] = 'admin_streams$1';



//copy this to cms/config/routes.php
$route['dashboard']	                    = 'syllabus/index';
$route['myProfile']                         ='syllabus/viewProfile';
$route['sectors']	                    = 'syllabus/Sectors';