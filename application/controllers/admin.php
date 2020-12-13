<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct() {
    parent::__construct();
    $this->load->model('sp_model');
		$user = $this->session->userdata('user'); 
		if ($user[0]['id'] < 1) {
			redirect(base_url().'Login');
		}
  }
 
	public function index()
	{ 
    $res['admin'] = $this->sp_model->getAdmin(); 
		$this->load->view('Admin', $res);
	}

	public function deactivate() {
		$id = $this->input->post('adminId');
		$updated = $this->sp_model->deactivateAccount('admin', $id);  
		if ($updated == 1) {
			$res['updated'] = 1;
		} else {
			$res['updated'] = 0;
		} 
		redirect(base_url().'Admin');
	}
}
