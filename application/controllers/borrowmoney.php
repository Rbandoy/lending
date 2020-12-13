<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Borrowmoney extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$user = $this->session->userdata('user'); 
		if ($user[0]['id'] < 1) {
			redirect(base_url().'Login');
		}
  }
 
	public function index()
	{ 
		$this->load->view('borrowmoney');
	}
}
