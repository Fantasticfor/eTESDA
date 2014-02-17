<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Create A Syllabus
 *
 * @author 		Fantastic 4
 * @website		
 * @package 	
 * @subpackage 	
 * @copyright 	MIT
 */
class syllabus_m extends MY_Model {

	private $folder;

	public function __construct()
	{
		parent::__construct();
		$this->_table = 'syllabus';
		// $this->load->model('files/file_folders_m');
		// $this->load->library('files/files');
		// $this->folder = $this->file_folders_m->get_by('name', 'syllabus');
	}

	//create a new item
	public function create($input)
	{
		// $fileinput = Files::upload($this->folder->id, FALSE, 'fileinput');
		$to_insert = array(
			// 'fileinput' => json_encode($fileinput);
			'Name' => $input['Name'],
'Description' => $input['Description'],

		);

		return $this->db->insert('syllabus', $to_insert);
	}

	//edit a new item
	public function edit($id = 0, $input)
	{
		// $fileinput = Files::upload($this->folder->id, FALSE, 'fileinput');
		$to_insert = array(
			'Name' => $input['Name'],
'Description' => $input['Description'],

		);

		// if ($fileinput['status']) {
		// 	$to_insert['fileinput'] = json_encode($fileinput);
		// }

		return $this->db->where('id', $id)->update('syllabus', $to_insert);
	}
}
