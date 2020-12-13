<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
class Borrowersloan extends CI_Controller {

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
		$res['borrower'] = $this->sp_model->getBorrowersLoan();  
		$this->load->view('borrowersloan', $res);
	}
}
