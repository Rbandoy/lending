<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('sp_model'); 
		$this->load->helper('url');
		$user = $this->session->userdata('user'); 
		if ($user[0]['id'] < 1) {
			redirect(base_url().'Login');
		}
  }
 
	public function index()
	{
		$res['data'] = $this->sp_model->getDashboardData();
		$this->load->view('Main', $res);
	}

	public function getData()
	{
		$res['data'] = $this->sp_model->getChartData();
		echo json_encode($res, true);
	}
}
