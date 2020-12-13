<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
class Borrower extends CI_Controller {

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
		$res['borrower'] = $this->sp_model->getBorrower(); 
		$res['rates'] = $this->sp_model->getRate(); 
		$this->load->view('Borrower', $res);
	}



	public function createBorrower() {
		 $fname = $this->input->post('fname');
		 $mname =  $this->input->post('mname');
		 $lname =  $this->input->post('lname');
		 $age =  $this->input->post('age');
		 $gender =  $this->input->post('gender');
		 $bdate =  $this->input->post('bdate');
		 $street =  $this->input->post('street');
		 $muni = $this->input->post('muni');
		 $city =  $this->input->post('city');
		 $country =  $this->input->post('country');
		 $sourceofincome =  $this->input->post('sourceofincome');
		 $occupation =  $this->input->post('occupation');
		 $providedId =  $this->input->post('providedId');
		 $idNo =  $this->input->post('idNo');
		
		 $res = $this->sp_model->createBorrower(
			$fname,
			$mname,
			$lname,
			$age,
			$gender,
			$bdate,
			$street,
			$muni,
			$city,
			$country,
			$sourceofincome,
			$occupation,
			$providedId,
			$idNo
		 );
		 
		 echo json_encode($res, true); 
	}

	public function archiveBorrower() {
		$id = $this->input->post('borrowerId');
		$updated = $this->sp_model->deactivateAccount('borrower', $id);  
		if ($updated == 1) {
			$res['updated'] = 1;
		} else {
			$res['updated'] = 0;
		}  
		redirect(base_url().'Borrower');
	}

	public function borrowMoney() {
		$bId = $this->input->post('bId');
		$bAmount =  $this->input->post('bAmount');
		$selectRate =  $this->input->post('selectRate');
		$bDate =  $this->input->post('bDate');
		$bTotalAmount =  $this->input->post('bTotalAmount');
		$bDueDate =  $this->input->post('bDueDate');
		$bMonths =  $this->input->post('bMonths');
		$res = $this->sp_model->borrowMoney($bId,$bAmount,$selectRate,$bDate,$bTotalAmount,$bDueDate,$bMonths); 
		$res['data'] = $res;
		echo json_encode($res);
	}
}
