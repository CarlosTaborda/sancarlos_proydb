<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Course_model", "course_mdl");
	}


	public function create(){
		
		$message="";

		$course = [
			$this->input->post('codigo'),
			$this->input->post('nombre'),
			$this->input->post('hrs_semana'),
			$this->input->post('area')
		];

		if( !empty($this->course_mdl->get_by_code($course[0])) ){
			$this->course_mdl->update($course);
			$message="Materia actualizada exitosamente";
		}
		else{
			$this->course_mdl->create($course);
			$message="Materia creada exitosamente";

		}

		
		echo json_encode(["success"=>true, "course"=>$course, "message"=>$message]);
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

	public function delete($codigo){
		$this->course_mdl->delete($codigo);
		echo json_encode(["success"=>true]);

	}

}
