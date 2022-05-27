<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Area extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Area_model", "area_mdl");
	}

	public function index(){
		$this->load->view("area/index.php");
	}


	public function create(){
		
		$message="";

		$area = [
			$this->input->post('codigo'),
			$this->input->post('nombre')
		];

		if( !empty($this->area_mdl->get_by_code( $area[0] )) ){
			$this->area_mdl->update( $area );
			$message="Área actualizada exitosamente";
		}
		else{
			$this->area_mdl->create( $area );
			$message="Área creada exitosamente";
		}

		echo json_encode(["success"=>true, "message"=>$message, "area"=>$area]);

	}

	public function list(){
		$filter = empty($this->input->post('search')['value'])? "" : $this->input->post('search')['value'];
		$offset = empty($this->input->post('start'))? "0" : $this->input->post('start');
		$length = empty($this->input->post('length'))? "10" : $this->input->post('length');

		$result = $this->area_mdl->get_list(
			$filter,
			$offset,
			$length
		);

		echo json_encode(["data"=>$result]);
	}

	public function delete($codigo){
		$this->area_mdl->delete($codigo);
		echo json_encode(["success"=>true]);
	}

}
