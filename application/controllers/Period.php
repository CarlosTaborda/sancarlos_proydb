<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Period extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Period_model", "period_mdl");
	}

	public function index(){
		$this->load->view("period/index.php");
	}


	public function create(){
		
		$message="";

		$periodo = [
			$this->input->post('codigo'),
			$this->input->post('nombre'),
			$this->input->post('fecha_inicio'),
			$this->input->post('fecha_fin'),
		];

		if( !empty($this->period_mdl->get_by_code( $periodo[0] )) ){
			$this->period_mdl->update( $periodo );
			$message="Periodo actualizado exitosamente";
		}
		else{
			$this->period_mdl->create( $periodo );
			$message="Periodo creado exitosamente";
		}

		echo json_encode(["success"=>true, "message"=>$message, "periodo"=>$periodo]);

	}

	public function list(){
		$filter = empty($this->input->post('search')['value'])? "" : $this->input->post('search')['value'];
		$offset = empty($this->input->post('start'))? "0" : $this->input->post('start');
		$length = empty($this->input->post('length'))? "10" : $this->input->post('length');

		$result = $this->period_mdl->get_list(
			$filter,
			$offset,
			$length
		);

		echo json_encode(["data"=>$result]);
	}

	public function delete($codigo){
		$this->period_mdl->delete($codigo);
		echo json_encode(["success"=>true]);
	}

}
