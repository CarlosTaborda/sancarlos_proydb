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



}
