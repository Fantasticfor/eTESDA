<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

$route['faq/admin/categories(:any)'] = 'admin_categories$1';
$route['syllabus/admin/streams(:any)'] = 'admin_streams$1';
$route['syllabus/admin/topics(/:any)?'] = 'admin_topics$1';
$route['syllabus/admin/templates(/:any)?'] = 'admin_templates$1';