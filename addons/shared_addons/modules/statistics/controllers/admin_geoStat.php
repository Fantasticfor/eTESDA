<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a sample module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	Sample Module
 */
class Admin_geoStat extends Admin_Controller
{
	protected $section = 'geo';

	public function __construct()
	{
		parent::__construct();

		// Load all the required classes
		$this->load->model('sample_m');
                $this->load->helper('download');
                $this->load->helper('file'); 
		$this->load->library('form_validation');
		$this->lang->load('syllabus');
                $this->lang->load('topic');
         
		// Set the validation rules
		$this->item_validation_rules = array(
			array(
				'field' => 'name',
				'label' => 'Name',
				'rules' => 'trim|max_length[100]|required'
			),
			array(
				'field' => 'slug',
				'label' => 'Slug',
				'rules' => 'trim|max_length[100]|required'
			)
		);
                $this->template
                         ->append_css('module::admin.css')
                         ->append_css('module::css3_breadcrumbs.css')
                        ->append_css('jquery/jquery-ui.css')
                 ->append_js('jquery/jquery.ui.nestedSortable.js')
			->append_js('jquery/jquery.cooki.js')
			->append_js('jquery/jquery.stickyscroll.js')
                          ->append_css('module::index.css')
                ->append_js('module::admin.js')
                ->append_js('module::jquery.tablesorter.min.js')
                ->append_js('module::filter_dropdown.js')
                ->append_js('module::items.js')
                ->append_js('module::jquery.tablesorter.pager.js')
                ->append_js('module::highcharts.js');
                        
               
		
		
	}

	/**
	 * List all items
	 */
	public function index()
	{
		// here we use MY_Model's get_all() method to fetch everything
		//$items = $this->sample_m->get_all();

		// Build the view with sample/views/admin/items.php
                $this->load->model('syllabus/getSectors');
                $this->load->model('syllabus/getCourses');
                $allSects = $this->getSectors->getSectorList();
                $courses = $this->getCourses->getAllCourses();
                $formopts = array();
                $formopts[0] = 'All';
                
                foreach($allSects as $sector){
                    $formopts[$sector['id']] = $sector['title'];
                }
            
		$this->template
			->title('Geographical Statistics')
			
                       
                      
			->build('admin/geoStat/index');
	}
        
        public function load_geoReport(){
            $geoType = $this->input->get('geoType');
            $this->load->model('model_users');
            $allCountries = $this->model_users->getCountries();
            $countryReg = array();
            $countryCTR = 0;
            $totalPerC = array();
           
            foreach($allCountries as $ac){
                $countryReg[$countryCTR]= $this->model_users->enPerCount($ac['country']);
                 $sumC = 0;
                foreach($countryReg[$countryCTR] as $cr){
                    if($geoType == 1){
                        $enCount = $this->model_users->countEnGeo($cr['userid']);
                        $sumC += $enCount;
                    }else{
                        $enCount = $this->model_users->countGrGeo($cr['userid']);
                        $sumC += $enCount;
                    }
                }
                $totalPerC[$countryCTR] []= $sumC;
                $countryCTR ++;
            }
            //print_r($totalPerC);
            $this->load->view('admin/geoStat/load_geoReport', array('allCountries' => $allCountries, 'totalPerC' => $totalPerC, 'geoType' => $geoType));
            
        }

	
        
      
        
       
}
