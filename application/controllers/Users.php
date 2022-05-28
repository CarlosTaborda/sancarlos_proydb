<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("User_model", "user_mdl");

		
	}

	public function index()
	{
		if($this->session->userdata('logged')=== true){
			redirect(site_url("users/home"));
		}
		
		$this->load->model("TypeDocument_model", "typedoc_mdl");
		$data["doc_types"] = $this->typedoc_mdl->get_all();
		$this->load->view('user/login.php', $data);
	}

	public function create(){
		
		$user = [
			$this->input->post('num_documento'),
			$this->input->post('usuario'),
			$this->input->post('nombre'),
			$this->input->post('apellido'),
			$this->input->post('contrasena'),
			$this->input->post('fech_nacimiento'),
			$this->input->post('email'),
			$this->input->post('direccion'),
			'1',
			$this->input->post('tipo_documento')
		];

		$this->user_mdl->create($user);

		if($this->input->post('user_type')=="admin"){
			$data=[
				$this->input->post('eps'),
				$this->input->post('pension'),
				$user[0]
			];
			$this->user_mdl->create_admin($data);
		}
		else{
			$data=[
				$this->input->post('profession'),
				$user[0]
			];
			$this->user_mdl->create_teacher($data);
		}

		echo json_encode([
			"success"=>true,
			"user"=>$user
		]);

	}


	public function auth(){
		$username = $this->input->post("username");
		$password = $this->input->post("password");

		$user = $this->user_mdl->auth($username, $password);

		if( empty($user) ){
			echo json_encode(["success"=>false]);
		}
		else{
			$this->session->set_userdata('logged', true);
			$this->session->set_userdata('user', $user);

			echo json_encode(["success"=>true]);
		}
	}

	public function home(){
		$this->load->model("Area_model", "area_mdl");

		$data["areas"] = $this->area_mdl->get_all();
		$this->load->view("user/home",$data);
	}

	public function account(){
		
		$this->load->model("TypeDocument_model", "typedoc_mdl");
		$data["user"] = $this->user_mdl->get_by_numdoc(
			$this->session->userdata('user')["num_documento"]
		);
		$data["doc_types"] = $this->typedoc_mdl->get_all();
	
		$this->load->view("user/account", $data);
	}

	public function logout(){
		$this->session->set_userdata('logged', false);
		$this->session->set_userdata('user', null);

		redirect(base_url());
	}

	public function delete($numdoc){
		$this->user_mdl->delete($numdoc);
		echo json_encode(["success"=>true]);
	}

	public function edit(){

		$user=[
			$this->input->post('num_documento'),
			$this->input->post('usuario'),
			$this->input->post('nombres'),
			$this->input->post('apellidos'),
			$this->input->post('contrasena'),
			$this->input->post('fecha_nacimiento'),
			$this->input->post('email'),
			$this->input->post('direccion'),
			'1',
			$this->input->post('tipo_documento_codigo')
		];

		$this->user_mdl->update( $user );

		if(!empty($this->input->post('profesion'))){

			$data[] = $this->input->post('profesion');
			$data[] = $user[0];

			$this->user_mdl->update_teacher($data);	
		}
		else{
			$data[] = $this->input->post('eps');
			$data[] = $this->input->post('pension');
			$data[] = $user[0];

			$this->user_mdl->update_admin($data);	
		}

		echo json_encode(["success"=>true, "message"=>"Usuario actualizado", "user"=>$user]);
	}
}
