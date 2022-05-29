<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendant extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Attendant_model", "attendant_mdl");
	}



	public function create(){
		
		$acudiente = $this->input->post();
		$message = "";

		if(!empty($this->attendant_mdl->get_by_code($acudiente['num_documento']))){
			$this->attendant_mdl->update($acudiente);
			$message = "Acudiente actualizado exitosamente";
		}
		else{
			$this->attendant_mdl->create($acudiente);
			$message = "Acudiente creado exitosamente";
		}

		echo json_encode(["success"=>true, "message"=>$message, "acudiente"=>array_values($acudiente)]);

	}

	public function get_all(){
		$acudientes= $this->attendant_mdl->get();
		echo json_encode(["success"=>true, "data"=>$acudientes]);
	}



}
