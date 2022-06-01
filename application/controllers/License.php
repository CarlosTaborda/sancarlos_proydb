<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class License extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("License_model", "license_mdl");
	}

	public function index(){
		$this->load->model("User_model", "user_mdl");
		$data["teachers"] = $this->user_mdl->get_by_type();
		$this->load->view("license/index.php",$data);
	}


	public function create(){
		
		$message="";

		$license = array_values($this->input->post());



		if( !empty($license[1]) && !empty($this->license_mdl->get_by_code( $license[1] )) ){
			$this->license_mdl->update( $license );
			$message="Licencia actualizada exitosamente";
		}
		else{
			unset($license[1]);
			$this->license_mdl->create( $license );
			$message="Licencia creada exitosamente";
		}

		echo json_encode(["success"=>true, "message"=>$message, "licencia"=>$license]);

	}

	public function list(){
		$filter = empty($this->input->post('search')['value'])? "" : $this->input->post('search')['value'];
		$offset = empty($this->input->post('start'))? "0" : $this->input->post('start');
		$length = empty($this->input->post('length'))? "10" : $this->input->post('length');

		$result = $this->license_mdl->get_list(
			$filter,
			$offset,
			$length
		);

		echo json_encode(["data"=>$result]);
	}

	public function delete($codigo){
		$this->license_mdl->delete($codigo);
		echo json_encode(["success"=>true]);
	}


	
}
