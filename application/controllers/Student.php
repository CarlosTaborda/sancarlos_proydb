<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Student_model", "student_mdl");

	}

	public function index(){

		$this->load->model("TypeDocument_model", "typedoc_mdl");
		$this->load->model("Group_model", "group_mdl");

		$data["doc_types"] = $this->typedoc_mdl->get_all();
		$data["groups"] = $this->group_mdl->get_all();
		$this->load->view("student/index.php", $data);
	}


	public function create(){
		
		$message="";
		$estudiante = array_values($this->input->post());

		if( !empty($this->student_mdl->get_by_numdoc( $estudiante[0] )) ){
			$this->student_mdl->update( $estudiante );
			$message="Área actualizada exitosamente";
		}
		else{
			$this->student_mdl->create( $estudiante );
			$message="Área creada exitosamente";
		}

		echo json_encode(["success"=>true, "message"=>$message, "estudiante"=>$estudiante]);

	}

	public function list(){
		$filter = empty($this->input->post('search')['value'])? "" : $this->input->post('search')['value'];
		$offset = empty($this->input->post('start'))? "0" : $this->input->post('start');
		$length = empty($this->input->post('length'))? "10" : $this->input->post('length');

		$result = $this->student_mdl->get_list(
			$filter,
			$offset,
			$length
		);

		echo json_encode(["data"=>$result,"iTotalRecords"=>PHP_INT_MAX, "iTotalDisplayRecords"=>PHP_INT_MAX ]);
	}

	public function delete($numdoc){
		$this->student_mdl->delete($numdoc);
		echo json_encode(["success"=>true]);
	}

	public function get_by_numdoc($numdoc){

		$this->load->model("Attendant_model", "attendant_mdl");

		$data["estudiante"] = $this->student_mdl->get_by_numdoc( $numdoc );
		$data["acudiente"] = $this->attendant_mdl->get_by_student( $numdoc );
		$data["success"] = true;

		echo json_encode($data);

	}

}
