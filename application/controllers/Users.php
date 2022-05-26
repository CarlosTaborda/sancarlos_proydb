<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {


	public function index()
	{
		$this->load->model("TipoDocumento_model", "tipodocumento_mdl");
		$data["doc_types"] = $this->tipodocumento_mdl->get_all();
		$this->load->view('user/login.php', $data);
	}

	public function create(){
		
	}
}
