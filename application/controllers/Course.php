<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Course_model", "course_mdl");
	}


	public function create(){
		
		$course = [
			$this->input->post('codigo'),
			$this->input->post('nombre'),
			$this->input->post('hrs_semana'),
			$this->input->post('area')
		];

		$this->course_mdl->create($course);
		echo json_encode(["success"=>true, "course"=>$course]);
	}

	public function list(){
		$filter = empty($this->input->post('search')['value'])? "" : $this->input->post('search')['value'];
		$offset = empty($this->input->post('start'))? "0" : $this->input->post('start');
		$length = empty($this->input->post('length'))? "10" : $this->input->post('length');

		$result = $this->course_mdl->get_list(
			$filter,
			$offset,
			$length
		);

		echo json_encode(["data"=>$result]);
	}

}
