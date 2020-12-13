<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
class BorrowEntry extends CI_Controller {

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
    $res['borrowerTransaction'] = $this->sp_model->getBorrowerEntry(''); 
    if (count($res['borrowerTransaction']) > 0) { 
      $res['fname'] = $res['borrowerTransaction'][0]['fullname'];
		}
		$this->load->view('borrowEntry', $res);
	} 
}
