<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Report_model","report_mdl");
	}

	public function index(){
		$this->load->view("report/index");
	}

	public function reportA(){
		$data["data_report"] = $this->report_mdl->report_a();

		
		$this->load->view("report/reportA",$data);
	}

	public function reportB(){
		
		$this->load->model("Group_model", "group_mdl");
		$data["groups"] = $this->group_mdl->get_all();

		if(empty($this->input->post("grupo_codigo"))){
			$data["data_report"] = $this->report_mdl->report_b($data["groups"][0]["codigo"]);
		}
		else{
			$data["data_report"] = $this->report_mdl->report_b($this->input->post("grupo_codigo"));
		}
		$this->load->view("report/reportB", $data);
	}


	public function reportC(){
		$data["data_report"] = $this->report_mdl->report_c();
		$this->load->view("report/reportC",$data);
	}


	public function reportD(){

		$data["data_report"]=$this->report_mdl->report_d();
		$this->load->view("report/reportD", $data);
	}


	public function reportE(){

		$this->load->model("Group_model", "group_mdl");
		$data["groups"] = $this->group_mdl->get_all();

		$anio = empty($this->input->post("grupo"))?
					1:
					$this->input->post("grupo");

		$data["data_report"]=$this->report_mdl->report_e($anio);
		$this->load->view("report/reportE", $data);
	}


	public function reportH(){

		$anio = empty($this->input->post("anio"))?
					date("Y"):
					$this->input->post("anio");

		$data["data_report"]=$this->report_mdl->report_h($anio);
		$this->load->view("report/reportH", $data);
	}

	public function reportI(){
		$anio = empty($this->input->post("anio"))?
					date("Y"):
					$this->input->post("anio");

		$data["data_report"]=$this->report_mdl->report_i($anio);
		$this->load->view("report/reportI", $data);
	}



}
